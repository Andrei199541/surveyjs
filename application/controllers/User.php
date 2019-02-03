<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

	public function login() {
		$email = $this->input->get('email');
		$password = $this->input->get('password');
		$result = $this->user_model->login($email, $password);
		exit( json_encode($result));
	}

	public function logout() {
		$this->session->sess_destroy();
        return redirect('/');
	}

	public function register() {
		$name = $this->input->get("name");
		$email = $this->input->get("email");
		$pwd = $this->input->get("password");
		$result = $this->user_model->register($name, $email, $pwd);
		exit( json_encode($result));
	}

	public function forgot() {
		$email = $this->input->get('email');
		$result = $this->user_model->forgot($email);
		exit($result);
	}

	public function customers() {
		if (!isAdmin()) {
			$this->logout();
		}
		$data['css'] = array(
			'vendor/dataTables.bootstrap4.min',
			'vendor/jquery.contextMenu.min',
			'vendor/datatables.responsive.bootstrap4.min',
			'vendor/perfect-scrollbar',
			'dore/main',
			'dore/customer',
		);
		$data['vendorJS'] = array(
			'datatables.min',
			'perfect-scrollbar.min',
			'Sortable',
		);
		$data['js'] = array('customers');
		$this->load->model("user_model");
		$info = $this->user_model->getUserInfo();
		$users = $this->user_model->getUsers();
		$user['info'] = $info;
		$data['users'] = $users;
		$data['mainMenu'] = "user_menu";
		$data['subMenu'] = "user_customer";
		$this->load->view('template/dore/header', $data);
		$this->load->view('template/dore/topbar', $user);
		$this->load->view('template/dore/sidebar');
		$this->load->view('admin/customers', $users);
		$this->load->view('template/dore/footer');
		$this->load->view('template/dore/link', $data);
	}

	public function changeAccount() {
		$data = $this->input->post();
		$email = $this->session->userdata("user_key");
		$result = $this->user_model->changeUserByEmail($data, $email);
		exit(json_encode($result));
	}

	public function changeUserInfo() {
		$data = $this->input->post();
		$result = $this->user_model->changeUserInfo($data);
		exit(json_encode($result));
	}

	public function deleteUser() {
		if (!isAdmin()) {
			$this->logout();
		}
		$id = $this->input->get("id");
		$result = $this->user_model->deleteRow($id);
		exit(json_encode($result));
	}
}
