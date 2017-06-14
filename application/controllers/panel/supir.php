<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supir extends MY_Controller
{

    public function __construct(){
        parent::__construct();
		$this->load->model("Driver_model");
    }

    public function index()
    {
		$this->activeMenu["supir"] = "active";
        $data = array(
            'title' => 'Driver',
			"page_title" => "Driver"
        );

        parent::template('supir', $data);
    }
	
	function getSupir() {
		$role_id = $this->session->userdata("role_id");
		if ($role_id == 2) {
			$user_id = $this->session->userdata("user_id");
			$supir = $this->Driver_model->getDriverByUserId($user_id);
			echo json_encode($supir);
		} else {
			
		}
	}
	
	public function tambahSupir() {
		$submit_tambah = $this->input->post("submit_tambah");
		if ($submit_tambah != null) {
			$driver_name = $this->input->post("driver_name");
			$driver_handphone = $this->input->post("driver_handphone");
			$driver_address = $this->input->post("driver_address");
			$driver_information = $this->input->post("driver_information");
			$driver_status = intval($this->input->post("driver_status"));
			$user_id = $this->session->userdata("user_id");
			$group_id = $this->session->userdata("group_id");
			
			$insertData = array(
				"driver_name" => $driver_name,
				"driver_handphone" => $driver_handphone,
				"driver_address" => $driver_address,
				"driver_information" => $driver_information,
				"driver_status" => $driver_status,
				"user_id" => $user_id,
				"group_id" => $group_id
			);
			$affected_rows = $this->Driver_model->addDriver($insertData);
			if ($affected_rows > 0) {
				echo "success";
			} else {
				echo "no rows affected. WHY??";
			}
		} else {
			
		}
	}
	
	public function updateSupir() {
		$submit_update = $this->input->post("submit_update");
		if ($submit_update != null) {
			$driver_id = $this->input->post("driver_id");
			$driver_name = $this->input->post("driver_name");
			$driver_handphone = $this->input->post("driver_handphone");
			$driver_address = $this->input->post("driver_address");
			$driver_information = $this->input->post("driver_information");
			$driver_status = intval($this->input->post("driver_status"));
			$user_id = $this->session->userdata("user_id");
			
			$data = array(
				"driver_id" => $driver_id,
				"driver_name" => $driver_name,
				"driver_handphone" => $driver_handphone,
				"driver_address" => $driver_address,
				"driver_information" => $driver_information,
				"driver_status" => $driver_status,
				"modified_by" => $user_id
			);
			$affected_rows = $this->Driver_model->updateDriver($data);
			if ($affected_rows > 0) {
				echo "success";
			} else {
				echo "no rows affected. WHY??";
			}
		} else {
			
		}
	}
	
	public function toggleSupirAktif() {
		$driver_id = $this->input->post("driver_id");
		$driver_status = intval($this->input->post("driver_status"));
		$user_id = $this->session->userdata("user_id");
		$data = array(
			"driver_id" => $driver_id,
			"driver_status" => $driver_status,
			"modified_by" => $user_id
		);
		$affected_rows = $this->Driver_model->toggleDriverAktif($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
	
	public function deleteSupir() {
		$driver_id = $this->input->post("driver_id");
		$user_id = $this->session->userdata("user_id");
		$affected_rows = $this->Driver_model->deleteDriver($driver_id, $user_id);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
}