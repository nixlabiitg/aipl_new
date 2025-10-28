<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct() {
		error_reporting(0);
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplStaffId')) {
			redirect('authentication/login');
		}
	}

	

	public function aristrouser()
	{
	
	
		$page_name="Aristocraf Users";
		$data['page_name']="Aristocraf Users";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
	}

    public function club_bonus()
	{
	
	
		$page_name="Club Bonus";
		$data['page_name']="Club Bonus";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
	}

    public function level_upgrade_incentive()
    {
        $page_name="Level Upgrade Incentive";
		$data['page_name']="Level Upgrade Incentive";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
    }


    public function Director_Club_Bonus()
    {
        $page_name="Director Club Bonus";
		$data['page_name']="Director Club Bonus";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
    }




    public function Direct_Sponsor_Income()
    {
        $page_name="Direct Sponsor Income";
		$data['page_name']="Direct Sponsor Income";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
    }


    public function Wallet_Benefits_Report()
    {
        $page_name="Wallet Benefits Report";
		$data['page_name']="Wallet Benefits Report";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
    }

    
    public function Service_Query_Report()
    {
        $page_name="Service Query Report";
		$data['page_name']="Service Query Report";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
    }

    public function kyc_request_by_customer()
    {
		$sql="SELECT *,k.id as kid ,DATE_FORMAT(`status_date`,'%d-%m-%Y %h:%i %p') as adate FROM kyc_master k INNER JOIN customer_master c on c.customer_id=k.cust_franc_id where k.status=0";
		$query=$this->db->query($sql);
		$data['kyc']=$query->result_array();
        $page_name="Customer KYC Request";
		$data['page_name']="Customer KYC Request";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('kyc/kycrequest',$data);
		$this->load->view('layouts/footer');
    }
    public function kyc_request_by_francise()
    {
		$sql="SELECT *,k.id as kid,DATE_FORMAT(`status_date`,'%d-%m-%Y %h:%i %p') as adate FROM kyc_master k INNER JOIN franchise_master f on k.cust_franc_id=f.franchise_id where k.status=0";
		$query=$this->db->query($sql);
		$data['kyc']=$query->result_array();

        $page_name="Franchise KYC Request";
		$data['page_name']="Franchise KYC Request";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('kyc/kycrequest',$data);
		$this->load->view('layouts/footer');
    }


    public function kyc_approved_francise()
    {
		$sql="SELECT *,k.id as kid,DATE_FORMAT(`status_date`,'%d-%m-%Y %h:%i %p') as adate FROM kyc_master k INNER JOIN franchise_master f on k.cust_franc_id=f.franchise_id where k.status=1";
		$query=$this->db->query($sql);
		$data['kyc']=$query->result_array();

        $page_name="Franchise KYC Approved";
		$data['page_name']="Franchise KYC Approved";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('kyc/approvedkyc',$data);
		$this->load->view('layouts/footer');
    }
	public function kyc_rejected_francise()
    {
		$sql="SELECT *,k.id as kid,DATE_FORMAT(`status_date`,'%d-%m-%Y %h:%i %p') as adate FROM kyc_master k INNER JOIN franchise_master f on k.cust_franc_id=f.franchise_id where k.status=2";
		$query=$this->db->query($sql);
		$data['kyc']=$query->result_array();

        $page_name="Franchise KYC Rejected";
		$data['page_name']="Franchise KYC Rejected";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('kyc/approvedkyc',$data);
		$this->load->view('layouts/footer');
    }

	public function activationreport()
	{
		$sql="SELECT ct.*,DATE_FORMAT(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt, c.customer_id as cid,c.name as cname,p.package_name,p.package_amount,CONCAT(cm.name,' - ',cm.customer_id) as activatedby FROM ((customer_master c INNER JOIN customer_transaction_master ct on ct.activate_to=c.customer_id) INNER JOIN package_master p on ct.package_id=p.package_id) INNER JOIN customer_master cm on ct.customer_id=cm.customer_id order by ct.vc_date";
		 $query=$this->db->query($sql);
		$data['actr']=$query->result_array();
		$page_name="Activation Report";
		$data['page_name']="Activation Report";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/activationreport',$data);
		$this->load->view('layouts/footer');
	}

	public function digitalincome()
	{
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='1' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Digital Wallet Interest";
		$data['page_name']="Digital Wallet Interest";
		$data['incomeid']=1;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function direct_ipp_income()
	{
		$incomeid=2;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Direct IPP Sponsor Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function generationincome()
	{
		$incomeid=3;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Special Generation Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function autopool1_income()
	{
		$incomeid=4;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Autopool 1 Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function autopool2_income()
	{
		$incomeid=5;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Autopool 2 Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	
	public function club_achieve_bonus()
	{
		$incomeid=6;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Club Achieve Bonus";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function level_upgrade_income()
	{
		$incomeid=7;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Level Upgrade Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function member_development_bonus()
	{
		$incomeid=8;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Member Development Bonus";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function club_autopool_income()
	{
		$incomeid=9;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Club Autopool Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function booster_income()
	{
		$incomeid=10;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Booster Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function mentor_income()
	{
		$incomeid=11;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Mentor Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function direct_point_bonus()
	{
		$incomeid=12;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Direct Point Bonus";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function direct_club_bonus()
	{
		$incomeid=13;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Direct Club Bonus";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function Rewards_and_Recognitions()
	{
		$incomeid=14;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Rewards & Recognition";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function Repurchase_Income()
	{
		$incomeid=15;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Repurchase Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}


	public function Fast_Track_Repurchase()
	{
		$incomeid=17;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Fast Track Repurchase Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function activation_wallet_benefit()
	{
		$incomeid=18;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Activation Wallet Benefits";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function benefited_b_income()
	{
		$incomeid=19;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Fast Track Benefited B Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	
	public function direct_purchase_income()
	{
		$incomeid=20;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Direct Repurchase Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function self_purchase_income()
	{
		$incomeid=21;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Self Repurchase Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
	public function monthly_purchase_income()
	{
		$incomeid=22;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Monthly Repurchase Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function point_income()
	{
		$incomeid=23;
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Point Income";
		$data['page_name']=$page_name;
		$data['incomeid']=$incomeid;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function filterincome()
	{
		$from=$this->input->post('from');
		$to=$this->input->post('to');
		$incomeid=$this->input->post('incomeid');
		$data['from']=$from;
		$data['to']=$to;
		$data['incomeid']=$incomeid;

		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id where DATE_FORMAT(ct.vc_date,'%Y-%m-%d')>='".$from."' and DATE_FORMAT(ct.vc_date,'%Y-%m-%d') <='".$to."'  and ct.income_type_id='".$incomeid."' ORDER BY ct.vc_date ;";
		
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$data['page_name']=$this->input->post('pagename');
		
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}

	public function kyc_approved_customer()
    {
		$sql="SELECT *,k.id as kid,DATE_FORMAT(`status_date`,'%d-%m-%Y %h %m %p') as adate FROM kyc_master k INNER JOIN customer_master c on k.cust_franc_id=c.customer_id where k.status=1";
		$query=$this->db->query($sql);
		$data['kyc']=$query->result_array();
        $page_name="Customer KYC Approved";
		$data['page_name']="Customer KYC Approved";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('kyc/approvedkyc',$data);
		$this->load->view('layouts/footer');
    }
    public function kyc_rejected_customer()
    {
		$sql="SELECT *,k.id as kid,DATE_FORMAT(`status_date`,'%d-%m-%Y %h %m %p') as adate FROM kyc_master k INNER JOIN customer_master c on k.cust_franc_id=c.customer_id where k.status=2";
		$query=$this->db->query($sql);
		$data['kyc']=$query->result_array();
        $page_name="Customer KYC Rejected";
		$data['page_name']="Customer KYC Rejected";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('kyc/approvedkyc',$data);
		$this->load->view('layouts/footer');
    }

    public function service_category()
    {
        $page_name="Customer KYC Approved";
		$data['page_name']="Customer KYC Approved";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('kyc/approvedkyc',$data);
		$this->load->view('layouts/footer');
    }


	public function coupon()
    {
        $sql="SELECT * FROM `customer_master` where status=1 ORDER BY `status_update_date` ";
	    $query=$this->db->query($sql);
		$data['coupon']=$query->result_array();
		
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('coupons/allcoupons',$data);
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
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
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
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/outofstock',$data);
		$this->load->view('layouts/footer');
    }
	public function cust_coupon()
    {
        $page_name="Customer KYC Approved";
		$data['page_name']="Customer KYC Approved";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('coupons/coupons',$data);
		$this->load->view('layouts/footer');
    }

	public function pending_orders()
	{
		
		$from=$this->input->post('from');
		$to=$this->input->post('to');
		if($from)
		{
			$sql="SELECT *,(o.amount-o.discount_price) as amt,DATE_FORMAT(order_date,'%d-%m-%Y %h:%i %p') as dt FROM order_master o INNER JOIN customer_master c on o.user_id=c.customer_id where o.status=0 and DATE_FORMAT(order_date,'%Y-%m-%d')>=DATE_FORMAT('".$from."','%Y-%m-%d') and DATE_FORMAT(order_date,'%Y-%m-%d')<=DATE_FORMAT('".$to."','%Y-%m-%d') order by o.order_date";
	
		}
		else
		{
		   $sql="SELECT *,(o.amount-o.discount_price) as amt,DATE_FORMAT(order_date,'%d-%m-%Y %h:%i %p') as dt FROM order_master o INNER JOIN customer_master c on o.user_id=c.customer_id where o.status=0 order by o.order_date";
			
		}
		$data['from']=$from;
		$data['to']=$to;

		$query=$this->db->query($sql);
		$data['order']=$query->result_array();

		$sql="SELECT * FROM `franchise_master` WHERE `status`=1";
		$query=$this->db->query($sql);
		$data['franchise']=$query->result_array();

		$page_name="Pending Orders";
		$data['page_name']="Pending Orders";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('order/pending-orders',$data);
		$this->load->view('layouts/footer');
	}
	
	public function despatched_orders()
	{
		
		$from=$this->input->post('from');
		$to=$this->input->post('to');
		if($from)
		{
			$sql="SELECT *,c.mobile as cmobile,c.name as cname,f.name as fname,(o.amount-o.discount_price) as amt,DATE_FORMAT(order_date,'%d-%m-%Y %h:%i %p') as dt,DATE_FORMAT(d.despatch_date,'%d-%m-%Y %h:%i %p') as ddt  FROM ((order_master o INNER JOIN customer_master c on o.user_id=c.customer_id) INNER JOIN despatch_details d on d.order_id=o.order_id) INNER JOIN franchise_master f on d.despatch_through=f.franchise_id where o.status=1 and DATE_FORMAT(despatch_date,'%Y-%m-%d')>=DATE_FORMAT('".$from."','%Y-%m-%d') and DATE_FORMAT(despatch_date,'%Y-%m-%d')<=DATE_FORMAT('".$to."','%Y-%m-%d') order by d.despatch_date";
	
		}
		else
		{
			$sql="SELECT *,c.mobile as cmobile,c.name as cname,f.name as fname,(o.amount-o.discount_price) as amt,DATE_FORMAT(order_date,'%d-%m-%Y %h:%i %p') as dt,DATE_FORMAT(d.despatch_date,'%d-%m-%Y %h:%i %p') as ddt  FROM ((order_master o INNER JOIN customer_master c on o.user_id=c.customer_id) INNER JOIN despatch_details d on d.order_id=o.order_id) INNER JOIN franchise_master f on d.despatch_through=f.franchise_id where o.status=1 order by d.despatch_date";
		
		}

		$data['from']=$from;
		$data['to']=$to;

		$query=$this->db->query($sql);
		$data['order']=$query->result_array();

		$sql="SELECT * FROM `franchise_master` WHERE `status`=1";
		$query=$this->db->query($sql);
		$data['franchise']=$query->result_array();

		$page_name="Despatched Orders";
		$data['page_name']="Despatched Orders";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('order/despatch-orders',$data);
		$this->load->view('layouts/footer');
		
	}

	public function delivered_orders()
	{
		
		$from=$this->input->post('from');
		$to=$this->input->post('to');
		if($from)
		{
			$sql="SELECT *,c.mobile as cmobile,c.name as cname,f.name as fname,(o.amount-o.discount_price) as amt,DATE_FORMAT(order_date,'%d-%m-%Y %h:%i %p') as dt,DATE_FORMAT(d.delivery_date,'%d-%m-%Y %h:%i %p') as ddt  FROM ((order_master o INNER JOIN customer_master c on o.user_id=c.customer_id) INNER JOIN despatch_details d on d.order_id=o.order_id) INNER JOIN franchise_master f on d.despatch_through=f.franchise_id where o.status=2 and DATE_FORMAT(delivery_date,'%Y-%m-%d')>=DATE_FORMAT('".$from."','%Y-%m-%d') and DATE_FORMAT(delivery_date,'%Y-%m-%d')<=DATE_FORMAT('".$to."','%Y-%m-%d') order by d.delivery_date";
			// $sql="call delorders('".$from."','".$to."')"; //Procedure
	
		}
		else
		{
			$sql="SELECT *,c.mobile as cmobile,c.name as cname,f.name as fname,(o.amount-o.discount_price) as amt,DATE_FORMAT(order_date,'%d-%m-%Y %h:%i %p') as dt,DATE_FORMAT(d.delivery_date,'%d-%m-%Y %h:%i %p') as ddt  FROM ((order_master o INNER JOIN customer_master c on o.user_id=c.customer_id) INNER JOIN despatch_details d on d.order_id=o.order_id) INNER JOIN franchise_master f on d.despatch_through=f.franchise_id where o.status=2 order by d.delivery_date";
			// $sql="call delorders()"; //Procedure
	
		}
		$data['from']=$from;
		$data['to']=$to;

		$query=$this->db->query($sql);
		$data['order']=$query->result_array();

		// $sql="SELECT * FROM `franchise_master` WHERE `status`=1";
		// $query=$this->db->query($sql);
		// $data['franchise']=$query->result_array();

		$page_name="Delivered Orders";
		$data['page_name']="Delivered Orders";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('order/delivered-orders',$data);
		$this->load->view('layouts/footer');
	}

	public function ordered_product()
	{
		$d=$this->input->post();
		$sql="SELECT * FROM order_details o INNER JOIN product_master p on o.product_id=p.product_code where o.order_id='".$d['order_id']."' order by o.id";
		$query=$this->db->query($sql);
		echo json_encode($query->result_array(),true);
	}

	public function despatch()
	{
		$userId=$this->session->userdata('aiplStaffId');
		$d=$this->input->post();
		$sql="UPDATE `order_master` SET `status`=1 where `order_id`='".$d['orderid']."'";
		$this->db->query($sql);

		$sql="INSERT INTO `despatch_details`(`order_id`, `despatch_through`, `remarks`, `despatch_by`) VALUES ('".$d['orderid']."','".$d['despatch_through']."','".$d['remarks']."','".$userId."')";
		$this->db->query($sql);

		echo $this->db->affected_rows();

	}
	
	
	public function cancelled_orders()
	{
		$page_name="Cancelled Orders";
		$data['page_name']="Cancelled Orders";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/orders',$data);
		$this->load->view('layouts/footer');
	}

	public function approve_reject()
	{
		$d=$this->input->post();
		$sql="UPDATE `kyc_master` SET `status`='".$d['status']."' WHERE `id`='".$d['id']."'";
		$this->db->query($sql);
		echo json_encode($this->db->affected_rows(),true);
	}

	public function franchise_payout()
	{
	
		$sql="SELECT * FROM `franchise_master` where wallet>0 order by `name`";
		$query=$this->db->query($sql);
		$data['franchise']=$query->result_array();
		$data['page_name']="Franchise Payout";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('franchise/franchisepayout', $data);
		$this->load->view('layouts/footer');
	}

	public function transaction_history_franchise()
	{
		$userId=$this->session->userdata('aiplFranchiseId');		
		$from=$this->input->post('from');
		$to=$this->input->post('to');
		
		if($from)
		{
			$sql="SELECT *,c.id as vcid,DATE_FORMAT(vc_date,'%d-%m-%Y %h:%i %p') as dt FROM customer_transaction_master c INNER JOIN franchise_master f on c.customer_id=f.franchise_id  where DATE_FORMAT(vc_date,'%Y-%m-%d')>=DATE_FORMAT('".$from."','%Y-%m-%d') and DATE_FORMAT(vc_date,'%Y-%m-%d')<=DATE_FORMAT('".$to."','%Y-%m-%d') order by vc_date";
		}
		else
		{
			$sql="SELECT *,c.id as vcid,DATE_FORMAT(vc_date,'%d-%m-%Y %h:%i %p') as dt FROM customer_transaction_master c INNER JOIN franchise_master f on c.customer_id=f.franchise_id   order by vc_date limit 100";
		}
		// var_dump($sql);
		// return;
		$data['from']=$from;
		$data['to']=$to;

		$query=$this->db->query($sql);
		$data['order']=$query->result_array();

		

		$page_name="Transaction History";
		$data['page_name']="Transaction History";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/wallet-history',$data);
		$this->load->view('layouts/footer');
	}
	public function franchise_reprt()
	{
		$sql="SELECT *,date_format(ct.vc_date,'%d-%m-%Y %h:%i %p') as dt FROM (customer_master c INNER JOIN customer_transaction_master ct on c.customer_id=ct.customer_id) INNER JOIN package_master p on c.package_id=p.package_id and ct.income_type_id='1' ORDER BY ct.vc_date desc limit 100;";
		$query=$this->db->query($sql);
		$data['income']=$query->result_array();
		$page_name="Digital Wallet Interest";
		$data['page_name']="Digital Wallet Interest";
		$data['incomeid']=1;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/incomereport',$data);
		$this->load->view('layouts/footer');
	}
}
