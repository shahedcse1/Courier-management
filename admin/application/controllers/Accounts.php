<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

    /**
     * Accounts constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('common');

        if (!in_array($this->session->userdata('user_role'), [1, 2, 3,4,5])) {
            redirect('auth');
        }
    }

    public function vouchar() {
        $data['title'] = 'Accounts Vouchar';
        $data['active_menu'] = 'accounts';
        $data['sub_menu'] = 'vouchar';
        $user_role = $this->session->userdata('user_role');
        $user_id = $this->session->userdata('user_id');

        if ($user_role == 2):
            $where = "WHERE paid_to=$user_id";
            $data['voucharinfo'] = $this->db->query("SELECT vouchar.*,users.name,users.company_name FROM vouchar JOIN users ON users.id=vouchar.paid_to $where Order by paid_date DESC")->result();

            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('accounts/vouchar', $data);
            $this->load->view('common/footer', $data);
        else:
            $where = '';
            $data['voucharinfo'] = $this->db->query("SELECT vouchar.*,users.name,users.company_name,users.phone FROM vouchar JOIN users ON users.id=vouchar.paid_to GROUP BY  vouchar.paid_to")->result();

            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('accounts/vouchar_all', $data);
            $this->load->view('common/footer', $data);
        endif;
    }

    function vouchar_details() {
        $data['title'] = 'Vouchar Details';
        $data['active_menu'] = 'accounts';
        $data['sub_menu'] = 'vouchar';
        $user_id = $this->input->get('paid_to');
        $month = $this->input->get('month');

        if (empty($month)):
            $date = date("Y-m", strtotime(date('Y-m-d')));
        else:
            $date = $month;
        endif;

        $where = "WHERE paid_to=$user_id";
        $data['voucharinfo'] = $this->db->query("SELECT vouchar.*,users.name,users.company_name FROM vouchar JOIN users ON users.id=vouchar.paid_to $where  AND paid_date LIKE '%$month%' Order by id DESC")->result();

        $data['paidto'] = $user_id;
        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('accounts/vouchar', $data);
        $this->load->view('common/footer', $data);
    }

    function transaction() {
        $data['title'] = 'Transaction Details';
        $data['active_menu'] = 'accounts';
        $data['sub_menu'] = 'transaction';
        $month = $this->input->post('month');
        if (!empty($month)):
            $all = $this->db
                            ->select('SUM(netprice) as transaction')
                            ->from('accounts')
                            ->where('paidtomarchent', 1)
                            ->LIKE('paid_marchent_date', $month)
                            ->get()
                            ->row()
                    ->transaction;
        else:
            $all = 0;
        endif;

        $data['transaction'] = $all;

        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('accounts/transaction_details', $data);
        $this->load->view('common/footer', $data);
    }

    public function addvouchar() {
        $data['title'] = 'Add Vouchar';
        $data['active_menu'] = 'accounts';
        $data['sub_menu'] = 'vouchar';

        $marchantQr = $this->db->query("SELECT * FROM users Where role='2' order by name");
        $data['marchent'] = $marchantQr->result();

        /** Assets */
        add_asset("css", 'global/plugins/bootstrap-summernote/summernote.css');
        add_assets('js', [
            'js/custom/add-voucher.js'
        ]);

        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('accounts/add_vouchar', $data);
        $this->load->view('common/footer', $data);
    }

    public function addvouchardata() {
        if (!in_array($this->session->userdata('user_role'), [1,5])) {
            redirect('auth');
        }
        $date = date('Y-m-d');
        $target_dir = "uploads/vouchar/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imgFile = $_FILES['fileToUpload']['name'];


        if (empty($imgFile)) :
            $image_path = '';
        else:
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) :
                $image_path = basename($_FILES["fileToUpload"]["name"]);
            else:
                $data['error'] = "Sorry, there was an error uploading your file";
            endif;
        endif;

        $marchent = $this->input->post('marchent_name');
        $payable_amount = $this->input->post('amount');
        $adjust_amount = $this->input->post('amount1');
        $cod = $this->input->post('amount3');
        $amount = $this->input->post('amount4');
        $remakrs = $this->input->post('remarks');
        $tracking_id = $this->input->post('tracking');
        $allrequest_id = implode(",", $tracking_id);

        $tracking_id2 = $this->input->post('tracking2');
        if (!empty($tracking_id2)):
            $allrequest_id2 = implode(",", $tracking_id2);
            $this->db->query("UPDATE accounts SET collect_frmod=1,coll_frmd_date='$date' WHERE id IN($allrequest_id2)");
            $this->db->query("UPDATE accounts SET paidtomarchent=1,paid_marchent_date='$date' WHERE id IN($allrequest_id)");
            $allrequestmergre = array_merge($tracking_id, $tracking_id2);
            $allrequestid = implode(",", $allrequestmergre);
        else:
            $this->db->query("UPDATE accounts SET paidtomarchent=1,paid_marchent_date='$date' WHERE id IN($allrequest_id)");
            $allrequestid = $allrequest_id;
        endif;

        $maxidqr = $this->db->query("SELECT MAX(id) AS MAX FROM vouchar ");
        $max = $maxidqr->row()->MAX;

        if (!empty($max)):
            $voucharid = $max + 1001;
        else:
            $voucharid = 1001;
        endif;
        $pvoucharId = 'pxvo' . '_' . rand() . $voucharid;
        $data = [
            'vouchar_no' => $pvoucharId,
            'paid_to' => $marchent,
            'payable_ids' => $allrequest_id,
            'adjustable_ids' => $allrequest_id2,
            'payable_amount' => $payable_amount,
            'adjustable_amount' => $adjust_amount,
            'COD' => $cod,
            'total_amount' => $amount,
            'paid_type' => $this->input->post('paid_type'),
            'file_name' => $image_path,
            'receivedby_marchent' => 1,
            'remarks' => $remakrs,
            'paid_date' => date('Y-m-d')
        ];

        $status = $this->db->insert('vouchar', $data);
        if ($status):
            $this->session->set_userdata('add', 'Vouchar add And paid to marchant Successfully ');
        else:
            $this->session->set_userdata('notadd', 'Failed to add Vouchar');
        endif;
        redirect('accounts/vouchar');
    }

    function updateby_marchent() {
        $date = date('Y-m-d');
        $receivedid = $this->input->post('receivedid');
        $this->db
                ->set('receivedby_marchent', 1)
                ->set('received_date', $date)
                ->where('id', $receivedid)
                // ->where('receivedby_marchent', 0)
                ->update('vouchar');
    }

    function print_vouchar() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3,5))) :
            $id = $this->input->get('id');
            $data['base_url'] = $this->config->item('base_url');
            $voucharQr = $this->db->query("SELECT vouchar_no FROM vouchar WHERE vouchar.id='$id'");
            $vouchar = $voucharQr->row()->vouchar_no;
            $data['title'] = 'Vouchar Copy-' . $vouchar;
            $data['role'] = $this->session->userdata('user_role');
            $data['active_menu'] = 'accounts';
            $data['sub_menu'] = 'vouchar';
            $role = $data['role'];
            if ($role == 2):
                $date = date('Y-m-d');
                $receivedid = $id;
                $this->db
                        ->set('received_date', $date)
                        ->set('seenby_merchant', 1)
                        ->where('id', $receivedid)
                        // ->where('receivedby_marchent', 0)
                        ->update('vouchar');
            endif;

            $allinfoqr = $this->db->query("SELECT vouchar.*,users.company_name,users.name,users.phone,users.address FROM vouchar JOIN users On users.id=vouchar.paid_to   WHERE vouchar.id='$id'");
            $data['allinfo'] = $allinfoqr->row();

            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('accounts/vouchar_print', $data);
            $this->load->view('common/footer', $data);
        else :
            redirect('auth');
        endif;
    }

    public function payableProducts() {
        $userId = $this->input->post('userId');
        $payables = $this->db
                ->select('accounts.id as id')
                ->select('request.tracking_id as trackingId')
                ->select('accounts.netprice as price')
                ->select('request.customer_name as customer_name')
                ->from('accounts')
                ->join('request', 'accounts.request_id = request.id')
                ->where('accounts.paidtomarchent', 0)
                //  ->where('accounts.collect_frmod', 1)
                ->where('request.request_by', $userId)
                ->where('request.deliverydate <>', '')
                ->order_by('request.tracking_id', 'asc')
                ->get()
                ->result();

        echo json_encode($payables, JSON_PRETTY_PRINT);
    }

    public function adjust_due() {
        $userId = $this->input->post('userId');
        $adjust1 = $this->db
                ->select('accounts.id as id')
                ->select('request.tracking_id as trackingId')
                ->select('accounts.delivery_cost as price')
                ->select('request.customer_name as customer_name')
                ->from('accounts')
                ->join('request', 'accounts.request_id = request.id')
                ->where('accounts.paidtomarchent', 0)
                ->where('request.request_by', $userId)
                ->where_in('request.final_status ', array(7))
                ->order_by('request.tracking_id', 'asc')
                ->get()
                ->result();
        $adjust2 = $this->db
                ->select('accounts.id as id')
                ->select('request.tracking_id as trackingId')
                ->select('accounts.delivery_cost as price')
                ->select('request.customer_name as customer_name')
                ->from('accounts')
                ->join('request', 'accounts.request_id = request.id')
                //  ->where('accounts.paidtomarchent', 0)
                ->where('accounts.collect_frmod', 0)
                ->where('request.request_by', $userId)
                ->where_in('request.final_status ', array(5))
                ->order_by('request.tracking_id', 'asc')
                ->get()
                ->result();
        $adjust = array_merge($adjust1, $adjust2);

        echo json_encode($adjust, JSON_PRETTY_PRINT);
    }

    public function payableProduct() {
        $id = $this->input->post('id');
        $payables = $this->db
                ->select('netprice as price')
                ->from('accounts')
                ->where('id', $id)
                ->get()
                ->row();

        echo json_encode($payables, JSON_PRETTY_PRINT);
    }

    public function payableProduct2() {
        $id = $this->input->post('id');
        $payables = $this->db
                ->select('delivery_cost as price')
                ->from('accounts')
                ->where('id', $id)
                ->get()
                ->row();

        echo json_encode($payables, JSON_PRETTY_PRINT);
    }

    public function payable() {
        $data['title'] = 'Accounts Payable';
        $data['active_menu'] = 'accounts';
        $data['sub_menu'] = 'payable';
        $data['receivable'] = [];

        if ($this->session->userdata('user_role') == 1 || $this->session->userdata('user_role') == 5) {
            $data['payables'] = $this->db
                    ->select('accounts.id as id')
                    ->select('accounts.paidtomarchent as paidtomarchent')
                    ->select('request.deliverydate as date')
                    ->select('request.final_status as final_status')
                    ->select('request.tracking_id as trackingId')
                    ->select('users.company_name as company')
                    ->select('users.phone as phone')
                    ->select('accounts.netprice as price')
                    ->from('accounts')
                    ->join('request', 'accounts.request_id = request.id')
                    ->join('users', 'request.request_by = users.id')
                    ->where('request.final_status <>', 7)
                    ->order_by('accounts.paid_marchent_date', 'asc')
                    ->get()
                    ->result();
        }

        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('accounts/payable', $data);
        $this->load->view('common/footer', $data);
    }

    public function receivable() {
        $data['title'] = 'Accounts Receivable';
        $role = $this->session->userdata('user_role');
        $data['active_menu'] = $role == 2 ? 'merchant' : 'accounts';
        $data['sub_menu'] = 'receivable';
        $data['receivable'] = [];

        if ($role == 2) {
            $data['receivables'] = $this->db
                    ->select('request.deliverydate as date')
                    ->select('request.tracking_id as trackingId')
                    ->select('request.final_status as final_status')
                    ->select('accounts.id as id')
                    ->select('accounts.netprice as price')
                    ->from('accounts')
                    ->join('request', 'accounts.request_id = request.id')
                    ->join('users', 'request.request_by = users.id')
                    ->where('request.request_by', $this->session->userdata('user_id'))
                    ->where('accounts.paidtomarchent', 0)
                    ->order_by('request.deliverydate', 'DESC')
                    ->get()
                    ->result();
        } elseif ($this->session->userdata('user_role') == 1 || $this->session->userdata('user_role') == 5) {
            $data['receivables'] = $this->db
                    ->select('request.deliverydate as date')
                    ->select('request.tracking_id as trackingId')
                    ->select('request.final_status as final_status')
                    ->select('users.company_name as company')
                    ->select('staffs.name as deliveryMan')
                    ->select('staffs.phone as deliveryManPhone')
                    ->select('accounts.id as id')
                    ->select('accounts.collect_frmod as collect_frmod')
                    ->select('accounts.netprice as price')
                    ->select('accounts.delivery_cost as deliveryCost')
                    ->from('accounts')
                    ->join('request', 'accounts.request_id = request.id')
                    ->join('staffs', 'staffs.id = request.delivery_man')
                    ->join('users', 'request.request_by = users.id')
                    //  ->where('accounts.collect_frmod', 0)
                    ->order_by('accounts.coll_frmd_date', 'asc')
                    ->get()
                    ->result();
        }

        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('accounts/receivable', $data);
        $this->load->view('common/footer', $data);
    }

    public function payToMerchant() {
        $id = $this->input->post('id');
        $date = date('Y-m-d');

        $this->db
                ->set('paidtomarchent', 1)
                ->set('paid_marchent_date', $date)
                ->where('id', $id)
                ->update('accounts');

        echo true;
    }

    /**
     * Additional Cost
     */
    public function additionalCost() {
        if (!in_array($this->session->userdata('user_role'), [1,5])) {
            redirect('auth');
        }

        $data['title'] = 'Additional Costs';
        $data['active_menu'] = 'accounts';
        $data['sub_menu'] = 'additionalcost';
        $data['costs'] = [];
        $data['category'] = $this->db->query("SELECT * FROM cost_category order by category_name")->result();

        $data['costs'] = $this->db->query("select substr(date, 1, 7) yr_mon, count(*) num_cost ,SUM(amount) AS total from additional_cost group by yr_mon order by yr_mon DESC ")->result();
        /** Assets */
        add_asset("css", 'css/style.css');
        add_assets('js', [
            'global/plugins/moment.min.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'js/custom/additionalCost.js'
        ]);

        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('accounts/additionalCost', $data);
        $this->load->view('common/footer', $data);
    }

    public function cost_details() {
        if (!in_array($this->session->userdata('user_role'), [1,5])) {
            redirect('auth');
        }

        $data['title'] = 'Costs Details';
        $data['active_menu'] = 'accounts';
        $data['sub_menu'] = 'additionalcost';
        $data['costs'] = [];
        $month = $this->input->get('month');
        $data['category'] = $this->db->query("SELECT * FROM cost_category order by category_name")->result();

        $data['costs'] = $this->db->query("select * FROM additional_cost where date LIKE '%$month%' order by date desc ")->result();
        /** Assets */
        add_asset("css", 'css/style.css');
        add_assets('js', [
            'global/plugins/moment.min.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'js/custom/additionalCost.js'
        ]);

        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('accounts/additionalCost_details', $data);
        $this->load->view('common/footer', $data);
    }

    public function newCost() {
        if (!in_array($this->session->userdata('user_role'), [1,5])) {
            redirect('auth');
        }

        $date = $this->input->post('dateOfCost');
        $dateOfCost = date_format(date_create_from_format('d/m/Y', $date), 'Y-m-d');

        $purpose = $this->input->post('addPurpose');
        $amount = $this->input->post('addAmount');

        $data = [
            'date' => $dateOfCost,
            'purpose' => $purpose,
            'amount' => $amount,
            'remarks' => $this->input->post('remarks')
        ];

        $status = $this->db
                ->insert('additional_cost', $data);
        if ($status):
            $this->session->set_userdata('add', 'Add Additonal Cost Successfully ');
        else:
            $this->session->set_userdata('notadd', 'Failed to add Additonal Cost');
        endif;
        redirect('accounts/additionalcost');
    }

    public function editCost($id = false) {
        if (!in_array($this->session->userdata('user_role'), [1,5])) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'You are not authorized to do this.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        if (!$id) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Please provide an ID.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        $getCost = $this->db
                ->order_by('created_at', 'desc')
                ->where('id', $id)
                ->get('additional_cost')
                ->row();

        if (!$getCost) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'No records found.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        $response = [
            'success' => true,
            'error' => false,
            'message' => 'One Record found.',
            'costs' => $getCost
        ];

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function updateCost() {
        if (!in_array($this->session->userdata('user_role'), [1,5])) {
            redirect('auth');
        }

        $id = $this->input->post('additionalCostId');
        $date = $this->input->post('editDateOfCost');
        $dateOfCost = date_format(date_create_from_format('d/m/Y', $date), 'Y-m-d');

        $purpose = $this->input->post('editPurpose');
        $amount = $this->input->post('editAmount');

        $this->db
                ->set('date', $dateOfCost)
                ->set('purpose', $purpose)
                ->set('amount', $amount)
                ->where('id', $id)
                ->update('additional_cost');

        redirect('accounts/additionalcost');
    }

    public function deleteCost($id = false) {
        if (!in_array($this->session->userdata('user_role'), [1,5])) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'You are not authorized to do this.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        if (!$id) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Please provide an ID.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        $this->db
                ->where('id', $id)
                ->delete('additional_cost');

        $response = [
            'success' => true,
            'error' => false,
            'message' => 'Successfully deleted your selected additional cost.'
        ];

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function collectFromDeliveryMan() {
        if (!in_array($this->session->userdata('user_role'), [1,5])) {
            redirect('auth');
        }

        $id = $this->input->post('id');
        $date = date('Y-m-d');

        $this->db
                ->set('collect_frmod', 1)
                ->set('coll_frmd_date', $date)
                ->where('id', $id)
                ->update('accounts');

        echo true;
    }

    public function profitAnalysis() {
        if (!in_array($this->session->userdata('user_role'), [1])) {
            redirect('auth');
        }

        $data['title'] = 'Profit Analysis';
        $data['active_menu'] = 'accounts';
        $data['sub_menu'] = 'profitanalysis';
        $data['costs'] = [];

        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('accounts/profitAnalysis', $data);
        $this->load->view('common/footer', $data);
    }

    public function monthOfProfit() {
        if (!in_array($this->session->userdata('user_role'), [1])) {
            redirect('auth');
        }

        $month = $this->input->post('month');
        $response = [];

        $response['debit'] = (double) $this->db
                        ->select('SUM(accounts.delivery_cost) as debit')
                        ->from('accounts')
                        ->join('request', 'request.id = accounts.request_id')
                        ->where('accounts.collect_frmod', 1)
                        ->where('DATE_FORMAT(request.inhousedate, "%m/%Y") =', $month)
                        ->get()
                        ->row()
                ->debit;



        $additionalCost = $this->db
                        ->select('SUM(amount) as additionalCost')
                        ->from('additional_cost')
                        ->where('DATE_FORMAT(additional_cost.date, "%m/%Y") =', $month)
                        ->get()
                        ->row()
                ->additionalCost;

        $response['credit'] = $additionalCost;

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

}
