<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	 public function __construct() {

		parent::__construct();
        error_reporting(0);
		$this->load->library('form_validation');

        $this->load->model('Settings_model');
        
        $this->load->library('encryption');

		if (!$this->session->userdata('aiplAppId') || $this->session->userdata('role') != '2') {

            redirect('authentication/login');

        }

     }

	 public function password() {

		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('settings/password');
		$this->load->view('layouts/footer');

     }

     public function profile() {
        // $data['PROFILE'] = $this->Crud->ciRead("user_master", "`user_id` = '1'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('settings/profile', $data);
		$this->load->view('layouts/footer');
     }

     public function edit_profile() {
        $userid = $this->session->userdata("aiplAppId");
		$data['profile'] = $this->Crud->ciRead("customer_master", "`customer_id` = '$userid'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('settings/edit-profile', $data);
		$this->load->view('layouts/footer');
     }

     public function changePassword() {
        $this->input->post('password');

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
        $id = $this->session->userdata("aiplAppId");
        if (isset($_POST['update'])) {
            extract($_POST);
            $config['upload_path'] = FCPATH . '../uploads/profile';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['overwrite'] = TRUE; // This allows the existing file to be overwritten
            $config['file_name'] = $id . '.png'; // Set the file name to the id of the record being updated
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('profile')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
                redirect('settings/edit_profile');
            } else {
                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
                redirect('settings/edit_profile');
            }
            redirect('settings/edit_profile');
        }
    }

    public function updateProfile(){
        extract($_POST);
        $data = [
            'customer_id' => $id,
            'user_name' => $name,
            'user_email' => $email,
            'user_phone' => $phone,
        ];

        if ($this->Crud->ciUpdate("user_master", $data, "`user_id` = '1'")) {
            $this->session->set_flashdata('success', "Profile updated.");
        } else {
            $this->session->set_flashdata('warning', "Something went wrong. Try again.");
        }
        redirect('settings/profile');
    }

}