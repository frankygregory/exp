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
		
		/*if (isset($_SERVER['HTTP_ORIGIN'])) {
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
		}*/
	}

	public function login() {
		$device_email = $this->input->post("email", true);
		$device_password = $this->input->post("password", true);
		$firebase_token = $this->input->post("firebase_token", true);
		if ($device_email != null && $device_password != null) {
			$data = array(
				"device_email" => $device_email,
				"device_password" => $device_password,
				"firebase_token" => $firebase_token
			);
			$result = $this->Api_model->login($data)[0];
			echo json_encode($result);
		} else {
			echo "{}";
		}
	}

	public function device_get_shipment($id) {
		$token = $this->input->post("token", true);
		$data = array(
			"device_id" => $id,
			"token" => $token
		);
		
		if ($token != null) {
			$result = $this->Api_model->getKirimanDriverByDeviceId($data);
			echo json_encode($result);
		} else {
			echo "{}";
		}
	}

	public function device_get_shipment_detail($id) {
		$token = $this->input->post("token", true);
		$device_id = $this->input->post("device_id", true);
		$data = array(
			"shipment_id" => $id,
			"token" => $token,
			"device_id" => $device_id
		);

		if ($token != null && $device_id != null) {
			$result = $this->Api_model->getKirimanDetail($data);
			echo json_encode($result);
		} else {
			echo "{}";
		}
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
			echo "no input found";
		}
	}

	public function submit_terima() {
		$token = $this->input->post("token", true);
		$device_id = $this->input->post("device_id", true);
		$shipment_id = $this->input->post("shipment_id", true);
		if ($shipment_id != null && $device_id != null && $token != null) {
			$data = array(
				"token" => $token,
				"device_id" => $device_id,
				"shipment_id" => $shipment_id
			);
			$result = $this->Api_model->submitTerima($data);
			echo json_encode($result);
		} else {
			echo "{}";
		}
	}

	public function submit_ambil() {
		$token = $this->input->post("token", true);
		$device_id = $this->input->post("device_id", true);
		$shipment_id = $this->input->post("shipment_id", true);
		if ($shipment_id != null && $device_id != null && $token != null) {
			$data = array(
				"token" => $token,
				"device_id" => $device_id,
				"shipment_id" => $shipment_id
			);
			$result = $this->Api_model->submitAmbil($data);
			echo json_encode($result);
		} else {
			echo "{}";
		}
	}

	public function submit_kirim() {
		$token = $this->input->post("token", true);
		$device_id = $this->input->post("device_id", true);
		$shipment_id = $this->input->post("shipment_id", true);
		if ($shipment_id != null && $device_id != null && $token != null) {
			$data = array(
				"token" => $token,
				"device_id" => $device_id,
				"shipment_id" => $shipment_id
			);
			$result = $this->Api_model->submitKirim($data);
			echo json_encode($result);
		} else {
			echo "{}";
		}
	}
}
