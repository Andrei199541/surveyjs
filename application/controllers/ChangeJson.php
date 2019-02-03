<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChangeJson extends CI_Controller {

	public function index()
	{
		$jsonFile = "./data.json";

		$surveyId = $this->input->get();
		$jsonData = json_decode(file_get_contents('php://input'), true);
		
		$saveAry = array();
		if (sizeof ($jsonData)) {
			$saveAry['Id'] = $jsonData['Id'];
			$saveAry['Json'] =  json_decode($jsonData['Json']);
		}
		// print_r($saveAry['Json']);exit;
		$saveAry = json_encode($saveAry['Json']);
		
		file_put_contents($jsonFile, $saveAry);

		exit ( file_get_contents($jsonFile) );
	}
}
