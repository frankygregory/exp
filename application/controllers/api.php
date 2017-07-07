<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//ini_set('max_execution_time', 0); 
//ini_set('memory_limit','2048M');

class Api extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		$this->output->set_header('Access-Control-Allow-Origin: *');
		$this->load->model("Api_model");
	}

	public function device_get_shipment($id) {
		$result = $this->Api_model->getKirimanDriverByDeviceId($id);
		echo json_encode($result);
	}

	public function device_get_shipment_detail($id) {
		$result = $this->Api_model->getKirimanDetail($id);
		echo json_encode($result);
	}
}
