<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan extends MY_Controller
{
    public $query;

    public function __construct()
    {
        parent::__construct();
		$this->load->model("Kendaraan_model");
        $this->query = 'select a.*,if((isVehichleInUsed(a.vehicle_id)<>0),"Tidak","Ya") available_status,' .
            'if((getVehicleInUsedTrx(a.vehicle_id)<0),"-",getVehicleInUsedTrx(a.vehicle_id)) ref_transaksi ' .
            'from m_vehicle a';
    }

    public function index()
    {
		$this->activeMenu["kendaraan"] = "active";
        $data = array(
            'title' => 'Kendaraan',
			'page_title' => "Kendaraan"
        );

        parent::template('kendaraan', $data);
    }
	
	public function getKendaraan() {
		$role_id = $this->session->userdata("role_id");
		if ($role_id == 2) {
			$user_id = $this->session->userdata("user_id");
			$kendaraan = $this->Kendaraan_model->getKendaraanByUserId($user_id);
			echo json_encode($kendaraan);
		} else {
			
		}
	}
	
	public function tambahKendaraan() {
		$submit_tambah = $this->input->post("submit_tambah");
		if ($submit_tambah != null) {
			$vehicle_nomor = $this->input->post("vehicle_nomor");
			$vehicle_name = $this->input->post("vehicle_name");
			$vehicle_information = $this->input->post("vehicle_information");
			$vehicle_status = intval($this->input->post("vehicle_status"));
			$user_id = $this->session->userdata("user_id");
			$group_id = $this->session->userdata("group_id");
			
			$insertData = array(
				"vehicle_nomor" => $vehicle_nomor,
				"vehicle_name" => $vehicle_name,
				"vehicle_information" => $vehicle_information,
				"vehicle_status" => $vehicle_status,
				"user_id" => $user_id,
				"group_id" => $group_id
			);
			$db = $this->Kendaraan_model->addKendaraan($insertData);
			if ($db->affected_rows() > 0) {
				echo json_encode(array("status" => "success"));
			} else {
				echo json_encode(array(
					"status" => "error",
					"error_code" => $db->error()["code"],
					"error_message" => $db->error()["message"]
				));
			}
		} else {
			header("Location: " . base_url("dashboard"));
		}
	}
	
	public function updateKendaraan() {
		$submit_update = $this->input->post("submit_update");
		if ($submit_update != null) {
			$vehicle_id = $this->input->post("vehicle_id");
			$vehicle_nomor = $this->input->post("vehicle_nomor");
			$vehicle_name = $this->input->post("vehicle_name");
			$vehicle_information = $this->input->post("vehicle_information");
			$vehicle_status = intval($this->input->post("vehicle_status"));
			$user_id = $this->session->userdata("user_id");
			
			$updateData = array(
				"vehicle_id" => $vehicle_id,
				"vehicle_nomor" => $vehicle_nomor,
				"vehicle_name" => $vehicle_name,
				"vehicle_information" => $vehicle_information,
				"vehicle_status" => $vehicle_status,
				"user_id" => $user_id
			);
			$affected_rows = $this->Kendaraan_model->updateKendaraan($updateData);
			if ($affected_rows > 0) {
				echo "success";
			} else {
				echo "no rows affected. WHY??";
			}
		} else {
			header("Location: " . base_url("dashboard"));
		}
	}
	
	public function toggleKendaraanAktif() {
		$vehicle_status = intval($this->input->post("vehicle_status"));
		$vehicle_id = $this->input->post("vehicle_id");
		$user_id = $this->session->userdata("user_id");
		$data = array(
			"vehicle_id" => $vehicle_id,
			"vehicle_status" => $vehicle_status,
			"modified_by" => $user_id
		);
		$affected_rows = $this->Kendaraan_model->toggleKendaraanAktif($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
	
	public function deleteKendaraan() {
		$submit_delete = $this->input->post("submit_delete");
		if ($submit_delete != null) {
			$vehicle_id = $this->input->post("vehicle_id");
			$user_id = $this->session->userdata("user_id");
			$affected_rows = $this->Kendaraan_model->deleteKendaraan($vehicle_id, $user_id);
			if ($affected_rows > 0) {
				echo "success";
			} else {
				echo "no rows affected. WHY??";
			}
		} else {
			
		}
	}

    private function  preg_match($string = '')
    {
        return !preg_match('/^[a-zA-Z0-9_\.]+$/', $string);
    }
}