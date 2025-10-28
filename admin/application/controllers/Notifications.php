<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifications extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAdminId')) {
			redirect('authentication/login');
		}
	}

	public function newNotification()
	{
		$sql="SELECT * FROM `user_type` WHERE `id`>1 order by `id`";
		$query=$this->db->query($sql);

		$data['utype']=$query->result_array();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('notifications/new',$data);
		$this->load->view('layouts/footer');
	}

	public function addnotification()
	{
		$d=$this->input->post();
		$sql="INSERT INTO `notifications`(`notification`, `show_until`, `user_type_id`) VALUES ('".$d['notification']."','".$d['until']."','".$d['for']."')";
		$this->db->query($sql);
		echo $this->db->affected_rows();
	}

	

	public function active()
	{
		
		$sql="SELECT *,date_format(`show_until`,'%d-%m-%Y') as ud,date_format(`added_date`,'%d-%m-%Y %h:%i %p') as ad FROM `notifications` WHERE `show_until`>=CURDATE() and status=1 order by id";
		$query=$this->db->query($sql);
		$data['NOTIFICATIONS'] =$query->result_array();
		$data['status']=1;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('notifications/active', $data);
		$this->load->view('layouts/footer');
	}

	public function inactive()
	{
		
		$sql="SELECT *,date_format(`show_until`,'%d-%m-%Y') as ud,date_format(`added_date`,'%d-%m-%Y %h:%i %p') as ad FROM `notifications` WHERE `show_until`>=CURDATE() and status=0 order by id";
		$query=$this->db->query($sql);
		$data['NOTIFICATIONS'] =$query->result_array();
		$data['status']=0;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('notifications/active', $data);
		$this->load->view('layouts/footer');
	}
	
	
	
	public function disableNotification()
	{
		if ($this->uri->segment(3)) {
			$id = $this->uri->segment(3);
			$data = [
				'status' => 0
			];
			$this->Crud->ciUpdate('notifications', $data, " `id` = '$id'");
			$this->session->set_flashdata('success', "Success");
		}
		redirect('notifications/active');
	}
	
	
}
