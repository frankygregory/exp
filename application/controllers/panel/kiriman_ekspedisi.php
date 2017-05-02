<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiriman_ekspedisi extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Kiriman_ekspedisi_model");
		$this->load->model("Driver_model");
		$this->load->model("Kendaraan_model");
		$this->load->model("Alat_model");
		$this->loadModule("tabs");
    }

    public function index()
    {   
		$data = array(
            'title' => 'Kiriman Saya',
			'page_title' => "Kiriman Saya",
        );
		
        parent::template('kiriman_ekspedisi', $data);
	}
	
	function secondsToTime($seconds) {
		$dtF = new \DateTime('@0');
		$dtT = new \DateTime("@$seconds");
		return $dtF->diff($dtT)->format('%a hari, %h jam, %i menit');
	}
	
	public function getKirimanSaya() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_model->getKiriman($user_id);
		$iLength = sizeof($kiriman);
		for ($i = 0; $i < $iLength; $i++) {
			$berakhir = $kiriman[$i]->berakhir;
			$kiriman[$i]->berakhir = $this->secondsToTime($berakhir);
		}
		echo json_encode($kiriman);
	}
	
	public function submitDeal() {
		$shipment_id = $this->input->post("shipment_id");
		$user_id = $this->session->userdata("user_id");
		$data = array(
			"shipment_id" => $shipment_id,
			"user_id" => $user_id
		);
		$affected_rows = $this->Kiriman_ekspedisi_model->submitDeal($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
	
	public function submitPesan() {
		$shipment_id = $this->input->post("shipment_id");
		$user_id = $this->session->userdata("user_id");
		$driver_id = $this->input->post("driver_id");
		$vehicle_id = $this->input->post("vehicle_id");
		$device_id = $this->input->post("device_id");
		
		$data = array(
			"shipment_id" => $shipment_id,
			"user_id" => $user_id,
			"driver_id" => $driver_id,
			"vehicle_id" => $vehicle_id,
			"device_id" => $device_id
		);
		$affected_rows = $this->Kiriman_ekspedisi_model->submitPesan($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
	
	public function getSupir() {
		$user_id = $this->session->userdata("user_id");
		$driver = $this->Driver_model->getDriverByUserId($user_id);
		echo json_encode($driver);
	}
	
	public function getKendaraan() {
		$user_id = $this->session->userdata("user_id");
		$vehicle = $this->Kendaraan_model->getKendaraanByUserId($user_id);
		echo json_encode($vehicle);
	}
	
	public function getAlat() {
		$user_id = $this->session->userdata("user_id");
		$device = $this->Alat_model->getAlatByUserId($user_id);
		echo json_encode($device);
	}
}