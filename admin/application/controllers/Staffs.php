<?php
/**
 * Created by PhpStorm.
 * User: Rezwana
 * Date: 10/24/2018
 * Time: 12:10 PM
 */

class Staffs extends CI_Controller
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
            $data['title'] = 'Staff Info';
            $data['active_menu'] = 'admin';
            $data['sub_menu'] = 'staff';
            $data['staffs'] = $this->common->staffList();
            $data['category'] = $this->common->viewAll('staff_category');
            $data['zones'] = $this->common->viewAll('zone');

            $this->load->view('common/header', $data);
            $this->load->view('common/sidebar', $data);
            $this->load->view('admin/staffinfo', $data);
            $this->load->view('common/footer', $data);
        else :
            redirect('auth');
        endif;
    }

    public function getarea()
    {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :

            $id = $this->input->get('zone');
            $area = $this->common->fetchResult('area',$id,'zone_id');
            echo json_encode($area);

        else :
            redirect('auth');
        endif;
    }
    public function addStaff()
    {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :

            $post['name'] =$this->input->post('name');
            $post['category'] =$this->input->post('category');
            $post['position'] =$this->input->post('position');
            $post['fb'] =$this->input->post('fb');
            $post['twitter'] = $this->input->post('twitter');
            $post['google'] = $this->input->post('google');
            $post['linkedin'] = $this->input->post('linkedin');
            $post['phone'] = $this->input->post('phone');
            $post['address'] = $this->input->post('address');
            $post['zone'] = $this->input->post('zone');
            $post['area'] = $this->input->post('area');


            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $imgFile = $_FILES['fileToUpload']['name'];


            if (empty($imgFile)) :
                $post['image_path'] = 'login.png';
            else:
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) :
                    $post['image_path'] = basename($_FILES["fileToUpload"]["name"]);
                else:
                    $data['error'] = "Sorry, there was an error uploading your file";
                endif;
            endif;

            $Staff = $this->common->add('staffs', $post);


            if ($Staff):
                $this->session->set_userdata('add', 'Staff add Successfully');
            else:
                $this->session->set_userdata('notadd', 'Failed to add Staff');
            endif;


            redirect('staffs');
        else :
            redirect('auth');
        endif;
    }
    public function editStaff()
    {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :

            $id = $this->input->post('id');
            $output = $this->common->edit('staffs', $id, 'id');

            $data['name'] =$output->name;
            $data['category'] =$output->category;
            $data['position'] =$output->position;
            $data['fb'] =$output->fb;
            $data['twitter'] = $output->twitter;
            $data['google'] = $output->google;
            $data['linkedin'] = $output->linkedin;
            $data['phone'] = $output->phone;
            $data['address'] = $output->address;
            $data['image_path'] = $output->image_path;
            $data['zone'] =$output->zone;
            $zone = $output->zone;
            $data['zone'] =$output->zone;
            $data['area'] =$output->area;
            $data['staffcategory'] = $this->common->viewAll('staff_category');
            $data['zones'] = $this->common->viewAll('zone');
            $data['areas'] = $this->common->fetchResult('area',$zone,'zone_id');

            echo json_encode($data);
        else :
            redirect('auth');
        endif;
    }

    public function updateStaff() {

        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :

            $id = $this->input->post('id');
            $post['name'] =$this->input->post('name');
            $post['category'] =$this->input->post('categoryid');
            $post['position'] =$this->input->post('pos');
            $post['fb'] =$this->input->post('facebook');
            $post['twitter'] = $this->input->post('twit');
            $post['google'] = $this->input->post('goog');
            $post['linkedin'] = $this->input->post('link');
            $post['phone'] = $this->input->post('phone');
            $post['address'] = $this->input->post('address');
            $post['zone'] = $this->input->post('zoneid');
            $post['area'] = $this->input->post('areaid');
            $imgFile = $_FILES['fileToUpload']['name'];

            if (!empty($imgFile)) :
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) :
                    $post['image_path'] = basename($_FILES["fileToUpload"]["name"]);
                else:
                    $data['error'] = "Sorry, there was an error uploading your file";
                endif;
            endif;

            $update = $this->common->update('staffs', $id, $post);

            if ($update):
                $this->session->set_userdata('edit', 'Staff edit Successfully');
            else:
                $this->session->set_userdata('notadd', 'Failed to edit Staff');
            endif;

            redirect('staffs');
        else :
            redirect('auth');
        endif;
    }
    public function deleteStaff()
    {
        if (in_array($this->session->userdata('user_role'), array(1, 2, 3))) :
            $id = $this->input->post('id');

            if ($id) :
                $this->common->delete('staffs', $id, 'id');
            endif;
        else:
            redirect('auth');
        endif;
    }

}