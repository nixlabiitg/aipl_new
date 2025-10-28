<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Franchise extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
	}

	public function franchise(){
		$userId=$this->session->userdata('aiplAppId');
		$data['franchises'] = $this->Crud->ciRead("franchise_master", "`referred_by` = '$userId'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('franchise/franchise-list', $data);
		$this->load->view('layouts/footer-shop');
	}
}