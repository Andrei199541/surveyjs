<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$user = $this->session->userdata("user_key");
		if ($user) {
			redirect("Home");
		} else {
			redirect("Login");
		}
	}
}
