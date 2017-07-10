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
		
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}
	
		// Access-Control headers are received during OPTIONS requests
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
	
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	
			exit(0);
		}
	}

	public function device_get_shipment($id) {
		$result = $this->Api_model->getKirimanDriverByDeviceId($id);
		echo json_encode($result);
	}

	public function device_get_shipment_detail($id) {
		$result = $this->Api_model->getKirimanDetail($id);
		echo json_encode($result);
	}

	public function post_coordinate() {
		$device_id = $this->input->post("device_id", true);
		$device_gps_lat = $this->input->post("lat", true);
		$device_gps_lng = $this->input->post("lng", true);
		$device_gps_accuracy = $this->input->post("accuracy", true);
		if ($device_id != null && $device_gps_lat != null && $device_gps_lng != null) {
			$data = array(
				"device_id" => $device_id,
				"device_gps_lat" => $device_gps_lat,
            	"device_gps_lng" => $device_gps_lng,
				"device_gps_accuracy" => $device_gps_accuracy
			);
			$affected_rows = $this->Api_model->postCoordinate($data);
			if ($affected_rows > 0) {
				echo "success";
			} else {
				echo "failed";
			}
		} else {
			echo "no data found <br>" . $device_id . "<br>" . $device_gps_lat . "<br>" . $device_gps_lng;
		}
	}
}
