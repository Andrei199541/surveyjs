<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questions extends CI_Controller {

	function __construct() {
		parent:: __construct();
		isUser();
		$this->load->model("question_management_model");
	}

	public function accessManage() {
		if (isAdmin()) {
			$data['css'] = array(
				'vendor/perfect-scrollbar',
				'vendor/select2.min',
				'vendor/select2-bootstrap.min',
				'dore/main'
			);
			$data['vendorJS'] = array(
				'perfect-scrollbar.min',
				'select2.full'
			);
			$data["js"] = array(
				'user'
			);
			$data['mainMenu'] = "question_menu";
			$data['subMenu'] = "access_management";

			$this->load->model("user_model");
			$info = $this->user_model->getUserInfo();
			$user['info'] = $info;

			$surveys = $this->question_management_model->getPageNames();
			$data["surveys"] = $surveys;

			$this->load->view('template/dore/header', $data);
			$this->load->view('template/dore/topbar', $user);
			$this->load->view('template/dore/sidebar');
			$this->load->view('admin/accessSurvey', $data);
			$this->load->view('template/dore/footer');
			$this->load->view('template/dore/link', $data);
		}
	}

	public function getAccess() {
		$result = $this->question_management_model->getAccess();
		exit( json_encode($result) );
	}

	public function setAccess() {
		$result = array();
		if (isAdmin()) {
			$free = $this->input->post("free");
			$freemium = $this->input->post("freemium");
			$paid = $this->input->post("paid");
			
			$result = $this->question_management_model->setAccess($free, $freemium, $paid);
			exit( json_encode($result) );
		}
	}

	public function management()
	{
		if (isAdmin()) {
			$checkCustomizeQuestions = $this->question_management_model->checkCustomizeQuestions();
			$data['css'] = array('index');
			$data['js']  = array('survey/editor');
			$data['checkCustomizeQuestions'] = $checkCustomizeQuestions;
			$data['mainMenu'] = "question_menu";
			$data['subMenu'] = "question_management";
			$data["title"] = "SurveyJS Editor";
			$data["flag"] = "editor";
			$this->load->view('template/header', $data);
			$this->load->view('questions');
			$this->load->view('template/link', $data);
		}
	}

	public function customQuestion() {
		if (isAdmin()) {
			$json = $this->input->post("json");
			$page = $this->input->post("page");
			$result = $this->question_management_model->setCustomQuestions($json, $page);
			exit( json_encode($result) );
		}
	}

	public function survey() {
		$data[] = array();
		$data['title'] = "Survey";
		$data['flag'] = "result";

		$json = $this->question_management_model->getJsonByRole();
		$data['json'] = json_encode($json);
		
		$this->load->view('template/header', $data);
		$this->load->view('user/survey', $data);
		$this->load->view('template/footer');
	}
}
