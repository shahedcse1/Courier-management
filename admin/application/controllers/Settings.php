<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    /**
     * Accounts constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('common');

        if (!in_array($this->session->userdata('user_role'), [1, 2, 3])) {
            redirect('auth');
        }
    }

    public function zone() {
        $data['title'] = 'Zone Info.';
        $data['active_menu'] = 'settings';
        $data['sub_menu'] = 'zone';
        $data['zoneinfo'] = $this->db
                ->select('*')
                ->from('zone')
                ->get()
                ->result();


        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('settings/zone_list', $data);
        $this->load->view('common/footer', $data);
    }

    public function addzone() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :

            $post['zone_name'] = $this->input->post('zone_name');
            $Staff = $this->common->add('zone', $post);

            if ($Staff):
                $this->session->set_userdata('add', 'New Zone add Successfully');
            else:
                $this->session->set_userdata('notadd', 'Failed to add new Zone');
            endif;
            redirect('settings/zone');
        else :
            redirect('auth');
        endif;
    }

    public function addarea() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :

            $post['zone_id'] = $this->input->post('zone_name');
            $post['area_name'] = $this->input->post('area_name');
            $status = $this->common->add('area', $post);

            if ($status):
                $this->session->set_userdata('add', 'New Area add Successfully');
            else:
                $this->session->set_userdata('notadd', 'Failed to add new Area');
            endif;
            redirect('settings/area');
        else :
            redirect('auth');
        endif;
    }

    public function editzone() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :

            $id = $this->input->post('id');
            $output = $this->common->edit('zone', $id, 'id');

            $data['zone_name'] = $output->zone_name;
            echo json_encode($data);
        else :
            redirect('auth');
        endif;
    }

    public function editarea() {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :

            $id = $this->input->post('id');
            $output = $this->common->edit('area', $id, 'id');

            $data['zone_id'] = $output->zone_id;
            $data['area_name'] = $output->area_name;
            echo json_encode($data);
        else :
            redirect('auth');
        endif;
    }

    public function updatezone() {

        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :

            $id = $this->input->post('id');
            $post['zone_name'] = $this->input->post('zone_name');


            $update = $this->common->update('zone', $id, $post);

            if ($update):
                $this->session->set_userdata('add', 'Zone edit Successfully');
            else:
                $this->session->set_userdata('notadd', 'Failed to edit Zone');
            endif;

            redirect('settings/zone');
        else :
            redirect('auth');
        endif;
    }

    public function updatearea() {

        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :

            $id = $this->input->post('id');
            $post['zone_id'] = $this->input->post('zone_id');
            $post['area_name'] = $this->input->post('area_name');

            $update = $this->common->update('area', $id, $post);

            if ($update):
                $this->session->set_userdata('add', 'Area edit Successfully');
            else:
                $this->session->set_userdata('notadd', 'Failed to edit Area');
            endif;

            redirect('settings/area');
        else :
            redirect('auth');
        endif;
    }

    public function area() {
        $data['title'] = 'Area Info.';
        $data['active_menu'] = 'settings';
        $data['sub_menu'] = 'area';
        $data['areainfo'] = $this->db
                ->select('area.*')
                ->select('zone.zone_name')
                ->from('area')
                ->join('zone', 'zone.id = area.zone_id')
                ->get()
                ->result();

        $data['zoneinfo'] = $this->db
                ->select('zone.*')
                ->from('zone')
                ->get()
                ->result();


        $this->load->view('common/header', $data);
        $this->load->view('common/sidebar', $data);
        $this->load->view('settings/area_list', $data);
        $this->load->view('common/footer', $data);
    }

}
