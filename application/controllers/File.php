<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Controller {

	function __construct() {
		parent::__construct();
		isUser();
		$this->load->model("file_manage_model");
	}

	public function post()
	{
		if (isAdmin()) {
			$file = $_FILES;
			$result = $this->file_manage_model->upload($file);
			exit( json_encode($result) );
		}
	}

	public function profileImage() {
		$file = $_FILES;
		$result = $this->file_manage_model->uploadProfileImage($file);
		exit( json_encode($result) );
	}

	public function checkFileName() {
		$filename = $this->input->get("filename");
		$res = $this->file_manage_model->checkFileName($filename);
		exit(json_encode($res));
	}

	public function deleteUploadedFile() {
		$id = $this->input->get("key");
		$res = $this->file_manage_model->deleteUploadedDocumentFile($id);
		exit(json_encode($res));
	}
}
