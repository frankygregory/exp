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
		$vehicle_nomor = $this->input->post("vehicle_nomor");
		$vehicle_name = $this->input->post("vehicle_name");
		$vehicle_information = $this->input->post("vehicle_information");
		$vehicle_status = intval($this->input->post("vehicle_status"));
		$user_id = $this->session->userdata("user_id");
		$group_id = $this->session->userdata("group_id");

		if ($submit_tambah && $vehicle_nomor && $vehicle_name && $vehicle_information) {
			$insertData = array(
				"vehicle_nomor" => $vehicle_nomor,
				"vehicle_name" => $vehicle_name,
				"vehicle_information" => $vehicle_information,
				"vehicle_status" => $vehicle_status,
				"user_id" => $user_id,
				"group_id" => $group_id
			);
			$db = $this->Kendaraan_model->addKendaraan($insertData);
			parent::generate_common_results($db, "ci");
		} else {
			header("Location: " . base_url());
		}
	}
	
	public function updateKendaraan() {
		$submit_update = $this->input->post("submit_update");
		$vehicle_id = $this->input->post("vehicle_id");
		$vehicle_nomor = $this->input->post("vehicle_nomor");
		$vehicle_name = $this->input->post("vehicle_name");
		$vehicle_information = $this->input->post("vehicle_information");
		$vehicle_status = intval($this->input->post("vehicle_status"));
		$user_id = $this->session->userdata("user_id");

		if ($submit_update && $vehicle_id && $vehicle_nomor && $vehicle_name && $vehicle_information) {
			$updateData = array(
				"vehicle_id" => $vehicle_id,
				"vehicle_nomor" => $vehicle_nomor,
				"vehicle_name" => $vehicle_name,
				"vehicle_information" => $vehicle_information,
				"vehicle_status" => $vehicle_status,
				"user_id" => $user_id
			);
			$db = $this->Kendaraan_model->updateKendaraan($updateData);
			parent::generate_common_results($db, "ci");
		} else {
			header("Location: " . base_url());
		}
	}
	
	public function toggleKendaraanAktif() {
		$vehicle_status = intval($this->input->post("vehicle_status"));
		$vehicle_id = $this->input->post("vehicle_id");
		$user_id = $this->session->userdata("user_id");
		if ($vehicle_id) {
			$data = array(
				"vehicle_id" => $vehicle_id,
				"vehicle_status" => $vehicle_status,
				"modified_by" => $user_id
			);
			$db = $this->Kendaraan_model->toggleKendaraanAktif($data);
			parent::generate_common_results($db, "ci");
		}
	}
	
	public function deleteKendaraan() {
		$submit_delete = $this->input->post("submit_delete");
		$vehicle_id = $this->input->post("vehicle_id");
		$user_id = $this->session->userdata("user_id");

		if ($submit_delete && $vehicle_id) {
			$db = $this->Kendaraan_model->deleteKendaraan($vehicle_id, $user_id);
			parent::generate_common_results($db, "ci");
		} else {
			header("Location: " . base_url());
		}
	}

    private function  preg_match($string = '')
    {
        return !preg_match('/^[a-zA-Z0-9_\.]+$/', $string);
    }
}