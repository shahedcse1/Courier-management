<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Messageinfo extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('common');
    }

    public function index() {

        if (in_array($this->session->userdata('user_role'), array(1))) :
            $data['base_url'] = $this->config->item('base_url');
            $data['title'] = 'All Message';
            $data['active_menu'] = 'admin';
            $data['sub_menu'] = 'message';
            $messageQr = $this->db->query("SELECT * FROM message_list");
            $data['message_info'] = $messageQr->result();

            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('admin/message_list', $data);
            $this->load->view('common/footer', $data);
        else :
            redirect('auth');
        endif;
    }

    public function view_message() {

        if (in_array($this->session->userdata('user_role'), array(1))) :
            $data['base_url'] = $this->config->item('base_url');
            $data['title'] = 'Message View';
            $data['active_menu'] = 'admin';
            $data['sub_menu'] = 'message';
            $id = $this->input->get('id');
            $messageQr = $this->db->query("SELECT * FROM message_list WHERE id='$id'");
            $data['message_info'] = $messageQr->row();

            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('admin/message_view', $data);
            $this->load->view('common/footer', $data);
        else :
            redirect('auth');
        endif;
    }

}
