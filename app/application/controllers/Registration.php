<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('encryption');
		error_reporting(0);
		$this->load->library('form_validation');
		$this->load->helper('sms');
	}

	function useridGenerate() {
		$str_number = "0123456789";
		$str_alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

		$userid = 'AI'.date('y').substr(str_shuffle($str_alphabet), 0, 2).substr(str_shuffle($str_number), 0, 4);
		$useridCheck = $this->Crud->ciCount("customer_master", "`customer_id` = '$userid'");
		if ($useridCheck > 0) {
			$this->useridGenerate();
		} else {
			echo $userid;
		}
	}

	public function findSponsor(){
		extract($_POST);
		$customerDetails = $this->Crud->ciCount("customer_master", "`customer_id` = '$sponsorid'");
		if($customerDetails > 0){
			$customerDetails = $this->Crud->ciRead("customer_master", "`customer_id` = '$sponsorid'");
			echo $customerDetails[0]->name;
		}else{
			echo 0;
		}
	}

	public function find_phoneno(){
		extract($_POST);
		echo $customerDetails = $this->Crud->ciCount("user_master", "`user_phone` = '$phone' AND `user_type` = '2'");	
	}

	public function find_emailid(){
		extract($_POST);
		echo $customerDetails = $this->Crud->ciCount("user_master", "`user_email` = '$email' AND `user_type` = '2'");	
	}

	public function createAccount(){
		if(isset($_POST['create_account'])){

			$this->load->helper('debug');
			extract($_POST);
	
			$ifExist = $this->Crud->ciCount("user_master", "`user_email` = '$email' OR `user_phone` = '$phone'" );

			if($ifExist > 0){
				$this->session->set_flashdata("warning", "Phone or email already exist");
				redirect('registration');
			}else{
				$data = [
					'customer_id' => $userid,
					'user_name' =>$name,
					'user_email' =>$email,
					'user_phone' =>$phone,
					'password' =>$this->encryption->encrypt($password),
					'user_type' =>2,
				];

				if($this->Crud->ciCreate("user_master", $data)){
					$findUser = $this->Crud->ciRead("user_master", "`customer_id` = '$userid' AND `user_phone` = '$phone'");

					$id = $findUser[0]->user_id;
					$this->Crud->ciCreate("customer_master", array(
						'customer_id' => $userid,
						'address' => $address,
						'name' =>$name,
						'mobile' =>$phone,
						'email' =>$email,
						'sponsor_id' =>$sponsor,
						'point_wallet' => 100,
						'nominee' => $nominee,
						'relationship' => $relationship,
						'nominee_bank_no' => $bankno,
						'nominee_bank_ifsc' => $nominee_ifsc,
						'nominee_dob' => $dobdate,
						'selected_package' => $package
					));

					 // SMS
					$tempid = '1707175516215519152';
					$message = 'Dear '.$name.', your registration is successful. Your User ID is '.$userid.' and your password is '.$password.'. Please keep them safe - Aceaaro India Pvt. Ltd.';
					sendsms($message, $phone, $tempid);
					
					// ------------------ Send Email ------------------
					$this->load->library('email');
					
					$config = array(
						'protocol'    => 'smtp',
						'smtp_host'   => 'ssl://smtp.gmail.com',
						'smtp_port'   => 465,
						'smtp_user'   => 'aceaaroindia@gmail.com',   // Gmail address
						//'smtp_user'   => 'banajyotidas@gmail.com',
						'smtp_pass'   => 'sodrkqgkuudfojdz',         // Gmail App Password
						'charset'     => 'utf-8',
						'wordwrap'    => TRUE,
						'newline'     => "\r\n",
						'crlf'        => "\r\n"
					);

					$this->email->initialize($config);
					$this->email->from('banajyotidas@gmail.com', 'Aceaaro India Pvt. Ltd.');
					$this->email->to($email);
					$this->email->subject('Registration');
					$this->email->message('
						<p>Dear '.$name.',</p>
						<p>Your Registration is successful. Your User ID is '.$userid.' and your password is '.$password.'. Please keep them safe</p>
						<p>Your Login ID: <strong>'.$userid.'</strong><br>
						Password: <strong>'.$password.'</strong></p>
						<p>Welcome aboard!<br><strong>- Aceaaro India Pvt. Ltd.</strong></p>
					');

					if(!$this->email->send()) {
							log_message('error', "Email failed to send to $email. Error: " . $this->email->print_debugger(['headers']));
						} else {
							log_message('info', "Email sent successfully to $email");
						}

					// ------------------------------------------------

					$this->session->set_flashdata("success", "**Congratulations! Your account created successfully. Your ID is <span style='color:red;'>".$userid."</span> and Password is <span style='color:red;'>".$password."</span>.");
					redirect('Authentication/login');
				}else{
					$this->session->set_flashdata("danger", "Registration Faild. Try again.");
					redirect('Authentication/register');
				}
			}
		}
	}

	public function sendOTP()
	{
		$phone = $_POST['phone'];
		$isExist = $this->Crud->ciCount('user_master', "`user_phone` = $phone");

		if($isExist > 0){

			$otp = $this->generateotp();

			$findPhoneno = $this->Crud->ciCount('otp', "`phone` = $phone");
			if ($findPhoneno > 0) {
				$this->Crud->ciUpdate('otp', array(
					'otp' => $otp,
					'phone' => $phone,
					'updated_at' => date('Y-m-d')
				), "`phone` = $phone");
				echo 1;
			} else {
				$this->Crud->ciCreate('otp', array(
					'otp' => $otp,
					'phone' => $phone
				));
				echo 0;
			}
		}else{
			echo 2;
		}
		/* otp send to mobile */
		$message = 'Dear Customer - one time password (OTP) to access registration is ' . $otp . '. Do not disclose OTP to anyone. OTECHNIX';
		$xml_data = '<?xml version="1.0"?>
		<parent>
			<child>
				<user>starspeaks</user>
				<key>8c4804e235XX</key>
				<mobile>+91' . $phone. '</mobile>
				<message>' . $message . '</message>
				<entityid>1201159162511519125</entityid>
				<tempid>1207167187189069441</tempid>
				<accusage>1</accusage>
				<senderid>OTCNIX</senderid>
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

	public function generateotp()
	{
		$str_result = '123456789';
		return substr(str_shuffle($str_result), 0, 4);
	}

	public function verifyOTP()
	{
		$phone = $_POST['phone'];
		$otp = $_POST['otp'];

		$matchOTP = $this->Crud->ciCount('otp', "`phone` = '$phone' AND `otp` = '$otp'");

		if ($matchOTP == 1) {
			$data['result'] = 'FOUND';
		} else {
			$data['result'] = 'NOT_FOUND';
		}

		echo json_encode($data);
	}

	public function changePassword(){
		$phone = $_POST['phone'];
		$password = $_POST['password'];

		$data = [
			'password' => $this->encryption->encrypt($password)
		];

		if($this->Crud->ciUpdate("user_master", $data, "`user_phone` = '$phone'")){
			echo 1;
		}else{
			echo 0;
		}
	}
}
