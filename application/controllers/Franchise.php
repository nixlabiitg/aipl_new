<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Franchise extends CI_Controller {
	public function __construct() {
		error_reporting(0);
		parent::__construct();
        $this->load->database(); // IMPORTANT
        $this->load->model('Franchise_model');
	}

	// --------------------------
    // Franchise Dashboard
    // --------------------------
    public function index(){
       // $userId = $this->session->userdata('aiplUserId');

        //$data['SPONSOR_INCOME']   = $this->Franchise_model->total_sponsor_income($userId);
        //$data['REMUNERATION']     = $this->Franchise_model->total_remuneration($userId);
       // $data['INCENTIVE']        = $this->Franchise_model->total_incentive($userId);
        //$data['QR_BENEFIT']       = $this->Franchise_model->total_qr_benefit($userId);

        $this->load->view('user/layouts/header');
        $this->load->view('user/layouts/nav');
        $this->load->view('franchise/dashboard');
        $this->load->view('user/layouts/footer');
    }

	// --------------------------
    // Sponsor Income (Level 1-3)
    // --------------------------
    public function sponsor_income(){
        $userId = $this->session->userdata('aiplUserId');
        $data['income_list'] = $this->Franchise_model->get_sponsor_income($userId);

        $this->load->view('user/layouts/header');
        $this->load->view('user/layouts/nav');
        $this->load->view('franchise/sponsor_income', $data);
        $this->load->view('user/layouts/footer');
    }

	// --------------------------
    // Franchise Income Statement
    // --------------------------
    public function income_statement(){
        $userId = $this->session->userdata('aiplUserId');

        $from = $this->input->post('from') ?: date("Y-m-01");
        $to   = $this->input->post('to') ?: date("Y-m-d");

        $data['income_list'] = $this->Franchise_model->get_income_statement($userId, $from, $to);

        $data['from'] = $from;
        $data['to'] = $to;

        $this->load->view('user/layouts/header');
        $this->load->view('user/layouts/nav');
        $this->load->view('franchise/income_statement', $data);
        $this->load->view('user/layouts/footer');
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
