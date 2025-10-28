<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

	 public function __construct() {

		parent::__construct();

		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->library('session');
		$this->load->model('Admin_auth');

		if ($this->session->userdata('aiplUserId') && $this->session->userdata('aiplUserEmail') && $this->session->userdata('aiplUserName')) {
			if ($this->session->userdata('role') == '2') {
				redirect('dashboard/index');
			}
		}

	 }

	public function index()
	{
		$this->load->view('user/login/index');
	}

	public function login()
	{
		$this->load->view('user/login/index');
	}


	
	public function processLogin() {

		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');

		// $password = $this->encryption->encrypt($this->input->post('password'));

		if ($this->form_validation->run()) {

			$operatingSystem = $this->getOS();

			$browser = $this->getBrowser();

			$result = $this->Admin_auth->checkLogin($this->input->post('email'), $this->input->post('password'), $operatingSystem, $browser);

			if ($result == '') {
				//digital wallet iterest 
				
				$uid=$this->session->userdata('aiplUID');
				$sql="SELECT * FROM `login_history` WHERE date_format(`login_date`,'%Y-%m-%d')=date_format(curdate(),'%Y-%m-%d') and `user_id`='".$uid."'";
				$this->db->query($sql);
				if($this->db->affected_rows()==1)
				{
					$sql="SELECT * FROM `customer_master` WHERE `status`=1 and `digital_wallet`>0 and customer_id='".$this->session->userdata('aiplUserId')."'";
					$query=$this->db->query($sql);
					$result=$query->result_array();
					foreach($result as $rs)
					{
						$interest=round($rs['digital_wallet']*12/36500,2);
						$mainwallet=$rs['main_wallet']+$interest;
						$sql="UPDATE `customer_master` SET `main_wallet`='".$mainwallet."' WHERE `customer_id`='".$rs['customer_id']."'";
						$this->db->query($sql);
						$sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,`income_type_id`) VALUES ('".$rs['customer_id']."','".$interest."','Digital Wallet Interest','1')";
						$this->db->query($sql);
					}
				}
				//digital wallet end 
				redirect('dashboard/index');

			} else {

				$this->session->set_flashdata('danger', $result);

				redirect('authentication/login');

			}

		} else {

			$this->session->set_flashdata('danger', 'Invalid credentials');

			redirect('authentication/login');

		}

	}

	public function getOS() {

		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		$os_platform  = "Unknown OS Platform";

		$os_array     = array(
							'/windows nt 10/i'      =>  'Windows 10',
							'/windows nt 6.3/i'     =>  'Windows 8.1',
							'/windows nt 6.2/i'     =>  'Windows 8',
							'/windows nt 6.1/i'     =>  'Windows 7',
							'/windows nt 6.0/i'     =>  'Windows Vista',
							'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
							'/windows nt 5.1/i'     =>  'Windows XP',
							'/windows xp/i'         =>  'Windows XP',
							'/windows nt 5.0/i'     =>  'Windows 2000',
							'/windows me/i'         =>  'Windows ME',
							'/win98/i'              =>  'Windows 98',
							'/win95/i'              =>  'Windows 95',
							'/win16/i'              =>  'Windows 3.11',
							'/macintosh|mac os x/i' =>  'Mac OS X',
							'/mac_powerpc/i'        =>  'Mac OS 9',
							'/linux/i'              =>  'Linux',
							'/ubuntu/i'             =>  'Ubuntu',
							'/iphone/i'             =>  'iPhone',
							'/ipod/i'               =>  'iPod',
							'/ipad/i'               =>  'iPad',
							'/android/i'            =>  'Android',
							'/blackberry/i'         =>  'BlackBerry',
							'/webos/i'              =>  'Mobile'
						);

		foreach ($os_array as $regex => $value)
			if (preg_match($regex, $user_agent))
				$os_platform = $value;

		return $os_platform;

	}

	public function getBrowser() {

		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		$browser        = "Unknown Browser";

		$browser_array = array(
								'/msie/i'      => 'Internet Explorer',
								'/firefox/i'   => 'Firefox',
								'/safari/i'    => 'Safari',
								'/chrome/i'    => 'Chrome',
								'/edge/i'      => 'Edge',
								'/opera/i'     => 'Opera',
								'/netscape/i'  => 'Netscape',
								'/maxthon/i'   => 'Maxthon',
								'/konqueror/i' => 'Konqueror',
								'/mobile/i'    => 'Handheld Browser'
						);

		foreach ($browser_array as $regex => $value)
			if (preg_match($regex, $user_agent))
				$browser = $value;

		return $browser;

	}

}
