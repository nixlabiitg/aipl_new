<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct() {
		error_reporting(0);
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('getcurrency_helper');
		if (!$this->session->userdata('aiplAppId')) {
			redirect('authentication/login');
		}
	}

	public function report_list() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/report-list');
		$this->load->view('layouts/footer');
	}

	
	public function view_stock()
    {
        $page_name="View Stock";
		$data['page_name']="View Stock";
		$sql="SELECT * FROM `product_master` WHERE `status`=1";
		$query=$this->db->query($sql);
		$data['stock']=$query->result_array();
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/view-stock',$data);
		$this->load->view('layouts/footer');
    }

	public function outofstock()
    {
        $page_name="Out of Stock";
		$data['page_name']="Out of Stock";
		$sql="SELECT * FROM `product_master` WHERE `status`=1 limit 10";
		$query=$this->db->query($sql);
		$data['stock']=$query->result_array();
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/outofstock',$data);
		$this->load->view('layouts/footer');
    }
	public function aristrouser()
	{
	
	
		$page_name="Aristocraf Users";
		$data['page_name']="Aristocraf Users";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
	}

    public function club_bonus()
	{
	
	
		$page_name="Club Bonus";
		$data['page_name']="Club Bonus";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
	}

    public function level_upgrade_incentive()
    {
        $page_name="Level Upgrade Incentive";
		$data['page_name']="Level Upgrade Incentive";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
    }



    public function kyc_request_by_customer()
    {
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT * FROM `kyc_master` WHERE `cust_franc_id`='".$userId."'";
		$query=$this->db->query($sql);
		$data['kyc']=$query->result_array();
		
		$data['customer_master'] = $this->Crud->ciRead("customer_master", "`customer_id` = '".$userId."'");

        $page_name="Customer KYC Request";
		$data['page_name']="Customer KYC Request";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('kyc/kycrequest',$data);
		$this->load->view('layouts/footer');
    }
    public function kyc_request_by_francise()
    {
        $page_name="Francise KYC Request";
		$data['page_name']="Francise KYC Request";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('kyc/kycrequest',$data);
		$this->load->view('layouts/footer');
    }


    public function kyc_approved_francise()
    {
        $page_name="Francise KYC Approved";
		$data['page_name']="Francise KYC Approved";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('kyc/approvedkyc',$data);
		$this->load->view('layouts/footer');
    }

    public function kyc_approved_customer()
    {
        $page_name="Customer KYC Approved";
		$data['page_name']="Customer KYC Approved";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('kyc/approvedkyc',$data);
		$this->load->view('layouts/footer');
    }

    public function service_category()
    {
        $page_name="Customer KYC Approved";
		$data['page_name']="Customer KYC Approved";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('kyc/approvedkyc',$data);
		$this->load->view('layouts/footer');
    }


	public function coupon()
    {
        
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT * FROM `customer_master` WHERE `customer_id`='".$userId."'";
		$query=$this->db->query($sql);
		$data['coupon']=$query->result_array();
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('coupons/coupons',$data);
		$this->load->view('layouts/footer');
    }

	public function rewards()
	{
		$userId=$this->session->userdata('aiplAppId');		
		$sql="SELECT *,c.product_code as pcode,TIMESTAMPDIFF(MINUTE,`create_date`,CURRENT_TIMESTAMP()) as extime,DATE_FORMAT( expiry_date,'%d-%m-%Y %h:%i %p') as expdate FROM scratch_card_master c inner join product_master p on c.product_code=p.product_code WHERE `customer_id`='".$userId."' order by create_date desc";
		$query=$this->db->query($sql);
		$data['reward']=$query->result_array();
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/rewards',$data);
		$this->load->view('layouts/footer');
	}

	public function activationreport()
	{
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT ct.*,DATE_FORMAT(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt, c.customer_id as cid,c.name as cname,p.package_name,p.package_amount FROM (customer_master c INNER JOIN customer_transaction_master ct on ct.activate_to=c.customer_id) INNER JOIN package_master p on ct.package_id=p.package_id where ct.customer_id='".$userId."' order by ct.vc_date;";
		$query=$this->db->query($sql);
		$data['actr']=$query->result_array();
		$page_name="Activation Report";
		$data['page_name']="Activation Report";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/activationreport',$data);
		$this->load->view('layouts/footer');
	}

	public function cust_coupon()
    {
        $page_name="Customer KYC Approved";
		$data['page_name']="Customer KYC Approved";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('coupons/coupons',$data);
		$this->load->view('layouts/footer');
    }

	
	public function despatched_orders()
	{
		$page_name="Despatched Orders";
		$data['page_name']="Despatched Orders";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/orders',$data);
		$this->load->view('layouts/footer');
	}
	public function delivered_orders()
	{
		$page_name="Delivered Orders";
		$data['page_name']="Delivered Orders";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/orders',$data);
		$this->load->view('layouts/footer');
	}
	public function cancelled_orders()
	{
		$page_name="Cancelled Orders";
		$data['page_name']="Cancelled Orders";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/orders',$data);
		$this->load->view('layouts/footer');
	}

	//iNCOME

	public function digitalincome()
	{
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='1' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Digital Wallet Interest";
		$data['page_name']="Digital Wallet Interest";
		$data['incomeid']=1;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function direct_ipp_income()
	{
		$incomeid=2;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
	
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Direct IPP Sponsor Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function generationincome()
	{
		$incomeid=3;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Special Generation Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function autopool1_income()
	{
		$incomeid=4;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Autopool 1 Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function autopool2_income()
	{
		$incomeid=5;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Autopool 2 Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	
	public function club_achieve_bonus()
	{
		$incomeid=6;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Club Achieve Bonus";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function level_upgrade_income()
	{
		$incomeid=7;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Level Upgrade Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function member_development_bonus()
	{
		$incomeid=8;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Member Development Bonus";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function club_autopool_income()
	{
		$incomeid=9;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Club Autopool Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function booster_income()
	{
		$incomeid=10;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Booster Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function mentor_income()
	{
		$incomeid=11;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Mentor Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function direct_point_bonus()
	{
		$incomeid=12;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Direct Point Bonus";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function direct_club_bonus()
	{
		$incomeid=13;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Direct Club Bonus";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function Rewards_and_Recognitions()
	{
		$incomeid=14;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Rewards & Recognition";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function Repurchase_Income()
	{
		$incomeid=15;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Repurchase Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function self_purchase_income()
	{
		$incomeid=21;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Self Repurchase Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function Fast_Track_Repurchase()
	{
		$incomeid=17;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Fast Track Repurchase Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function activation_wallet_benefit()
	{
		$incomeid=18;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Activation Wallet Benefits";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function benefited_b_income()
	{
		$incomeid=19;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Fast Track Benefited B Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	
	public function direct_purchase_income()
	{
		$incomeid=20;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Direct Repurchase Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function monthly_purchase_income()
	{
		$incomeid=22;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Monthly Repurchase Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function cash_back_report()
	{
		$incomeid=24;
		$userId=$this->session->userdata('aiplUserId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Cash Back Report";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function point_income()
	{
		$incomeid=23;
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Point Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function filterincome()
	{
		$userId=$this->session->userdata('aiplAppId');
		$from=$this->input->post('from');
		$to=$this->input->post('to');
		$incomeid=$this->input->post('incomeid');
		$data['from']=$from;
		$data['to']=$to;
		$data['incomeid']=$incomeid;

		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id where DATE_FORMAT(ct.vc_date,'%Y-%m-%d')>='".$from."' and DATE_FORMAT(ct.vc_date,'%Y-%m-%d') <='".$to."'  and ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date ;";
		
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$data['page_name']=$this->input->post('pagename');
		
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function pending_orders()
	{
		$userId=$this->session->userdata('aiplAppId');
		$from=$this->input->post('from');
		$to=$this->input->post('to');
		if($from)
		{
			$sql="SELECT *,om.status as ostatus,DATE_FORMAT(order_date,'%d-%m-%Y %h:%i %p') as dt FROM ((order_details o INNER JOIN order_master om on o.order_id=om.order_id) inner join product_master p on p.product_code=o.product_id) where om.user_id='".$userId."' and DATE_FORMAT(order_date,'%Y-%m-%d')>=DATE_FORMAT('".$from."','%Y-%m-%d') and DATE_FORMAT(order_date,'%Y-%m-%d')<=DATE_FORMAT('".$to."','%Y-%m-%d') order by om.order_date desc limit 50";
	
		}
		else
		{
			$sql="SELECT *,om.status as ostatus,DATE_FORMAT(order_date,'%d-%m-%Y %h:%i %p') as dt FROM ((order_details o INNER JOIN order_master om on o.order_id=om.order_id) inner join product_master p on p.product_code=o.product_id) where om.user_id='".$userId."' order by om.order_date desc limit 50";
	
		}
		$data['from']=$from;
		$data['to']=$to;

		$query=$this->db->query($sql);
		$data['order']=$query->result_array();

		
		$page_name="My Orders";
		$data['page_name']="My Orders";
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('order/pending-orders',$data);
		$this->load->view('layouts/footer');
	}

	public function customer_order_invoice(){
		extract($_POST);
		$userId=$this->session->userdata('aiplUserId');
		$data['MEMBER'] = $this->Crud->ciRead("customer_master", "`customer_id` = '$userId'");
		$data['ORDER'] = $this->Crud->ciRead("order_master", "`user_id` = '$userId' AND `order_id` = '$orderId'");
		$this->load->view('order/print-invoice',$data);
	}


	public function ordered_product()
	{
		$d=$this->input->post();
		$sql="SELECT * FROM ((order_details o LEFT JOIN product_master p on o.product_id=p.product_code) LEFT JOIN despatch_details d on d.order_id=o.order_id) LEFT JOIN franchise_master f on f.franchise_id=d.despatch_through where o.order_id='".$d['order_id']."' order by o.id";
	
		$query=$this->db->query($sql);
		echo json_encode($query->result_array(),true);
	}
	public function scratched()
	{
		$d=$this->input->post();
		$sql="UPDATE `scratch_card_master` SET `is_scratched`=1 where `id`='".$d['sid']."'";
		$this->db->query($sql);
		echo $this->db->affected_rows();
	}


	public function repurchase()
	{
		
		$userId=$this->session->userdata('aiplAppId');
		$sql="SELECT magic_shopping_points FROM `customer_master` WHERE `customer_id`='".$userId."'";
		$query=$this->db->query($sql);
		$data['mspoint']=$query->result_array()[0]['magic_shopping_points'];

		$sid=$this->input->post("sid");
		$pid=$this->input->post("productid");
		$sql="SELECT * FROM `product_master` WHERE `product_code`='".$pid."'";
		$query=$this->db->query($sql);
		$data['product']=$query->result_array();
		$page_name="Redeem";
		$data['page_name']=$page_name;
		$data['sid']=$sid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('scratchpurchase',$data);
		$this->load->view('layouts/footer');
	}


	public function placeOrder(){
		$userid = $this->session->userdata('aiplAppId');

		$d=$this->input->post();
		$totaldiscount=$d['rewarddiscount']+$d['spointdiscount'];
		$date = date('Y-m-d H:i:s');		
		$sql="INSERT INTO `order_master`(`user_id`, `order_date`, `amount`, `discount_price`,`scratchused`) VALUES ('".$userid."','".$date."','".$d['gross']."','".$totaldiscount."','1')";
		
		$this->db->query($sql);
		if($this->db->affected_rows()==1)
		{
			$sql="SELECT `order_id` FROM `order_master` WHERE `user_id`='".$userid."' and `order_date`='".$date."' and `amount`='".$d['gross']."' and `discount_price`='".$totaldiscount."'";
			$query=$this->db->query($sql);
			$orderid=$query->result_array()[0]['order_id'];
			$sql="INSERT INTO `order_details`( `order_id`, `product_id`, `qty`, `rate`) VALUES ('".$orderid."','".$d['pid']."','".$d['pqty']."','".$d['prate']."')";
			$this->db->query($sql);

			$sql="UPDATE `scratch_card_master` SET `is_used`='1' where `id`='".$d['sid']."'";
			$this->db->query($sql);

			$sql="UPDATE `customer_master` SET `magic_shopping_points`=`magic_shopping_points`-".$d['spointdiscount']." where `customer_id`='".$userid."'";
			$this->db->query($sql);

			echo $this->db->affected_rows();
		}		
		
	}

	public function my_id_card(){
		$userid = $this->session->userdata("aiplAppId");
		$data['profile'] = $this->Crud->ciRead("customer_master", "`customer_id` = '$userid'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('settings/my-id-card', $data);
		$this->load->view('layouts/footer');
	}

	public function repurchase_performance_bonus()
	{
		$incomeid=25;
		$userId=$this->session->userdata('aiplUserId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Monthly Repurchase Performance Bonus";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function direct_team_shopping_income()
	{
		$incomeid=26;
		$userId=$this->session->userdata('aiplUserId');
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id WHERE ct.income_type_id='".$incomeid."' AND ct.customer_id='".$userId."' ORDER BY ct.vc_date desc limit 100";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Direct Team Shopping Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
}
