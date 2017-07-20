<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiriman_ekspedisi extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Kiriman_ekspedisi_model");
		$this->loadModule("tabs");
    }

    public function index()
    {   
		$this->activeMenu["kiriman_darat"] = "active";
		$data = array(
            'title' => 'Kiriman Darat',
			'page_title' => "Kiriman Darat",
        );
		
        parent::template('kiriman_ekspedisi', $data);
	}

	public function getDetailPengirim() {
		$shipment_id = $this->input->post("shipment_id");
		$detail = $this->Kiriman_ekspedisi_model->getDetailPengirim($shipment_id);
		echo json_encode($detail);
	}
	
	public function getDealKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_model->getDealKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getPendingKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_model->getPendingKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getPesananKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_model->getPesananKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getDikirimKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_model->getDikirimKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getDiambilKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_model->getDiambilKiriman($user_id);
		echo json_encode($kiriman);
	}
	public function getDiterimaKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_model->getDiterimaKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getSelesaiKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_model->getSelesaiKiriman($user_id);
		$iLength = sizeof($kiriman);
		for ($i = 0; $i < $iLength; $i++) {
			$waktu = intval($kiriman[$i]->waktu_kiriman);
			$kiriman[$i]->waktu_kiriman = $this->secondsToDay($waktu);
			$waktu = $kiriman[$i]->total_waktu;
			$kiriman[$i]->total_waktu = $this->secondsToDay($waktu);
		}
		echo json_encode($kiriman);
	}
	public function getCancelKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_model->getCancelKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	function secondsToTime($seconds) {
		$dtF = new \DateTime('@0');
		$dtT = new \DateTime("@$seconds");
		return $dtF->diff($dtT)->format('%a hari, %h jam, %i menit');
	}
	
	function secondsToDay($seconds) {
		$dtF = new \DateTime('@0');
		$dtT = new \DateTime("@$seconds");
		return $dtF->diff($dtT)->format('%a');
		return $seconds;
	}
		
	public function getKirimanSaya() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_ekspedisi_model->getKirimanCount($user_id);
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
		$shipment_jenis_muatan = $this->input->post("jenis_muatan");
		$driver_id = $this->input->post("driver_id");
		$vehicle_id = $this->input->post("vehicle_id");
		$device_id = $this->input->post("device_id");
		
		$data = array(
			"shipment_id" => $shipment_id,
			"user_id" => $user_id,
			"shipment_jenis_muatan" => $shipment_jenis_muatan,
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
	
	public function submitKirim() {
		$shipment_id = $this->input->post("shipment_id");
		$user_id = $this->session->userdata("user_id");
		$data = array(
			"shipment_id" => $shipment_id,
			"user_id" => $user_id
		);
		$affected_rows = $this->Kiriman_ekspedisi_model->submitKirim($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
	
	public function submitAmbil() {
		$shipment_id = $this->input->post("shipment_id");
		$user_id = $this->session->userdata("user_id");
		$data = array(
			"shipment_id" => $shipment_id,
			"user_id" => $user_id
		);
		$affected_rows = $this->Kiriman_ekspedisi_model->submitAmbil($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
	
	public function submitTerima() {
		$shipment_id = $this->input->post("shipment_id");
		$user_id = $this->session->userdata("user_id");
		$data = array(
			"shipment_id" => $shipment_id,
			"user_id" => $user_id
		);
		$affected_rows = $this->Kiriman_ekspedisi_model->submitTerima($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
	
	public function cancelShipment() {
		$shipment_id = $this->input->post("shipment_id");
		$user_id = $this->session->userdata("user_id");
		$data = array(
			"shipment_id" => $shipment_id,
			"user_id" => $user_id
		);
		$affected_rows = $this->Kiriman_ekspedisi_model->cancelShipment($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
	
	public function getSupir() {
		$user_id = $this->session->userdata("user_id");
		$driver = $this->Kiriman_ekspedisi_model->getDriverAktif($user_id);
		echo json_encode($driver);
	}
	
	public function getKendaraan() {
		$user_id = $this->session->userdata("user_id");
		$vehicle = $this->Kiriman_ekspedisi_model->getKendaraanAktif($user_id);
		echo json_encode($vehicle);
	}
	
	public function getAlat() {
		$user_id = $this->session->userdata("user_id");
		$device = $this->Kiriman_ekspedisi_model->getAlatAktif($user_id);
		echo json_encode($device);
	}
}