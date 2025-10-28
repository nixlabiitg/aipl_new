<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	 public function __construct() {

		parent::__construct();
        error_reporting(0);
		$this->load->library('form_validation');

        $this->load->model('Settings_model');
        
        $this->load->library('encryption');

		if (!$this->session->userdata('aiplAdminId') || $this->session->userdata('role') != '1') {

            redirect('authentication/login');

        }

     }

	 public function password() {

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('settings/password');
		$this->load->view('layouts/footer');

     }

     public function logo() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('settings/logo');
		$this->load->view('layouts/footer');
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
    public function logs()
    {

        $data['LOGIN_HISTORY'] = $this->Settings_model->getLoginHistory();

        $this->load->view('layouts/header');
        $this->load->view('layouts/bar');
        $this->load->view('layouts/nav');
        $this->load->view('layouts/sub-header');
        $this->load->view('settings/logs', $data);
        $this->load->view('layouts/footer');
    }

    public function changeFavicon(){
        $id = 'favicon';
        if (isset($_POST['addFavicon'])) {
            extract($_POST);
            $config['upload_path'] = FCPATH . '../portal_assets/images';
            $config['allowed_types'] = 'jpg|ico|jpeg|png';
            $config['overwrite'] = TRUE; // This allows the existing file to be overwritten
            $config['file_name'] = $id . '.ico'; // Set the file name to the id of the record being updated
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('favicon')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
            }
            redirect('settings/logo');
        }
    }

    public function changeLogo(){
        $id = 'logo';
        if (isset($_POST['change'])) {
            extract($_POST);
            $config['upload_path'] = FCPATH . '../portal_assets/images';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['overwrite'] = TRUE; // This allows the existing file to be overwritten
            $config['file_name'] = $id . '.png'; // Set the file name to the id of the record being updated
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('logo')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
            }
            redirect('settings/logo');
        }
    }

    public function logout() {
        $data = $this->session->all_userdata();
        foreach ($data as $key => $value) {
            $this->session->unset_userdata($key);
        }
        redirect('authentication/login');

	}

}