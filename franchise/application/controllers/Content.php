<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {

	 public function __construct() {

		parent::__construct();
        error_reporting(0);
		$this->load->library('form_validation');

        $this->load->model('Settings_model');
        
        $this->load->library('encryption');

		if (!$this->session->userdata('aiplAdminId') || $this->session->userdata('role') != '1') {

            redirect('authentication/login');

        }

     }

	 public function about_content() {

		$file = FCPATH . "content/about.txt";

		if ($this->input->post('submit')) {
			file_put_contents($file, $this->input->post('content'));
			$this->session->set_flashdata('success', 'File updated successfully!');
		}

  		$data['content'] = file_get_contents($file);

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('content/about', $data);
		$this->load->view('layouts/footer');

     }

	 public function mission_content() {

		$file = FCPATH . "content/mission.txt";

		if ($this->input->post('submit')) {
			file_put_contents($file, $this->input->post('content'));
			$this->session->set_flashdata('success', 'File updated successfully!');
		}

  		$data['content'] = file_get_contents($file);

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('content/mission', $data);
		$this->load->view('layouts/footer');

     }

	 public function vision_content() {

		$file = FCPATH . "content/vision.txt";

		if ($this->input->post('submit')) {
			file_put_contents($file, $this->input->post('content'));
			$this->session->set_flashdata('success', 'File updated successfully!');
		}

  		$data['content'] = file_get_contents($file);

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('content/vision', $data);
		$this->load->view('layouts/footer');

     }

	 public function privacy_policy_content() {

		$file = FCPATH . "content/vision.txt";

		if ($this->input->post('submit')) {
			file_put_contents($file, $this->input->post('content'));
			$this->session->set_flashdata('success', 'File updated successfully!');
		}

  		$data['content'] = file_get_contents($file);

		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('content/vision', $data);
		$this->load->view('layouts/footer');

     }

	 public function faq_content() {
		$file = file_get_contents(FCPATH . "content/faq.json");
  		$data['faqs'] = json_decode($file, true);
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('content/faq', $data);
		$this->load->view('layouts/footer');

     }

	 public function add_faq() {
		$file = FCPATH . "content/faq.json";
	  
		if (isset($_POST['addFAQ'])) {
			extract($_POST);
		  $faqs = json_decode(file_get_contents($file), true);
		  $faqs['faqs'][] = [
			'question' => $question,
			'answer' => $answer,
			'status' => $status,
		  ];
		  file_put_contents($file, json_encode($faqs));
		  $this->session->set_flashdata('success', 'FAQ added successfully!');
		  redirect('content/faq_content');
		}
	  }


	  public function edit_faq() {
		$file = FCPATH . "content/faq.json";
	  
		if(isset($_POST['editFAQ'])) {
			extract($_POST);
		  $faqs = json_decode(file_get_contents($file), true);
		  $faqs['faqs'][$faqid]['question'] = $question;
		  $faqs['faqs'][$faqid]['answer'] = $answer;
		  file_put_contents($file, json_encode($faqs));
		  $this->session->set_flashdata('success', 'FAQ updated successfully!');
		  redirect('content/faq_content');
		}
	  }

	  public function view_faq(){
		$file = FCPATH . "content/faq.json";
		$faqs = json_decode(file_get_contents($file), true);

		extract($_POST);
		$faq = $faqs['faqs'][$id];
		echo $result = '<div class="row px-4">
		<div class="col-lg-12">
			<div class="form-group">
				<label for="name">Question</label>
				<input type="text" name="question" value="'.$faq['question'].'" placeholder="Question" id="question" class="form-control" required>
				<input type="hidden" name="faqid" value="'.$id.'">
			</div>
		</div>
		<div class="col-lg-12">
			<div class="form-group">
				<label for="name">Answer</label>
				<textarea type="text" name="answer" rows="5" placeholder="Answer" id="answer" class="form-control" required>'.$faq['answer'].'</textarea>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="form-group">
				<label for="name">Status</label>
				<select name="status" id="" class="form-control">
					<option value="active">Active</option>
					<option value="block">Blocked</option>
				</select>
			</div>
		</div>
	</div>';
	  }

	public function delete_faq() {
		$file = FCPATH . "content/faq.json";
		$index = $this->uri->segment(3);
		$faqs = json_decode(file_get_contents($file), true);
		unset($faqs['faqs'][$index]);
		file_put_contents($file, json_encode($faqs));
		$this->session->set_flashdata('success', 'FAQ deleted successfully!');
		redirect('content/faq_content');
	}

	public function block() {
		$file = FCPATH . "content/faq.json";
		echo $faqid = $this->uri->segment(3);
		$faqs = json_decode(file_get_contents($file), true);
		$faqs['faqs'][$faqid]['status'] = 'block';
		file_put_contents($file, json_encode($faqs));
		$this->session->set_flashdata('success', 'FAQ updated successfully!');
		redirect('content/faq_content');
	}

	public function unblock() {
		$file = FCPATH . "content/faq.json";
		echo $faqid = $this->uri->segment(3);
		$faqs = json_decode(file_get_contents($file), true);
		$faqs['faqs'][$faqid]['status'] = 'active';
		file_put_contents($file, json_encode($faqs));
		$this->session->set_flashdata('success', 'FAQ updated successfully!');
		redirect('content/faq_content');
	}

	public function slider() {
		$this->load->view('layouts/header');
		$this->load->view('layouts/bar');
		$this->load->view('layouts/nav');
		$this->load->view('layouts/sub-header');
		$this->load->view('content/slider');
		$this->load->view('layouts/footer');

     }

	 public function addSlider(){
        if (isset($_POST['addSlider'])) {
            extract($_POST);
			echo $id = $no;
            $config['upload_path'] = FCPATH . '../assets/images/slider';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['overwrite'] = TRUE; // This allows the existing file to be overwritten
            $config['file_name'] = $id . '.png'; // Set the file name to the id of the record being updated
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('slider')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
                $this->session->set_flashdata('warning', $this->upload->display_errors());
            }
            redirect('content/slider');
        }
	 }

	 public function remove_image() {
		$image = $this->uri->segment(3);
		$filename = $image.'.png';
		$file_path = FCPATH . "../assets/images/slider/" . $filename;
		if (file_exists($file_path)) {
		  unlink($file_path);
		  $this->session->set_flashdata('success', 'Image removed successfully!');
		} else {
		  $this->session->set_flashdata('error', 'Image not found!');
		}
		redirect('content/slider');
	  }

}