<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function viewAll($table) {
        $query = $this->db->get($table);
        $this->db->group_by('id');
        return $query->result();
    }

    public function add($table, $data) {
        return $this->db->insert($table, $data);
    }

    public function edit($table, $id, $col) {
        return $this->db->select('*')
                        ->where($col, $id)
                        ->get($table)->row();
    }

    public function fetchResult($table, $id, $col) {
        return $this->db->select('*')
                        ->where($col, $id)
                        ->get($table)->result();
    }

    public function login($uname) {
        $query = "select id, name, random_salt, password, user_pin,role,status,image_path  from users where user_pin = ?";
        $queryResult = $this->db->query($query, $uname);
        if ($queryResult->num_rows() > 0):
            return $queryResult->row();
        endif;
    }

    public function update($table, $id, $update) {
        return $this->db->where('id', $id)
                        ->update($table, $update);
    }

    public function delete($table, $id, $uid) {
        return $this->db
                        ->where($uid, $id)
                        ->delete($table);
    }

    public function userData() {
        $this->db->select("users.*, role_name ,backgorund_color ");
        $this->db->from('users');
        $this->db->join('userrole', 'users.role= userrole.id');
        $this->db->order_by('userrole.role_name');
        $queryStr = $this->db->get()->result();
        return $queryStr;
    }

    public function userData2() {
        $this->db->select("users.*, role_name ");
        $this->db->from('users');
        $this->db->join('userrole', 'users.role= userrole.id');
        $this->db->WHERE('role', '2');
        $this->db->order_by('id', 'DESC');
        $queryStr = $this->db->get()->result();
        return $queryStr;
    }

    /**
     * @param $pin
     * @return bool
     */
    public function checkPin($pin) {
        $total = $this->db
                        ->select('COUNT(1) as total')
                        ->from('users')
                        ->where('user_pin', $pin)
                        ->get()
                        ->row()
                ->total;

        return $total ? false : true;
    }

    public function getPin($id, $pin) {

        return $this->db
                        ->select('id')
                        ->from('users')
                        ->where('user_pin', $pin)
                        ->where('id <>', $id)
                        ->get()
                        ->row();
    }

    public function staffList() {
        $this->db->select("staffs.*, staff_category.staff_category as category ");
        $this->db->from('staffs');
        $this->db->join('staff_category', 'staffs.category = staff_category.id');
        $queryStr = $this->db->get()->result();
        return $queryStr;
    }

    public function profileView($pin) {
        $this->db->select("users.*, role_name ");
        $this->db->from('users');
        $this->db->join('userrole', 'users.role= userrole.id');
        $this->db->where('user_pin', $pin);
        $queryStr = $this->db->get()->row();
        return $queryStr;
    }

    function checkPassword($loginname, $tablename, $cpassword) {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))):
            $this->db->select('random_salt,password');
            $this->db->where('user_pin', $loginname);
            $queryResult = $this->db->get($tablename);
            $queryrow = $queryResult->row();

            $db_hashpass = $queryrow->password;
            $random_salt = $queryrow->random_salt;
            $prependwithpass = $random_salt . $cpassword;
            $hass_password = hash('sha256', $prependwithpass);

            if ($db_hashpass == $hass_password):
                return true;
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }

    function updateInfo($userdata, $loginname, $tablename) {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))):
            $this->db
                    ->select('user_pin')
                    ->from($tablename)
                    ->where('user_pin', $loginname);
            $checkuser = $this->db->get();
            if ($checkuser->num_rows() > 0):
                $this->db
                        ->where('user_pin', $loginname);
                $query = $this->db->update($tablename, $userdata);
                if ($query) {
                    return true;
                } else {
                    return false;
                }
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }

    public function updateImage($pin, $update) {
        return
                        $this->db->where('user_pin', $pin)
                        ->update('users', $update);
    }

    /**
     * @param $status
     * @param bool $today
     *
     * Count Total Parcel
     *
     * @return mixed
     */
    public function countParcel($status = false, $today = false) {
        $this->db
                ->select('COUNT(1) as total')
                ->from('request');

        if ($status) {
            $this->db
                    ->where('final_status', $status);
        }

        if ($this->session->userdata('user_role') == 2) {
            $this->db
                    ->where('request_by', $this->session->userdata('user_id'));
        }

        if ($today) {
            $this->db
                    ->where("DATE_FORMAT(createddate, '%Y-%m-%d') = '$today'");
        }

        return $this->db
                        ->get()
                        ->row();
    }

}
