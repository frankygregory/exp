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
	
	function getAlat() {
		$user_id = $this->session->userdata("user_id");
		$alat = $this->Alat_model->getAlatByUserId($user_id);
		echo json_encode($alat);
	}

	public function checkUserKembar() {
		parent::checkUserKembar();
	}

	public function checkEmailKembar() {
		parent::checkEmailKembar();
	}
	
	public function tambahAlat() {
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
				$this->email->message("Untuk mengaktifkan account alat, silakan mengklik link di bawah ini:\n" . base_url("verify-device-email/" . $result->generated_token) . "\n\nBest regards,\n\nYukirim");
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
	
	public function toggleAlatAktif() {
		$device_id = $this->input->post("device_id");
		$device_status = intval($this->input->post("device_status"));
		$user_id = $this->session->userdata("user_id");
		if ($device_id) {
			$data = array(
				"device_id" => $device_id,
				"device_status" => $device_status,
				"modified_by" => $user_id
			);
			$db = $this->Alat_model->toggleAlatAktif($data);
			parent::generate_common_results($db, "ci");
		}
	}
	
	public function deleteAlat() {
		$device_id = $this->input->post("device_id");
		$user_id = $this->session->userdata("user_id");
		$db = $this->Alat_model->deleteAlat($device_id, $user_id);
		parent::generate_common_results($db, "ci");
	}
}