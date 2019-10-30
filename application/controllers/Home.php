<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    /**
     * Home constructor.
     */
    public function __construct($config = 'rest') {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        parent::__construct();
    }

    public function index() {
        $data['base_url'] = $this->config->item('base_url');
        $data['adminbbase_url'] = $this->config->item('base_url_admin') . 'auth' . '/' . 'login ';
        $data['page_title'] = "parcel xpress BD ";

        $this->load->view('web/Header', $data);
        $this->load->view('web/Home', $data);
        $this->load->view('web/Footer', $data);
    }

    public function get_cost() {
        $location_to = $this->input->get("location_to");
        $weight = $this->input->get("weight");
        if (!empty($location_to) && !empty($weight)):
            $costqr = $this->db->query("SELECT cost from cost_total where locationto_id='$location_to' AND weight_id='$weight' AND location_from='Dhaka'");
            $cost = $costqr->row()->cost;
            echo $cost;
        else:
            echo 'N/A';
        endif;
    }

    public function register() {
        $data['page_title'] = "Register Now";
        $data['name'] = $this->input->post('name');
        $data['phone'] = $this->input->post('user_phone');
        $data['email'] = $this->input->post('user_email');

        /** Assets */
        add_assets('js', [
            'register.js'
        ]);

        $this->load->view('web/Header', $data);
        $this->load->view('web/register', $data);
        $this->load->view('web/Footer', $data);
    }

    public function registerMerchant() {
        $name = $this->input->post('name');

        if (!$name) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Please provide your name.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        if (strlen($name) > 256) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Your provided name is too long.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        $companyName = $this->input->post('company_name');

        if (!$companyName) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Please provide your company name.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        if (strlen($companyName) > 256) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Your provided company name is too long.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        $phone = $this->input->post('user_phone');
        $phonelength=strlen($phone);
          if ($phonelength != 11) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Please provide your eleven digit number.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        if (!$phone) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Please provide your contact number.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        $email = $this->input->post('user_email');

        if (!$email) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Please provide your email address.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Please provide your email properly.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        $checkEmail = $this->db
                        ->select('COUNT(1) as total')
                        ->from('users')
                        ->where('email', $email)
                        ->get()
                        ->row()
                ->total;

        if ($checkEmail) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Your provided email has already registered. Please provide another email.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        $address = $this->input->post('address');

        if (!$address) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Please provide your company address.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        $pin = $this->input->post('user_pin');

        if (!$pin) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Please provide an unique pin.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        $checkPin = $this->db
                        ->select('COUNT(1) as total')
                        ->from('users')
                        ->where('user_pin', $pin)
                        ->get()
                        ->row()
                ->total;

        if ($checkPin) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Your provided pin has already registered. Please try with another pin.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        $password = $this->input->post('password');

        if (!$password) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Please provide a strong password.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

//        $isChar = preg_match('/[a-zA-Z]+/', $password);
//        $isNum  = preg_match('/\d+/', $password);
//        $len    = strlen($password) > 5;
//
//        if (!($isChar && $isNum && $len)) {
//            $response = [
//                'success' => false,
//                'error'   => true,
//                'message' => 'Password must contain minimum 6 characters with at-least one letter and one number.'
//            ];
//
//            echo json_encode($response, JSON_PRETTY_PRINT);
//            return;
//        }

        $random_salt = bin2hex(openssl_random_pseudo_bytes(16));
        $prependwithpass = $random_salt . $password;
        $passwordorg = hash('sha256', $prependwithpass);

        $userData = [
            'name' => $name,
            'company_name' => $companyName,
            'user_pin' => $pin,
            'random_salt' => $random_salt,
            'password' => $passwordorg,
            'phone' => $phone,
            'email' => $email,
            'payment_type' => $this->input->post('payment_type'),
            'account_no' => $this->input->post('account_no'),
            'address' => $address,
            'status' => 1,
            'role' => 2
        ];

        $saveData = $this->db
                ->insert('users', $userData);

        if (!$saveData) {
            $response = [
                'success' => false,
                'error' => true,
                'message' => 'Your Registration is Failed. Please try again.'
            ];

            echo json_encode($response, JSON_PRETTY_PRINT);
            return;
        }

        $response = [
            'success' => true,
            'error' => false,
            'pin' => $pin,
            'pass' => $password,
            'message' => 'Your Registration completed successfully. Please login to start.'
        ];

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function add_message() {
        $data['adminbbase_url'] = $this->config->item('base_url_admin') . 'auth' . '/' . 'login ';
        $data['base_url'] = $this->config->item('base_url');

        $messageData = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'message' => $this->input->post('message'),
            'created_date' => date("Y-m-d H:i:s")
        ];

        $saveData = $this->db->insert('message_list', $messageData);

        if ($saveData) {
            $this->session->set_userdata('login_error', 'Your message Submitted Succesfully !! Stay Connected With Us.');
        } else {
            $this->session->set_userdata('login_error', 'Your message Submitted  Failed');
        }
        redirect('home/contact');
    }

}
