<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$data['js'] = array("user");
		$data['mainMenu'] = "home";
		$data['subMenu'] = "login";
		$this->load->view('template/dore/header');
		$this->load->view('user/login');
		$this->load->view('template/dore/footer');
		$this->load->view('template/dore/link', $data);
	}
}
