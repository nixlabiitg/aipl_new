<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

	 public function __construct() {

		parent::__construct();

		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->library('session');
		$this->load->model('Admin_auth');

		if ($this->session->userdata('aiplAdminId') && $this->session->userdata('aiplAdminEmail') && $this->session->userdata('aiplAdminName')) {
			if ($this->session->userdata('adrole') == '1') {
				redirect('dashboard/');
			}
		}

	 }

	public function index()
	{
		$this->load->view('login/index');
	}

	public function login()
	{
		$this->load->view('login/index');
	}

	// public function processLogin() {

	// 	$this->form_validation->set_rules('email', 'Email', 'required|trim');
	// 	$this->form_validation->set_rules('password', 'Password', 'required');

	// 	// $password = $this->encryption->encrypt($this->input->post('password'));

	// 	if ($this->form_validation->run()) {

	// 		$operatingSystem = $this->getOS();

	// 		$browser = $this->getBrowser();

	// 		$result = $this->Admin_auth->checkLogin($this->input->post('email'), $this->input->post('password'), $operatingSystem, $browser);

	// 		if ($result == '') {

	// 			redirect('dashboard/');

	// 		} else {

	// 			$this->session->set_flashdata('danger', $result);

	// 			redirect('authentication/login');

	// 		}

	// 	} else {

	// 		$this->session->set_flashdata('danger', 'Invalid credentials');

	// 		redirect('authentication/login');

	// 	}

	// }

	public function processLogin()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {

            $operatingSystem = $this->getOS();
            $browser = $this->getBrowser();

            // Check if user exists and fetch status
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->db->where('user_email', $email)->get('user_master')->row();

            // Check if user found
            if ($user) {
                // Check if blocked (status = 3)
                if ($user->status == 3) {
                    $this->session->set_flashdata('danger', 'Your account is blocked. Please contact support.');
                    redirect('authentication/login');
                    return;
                }

                // If active, check login credentials
                $result = $this->Admin_auth->checkLogin($email, $password, $operatingSystem, $browser);

                if ($result == '') {
                    redirect('dashboard/');
                } else {
                    $this->session->set_flashdata('danger', $result);
                    redirect('authentication/login');
                }
            } else {
                $this->session->set_flashdata('danger', 'Email not found.');
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
