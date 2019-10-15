<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pricing extends CI_Controller {

    /**
     * Blog constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['page_title'] = "Our pricing";


        $data['delivery_location'] = $this->db
                ->get('delivery_location')
                ->result();

        $data['weight_info'] = $this->db
                ->get('weight_info')
                ->result();


        $this->load->view('web/Header', $data);
        $this->load->view('web/pricing', $data);
        $this->load->view('web/Footer', $data);
    }

}
