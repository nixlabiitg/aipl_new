<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct() {
	 error_reporting(0);
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAppId')) {
			redirect('authentication/login');
		}
	}

	public function customer_list() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('customers/customers-list');
		$this->load->view('layouts/footer');
	}

	public function downlineCustomer(){
		if(isset($_POST['cust__id'])){
			$userId=$_POST['cust__id'];
			$sql="SELECT *,c.status as st,DATE_FORMAT(status_update_date, '%d-%m-%Y %h:%i %p') as rgdate FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE `sponsor_id`='".$userId."' order by name";
		}else{
			$userId=$this->session->userdata('aiplAppId');
			$sql="SELECT *,c.status as st,DATE_FORMAT(status_update_date, '%d-%m-%Y %h:%i %p') as rgdate FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE `sponsor_id`='".$userId."' order by name";
		}
		
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$data['UPLINE'] = $userId;		
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('customers/customers-downline-list', $data);
		$this->load->view('layouts/footer');
	}

	public function wallet_list() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('customers/wallet-list');
		$this->load->view('layouts/footer');
	}

	public function payout_list() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('customers/payout-list');
		$this->load->view('layouts/footer');
	}

	public function transfer_list() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('customers/transfer-list');
		$this->load->view('layouts/footer');
	}

	public function genealogy_list() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('customers/genealogy-list');
		$this->load->view('layouts/footer');
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
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('master/listpackage',$data);
		$this->load->view('layouts/footer');
	}

	public function addtowallet()
	{
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *, DATE_FORMAT(approve_date,'%d-%m-%Y') as apdate,DATE_FORMAT(entry_date,'%d-%m-%Y') as rqdate FROM `activation_wallet_recharge_details` WHERE `customer_id`='".$userId."' order by entry_date desc";
		$query=$this->db->query($sql);
		$data['wallet']=$query->result_array();
		

			$this->load->view('layouts/header');
			$this->load->view('layouts/header-top');
			$this->load->view('layouts/bar');
			$this->load->view('customers/addtowallet',$data);
			$this->load->view('layouts/footer');
	}
	public function addtowalletrequest()
	{
		$userId=$this->session->userdata('aiplAppId');
		$d=$this->input->post();
		$sql="INSERT INTO `activation_wallet_recharge_details`(`customer_id`, `amount`,`mode_of_payment`) VALUES ('".$userId."','".$d['amount']."','".$d['mop']."')";
		$this->db->query($sql);
		echo $this->db->affected_rows();
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

    public function activeCustomer()
	{	
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,c.status as st,DATE_FORMAT(status_update_date, '%d-%m-%Y %h:%i %p') as rgdate FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE `sponsor_id`='".$userId."' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$page_name="Active Customer";
		$data['page_name']="Active Customer";		
		$data['status']=1;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('customers/customers', $data);
		$this->load->view('layouts/footer');
	}

	public function pendingCustomer()
	{
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,c.status as st,DATE_FORMAT(status_update_date, '%d-%m-%Y %h:%i %p') as rgdate  FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE `sponsor_id`='".$userId."' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$page_name="Pending Customer";
		$data['page_name']="Pending Customer";		
		$data['status']=0;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
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
	
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('customers/customers', $data);
		$this->load->view('user/layouts/footer');
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
		
			$userId=$this->session->userdata('aiplAppId');
			
			$data['cname']=$this->session->userdata('aiplAppName');
			$data['cid']=$userId;		
			
			$sql="SELECT * FROM autopool_master1 a INNER JOIN customer_master c on c.customer_id=a.member_id WHERE member_id='".$userId."'";
                
			$query=$this->db->query($sql);
			$data['tree']=$query->result_array();

			$data['PACKAGE'] = $this->Crud->ciRead("package_master", "`package_id` <> 0");
		
			$page_name="Autopool 1 Genealogy";
			$data['page_name']="Autopool 1 Genealogy";
			$this->load->view('layouts/header');
			$this->load->view('layouts/header-top');
			$this->load->view('layouts/bar');
			$this->load->view('autopool/autopool1geanology', $data);
			$this->load->view('layouts/footer');
		
	}

	public function autopool2geanology()
	{
	
	
		$userId=$this->session->userdata('aiplAppId');
			
		$data['cname']=$this->session->userdata('aiplAppName');
		$data['cid']=$userId;		
		
		$sql="SELECT * FROM autopool_master2 a INNER JOIN customer_master c on c.customer_id=a.member_id WHERE member_id='".$userId."'";
			
		$query=$this->db->query($sql);
		$data['tree']=$query->result_array();
	
		$page_name="Autopool 2 Genealogy";
		$data['page_name']="Autopool 2 Genealogy";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('autopool/autopool2geanology', $data);
		$this->load->view('layouts/footer');
	}

	public function clubautopoolgeanology()
	{
	
	
		$userId=$this->session->userdata('aiplAppId');
			
		$data['cname']=$this->session->userdata('aiplAppName');
		$data['cid']=$userId;		
		
		$sql="SELECT * FROM club_autopool a INNER JOIN customer_master c on c.customer_id=a.member_id WHERE member_id='".$userId."'";
			
		$query=$this->db->query($sql);
		$data['tree']=$query->result_array();
	
		$page_name="Club Autopool Genealogy";
		$data['page_name']="Club Autopool Genealogy";
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('autopool/clubautopoolgeanology', $data);
		$this->load->view('user/layouts/footer');
	}


	public function geanology()
	{
		$userId=$this->session->userdata('aiplAppId');
		
		$data['cname']=$this->session->userdata('aiplAppName');
		$data['cid']=$userId;		
		$sql="SELECT * FROM `customer_master` WHERE `customer_id`='".$userId."'";
		$query=$this->db->query($sql);
		$data['profile_pic']=$query->result_array();


		$sql="SELECT * FROM `customer_master` WHERE `sponsor_id`='".$userId."'";
		$query=$this->db->query($sql);
		$data['tree']=$query->result_array();

		$data['PACKAGE'] = $this->Crud->ciRead("package_master", "`package_id` <> 0");
	
		$page_name="Genealogy";
		$data['page_name']="Genealogy";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('autopool/geanology', $data);
		$this->load->view('layouts/footer');
	}


	public function autopool2_income()
	{
	
		$sql="SELECT * FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE c.status='3' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$page_name="Blocked Customer";
		$data['page_name']="Rejected Customer";
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('autopool/autopool2income', $data);
		$this->load->view('user/layouts/footer');
	}

	public function autopool1_income()
	{
	
		$sql="SELECT * FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE c.status='3' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$page_name="Blocked Customer";
		$data['page_name']="Rejected Customer";
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('autopool/autopool1income', $data);
		$this->load->view('user/layouts/footer');
	}

	public function find()
	{
		$userId=$this->session->userdata('aiplAppId');
		$d=$this->input->post();
		$sql="SELECT c.*, p.package_name FROM customer_master c JOIN package_master p ON p.package_id = c.selected_package where (c.status=0 or c.status=2) and c.customer_id='".$d['cid']."' and (c.package_id=0 or c.package_id is null) and c.customer_id<>'".$userId."'";
		$query=$this->db->query($sql);
		echo json_encode($query->result_array(),true);
	}
	
	public function findtotransfer()
	{
		$userId=$this->session->userdata('aiplAppId');
		$d=$this->input->post();
		$sql="SELECT * FROM customer_master c where c.status=1 and c.customer_id='".$d['cid']."' and c.customer_id<>'".$userId."'";
		$query=$this->db->query($sql);
		echo json_encode($query->result_array(),true);
	}

public function manualActivation()
{
		$userId=$this->session->userdata('aiplAppId');		
		$sql="SELECT * FROM customer_master  where status=1 and customer_id='".$userId."' ";
		$query=$this->db->query($sql);
		$data['wallet']=$query->result_array()[0]['activation_wallet'];

		$sql="SELECT * FROM `package_master` where `status`=1 order by `package_name` asc";
		$query=$this->db->query($sql);

		$data['package']=$query->result_array();
		$page_name="Active Customer";
		$data['page_name']="Active Customer";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('customers/manual-activation',$data);
		$this->load->view('layouts/footer');
}


public function selfActivation()
{
	$userId=$this->session->userdata('aiplAppId');
	$sql="SELECT *,c.status as cstatus FROM customer_master c left join package_master p on p.package_id=c.package_id where  c.customer_id='".$userId."' ";
	$query=$this->db->query($sql);
	$data['self']=$query->result_array();

	$sql="SELECT * FROM `package_master` where `status`=1 order by `package_name` asc";
	$query=$this->db->query($sql);
	$data['package']=$query->result_array();
	$page_name="Active Customer";
	$data['page_name']="Active Customer";
	$this->load->view('layouts/header');
	$this->load->view('layouts/header-top');
	$this->load->view('layouts/bar');
	$this->load->view('customers/self-activation',$data);
	$this->load->view('layouts/footer');
}

public function transfertoactivationwallet()
{
	$userId=$this->session->userdata('aiplAppId');		
		$sql="SELECT * FROM customer_master  where status=1 and customer_id='".$userId."' ";
		$query=$this->db->query($sql);
		$data['wallet']=$query->result_array()[0]['activation_wallet'];

	$sql="SELECT * FROM `package_master` where `status`=1 order by `package_name` asc";
	$query=$this->db->query($sql);
	$data['page_name']="Active Customer";
	$this->load->view('layouts/header');
	$this->load->view('layouts/header-top');
	$this->load->view('layouts/bar');
	$this->load->view('customers/transfer',$data);
	$this->load->view('layouts/footer');
}

public function upgradation()
{
	$userId=$this->session->userdata('aiplAppId');
	$sql="SELECT *,c.status as cstatus FROM customer_master c left join package_master p on p.package_id=c.package_id where  c.customer_id='".$userId."' ";
	$query=$this->db->query($sql);
	$data['self']=$query->result_array();

	$sql="SELECT * FROM `package_master` where `status`=1 order by `package_name` asc";
	$query=$this->db->query($sql);
	$data['package']=$query->result_array();
	$page_name="Active Customer";
	$data['page_name']="Active Customer";
	$this->load->view('layouts/header');
	$this->load->view('layouts/header-top');
	$this->load->view('layouts/bar');
	$this->load->view('customers/upgradation',$data);
	$this->load->view('layouts/footer');
}

	public function transferamount()
	{
		$d=$this->input->post();

		$userId=$this->session->userdata('aiplAppId');	

		$sql="SELECT `activation_wallet` FROM `customer_master` WHERE `customer_id`='".$userId."'";
		$query=$this->db->query($sql);
		$wallet=$query->result_array()[0]['activation_wallet'];
		if($wallet<$d['amount'] )
		{
			echo "d";
		}
		else
		{		
			$sql="INSERT INTO `activation_wallet_recharge_details`(`customer_id`, `amount`,`transfer_by`,`status`) VALUES ('".$d['cid']."','".$d['amount']."','".$userId."','3')";
			$this->db->query($sql);
			$sql="UPDATE `customer_master` SET `activation_wallet`=`activation_wallet`-".$d['amount'].",`activation_wallet_calculation_amount`=`activation_wallet_calculation_amount`-".$d['amount']." WHERE `customer_id`='".$userId."'";
			$this->db->query($sql);		
			$sql="UPDATE `customer_master` SET `activation_wallet`=`activation_wallet`+".$d['amount'].",activation_wallet_calculation_amount=activation_wallet_calculation_amount+".$d['amount'].",interest_cal_start_date=CURRENT_TIMESTAMP(),interest_calc_end_date=DATE_ADD(CURRENT_TIMESTAMP(),INTERVAL 30 DAY) where `customer_id`='".$d['cid']."'";
			$this->db->query($sql);
			echo $this->db->affected_rows();
		}
	
	}

	public function payoutrequest()
	{
		$userId=$this->session->userdata('aiplAppId');	
		$sql="SELECT * FROM `customer_master` WHERE `customer_id`='".$userId."'";
		$query=$this->db->query($sql);
		$data['wallet']=$query->result_array()[0]['main_wallet'];
		$data['page_name']="PAYOUT REQUEST";
		$data['is_kyc_approved'] = $this->Crud->ciCount("kyc_master", "`cust_franc_id` = '$userId' AND `status` = 1");

		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('customers/payoutrequest',$data);
		$this->load->view('layouts/footer');
		
	}

	public function send_request()
	{
		$userId=$this->session->userdata('aiplUserId');	
		$d=$this->input->post();

		$sql = $this->db->query("SELECT SUM(`amount`) as total_order_value FROM `order_master` WHERE MONTH(`order_date`) = MONTH(CURRENT_DATE()) AND YEAR(`order_date`) = YEAR(CURRENT_DATE()) AND `user_id` = '".$userId."' AND `status` BETWEEN 1 AND 2");
		$details = $sql->result();
		if($details[0]->total_order_value >= 1000){
			$sql="SELECT * FROM `payout_request` WHERE `customer_id`='".$userId."' and `status`=0";
			$this->db->query($sql);
			if($this->db->affected_rows()==0)
			{
				$sql="INSERT INTO `payout_request`(`customer_id`, `request_amount`,`remarks`,`tds`,`admin_charge`) VALUES ('".$userId."','".$d['amount']."','".$d['remarks']."','".$d['tds']."','".$d['admincharge']."')";
				$this->db->query($sql);
				echo $this->db->affected_rows();
			}
			else echo "d";
		}else{
			echo "f";
		}

	}


	public function transferto()
	{
		$userId=$this->session->userdata('aiplAppId');	
		$sql="SELECT DATE_FORMAT(entry_date,'%d-%m-%Y') as rqdate,c.name,c.customer_id,a.amount FROM (activation_wallet_recharge_details a INNER JOIN customer_master c on a.customer_id=c.customer_id) WHERE a.status=3 and a.transfer_by='".$userId."' ORDER BY `entry_date`";
		$query=$this->db->query($sql);
		$data['wallet']=$query->result_array();
		$data['page_name']="TRANSFERED TO";
		

		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('customers/transferhistory',$data);
		$this->load->view('layouts/footer');
		
	}

	public function pending_request()
	{
		$userId=$this->session->userdata('aiplAppId');	
		$sql="SELECT *,DATE_FORMAT(date,'%d-%m-%Y %h:%i %p') as date FROM `payout_request` WHERE status=0 and `customer_id`='".$userId."' ORDER BY `date`";
		$query=$this->db->query($sql);
		$data['request']=$query->result_array();
		$data['page_name']="Pending Request";
		$data['status']=0;

		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('customers/requesthistory',$data);
		$this->load->view('layouts/footer');
		
	}
	public function approved_request()
	{
		$userId=$this->session->userdata('aiplAppId');	
		$sql="SELECT *,DATE_FORMAT(date,'%d-%m-%Y %h:%i %p') as date,DATE_FORMAT(approve_date,'%d-%m-%Y %h:%i %p') as apdate FROM `payout_request` WHERE status=1 and `customer_id`='".$userId."' ORDER BY `date`";
		$query=$this->db->query($sql);
		$data['request']=$query->result_array();
		$data['page_name']="Approved Request";
		$data['status']=1;

		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('customers/requesthistory',$data);
		$this->load->view('layouts/footer');
		
	}
	public function transferfrom()
	{
		$userId=$this->session->userdata('aiplAppId');	
		$sql="SELECT DATE_FORMAT(entry_date,'%d-%m-%Y') as rqdate,c.name,c.customer_id,a.amount FROM (activation_wallet_recharge_details a INNER JOIN customer_master c on a.transfer_by=c.customer_id) WHERE a.status=3 and a.customer_id='".$userId."' ORDER BY `entry_date`";
		$query=$this->db->query($sql);
		$data['wallet']=$query->result_array();
		$data['page_name']="TRANSFERED FROM";
		

		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('customers/transferhistory',$data);
		$this->load->view('layouts/footer');
		
	}
	public function activate()
	{
		$d=$this->input->post();
		//generation income start

		$sql="SELECT * FROM `package_master` WHERE `package_id`='".$d['packageId']."'";
		$query=$this->db->query($sql);
		$rs=$query->result_array();	
		$l1=$rs[0]['magic_ipp_for_level_1'];
		$l2=$rs[0]['magic_ipp_for_level_2'];
		$l3=$rs[0]['magic_ipp_for_level_3'];
		$l4=$rs[0]['magic_ipp_for_level_4'];
		$l5=$rs[0]['magic_ipp_for_level_5'];
		$l6=$rs[0]['magic_ipp_for_level_6'];
		$l7=$rs[0]['magic_ipp_for_level_7'];
		$l8=$rs[0]['magic_ipp_for_level_8'];
		$l9=$rs[0]['magic_ipp_for_level_9'];
		$l10=$rs[0]['magic_ipp_for_level_10'];
		$directippincome=$rs[0]['direct_ipp_amount'];
		$packname=$rs[0]['package_name'];
		$directpointbonus=$rs[0]['direct_point_bonus'];
		$sales_point=$rs[0]['sales_point'];
		//generation income end

		/* level upgrade income */
		$lu1=$rs[0]['level_upgrade_incentive_level_1'];
		$lu2=$rs[0]['level_upgrade_incentive_level_2'];
		$lu3=$rs[0]['level_upgrade_incentive_level_3'];
		$lu4=$rs[0]['level_upgrade_incentive_level_4'];
		$lu5=$rs[0]['level_upgrade_incentive_level_5'];
		$lu6=$rs[0]['level_upgrade_incentive_level_6'];
		$lu7=$rs[0]['level_upgrade_incentive_level_7'];
		$lu8=$rs[0]['level_upgrade_incentive_level_8'];
		$lu9=$rs[0]['level_upgrade_incentive_level_9'];
		$lu10=$rs[0]['level_upgrade_incentive_level_10'];

		$this->levelUpgradeIncome($d['sponsorid'],0,$lu1,$lu2,$lu3,$lu4,$lu5,$lu6,$lu7,$lu8,$lu9,$lu10);

		$this->generationIncome($d['sponsorid'],0,$l1,$l2,$l3,$l4,$l5,$l6,$l7,$l8,$l9,$l10);
		
		$userId=$this->session->userdata('aiplUserId');
		$sql="SELECT `activation_wallet` FROM `customer_master` WHERE `customer_id`='".$userId."'";
		$query=$this->db->query($sql);
		$wallet=$query->result_array()[0]['activation_wallet'];

		if($wallet<$d['packamount'] )
		{
			echo "d";
		}
		else
		{		
			$sql="UPDATE `customer_master` SET `activation_wallet`=`activation_wallet`-".$d['packamount'].",`activation_wallet_calculation_amount`=`activation_wallet_calculation_amount`-".$d['packamount']." WHERE `customer_id`='".$userId."'";
			$this->db->query($sql);
			$sql="INSERT INTO `customer_transaction_master`(`customer_id`, `debit`, `remarks`,`activate_to`, `package_id`) VALUES ('".$userId."','".$d['packamount']."','Activation of Customer Id :".$d['cid']."','".$d['cid']."','".$d['packageId']."')";
			$this->db->query($sql);

			$w=explode("/",$d['wallet']);
			$sql="UPDATE `customer_master` SET `package_id`='".$d['packageId']."',`main_wallet`='".$w[0]."',`digital_wallet`='".$w[1]."',`shopping_coupon_amt`='".$w[2]."',no_of_coupon='".$w[3]."', `magic_shopping_points`='".$w[4]."',`gift_product_amt`='".$w[5]."', status='1', activated_by='".$userId."', activation_date=CURRENT_TIMESTAMP() WHERE `customer_id`='".$d['cid']."'";
			$this->db->query($sql);

			// sponsor update 
			if($directpointbonus>0)
			{
				$sql="UPDATE `customer_master` SET  direct_bonus_point=direct_bonus_point+".$directpointbonus." WHERE `customer_id`='".$d['sponsorid']."'";
				$this->db->query($sql);
				
			}

			if($directippincome>0)
			{
				$sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$directippincome." WHERE `customer_id`='".$d['sponsorid']."'";
				$this->db->query($sql);
				$sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$d['sponsorid']."','".$directippincome."','Direct IPP Sponsor Income From ".$d['cid']." (".$packname.")','2')";
				// echo json_encode($sql);
				$this->db->query($sql);
			}

			$sponsor_details = $this->Crud->ciRead("customer_master", "`customer_id`='".$d['sponsorid']."'");
			$sponsor_sponsorid = $sponsor_details[0]->sponsor_id;
			$promotion_id_sponsor = $sponsor_details[0]->promotion_id;

			if($sales_point > 0 && $promotion_id_sponsor < 2)
			{
				$sql="UPDATE `customer_master` SET `sales_point` = sales_point+".$sales_point." WHERE `customer_id`='".$d['sponsorid']."'";
				$this->db->query($sql);
			}

			if($sponsor_sponsorid){
				$sponsor_details_ = $this->Crud->ciRead("customer_master", "`customer_id`='".$sponsor_sponsorid."'");
				$promotion_id = $sponsor_details_[0]->promotion_id;

				if($promotion_id >= 2){
					$sql="UPDATE `customer_master` SET `spp_sales_point` = `spp_sales_point`+".$sales_point.", `incentive_member_no` = `incentive_member_no`+1 WHERE `customer_id`='".$sponsor_sponsorid."'";
					$this->db->query($sql);
				}
			}

			/*booster income*/
			$this->booster_mentor_income($d['cid'],$d['sponsorid'],$d['boosterincome']);
		
	    	/*autopool start*/
			if($d['autopoolallow']==1)
			{
				
				$sql="SELECT * FROM `autopool_master1` WHERE `uid_5`='' ORDER BY `entry_date` ASC limit 1";
				$query=$this->db->query($sql);
				$result=$query->result_array();
				if($result[0]['uid_1']=="")
				{
					$sql="UPDATE `autopool_master1` SET `uid_1`='".$d['cid']."' WHERE  `id`='".$result[0]['id']."'";
					$this->db->query($sql);
				}
				elseif($result[0]['uid_2']=="")
				{
					$sql="UPDATE `autopool_master1` SET `uid_2`='".$d['cid']."' WHERE  `id`='".$result[0]['id']."'";
					$this->db->query($sql);
				}
				elseif($result[0]['uid_3']=="")
				{
					$sql="UPDATE `autopool_master1` SET `uid_3`='".$d['cid']."' WHERE  `id`='".$result[0]['id']."'";
					$this->db->query($sql);
				}
				elseif($result[0]['uid_4']=="")
				{
					$sql="UPDATE `autopool_master1` SET `uid_4`='".$d['cid']."' WHERE  `id`='".$result[0]['id']."'";
					$this->db->query($sql);
				}
				else 
				{
					$sql="UPDATE `autopool_master1` SET `uid_5`='".$d['cid']."' WHERE  `id`='".$result[0]['id']."'";
					$this->db->query($sql);
				}

				$sql="INSERT INTO `autopool_master1`(`member_id`) VALUES ('".$d['cid']."')";
				$this->db->query($sql);

			}
			/*autopool end*/

			// Update franchise referrer Commission 1%
			$franchiseid = $d['franchiseid'];
			$get_franchise_sponsor = $this->Crud->ciRead("franchise_master", "`franchise_id` = '$franchiseid'");
			$franchise_sponsor = $get_franchise_sponsor[0]->referred_by;

			$referrer_commission = $d['packamount'] * 0.01;

			$sql = $this->db->query("UPDATE `customer_master` SET `main_wallet` = `main_wallet` + $referrer_commission WHERE `customer_id` = '$franchise_sponsor'");

			$data = [
				'customer_id' => $franchise_sponsor,
				'credit' => $referrer_commission,
				'remarks' => $d['cid'],
				'package_id' => $d['packageId'],
				'income_type_id' => 34
			];

			$this->Crud->ciCreate("customer_transaction_master", $data);

			// Update franchise Commission 1%
			$digital_wallet_amount = $rs[0]['digital_wallet_value'];
			$franchise_commission = $digital_wallet_amount * 0.01;
			$sql = $this->db->query("UPDATE `franchise_master` SET `wallet` = `wallet` + $franchise_commission WHERE `franchise_id` = '$franchiseid'");

			$data2 = [
				'customer_id' => $franchiseid,
				'credit' => $franchise_commission,
				'remarks' => $d['cid'],
				'package_id' => $d['packageId'],
				'income_type_id' => 35
			];

			$this->Crud->ciCreate("customer_transaction_master", $data2);

			echo json_encode($this->db->affected_rows(),true);
		}
	}

	public function levelUpgradeIncome($sponsorid,$s,$l1,$l2,$l3,$l4,$l5,$l6,$l7,$l8,$l9,$l10)  //S=0 in call
{
	$k=$s+1;
	$amt=0;
	
	if($k<=10)	
	{
		$sql="SELECT * FROM customer_master  WHERE `customer_id`='".$sponsorid."'";
		
		$query = $this->db->query($sql);
		$result = $query->result_array();
		if($this->db->affected_rows()>0)
		{
				foreach ($result as $rs) {  
				
				if($k==1) $amt=$l1;
				else if($k==2) $amt=$l2;
				else if($k==3) $amt=$l3;
				else if($k==4) $amt=$l4;
				else if($k==5) $amt=$l5;
				else if($k==6) $amt=$l6;
				else if($k==7) $amt=$l7;
				else if($k==8) $amt=$l8;
				else if($k==9) $amt=$l9;
				else $amt=$amt=$l10;				
				
				$sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$amt." WHERE `customer_id`='".$sponsorid."'";
			    $this->db->query($sql);     
				if($amt>0)
				{
					
					$sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$sponsorid."','".$amt."','Level Upgrade Income','7')";
					
					 $this->db->query($sql);
				 }			
				
				
				 $this->levelUpgradeIncome($rs['sponsor_id'],$k,$l1,$l2,$l3,$l4,$l5,$l6,$l7,$l8,$l9,$l10);  
				 
			
			}
		}				
	}	
}
	
	
//Booster Income
public function booster_mentor_income($customerid,$sponsorid,$boosterIncome)  //S=0 in call
{	
		$bIncome=0;
		$sql="SELECT * FROM customer_master c INNER JOIN package_master p on c.package_id=p.package_id  WHERE date_format(`activation_date`,'%Y-%m-%d')=date_format(CURDATE(),'%Y-%m-%d') AND `sponsor_id`='".$sponsorid."' and `boosterincome`=0 and p.booster_income>0 and c.customer_id<> '".$customerid."' and c.status=1 order by `status_update_date` limit 1";			
		$query = $this->db->query($sql);
		$result = $query->result_array();
		foreach ($result as $rs) {  
			$bIncome=($rs['booster_income']>$boosterIncome?$boosterIncome:$rs['booster_income']);
			//Booster Income		
			$sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$bIncome." WHERE `customer_id`='".$sponsorid."'";
			$this->db->query($sql);     
			$sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$sponsorid."','".$bIncome."','Booster Income','10')";
			$this->db->query($sql);
			$sql="UPDATE `customer_master` SET `boosterincome`=1 WHERE `customer_id`='".$customerid."'";
			$this->db->query($sql);     
			$sql="UPDATE `customer_master` SET `boosterincome`=1 WHERE `customer_id`='".$rs['customer_id']."'";
			$this->db->query($sql);     
			//Mentor Income	
			$sql="SELECT * FROM `customer_master` WHERE `customer_id`='".$sponsorid."'";		
			$query = $this->db->query($sql);
			$result1 = $query->result_array();
			foreach($result1 as $rs1)
				{
					$sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$bIncome." WHERE `customer_id`='".$rs1['sponsor_id']."'";
					$this->db->query($sql);     
					$sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$rs1['sponsor_id']."','".$bIncome."','Mentor Income','11')";
					$this->db->query($sql);
				}				
		
	}	
	
}
//Special generation income
public function generationIncome($sponsorid,$s,$l1,$l2,$l3,$l4,$l5,$l6,$l7,$l8,$l9,$l10)  //S=0 in call
{
	$k=$s+1;
	$amt=0;
	
	if($k<=10)	
	{
		$sql="SELECT * FROM customer_master  WHERE `customer_id`='".$sponsorid."'";
		
		$query = $this->db->query($sql);
		$result = $query->result_array();
		if($this->db->affected_rows()>0)
		{
				foreach ($result as $rs) {  
				
				if($k==1) $amt=$l1;
				else if($k==2) $amt=$l2;
				else if($k==3) $amt=$l3;
				else if($k==4) $amt=$l4;
				else if($k==5) $amt=$l5;
				else if($k==6) $amt=$l6;
				else if($k==7) $amt=$l7;
				else if($k==8) $amt=$l8;
				else if($k==9) $amt=$l9;
				else $amt=$l10;
				
				
				$sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$amt." WHERE `customer_id`='".$sponsorid."'";
				
				 $this->db->query($sql);     
				
				if($amt>0)
				{
					
					$sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$sponsorid."','".$amt."','Special Generation income','3')";
					
					 $this->db->query($sql);
				 }			
				
				
				 $this->generationIncome($rs['sponsor_id'],$k,$l1,$l2,$l3,$l4,$l5,$l6,$l7,$l8,$l9,$l10);  
				 
			
			}
		}
					
		
		
	}	

}
	public function selfactivate()
	{
		$d=$this->input->post();		
		
			
		$w=explode("/",$d['wallet']);
		$sql="UPDATE `customer_master` SET `package_id`='".$d['packageId']."',`main_wallet`='".$w[0]."',`digital_wallet`='".$w[1]."',`shopping_coupon_amt`='".$w[2]."',no_of_coupon='".$w[3]."', `magic_shopping_points`='".$w[4]."',`gift_product_amt`='".$w[5]."', status='0',activation_payment_mode='".$d['mop']."' WHERE `customer_id`='".$d['cid']."'";
		$this->db->query($sql);
	
		echo json_encode($this->db->affected_rows(),true);
		
	
	}

	public function upgrade()
	{
		$d=$this->input->post();		
		$sql="UPDATE `customer_master` SET `upgrade_package_request`='".$d['packageId']."',`upgrade_date`=CURRENT_TIMESTAMP() WHERE `customer_id`='".$d['cid']."'";
		$this->db->query($sql);
	
		echo json_encode($this->db->affected_rows(),true);
		
	
	}

	public function kyc_update()
	{
		$userId=$this->session->userdata('aiplAppId');
		$d=$this->input->post();

		$sql="DELETE FROM `kyc_master` WHERE `cust_franc_id`='".$userId."'";
		$this->db->query($sql);	

		$sql="INSERT INTO `kyc_master`( `bank_name`, `branch_name`, `ac_no`,`ifsc_code`, `pan_no`, `aadhar_no`, `cust_franc_id`, `payee_name`) VALUES ('".$d['bank']."','".$d['branch']."','".$d['acno']."','".$d['ifsc']."','".$d['pan']."','".$d['aadhar']."','".$userId."','".$d['payee']."')";
		$this->db->query($sql);	

		$sql = "UPDATE `customer_master` SET `nominee`='".$d['nominee']."',`relationship`='".$d['nominee_relation']."',`nominee_bank_no`='".$d['nominee_bankno']."',`nominee_bank_ifsc`='".$d['nominee_bank_ifsc']."',`nominee_dob`='".$d['nominee_dob']."' WHERE `customer_id` = '".$userId."'";
		$this->db->query($sql);	
		
		echo json_encode($this->db->affected_rows(),true);
		
	}

	public function payment_slip(){
		extract($_POST);
		$data['SETTINGS'] = $this->Crud->ciRead("setting", "`id` = '1'");
		$sql = $this->db->query("SELECT pr.*, cm.name, cm.mobile, cm.email FROM `payout_request` pr JOIN customer_master cm ON cm.customer_id = pr.customer_id WHERE pr.id = '$payoutid'");
		$data['PAYMENT'] = $sql->result();
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('customers/payment-slip', $data);
		$this->load->view('layouts/footer');
	}

}


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	