<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Franchise extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	

	public function activeFranchise()
	{
	
		$sql="SELECT * FROM `franchise_master` WHERE `status`='1' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$page_name="Active Franchise";
		$data['page_name']="Active Franchise";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('franchise/franchise', $data);
		$this->load->view('layouts/footer');
	}

	public function pendingFranchise()
	{
	
		$sql="SELECT * FROM `franchise_master` WHERE `status`='0' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$page_name="Franchise Request";
		$data['page_name']="Franchise Request";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('franchise/franchise', $data);
		$this->load->view('layouts/footer');
	}

	public function blockedFranchise()
	{
	
		$sql="SELECT * FROM `franchise_master` WHERE `status`='2' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$page_name="Blocked Franchise";
		$data['page_name']="Blocked Franchise";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('franchise/franchise', $data);
		$this->load->view('layouts/footer');
	}


}
