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
	
	public function tambahAlat() {
		$submit_tambah = $this->input->post("submit_tambah");
		if ($submit_tambah != null) {
			$device_name = $this->input->post("device_name");
			$device_information = $this->input->post("device_information");
			$device_email = $this->input->post("device_email");
			$device_status = intval($this->input->post("device_status"));
			$user_id = $this->session->userdata("user_id");
			$group_id = $this->session->userdata("group_id");
			
			$insertData = array(
				"device_name" => $device_name,
				"device_information" => $device_information,
				"device_email" => $device_email,
				"device_status" => $device_status,
				"user_id" => $user_id,
				"group_id" => $group_id
			);
			$affected_rows = $this->Alat_model->addAlat($insertData);
			if ($affected_rows > 0) {
				echo "success";
			} else {
				echo "no rows affected. WHY??";
			}
		} else {
			
		}
	}
	
	public function updateAlat() {
		$submit_update = $this->input->post("submit_update");
		if ($submit_update != null) {
			$device_id = $this->input->post("device_id");
			$device_name = $this->input->post("device_name");
			$device_email = $this->input->post("device_email");
			$device_information = $this->input->post("device_information");
			$device_status = intval($this->input->post("device_status"));
			$user_id = $this->session->userdata("user_id");
			
			$data = array(
				"device_id" => $device_id,
				"device_name" => $device_name,
				"device_email" => $device_email,
				"device_information" => $device_information,
				"device_status" => $device_status,
				"modified_by" => $user_id
			);
			$affected_rows = $this->Alat_model->updateAlat($data);
			if ($affected_rows > 0) {
				echo "success";
			} else {
				echo "no rows affected. WHY??";
			}
		} else {
			
		}
	}
	
	public function toggleAlatAktif() {
		$device_id = $this->input->post("device_id");
		$device_status = intval($this->input->post("device_status"));
		$user_id = $this->session->userdata("user_id");
		$data = array(
			"device_id" => $device_id,
			"device_status" => $device_status,
			"modified_by" => $user_id
		);
		$affected_rows = $this->Alat_model->toggleAlatAktif($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
	
	public function deleteAlat() {
		$device_id = $this->input->post("device_id");
		$user_id = $this->session->userdata("user_id");
		$affected_rows = $this->Alat_model->deleteAlat($device_id, $user_id);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
}