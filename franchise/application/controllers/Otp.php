<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Otp extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		$this->load->library('encryption');
	}

	// OTP VERIFICATION
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