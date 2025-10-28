<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{

	public function __construct() {
		error_reporting(0);
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	public function addStaff()
	{
		$page_name = 'Add Staff';
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('staff/add-staff');
		$this->load->view('layouts/footer');
	}

	public function addNewStaff()
	{
		if (isset($_POST['addstaff'])) {
			extract($_POST);

			$isExist = $this->Crud->ciCount("user_master", "`contact_no` = '$phone' OR `email_id` = 'email'");

			if ($isExist > 0) {
				$this->session->set_flashdata("warning", "Phone or email exist already.");
				redirect('staff/addStaff');
			} else {

				$data = [
					'user_name' => $name,
					'contact_no' => $phone,
					'email_id' => $email,
					'inv_target' => $meeting,
					'call_target' => $calling,
					'password' => $this->encryption->encrypt($password),
					'designation' => $designation,
					'Type' => 'Staff'
				];

				if ($this->Crud->ciCreate("user_master", $data)) {
					$this->session->set_flashdata("success", "Staff added successfully.");
				} else {
					$this->session->set_flashdata("danger", "Try again.");
				}

				redirect('staff/addStaff');
			}
		}
	}

	public function manageStaff()
	{
		echo $userList = $this->uri->segment(3);
		if ($userList == 'active') {
			$page_name = 'Active Staff';
			$data['STAFF'] = $this->Crud->ciRead("user_master", "`status` = '1' and user_type=4");
		} else if ($userList == 'inactive') {
			$page_name = 'Inactive Staff';
			$data['STAFF'] = $this->Crud->ciRead("user_master", "`status` = '0' and user_type=4");
		}
		$data['page_name']=$page_name;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('staff/manage-staff', $data);
		$this->load->view('layouts/footer');
	}

	public function editStaff()
	{
		if (isset($_POST['editStaff'])) {
			extract($_POST);

			$data = [
				'user_name' => $name,
				'contact_no' => $phone,
				'email_id' => $email,
				'designation' => $designation,
			];

			if ($this->Crud->ciUpdate("user_master", $data, "`user_id` = '$userid'")) {
				$this->session->set_flashdata("success", "Staff updated successfully.");
			} else {
				$this->session->set_flashdata("danger", "Try again.");
			}

			redirect('staff/manageStaff/active');
		}
	}

	public function changeStatus()
	{
		$staffId = $this->uri->segment(4);
		$status = $this->uri->segment(3);

		$data = [
			'status' => $status,
		];

		if ($this->Crud->ciUpdate("user_master", $data, "`user_id` = '$staffId'")) {
			$this->session->set_flashdata("success", "Staff status changed successfully.");
		} else {
			$this->session->set_flashdata("danger", "Try again.");
		}

		redirect('staff/manageStaff/active');
	}

	public function uploadProfileImage()
	{
		extract($_POST);
		$config['upload_path'] = FCPATH . 'uploads/profile/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['overwrite'] = TRUE;
		$config['max_width'] = 1500;
		$config['max_height'] = 1500;
		$config['encrypt_name'] = TRUE;
		$this->load->library('image_lib');
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('profile')) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('warning', $this->upload->display_errors());
		} else {
			$image_metadata = $this->upload->data();
			$profileImage = $image_metadata['file_name'];
			$configer =  array(
				'image_library'   => 'gd2',
				'source_image'    =>  $image_metadata['full_path'],
				'maintain_ratio'  =>  TRUE,
				'width'           =>  400,
				'height'          =>  400,
			);
			$this->image_lib->clear();
			$this->image_lib->initialize($configer);
		}

		$data = [
			'profile' => $profileImage
		];

		if ($this->Crud->ciUpdate("user_master", $data, "`user_id` = '$staffid'")) {
			$this->session->set_flashdata("success", "Staff status changed successfully.");
		} else {
			$this->session->set_flashdata("danger", "Try again.");
		}

		redirect('staff/manageStaff/active');
	}
}
