<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct() {
		error_reporting(0);
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplFranchiseId')) {
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


    public function Club_Autopool_Income()
    {
        $page_name="Club Autopool Income";
		$data['page_name']="Club Autopool Income";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
    }




    public function Member_Development_Bonus()
    {
        $page_name="Member Development Bonus";
		$data['page_name']="Member Development Bonus";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
    }

    public function Booster_Income()
    {
        $page_name="Booster Income";
		$data['page_name']="Booster Income";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
    }

    public function Mentor_Income()
    {
        $page_name="Mentor Income";
		$data['page_name']="Mentor Income";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
    }


    public function Direct_Point_Bonus()
    {
        $page_name="Direct Point Bonus";
		$data['page_name']="Direct Point Bonus";
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



    public function Rewards_and_Recognitions()
    {
        $page_name="Rewards and Recognitions";
		$data['page_name']="Rewards and Recognitions";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
    }

    public function Repurchase_Income()
    {
        $page_name="Repurchase Income";
		$data['page_name']="Repurchase Income";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
    }


    public function Team_Repurchase_Income()
    {
        $page_name="Team Repurchase Income";
		$data['page_name']="Team Repurchase Income";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/report',$data);
		$this->load->view('layouts/footer');
    }


    public function Fast_Track_Repurchase()
    {
        $page_name="Fast Track Repurchase";
		$data['page_name']="Fast Track Repurchase";
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

    // public function kyc_request_by_customer()
    // {
    //     $page_name="Customer KYC Request";
	// 	$data['page_name']="Customer KYC Request";
	// 	$this->load->view('layouts/header');
	// 	$this->load->view('layouts/bar');
	// 	$this->load->view('layouts/sub-header');
	// 	$this->load->view('layouts/nav');
	// 	$this->load->view('kyc/kycrequest',$data);
	// 	$this->load->view('layouts/footer');
    // }
    public function kyc_request_by_francise()
    {
		$userId=$this->session->userdata('aiplFranchiseId');
		$sql="SELECT * FROM `kyc_master` WHERE `cust_franc_id`='".$userId."'";
		$query=$this->db->query($sql);
		$data['kyc']=$query->result_array();

		$data['customer_master'] = $this->Crud->ciRead("franchise_master", "`franchise_id` = '".$userId."'");

        $page_name="Customer KYC Request";
		$data['page_name']="Customer KYC Request";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('kyc/kycrequest',$data);
		$this->load->view('layouts/footer');
    }


    public function kyc_approved_francise()
    {
        $page_name="Francise KYC Approved";
		$data['page_name']="Francise KYC Approved";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('kyc/approvedkyc',$data);
		$this->load->view('layouts/footer');
    }

    public function kyc_approved_customer()
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
        // $page_name="Customer KYC Approved";
		// $data['page_name']="Customer KYC Approved";
		
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

	
	public function despatched_orders()
	{
		$page_name="Despatched Orders";
		$data['page_name']="Despatched Orders";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('report/orders',$data);
		$this->load->view('layouts/footer');
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

	public function pending_orders()
	{
		$userId=$this->session->userdata('aiplFranchiseId');		
		$from=$this->input->post('from');
		$to=$this->input->post('to');
		if($from)
		{
				$sql="SELECT *,(o.amount-o.discount_price) as amt,DATE_FORMAT(despatch_date,'%d-%m-%Y %h:%i %p') as dt FROM (order_master o INNER JOIN customer_master c on o.user_id=c.customer_id) INNER JOIN despatch_details d on o.order_id=d.order_id where d.despatch_through='".$userId."' and o.status=1 and DATE_FORMAT(despatch_date,'%Y-%m-%d')>=DATE_FORMAT('".$from."','%Y-%m-%d') and DATE_FORMAT(despatch_date,'%Y-%m-%d')<=DATE_FORMAT('".$to."','%Y-%m-%d') order by order_date";

		}
		else
		{
			$sql="SELECT *,(o.amount-o.discount_price) as amt,DATE_FORMAT(despatch_date,'%d-%m-%Y %h:%i %p') as dt FROM (order_master o INNER JOIN customer_master c on o.user_id=c.customer_id) INNER JOIN despatch_details d on o.order_id=d.order_id where d.despatch_through='".$userId."' and o.status=1 order by despatch_date";
		}
		$data['from']=$from;
		$data['to']=$to;

		$query=$this->db->query($sql);
		$data['order']=$query->result_array();

		

		$page_name="Pending Orders";
		$data['page_name']="Pending Orders";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('order/pending-orders',$data);
		$this->load->view('layouts/footer');
	}

	public function delivered_orders()
	{
		$userId=$this->session->userdata('aiplFranchiseId');		
		$from=$this->input->post('from');
		$to=$this->input->post('to');
		if($from)
		{
				$sql="SELECT *,(o.amount-o.discount_price) as amt,DATE_FORMAT(delivery_date,'%d-%m-%Y %h:%i %p') as dt FROM (order_master o INNER JOIN customer_master c on o.user_id=c.customer_id) INNER JOIN despatch_details d on o.order_id=d.order_id where d.despatch_through='".$userId."' and o.status=2 and DATE_FORMAT(delivery_date,'%Y-%m-%d')>=DATE_FORMAT('".$from."','%Y-%m-%d') and DATE_FORMAT(delivery_date,'%Y-%m-%d')<=DATE_FORMAT('".$to."','%Y-%m-%d') order by delivery_date";
	
		}
		else
		{
			$sql="SELECT *,(o.amount-o.discount_price) as amt,DATE_FORMAT(delivery_date,'%d-%m-%Y %h:%i %p') as dt FROM (order_master o INNER JOIN customer_master c on o.user_id=c.customer_id) INNER JOIN despatch_details d on o.order_id=d.order_id where d.despatch_through='".$userId."' and o.status=2 order by delivery_date";
		}
		$data['from']=$from;
		$data['to']=$to;

		$query=$this->db->query($sql);
		$data['order']=$query->result_array();

		

		$page_name="Delivered Orders";
		$data['page_name']="Delivered Orders";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('order/delivered-orders',$data);
		$this->load->view('layouts/footer');
	}
	public function wallet_history()
	{
		$userId=$this->session->userdata('aiplFranchiseId');		
		$from=$this->input->post('from');
		$to=$this->input->post('to');
		
		if($from)
		{
			$sql="SELECT *,DATE_FORMAT(vc_date,'%d-%m-%Y %h:%i %p') as dt FROM customer_transaction_master  where customer_id='".$userId."' and DATE_FORMAT(vc_date,'%Y-%m-%d')>=DATE_FORMAT('".$from."','%Y-%m-%d') and DATE_FORMAT(vc_date,'%Y-%m-%d')<=DATE_FORMAT('".$to."','%Y-%m-%d') order by vc_date";
		}
		else
		{
			$sql="SELECT *,DATE_FORMAT(vc_date,'%d-%m-%Y %h:%i %p') as dt FROM customer_transaction_master  where customer_id='".$userId."' order by vc_date";
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


	public function ordered_product()
	{
		$d=$this->input->post();
		$sql="SELECT * FROM order_details o INNER JOIN product_master p on o.product_id=p.product_code where o.order_id='".$d['order_id']."' order by o.id";
		$query=$this->db->query($sql);
		echo json_encode($query->result_array(),true);
	}

	public function deliver()
	{
		$userId=$this->session->userdata('aiplFranchiseId');
		$fid = $this->session->userdata('aiplFranchiseUserId');
		$d=$this->input->post();
		$sql="UPDATE `order_master` SET `status`=2 where `order_id`='".$d['orderid']."'";
		$this->db->query($sql);

		$sql="UPDATE `despatch_details` SET `delivery_date`=CURRENT_TIMESTAMP() where `order_id`='".$d['orderid']."'";
		$this->db->query($sql);

		$com=round($d['invamt']*5/100,2);
	
		$sql="UPDATE `franchise_master` SET `wallet`=`wallet`+".$com." where `franchise_id`='".$d['fid']."'";
		$this->db->query($sql);		

		$sql="INSERT INTO `customer_transaction_master`(`customer_id`,`credit`, `remarks`) VALUES ('".$d['fid']."','".$com."','Against order no - ".$d['orderid']." and voucher amount - &#8377;".$d['invamt']."')";
		$this->db->query($sql);

		//Cash Back
		$cashback=round(($d['invamt']*20/100)*5/100,2);
		$sql="INSERT INTO `customer_transaction_master`(`customer_id`,`credit`, `remarks`,income_type_id) VALUES ('".$d['custid']."','".$cashback."','Cashback from order no - ".$d['orderid']." and voucher amount - &#8377;".$d['invamt']."','24')";
		$this->db->query($sql);
		$sql="UPDATE `customer_master` SET `main_wallet`=`main_wallet`+".$cashback." where `customer_id`='".$d['custid']."'";
		$this->db->query($sql);		

		if($d['scratchused']==1)
		{
			echo 1;
			return;
		}

		$fasttrackDetails = $this->Crud->ciRead("customer_fasttrack_income", "`customer_id` = '".$d['custid']."'");
		$data = [
			'fasttrack_amount' => $fasttrackDetails[0]->fasttrack_amount,
			'fasttrack_duration' => $fasttrackDetails[0]->fasttrack_duration,
			'next_calculate_date' => $fasttrackDetails[0]->next_calculate_date,
			'benifit_b_amount' => $fasttrackDetails[0]->benifit_b_amount,
			'next_benefit_income_date' => $fasttrackDetails[0]->next_benefit_income_date,
			'benefited_year' => $fasttrackDetails[0]->benefited_year
		];

		$this->Crud->ciUpdate("customer_master", $data, "`customer_id`='".$d['custid']."'");

		
		$sql="SELECT `sponsor_id` FROM `customer_master` WHERE `customer_id`='".$d['custid']."'";
		$query=$this->db->query($sql);
		$sponsorid =$query->result_array()[0]['sponsor_id'];
		$this->repurchaseIncome($sponsorid,0,5,2,1,1,1,$d['invamt']);
		$this->sponsor_repurchase_commission($sponsorid, $d['custid'], $d['orderid']);

		$random_product = "SELECT * FROM `product_master` where `used_in_scratch`=1 order by rand() limit 1";
		$result = $this->db->query($random_product);
		$product_code = $result->result_array();
		$productCode = $product_code[0]['product_code'];

		$str_result = '0123456789';
        $promocode = 'AIPCODE'.substr(str_shuffle($str_result), 0, 4);

		$currentDateTime = new DateTime();
		$currentDateTime->modify('+30 minutes');
		$expiryDate = $currentDateTime->format('Y-m-d H:i:s');
		

		$data2 = [
			'promo_code' =>$promocode,
			'customer_id' =>$d['custid'],
			'product_code' =>$productCode,
			'expiry_date' =>$expiryDate
		];

		$this->Crud->ciCreate("scratch_card_master", $data2);

		$this->Crud->ciCreate("scratch_card_master", $data2);

		$products = $this->input->post('products'); // array of products

		// Loop through each product
		if(!empty($products)) {
			foreach($products as $p) {
				$data3 = [
					'product_id'   => $p['product_id'],
					'stock_in'     => 0,
					'stock_out'    => $p['qty'],
					'entry_date'   => date('Y-m-d H:i:s'),
					'franchise_id' => $fid,
					'stock_type'   => 3 // stock out
				];
				
				$this->Crud->ciCreate("stock_master", $data3);
			}
		}

		echo 1;

	}

	public function sponsor_repurchase_commission($sponsorId, $customerId, $orderId)
	{
		$orderItems = $this->Crud->ciRead("order_details", "`order_id` = '$orderId'");

		$totalCommission = 0;
		foreach ($orderItems as $item) {
			$productCode = $item->product_id;
			$product = $this->Crud->ciRead("product_master", "`product_code` = '$productCode'");
			if (empty($product)) continue;

			$commissionPercent = $product[0]->sponsor_repurchase_commission;

			// Skip if commission is not set or zero
			if (empty($commissionPercent) || $commissionPercent <= 0) continue;

			$totalCommission += ($item->rate * $commissionPercent / 100) * $item->qty;
		}

		if ($totalCommission > 0) {
			$this->Crud->ciCreate("customer_transaction_master", [
				'customer_id' => $sponsorId,
				'credit' => $totalCommission,
				'income_type_id' => 36,
				'remarks' => 'Sponsor Repurchase Income from '.$customerId.' Order ID : '.$orderId
			]);
			$this->db->set('main_wallet', "main_wallet + $totalCommission", false)->where('customer_id', $sponsorId)->update('customer_master');
		}
	}

	//Repurchase Income
	//call this at the time of re -purchase $this->repurchaseIncome($sponsorid,0,5,2,1,1,1,$invoiceamt);
	public function repurchaseIncome($sponsorid,$s,$l1,$l2,$l3,$l4,$l5,$invoiceamt)  //S=0 in call
	{
		$k=$s+1;
		$percentage=0;
		$eligible_amount=round($invoiceamt*20/100,2);
		if($k<=5)	
		{
			$sql="SELECT * FROM customer_master  WHERE `customer_id`='".$sponsorid."'";
			
			$query = $this->db->query($sql);
			$result = $query->result_array();
			if($this->db->affected_rows()>0)
			{
					foreach ($result as $rs) {  
						
					if($k==1) $percentage=$l1;
					else if($k==2) $percentage=$l2;
					else if($k==3) $percentage=$l3;
					else if($k==4) $percentage=$l4;
					else  $percentage=$l5;
					
					$comm=round($eligible_amount*$percentage/100,2);
					if($comm>0)
					{
						$sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$comm." WHERE `customer_id`='".$sponsorid."'";
						$this->db->query($sql);    
						$sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$sponsorid."','".$comm."','Repurchase Income','15')";
						$this->db->query($sql);

						if($k==1)
						{
						//DIRECT REPURCHASE INCOME
						$direct_repurchase_income=round($comm*20/100,2);
						$sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$direct_repurchase_income." WHERE `customer_id`='".$sponsorid."'";
						$this->db->query($sql);    
						$sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$sponsorid."','".$direct_repurchase_income."','Direct Repurchase Income','20')";
						$this->db->query($sql);

						}


					}		
					
					
					$this->repurchaseIncome($rs['sponsor_id'],$k,$l1,$l2,$l3,$l4,$l5,$invoiceamt);  
					
				
				}
			}	
		}	
		else
		{
			return;
		}

	}


	public function total_stock()
    {
		$fid = $this->session->userdata('aiplFranchiseUserId');
		$data['TotalStocks'] = $this->db->select("
			p.product_name,
			SUM(CASE WHEN s.stock_type = 2 THEN s.stock_out ELSE 0 END) 
				- SUM(CASE WHEN s.stock_type = 3 THEN s.stock_out ELSE 0 END) 
			AS total_stock
		")
		->from('stock_master s')
		->join('product_master p', 'p.product_id = s.product_id', 'left')
		->where('s.franchise_id', $fid)   // ✅ filter by franchise_id
		->group_by(['s.product_id', 's.franchise_id'])
		->get()
		->result_array();

		$data['page_name']="Total Stock";
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('stock/total_stock',$data);
		$this->load->view('layouts/footer');
    }

}