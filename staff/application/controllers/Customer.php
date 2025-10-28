<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct() {
		error_reporting(0);
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplStaffId')) {
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

	public function activeCustomer()
	{
		$sql="SELECT *,DATE_FORMAT(status_update_date, '%d-%m-%Y %h:%i %p') as rgdate  FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE c.status='1' order by name";
		// $sql="SELECT *,a1.member_id as a1member,a2.member_id as a2member,cl.member_id as clmember,DATE_FORMAT(status_update_date, '%d-%m-%Y %h:%i %p') as rgdate  FROM ((((customer_master c LEFT  JOIN package_master p on c.package_id=p.package_id) LEFT JOIN autopool_master1 a1 on a1.member_id=c.customer_id) LEFT JOIN autopool_master2 a2 on a2.member_id=c.customer_id)) LEFT JOIN club_autopool cl on cl.member_id=c.customer_id WHERE c.status='1' order by name";
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

	public function upgraderequest()
	{
		$sql="SELECT *,c.package_id as pid,DATE_FORMAT(status_update_date, '%d-%m-%Y %h:%i %p') as rgdate   FROM customer_master c INNER JOIN package_master p on c.upgrade_package_request=p.package_id WHERE  c.id<>1 order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$page_name="Upgrade Request";
		$data['page_name']="Upgrade Request";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/customers', $data);
		$this->load->view('layouts/footer');
	}
	public function upgrade()
	{

		$userId=$this->session->userdata('aiplStaffId');
		$d=$this->input->post();

	
		$sql="SELECT * FROM `package_master` WHERE `package_id`='".$d['packageId']."'";

		$query=$this->db->query($sql);
		$result=$query->result_array();
		foreach($result as $rs)
		{
			$l1=$rs[0]['magic_ipp_for_level_1'];
		$l2=$rs['magic_ipp_for_level_2'];
		$l3=$rs['magic_ipp_for_level_3'];
		$l4=$rs['magic_ipp_for_level_4'];
		$l5=$rs['magic_ipp_for_level_5'];
		$l6=$rs['magic_ipp_for_level_6'];
		$l7=$rs['magic_ipp_for_level_7'];
		$l8=$rs['magic_ipp_for_level_8'];
		$l9=$rs['magic_ipp_for_level_9'];
		$l10=$rs['magic_ipp_for_level_10'];
			$directippincome=$rs[0]['direct_ipp_amount'];
			$packname=$rs[0]['package_name'];
			$directpointbonus=$rs[0]['direct_point_bonus'];
		
			//Level upgrade income start
			$lu1=$rs['level_upgrade_incentive_level_1'];
			$lu2=$rs['level_upgrade_incentive_level_2'];
			$lu3=$rs['level_upgrade_incentive_level_3'];
			$lu4=$rs['level_upgrade_incentive_level_4'];
			$lu5=$rs['level_upgrade_incentive_level_5'];
			$lu6=$rs['level_upgrade_incentive_level_6'];
			$lu7=$rs['level_upgrade_incentive_level_7'];
			$lu8=$rs['level_upgrade_incentive_level_8'];
			$lu9=$rs['level_upgrade_incentive_level_9'];
			$lu10=$rs['level_upgrade_incentive_level_10'];

			/*/////Updated on 13-04-2023*/
			
			$boosterincome=$rs['booster_income'];
	
			

		    $this->generationIncome($d['sponsorid'],0,$l1,$l2,$l3,$l4,$l5,$l6,$l7,$l8,$l9,$l10);
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
				
				$this->db->query($sql);
			}
			/*booster income*/
			$this->booster_mentor_income($d['cid'],$d['sponsorid'],$boosterincome);
           /*kjkgdfg*/
		   $this->levelUpgradeIncome($d['sponsorid'],0,$lu1,$lu2,$lu3,$lu4,$lu5,$lu6,$lu7,$lu8,$lu9,$lu10);

			//Level upgrade income end
			$sql="INSERT INTO `customer_transaction_master`(`customer_id`, `debit`, `remarks`,`activate_to`, `package_id`) VALUES ('".$userId."','".$rs['package_amount']."','Upgradation of Customer Id :".$d['cid']."','".$d['cid']."','".$d['packageId']."')";
			$this->db->query($sql);
			$w=explode("/",$d['wallet']);
			$sql="UPDATE `customer_master` SET `package_id`='".$d['packageId']."',`main_wallet`='".$rs['main_wallet']."',`digital_wallet`='".$rs['digital_wallet_value']."',`shopping_coupon_amt`='".$rs['shopping_coupon_value']."',no_of_coupon='".$rs['no_of_coupon']."', `magic_shopping_points`='".$rs['magic_shopping_points']."',`gift_product_amt`='".$rs['gift_product_amount']."',upgrade_package_request='0',status_update_date=CURRENT_TIMESTAMP() WHERE `customer_id`='".$d['cid']."'";
			$this->db->query($sql);			

			$sql="SELECT * FROM `autopool_master1` WHERE `member_id`='".$d['cid']."'";
			$this->db->query($sql);
			if($this->db->affected_rows()==0)
			{
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
			}


		}
		echo $this->db->affected_rows();
	}

	public function pendingCustomer()
	{
		$sql="SELECT *,c.package_id as pid,DATE_FORMAT(registration_date, '%d-%m-%Y %h:%i %p') as rgdate   FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE c.status='0' and c.id<>1 order by name";
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
		$sql="SELECT *,DATE_FORMAT(status_update_date, '%d-%m-%Y %h:%i %p') as rgdate  FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE c.status='2' order by name";
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
		$sql="SELECT *,DATE_FORMAT(status_update_date, '%d-%m-%Y %h:%i %p') as rgdate  FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE c.status='3' order by name";
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
		
		$userId=$this->input->post('customerid1');		
		$data['cname']=$this->input->post('custname1');
		$data['cid']=$userId;	

			$sql="SELECT * FROM autopool_master1 a INNER JOIN customer_master c on c.customer_id=a.member_id WHERE member_id='".$userId."'";
            $data['sql']=$sql;	
			$query=$this->db->query($sql);
			$data['tree']=$query->result_array();
		
			$page_name="Autopool 1 Genealogy";
			$data['page_name']="Autopool 1 Genealogy";
			$this->load->view('layouts/header');
			$this->load->view('layouts/bar');
			$this->load->view('layouts/sub-header');
			$this->load->view('layouts/nav');
			$this->load->view('autopool/autopool1geanology', $data);
			$this->load->view('layouts/footer');		
	}

	public function autopool2geanology()
	{
	
		$userId=$this->input->post('customerid2');		
		$data['cname']=$this->input->post('custname2');
		$data['cid']=$userId;		
		
		$sql="SELECT * FROM autopool_master2 a INNER JOIN customer_master c on c.customer_id=a.member_id WHERE member_id='".$userId."'";
			
		$query=$this->db->query($sql);
		$data['tree']=$query->result_array();
	
		$page_name="Autopool 2 Genealogy";
		$data['page_name']="Autopool 2 Genealogy";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('autopool/autopool2geanology', $data);
		$this->load->view('layouts/footer');
	}

	public function clubautopoolgeanology()
	{
	
		$userId=$this->input->post('customerid2');		
		$data['cname']=$this->input->post('custname2');
		$data['cid']=$userId;		
		
		$sql="SELECT * FROM  club_autopool a INNER JOIN customer_master c on c.customer_id=a.member_id WHERE member_id='".$userId."'";
			
		$query=$this->db->query($sql);
		$data['tree']=$query->result_array();
	
		$page_name="Club Autopool Genealogy";
		$data['page_name']="Club Autopool Genealogy";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('autopool/clubautopoolgeanology', $data);
		$this->load->view('layouts/footer');
	}


	public function geanology()
	{
		$userId=$this->input->post('customerid');		
		$data['cname']=$this->input->post('custname');
		$data['cid']=$userId;		

				
		$sql="SELECT * FROM `customer_master` WHERE `customer_id`='".$userId."'";
		$query=$this->db->query($sql);
		$data['profile_pic']=$query->result_array()[0]['profile_pic'];


		$sql="SELECT * FROM `customer_master` WHERE `sponsor_id`='".$userId."'";
		$query=$this->db->query($sql);
		$data['tree']=$query->result_array();
	
		$page_name="Genealogy";
		$data['page_name']="Genealogy";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('autopool/geanology', $data);
		$this->load->view('layouts/footer');
	}
	public function activationwallet()
	{
	
		$sql="SELECT *,a.id as id, DATE_FORMAT(approve_date,'%d-%m-%Y') as apdate,DATE_FORMAT(entry_date,'%d-%m-%Y') as rqdate FROM activation_wallet_recharge_details a INNER JOIN customer_master c on a.customer_id=c.customer_id WHERE a.status=0 ORDER BY `entry_date` desc";
		$query=$this->db->query($sql);
		$data['wallet']=$query->result_array();
		$data['page_name']="ADD TO ACTIVATION WALLET REQUEST";
		$data['status']=0;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/activationwallet', $data);
		$this->load->view('layouts/footer');
	}

	public function approvedwallet()
	{
	
		$sql="SELECT *, DATE_FORMAT(approve_date,'%d-%m-%Y') as apdate,DATE_FORMAT(entry_date,'%d-%m-%Y') as rqdate FROM activation_wallet_recharge_details a INNER JOIN customer_master c on a.customer_id=c.customer_id WHERE a.status=1 ORDER BY `entry_date` desc";
		$query=$this->db->query($sql);
		$data['wallet']=$query->result_array();
		$data['page_name']="APPROVED REQUEST";
		$data['status']=1;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/activationwallet', $data);
		$this->load->view('layouts/footer');
	}

	public function rejectedwallet()
	{
	
		$sql="SELECT *, DATE_FORMAT(approve_date,'%d-%m-%Y') as apdate,DATE_FORMAT(entry_date,'%d-%m-%Y') as rqdate FROM activation_wallet_recharge_details a INNER JOIN customer_master c on a.customer_id=c.customer_id WHERE a.status=2 ORDER BY `entry_date` desc";
		$query=$this->db->query($sql);
		$data['wallet']=$query->result_array();
		$data['page_name']="REJECT REQUEST";
		$data['status']=2;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/activationwallet', $data);
		$this->load->view('layouts/footer');
	}

	
	public function transferhistory()
	{
	
		$sql="SELECT DATE_FORMAT(entry_date,'%d-%m-%Y') as rqdate,CONCAT(c.name,' - ',c.customer_id) as transto,CONCAT(ct.name,' - ',ct.customer_id) as transby,a.amount FROM (activation_wallet_recharge_details a INNER JOIN customer_master c on a.customer_id=c.customer_id) INNER JOIN customer_master ct on ct.customer_id=a.transfer_by WHERE a.status=3 ORDER BY `entry_date`";
		$query=$this->db->query($sql);
		$data['wallet']=$query->result_array();
		$data['page_name']="TRANSFER HISTORY";
		$data['status']=3;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/transferhistory', $data);
		$this->load->view('layouts/footer');
	}

	public function walletapprove()
	{
		$d=$this->input->post();
		$sql="UPDATE `activation_wallet_recharge_details` SET  `approve_date`=CURRENT_TIMESTAMP(),`status`=1 where `id`='".$d['id']."'";
		
		$this->db->query($sql);
		$sql="UPDATE `customer_master` SET `activation_wallet`=`activation_wallet`+".$d['amount'].",activation_wallet_calculation_amount=activation_wallet_calculation_amount+".$d['amount'].",interest_cal_start_date=CURRENT_TIMESTAMP(),interest_calc_end_date=DATE_ADD(CURRENT_TIMESTAMP(),INTERVAL 30 DAY) where `customer_id`='".$d['cid']."'";
		$this->db->query($sql);
		echo $this->db->affected_rows();
	}

	public function payoutapprove()
	{
		$d=$this->input->post();		
		$sql="UPDATE `payout_request` SET `status`=1,`approve_date`=CURRENT_TIMESTAMP() where `id`='".$d['id']."'";
		$this->db->query($sql);
		$sql="UPDATE `customer_master` SET `main_wallet`=`main_wallet`-".$d['amount']." where `customer_id`='".$d['cid']."'";
		$this->db->query($sql);
		$sql="INSERT INTO `customer_transaction_master`(`customer_id`, `debit`,`remarks`, `tds`, `admin_charge`, `is_payout`) VALUES ('".$d['cid']."','".$d['amount']."','Payout','".$d['tds']."','".$d['admincharge']."','1')";
		$this->db->query($sql);

		echo $this->db->affected_rows();
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
	$sql="SELECT * FROM customer_master c where (c.status=0 or c.status=2) and c.customer_id='".$d['cid']."' and (c.package_id=0 or c.package_id is null)";
	$query=$this->db->query($sql);
    echo json_encode($query->result_array(),true);
}

public function manualActivation()
{
	$sql="SELECT * FROM `package_master` where `status`=1 order by `package_name` asc";
	$query=$this->db->query($sql);
	$data['package']=$query->result_array();
	$page_name="Active Customer";
	$data['page_name']="Active Customer";
	$this->load->view('layouts/header');
	$this->load->view('layouts/bar');
	$this->load->view('layouts/sub-header');
	$this->load->view('layouts/nav');
	$this->load->view('customers/manual-activation',$data);
	$this->load->view('layouts/footer');
}
public function rejectwallet()
{
	$d=$this->input->post();
	$sql="UPDATE `activation_wallet_recharge_details` SET `status`=2,`reject_reason`='".$d['reason']."' where `id`='".$d['id']."'";
	$this->db->query($sql);
	$this->db->affected_rows();
}



public function activate()
{
	$userId=$this->session->userdata('aiplStaffId');
	$d=$this->input->post();
	
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
	/*end*/

	$this->generationIncome($d['sponsorid'],0,$l1,$l2,$l3,$l4,$l5,$l6,$l7,$l8,$l9,$l10);

	$sql="INSERT INTO `customer_transaction_master`(`customer_id`, `debit`, `remarks`,`activate_to`, `package_id`) VALUES ('".$userId."','".$d['packamount']."','Activation of Customer Id :".$d['cid']."','".$d['cid']."','".$d['packageId']."')";
	$this->db->query($sql);
	$w=explode("/",$d['wallet']);
	$sql="UPDATE `customer_master` SET `package_id`='".$d['packageId']."',`main_wallet`='".$w[0]."',`digital_wallet`='".$w[1]."',`shopping_coupon_amt`='".$w[2]."',no_of_coupon='".$w[3]."', `magic_shopping_points`='".$w[4]."',`gift_product_amt`='".$w[5]."', status=1, activation_date=CURRENT_TIMESTAMP() WHERE `customer_id`='".$d['cid']."'";
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
			$this->db->query($sql);
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
	echo json_encode($this->db->affected_rows(),true);

}

	public function changestatus()
	{
		$d=$this->input->post();
		$sql="UPDATE `customer_master` SET `status`='".$d['status']."',`status_update_date`=CURRENT_TIMESTAMP() WHERE `id`='".$d['cid']."'";
		$this->db->query($sql);
		
		echo json_encode($this->db->affected_rows(),true);
	}

	public function rejectcust()
	{
		$d=$this->input->post();
		$sql="UPDATE `customer_master` SET `status`='".$d['status']."',`reject_reason`='".$d['reason']."',`status_update_date`=CURRENT_TIMESTAMP() WHERE `id`='".$d['cid']."'";
		$this->db->query($sql);
		echo json_encode($this->db->affected_rows(),true);
	}

	public function approve()
	{
		$d=$this->input->post();

		//generation income
		
		$sql="SELECT * FROM customer_master c INNER JOIN package_master p on c.package_id=p.package_id WHERE `customer_id`='".$d['cid']."'";
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
		
			//Level upgrade income start
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

		
		$sql="UPDATE `customer_master` SET  `status`='".$d['status']."',`status_update_date`=CURRENT_TIMESTAMP(), activation_date=CURRENT_TIMESTAMP() WHERE `customer_id`='".$d['cid']."'";
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
			$sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$d['sponsor_id']."','".$directippincome."','Direct IPP Sponsor Income From ".$d['cid']." (".$packname.")','2')";
			$this->db->query($sql);
		}
		

		/*booster income*/
		$this->booster_mentor_income($d['cid'],$d['sponsorid'],$boosterincome);
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
		
		echo json_encode($this->db->affected_rows(),true);
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
		else
		{
			return ;
		}
	
	}
//Level Upgrade Income
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
	public function pending_request()
	{
		$userId=$this->session->userdata('aiplUserId');	
		$sql="SELECT *,p.id as pid,DATE_FORMAT(date,'%d-%m-%Y %h:%i %p') as date FROM payout_request p INNER JOIN customer_master c on c.customer_id=p.customer_id  WHERE p.status=0  ORDER BY `date`";
		$query=$this->db->query($sql);
		$data['request']=$query->result_array();
		$data['page_name']="Pending Request";
		$data['status']=0;

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/requesthistory',$data);
		$this->load->view('layouts/footer');		
	}
	public function approved_request()
	{
		$userId=$this->session->userdata('aiplUserId');	
		$sql="SELECT *,p.id as pid,DATE_FORMAT(date,'%d-%m-%Y %h:%i %p') as date,DATE_FORMAT(approve_date,'%d-%m-%Y %h:%i %p') as adate FROM payout_request p INNER JOIN customer_master c on c.customer_id=p.customer_id  WHERE p.status=1  ORDER BY `date`";
		$query=$this->db->query($sql);
		$data['request']=$query->result_array();
		$data['page_name']="Approved Request";
		$data['status']=1;

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/requesthistory',$data);
		$this->load->view('layouts/footer');
		
	}
public function rejectupgraderequest()
{
	$d=$this->input->post();
	$sql="INSERT INTO `upgrade_request_reject`(`customer_id`, `package_id`, `reject_reason`) VALUES ('".$d['cid']."','".$d['packageid']."','".$d['reason']."')";
	$this->db->query($sql);

	$sql="UPDATE `customer_master` SET `upgrade_package_request`=0 WHERE `customer_id`='".$d['cid']."'";
	$this->db->query($sql);

	echo $this->db->affected_rows();
}
}
