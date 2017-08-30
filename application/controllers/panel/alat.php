<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alat extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->model("Alat_model");
    }

    public function index()
    {
		$this->activeMenu["alat"] = "active";
        $data = array(
            'title' => 'Alat',
			'page_title' => "Alat"
        );
        parent::template('alat', $data);
	}
	
	function getAlatLocation() {
		parent::checkAjaxRequest();
		
		$device_id = $this->input->post("device_id", true);
		$data = array(
			"device_id" => $device_id
		);
		$result = $this->Alat_model->getAlatLocation($data)[0];
		if ($result->status == "success") {
			$postData = array(
				"data" => array(
					"message" => "coba kirim dari php",
					"type" => "request_location",
					"device_gps_id" => $result->device_gps_id
				),
				"to" => $result->firebase_token
			);
	
			$ch = curl_init('https://fcm.googleapis.com/fcm/send');
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt_array($ch, array(
				CURLOPT_POST => true,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTPHEADER => array(
					"Authorization:key=AAAAA_VaulM:APA91bFLRWUqDySQaRZezmMk8wNBWFRmVi73oZdG5SQnnCn452-mt3C8OqYD1Axa9rwQRbeofJyMckei3GKxx7xdokQblAOONDoDXPZBfc2NHZLFf_UFJR_9jd0Snzp7tFYVdstEeAVf",
					"Content-Type: application/json"
				),
				CURLOPT_POSTFIELDS => json_encode($postData)
			));
			$response = curl_exec($ch);
			if ($response === FALSE) {
				echo curl_error($ch);
			} else {
				$data = new stdClass();
				$data->result = $result;
				$data->response = json_decode($response);
				echo json_encode($data);
			}
		} else {
			echo json_encode(array(
				"status" => "error",
				"error_code" => $db->error()["code"],
				"error_message" => $db->error()["message"]
			));
		}
	}

	function getAlatLocationFromRequest() {
		parent::checkAjaxRequest();
		
		$device_gps_id = $this->input->post("device_gps_id", true);
		$data = array(
			"device_gps_id" => $device_gps_id
		);
		$result = $this->Alat_model->getAlatLocationFromRequest($data);
		if (sizeof($result) > 0) {
			$result = $result[0];
			$result->modified_date = date_format(new DateTime($result->modified_date), "d-m-Y H:i");
		}
		echo json_encode($result);
	}
	
	function getAlat() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$alat = $this->Alat_model->getAlatByUserId($user_id);
		echo json_encode($alat);
	}

	function getAlatLastLocation() {
		parent::checkAjaxRequest();

		$device_id = $this->input->post("device_id", true);
		$data = array(
			"device_id" => $device_id
		);
		$location = $this->Alat_model->getAlatLastLocation($data);
		if (sizeof($location) > 0) {
			$location = $location[0];
			$location->modified_date = date_format(new DateTime($location->modified_date), "d-m-Y H:i");
		}
		echo json_encode($location);
	}

	public function checkUserKembar() {
		parent::checkAjaxRequest();
		parent::checkUserKembar();
	}

	public function checkEmailKembar() {
		parent::checkAjaxRequest();
		parent::checkEmailKembar();
	}
	
	public function tambahAlat() {
		parent::checkAjaxRequest();

		$config = parent::get_default_email_config();
		$this->load->library("email", $config);

		$submit_tambah = $this->input->post("submit_tambah");
		$device_name = $this->input->post("device_name", true);
		$device_information = $this->input->post("device_information", true);
		$device_email = $this->input->post("device_email", true);
		$device_password = $this->input->post("device_password", true);
		$device_status = intval($this->input->post("device_status", true));

		if ($submit_tambah && $device_name && $device_information && $device_email && $device_password) {
			$user_id = $this->session->userdata("user_id", true);
			$group_id = $this->session->userdata("group_id", true);
			
			$insertData = array(
				"device_name" => $device_name,
				"device_information" => $device_information,
				"device_email" => $device_email,
				"device_password" => $device_password,
				"device_status" => $device_status,
				"user_id" => $user_id,
				"group_id" => $group_id
			);
			$result = $this->Alat_model->addAlat($insertData)[0];
			if ($result->status == "success") {
				$this->email->set_newline("\r\n");
				$this->email->from("admin@wahanafurniture.com", "Yukirim");
				$this->email->to($device_email);
				$this->email->subject("Verifikasi Alat Yukirim");
				$this->email->message("Dear " . $result->user_fullname . ",\n\nUntuk mengaktifkan account alat, silakan mengklik link di bawah ini:\n" . base_url("verify-device-email/" . $result->generated_token) . "\n\nBest regards,\n\nYukirim");
				$this->email->send();

				$this->session->set_flashdata('flash_message', 'Kode verifikasi untuk mengaktifkan account pada ' . $device_name . ' telah dikirim ke ' . $device_email);
				echo json_encode(array(
					"status" => "success",
					"message" => "Kode verifikasi untuk mengaktifkan account pada " . $device_name . " telah dikirim ke " . $device_email
				));
			} else {
				echo json_encode(array(
					"status" => $result->status
				));
			}
		}
	}
	
	public function updateAlat() {
		parent::checkAjaxRequest();

		$submit_update = $this->input->post("submit_update");
		$device_id = $this->input->post("device_id");
		$device_name = $this->input->post("device_name");
		$device_information = $this->input->post("device_information");
		$device_status = intval($this->input->post("device_status"));

		if ($submit_update && $device_id && $device_name && $device_information) {
			$user_id = $this->session->userdata("user_id");
			
			$data = array(
				"device_id" => $device_id,
				"device_name" => $device_name,
				"device_information" => $device_information,
				"device_status" => $device_status,
				"modified_by" => $user_id
			);
			$db = $this->Alat_model->updateAlat($data);
			parent::generate_common_results($db, "ci");
		}
	}

	public function gantiPassword() {
		parent::checkAjaxRequest();

		$device_id = $this->input->post("device_id", true);
		$device_password = $this->input->post("device_password", true);
		if ($device_id && $device_password) {
			$user_id = $this->session->userdata("user_id");
			$data = array(
				"device_id" => $device_id,
				"device_password" => $device_password,
				"user_id" => $user_id
			);
			$result = $this->Alat_model->gantiPassword($data);
			if ($result->error()["code"] == 0) {
				echo json_encode(array(
					"status" => "success"
				));
			} else {
				echo json_encode(array(
					"status" => "error",
					"error_message" => $result->error()["message"]
				));
			}
		}
	}
	
	public function deleteAlat() {
		parent::checkAjaxRequest();
		
		$device_id = $this->input->post("device_id");
		$user_id = $this->session->userdata("user_id");
		$db = $this->Alat_model->deleteAlat($device_id, $user_id);
		parent::generate_common_results($db, "ci");
	}
}