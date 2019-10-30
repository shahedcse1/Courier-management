<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common');
    }

    function index() {

        if ($this->session->userdata('user_role') != NULL && $this->session->userdata('user_pin') != NULL):
            redirect('dashboard');
        else:
            redirect('login');
        endif;
    }

    function login() {

        $this->form_validation->set_rules('userpin', 'Userpin', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $userpin = $this->input->post('userpin');

        if ($this->form_validation->run() == FALSE):
            $this->session->set_userdata('login_error', 'Please Enter User Name & Password correctly');

            redirect('login');
        else:
            $upass = $this->input->post('password');
            $userstatus = 1;
            $data['name'] = $userpin;
            $queryResult = $this->common->login($data);

            if ($queryResult) :
                $userdbstatus = $queryResult->status;
                $this->session->set_userdata('user_name', $queryResult->name);
                $this->session->set_userdata('image_path', $queryResult->image_path);
                //hash password convert
                $random_salt = $queryResult->random_salt;
                $db_hashpass = $queryResult->password;
                $prependwithpass = $random_salt . $upass;
                $hass_password = hash('sha256', $prependwithpass);
                //

                if ($userdbstatus == $userstatus && $hass_password == $db_hashpass):

                    $this->session->set_userdata('user_id', $queryResult->id);
                    $this->session->set_userdata('user_pin', $userpin);
                    $this->session->set_userdata("user_role", $queryResult->role);

                    redirect('auth');
                else:
                    $this->session->set_userdata('login_error', 'Please Check User Name & Password.');

                    redirect('login');
                endif;
            else:
                $this->session->set_userdata('login_error', 'Not a Valid User Name.');
                redirect('login');
            endif;
        endif;
    }

    function logindirect() {
        $userpin = $this->input->get('userpin');
        $upass = $this->input->get('password');
        $userstatus = 1;
        $data['name'] = $userpin;
        $queryResult = $this->common->login($data);

        if ($queryResult) :
            $userdbstatus = $queryResult->status;
            $this->session->set_userdata('user_name', $queryResult->name);
            $this->session->set_userdata('image_path', $queryResult->image_path);
            //hash password convert
            $random_salt = $queryResult->random_salt;
            $db_hashpass = $queryResult->password;
            $prependwithpass = $random_salt . $upass;
            $hass_password = hash('sha256', $prependwithpass);
            //

            if ($userdbstatus == $userstatus && $hass_password == $db_hashpass):

                $this->session->set_userdata('user_id', $queryResult->id);
                $this->session->set_userdata('user_pin', $userpin);
                $this->session->set_userdata("user_role", $queryResult->role);

                redirect('auth');
            else:
                $this->session->set_userdata('login_error', 'Please Check User Name & Password.');

                redirect('login');
            endif;
        else:
            $this->session->set_userdata('login_error', 'Not a Valid User Name.');
            redirect('login');
        endif;
    }

    function changePassword() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3, 4))) :
            $data['base_url'] = $this->config->item('base_url');
            $data['title'] = 'Change Password';
            $data['active_menu'] = '';
            $data['active_sub_menu'] = '';
            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('User_Information/changePassword');
            $this->load->view('common/footer', $data);
        endif;
    }

    function updatePass() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3, 4))):

            $tablename = 'user';
            $loginname = $this->session->userdata('user_pin');
            $cpassword = $this->input->post('cpassword');
            $npassword = $this->input->post('npassword');

            $queryCheckPwd = $this->user_model->checkPassword($loginname, $tablename, $cpassword);
            if ($queryCheckPwd == TRUE) {
                $random_salt = bin2hex(openssl_random_pseudo_bytes(16));
                $prependwithpass = $random_salt . $npassword;
                $hass_password = hash('sha256', $prependwithpass);
                $userdata = array(
                    'random_salt' => $random_salt,
                    'password' => $hass_password
                );
                $updatestatus = $this->user_model->updateuserinfo($userdata, $loginname, $tablename);
                if ($updatestatus == TRUE) {
                    $this->session->set_userdata('successfull', 'Password updated successfully !!!');
                } else {
                    $this->session->set_userdata('failed', 'Password updated fail. Try again !!!');
                }
                redirect('auth/changepassword');
            } else {
                $this->session->set_userdata('failed', 'Password do not match with your existing password, Please try again !!!');

                redirect('Auth/changePassword');
            }
        else:
            redirect('auth');
        endif;
    }

    function logout() {
        if (($this->session->userdata('user_role') != NULL) && ($this->session->userdata('user_name') != NULL || $this->session->userdata('user_pin') != NULL)):
            // $logdetails = "Logout successfully";
            $this->session->unset_userdata('user_name');
            $this->session->unset_userdata('user_role');
            $this->session->unset_userdata("user_pin");
            $this->session->unset_userdata("image_path");
            $this->session->sess_destroy();
            redirect('auth');
        else:
            redirect('auth');
        endif;
    }

}
