<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    /**
     * Dashboard constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('common');
    }

    /**
     * Dashboard works
     */
    public function index() {
        if (!in_array($this->session->userdata('user_role'), [1, 2, 3])) {
            redirect('auth');
        }

        $data['base_url'] = $this->config->item('base_url');
        $data['title'] = 'Dashboard';
        $data['active_menu'] = 'dashboard';
        $data['sub_menu'] = '';
        $data['roleId'] = $this->session->userdata('user_role');
        $user_role = $data['roleId'];
        $user_pin = $this->session->userdata('user_pin');
        $data['user_name'] = $this->db->query("SELECT  name from users where user_pin='$user_pin'")->row()->name;
        $today = date('Y-m-d');
        $user_id = $this->session->userdata("user_id");

        if ($user_role == 2):
            $data['newvouchar'] = $this->db->query("SELECT COUNT(id) AS new FROM vouchar where seenby_merchant='0' AND paid_to='$user_id'")->row()->new;
        endif;

        /**
         * Pending Parcels
         */
        $data['pending'] = $this->common->countParcel(1)->total;
        $data['todayPending'] = $this->common->countParcel(1, $today)->total;

        /**
         * In Progress Parcels
         */
        $data['inProgress'] = $this->common->countParcel(2)->total;
        $data['todayInProgress'] = $this->common->countParcel(2, $today)->total;

        /**
         * In House Parcels
         */
        $data['inHouse'] = $this->common->countParcel(4)->total;
        $data['todayInHouse'] = $this->common->countParcel(4, $today)->total;

        /**
         * Delivered Parcels
         */
        $data['delivered'] = $this->common->countParcel(5)->total;
        $data['todayDelivered'] = $this->common->countParcel(5, $today)->total;
        /**
         * Out for Delivered Parcels
         */
        $data['outfordelivery'] = $this->common->countParcel(6)->total;
        $data['todayoutfordelivery'] = $this->common->countParcel(6, $today)->total;


        $data['customercanceled'] = $this->common->countParcel(7)->total;
        $data['todaycustomercanceled'] = $this->common->countParcel(7, $today)->total;
        /**
         * Today's total Parcels
         */
        $data['totalParcelToday'] = $this->common->countParcel(false, $today)->total;

        /**
         * Month wise parcels
         */
        if ($user_role == 2):
            $extra = "AND request_by=$user_id";
        else:
            $extra = '';
        endif;

        $monthfromdate = date('Y-m', strtotime(date('Y-m') . " -11 month"));
        $data['totaldata'] = $data['period'] = [];

        for ($m = 0; $m <= 11; $m++) {
            $subval = '+' . $m . 'month';

            $data_month_query = date('Y-m', strtotime($monthfromdate . " $subval"));
            $data_month_show = date('M-y', strtotime($monthfromdate . " $subval"));

            $totalParcels = $this->db
                            ->select('COUNT(1) as total')
                            ->from('request')
                            ->where('final_status', 5)
                            ->where("DATE_FORMAT(createddate, '%Y-%m') = '$data_month_query' $extra")
                            ->get()
                            ->row()->total;

            array_push($data['totaldata'], $totalParcels);
            array_push($data['period'], "$data_month_show");
        }

        /**
         * Calculate percentage for the pie chart
         */
        $data['todayPendingInPercent'] = $data['todayInProgressInPercent'] = $data['todayInHouseInPercent'] = $data['todayDeliveredInPercent'] = $data['todayoutfordeliverypercent'] = 0;

        if ($data['totalParcelToday'] != 0) {
            $data['todayPendingInPercent'] = (double) ($data['todayPending'] / $data['totalParcelToday']) * 100;
            $data['todayInProgressInPercent'] = (double) ($data['todayInProgress'] / $data['totalParcelToday']) * 100;
            $data['todayInHouseInPercent'] = (double) ($data['todayInHouse'] / $data['totalParcelToday']) * 100;
            $data['todayoutfordeliverypercent'] = (double) ($data['todayoutfordelivery'] / $data['totalParcelToday']) * 100;
            $data['todayDeliveredInPercent'] = (double) ($data['todayDelivered'] / $data['totalParcelToday']) * 100;
        }

        /**
         * View Files
         */
        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('dashboard/dashboard', $data);
        $this->load->view('common/footer', $data);
    }

}
