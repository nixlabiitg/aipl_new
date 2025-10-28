<?php
    class Ads extends CI_Controller
    {    
        
        public function __construct() {
            error_reporting(0);
            parent::__construct();
            $this->load->library('form_validation');
            if (!$this->session->userdata('aiplAdminId')) {
                redirect('authentication/login');
            }
        }

        public function create_ads()
        {
            $data['page_name'] = 'Create Ads';
            $this->load->view('layouts/header');
            $this->load->view('layouts/bar');
            $this->load->view('layouts/sub-header');
            $this->load->view('layouts/nav');
            $this->load->view('ads/create-ads', $data);
            $this->load->view('layouts/footer');
        }

        public function manage_ads(){
            $data['page_name'] = 'Manage Ads';
            $data['ADS'] = $this->Crud->ciRead("ads_master", "`id` <> 0");
            $this->load->view('layouts/header');
            $this->load->view('layouts/bar');
            $this->load->view('layouts/sub-header');
            $this->load->view('layouts/nav');
            $this->load->view('ads/manage-ads', $data);
            $this->load->view('layouts/footer');
        }

        public function uploadAds(){
            extract($_POST);

            $config['upload_path'] = FCPATH . 'uploads/ads/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['encrypt_name'] = TRUE;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('ads')) {
				$error = array('error' => $this->upload->display_errors());
			} else {

				$image_metadata = $this->upload->data();

				$ads = $image_metadata['file_name'];
			}

            $data = [
                'ads_image' => $ads
            ];

            if($this->Crud->ciCreate("ads_master", $data)){
                $this->session->set_flashdata("success", "Ads uploaded successfully.");
            }else{
                $this->session->set_flashdata("danger", "Something went wrong. Please try agaian.");
            }

            redirect('ads/create_ads');
        }

        public function remove_ad(){
            extract($_POST);

            if($this->Crud->ciDelete("ads_master", "`id` = '$id'")){
                echo 1;
            }else{
                echo 0;
            }
        }

        public function change_ads_status(){
            extract($_POST);

            $data = [
                'status' => $status
            ];

            if($this->Crud->ciUpdate("ads_master", $data, "`id` = '$id'")){
                echo 1;
            }else{
                echo 0;
            }
        }
    }