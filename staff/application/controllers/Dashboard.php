<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplStaffId')) {
			redirect('authentication/login');
		}
	}

	public function index() {
		$pendingcust=0;
		$pendingamt=0;
		$approvecust=0;
		$approveamt=0;
		$rejectcust=0;
		$rejectamt=0;
		$sql="SELECT count(id) as cnt,sum(p.package_amount) as pamt, c.status FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id group by c.status";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		foreach($result as $rs)
		{
			if($rs['status']==0) 
			{
				$pendingcust=$rs['cnt'];
				$pendingamt=$rs['pamt'];
			}
			if($rs['status']==2) 
			{
				$rejectcust=$rs['cnt'];
				$rejectamt=$rs['pamt'];
			}
			else if($rs['status']==1) 
			{
				$approvecust=$rs['cnt'];
				$approveamt=$rs['pamt'];
			}
		}
		$data['apcust']=$approvecust;
		$data['pencust']=$pendingcust;
		$data['pamt']=$pendingamt;
		$data['aamt']=$approveamt;

		$data['rejcust']=$pendingcust;
		$data['ramt']=$pendingamt;
		//Franchise
		$fpending=0;
		$fapprove=0;
		$freject=0;
		$sql="SELECT count(id) as cnt,status FROM `franchise_master` group by status";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		foreach($result as $rs)
		{
			if($rs['status']==0) 
			{
				$fpending=$rs['cnt'];
			
			}
			else if($rs['status']==1) 
			{
				$fapprove=$rs['cnt'];
			
			}
			else
			{
				$freject=$rs['cnt'];
			
			}
		}
		$data['fpending']=$fpending;
		$data['fapprove']=$fapprove;
		$data['freject']=$freject;
		//package
		$sql="SELECT count(c.package_id) as cnt,p.package_name FROM package_master p LEFT JOIN customer_master c on p.package_id=c.package_id WHERE c.status=1 group by p.package_name,p.package_amount order by p.package_amount";
		$query=$this->db->query($sql);
		$data['package']=$query->result_array();

		//club
		$green=0;
		$yellow=0;
		$red=0;

		$sql="SELECT count(id) as cnt,club_id FROM customer_master  where club_id>0 and sponsor_id<>'0' group by club_id";
		$query=$this->db->query($sql);
		$club=$query->result_array();
		foreach($club as $cl)
		{
			if($cl['club_id']==1) $green=$cl['cnt'];
			else if($cl['club_id']==2) $red=$cl['cnt'];
			else $yellow=$cl['cnt'];
		}
		$data['green']=$green;
		$data['red']=$red;
		$data['yellow']=$yellow;

		//director club
		$adirector=0;
		$director=0;
		$sdirector=0;

		$sql="SELECT count(id) as cnt,club_id FROM customer_master  where club_id>3 and sponsor_id<>'0'  group by club_id";
		$query=$this->db->query($sql);
		$club=$query->result_array();
		foreach($club as $cl)
		{
			if($cl['club_id']==4) $adirector=$cl['cnt'];
			else if($cl['club_id']==5) $director=$cl['cnt'];
			else $sdirector=$cl['cnt'];
		}
		$data['adirector']=$adirector;
		$data['director']=$director;
		$data['sdirector']=$sdirector;
		//recognition	
		$sql="SELECT count(id) as cnt,cl.club_name,cl.facilities,reward_club_id FROM customer_master c RIGHT JOIN club_master cl on c.reward_club_id=cl.club_id  where reward_club_id>0 group by reward_club_id,cl.club_name,cl.facilities order by reward_club_id";
		$query=$this->db->query($sql);
		$data['recognition']=$query->result_array();
		
		$sql="SELECT sum(main_wallet) as mwallet,sum(digital_wallet) as dwallet,sum(point_wallet) as pwallet,sum(activation_wallet) as awallet FROM `customer_master` WHERE status=1 and id<>1";
		$query=$this->db->query($sql);
		$data['wallet']=$query->result_array();

		//payout
		$sql="SELECT sum(debit) as amt FROM customer_transaction_master ct INNER JOIN franchise_master f on ct.customer_id=f.franchise_id";
		$query=$this->db->query($sql);
		$data['fpayout']=$query->result_array()[0]['amt'];
		$sql="SELECT sum(debit) as amt FROM customer_transaction_master ct INNER JOIN customer_master c on ct.customer_id=c.customer_id";
		$query=$this->db->query($sql);
		$data['cpayout']=$query->result_array()[0]['amt'];

		//payout request
		$prequest=0;
		$papprove=0;
		$sql="SELECT sum(request_amount) as ramount,status FROM `payout_request` group by status";
		$query=$this->db->query($sql);
		$result=$query->result_array();
		foreach($result as $rs)
		{
			if($rs['status']==0) $prequest=$rs['ramount'];
			else if($rs['status']==1) $papprove=$rs['ramount'];
		}
		$data['prequest']=$prequest;
		$data['papprove']=$papprove;

		$sql="SELECT sum(credit) as income,i.income_name FROM customer_transaction_master ct right JOIN	income_type_master i on ct.income_type_id=i.income_type_id group by i.income_name,i.income_type_id order by i.income_type_id";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();

		$sql="SELECT sum(credit) as income,i.income_name FROM customer_transaction_master ct right JOIN	income_type_master i on ct.income_type_id=i.income_type_id group by i.income_name,i.income_type_id order by i.income_type_id";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		// 11-05-2023
		$awallet=0;
		$sql="SELECT count(id) as cnt FROM `activation_wallet_recharge_details` WHERE `status`=0";
		$query=$this->db->query($sql);
		$awallet=$query->result_array()[0]['cnt'];
		$data['awallet']=$awallet;

		$payout=0;
		$sql="SELECT count(`id`) as cnt FROM `payout_request` WHERE `status`=0";
		$query=$this->db->query($sql);
		$payout=$query->result_array()[0]['cnt'];
		$data['payout']=$payout;

		$ugrequest=0;
		$sql="SELECT count(id) as cnt FROM `customer_master` WHERE `upgrade_package_request`>0";
		$query=$this->db->query($sql);
		$ugrequest=$query->result_array()[0]['cnt'];
		$data['ugrequest']=$ugrequest;

		$porder=0;
		$sql="SELECT count(`order_id`) as cnt  FROM order_master  where status=0";
		$query=$this->db->query($sql);
		$porder=$query->result_array()[0]['cnt'];
		$data['porder']=$porder;

		$pservice=0;
		$sql="SELECT count(`id`) as cnt FROM `service_master` WHERE `status`=1";
		$query=$this->db->query($sql);
		$pservice=$query->result_array()[0]['cnt'];
		$data['pservice']=$pservice;

		$ckyc=0;
		$sql="SELECT count(k.id) as cnt FROM kyc_master k INNER JOIN customer_master c on c.customer_id=k.cust_franc_id where k.status=0";
		$query=$this->db->query($sql);
		$ckyc=$query->result_array()[0]['cnt'];
		$data['ckyc']=$ckyc;

		$fkyc=0;
		$sql="SELECT count(k.id) as cnt FROM kyc_master k INNER JOIN franchise_master c on c.franchise_id=k.cust_franc_id where k.status=0";
		$query=$this->db->query($sql);
		$fkyc=$query->result_array()[0]['cnt'];
		$data['fkyc']=$fkyc;

		


		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('dashboard',$data);
		$this->load->view('layouts/footer');
	}

	

	public function logout() {
		$this->session->unset_userdata('aiplStaffId');
		 redirect('authentication/login');
	}
	public function club_members()
	{
		$clubid=$this->input->post('club_id');
		$sql="SELECT * FROM customer_master c INNER JOIN package_master p on c.package_id=p.package_id  WHERE `club_id`='".$clubid."' order by `name`";
		$query=$this->db->query($sql);
		$data['club']=$query->result_array();
		$data['page_name']=($clubid==1?"GREEN CLUB":($clubid==2?"RED CLUB":"YELLOW CLUB"));
		

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/clubmembers',$data);
		$this->load->view('layouts/footer');
		
	}
	public function director_club_members()
	{
		$clubid=$this->input->post('dclub_id');
		$sql="SELECT * FROM customer_master c INNER JOIN package_master p on c.package_id=p.package_id  WHERE `club_id`='".$clubid."' order by `name`";
		$query=$this->db->query($sql);
		$data['club']=$query->result_array();
		$data['page_name']=($clubid==4?"Assistant Director":($clubid==5?"Director":"Senior Director"));
		
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/clubmembers',$data);
		$this->load->view('layouts/footer');
	}
	public function recog_members()
	{
		$clubid=$this->input->post('rclub_id');
		$sql="SELECT * FROM customer_master c INNER JOIN package_master p on c.package_id=p.package_id  WHERE `reward_club_id`='".$clubid."' order by `name`";
		$query=$this->db->query($sql);
		$data['club']=$query->result_array();
		$data['page_name']=$this->input->post('rclub_name');		

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('customers/clubmembers',$data);
		$this->load->view('layouts/footer');
	}
}
