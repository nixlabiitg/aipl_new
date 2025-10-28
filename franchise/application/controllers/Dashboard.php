<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplFranchiseId')) {
			redirect('authentication/login');
		}
	}
	public function notifications()
	{
		
		$sql="SELECT *,date_format(`show_until`,'%d-%m-%Y') as ud,date_format(`added_date`,'%d-%m-%Y %h:%i %p') as ad FROM `notifications` WHERE `show_until`>=CURDATE() and status=1 and (user_type_id=3 or user_type_id=0)  order by id desc";
		$query=$this->db->query($sql);
		$data['NOTIFICATIONS'] =$query->result_array();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('notifications/active', $data);
		$this->load->view('layouts/footer');
	
	}
	public function index() {
		$userId=$this->session->userdata('aiplFranchiseId');
		$sql="SELECT * FROM `franchise_master` WHERE `franchise_id`='".$userId."'";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		$package_id = $result[0]['package_id'];
		$data['wallet']=($result?$result[0]['wallet']:0);
		$sql="SELECT count(o.order_id) as cnt ,o.status FROM despatch_details d INNER JOIN order_master o on d.order_id=o.order_id  where d.despatch_through='".$userId."' GROUP BY o.status";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		$pending=0;
		$delivered=0;

		foreach($result as $rs)
		{
			if($rs['status']==1) $pending=$rs['cnt'];
			else if($rs['status']==2) $delivered=$rs['cnt'];
		}
		$data['totalorders']=$pending+$delivered;
		$data['pending']=$pending;
		$data['delivered']=$delivered;

		$sql="SELECT sum(debit) as income FROM `customer_transaction_master` WHERE `customer_id`='".$userId."'";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		$data['income']=$result[0]['income'];

		$sql="SELECT *,(o.amount-o.discount_price) as amt,DATE_FORMAT(despatch_date,'%d-%m-%Y %h:%i %p') as dt FROM (order_master o INNER JOIN customer_master c on o.user_id=c.customer_id) INNER JOIN despatch_details d on o.order_id=d.order_id where d.despatch_through='".$userId."' and o.status=1 order by despatch_date";
		$query=$this->db->query($sql);
		$data['order']=$query->result_array();

		// Package details
		
		$data['package'] = $this->Crud->ciRead("franchise_package_master", "`id` = '$package_id'");

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('dashboard',$data);
		$this->load->view('layouts/footer');
	}

	

	public function logout() {

		$this->session->unset_userdata('aiplFranchiseId');
		 redirect('authentication/login');
	}
}
