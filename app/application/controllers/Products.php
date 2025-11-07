<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		$this->load->library('form_validation');
		$this->load->helper('sms');
	}

	public function products() {
		$sql="SELECT count(pm.product_id) as id FROM product_master pm group by pm.product_id";
		$query = $this->db->query($sql);
		$data['total'] = $query->result_array()[0]['id'];

		$sql="SELECT * FROM `category_master`  where `under_category_id`<>0 AND `type` = 'p' order by `category_name`";
		$query=$this->db->query($sql);
		$data['category']=$query->result_array();

		$sql="SELECT * FROM product_master order by `added_date` desc limit 5";
		$query=$this->db->query($sql);
		$data['newproduct']=$query->result_array();

		$sql="SELECT * FROM product_master;";
		$query=$this->db->query($sql);
		$data['prd']=$query->result_array();

		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('shop/products', $data);
		$this->load->view('layouts/footer');
	}

	public function shop_details(){
		$pid=$this->input->post("pid");	
		$sql="SELECT * FROM product_master where product_id='$pid'";
		$query = $this->db->query($sql);
		$data['pro'] = $query->result_array();

		$product_stock_sql = $this->db->query("SELECT (SUM(CASE WHEN stock_type = 1 THEN stock_in ELSE 0 END) - SUM(CASE WHEN stock_type = 2 THEN stock_out ELSE 0 END)) AS total_stock FROM `stock_master` WHERE `product_id` = '$pid'");
		$data['STOCK'] = $product_stock_sql->result();
		
		$this->load->view('layouts/header-shop');
		$this->load->view('layouts/header-top-shop');
		$this->load->view('layouts/bar');
		$this->load->view('shop/shop-details', $data);
		$this->load->view('layouts/footer-shop');
	}

	public function cart()
	{
		$userid = $this->session->userdata('aiplAppId');
		if($userid){
			$data['cart'] = $this->Crud->ciRead("cart_master","`user_id` = '$userid' AND `status` = '0'");
			$data['cartItems'] = $this->Crud->ciCount("cart_master","`user_id` = '$userid' AND `status` = '0'");
			$this->load->view('layouts/header');
			$this->load->view('layouts/header-top');
			$this->load->view('layouts/bar');
			$this->load->view('shop/cart', $data);
			$this->load->view('layouts/footer-shop');
		}else{
			redirect('authentication/login');
		}
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
		$userid = $this->session->userdata('aiplAppId');
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

	public function checkout()
	{
		$userid = $this->session->userdata('aiplAppId');
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

			$this->load->view('layouts/header');
			$this->load->view('layouts/header-top');
			$this->load->view('layouts/bar');
			$this->load->view('shop/checkout', compact('customerDetails', 'cart', 'dcoupon','cartItem'));
			$this->load->view('layouts/footer-shop');
		}else{
			redirect('authentication/login');
		}
	}

	public function placeOrder(){
		$userid = $this->session->userdata('aiplAppId');
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
			$customerEmail = $customer[0]->email;
            $tempid = '1707175516284291361';
            $message = 'Dear '.$customerName.', you have successfully repurchased items worth '.$finalDistPrice.' - Aceaaro India Pvt. Ltd.';
            sendsms($message, $customerPhone, $tempid);

			// ------------------ Send Email ------------------
			$this->load->library('email');

			$config = array(
				'protocol'    => 'smtp',
				'smtp_host'   => 'ssl://smtp.gmail.com',
				'smtp_port'   => 465,
				'smtp_user'   => 'no-reply@aceaaro.in',   // Gmail address
				'smtp_pass'   => 'sodrkqgkuudfojdz',         // Gmail App Password
				'mailtype'    => 'html',
				'charset'     => 'utf-8',
				'wordwrap'    => TRUE,
				'newline'     => "\r\n",
				'crlf'        => "\r\n"
			);

			$this->email->initialize($config);
			$this->email->from('no-reply@aceaaro.in', 'Aceaaro India Pvt. Ltd.');
			$this->email->to($customerEmail);
			$this->email->subject('Repurchased');
			$this->email->message('
				<p>Dear '.$customerName.',</p>
				<p>You have successfully repurchased items worth '.$finalDistPrice.'.</p>
				<p>Thank you,<br>
				<strong>Aceaaro India Pvt. Ltd.</strong></p>
			');

			if($this->email->send()) {
				log_message('info', 'Email sent successfully to '.$result[0]->email);
			} else {
				log_message('error', 'Email failed to send to '.$result[0]->email.' Error: '.$this->email->print_debugger(['headers']));
			}
			// ------------------------------------------------

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
			redirect('products/order_successful');
		}else{
			$this->session->set_flashdata("danger", "Something went wrong. Try again.");
			redirect('products/cart');
		}
	}
	
	public function order_successful(){
		$this->load->view('shop/order-successful');
	}

	public function orders() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('shop/orders');
		$this->load->view('layouts/footer');
	}

	// Services Controller
	public function services_list()
	{
		$page_name = 'Add Service';
		$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`category_id` != '1' AND `under_category_id` = '2' and type='s'");
		$data['country'] = $this->Crud->ciRead("countries", "`id` != '0'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('services/services-list', $data);
		$this->load->view('layouts/footer');
	}

	public function services()
	{
		$page_name = 'Add Service';
		$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`category_id` != '1' AND `under_category_id` = '2' and type='s'");
		$data['country'] = $this->Crud->ciRead("countries", "`id` != '0'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('services/add-service', $data);
		$this->load->view('layouts/footer');
	}

	public function getStates(){
		extract($_POST);

		$state = $this->Crud->ciRead("states", "`country_code` = '$iso' ORDER BY `name` asc");

		foreach($state as $s){
			echo '<option value="'.$s->id.'">'.$s->name.'</option>';
		}
	}

	public function getCity(){
		extract($_POST);

		$city = $this->Crud->ciRead("cities", "`state_id` = '$iso' ORDER BY `name` asc");

		foreach($city as $c){
			echo '<option value="'.$c->id.'">'.$c->name.'</option>';
		}
	}


	public function manageServices()
	{
		$userList = $this->uri->segment(3);
		$userId = $this->session->userdata('aiplAppId');
		if ($userList == 'active') {
			$page_name = 'Active Service';
			$data['PRODUCT'] = $this->Crud->ciRead("service_master", "`status` != '0' AND `user_id` = '$userId'");
		} else if ($userList == 'inactive') {
			$page_name = 'Inactive Service';
			$data['PRODUCT'] = $this->Crud->ciRead("service_master", "`status` = '0' AND `user_id` = '$userId'");
		}
       $data['page_name']=$page_name;
		$this->load->view('layouts/header');
		$this->load->view('layouts/header-top');
		$this->load->view('layouts/bar');
		$this->load->view('services/active_service', $data);
		$this->load->view('layouts/footer');
	}

	public function addNewService(){
		$userId = $this->session->userdata('aiplAppId');
        // Generate product id
        $str_result = '0123456789';
        $productId = 'SER'.substr(str_shuffle($str_result), 0, 5);
            extract($_POST);
          
			$isExist = $this->Crud->ciCount("service_master", "`service_code` = '$productId' AND `user_id` = '$userId' AND `organization_name` = '$organization' AND `category_id` = '$category' AND `service_description` = '$description' AND `available_in` = '$locations' AND `address` = '$address' AND `country` = '$country' AND `state` = '$state' AND `city` = '$city' AND `pin` = '$pin' AND `phone` = '$phone' AND `mail_id` = '$email' AND `website` = '$website' AND `experience` = '$experience' AND `expertise` = '$expertise'");
			if($isExist > 0){
				redirect('product/services');
			}else{

				// Service Images
                $this->load->library('upload');
                $dataInfo = array();
                $files = $_FILES;
               $cpt = count($_FILES['serviceimg']['name']);
               $cpt=($cpt>6?6:$cpt);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['serviceimg']['name'] = $files['serviceimg']['name'][$i];
                    $_FILES['serviceimg']['type'] = $files['serviceimg']['type'][$i];
                    $_FILES['serviceimg']['tmp_name'] = $files['serviceimg']['tmp_name'][$i];
                    $_FILES['serviceimg']['error'] = $files['serviceimg']['error'][$i];
                    $_FILES['serviceimg']['size'] = $files['serviceimg']['size'][$i];

                    $this->upload->initialize($this->set_upload_options());
                    $this->upload->do_upload('serviceimg');
                    $dataInfo[] = $this->upload->data();
                }
                if (!isset($dataInfo[0]['file_name'])) {
                    $dataInfo[0]['file_name'] = NULL;
                }
                if (!isset($dataInfo[1]['file_name'])) {
                    $dataInfo[1]['file_name'] = NULL;
                }
                if (!isset($dataInfo[2]['file_name'])) {
                    $dataInfo[2]['file_name'] = NULL;
                }
                if (!isset($dataInfo[3]['file_name'])) {
                    $dataInfo[3]['file_name'] = NULL;
                }
                if (!isset($dataInfo[4]['file_name'])) {
                    $dataInfo[4]['file_name'] = NULL;
                }

               $data = array(
                    'service_code' => $productId,
                    'user_id' => $userId, 
                    'organization_name' => $organization,
                    'category_id' => $category,
                    'service_description' => $description,
                    'available_in' => $locations,
                    'address' => $address,
                    'country' => $country,
                    'state' => $state,
                    'city' => $city,
                    'pin' => $pin,
                    'phone' => $phone,
                    'whatsapp' => $whatsapp,
                    'mail_id' => $email,
                    'website' => $website,
                    'experience' => $experience,
                    'expertise' => $expertise,
                    'image_1' => $dataInfo[0]['file_name'],
                    'image_2' => $dataInfo[1]['file_name'],
                    'image_3' => $dataInfo[2]['file_name'],
                    'image_4' => $dataInfo[3]['file_name'],
                    'image_5' => $dataInfo[4]['file_name']                  
                );

                if ($this->Crud->ciCreate('service_master', $data)) {
                    $this->session->set_flashdata('success', 'Product added successfully');
                    redirect('products/services');
                } else {
                    $this->session->set_flashdata('danger', 'Something went wrong');
					redirect('products/services');
                }
			
        }
    }

	private function set_upload_options() {
        //upload an image options
        $config = array();
        $config['upload_path'] = 'uploads/service/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;
        $config['encrypt_name'] = TRUE;
        return $config;
    }

	public function viewImages(){
		extract($_POST);
		$images = $this->Crud->ciRead("service_master", "`id` = '$id'");
		echo '<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/service/'.$images[0]->image_1).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/service/'.$images[0]->image_2).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/service/'.$images[0]->image_3).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/service/'.$images[0]->image_4).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/service/'.$images[0]->image_5).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>';
	}
}