<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('common');
    }

    public function index() {

        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :
            $data['base_url'] = $this->config->item('base_url');
            $data['title'] = 'My Profile';
            $data['active_menu'] = 'profile';
            $data['sub_menu'] = '';
            $data['role'] = $this->session->userdata('user_role');

            $userpin = $this->session->userdata('user_pin');
            $data['edit'] = $this->common->profileView($userpin);


            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('admin/profile', $data);
            $this->load->view('common/footer', $data);
        else :
            redirect('auth');
        endif;
    }

    public function edit() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :
            $id = $this->input->post('id');
            $post['name'] = $this->input->post('name');
            $post['email'] = $this->input->post('email');
            $post['company_name'] = $this->input->post('company_name');
            $post['user_pin'] = $this->input->post('user_pin');
            $post['phone'] = $this->input->post('phone');
            $post['address'] = $this->input->post('address');
            $post['payment_type'] = $this->input->post('payment_type');
            $post['account_no'] = $this->input->post('account_no');

            $update = $this->common->update('users', $id, $post);
            if ($update):
                $this->session->set_userdata('user_pin', $post['user_pin']);
                $this->session->set_userdata('update', 'Profile update Successfully');
            else:
                $this->session->set_userdata('notupdate', 'Failed to Profile update');
            endif;

            redirect('profile');
        else :
            redirect('auth');
        endif;
    }

    function updatePassword() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))):

            $userpin = $this->session->userdata('user_pin');
            $currentpass = $this->input->post('cpassword');
            $newpass = $this->input->post('npassword');

            $queryCheckPwd = $this->common->checkPassword($userpin, 'users', $currentpass);

            if ($queryCheckPwd == true) {
                $random_salt = bin2hex(openssl_random_pseudo_bytes(16));
                $prependwithpass = $random_salt . $newpass;
                $hass_password = hash('sha256', $prependwithpass);
                $userdata = array(
                    'random_salt' => $random_salt,
                    'password' => $hass_password
                );
                $status = $this->common->updateInfo($userdata, $userpin, 'users');
                if ($status):
                    $this->session->set_userdata('update', 'Password updated successfully !!!');
                else :
                    $this->session->set_userdata('notupdate', 'Password updated fail. Try again !!!');
                endif;
                redirect('profile');
            } else {
                $this->session->set_userdata('notupdate', 'Password do not match with your existing password, Please try again !!!');
                redirect('profile');
            }
        else:
            redirect('auth');
        endif;
    }

    function updateImage() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))):

            $userpin = $this->session->userdata('user_pin');
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $imgFile = $_FILES['fileToUpload']['name'];

            if (empty($imgFile)) :
                $post['image_path'] = 'login.png';
            else:
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) :
                    $post['image_path'] = basename($_FILES["fileToUpload"]["name"]);
                else:
                    $data['error'] = "Sorry, there was an error uploading your file";
                endif;
            endif;

            $status = $this->common->updateImage($userpin, $post);
            if ($status):
                $this->session->set_userdata('update', 'Image Upload Successfully');
            else:
                $this->session->set_userdata('notupdate', 'Failed to Image Upload');
            endif;

            redirect('profile');
        else :
            redirect('auth');
        endif;
    }

}
