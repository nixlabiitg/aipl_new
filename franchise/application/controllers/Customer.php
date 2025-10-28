<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct() {
		error_reporting(0);
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplFranchiseId')) {
			redirect('authentication/login');
		}
	}

	public function customers() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/customers');
		$this->load->view('layouts/footer');
	}

public function package()
{
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('master/package');
		$this->load->view('layouts/footer');
}

public function addPackage()
{
	$d=$this->input->post();
	$sql="INSERT INTO `package_master`( `package_name`,  `package_amount`,`digital_wallet_value`, `shopping_coupon_value`, `no_of_coupon`, `magic_shopping_points`, `gift_product_amount`, `direct_ipp_amount`, `registration_point`, `reffer_point`,  `autopool_allow`) VALUES ('".$d['p_name']."','".$d['p_amount']."','".$d['d_wallet']."','".$d['quopon']."','".$d['noquopon']."','".$d['magicpoint']."','".$d['giftamt']."','".$d['sponsoramt']."','".$d['regpoint']."','".$d['refpoint']."','".$d['autopoolallow']."')";
	// echo $sql;
	$this->db->query($sql);
	echo json_encode($this->db->affected_rows(),true);
}
public function active_package()
{
	$sql="SELECT * FROM `package_master` WHERE `status`=1";
	$query=$this->db->query($sql);
	$data['package']=$query->result_array();
	$data['status']=1;

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('master/listpackage',$data);
		$this->load->view('layouts/footer');
}

public function block_package()
{
	$sql="SELECT * FROM `package_master` WHERE `status`=0";
	$query=$this->db->query($sql);
	$data['package']=$query->result_array();
	$data['status']=2;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('master/listpackage',$data);
		$this->load->view('layouts/footer');
}


	public function manualActivation()
	{
	
		$sql="SELECT * FROM `package_master` order by `package_name` asc";
		$query=$this->db->query($sql);
		$data['package']=$query->result_array();
		$page_name="Active Customer";
		$data['page_name']="Active Customer";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/manual-activation');
		$this->load->view('layouts/footer');
	}

public function activeCustomer()
	{
	
		$sql="SELECT * FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE c.status='1' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$page_name="Active Customer";
		$data['page_name']="Active Customer";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/customers', $data);
		$this->load->view('layouts/footer');
	}

	public function pendingCustomer()
	{
	
		$sql="SELECT * FROM customer_master c INNER JOIN package_master p on c.package_id=p.package_id WHERE c.status='0' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$page_name="Pending Customer";
		$data['page_name']="Pending Customer";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/customers', $data);
		$this->load->view('layouts/footer');
	}

	public function blockedCustomer()
	{
	
		$sql="SELECT * FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE c.status='2' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$page_name="Blocked Customer";
		$data['page_name']="Blocked Customer";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/customers', $data);
		$this->load->view('layouts/footer');
	}

	public function rejectedCustomer()
	{
	
		$sql="SELECT * FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE c.status='3' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$page_name="Blocked Customer";
		$data['page_name']="Rejected Customer";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/customers', $data);
		$this->load->view('layouts/footer');
	}

	public function autopool1geanology()
	{
	
	
		$page_name="Autopool 1 Geanology";
		$data['page_name']="Autopool 1 Geanology";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('autopool/geanology1', $data);
		$this->load->view('layouts/footer');
	}

	public function autopool2geanology()
	{
	
	
		$page_name="Autopool 2 Geanology";
		$data['page_name']="Autopool 2 Geanology";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('autopool/geanology2', $data);
		$this->load->view('layouts/footer');
	}

	public function geanology()
	{
	
	
		$page_name="Geanology";
		$data['page_name']="Geanology";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('autopool/geanology2', $data);
		$this->load->view('layouts/footer');
	}


	public function autopool2_income()
	{
	
		$sql="SELECT * FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE c.status='3' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$page_name="Blocked Customer";
		$data['page_name']="Rejected Customer";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('autopool/autopool2income', $data);
		$this->load->view('layouts/footer');
	}

	public function autopool1_income()
	{
	
		$sql="SELECT * FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE c.status='3' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$page_name="Blocked Customer";
		$data['page_name']="Rejected Customer";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('autopool/autopool1income', $data);
		$this->load->view('layouts/footer');
	}

public function find()
{
	$d=$this->input->post();
	$sql="SELECT * FROM customer_master c where c.status=0 and c.customer_id='".$d['cid']."' and (c.package_id=0 or c.package_id is null)";
	$query=$this->db->query($sql);
    echo json_encode($sql,true);

}

public function activate()
{
	$d=$this->input->post();
	$sql="SELECT * FROM `package_master` WHERE `package_id`='".$d['packageId']."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();
	foreach($result as $rs)
	{

	}
    echo json_encode($sql,true);

}

	public function kyc_update()
	{
		$userId=$this->session->userdata('aiplFranchiseId');
		$d=$this->input->post();

		$sql="DELETE FROM `kyc_master` WHERE `cust_franc_id`='".$userId."'";
		$this->db->query($sql);	

		$sql="INSERT INTO `kyc_master`( `bank_name`, `branch_name`, `ac_no`,`ifsc_code`, `pan_no`, `aadhar_no`, `cust_franc_id`, `payee_name`) VALUES ('".$d['bank']."','".$d['branch']."','".$d['acno']."','".$d['ifsc']."','".$d['pan']."','".$d['aadhar']."','".$userId."','".$d['payee']."')";
		$this->db->query($sql);	
		
		$sql = "UPDATE `franchise_master` SET `nominee`='".$d['nominee']."',`relationship`='".$d['nominee_relation']."',`nominee_bank_no`='".$d['nominee_bankno']."',`nominee_bank_ifsc`='".$d['nominee_bank_ifsc']."',`nominee_dob`='".$d['nominee_dob']."' WHERE `franchise_id` = '".$userId."'";
		$this->db->query($sql);	
		
		echo json_encode($this->db->affected_rows(),true);
		
	}

}
