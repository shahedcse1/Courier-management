<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller
{
    /**
     * Blog constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['page_title'] = "Blog";

        $this->load->view('web/Header', $data);
        $this->load->view('web/Blog', $data);
        $this->load->view('web/Footer', $data);
    }

}
