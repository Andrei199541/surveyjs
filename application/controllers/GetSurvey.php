<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GetSurvey extends CI_Controller {

	public function index()
	{
		$surveyId = $this->input->get('surveyId');
		$jsonFile = './data.json';

		$jsonData = file_get_contents($jsonFile);
		// print_r(json_decode($jsonData));exit;
		exit($jsonData);
	}
}
