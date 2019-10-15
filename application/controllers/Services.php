<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller
{
    /**
     * Services constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['page_title'] = "Our Services";
        $data['allservices'] = $this->db
            ->get('services')
            ->result();

        $this->load->view('web/Header', $data);
        $this->load->view('web/Our_services', $data);
        $this->load->view('web/Footer', $data);
    }

}
