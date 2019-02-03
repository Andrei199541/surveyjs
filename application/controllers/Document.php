<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {

	function __construct() {
		parent:: __construct();
		isUser();
		$this->load->model("file_manage_model");
	}

	public function uploads()
	{
		if (!isAdmin()) {
			$this->logout();
		}
		$data['css'] = array(
			'vendor/dropzone.min',
			'vendor/dataTables.bootstrap4.min',
			'vendor/datatables.responsive.bootstrap4.min',
			'vendor/perfect-scrollbar',
			'dore/main',
			'dore/customer',
		);
		$data["js"] = array('user');
		$data['vendorJS'] = array(
			'dropzone.min',
			'mousetrap.min',
			'perfect-scrollbar.min',
			'jquery.contextMenu.min',
		);
		$data['mainMenu'] = "document_menu";
		$data['subMenu'] = "uploads";
		$this->load->model("user_model");
		$info = $this->user_model->getUserInfo();
		$user['info'] = $info;

		$this->load->view('template/dore/header', $data);
		$this->load->view('template/dore/topbar', $user);
		$this->load->view('template/dore/sidebar');
		$this->load->view('admin/uploads');
		$this->load->view('template/dore/footer');
		$this->load->view('template/dore/link', $data);
	}

	public function getCounts() {
		$count = $this->file_manage_model->getCounts();
		exit( json_encode(ceil($count / 10)) );
	}

	public function getFiles() {
		$limit = $this->input->get("c");
		$result = $this->file_manage_model->getFiles($limit);
		exit( json_encode($result) );
	}
}
