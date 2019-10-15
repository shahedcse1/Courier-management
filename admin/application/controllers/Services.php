<?php
/**
 * Created by PhpStorm.
 * User: Rezwana
 * Date: 10/24/2018
 * Time: 12:10 PM
 */

class Services extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('common');
    }

    public function index()
    {
        if (in_array($this->session->userdata('user_role'), array(1))) :
            $data['base_url'] = $this->config->item('base_url');
            $data['title'] = 'Service Info';
            $data['active_menu'] = 'admin';
            $data['sub_menu'] = 'services';
            $data['services'] = $this->common->viewAll('services');
            $data['role'] = $this->common->viewAll('userrole');

            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('admin/serviceinfo', $data);
            $this->load->view('common/footer', $data);
        else :
            redirect('auth');
        endif;
    }

    public function addService()
    {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :

            $post['service_name'] =$this->input->post('service_name');
            $post['description'] =$this->input->post('description');
            $post['link'] =$this->input->post('link');

            $add = $this->common->add('services', $post);

            if ($add):
                $this->session->set_userdata('add', 'Service add Successfully');
            else:
                $this->session->set_userdata('notadd', 'Failed to add Service');
            endif;

            redirect('services');
        else :
            redirect('auth');
        endif;
    }
    public function editService()
    {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :

            $id = $this->input->post('id');
            $output = $this->common->edit('services', $id, 'id');

            $data['service_name'] = $output->service_name;
            $data['description'] = $output->description;
            $data['link'] = $output->link;

            echo json_encode($data);
        else :
            redirect('auth');
        endif;
    }

    public function updateService() {

        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :

            $id  = (int)$this->input->post('id');
            $data['service_name'] = $this->input->post('service_name');
            $data['description'] = $this->input->post('description');
            $data['link'] = $this->input->post('link');
            $update=$this->common->update( 'services',$id, $data);

            if ($update):
                $this->session->set_userdata('edit', 'Service edit Successfully');
            else:
                $this->session->set_userdata('notadd', 'Failed to edit Service');
            endif;

            redirect('services');
        else :
            redirect('auth');
        endif;
    }
    public function deleteService()
    {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :
            $id = $this->input->post('id');
            if ($id) :
                $this->common->delete('services', $id, 'id');
            endif;
        else:
            redirect('auth');
        endif;
    }

}