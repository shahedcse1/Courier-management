<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller
{
    /**
     * Contact constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['page_title'] = 'Contact Us';

        add_assets('js', [
            'html-table.js',
            'enrollmentlist.js'
        ]);

        $this->load->view('web/Header', $data);
        $this->load->view('web/Contact', $data);
        $this->load->view('web/Footer', $data);
    }

}
