<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChangeName extends CI_Controller {

	public function index()
	{
		$id = $this->input->get('id');
		$name = $this->input->get('name');
		$jsonFile = "./data.json";
		$jsonData = json_decode(file_get_contents($jsonFile));
		if ($jsonData) {
			if ($jsonData->Id == $id) {
				$jsonData->title = $name;
			}
		}
		file_put_contents($jsonFile, json_encode($jsonData));
		exit( json_encode($jsonData) );
	}
}
