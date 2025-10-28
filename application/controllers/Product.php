<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

	public function __construct() {
		error_reporting(0);
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplUserId')) {
			redirect('authentication/login');
		}
	}

	// ************************************************************************
	// *****************************CATEGORIES*********************************
	// ************************************************************************

	public function categories()
	{
		$page_name = 'Add Categories';
		$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`status` = '1' and type='p'");
		$data['CATEGORIES'] = $this->Crud->ciRead("category_master", "`category_id` != '0' and type='p'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header', compact('page_name'));
		$this->load->view('user/layouts/nav');
		$this->load->view('product/categories', $data);
		$this->load->view('user/layouts/footer');
	}

	public function editCategories()
	{
		$page_name = 'Edit Categories';
		$categoryid = $this->input->post('categoryid');
		$data['CATEGORIES'] = $this->Crud->ciRead("category_master", "`category_id` = '$categoryid'");
		$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`category_id` != '0'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header', compact('page_name'));
		$this->load->view('user/layouts/nav');
		$this->load->view('product/edit-categories', $data);
		$this->load->view('user/layouts/footer');
	}

	public function addNewCategory()
	{
		$userId = $this->session->userdata('aiplAdminId');
		if (isset($_POST['addCategory'])) {
			extract($_POST);

			$data = [
				'under_category_id' => $category,
				'category_name' => $name,
				'user_id' => $userId,
			];

			if ($this->Crud->ciCreate("category_master", $data)) {
				$this->session->set_flashdata("success", "Category added successfully.");
			} else {
				$this->session->set_flashdata("danger", "Try again.");
			}

			redirect('product/categories');
		}
	}

	public function changeStatus()
	{
		$categoryId = $this->uri->segment(4);
		$status = $this->uri->segment(3);

		$data = [
			'status' => $status,
		];

		if ($this->Crud->ciUpdate("category_master", $data, "`category_id` = '$categoryId'")) {
			$this->session->set_flashdata("success", "Category status changed successfully.");
		} else {
			$this->session->set_flashdata("danger", "Try again.");
		}

		redirect('product/categories');
	}

	public function updateCategory()
	{
		$userId = $this->session->userdata('aiplAdminId');
		if (isset($_POST['upadteCategory'])) {
			extract($_POST);
			$data = [
				'under_category_id' => $category,
				'category_name' => $name,
				'user_id' => $userId,
			];

			if ($this->Crud->ciUpdate("category_master", $data, "`category_id` = '$categoryid'")) {
				$this->session->set_flashdata("success", "Category updated successfully.");
			} else {
				$this->session->set_flashdata("danger", "Try again.");
			}

			redirect('product/categories');
		}
	}
	public function updateServiceCategory()
	{
		$userId = $this->session->userdata('aiplAdminId');
		if (isset($_POST['upadteCategory'])) {
			extract($_POST);
			$data = [
				'under_category_id' => $category,
				'category_name' => $name,
				'user_id' => $userId,
			];

			if ($this->Crud->ciUpdate("category_master", $data, "`category_id` = '$categoryid'")) {
				$this->session->set_flashdata("success", "Category updated successfully.");
			} else {
				$this->session->set_flashdata("danger", "Try again.");
			}

			redirect('product/service_categories');
		}
	}


	// ************************************************************************
	// *****************************PRODUCTS***********************************
	// ************************************************************************

	public function products()
	{
		$page_name = 'Add Products';
		$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`category_id` != '1' AND `under_category_id` = '1' and type='p'");
		$data['UNIT'] = $this->Crud->ciRead("unit", "`id` != '0'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header', compact('page_name'));
		$this->load->view('user/layouts/nav');
		$this->load->view('product/add-product', $data);
		$this->load->view('user/layouts/footer');
	}

	public function getsubcategory()
	{
		if (!empty($_POST["categoryID"])) {
			$categoryID = $_POST['categoryID'];
			$isExist = $this->Crud->ciCount('category_master', "`under_category_id` = '$categoryID' ");
			if ($isExist == 0) {
				echo 0;
			} else {
				$SUBCATEGORIES = $this->Crud->ciRead('category_master', "`under_category_id` = '$categoryID'");

				if ($SUBCATEGORIES) {
					echo '<option value="">Select an option</option>';
					foreach ($SUBCATEGORIES as $key) {
						echo '<option value="' . $key->category_id . '">' . $key->category_name . '</option>';
					}
				}
			}
		}
	}

	public function addNewProduct()
	{
		$userId = $this->session->userdata('aiplAdminId');
		if (isset($_POST['addproduct'])) {
			extract($_POST);

			$data = [
				'category_id' => $category,
				'HSN_code' => $hsn,
				'product_name' => $name,
				'product_description' => $description,
				'gst' => $gst,
				'unit' => $unit,
				'user_id' => $userId
			];

			if ($this->Crud->ciCreate("product_master", $data)) {
				$this->session->set_flashdata("success", "Product added successfully.");
			} else {
				$this->session->set_flashdata("danger", "Try again.");
			}

			redirect('product/products');
		}
	}

	public function manageProducts()
	{
		$userList = $this->uri->segment(3);
		if ($userList == 'active') {
			$page_name = 'Active Product';
			$data['PRODUCT'] = $this->Crud->ciRead("product_master", "`status` = '1'");
		} else if ($userList == 'inactive') {
			$page_name = 'Inactive Product';
			$data['PRODUCT'] = $this->Crud->ciRead("product_master", "`status` = '0'");
		}
		$data['page_name']=$page_name;
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header', compact('page_name'));
		$this->load->view('user/layouts/nav');
		$this->load->view('product/manage-products', $data);
		$this->load->view('user/layouts/footer');
	}

	public function u_category($catid)
	{

		$cat = "";
		$sql = "SELECT * FROM `category_master` WHERE `category_id`='" . $catid . "' and type='p' and status=1 ";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		foreach ($result as $rs) {
			if ($rs['under_category_id'] != 1) {
				$cat = $this->u_category($rs['under_category_id']);
			} else  $cat = $rs['category_id'];
		}
		return $cat;
	}

	public function product_details()
	{
		$page_name = 'Add Product Item';
		$data['pcode'] = $this->input->post('pcode');
		$data['pname'] = $this->input->post('pname');

		$productid = $this->input->post('pcode');
		$data['ITEMS'] = $this->Crud->ciRead("product_details", "`product_id` = '$productid' AND `status` = '1'");
		$data['ITEMSCOUNT'] = $this->Crud->ciCount("product_details", "`product_id` = '$productid' AND `status` = '1'");

		$data['ITEMS_UPDATED_LIFT'] = $this->Crud->ciRead("product_details_updated", "`product_id` = '$productid'");

		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header', compact('page_name'));
		$this->load->view('user/layouts/nav');
		$this->load->view('product/product-details', $data);
		$this->load->view('user/layouts/footer');
	}

	public function addProductItem()
	{
		$userId = $this->session->userdata('aiplAdminId');

		extract($_POST);

		$data = [
			'product_id' => $productId,
			'purchase_price' => $purchase,
			'sale_price' => $sale,
			'qty' => $qty,
			'warehouse' => $warehouse,
			'added_by' => $userId,
			'updated_on' => date('Y-m-d')
		];

		if ($this->Crud->ciCreate("product_details", $data)) {
			$this->session->set_flashdata("success", "Product item added successfully.");
		} else {
			$this->session->set_flashdata("danger", "Try again.");
		}
	}

	public function updateProductItem()
	{
		$userId = $this->session->userdata('aiplAdminId');
		extract($_POST);

		$previousitemdetails = $this->Crud->ciRead("product_details", "`product_id` = '$uproductId'");

		$data = [
			'product_id' => $uproductId,
			'purchase_price' => $upurchase,
			'sale_price' => $usale,
			'qty' => $uqty,
			'warehouse' => $uwarehouse,
			'updated_on' => date('Y-m-d')
		];

		$data2 = [
			'product_id' => $uproductId,
			'purchase_price' => $previousitemdetails[0]->purchase_price,
			'purchase_price_new' => $upurchase,
			'sale_price' => $previousitemdetails[0]->sale_price,
			'sale_price_new' => $usale,
			'qty' => $uqty,
			'warehouse' => $uwarehouse,
			'added_by' => $userId
		];

		if ($this->Crud->ciUpdate("product_details", $data, "`id` = '$uproductdetailsId'")) {
			$this->Crud->ciCreate("product_details_updated", $data2);
			$this->session->set_flashdata("success", "Product item updated successfully.");
		} else {
			$this->session->set_flashdata("danger", "Try again.");
		}
	}


	//service
	public function service_categories()
	{
		$page_name = 'Add Categories';
		$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`status` = '1' and type='s'");
		$data['CATEGORIES'] = $this->Crud->ciRead("category_master", "`category_id` != '0' and type='s'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header', compact('page_name'));
		$this->load->view('user/layouts/nav');
		$this->load->view('service/categories', $data);
		$this->load->view('user/layouts/footer');
	}
	function addNewServiceCategory()
	{
		$userId = $this->session->userdata('aiplAdminId');
		if (isset($_POST['addCategory'])) {
			extract($_POST);

			$data = [
				'under_category_id' => $category,
				'category_name' => $name,
				'type'=>'s',
				'user_id' => $userId,
			];

			if ($this->Crud->ciCreate("category_master", $data)) {
				$this->session->set_flashdata("success", "Category added successfully.");
			} else {
				$this->session->set_flashdata("danger", "Try again.");
			}

			redirect('product/service_categories');
		}
	}

	public function editServiceCategories()
	{
		$page_name = 'Edit Categories';
		$categoryid = $this->input->post('categoryid');
		$data['CATEGORIES'] = $this->Crud->ciRead("category_master", "`category_id` = '$categoryid'");
		$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`category_id` != '0'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header', compact('page_name'));
		$this->load->view('user/layouts/nav');
		$this->load->view('service/edit-categories', $data);
		$this->load->view('user/layouts/footer');
	}

	public function services()
	{
		$page_name = 'Add Service';
		$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`category_id` != '1' AND `under_category_id` = '2' and type='s'");
		$data['country'] = $this->Crud->ciRead("countries", "`id` != '0'");
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header', compact('page_name'));
		$this->load->view('user/layouts/nav');
		$this->load->view('service/add-service', $data);
		$this->load->view('user/layouts/footer');
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
		$userId = $this->session->userdata('aiplUserId');
		if ($userList == 'active') {
			$page_name = 'Active Service';
			$data['PRODUCT'] = $this->Crud->ciRead("service_master", "`status` != '0' AND `user_id` = '$userId'");
		} else if ($userList == 'inactive') {
			$page_name = 'Inactive Service';
			$data['PRODUCT'] = $this->Crud->ciRead("service_master", "`status` = '0' AND `user_id` = '$userId'");
		}
       $data['page_name']=$page_name;
		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/bar');
		$this->load->view('user/layouts/sub-header', compact('page_name'));
		$this->load->view('user/layouts/nav');
		$this->load->view('service/active_service', $data);
		$this->load->view('user/layouts/footer');
	}

	public function addNewService(){
		$userId = $this->session->userdata('aiplUserId');
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
                    redirect('product/services');
                } else {
                    $this->session->set_flashdata('danger', 'Something went wrong');
					redirect('product/services');
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