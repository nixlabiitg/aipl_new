<?php
    class Tiesup extends CI_Controller
    {    
        
        public function __construct() {
            error_reporting(0);
            parent::__construct();
            $this->load->library('form_validation');
            if (!$this->session->userdata('aiplAdminId')) {
                redirect('authentication/login');
            }
        }

        public function create_tiesup()
        {
            $data['page_name'] = 'Create Ties Up';
            $this->load->view('layouts/header');
            $this->load->view('layouts/bar');
            $this->load->view('layouts/sub-header');
            $this->load->view('layouts/nav');
            $this->load->view('tiesup/create-tiesup', $data);
            $this->load->view('layouts/footer');
        }

        public function manage_tiesup(){
            $data['page_name'] = 'Manage Ties Up';
            $data['TIESUP'] = $this->Crud->ciRead("tiesup_master", "`id` <> 0");
            $this->load->view('layouts/header');
            $this->load->view('layouts/bar');
            $this->load->view('layouts/sub-header');
            $this->load->view('layouts/nav');
            $this->load->view('tiesup/manage-tiesup', $data);
            $this->load->view('layouts/footer');
        }

        public function add_tiesup(){
            extract($_POST);

            $config['upload_path'] = FCPATH . '../uploads/tiesup/';

            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $config['max_size'] = 2048;

            $config['max_width'] = 5000;

            $config['encrypt_name'] = TRUE;

            $config['max_height'] = 5000;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('tiesimage')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
                redirect('tiesup/create_tiesup');
            } else {

                $image_metadata = $this->upload->data();

                $ties_image = $image_metadata['file_name'];
            }

            $data = [
                'company_name' => $name,
                'ties_image' => $ties_image
            ];

            if($this->Crud->ciCreate("tiesup_master", $data)){
                $this->session->set_flashdata("success", "Ties Up added successfully.");
            }else{
                $this->session->set_flashdata("danger", "Something went wrong. Please try again.");
            }

            redirect('tiesup/create_tiesup');
        }

        public function remove_tieup(){
            extract($_POST);

            if($this->Crud->ciDelete("tiesup_master", "`id` = '$id'")){
                echo 1;
            }else{
                echo 0;
            }
        }

        public function change_tiesup_status(){
            extract($_POST);

            $data = [
                'status' => $status
            ];

            if($this->Crud->ciUpdate("tiesup_master", $data, "`id` = '$id'")){
                echo 1;
            }else{
                echo 0;
            }
        }

        public function downloads(){
            $data['DOWNLOADS'] = $this->Crud->ciRead("download_master", "`id` <> 0");
            $data['page_name'] = 'Downloads';
            $this->load->view('layouts/header');
            $this->load->view('layouts/bar');
            $this->load->view('layouts/sub-header');
            $this->load->view('layouts/nav');
            $this->load->view('tiesup/downloads', $data);
            $this->load->view('layouts/footer');
        }

        public function add_download(){
            extract($_POST);

            $sql = $this->db->query("SELECT * FROM `download_master` WHERE `download_type` = '$download_type'");
            $isExist = $sql->num_rows();
            $details = $sql->result();

            if($isExist > 0){
                $file_name = $details[0]->download_file;
                $link = '../uploads/tiesup/'.$file_name;
                unlink($link);
                $this->Crud->ciDelete("download_master", "`download_type` = '$download_type'");
                
            }

            $config['upload_path'] = FCPATH . '../uploads/tiesup/';

            $config['allowed_types'] = 'pdf';

            $config['max_size'] = 5120;

            $config['max_width'] = 5000;

            $config['encrypt_name'] = TRUE;

            $config['max_height'] = 5000;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file_pdf')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
                redirect('tiesup/downloads');
            } else {
                $image_metadata = $this->upload->data();
                $download_file = $image_metadata['file_name'];

                $data = [
                    'download_type' => $download_type,
                    'download_file' => $download_file,
                    'added_on' => date('Y-m-d')
                ];
    
                if($this->Crud->ciCreate("download_master", $data)){
                    $this->session->set_flashdata("success", "Download added successfully.");
                }else{
                    $this->session->set_flashdata("danger", "Something went wrong. Please try again.");
                }
    
                redirect('tiesup/downloads');
            }
        }

        public function benefits(){
            $sql = $this->db->query('SELECT bm.*, bc.category FROM `benifit_master` bm JOIN benifit_category bc ON bc.id = bm.benifit_category_id');
            $data['BENEFIT'] = $sql->result();
            $data['CATEGORY'] = $this->Crud->ciRead("benifit_category", "`id` <> 0");
            $data['page_name'] = 'Benifits';
            $this->load->view('layouts/header');
            $this->load->view('layouts/bar');
            $this->load->view('layouts/sub-header');
            $this->load->view('layouts/nav');
            $this->load->view('tiesup/benifits', $data);
            $this->load->view('layouts/footer');
        }

        public function benefits_category(){
            $data['CATEGORY'] = $this->Crud->ciRead("benifit_category", "`id` <> 0");
            $data['page_name'] = 'Benifits Category';
            $this->load->view('layouts/header');
            $this->load->view('layouts/bar');
            $this->load->view('layouts/sub-header');
            $this->load->view('layouts/nav');
            $this->load->view('tiesup/benifits-category', $data);
            $this->load->view('layouts/footer');
        }

        public function webinar(){
            $data['WEBINAR'] = $this->Crud->ciRead("webinar_master", "`id` <> 0");
            $data['page_name'] = 'Add Webinar';
            $this->load->view('layouts/header');
            $this->load->view('layouts/bar');
            $this->load->view('layouts/sub-header');
            $this->load->view('layouts/nav');
            $this->load->view('tiesup/webinar', $data);
            $this->load->view('layouts/footer');
        }

        public function add_new_category(){
            extract($_POST);

            $isExist = $this->Crud->ciCount("benifit_category", "`category` = '$category'");
            if($isExist > 0){
                $this->session->set_flashdata("warning", "This category already exist.");
                redirect('tiesup/benifits_category');
            }else{
                $data = [
                    'category' => $category,
                    'added_on' => date('Y-m-d H:i:s'),
                ];

                if($this->Crud->ciCreate("benifit_category", $data)){
                    $this->session->set_flashdata("success", "Category added successfully.");
                }else{
                    $this->session->set_flashdata("danger", "Something went wrong. Please try again.");
                }

                redirect('tiesup/benefits_category');
            }
        }

        public function delete_category(){
            extract($_POST);

            if($this->Crud->ciDelete("benifit_category", "`id` = '$id'")){
                echo 1;
            }else{
                echo 0;
            }
        }

        public function add_benefit(){
            extract($_POST);

            $config['upload_path'] = FCPATH . '../uploads/tiesup/';

            $config['allowed_types'] = 'pdf';

            $config['max_size'] = 2048;

            $config['max_width'] = 5000;

            $config['encrypt_name'] = TRUE;

            $config['max_height'] = 5000;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file_pdf')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
                redirect('tiesup/benefits');
            } else {
                $image_metadata = $this->upload->data();
                $benifit_file = $image_metadata['file_name'];

                $data = [
                    'benifit_category_id' => $category,
                    'benifit_file' => $benifit_file,
                    'added_on' => date('Y-m-d')
                ];
    
                if($this->Crud->ciCreate("benifit_master", $data)){
                    $this->session->set_flashdata("success", "Benefit added successfully.");
                }else{
                    $this->session->set_flashdata("danger", "Something went wrong. Please try again.");
                }
    
                redirect('tiesup/benefits');
            }
        }

        public function delete_benefit(){
            extract($_POST);

            $details = $this->Crud->ciRead("benifit_master", "`id` = '$id'");
            $file_name = $details[0]->benifit_file;
            $link = '../uploads/tiesup/'.$file_name;

            if($this->Crud->ciDelete("benifit_master", "`id` = '$id'")){
                unlink($link);
                echo 1;
            }else{
                echo 0;
            }
        }

        public function add_webinar(){
            extract($_POST);

            $data = [
                'webinar_link' => $webinar_link,
                'webinar_date' => $webinar_date,
                'webinar_time' => $webinar_time,
                'note' => $note,
                'added_on' => date('Y-m-d H:i:s'),
            ];

            if($this->Crud->ciCreate("webinar_master", $data)){
                $this->session->set_flashdata("success", "Webinar added successfully.");
            }else{
                $this->session->set_flashdata("danger", "Something went wrong. Please try again.");
            }

            redirect('tiesup/webinar');
        }

        public function delete_webinar(){
            extract($_POST);

            if($this->Crud->ciDelete("webinar_master", "`id` = '$id'")){
                echo 1;
            }else{
                echo 0;
            }
        }
    }