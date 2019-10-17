<?php

class Merchant extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common');
        $this->load->library('excel');
    }

    public function makerequest_action() {
        if (in_array($this->session->userdata('user_role'), array(1))) :
            $ids = $this->input->post('request_id');
            $action = $this->input->post('action');
            if ($action == 1):
                $statusId = 1;
                if (!empty($ids)):
                    $requestData = array(
                        'final_status' => 2,
                        'inprogress_date' => date('Y-m-d')
                    );
                    $this->db->where('final_status', $statusId);
                    $this->db->where_in('id', $ids);
                    $this->db->update('request', $requestData);
                    $this->session->set_userdata('add', 'Your submited tracking ids are succesfully inprogressed.');
                    redirect('merchant/requestlist/' . $statusId);
                else:
                    $this->session->set_userdata('notadd', 'Sorry ! You Dont select any tracking number.');
                    redirect('merchant/requestlist/' . $statusId);
                endif;
            elseif ($action == 2):
                $statusId = 2;
                if (!empty($ids)):
                    $requestData = array(
                        'final_status' => 4,
                        'product_receive' => 1,
                        'inhousedate' => date('Y-m-d')
                    );
                    $this->db->where('final_status', $statusId);
                    $this->db->where_in('id', $ids);
                    $this->db->update('request', $requestData);
                    $this->session->set_userdata('add', 'Your submited tracking ids are succesfully in house.');
                    redirect('merchant/requestlist/' . $statusId);
                else:
                    $this->session->set_userdata('notadd', 'Sorry ! You Dont select any tracking number.');
                    redirect('merchant/requestlist/' . $statusId);
                endif;

            elseif ($action == 4):
                $statusId = 4;
                if (!empty($ids)):
                    $requestData = array(
                        'final_status' => 6,
                        'delivery_man' => $this->input->post('delivery_man'),
                        'outfordeliverydate' => date('Y-m-d')
                    );
                    $this->db->where('final_status', $statusId);
                    $this->db->where_in('id', $ids);
                    $this->db->update('request', $requestData);

                    foreach ($ids as $id):
                        $priceqr = $this->db->query("SELECT netprice,delivery_cost FROM request WHERE id=$id")->row();
                        $price = $priceqr->netprice;
                        $accountsData = array(
                            'request_id' => $id,
                            'netprice' => $price,
                            'delivery_cost' => $priceqr->delivery_cost,
                            'paid_marchent_date' => '0000-00-00',
                            'coll_frmd_date' => '0000-00-00'
                        );
                        $this->db->insert('accounts', $accountsData);

                    endforeach;
                    $this->session->set_userdata('add', 'Your submited tracking ids are out for delivery.');
                    redirect('merchant/requestlist/' . $statusId);
                else:
                    $this->session->set_userdata('notadd', 'Sorry ! You Dont select any tracking number.');
                    redirect('merchant/requestlist/' . $statusId);
                endif;

            elseif ($action == 5):
                $statusId = 6;
                if (!empty($ids)):
                    $requestData = array(
                        'final_status' => 5,
                        'collect_frmod' => $this->input->post('delivery_Charge') ? $this->input->post('delivery_Charge') : 0,
                        'deliverydate' => date('Y-m-d')
                    );
                    $this->db->where('final_status', $statusId);
                    $this->db->where_in('id', $ids);
                    $this->db->update('request', $requestData);
                    $accountsData = array(
                        'paid_marchent_date' => '0000-00-00',
                        'coll_frmd_date' => '0000-00-00',
                        'collect_frmod' => $this->input->post('delivery_Charge') ? $this->input->post('delivery_Charge') : 0
                    );
                    $this->db->where_in('request_id', $ids);
                    $this->db->update('accounts', $accountsData);

                    $this->session->set_userdata('add', 'Your submited tracking ids are delivered.');
                    redirect('merchant/requestlist/' . $statusId);
                else:
                    $this->session->set_userdata('notadd', 'Sorry ! You Dont select any tracking number.');
                    redirect('merchant/requestlist/' . $statusId);
                endif;
            elseif ($action == 7):
                $statusId = 6;
                if (!empty($ids)):
                    $requestData = array(
                        'final_status' => 7
                    );
                    $this->db->where('final_status', $statusId);
                    $this->db->where_in('id', $ids);
                    $this->db->update('request', $requestData);

                    $this->session->set_userdata('add', 'Your submited tracking ids are canceled by Customer.');
                    redirect('merchant/requestlist/' . $statusId);
                else:
                    $this->session->set_userdata('notadd', 'Sorry ! You Dont select any tracking number.');
                    redirect('merchant/requestlist/' . $statusId);
                endif;
            endif;
        else :
            redirect('auth');
        endif;
    }

    function update_cancel() {
        $id = $this->input->get('id');
        $notes = $this->input->get('notes');
        $charge = $this->input->get('collect_frmod');
        $Datanotes = [
            'final_status' => 7,
            'cancel_notes' => $notes
        ];
        $this->db->where('id', $id);
        $this->db->Update('request', $Datanotes);
        $Datanotes2 = [
            'collect_frmod' => $charge
        ];
        $this->db->where('request_id', $id);
        $this->db->Update('accounts', $Datanotes2);
    }

    function update_delay() {
        $id = $this->input->get('id');
        $notes = $this->input->get('notes');
        $Datanotes = [
            'final_status' => 4,
            'delivery_man' => '',
            'delay_notes' => $notes
        ];
        $this->db->where('id', $id);
        $this->db->Update('request', $Datanotes);
        $this->db->where('request_id', $id);
        $this->db->delete('accounts');
    }

    public function complainList() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :
            $data['base_url'] = $this->config->item('base_url');
            $data['title'] = 'Complain List';

            $role = $this->session->userdata('user_role');
            if ($role == 2):
                $data['active_menu'] = 'merchant';
                $data['sub_menu'] = 'complain';
            else:
                $data['active_menu'] = 'complainlist';
                $data['sub_menu'] = '';
            endif;
            $pin = $this->session->userdata('user_pin');
            if ($role == 1 || $role == 3):
                $complainQr = $this->db->query("SELECT complain.*,users.name FROM complain JOIN users ON users.user_pin=complain.created_by");
                $data['complains'] = $complainQr->result();
            else:
                $complainQr = $this->db->query("SELECT complain.*,users.name FROM complain JOIN users ON users.user_pin=complain.created_by WHERE complain.created_by='$pin' ");
                $data['complains'] = $complainQr->result();
            endif;
            $data['role'] = $role;
            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('merchant/complainview', $data);
            $this->load->view('common/footer', $data);
        else :
            redirect('auth');
        endif;
    }

    public function complain_view() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :
            $data['base_url'] = $this->config->item('base_url');
            $data['title'] = 'Complain View';
            $data['active_menu'] = 'merchant';
            $data['sub_menu'] = 'complain';
            $id = $this->input->get('id');
            $complainQr = $this->db->query("SELECT complain.*,users.name FROM complain JOIN users ON users.user_pin=complain.created_by WHERE complain.id='$id'");
            $data['complains_view'] = $complainQr->row();

            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('merchant/complain_view', $data);
            $this->load->view('common/footer', $data);
        else :
            redirect('auth');
        endif;
    }

    public function complainCreate() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :
            $data['base_url'] = $this->config->item('base_url');
            $data['title'] = 'Complain Create';
            $data['active_menu'] = 'merchant';
            $data['sub_menu'] = 'complain';

            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('merchant/complain', $data);
            $this->load->view('common/footer', $data);
        else :
            redirect('auth');
        endif;
    }

    public function addcomplain() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :
            $post['complain_title'] = $this->input->post('complain_title');
            $post['complain_details'] = $this->input->post('complain_details');
            $post['created_by'] = $this->session->userdata("user_pin");
            $post['created_date'] = date('Y-m-d H:i:s');

            $status = $this->common->add('complain', $post);
            if ($status):
                $this->session->set_userdata('add', 'Complain add Successfully');
            else:
                $this->session->set_userdata('notadd', 'Failed to add complain');
            endif;
            redirect('merchant/complainlist');
        else :
            redirect('auth');
        endif;
    }

    public function requestlist($status = false) {
        if (!in_array($this->session->userdata('user_role'), [1, 2, 3])) {
            redirect('auth');
        }

        $data['base_url'] = $this->config->item('base_url');
        $data['title'] = 'All Request List' . '<br>' . 'Parcel Xpress BD.' . '<br>' . 'Date:' . date('d-m-Y');
        $role = $this->session->userdata('user_role');
        $data['role'] = $role;

        $data['active_menu'] = $role == 2 ? 'merchant' : 'requestlist';
        $data['sub_menu'] = $role == 2 ? 'request' : '';
        $data['status'] = $status;
        $deliverymanqr = $this->db->query("SELECT * FROM staffs WHERE category=3 order by name asc");
        $data['deliveryman'] = $deliverymanqr->result();

        $userId = $this->session->userdata("user_id");

        $this->db
                ->select('request.*')
                ->select('users.name')
                ->select('users.company_name')
                ->select('users.phone')
                ->select('zone.zone_name')
                ->select('status.status_name')
                ->select('status.color')
                ->from('request')
                ->join('zone', 'zone.id = request.zoneid')
                ->join('users', 'users.id = request.request_by')
                ->join('status', 'status.id = request.final_status')
                ->where('request.final_status <>', 3);


        if ($role == 2) {
            $this->db
                    ->where('request.request_by', $userId);
        }

        if ($status) {
            $this->db
                    ->where('request.final_status', $status);
        }

        $data['requestinfo'] = $this->db
                ->order_by('status.ordr_by', 'asc')
                ->get()
                ->result();


        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('merchant/request_list', $data);
        $this->load->view('common/footer', $data);
    }

    public function makerequest() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :
            $data['base_url'] = $this->config->item('base_url');
            $data['title'] = 'Make Request';
            $data['active_menu'] = 'new';
            $data['sub_menu'] = '';
            $data['zones'] = $this->common->viewAll('zone');
            $data['district'] = $this->common->viewAll('district_govt');
            $data['weight'] = $this->common->viewAll('weight_info');
            $userid = $this->session->userdata('user_id');
            $data['priceplan'] = $this->db->query("SELECT price_plan FROM users WHERE id='$userid'")->row()->price_plan;

            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('merchant/request', $data);
            $this->load->view('common/footer', $data);
        else :
            redirect('auth');
        endif;
    }

    public function editrequest($id, $status = false) {
        if (!in_array($this->session->userdata('user_role'), array(1, 2, 3))) {
            redirect('auth');
        }

        $data['base_url'] = $this->config->item('base_url');
        $data['title'] = 'Edit Request';
        $role = $this->session->userdata('user_role');
        $data['role'] = $role;
        $data['status'] = $status;
        $deliverymanqr = $this->db->query("SELECT * FROM staffs WHERE category=3");
        $data['deliveryman'] = $deliverymanqr->result();
        if ($role == 2):
            $data['active_menu'] = 'merchant';
            $data['sub_menu'] = 'request';
        else:
            $data['active_menu'] = 'requestlist';
            $data['sub_menu'] = '';
        endif;

        $allinfoqr = $this->db->query("SELECT * FROM request WHERE id='$id'");
        $data['allinfo'] = $allinfoqr->row();
        $data['zones'] = $this->common->viewAll('zone');
        $data['district'] = $this->common->viewAll('district_govt');
        $data['weight'] = $this->common->viewAll('weight_info');

        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('merchant/editrequest', $data);
        $this->load->view('common/footer', $data);
    }

    public function print_challan() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :
            $data['base_url'] = $this->config->item('base_url');
            $data['title'] = 'Challan Copy';
            $data['role'] = $this->session->userdata('user_role');
            $data['active_menu'] = 'requestlist';
            $data['sub_menu'] = '';
            $id = $this->input->get('id');

            $allinfoqr = $this->db->query("SELECT request.*,users.company_name FROM request JOIN users On users.id=request.request_by  WHERE request.id='$id'");
            $data['allinfo'] = $allinfoqr->row();
            $data['zones'] = $this->common->viewAll('zone');
            $data['district'] = $this->common->viewAll('district_govt');
            $data['weight'] = $this->common->viewAll('weight_info');

            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('merchant/view_challan', $data);
            $this->load->view('common/footer', $data);
        else :
            redirect('auth');
        endif;
    }

    public function request_save_multiple() {
        if (in_array($this->session->userdata('user_role'), array(2))) :
            $created_by = $this->session->userdata("user_id");
            $settings_query = $this->db->query("SELECT price_plan,weight_plan,price_plan.price AS pprice,weight_plan.price AS wprice FROM users JOIN price_plan ON price_plan.id=users.price_plan JOIN weight_plan ON weight_plan.id=users.weight_plan where users.id='$created_by' ")->row();
            $deliverycost = $settings_query->pprice;
            $maxidqr = $this->db->query("SELECT MAX(id) AS MAX FROM request ");
            $max = $maxidqr->row()->MAX;

            if (!empty($max)):
                $trackid = $max + 1000;
            else:
                $trackid = 1000;
            endif;
            $zones = $this->input->post('zoneid');
            foreach ($zones as $i => $zone):
                $trackid++;
                $trackingId = 'pxBD' . $trackid;
                $requestData = [
                    'tracking_id' => $trackingId,
                    'zoneid' => $zone,
                    'd_address' => $this->input->post('address')[$i],
                    'customer_name' => $this->input->post('customer_name')[$i],
                    'customer_phone' => $this->input->post('customer_phone')[$i],
                    'order_no' => $this->input->post('order_no')[$i],
                    'netprice' => $this->input->post('netprice')[$i] ? $this->input->post('netprice')[$i] : 0.00,
                    'product_price' => $this->input->post('netprice')[$i] ? $this->input->post('netprice')[$i] : 0.00,
                    'delivery_cost' => $deliverycost,
                    'quantity' => 1,
                    'request_by' => $created_by,
                    'final_status' => 1
                ];

                $status = $this->db
                        ->insert('request', $requestData);
            endforeach;
            if ($status) {
                /**
                 * Email
                 */
                $this->load->library('email');

                $subject = 'New Parcel Request: Multiple Requests';
                $message = "<p>Some parcel requests has come. Please check your dashboard.</p><br /><br />Thank You.";

// Get full html:
                $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
    <title>' . html_escape($subject) . '</title>
    <style type="text/css">
        body {
            font-family: Arial, Verdana, Helvetica, sans-serif;
            font-size: 16px;
        }
    </style>
</head>
<body>
' . $message . '
</body>
</html>';

                $result = $this->email
                        ->to('info@parcelxpressbd.com')
                        ->subject($subject)
                        ->message($body)
                        ->send();

                $this->session->set_userdata('add', 'Your Delivery Request is added Successfully');
            } else {
                $this->session->set_userdata('notadd', 'Your Delivery Request is failed');
            }

            redirect('merchant/requestlist');
        else :
            redirect('auth');
        endif;
    }

    public function request_save() {
        if (in_array($this->session->userdata('user_role'), array(2))) :
            $created_by = $this->session->userdata("user_id");
            $pweight = $this->input->post('weight');
            $settings_query = $this->db->query("SELECT price_plan,weight_plan,price_plan.price AS pprice,weight_plan.price AS wprice FROM users JOIN price_plan ON price_plan.id=users.price_plan JOIN weight_plan ON weight_plan.id=users.weight_plan where users.id='$created_by' ")->row();
            if ($pweight == 1 || $pweight == 2):
                $deliverycost = $settings_query->pprice;
            elseif ($pweight == 3):
                $deliverycost = $settings_query->pprice + $settings_query->wprice;
            elseif ($pweight == 4):
                $deliverycost = $settings_query->pprice + ($settings_query->wprice * 2);
            elseif ($pweight == 5):
                $deliverycost = $settings_query->pprice + ($settings_query->wprice * 3);
            elseif ($pweight == 6):
                $deliverycost = $settings_query->pprice + ($settings_query->wprice * 4);
            endif;

            $maxidqr = $this->db->query("SELECT MAX(id) AS MAX FROM request ");
            $max = $maxidqr->row()->MAX;

            if (!empty($max)):
                $trackid = $max + 1001;
            else:
                $trackid = 1001;
            endif;
            $target_dir = "uploads/product/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $imgFile = $_FILES['fileToUpload']['name'];


            if (empty($imgFile)) :
                $image_path = 'nofile.jpg';
            else:
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) :
                    $image_path = basename($_FILES["fileToUpload"]["name"]);
                else:
                    $data['error'] = "Sorry, there was an error uploading your file";
                endif;
            endif;

            $trackingId = 'pxBD' . $trackid;

            $requestData = [
                'tracking_id' => $trackingId,
                'order_no' => $this->input->post('order_no'),
                'zoneid' => $this->input->post('zoneid'),
                'areaid' => $this->input->post('areaid'),
                'districtid' => $this->input->post('districtid') ? $this->input->post('districtid') : 0,
                'd_address' => $this->input->post('address'),
                'customer_name' => $this->input->post('customer_name'),
                'customer_phone' => $this->input->post('customer_phone'),
                'p_weight' => $pweight,
                'delivery_cost' => $deliverycost,
                'product_price' => $this->input->post('p_price'),
                'quantity' => $this->input->post('quantity'),
                'netprice' => $this->input->post('total_price'),
                'p_img_path' => $image_path,
                'delivery_type' => $this->input->post('delivery_type'),
                'note' => $this->input->post('details'),
                'request_by' => $created_by,
                'final_status' => 1
            ];
            $status = $this->db
                    ->insert('request', $requestData);

            if ($status) {
                /**
                 * Email
                 */
                $this->load->library('email');

                $subject = 'New Parcel Request: ' . $trackingId;
                $message = "<p>A new parcel request has come (Tracking ID: ' . $trackingId . '). Please check your dashboard.</p><br /><br />Thank You.";

// Get full html:
                $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
    <title>' . html_escape($subject) . '</title>
    <style type="text/css">
        body {
            font-family: Arial, Verdana, Helvetica, sans-serif;
            font-size: 16px;
        }
    </style>
</head>
<body>
' . $message . '
</body>
</html>';

                $result = $this->email
                        ->to('info@parcelxpressbd.com')
                        ->subject($subject)
                        ->message($body)
                        ->send();

                $this->session->set_userdata('add', 'Your Delivery Request is added Successfully');
            } else {
                $this->session->set_userdata('notadd', 'Your Delivery Request is failed');
            }

            redirect('merchant/requestlist');
        else :
            redirect('auth');
        endif;
    }

    public function request_update($statusId = false) {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :
            $id = $this->input->post('id');
            if (!in_array($this->session->userdata('user_role'), array(1, 3))) :
                $target_dir = "uploads/product/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $imgFile = $_FILES['fileToUpload']['name'];
                if (!empty($imgFile)):
                    if (empty($imgFile)) :
                        $image_path = 'nofile.jpg';
                    else:
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) :
                            $image_path = basename($_FILES["fileToUpload"]["name"]);
                        else:
                            $data['error'] = "Sorry, there was an error uploading your file";
                        endif;
                    endif;

                    $requestData = array(
                        'zoneid' => $this->input->post('zoneid'),
                        'areaid' => $this->input->post('areaid'),
                        'districtid' => $this->input->post('districtid'),
                        'd_address' => $this->input->post('address'),
                        'customer_name' => $this->input->post('customer_name'),
                        'customer_phone' => $this->input->post('customer_phone'),
                        'p_weight' => $this->input->post('weight'),
                        'product_price' => $this->input->post('p_price'),
                        'quantity' => $this->input->post('quantity'),
                        'netprice' => $this->input->post('total_price'),
                        'p_img_path' => $image_path,
                        'delivery_type' => $this->input->post('delivery_type'),
                        'note' => $this->input->post('details')
                    );
                else:
                    $requestData = array(
                        'zoneid' => $this->input->post('zoneid'),
                        'areaid' => $this->input->post('areaid') ? $this->input->post('areaid') : 0,
                        'districtid' => $this->input->post('districtid') ? $this->input->post('districtid') : 0,
                        'd_address' => $this->input->post('address'),
                        'customer_name' => $this->input->post('customer_name'),
                        'customer_phone' => $this->input->post('customer_phone'),
                        'p_weight' => $this->input->post('weight'),
                        'product_price' => $this->input->post('p_price'),
                        'quantity' => $this->input->post('quantity'),
                        'netprice' => $this->input->post('total_price'),
                        'delivery_type' => $this->input->post('delivery_type'),
                        'note' => $this->input->post('details')
                    );
                endif;
            else:
                $status = $this->input->post('final_status');
                $allinfoqr = $this->db->query("SELECT * FROM request WHERE id='$id'");
                $netprice = $allinfoqr->row()->netprice;

                if ($status == 2 || $status == 3):
                    $requestData = array(
                        'final_status' => $status,
                        'inprogress_date' => date('Y-m-d')
                    );
                elseif ($status == 4):
                    $requestData = array(
                        'final_status' => $status,
                        'product_receive' => $this->input->post('product_receive'),
                        'inhousedate' => date('Y-m-d')
                    );
                elseif ($status == 7):
                    $requestData = array(
                        'final_status' => $status
                    );
                elseif ($status == 8):
                    $requestData = array(
                        'product_returned' => 1,
                        'returned_date' => date('Y-m-d')
                    );

                elseif ($status == 6):
                    $requestData = array(
                        'final_status' => $status,
                        'delivery_man' => $this->input->post('delivery_man'),
                        'outfordeliverydate' => date('Y-m-d')
                    );
                    $accountsData = array(
                        'request_id' => $id,
                        'netprice' => $netprice,
                        'delivery_cost' => $this->input->post('delivery_cost'),
                        'paid_marchent_date' => '0000-00-00',
                        'coll_frmd_date' => '0000-00-00'
                    );
                    $this->db->insert('accounts', $accountsData);
                elseif ($status == 5):
                    $requestData = array(
                        'final_status' => $status,
                        'collect_frmod' => $this->input->post('delivery_Charge') ? $this->input->post('delivery_Charge') : 0,
                        'deliverydate' => date('Y-m-d')
                    );
                    $accountsData = array(
                        'paid_marchent_date' => '0000-00-00',
                        'coll_frmd_date' => '0000-00-00',
                        'collect_frmod' => $this->input->post('delivery_Charge') ? $this->input->post('delivery_Charge') : 0
                    );
                    $this->db->where('request_id', $id);
                    $this->db->update('accounts', $accountsData);
                endif;
            endif;
            $this->db->where('id', $id);
            $status_update = $this->db->update('request', $requestData);
            if ($status == 5):
                /**
                 * Send Email
                 */
                require APPPATH . 'third_party/sendgrid-php-7.2.1/vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases
                $email = new \SendGrid\Mail\Mail();
                $email->setFrom("salehoyon@hotmail.com", "Saleh Ahmad");
                $email->setSubject("Parcel Delivered");
                $email->addTo("nissongo102@gmail.com", "ESaleh Ahmad\"");
                $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
                $email->addContent(
                        "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
                );
                $sendgrid = new \SendGrid(getenv('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'));
                try {
                    $response = $sendgrid->send($email);
                } catch (Exception $e) {
                    echo 'Caught exception: ' . $e->getMessage() . "\n";
                }
            endif;
            if ($status_update):
//email
                $this->session->set_userdata('add', 'Delivery Request is Updated Successfully');
            else:
                $this->session->set_userdata('notadd', 'Delivery Request is Update failed');
            endif;
            redirect('merchant/requestlist/' . $statusId);
        else :
            redirect('auth');
        endif;
    }

    function file_upload() {

        $created_by = $this->session->userdata("user_id");
        $settings_query = $this->db->query("SELECT price_plan,weight_plan,price_plan.price AS pprice,weight_plan.price AS wprice FROM users JOIN price_plan ON price_plan.id=users.price_plan JOIN weight_plan ON weight_plan.id=users.weight_plan where users.id='$created_by' ")->row();
        $deliverycost = $settings_query->pprice;
        $maxidqr = $this->db->query("SELECT MAX(id) AS MAX FROM request ");
        $max = $maxidqr->row()->MAX;

        if (!empty($max)):
            $trackid = $max + 1000;
        else:
            $trackid = 1000;
        endif;

        $inputFileName = $_FILES['data_import']['name'];
        $temp_name = $_FILES["data_import"]["tmp_name"];
        $inputFileType = pathinfo($inputFileName, PATHINFO_EXTENSION);
        $target_dir = "uploads/excel_file/" . $inputFileName;
        $file_found = 0;


        $actual_name = pathinfo($inputFileName, PATHINFO_FILENAME);
        $original_name = $actual_name;
        $extension = pathinfo($inputFileName, PATHINFO_EXTENSION);
        $i = 1;
        while (file_exists('uploads/excel_file/' . $actual_name . "." . $extension)) {
            $actual_name = (string) $original_name . '_' . $i;
            $inputFileName = $actual_name . "." . $extension;
            $i++;
        }

        $target_dir = "uploads/excel_file/" . $inputFileName;

        if ($inputFileType == 'xlsx' || $inputFileType == 'xls' || $inputFileType == 'csv'):
            move_uploaded_file($temp_name, $target_dir);
            try {
                $inputFileType = PHPExcel_IOFactory::identify($target_dir);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($target_dir);
                $file_found = 1;
            } catch (Exception $e) {
                $logdetails = " Error loading file";
                savelogdata("Error loading", $logdetails);
                $this->session->set_userdata('failed', 'Error loading file ' . $e->getMessage());
                redirect('merchant/requestlist');
            }
            if ($file_found == 1):

                $worksheetList = $objReader->listWorksheetNames($target_dir);
                if (sizeof($worksheetList)):
                    for ($shitno = 0; $shitno < sizeof($worksheetList); $shitno++):
                        $shitname = $worksheetList[$shitno];
                        $sheet = $objPHPExcel->getSheet($shitno);
                        $highestRow = $sheet->getHighestRow();
                        //echo $highestRow . " == ";
                        $highestColumn = $sheet->getHighestColumn();


                        for ($row = 2; $row <= $highestRow; $row++):
                            if ($highestColumn == 'F'):
                                $trackid++;
                                $trackingId = 'pxBD' . $trackid;
                                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                                if ($sheet->getRowDimension($row)->getVisible()):
                                    $note = $rowData[0][0];

                                    if ($note != ""):
                                        $requestData[] = array(
                                            'tracking_id' => $trackingId,
                                            'note' => $note,
                                            'customer_name' => $rowData[0][1],
                                            'd_address' => $rowData[0][2],
                                            'customer_phone' => $rowData[0][3],
                                            'product_price' => $rowData[0][4],
                                            'netprice' => $rowData[0][4],
                                            'order_no' => $rowData[0][5],
                                            'quantity' => 1,
                                            'delivery_cost' => $deliverycost,
                                            'final_status' => 1,
                                            'zoneid' => 11,
                                            'request_by' => $created_by,
                                            'upload_file' => $inputFileName
                                        );
                                    endif;
                                endif;
                            else:
                                $this->session->set_userdata('failed', 'Sorry Your Excel Format is not Correct.');
                                redirect('merchant/requestlist');
                            endif;
                        endfor;


                    endfor;
                    $status = $this->db->insert_batch('request', $requestData);

                    if ($status) {
                        /**
                         * Email
                         */
                        $this->load->library('email');

                        $subject = 'New Parcel Request: Multiple Requests By Excel upload';
                        $message = "<p>Some parcel requests has come. Please check your dashboard.</p><br /><br />Thank You.";

// Get full html:
                        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
    <title>' . html_escape($subject) . '</title>
    <style type="text/css">
                            body {
                            font-family: Arial, Verdana, Helvetica, sans-serif;
            font-size: 16px;
        }
    </style>
</head>
<body>
                        ' . $message . '
</body>
</html>';

                        $result = $this->email
                                ->to('info@parcelxpressbd.com')
                                ->subject($subject)
                                ->message($body)
                                ->send();
                    }
                endif;

            else:
                $logdetails = " Problem of reading excel data";
                savelogdata("Error reading", $logdetails);
                $this->session->set_userdata('failed', 'There is a problem of reading excel data. Try again!');
                redirect('merchant/requestlist');
            endif;
        else:
            $logdetails = " This type of file is not acceptable to import";
            savelogdata("Data imported", $logdetails);
            $this->session->set_userdata('failed', 'data uploaded fail .');
            redirect('merchant/requestlist');
        endif;

        if ($status):
            $this->session->set_userdata('successfull', 'Upload Request Successfully');
        else:
            $this->session->set_userdata('failed', 'Upload Request Failed.');
        endif;
        redirect('merchant/requestlist');
    }

}
