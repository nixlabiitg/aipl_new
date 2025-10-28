<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Franchise extends CI_Controller {
	public function __construct() {
		error_reporting(0);
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

	public function franchise_list(){
		$page_name="Franchise List";
		$data['page_name']= $page_name;
		$userId=$this->session->userdata('aiplUserId');
		$data['franchises'] = $this->Crud->ciRead("franchise_master", "`referred_by` = '$userId'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header', compact('page_name'));
		$this->load->view('user/layouts/nav');
		$this->load->view('franchise/franchise-list', $data);
		$this->load->view('user/layouts/footer');
	}

	public function all_collections(){
		$page_name="All Collections";
		$data['page_name']= $page_name;
		$userId=$this->session->userdata('aiplUserId');
		$sql = $this->db->query("SELECT ctm.*, pm.package_name FROM `customer_transaction_master` ctm JOIN franchise_package_master pm ON pm.id = ctm.package_id WHERE ctm.`customer_id` = '$userId' AND ctm.`income_type_id` = '33'");
		$data['franchises'] = $sql->result();
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header', compact('page_name'));
		$this->load->view('user/layouts/nav');
		$this->load->view('franchise/franchise-collection', $data);
		$this->load->view('user/layouts/footer');
	}
}
