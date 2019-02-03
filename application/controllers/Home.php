<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
        parent::__construct();
        isUser();
    }

	public function index()
	{
		$data['css'] = array(
			'vendor/perfect-scrollbar',
			'dore/main'
		);
		$data['vendorJS'] = array(
			'perfect-scrollbar.min'
		);
		$data["js"] = array(
			'user'
		);
		$data['mainMenu'] = "user_menu";
		$data['subMenu'] = "user_account";
		$this->load->model("user_model");
		$info = $this->user_model->getUserInfo();
		$user['info'] = $info;
		$this->load->view('template/dore/header', $data);
		$this->load->view('template/dore/topbar', $user);
		$this->load->view('template/dore/sidebar');
		$this->load->view('user/account', $user);
		$this->load->view('template/dore/footer');
		$this->load->view('template/dore/link', $data);
	}
}
