<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserInfo extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('common');

        if (!in_array($this->session->userdata('user_role'), [1, 2, 3])) {
            redirect('auth');
        }
    }

    public function index() {
        if (in_array($this->session->userdata('user_role'), array(1))) :
            $data['base_url'] = $this->config->item('base_url');
            $data['title'] = 'userinfo';
            $data['active_menu'] = 'admin';
            $data['sub_menu'] = 'userinfo';
            $data['users'] = $this->common->userData();
            $data['role'] = $this->common->viewAll('userrole');

            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('admin/userinfo', $data);
            $this->load->view('common/footer', $data);
        else :
            redirect('auth');
        endif;
    }

    public function allmerchant() {
        if (in_array($this->session->userdata('user_role'), array(1))) :
            $data['base_url'] = $this->config->item('base_url');
            $data['title'] = 'All Merchant';
            $data['active_menu'] = 'admin';
            $data['sub_menu'] = 'merchant';
            $data['users2'] = $this->common->userData2();
            $data['role'] = $this->common->viewAll('userrole');
            $data['priceplan'] = $this->common->viewAll('price_plan');
            $data['weightplan'] = $this->common->viewAll('weight_plan');

            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('admin/merchant_view', $data);
            $this->load->view('common/footer', $data);
        else :
            redirect('auth');
        endif;
    }

    public function addUser() {
        $post['name'] = $this->input->post('name');
        $post['company_name'] = $this->input->post('company_name');
        $post['email'] = $this->input->post('email');
        $post['user_pin'] = $this->input->post('user_pin');
        $post['phone'] = $this->input->post('phone');
        $post['role'] = $this->input->post('role');
        $post['address'] = $this->input->post('address');
        $post['status'] = $this->input->post('status');

        $password = $this->input->post('password');
        $random_salt = bin2hex(openssl_random_pseudo_bytes(16));
        $prependwithpass = $random_salt . $password;
        $post['password'] = hash('sha256', $prependwithpass);
        $post['random_salt'] = $random_salt;

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imgFile = $_FILES['fileToUpload']['name'];

        if (!empty($imgFile)) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) :
                $post['image_path'] = basename($_FILES["fileToUpload"]["name"]);
            else:
                $data['error'] = "Sorry, there was an error uploading your file";
            endif;
        }

        $status = $this->common->add('users', $post);

        if ($status):
            $this->session->set_userdata('add', 'User add Successfully');
        else:
            $this->session->set_userdata('notadd', 'Failed to add user');
        endif;

        redirect('userinfo');
    }

    public function editUser() {
        $id = $this->input->post('id');
        $output = $this->common->edit('users', $id, 'id');

        $data['name'] = $output->name;
        $data['company_name'] = $output->company_name;
        $data['email'] = $output->email;
        $data['password'] = $output->password;
        $data['phone'] = $output->phone;
        $data['address'] = $output->address;
        $data['role_id'] = $output->role;
        $data['image_path'] = $output->image_path;
        $data['status'] = $output->status;
        $data['user_pin'] = $output->user_pin;
        $data['userrole'] = $this->common->viewAll('userrole');

        echo json_encode($data);
    }

    public function updateUser() {
        $id = $this->input->post('id');
        $post = $this->input->post();
        $user_pin = $this->session->userdata('user_pin');
        $imgFile = $_FILES['fileToUpload']['name'];

        if (!empty($imgFile)) :
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) :
                $post['image_path'] = basename($_FILES["fileToUpload"]["name"]);
            else:
                $data['error'] = "Sorry, there was an error uploading your file";
            endif;
        endif;

        $update = $this->common->update('users', $id, $post);

        if ($update):
            $this->session->set_userdata('edit', 'User Edit Successfully');
        else:
            $this->session->set_userdata('notadd', 'Failed to edit user');
        endif;

        redirect('userinfo');
    }

    public function updatePass() {
        $id = $this->input->post('id');
        $npassword = $this->input->post('npassword');
        $rpassword = $this->input->post('rpassword');

        $random_salt = bin2hex(openssl_random_pseudo_bytes(16));
        $prependwithpass = $random_salt . $npassword;
        $hass_password = hash('sha256', $prependwithpass);
        $userdata = array(
            'random_salt' => $random_salt,
            'password' => $hass_password
        );

        $query = $this->common->update('users', $id, $userdata);
        if ($query = True) :
            $this->session->set_userdata('successfull', 'Password updated successfully !!!');

            redirect('userinfo');
        else:
            $this->session->set_userdata('failed', 'Password updated fail. Try again !!!');
        endif;
    }

    public function deleteUser() {
        $id = $this->input->post('id');
        if ($id) :
            $this->common->delete('users', $id, 'id');
        endif;
    }

    public function checkPin() {
        echo $this->common->checkPin($this->input->get('pin'));
    }

    public function changePin() {
        $pin = $this->input->post('pin');
        $id = $this->input->post('id');
        $getdata = $this->common->getPin($id, $pin);
        $getpin = $getdata ? true : false;
        echo json_encode($getpin);
    }

}
