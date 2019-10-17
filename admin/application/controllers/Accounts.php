<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

    /**
     * Accounts constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('common');

        if (!in_array($this->session->userdata('user_role'), [1, 2, 3])) {
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
        else:
            $where = '';
        endif;
        $data['voucharinfo'] = $this->db->query("SELECT vouchar.*,users.name,users.company_name FROM vouchar JOIN users ON users.id=vouchar.paid_to $where Order by id DESC")->result();

        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('accounts/vouchar', $data);
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
        if (!in_array($this->session->userdata('user_role'), [1])) {
            redirect('auth');
        }

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
        $amount = $this->input->post('amount');
        $remakrs = $this->input->post('remarks');
        $tracking_id = $this->input->post('tracking');
        $allrequest_id = implode(",", $tracking_id);
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
            'total_amount' => $amount,
            'paid_type' => $this->input->post('paid_type'),
            'file_name' => $image_path,
            'remarks' => $remakrs,
            'paid_date' => date('Y-m-d')
        ];

        $this->db->insert('vouchar', $data);
        $date = date('Y-m-d');
        $status = $this->db->query("UPDATE accounts SET paidtomarchent=1,paid_marchent_date='$date' WHERE id IN($allrequest_id)");
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
                ->where('receivedby_marchent', 0)
                ->update('vouchar');
    }

    function print_vouchar() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :
            $id = $this->input->get('id');
            $data['base_url'] = $this->config->item('base_url');
            $voucharQr = $this->db->query("SELECT vouchar_no FROM vouchar WHERE vouchar.id='$id'");
            $vouchar = $voucharQr->row()->vouchar_no;
            $data['title'] = 'Vouchar Copy-' . $vouchar;
            $data['role'] = $this->session->userdata('user_role');
            $data['active_menu'] = 'accounts';
            $data['sub_menu'] = 'vouchar';


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
                ->where('request.request_by', $userId)
                ->where('request.deliverydate <>', '')
                ->order_by('request.tracking_id', 'asc')
                ->get()
                ->result();

        echo json_encode($payables, JSON_PRETTY_PRINT);
    }

    public function adjust_due() {
        $userId = $this->input->post('userId');
        $adjust = $this->db
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

        if ($this->session->userdata('user_role') == 1) {
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
        } elseif ($this->session->userdata('user_role') == 1) {
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
        if (!in_array($this->session->userdata('user_role'), [1])) {
            redirect('auth');
        }

        $data['title'] = 'Additional Costs';
        $data['active_menu'] = 'accounts';
        $data['sub_menu'] = 'additionalcost';
        $data['costs'] = [];

        $data['costs'] = $this->db
                ->order_by('date', 'desc')
                ->get('additional_cost')
                ->result();

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

    public function newCost() {
        if (!in_array($this->session->userdata('user_role'), [1])) {
            redirect('auth');
        }

        $date = $this->input->post('dateOfCost');
        $dateOfCost = date_format(date_create_from_format('d/m/Y', $date), 'Y-m-d');

        $purpose = $this->input->post('addPurpose');
        $amount = $this->input->post('addAmount');

        $data = [
            'date' => $dateOfCost,
            'purpose' => $purpose,
            'amount' => $amount
        ];

        $this->db
                ->insert('additional_cost', $data);

        redirect('accounts/additionalcost');
    }

    public function editCost($id = false) {
        if (!in_array($this->session->userdata('user_role'), [1])) {
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
        if (!in_array($this->session->userdata('user_role'), [1])) {
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
        if (!in_array($this->session->userdata('user_role'), [1])) {
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
        if (!in_array($this->session->userdata('user_role'), [1])) {
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
                        ->select('SUM(accounts.netprice + accounts.delivery_cost) as debit')
                        ->from('accounts')
                        ->join('request', 'request.id = accounts.request_id')
                        ->where('accounts.collect_frmod', 1)
                        ->where('DATE_FORMAT(request.inhousedate, "%m/%Y") =', $month)
                        ->get()
                        ->row()
                ->debit;

        $paid = $additionalCost = 0.00;

        $paid = $this->db
                        ->select('SUM(accounts.netprice ) as paid')
                        ->from('accounts')
                        ->join('request', 'request.id = accounts.request_id')
                        ->where('accounts.paidtomarchent', 1)
                        ->where('DATE_FORMAT(request.inhousedate, "%m/%Y") =', $month)
                        ->get()
                        ->row()
                ->paid;

        $additionalCost = $this->db
                        ->select('SUM(amount) as additionalCost')
                        ->from('additional_cost')
                        ->where('DATE_FORMAT(additional_cost.date, "%m/%Y") =', $month)
                        ->get()
                        ->row()
                ->additionalCost;

        $response['credit'] = (double) $paid + (double) $additionalCost;

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

}
