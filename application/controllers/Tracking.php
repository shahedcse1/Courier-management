<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller
{
    /**
     * Tracking constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['page_title'] = "Track Your Product";
        $data['product_id'] = '';

        $this->load->view('web/Header', $data);
        $this->load->view('web/Product_track', $data);
        $this->load->view('web/Footer', $data);
    }

    public function search()
    {
        $data['page_title'] = "product_search";

        $data['product_id'] = $trackid = $this->input->get('tracking_id');
        $data['all_info'] = $this->db
            ->select('request.*')
           // ->select('users.name')
            ->select('zone.zone_name')
            ->select('status.status_name')
            ->select('status.color')
            ->select('weight_info.weight')
            ->from('request')
            ->join('zone', 'zone.id = request.zoneid')
           //  ->join('users', 'users.user_pin = request.request_by')
            ->join('status', 'status.id = request.final_status')
            ->join('weight_info', 'weight_info.id = request.p_weight')
            ->where('request.tracking_id', $trackid)
            ->get()
            ->row();

        $this->load->view('web/Header', $data);
        $this->load->view('web/Product_track', $data);
        $this->load->view('web/Footer', $data);
    }

}
