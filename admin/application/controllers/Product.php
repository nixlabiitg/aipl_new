<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

	public function __construct() {
		error_reporting(0);
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('aiplAdminId')) {
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
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/categories', $data);
		$this->load->view('layouts/footer');
	}
	public function brand()
	{
		$page_name = 'Add Brand';
		$sql="SELECT * FROM `brand_master` order by `brand_name`";
		$query=$this->db->query($sql);
		$data['brand'] =$query->result_array();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/brand', $data);
		$this->load->view('layouts/footer');
	}
	public function add_brand()
	{
		$userId=$this->session->userdata('aiplAdminId');
		$d=$this->input->post();
		$sql="SELECT * FROM `brand_master` WHERE `brand_name`='".$d['brand']."'";
		$this->db->query($sql);
		if($this->db->affected_rows()>0)
		{
			echo "e";
		}
		else
		{
			$sql="UPDATE `brand_master` SET `brand_name`='".$d['brand']."' WHERE `brand_id`='".$d['brandid']."'";
			$this->db->query($sql);
			if($this->db->affected_rows()==0)
			{
				$sql="INSERT INTO `brand_master`(`brand_name`, `user_id`) VALUES ('".$d['brand']."','".$userId."')";
				$this->db->query($sql);
				echo json_encode($this->db->affected_rows(),true);
			}
			else "u";
		}
		
	}

	public function editCategories()
	{
		$page_name = 'Edit Categories';
		$categoryid = $this->input->post('categoryid');
		$data['CATEGORIES'] = $this->Crud->ciRead("category_master", "`category_id` = '$categoryid'");
		$data['CATEGORY'] = $this->Crud->ciRead("category_master", "`category_id` != '0'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/edit-categories', $data);
		$this->load->view('layouts/footer');
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

	public function changeProductStatus()
	{
		extract($_POST);
		$id = $id;
		$status = $status;

		$data = [
			'status' => $status,
		];

		if ($this->Crud->ciUpdate("product_master", $data, "`product_id` = '$id'")) {
			echo 1;
		} else {
			echo 0;
		}
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
			$config['upload_path'] = FCPATH . 'uploads/categories/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('avatar')) {
				$error = array('error' => $this->upload->display_errors());
			} else {

				$image_metadata = $this->upload->data();

				$avatar = $image_metadata['file_name'];
			}

			$data = [
				'under_category_id' => $category,
				'category_name' => $name,
				'user_id' => $userId,
				'avatar' => $avatar,
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
		$data['BRAND'] = $this->Crud->ciRead("brand_master", "`brand_id` != '0'");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/add-product', $data);
		$this->load->view('layouts/footer');
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

	public function addProductBasic(){
        $this->form_validation->set_rules('category', 'Category Name', 'required');
		$userId = $this->session->userdata('aiplAdminId');
        // Generate product id
        $str_result = '0123456789';
        $productId = 'PRO'.substr(str_shuffle($str_result), 0, 5);
            extract($_POST);
          
			$isExist = $this->Crud->ciCount("product_master", "`product_code` = '$productId' AND `HSN_code` = '$hsn' AND `user_id` = '$userId' AND `product_name` = '$product' AND `category_id` = '$category' AND `brand_id` = '$brand' AND `unit` = '$unit' AND `mrp` = '$mrp' AND `price` = '$sPrice' AND `gst` = '$gst' AND `product_description` = '$description' AND `country_of_origin` = '$country' AND `manufacturer` = '$manufacturer' AND `packer_details` = '$packer' AND `importer_details` = '$importer'");
			if($isExist > 0){
				redirect('product/products');
			}else{
            if ($this->form_validation->run()) {
                $this->load->library('upload');
                $dataInfo = array();
                $files = $_FILES;
               $cpt = count($_FILES['productImage']['name']);
               $cpt=($cpt>6?6:$cpt);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['productImage']['name'] = $files['productImage']['name'][$i];
                    $_FILES['productImage']['type'] = $files['productImage']['type'][$i];
                    $_FILES['productImage']['tmp_name'] = $files['productImage']['tmp_name'][$i];
                    $_FILES['productImage']['error'] = $files['productImage']['error'][$i];
                    $_FILES['productImage']['size'] = $files['productImage']['size'][$i];

                    $this->upload->initialize($this->set_upload_options());
                    $this->upload->do_upload('productImage');
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
                if (!isset($dataInfo[5]['file_name'])) {
                    $dataInfo[5]['file_name'] = NULL;
                }

               $data = array(
                    'product_code' => $productId,
                    'HSN_code' => $hsn,
                    'user_id' => $userId, 
                    'product_name' => $product,
                    'category_id' => $category,
                    'brand_id' => $brand,
                    'unit' => $unit,
                    'mrp' => $mrp,
                    'price' => $sPrice,
                    'gst' => $gst,
                    'product_description' => $description,
                    'product_image_one' => $dataInfo[0]['file_name'],
                    'product_image_two' => $dataInfo[1]['file_name'],
                    'product_image_three' => $dataInfo[2]['file_name'],
                    'product_image_four' => $dataInfo[3]['file_name'],
                    'product_image_five' => $dataInfo[4]['file_name'],
                    'product_image_six' => $dataInfo[5]['file_name'],
                    'manufacturer' => $manufacturer,
                    'packer_details' => $packer,
                    'importer_details' => $importer,
					'sponsor_repurchase_commission' => $sCommission                
                );

                if ($this->Crud->ciCreate('product_master', $data)) {
                    $this->session->set_flashdata('success', 'Product added successfully');
                    redirect('product/products');
                } else {
                    $this->session->set_flashdata('danger', 'Something went wrong');
					redirect('product/products');
                }
			}
        }
    }

	private function set_upload_options() {
        //upload an image options
        $config = array();
        $config['upload_path'] = 'uploads/products/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;
        $config['encrypt_name'] = TRUE;
        return $config;
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
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/manage-products', $data);
		$this->load->view('layouts/footer');
	}

	public function viewImages(){
		extract($_POST);
		$images = $this->Crud->ciRead("product_master", "`product_id` = '$id'");
		echo '<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/products/'.$images[0]->product_image_one).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/products/'.$images[0]->product_image_two).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/products/'.$images[0]->product_image_three).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/products/'.$images[0]->product_image_four).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/products/'.$images[0]->product_image_five).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('uploads/products/'.$images[0]->product_image_six).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>';
	}

	public function viewServiceImages(){
		extract($_POST);
		$images = $this->Crud->ciRead("service_master", "`id` = '$id'");
		echo '<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('../uploads/service/'.$images[0]->image_1).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('../uploads/service/'.$images[0]->image_2).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('../uploads/service/'.$images[0]->image_3).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('../uploads/service/'.$images[0]->image_4).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card">
					<img src="'. base_url('../uploads/service/'.$images[0]->image_5).'" style="height:150px; width:100%;" alt="">
				</div>
			</div>';
	}

	public function updateImage(){
		extract($_POST);
		$details = $this->Crud->ciRead("product_master", "`product_id` = '$id'");
		$image_name = $details[0]->$image;
		$image_field = 'image'.$id;
		$config['upload_path'] = FCPATH . '/uploads/products';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['overwrite'] = TRUE; 
		$config['file_name'] = $image_name; 
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload($image_field)) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('warning', $this->upload->display_errors());
		} else {
			$data = array('upload_data' => $this->upload->data());
			$this->session->set_flashdata('warning', $this->upload->display_errors());
		}
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
		$productid = $this->input->post('pcode');
		$data['products'] = $this->Crud->ciRead("product_master", "`product_id` = '$productid'");

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/product-details', $data);
		$this->load->view('layouts/footer');
	}

	public function product_edit(){
		$productid= $this->input->post('editpid');
        $catid=$this->input->post('editcatid');
        $pcode=$this->input->post('editpcode');
        $pname=$this->input->post('editpname');
        $data['catid']=$catid;
        // Fetch all category
        $cat="SELECT `category_id`,`category_name` FROM `category_master` where `under_category_id`=1 order by category_name";
        $query=$this->db->query($cat);
        $data['category'] = $query->result_array();
      
        $cat="SELECT * FROM `brand_master` order by `brand_name`";
        $query=$this->db->query($cat);
        $data['brand'] = $query->result_array();

		$cat="SELECT * FROM `unit` order by `unit`";
        $query=$this->db->query($cat);
        $data['unit'] = $query->result_array();
   
        // Fetch all category
        $cat="SELECT * FROM `product_master` WHERE `product_id`='".$productid."'";
        $query=$this->db->query($cat);
        $data['product'] = $query->result_array();

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header');
		$this->load->view('layouts/nav');
		$this->load->view('product/edit-product', $data);
		$this->load->view('layouts/footer');
	}

	public function getsubcategory1() {
		if(!empty($_POST["categoryID"])){ 
		$categoryID = $_POST['categoryID'];
            $SUBCATEGORIES = $this->Crud->ciRead('category_master', " `under_category_id` = '$categoryID' ");
			// Generate HTML of state options list 
            if($SUBCATEGORIES)
            {
                echo '<option value="">---Select---</option>'; 
                foreach ($SUBCATEGORIES as $key) {
                   echo'<option value="'.$key->category_id.'">'.$key->category_name.'</option>';
                }
            }
            else 
            { 
                echo 0;}
			 } 
		}

		public function updateProductBasic(){
			extract($_POST);
			
				/* delete Existing File */ 
				$this->load->helper("file");
				$productId=$this->input->post("productid");
				$pcode=$this->input->post("pcode");
				$path=FCPATH."uploads/products/";
				
				/* end delete */
				$this->load->library('upload');
				$dataInfo = array();
				$files = $_FILES;
				$cpt = count($_FILES['productImage']['name']);
				if($cpt>1)
				{
					$productimage1=$this->input->post("productImage1");      
					if (is_file($path.$productimage1) && file_exists($path.$productimage1)) unlink($path.$productimage1);     
					$productimage2=$this->input->post("productImage2");    
					if (is_file($path.$productimage2) && file_exists($path.$productimage2)) unlink($path.$productimage2);        
					$productimage3=$this->input->post("productImage3");     
					if (is_file($path.$productimage3) && file_exists($path.$productimage3)) unlink($path.$productimage3);        
					$productimage4=$this->input->post("productImage4");      
					if (is_file($path.$productimage4) && file_exists($path.$productimage4)) unlink($path.$productimage4);
					$productimage5=$this->input->post("productImage5");        
					if (is_file($path.$productimage5) && file_exists($path.$productimage5)) unlink($path.$productimage5);
					$productimage6=$this->input->post("productImage6");      
					if (is_file($path.$productimage6) && file_exists($path.$productimage6)) unlink($path.$productimage6);
				}             
				
				for ($i = 0; $i < $cpt; $i++) {
					echo $_FILES['productImage']['name'] = $files['productImage']['name'][$i];
					$_FILES['productImage']['type'] = $files['productImage']['type'][$i];
					$_FILES['productImage']['tmp_name'] = $files['productImage']['tmp_name'][$i];
					$_FILES['productImage']['error'] = $files['productImage']['error'][$i];
					$_FILES['productImage']['size'] = $files['productImage']['size'][$i];
					$this->upload->initialize($this->set_upload_options());
					$this->upload->do_upload('productImage');
					$dataInfo[] = $this->upload->data();
				} 
				
				$condition = "`product_id` = $productid";
				if($cpt>1){
				$data = array(
							'product_code' => $pcode,
							'HSN_code' => $hsn,
							'user_id' => $this->session->userdata('aiplAdminId'), 
							'product_name' => $product,
							'category_id' => $category,
							'brand_id' => $brand,
							'unit' => $unit,
							'mrp' => $mrp,
							'price' => $sPrice,
							'gst' => $gst,
							'product_description' => $description,
							
							'product_image_one' => ($dataInfo[0]?$dataInfo[0]['file_name']:''),
							'product_image_two' => ($dataInfo[1]?$dataInfo[1]['file_name']:''),
							'product_image_three' =>($dataInfo[2]?$dataInfo[2]['file_name']:''),
							'product_image_four' => ($dataInfo[3]?$dataInfo[3]['file_name']:''),
							'product_image_five' => ($dataInfo[4]?$dataInfo[4]['file_name']:''),
							'product_image_six' => ($dataInfo[5]?$dataInfo[5]['file_name']:''),
							'manufacturer' => $manufacturer,
							'packer_details' => $packer,
							'importer_details' => $importer, 
							'sponsor_repurchase_commission' => $sCommission               
					);
					}
					else {
					$data = array(
							'product_code' => $pcode,
							'HSN_code' => $hsn,
							'user_id' => $this->session->userdata('aiplAdminId'), 
							'product_name' => $product,
							'category_id' => $category,
							'brand_id' => $brand,
							'unit' => $unit,
							'mrp' => $mrp,
							'price' => $sPrice,
							'gst' => $gst,
							'manufacturer' => $manufacturer,
							'packer_details' => $packer,
							'importer_details' => $importer,
							'sponsor_repurchase_commission' => $sCommission           
						);
					}
				if ($this->Crud->ciUpdate('product_master', $data,$condition)) {
					$this->session->set_flashdata('success', 'Product added successfully');
					redirect('product/manageProducts/active');
				} else {
					$this->session->set_flashdata('danger', 'Something went wrong');
				}
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
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('service/categories', $data);
		$this->load->view('layouts/footer');
	}
	function addNewServiceCategory()
	{
		$userId = $this->session->userdata('aiplAdminId');
		if (isset($_POST['addCategory'])) {
			extract($_POST);

			$config['upload_path'] = FCPATH . 'uploads/categories/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('avatar')) {
				$error = array('error' => $this->upload->display_errors());
			} else {

				$image_metadata = $this->upload->data();

				$avatar = $image_metadata['file_name'];
			}

			$data = [
				'under_category_id' => $category,
				'category_name' => $name,
				'type'=>'s',
				'user_id' => $userId,
				'avatar' => $avatar,
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
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('service/edit-categories', $data);
		$this->load->view('layouts/footer');
	}

	public function manageServices()
	{
		$userList = $this->uri->segment(3);
		if ($userList == 'pending') {
			$page_name = 'Pending Service';
			$data['PRODUCT'] = $this->Crud->ciRead("service_master", "`status` = '1'");
		} else if ($userList == 'active') {
			$page_name = 'Inactive Service';
			$data['PRODUCT'] = $this->Crud->ciRead("service_master", "`status` = '2'");
		} else if ($userList == 'inactive') {
			$page_name = 'Inactive Service';
			$data['PRODUCT'] = $this->Crud->ciRead("service_master", "`status` = '0'");
		}

       	$data['page_name']=$page_name;
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('service/active_service', $data);
		$this->load->view('layouts/footer');
	}

	public function serviceRequest(){
		$id = $this->uri->segment(4);
		$status = $this->uri->segment(3);
		$table = 'service_master';
		$data = [
			'status' => $status
		];
		$condition = "`id` = '$id'";

		if($this->Crud->ciUpdate("$table", $data, $condition)){
			$this->session->set_flashdata("success", "Status changed successfully.");
			$referer = basename($_SERVER['HTTP_REFERER']);
        	redirect('product/manageServices/' . $referer);
		}else{
			$this->session->set_flashdata("success", "Something went wrong.");
			$referer = basename($_SERVER['HTTP_REFERER']);
        	redirect('product/manageServices/' . $referer);
		}
	}

	public function queries(){
		$page_name = 'Service Queries';
		$data['services_query'] = $this->Crud->ciRead("service_request", "`id` != '0' ORDER BY `added_date` desc");
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('service/query', $data);
		$this->load->view('layouts/footer');
	}
	public function setscratch()
	{
		$d=$this->input->post();
		$sql="UPDATE `product_master` SET `used_in_scratch`='".$d['status']."' WHERE `product_id`='".$d['pid']."'";
	
		$this->db->query($sql);
		echo $this->db->affected_rows();
	}

	public function changePerformanceBonusStatus(){
		extract($_POST);

		$data = [
			'monthly_performance_bonus' => $status
		];

		if($this->Crud->ciUpdate("product_master", $data, "`product_id` = '$id'")){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function changeTeamShoppingIncomeStatus(){
		extract($_POST);

		$data = [
			'team_shopping_income' => $status
		];

		if($this->Crud->ciUpdate("product_master", $data, "`product_id` = '$id'")){
			echo 1;
		}else{
			echo 0;
		}
	}

	public function stocks()
	{
		$page_name = 'Add Stock';
		$data['PRODUCTS'] = $this->Crud->ciRead("product_master", "`product_id` != '0'");
		$data['Stocks'] = $this->db->select('s.*, p.product_name')
			->from('stock_master s')
			->join('product_master p', 'p.product_id = s.product_id', 'left')
			->where('s.stock_type', 1)
			->get()
			->result_array();
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/add-stock', $data);
		$this->load->view('layouts/footer');
	}

	public function addStocks()
	{
		// validation rules
		$this->form_validation->set_rules('product_id', 'Product', 'required');
		$this->form_validation->set_rules('stock_in', 'Stock', 'required|integer|greater_than[0]');

		if ($this->form_validation->run() == FALSE) {
			// validation failed -> reload form with errors
			$this->session->set_flashdata('error', validation_errors());
			redirect('product/stocks');
		} else {
			// get form values
			$product_id = $this->input->post('product_id');
			$stock_in   = $this->input->post('stock_in');

			// data to insert
			$data = [
				'product_id' => $product_id,
				'stock_in'   => $stock_in,
				'entry_date' => date('Y-m-d H:i:s'),
				'stock_type' => 1
			];

			// insert into table
			$this->db->insert('stock_master', $data);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Stock added successfully.');
			} else {
				$this->session->set_flashdata('error', 'Failed to add stock. Please try again.');
			}

			redirect('product/stocks');
		}
	}

	// public function stockTransfer()
	// {
	// 	$page_name = 'Stock Transfer';
	// 	$data['PRODUCTS'] = $this->Crud->ciRead("product_master", "`product_id` != '0'");
	// 	$data['franchises'] = $this->Crud->ciRead("franchise_master", "`id` != '0'");
	// 	$data['Stocks'] = $this->db->select('s.*, p.product_name, f.name')
	// 		->from('stock_master s')
	// 		->join('product_master p', 'p.product_id = s.product_id', 'left')
	// 		->join('franchise_master f', 'f.id = s.franchise_id', 'left')
	// 		->where('s.stock_type', 2)
	// 		->get()
	// 		->result_array();

	// 	$data['AvailableStocks'] = $this->db->select("
	// 			product_id,
	// 			(SUM(CASE WHEN stock_type = 1 THEN stock_in ELSE 0 END) - 
	// 			SUM(CASE WHEN stock_type = 2 THEN stock_out ELSE 0 END)) as available_stock
	// 		", false)
	// 		->from('stock_master')
	// 		->group_by('product_id')
	// 		->having('available_stock >', 0)
	// 		->get()
	// 		->result_array();


	// 	$this->load->view('layouts/header');
	// 	$this->load->view('layouts/bar');
	// 	$this->load->view('layouts/sub-header', compact('page_name'));
	// 	$this->load->view('layouts/nav');
	// 	$this->load->view('product/stock-transfer', $data);
	// 	$this->load->view('layouts/footer');
	// }

	public function stockTransfer()
    {
        $page_name = 'Stock Transfer';
        $data['PRODUCTS'] = $this->Crud->ciRead("product_master", "`product_id` != '0'");
        // $data['franchises'] = $this->Crud->ciRead("franchise_master", "`id` != '0'");
        $data['franchises'] = $this->Crud->ciRead("user_master", "`user_type` = '3'", "user_name");
        // $data['Stocks'] = $this->db->select('s.*, p.product_name, f.name')
        // 	->from('stock_master s')
        // 	->join('product_master p', 'p.product_id = s.product_id', 'left')
        // 	//->join('franchise_master f', 'f.id = s.franchise_id', 'left')
        // 	->join('user_master f', 'f.user_id = s.franchise_id', 'left')
        // 	->where('s.stock_type', 2)
        // 	->get()
        // 	->result_array();

        $query = $this->db->select('s.*, p.product_name, f.user_name')
			->from('stock_master s')
			->join('product_master p', 'p.product_id = s.product_id', 'left')
			->join('user_master f', 'f.user_id = s.franchise_id', 'left') // assuming 'id' is PK in user_master
			->where('s.stock_type', 2)
			->get();

        if (!$query) {
            echo $this->db->last_query();  // optional: see generated SQL
            echo '<br>Error: ' . $this->db->error()['message'];  // show actual DB error
            exit;
        }

        $data['Stocks'] = $query->result_array();

        $data['AvailableStocks'] = $this->db->select("
				product_id,
				(SUM(CASE WHEN stock_type = 1 THEN stock_in ELSE 0 END) - 
				SUM(CASE WHEN stock_type = 2 THEN stock_out ELSE 0 END)) as available_stock
			", false)
            ->from('stock_master')
            ->group_by('product_id')
            ->having('available_stock >', 0)
            ->get()
            ->result_array();


        $this->load->view('layouts/header');
        $this->load->view('layouts/bar');
        $this->load->view('layouts/sub-header', compact('page_name'));
        $this->load->view('layouts/nav');
        $this->load->view('product/stock-transfer', $data);
        $this->load->view('layouts/footer');
    }

	public function addStockTransfer()
	{
		// validation rules
		$this->form_validation->set_rules('product_id', 'Product', 'required');
		$this->form_validation->set_rules('franchise_id', 'Franchise', 'required');
		$this->form_validation->set_rules('stock_out', 'Stock', 'required|integer|greater_than[0]');

		if ($this->form_validation->run() == FALSE) {
			// validation failed -> reload form with errors
			$this->session->set_flashdata('error', validation_errors());
			redirect('product/stockTransfer');
		} else {
			// get form values
			$product_id = $this->input->post('product_id');
			$franchise_id = $this->input->post('franchise_id');
			$stock_out   = $this->input->post('stock_out');

			// data to insert
			$data = [
				'product_id' => $product_id,
				'franchise_id' => $franchise_id,
				'stock_out'   => $stock_out,
				'entry_date' => date('Y-m-d H:i:s'),
				'stock_type' => 2
			];

			// insert into table
			$this->db->insert('stock_master', $data);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('success', 'Stock Transfer successfully.');
			} else {
				$this->session->set_flashdata('error', 'Failed to Transfer stock. Please try again.');
			}

			redirect('product/stockTransfer');
		}
	}

	public function returnStock()
	{
		// Validation rules
		$this->form_validation->set_rules('stock_id', 'Stock ID', 'required|integer');
		$this->form_validation->set_rules('return_qty', 'Return Quantity', 'required|integer|greater_than[0]');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$stock_id = $this->input->post('stock_id', true);
			$return_qty = $this->input->post('return_qty', true);

			// Get current stock row
			$stock = $this->db->get_where('stock_master', ['id' => $stock_id])->row_array();

			if (!$stock) {
				$this->session->set_flashdata('error', 'Stock entry not found!');
				redirect($_SERVER['HTTP_REFERER']);
			}

			// Validate return quantity
			if ($return_qty > $stock['stock_out']) {
				$this->session->set_flashdata('error', 'Return quantity cannot exceed stock out.');
				redirect($_SERVER['HTTP_REFERER']);
			}

			// Calculate new stock values
			$new_stock_out = $stock['stock_out'] - $return_qty;
			$new_stock_in  = $stock['stock_in'] + $return_qty;

			// Update stock_master
			$update = $this->db->where('id', $stock_id)
							->update('stock_master', [
								'stock_out' => $new_stock_out,
								'stock_in'  => $new_stock_in
							]);

			if ($update) {
				$this->session->set_flashdata('success', 'Stock returned successfully!');
			} else {
				$this->session->set_flashdata('error', 'Failed to return stock!');
			}

			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function aiplStock()
	{
		$page_name = 'Stock Transfer';
		$data['TotalStocks'] = $this->db
		->select("
			p.product_id,
			p.product_name,
			SUM(CASE WHEN s.stock_type = 1 THEN s.stock_in ELSE 0 END)
			- SUM(CASE WHEN s.stock_type = 2 THEN s.stock_out ELSE 0 END) AS total_stock
		")
		->from('stock_master s')
		->join('product_master p', 'p.product_id = s.product_id', 'left')
		->where('s.stock_type !=', 3)   // exclude stock_type = 3
		->group_by('s.product_id')
		->get()
		->result_array();

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/sub-header', compact('page_name'));
		$this->load->view('layouts/nav');
		$this->load->view('product/total-aipl-stock', $data);
		$this->load->view('layouts/footer');
	}

	public function update_arrival_status(){
		extract($_POST);

		$data = [
			'new_arrival' => 0
		];

		if($this->Crud->ciUpdate("product_master", $data, "`product_id` = '$id'")){
			echo 1;
		}else{
			echo 0;
		}
	}
}