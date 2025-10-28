<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
	}

	public function all_services() {
		$data['SERVICES'] = $this->Crud->ciRead("category_master", "`status` = '1' AND `type` = 's' AND `under_category_id` != '0'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('services/all-services', $data);
		$this->load->view('layouts/footer');
	}

	public function services() {
		extract($_POST);
		// Single category services
		$sql = "SELECT * FROM `service_master` WHERE `status`=2 AND `category_id` = '$serviceid'";
		$query = $this->db->query($sql);
		$data['services'] = $query->result_array();
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('services/services', $data);
		$this->load->view('layouts/footer');
	}

	
}
