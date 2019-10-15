<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller
{
    /**
     * About constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['page_title'] = "About Us";

        $this->load->view('web/Header', $data);
        $this->load->view('web/About', $data);
        $this->load->view('web/Footer', $data);
    }

    public function team()
    {
        $data['page_title'] = "Our Team";

        $data['teaminfo'] = $this->db
            ->select('*')
            ->from('staffs')
            ->where_in('category', [1, 2])
            ->get()
            ->result();

        $this->load->view('web/Header', $data);
        $this->load->view('web/Ourteam', $data);
        $this->load->view('web/Footer', $data);
    }

}
