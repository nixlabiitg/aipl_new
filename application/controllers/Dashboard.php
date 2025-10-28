<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}
	public function index() {
		$cnt=0;
		$userId=$this->session->userdata('aiplUserId');

		// Self purchase 1000 notification
		$sql = $this->db->query("SELECT SUM(`amount`) as total_order_value FROM `order_master` WHERE MONTH(`order_date`) = MONTH(CURRENT_DATE()) AND YEAR(`order_date`) = YEAR(CURRENT_DATE()) AND `user_id` = '".$userId."' AND `status` BETWEEN 1 AND 2");
		$details = $sql->result();
		$data['SELF_PURCHASE'] = $details[0]->total_order_value;

		//recognition	
		$sql="SELECT count(id) as cnt,cl.club_name,cl.facilities,reward_club_id FROM customer_master c RIGHT JOIN club_master cl on c.reward_club_id=cl.club_id  where reward_club_id>0 and c.customer_id='".$userId."' group by reward_club_id,cl.club_name,cl.facilities  order by reward_club_id";
		$query=$this->db->query($sql);
		$data['recognition']=$query->result_array();

		$sql="SELECT count(id) as cnt,cl.club_name,cl.facilities,c.club_id FROM customer_master c RIGHT JOIN club_master cl on c.club_id=cl.club_id  where c.club_id>3 and c.customer_id='".$userId."' group by director_club_id,cl.club_name,cl.facilities,c.club_id  order by club_id";
		$query=$this->db->query($sql);
		$data['dclub']=$query->result_array();

		$sql="SELECT count(id) as cnt,cl.club_name,cl.facilities,c.club_id FROM customer_master c RIGHT JOIN club_master cl on c.club_id=cl.club_id  where c.club_id>0 and c.customer_id='".$userId."' group by cl.club_name,cl.facilities,c.club_id  order by c.club_id";
		$query=$this->db->query($sql);
		$data['club']=$query->result_array();

		$sql="SELECT sum(credit) as income,i.income_name FROM customer_transaction_master ct right JOIN	income_type_master i on ct.income_type_id=i.income_type_id where ct.customer_id='".$userId."' group by  i.income_name,i.income_type_id order by i.income_type_id";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();

		$sql="SELECT *,c.main_wallet as wallet, c.sales_point as sp FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE `customer_id`='".$userId."'";

		$query=$this->db->query($sql);
		$result=$query->result_array();

		$sql = $this->db->query("SELECT sum(`credit`) as total_income FROM `customer_transaction_master` WHERE `customer_id` = '".$userId."'");
		$data['TOTAL_INCOME'] = $sql->result();
	
		$data['customer']=$result;
		$data['main_wallet']=($result?$result[0]['wallet']:0);
		$data['point_wallet']=($result?$result[0]['point_wallet']:0);
		$data['digital_wallet']=($result?$result[0]['digital_wallet']:0);
		$data['activation_wallet']=($result?$result[0]['activation_wallet']:0);
		$data['direct_bonus_point']=($result?$result[0]['direct_bonus_point']:0);
		$sql="SELECT magic_shopping_points FROM `customer_master` WHERE `customer_id`='".$userId."'";
		$query=$this->db->query($sql);
		$data['mspoint']=$query->result_array()[0]['magic_shopping_points'];

		$data['promotion_id'] = $result[0]['promotion_id'];
		$data['PP'] = $result[0]['sp'];
		$data['SPP'] = $result[0]['spp_sales_point'];


		$data['status']=($result?$result[0]['status']:0);
		$this->session->set_userdata('packageid', ($result?$result[0]['package_id']:0));

		$sql="SELECT *,date_format(`show_until`,'%d-%m-%Y') as ud,date_format(`added_date`,'%d-%m-%Y %h:%i %p') as ad FROM `notifications` WHERE `show_until`>=CURDATE() and status=1 and (user_type_id=2 or user_type_id=0)  order by id desc";
		$query=$this->db->query($sql);
		$data['NOTIFICATIONS'] =$query->result_array();

		$data['WEBINAR'] = $this->Crud->ciRead("webinar_master", "`id` <> '0' order by `id` desc limit 3");

		$data['profile'] = $this->Crud->ciRead("customer_master", "`customer_id` = '$userId'");
		
		if(isset($_POST['filter_payouts'])){
			$month = $_POST['payout_month'];
		}else{
			$month = date('Y-m');
		}
		
		$sql = $this->db->query("SELECT * FROM `payout_request` WHERE date_format(`approve_date`, '%Y-%m') = '$month' AND `status` = 1 AND `customer_id` = '$userId'");
		$data['PAYOUTS'] = $sql->result();
		$data['MONTH'] = $month;
		
		
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('dashboard',$data);
		$this->load->view('user/layouts/footer');
	}

	public function notifications()
	{
		
		$sql="SELECT *,date_format(`show_until`,'%d-%m-%Y') as ud,date_format(`added_date`,'%d-%m-%Y %h:%i %p') as ad FROM `notifications` WHERE `show_until`>=CURDATE() and status=1 and (user_type_id=2 or user_type_id=0)  order by id desc";
		$query=$this->db->query($sql);
		$data['NOTIFICATIONS'] =$query->result_array();
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('notifications/active', $data);
		$this->load->view('user/layouts/footer');
	
	}

	public function welcomeLetter()
	{
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header');
		$this->load->view('user/layouts/nav');
		$this->load->view('welcome-letter');
		$this->load->view('user/layouts/footer');
	
	}

	public function logout() {

		$this->session->unset_userdata('aiplUserId');
		 redirect('authentication/login');
	}

	public function visiting_card(){
		$userId=$this->session->userdata('aiplUserId');
		$data['profile'] = $this->Crud->ciRead("customer_master", "`customer_id` = '$userId'");
		$this->load->view('download-visiting-card', $data);
	}
}
