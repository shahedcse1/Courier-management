<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('user_role') != NULL && $this->session->userdata('user_pin') != NULL) {
            redirect('dashboard');
        } else {
            $data['title'] = 'User Login';

            /** Rendering Views */
            $this->load->view('login', $data);
        }
    }

}
