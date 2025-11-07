<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Franchise extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->helper('sms');
		error_reporting(0);
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	

	public function activeFranchise()
	{
		$sql="SELECT fm.*,DATE_FORMAT(fm.app_reject_date,'%d-%m-%Y %h:%i %p') as adate, um.customer_id, um.password FROM `franchise_master` fm JOIN user_master um ON um.customer_id = fm.franchise_id WHERE fm.`status`='1' order by name";
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
	
		$sql="SELECT *,DATE_FORMAT(u.create_date_time,'%d-%m-%Y %h:%i %p') as cdate, u.customer_id, u.password FROM franchise_master fm INNER join user_master u on fm.franchise_id=u.customer_id WHERE fm.status='0' order by name";
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
	
		$sql="SELECT *,DATE_FORMAT(app_reject_date,'%d-%m-%Y %h:%i %p') as adate, u.customer_id, u.password FROM `franchise_master` fm INNER join user_master u on fm.franchise_id=u.customer_id WHERE `status`='2' order by name";
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
			$sql="INSERT INTO `customer_transaction_master`(`customer_id`, `debit`,`remarks`,`is_payout`, `tds`, `admin_charge`) VALUES ('".$d['fid']."','".$d['amount']."','".$d['remarks']."','1','".$d['tds']."','".$d['admin_charge']."')";
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
		$d = $this->input->post();
		$pw_ = 123;
		$pwd = $this->encryption->encrypt($pw_);

		// Approve franchise
		$this->db->query("UPDATE `franchise_master` SET `status`=1 WHERE `franchise_id`='" . $d['fid'] . "'");

		// Update user password and activate account
		$this->db->query("UPDATE `user_master` SET `password`='" . $pwd . "', `status`='1' WHERE `customer_id`='" . $d['fid'] . "'");

		// SMS
		$user =	'AIPL';
		$tempid= '1707175516290192005';
		$amount = $d['package']; 
		$message="Dear user, we have successfully received an amount of ₹".$amount." as franchise registration fees - Aceaaro India Pvt. Ltd.";
		$phone = '8638828553';
		sendsms($message, $phone, $tempid);

		$sql = $this->db->query("SELECT * FROM `franchise_master` WHERE `franchise_id` = '" . $d['fid'] . "'");
		$franchise_details = $sql->result();

		$tempid2= '1707175516262586925';
		$message2="Dear user, your franchise has been successfully registered with Aceaaro India Pvt. Ltd. Welcome aboard! -Aceaaro India Pvt. Ltd.";
		sendsms($message2, $franchise_details[0]->mobile, $tempid2);

		// ------------------ Send Email ------------------
		$this->load->library('email');

		$config = array(
			'protocol'    => 'smtp',
			'smtp_host'   => 'ssl://smtp.gmail.com',
			'smtp_port'   => 465,
			'smtp_user'   => 'aceaaroindia@gmail.com',   // Gmail address
			'smtp_pass'   => 'sodrkqgkuudfojdz',         // Gmail App Password
			'mailtype'    => 'html',
			'charset'     => 'utf-8',
			'wordwrap'    => TRUE,
			'newline'     => "\r\n",
			'crlf'        => "\r\n"
		);

		$this->email->initialize($config);
		$this->email->from('aceaaroindia@gmail.com', 'Aceaaro India Pvt. Ltd.');
		$this->email->to($franchise_details[0]->email); // hardcoded for testing (can change to $result[0]->email later)
		$this->email->subject('Franchise Register');
		$this->email->message('
			<p>Dear '.$franchise_details[0]->name.',</p>
			<p>Your franchise has been successfully registered with Aceaaro India Pvt. Ltd. Welcome aboard!</p>
			<p>Thank you,<br>
			<strong>Aceaaro India Pvt. Ltd.</strong></p>
		');

		if($this->email->send()) {
			log_message('info', 'Email sent successfully to '.$result[0]->email);
		} else {
			log_message('error', 'Email failed to send to '.$result[0]->email.' Error: '.$this->email->print_debugger(['headers']));
		}

		
		// ------------------------------------------------

		// Commission percentages per level
		$commissionRates = [5, 1, 1];
		$currentReferrer = $d['referrer'];

		foreach ($commissionRates as $level => $rate) {
			if (empty($currentReferrer)) {
				break; // No more uplines
			}

			$commission = floatval($d['package']) * ($rate / 100);

			// Add commission to wallet
			$this->db->query("UPDATE `customer_master` SET `main_wallet` = `main_wallet` + $commission WHERE `customer_id`='" . $currentReferrer . "'");

			// Store transaction
			$this->Crud->ciCreate("customer_transaction_master", [
				'customer_id'    => $currentReferrer,
				'credit'         => $commission,
				'package_id'     => $d['pkgid'],
				'income_type_id' => 33,
				'remarks'        => "Level " . ($level + 1) . " commission for franchise " . $d['fid']
			]);

			// Get next upline for next loop
			$row = $this->db->query("SELECT `sponsor_id` FROM `customer_master` WHERE `customer_id`='" . $currentReferrer . "'")->row_array();
			$currentReferrer = $row['sponsor_id'] ?? null;
		}
	}


	public function update_password(){
		extract($_POST);

		$data = [
			'password' => $this->encryption->encrypt($password)
		];

		if($this->Crud->ciUpdate("user_master", $data, "`customer_id` = '$franchise_id'")){
			$this->session->set_flashdata("success", "Password updated successfully for Franchise ID: ".$franchise_id);
		}else{
			$this->session->set_flashdata("error", "Failed to update password for Franchise ID");
		}

		redirect('franchise/activeFranchise');
	}

	public function totalStock()
	{
		$page_name="Total Stock";
		$data['page_name']="Total Stock";
		$data['TotalStocks'] = $this->db->select("
			p.product_name,
			f.name AS franchise_name,
			f.id AS franchise_id,
			SUM(CASE WHEN s.stock_type = 2 THEN s.stock_out ELSE 0 END) 
				- SUM(CASE WHEN s.stock_type = 3 THEN s.stock_out ELSE 0 END) 
			AS total_stock
		")
		->from('stock_master s')
		->join('product_master p', 'p.product_id = s.product_id', 'inner')
		->join('franchise_master f', 'f.id = s.franchise_id', 'inner')
		->group_by(['s.product_id', 's.franchise_id'])
		->get()
		->result_array();

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('franchise/total-stock', $data);
		$this->load->view('layouts/footer');
	}
}
