<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot extends CI_Controller {

	public function index()
	{
		$data['js'] = array('user');
		$data['mainMenu'] = "home";
		$data['subMenu'] = "forgot";
		$this->load->view('template/dore/header', $data);
		$this->load->view('user/forgot');
		$this->load->view('template/dore/footer');
		$this->load->view('template/dore/link', $data);
	}
}
