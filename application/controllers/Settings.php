<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	 public function __construct() {

		parent::__construct();

		$this->load->library('form_validation');

        $this->load->model('Settings_model');
        
        $this->load->library('encryption');

		if (!$this->session->userdata('aiplUserId')) {

            redirect('authentication/login');

        }

     }

	 public function password() {

		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('settings/password');
		$this->load->view('user/layouts/footer');

     }

     public function profile() {
        $userid = $this->session->userdata("aiplUserId");
		$data['profile'] = $this->Crud->ciRead("customer_master", "`customer_id` = '$userid'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/nav');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('settings/details', $data);
		$this->load->view('user/layouts/footer');

     }

     public function changePassword() {

        $this->form_validation->set_rules('password', 'Current password', 'required');

        $this->form_validation->set_rules('new_password', 'New password', 'required');

        if ($this->form_validation->run()) {

            $output = $this->Settings_model->changePassword($this->input->post('password'), $this->input->post('new_password'));

            if ($output == 'Password changed') {

                $message = 'success';

            } else {

                $message = 'danger';

            }

            $this->session->set_flashdata($message, $output);

            redirect('settings/password');

        } else {

            $this->session->set_flashdata('danger', 'Please enter valid passwords');

            redirect('settings/password');

        }

    }

    public function changeProfile(){
        $id = $this->session->userdata("aiplUserId");
        // if (isset($_POST['update'])) {
            extract($_POST);
            $config['upload_path'] = FCPATH . 'uploads/profile';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['overwrite'] = TRUE; // This allows the existing file to be overwritten
            $config['file_name'] = $id . '.png'; // Set the file name to the id of the record being updated
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            unlink(FCPATH . 'uploads/profile'.$id.".png");
            $sql="UPDATE `customer_master` SET `profile_pic`=1 where `customer_id`='".$id."'";
           
            if (!$this->upload->do_upload('profile')) {
                // $error = array('error' => $this->upload->display_errors());
                
                $this->session->set_flashdata('warning', "Something went wrong");
                redirect('settings/profile');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $sql="UPDATE `customer_master` SET `profile_pic`=1 where `customer_id`='".$id."'";
                $this->db->query($sql);
                // $this->session->set_flashdata('warning', $this->upload->display_errors());
                $this->session->set_flashdata('success', "Profile pic updated");
                redirect('settings/profile');
            }
            redirect('settings/profile');
        // }
    }
    

    public function logout() {
        $data = $this->session->all_userdata();
        foreach ($data as $key => $value) {
            $this->session->unset_userdata($key);
        }
        redirect('user/authentication/login');

	}

}