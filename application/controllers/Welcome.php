<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->helper('sms');
		$this->load->helper('text');
	}

	public function index()
	{
		$file = file_get_contents(FCPATH . "admin/content/faq.json");
  		$faqs = json_decode($file, true);
		$activeData = array_filter($faqs['faqs'], function($item) {
			return $item['status'] == 'active';
		});
		$data['faqs'] = array_slice($activeData, 0, 3);

		// fetch packages
		$sql="SELECT * FROM `package_master` WHERE `status`=1 AND `display_status` = 1";
		$query=$this->db->query($sql);
		$data['package']=$query->result_array();

		$data['ADS'] = $this->Crud->ciRead("ads_master", "`status` = '1' ORDER BY `added_date` desc");
		$data['TIESUP'] = $this->Crud->ciRead("tiesup_master", "`status` = '1' ORDER BY `added_date` desc");
		$this->load->view('include/header');
		$this->load->view('include/slider');
		$this->load->view('index', $data);
		$this->load->view('include/footer');
	}

	public function about()
	{
		$this->load->view('include/header');
		$this->load->view('about');
		$this->load->view('include/footer');
	}

	public function mission()
	{
		$this->load->view('include/header');
		$this->load->view('mission');
		$this->load->view('include/footer');
	}

	public function vision()
	{
		$this->load->view('include/header');
		$this->load->view('vision');
		$this->load->view('include/footer');
	}

	public function faq()
	{
		$file = file_get_contents(FCPATH . "admin/content/faq.json");
  		$data['faqs'] = json_decode($file, true);
		$this->load->view('include/header');
		$this->load->view('faq', $data);
		$this->load->view('include/footer');
	}

	public function packages()
	{
		// fetch packages
		$sql="SELECT * FROM `package_master` WHERE `status`=1 AND `display_status` = 1";
		$query=$this->db->query($sql);
		$data['package']=$query->result_array();
		$this->load->view('include/header');
		$this->load->view('packages', $data);
		$this->load->view('include/footer');
	}

	public function company_documents()
	{
		$this->load->view('include/header');
		$this->load->view('company-documents');
		$this->load->view('include/footer');
	}

	public function gallery()
	{
		$this->load->view('include/header');
		$this->load->view('gallery');
		$this->load->view('include/footer');
	}

	public function service()
	{
		// Fetch Services
		$sql = "SELECT * FROM `category_master` WHERE `status`=1 AND `type` = 's' AND `under_category_id` != '0'";
		$query = $this->db->query($sql);
		$data['service'] = $query->result_array();

		$this->load->view('include/header');
		$this->load->view('service', $data);
		$this->load->view('include/footer');
	}

	public function services()
	{
		extract($_POST);
		// Fetch Services
		$sql = "SELECT * FROM `category_master` WHERE `status`=1 AND `type` = 's' AND `under_category_id` != '0'";
		$query = $this->db->query($sql);
		$data['service'] = $query->result_array();

		// Single category services
		$sql = "SELECT * FROM `service_master` WHERE `status`=2 AND `category_id` = '$serviceid'";
		$query = $this->db->query($sql);
		$data['services'] = $query->result_array();

		$this->load->view('include/header');
		$this->load->view('view-service', $data);
		$this->load->view('include/footer');
	}

	public function service_details()
	{
		extract($_POST);
		// Single category services
		$sql = "SELECT * FROM `service_master` WHERE `status`=2 AND `id` = '$singleserviceid'";
		$query = $this->db->query($sql);
		$data['services'] = $query->result_array();

		$this->load->view('include/header');
		$this->load->view('service-details', $data);
		$this->load->view('include/footer');
	}

	public function service_query(){
		$userid = $this->session->userdata('aiplUserId');
		extract($_POST);
		$date = date('Y-m-d');
		$isExist = $this->Crud->ciCount("service_request", "`service_code` = '$service_code' AND `service_partner` = '$service_partner' AND `user_id` = '$userid' AND `added_date` = '$date'");
		if($isExist == 0){
			$data = [
				'service_code' => $service_code,
				'service_partner' => $service_partner,
				'user_id' => $userid,
				'added_date' => $date
			];

			$this->Crud->ciCreate("service_request", $data);
		}
	}

	public function shop()
	{
		$sql="SELECT count(pm.product_id) as id FROM product_master pm group by pm.product_id";
		$query = $this->db->query($sql);
		$data['total'] = $query->result_array()[0]['id'];

		$sql="SELECT * FROM `category_master`  where `under_category_id`<>0 AND `type` = 'p' order by `category_name`";
		$query=$this->db->query($sql);
		$data['category']=$query->result_array();

		$sql="SELECT * FROM product_master WHERE `status` = 1 order by `added_date` desc limit 5";
		$query=$this->db->query($sql);
		$data['newproduct']=$query->result_array();

		$sql="SELECT * FROM product_master where `status` = 1";
		$query=$this->db->query($sql);
		$data['prd']=$query->result_array();

		$this->load->view('include/header');
		$this->load->view('shop', $data);
		$this->load->view('include/footer');
	}

	public function shop_details()
	{
		$pid=$this->input->post("pid");	
		$sql="SELECT * FROM product_master where product_id='$pid'";
		$query = $this->db->query($sql);
		$data['pro'] = $query->result_array();

		$product_stock_sql = $this->db->query("SELECT (SUM(CASE WHEN stock_type = 1 THEN stock_in ELSE 0 END) - SUM(CASE WHEN stock_type = 2 THEN stock_out ELSE 0 END)) AS total_stock FROM `stock_master` WHERE `product_id` = '$pid'");
		$data['STOCK'] = $product_stock_sql->result();

		$this->load->view('include/header');
		$this->load->view('shop-details', $data);
		$this->load->view('include/footer');
	}

	public function cart()
	{
		$userid = $this->session->userdata('aiplUserId');
		if($userid){
			$data['cart'] = $this->Crud->ciRead("cart_master","`user_id` = '$userid' AND `status` = '0'");
			$data['cartItems'] = $this->Crud->ciCount("cart_master","`user_id` = '$userid' AND `status` = '0'");
			$this->load->view('include/header');
			$this->load->view('cart', $data);
			$this->load->view('include/footer');
		}else{
			redirect('authentication/login');
		}
	}

	public function checkout()
	{
		$userid = $this->session->userdata('aiplUserId');
		if($userid){
			extract($_POST);
			// Customer Details
			$customerDetails = $this->Crud->ciRead("customer_master","`customer_id` = '$userid'");
			$usedCoupons = $customerDetails[0]->coupon_used;
			$noOfCoupons = $customerDetails[0]->no_of_coupon;
			
			$availableCoupon = $noOfCoupons - $usedCoupons;
			$coupon =  intval($totalAmt/1100);

			if($availableCoupon == 0){
				$dcoupon =  '';
			}else if($availableCoupon < $coupon){
				$dcoupon =  $availableCoupon;
			}else{
				$dcoupon = $coupon;
			}
			// Cart Details
			$cart = $this->Crud->ciRead("cart_master","`user_id` = '$userid' AND `status` = '0'");
			$cartItem = $this->Crud->ciCount("cart_master","`user_id` = '$userid' AND `status` = '0'");

			$this->load->view('include/header');
			$this->load->view('order',compact('customerDetails', 'cart', 'dcoupon','cartItem'));
			$this->load->view('include/footer');
		}else{
			redirect('authentication/login');
		}
	}

	public function placeOrder(){
		$userid = $this->session->userdata('aiplUserId');
		$date = date('Y-m-d H:i:s');
		extract($_POST);
	
		$data = [
			'user_id'=> $userid,
			'order_date'=> $date,
			'amount'=> $finalTotalAmount,
			'discount_price'=> $finalDistPrice,
		];
	
		if($this->Crud->ciCreate("order_master", $data)){
			// Update order details
			$findOrderId = $this->Crud->ciRead("order_master", "`user_id` = '$userid' AND `order_date` = '$date' AND `amount` = '$finalTotalAmount' AND `discount_price` = '$finalDistPrice'")[0]->order_id;
			$data1 = array();
			for($i = 0; $i < $cartItems; $i++){
				$data1 = [
					'order_id' =>$findOrderId,
					'product_id' =>$finalProductId[$i],
					'qty' =>$finalQty[$i],
					'rate' =>$finalPrice[$i],
					'gst' =>$finalGst[$i],
					'performance_bonus_status' =>$finalPerformanceBonusStatus[$i],
					'team_shopping_status' =>$finalShoppingIncomeStatus[$i],
				];
	
				$this->Crud->ciCreate("order_details", $data1);
			}
	
			// Update customer coupon details
			$customer = $this->Crud->ciRead("customer_master", "`customer_id`='$userid'");
			$coupon_used = $customer[0]->coupon_used;
			$updatedCoupon = $coupon_used + $finalCouponUsed;
			$sponsorid = $customer[0]->sponsor_id;
	
			$data2 = [
				'coupon_used' => $updatedCoupon
			];
	
			$this->Crud->ciUpdate("customer_master", $data2, "`customer_id`='$userid'");
	
			// Update cart details
			$data3 = [
				'status' => 1
			];
	
			$this->Crud->ciUpdate("cart_master", $data3, "`user_id`='$userid' AND `status` = '0'");

            // SMS
            $customerName = $customer[0]->name;
            $customerPhone = $customer[0]->mobile;
            $tempid = '1707175516284291361';
            $message = 'Dear '.$customerName.', you have successfully repurchased items worth '.$finalDistPrice.' - Aceaaro India Pvt. Ltd.';
            sendsms($message, $customerPhone, $tempid);

			// Check Fasttrack
			if($finalDistAmt > 2500){
				$fasttrackStatus = $customer[0]->fasttrack_status;
				$activationStatus = $customer[0]->status;

				if($fasttrackStatus == 0 && $activationStatus == 1 || $activationStatus == 4){
					$checkTime = $customer[0]->activation_date;
					$currentTime = date('Y-m-d H:i:s');

					$diffInSeconds = strtotime($currentTime) - strtotime($checkTime);
					$diffInHours = floor($diffInSeconds / 3600);

					if($diffInHours < 24){
						$userPackage = $customer[0]->package_id;
						$packageDetails = $this->Crud->ciRead("package_master", "`package_id` = '$userPackage'")[0]->fasttrack_income;

						$data4 = [
							'fasttrack_amount' => $packageDetails,
							'fasttrack_duration' => 0,
							'next_calculate_date' => date('Y-m-d', strtotime("+1 days")),
							'benifit_b_amount' =>$finalDistAmt,
							'next_benefit_income_date' => date('Y-m-d', strtotime("+365 days")),
							'benefited_year' =>1,
							'customer_id' => $userid,
							'sponsor_id' => $customer[0]->sponsor_id
						];

						$this->Crud->ciCreate("customer_fasttrack_income", $data4);
						$this->Crud->ciUpdate("customer_master", array(
							'fasttrack_status' =>1
						), "`customer_id`='$userid'");
					}
				}
			}

			// Repurchase Income
			// $sponsorid = $customer[0]->sponsor_id;
			// $this->repurchaseIncome($sponsorid,0,5,2,1,1,1,$finalDistAmt);
	
			$this->session->set_flashdata("success", "Order created successfully.");
			redirect('/order_successful');
		}else{
			$this->session->set_flashdata("danger", "Something went wrong. Try again.");
			redirect('/cart');
		}
	}
	
	public function order_successful(){
		$this->load->view('include/header');
		$this->load->view('order-successful',);
		$this->load->view('include/footer');
	}

	public function addToCart(){
		extract($_POST);
		$isExist = $this->Crud->ciCount("cart_master", "`user_id` = '$customerid' AND `product_id` = '$productid' AND `status` = '0'");

		if($isExist > 0){
			$pd = $this->Crud->ciRead("cart_master", "`user_id` = '$customerid' AND `product_id` = '$productid' AND `status` = '0'");

			$productId = $pd[0]->cart_id;

			$pQty = $pd[0]->qty;

			$pQty += $qty;

			$data = [
				'qty' => $pQty
			];

			if($this->Crud->ciUpdate("cart_master", $data, "`cart_id` = '$productId'")){
				echo 1;
			}else{
				echo 0;
			}

		}else{
			$data = [
				'user_id' => $customerid,
				'product_id' => $productid,
				'qty' => $qty,
			];

			if($this->Crud->ciCreate("cart_master", $data)){
				echo 1;
			}else{
				echo 0;
			}
		}
	}

	public function removeFromCart(){
		extract($_POST);
		if($this->Crud->ciDelete("cart_master", "`cart_id` = '$id'")){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function removeAll(){
		$userid = $this->session->userdata('aiplUserId');
		if($this->Crud->ciDelete("cart_master", "`user_id` = '$userid' AND `status` = '0'")){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function decreaseCartQty(){
		extract($_POST);
		$findProduct = $this->Crud->ciRead("cart_master", "`cart_id` = '$id'");
		$qty = $findProduct[0]->qty;
		$update = $qty - 1;
		$data = [
			'qty' => $update
		];
		$this->Crud->ciUpdate("cart_master", $data, "`cart_id` = '$id'");
	}

	public function increaseCartQty(){
		extract($_POST);
		$findProduct = $this->Crud->ciRead("cart_master", "`cart_id` = '$id'");
		$qty = $findProduct[0]->qty;
		$update = $qty + 1;
		$data = [
			'qty' => $update
		];
		$this->Crud->ciUpdate("cart_master", $data, "`cart_id` = '$id'");
	}

	public function filter_shop()
	{
		$d = $this->input->post();
		$sr = explode(" ", $d['search']);
		$i = 0;
		$srcen = count($sr);
		$src = '(';
		foreach ($sr as $s) {
			$src .= 'product_name like "%' . $s . '%" or product_description like "%' . $s . '%"';
			if ($i < $srcen - 1) $src .= " or ";
			$i++;
		}
		$src .= ")";

		if($d['cid']!="")
		{
			$catid=($d['cid']?"(`category_id`='".$d['cid']."' ":'');
			$sql="SELECT * FROM `category_master` WHERE `under_category_id`='".$d['cid']."'";
			$query = $this->db->query($sql);
			$cat=$query->result_array();
			
			foreach($cat as $ct)
			{
				
				 $catid.=" OR `category_id`='".$ct['category_id']."' ";
				
			}
			$catid.=") and ";
		} else {
			$catid = "";
		}
		
	

		$catid_=($d['cid']?" where `category_id`='".$d['cid']."' ":'');
		$sql="SELECT product_image_one, product_id,product_name,mrp,price FROM product_master where `status` = 1 AND $catid $src";
 		$query = $this->db->query($sql);
		$products = $query->result_array();

		// Append stock info
		foreach ($products as &$row) {
			$productId = $row['product_id'];
			$stock_sql = $this->db->query("
				SELECT 
					(SUM(CASE WHEN stock_type = 1 THEN stock_in ELSE 0 END) -
					SUM(CASE WHEN stock_type = 2 THEN stock_out ELSE 0 END)) AS total_stock
				FROM stock_master 
				WHERE product_id = '$productId'
			");
			$stock_res = $stock_sql->row();
			$row['stock'] = (int)$stock_res->total_stock ?? 0;
		}
		
		echo json_encode($products, true);
	}

	public function franchises()
	{
		$data['FRANCHISE'] = $this->Crud->ciRead("franchise_master", "`status` = '1' ORDER BY `app_reject_date` DESC");
		$this->load->view('include/header');
		$this->load->view('franchise', $data);
		$this->load->view('include/footer');
	}

	public function contact()
	{
		$this->load->view('include/header');
		$this->load->view('contact');
		$this->load->view('include/footer');
	}

	public function registration()
	{
		$data['PACKAGES'] = $this->Crud->ciRead("package_master", "`status` = '1' AND `display_status` = 1");
		$this->load->view('include/header');
		$this->load->view('registration', $data);
		$this->load->view('include/footer');
	}

	public function referral_registration()
	{
		$data['PACKAGES'] = $this->Crud->ciRead("package_master", "`status` = '1' AND `display_status` = 1");
		$this->load->view('include/header');
		$this->load->view('referral-registration', $data);
		$this->load->view('include/footer');
	}

	public function franchise_registration()
	{
		$this->load->view('include/header');
		$this->load->view('franchise-registration');
		$this->load->view('include/footer');
	}

	public function privacy_policy()
	{
		$this->load->view('include/header');
		$this->load->view('privacy-policy');
		$this->load->view('include/footer');
	}

	public function return_policy()
	{
		$this->load->view('include/header');
		$this->load->view('return-policy');
		$this->load->view('include/footer');
	}

	public function benefits(){
		$sql = $this->db->query('SELECT bm.*, bc.category FROM `benifit_master` bm JOIN benifit_category bc ON bc.id = bm.benifit_category_id');
        $data['BENEFIT'] = $sql->result();
		$this->load->view('include/header');
		$this->load->view('benefits', $data);
		$this->load->view('include/footer');
	}

	public function terms_and_condition()
	{
		$this->load->view('include/header');
		$this->load->view('terms-and-condition');
		$this->load->view('include/footer');
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

	function franchiseidGenerate() {
		$str_number = "0123456789";
		$str_alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

		$userid = 'FR'.date('y').substr(str_shuffle($str_alphabet), 0, 2).substr(str_shuffle($str_number), 0, 4);
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

	public function franchise_find_phoneno(){
		extract($_POST);
		echo $customerDetails = $this->Crud->ciCount("user_master", "`user_phone` = '$phone' AND `user_type` = '3'");	
	}

	public function franchise_find_emailid(){
		extract($_POST);
		echo $customerDetails = $this->Crud->ciCount("user_master", "`user_email` = '$email' AND `user_type` = '3'");	
	}

	public function createAccount(){
		// if(isset($_POST['create_account'])){
			extract($_POST);

			// Validate the reCAPTCHA
			$recaptchaSecret = '6LcBg9grAAAAAHLCoTq-KT9SD8NSeefZCks-WiTk';
			$recaptchaResponse = $g_recaptcha_response;
			$recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
			$data = [
				'secret' => $recaptchaSecret,
				'response' => $recaptchaResponse
			];
		
			$options = [
				'http' => [
					'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
					'method'  => 'POST',
					'content' => http_build_query($data)
				]
			];
		
			$context  = stream_context_create($options);
			$result = file_get_contents($recaptchaUrl, false, $context);
			$recaptcha = json_decode($result);
		
			if ($recaptcha->success == true && $recaptcha->action == 'submit') {
				
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

						// Update sponsor point wallet
						echo $findSponsorPntAmt = $this->Crud->ciRead("customer_master", "`customer_id` = '$sponsor'")[0]->point_wallet;
						$UpdateSponsorPntAmt =$findSponsorPntAmt + 5;
						$this->Crud->ciUpdate("customer_master", array(
							'point_wallet' => $UpdateSponsorPntAmt,
						), "`customer_id` = '$sponsor'");

                        // SMS
                        $tempid = '1707175516215519152';
                        $message = 'Dear '.$name.', your registration is successful. Your User ID is '.$userid.' and your password is '.$password.'. Please keep them safe - Aceaaro India Pvt. Ltd.';
                        sendsms($message, $phone, $tempid);

						$this->session->set_flashdata("success", "**Congratulations! Your account created successfully. Your ID is <span style='color:red;'>".$userid."</span> and Password is <span style='color:red;'>".$password."</span>. Click here to <u><a href=".base_url('authentication/login').">login now</a></u>");
						redirect('registration');

					}else{
						$this->session->set_flashdata("danger", "Registration Faild. Try again.");
						redirect('registration');
					}
				}
			}else {
				$this->session->set_flashdata("danger", "reCAPTCHA validation failed. Please try again.");
				redirect('registration');
			}
		// } 
	}


	public function franchiseQuery(){
		extract($_POST);

		$recaptchaSecret = '6LcBg9grAAAAAHLCoTq-KT9SD8NSeefZCks-WiTk';
		$recaptchaResponse = $g_recaptcha_response;
		$recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
		$data = [
			'secret' => $recaptchaSecret,
			'response' => $recaptchaResponse
		];
	
		$options = [
			'http' => [
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			]
		];
	
		$context  = stream_context_create($options);
		$result = file_get_contents($recaptchaUrl, false, $context);
		$recaptcha = json_decode($result);
	
		if ($recaptcha->success == true && $recaptcha->action == 'submit') {
		
			$data = [
				'franchise_id' => $userid,
				'name' =>$name,
				'mobile' =>$phone,
				'email' =>$email,
				'address' => $address,
				'package_id' => $package,
				'nominee' => $nominee,
				'relationship' => $relationship,
				'referred_by' => $refer_id
			];

			$data2 = [
				'customer_id' => $userid,
				'user_name' =>$name,
				'user_phone' =>$phone,
				'user_email' =>$email,
				'user_type' => 3,
				'status' => 0
			];

			$data3 = [
				'bank_name' => $bank,
				'branch_name' => $branch,
				'ac_no' => $acno,
				'ifsc_code' => $ifsc,
				'pan_no' => $pan,
				'aadhar_no' => $aadhar,
				'cust_franc_id' => $userid,
				'payee_name' => $payee
			];

			if($this->Crud->ciCreate("user_master", $data2)){
				$this->Crud->ciCreate("franchise_master", $data);
				$this->Crud->ciCreate("kyc_master", $data3);
				$this->session->set_flashdata("success", "Franchise request created successfully.");
				redirect('franchise_registration');
			}else{
				$this->session->set_flashdata("danger", "Something went wrong. Try again.");
				redirect('franchise_registration');
			}
		}else {
			$this->session->set_flashdata("danger", "reCAPTCHA validation failed. Please try again.");
			redirect('franchise_registration');
		}
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
        <senderid></senderid>
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

                    // //SELF REPURCHASE INCOME
                    // $self_repurchase_income=round($comm*5/100,2);
                    // $sql="UPDATE `customer_master` SET `main_wallet`=main_wallet+".$comm." WHERE `customer_id`='".$sponsorid."'";
			    	// $this->db->query($sql);    
					// $sql="INSERT INTO `customer_transaction_master`(`customer_id`, `credit`, `remarks`,income_type_id) VALUES ('".$sponsorid."','".$comm."','Repurchase Income','15')";
			        // $this->db->query($sql);
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


public function get_refer_details(){
	extract($_POST);

	$details = $this->Crud->ciRead("customer_master", "`customer_id` = '$rid'");

	if(!empty($details)){
		echo $details[0]->name;
	}else{
		echo 'NOT_FOUND';
	}
}

public function get_package_products() {
    $package_id = $this->input->post('package_id', true); // XSS filtering

    if (!$package_id) {
        echo '<tr><td colspan="2">Invalid package selected.</td></tr>';
        return;
    }

    $this->db->select('p.product_name, p.price');
    $this->db->from('package_product_master pm');
    $this->db->join('product_master p', 'p.product_id = pm.product_id');
    $this->db->where('pm.package_id', $package_id);
    $query = $this->db->get();
    $products = $query->result();

    if (empty($products)) {
        echo '<tr><td colspan="2" class="text-center">No products found for this package.</td></tr>';
        return;
    }

    $total = 0;
    foreach ($products as $product) {
        $product_name = htmlspecialchars($product->product_name);
        $price = (float) $product->price;
        $total += $price;

        echo "<tr><td>{$product_name}</td><td class='text-right'>&#8377;" . number_format($price, 2) . "</td></tr>";
    }

    // Add total row
    echo '<tr style="font-weight: bold;"><td>Total</td><td class="text-right">&#8377;' . number_format($total, 2) . '</td></tr>';
}

}