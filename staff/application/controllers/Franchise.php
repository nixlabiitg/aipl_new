<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Franchise extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encryption');
		if (!$this->session->userdata('aiplStaffId')) {
			redirect('authentication/login');
		}
	}

	

	public function activeFranchise()
	{
	
		$sql="SELECT *,DATE_FORMAT(app_reject_date,'%d-%m-%Y %h:%i %p') as adate FROM `franchise_master` WHERE `status`='1' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$page_name="Active Franchise";
		$data['page_name']="Active Franchise";
		$data['status']=1;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('franchise/franchise', $data);
		$this->load->view('layouts/footer');
	}

	public function pendingFranchise()
	{
	
		$sql="SELECT *,DATE_FORMAT(u.create_date_time,'%d-%m-%Y %h:%i %p') as cdate FROM franchise_master fm INNER join user_master u on fm.franchise_id=u.customer_id WHERE fm.status='0' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$data['status']=0;
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
	
		$sql="SELECT *,DATE_FORMAT(app_reject_date,'%d-%m-%Y %h:%i %p') as adate FROM `franchise_master` WHERE `status`='2' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$data['status']=2;
		$page_name="Blocked Franchise";
		$data['page_name']="Blocked Franchise";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('franchise/franchise', $data);
		$this->load->view('layouts/footer');
	}

	public function payment()
	{
		$d=$this->input->post();

		$sql="SELECT * FROM `kyc_master` WHERE `cust_franc_id`='".$d['fid']."' and status=1";
		$this->db->query($sql);

		if($this->db->affected_rows()==1)
		{
			$sql="INSERT INTO `customer_transaction_master`(`customer_id`, `debit`,`remarks`,`is_payout`) VALUES ('".$d['fid']."','".$d['amount']."','".$d['remarks']."','1')";
			$this->db->query($sql);

			$sql="UPDATE `franchise_master` SET `wallet`=`wallet`-".$d['amount']." where `franchise_id`='".$d['fid']."'";
			$this->db->query($sql);
			$this->db->affected_rows();
		}
		else
		{
			echo "d";
		}
	}

	public function rejectedFranchise()
	{	
		$sql="SELECT *,DATE_FORMAT(app_reject_date,'%d-%m-%Y %h:%i %p') as adate FROM `franchise_master` WHERE `status`='3' order by name";
		$query=$this->db->query($sql);
		$data['cust']=$query->result_array();
		$data['status']=3;
		$page_name="Rejected Franchise";
		$data['page_name']="Rejected Franchise";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('franchise/franchise', $data);
		$this->load->view('layouts/footer');
	}

	public function reject_block_francise()
	{
		$d=$this->input->post();
		
		$sql="UPDATE `franchise_master` SET `status`='".$d['status']."',`app_reject_date`=CURRENT_TIMESTAMP(),`reject_reason`='".$d['reason']."' WHERE `franchise_id`='".$d['fid']."'";
		$this->db->query($sql);
		$sql="UPDATE `user_master` SET `status`='".$d['status']."' WHERE `customer_id`='".$d['fid']."'";
		$this->db->query($sql);
		echo json_encode($this->db->affected_rows(),true);
	}

	public function approve_francise()
	{
		$d=$this->input->post();
		$pw_=rand(1111,9999);
		$pwd=$this->encryption->encrypt($pw_);
	
		$sql="UPDATE `franchise_master` SET `status`=1 WHERE `franchise_id`='".$d['fid']."'";
		$this->db->query($sql);
		$sql="UPDATE `user_master` SET `password`='".$pwd."',`status`='1' WHERE `customer_id`='".$d['fid']."'";
		$this->db->query($sql);
		/* otp send to mobile */
		$message="Congratulation, you have successfully registered  to CODE-HIVE INSTITUTION . Your course id is ".$d['fid']." against reg. no ".$pw_.". OTECHNIX";
		$xml_data = '<?xml version="1.0"?>
				<parent>
					<child>
						<user>starspeaks</user>
						<key>8c4804e235XX</key>
						<mobile>+91'.$d['phone'].'</mobile>
						<message>'.$message.'</message>
						<entityid>1201159162511519125</entityid>
						<tempid>1207165674690020335</tempid>
						<accusage>1</accusage>
						<senderid>CODEHV</senderid>
					</child>
				</parent>';
		$URL = "http://sms.otechnonix.in/submitsms.jsp?";


		
	   $ch = curl_init($URL);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
	}

	
}
