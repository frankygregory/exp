<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kiriman extends MY_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model("Kiriman_model");
		$this->loadModule("tabs");
		$this->loadModule("rating");
    }

    public function index()
    {   
		$this->activeMenu["kiriman_saya"] = "active";
		$data = array(
            'title' => 'Kiriman Saya',
			'page_title' => "Kiriman Saya",
        );
		
        parent::template('kiriman', $data);
	}

	public function getInfoEkspedisi() {
		$shipment_id = $this->input->post("shipment_id");
		$info = $this->Kiriman_model->getInfoEkspedisi($shipment_id);
		echo json_encode($info);
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
	}
	
	public function getKirimanCount() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_model->getKirimanCount($user_id)[0];
		echo json_encode($kiriman);
	}
	
	public function getOpenKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_model->getOpenKiriman($user_id);
		$iLength = sizeof($kiriman);
		for ($i = 0; $i < $iLength; $i++) {
			$berakhir = $kiriman[$i]->berakhir;
			$kiriman[$i]->berakhir = $this->secondsToTime($berakhir);
		}
		echo json_encode($kiriman);
	}

	public function getProgressKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_model->getProgressKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	/*public function getPendingKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_model->getPendingKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getPesananKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_model->getPesananKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getDikirimKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_model->getDikirimKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getDiambilKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_model->getDiambilKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function getDiterimaKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_model->getDiterimaKiriman($user_id);
		echo json_encode($kiriman);
	}*/
	
	public function getSelesaiKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_model->getSelesaiKiriman($user_id);
		$iLength = sizeof($kiriman);
		for ($i = 0; $i < $iLength; $i++) {
			$waktu = intval($kiriman[$i]->waktu_kiriman);
			$kiriman[$i]->waktu_kiriman = $this->secondsToDay($waktu);
			$waktu = intval($kiriman[$i]->total_waktu);
			$kiriman[$i]->total_waktu = $this->secondsToDay($waktu);
		}
		echo json_encode($kiriman);
	}
	
	public function getCancelKiriman() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_model->getCancelKiriman($user_id);
		echo json_encode($kiriman);
	}
	
	public function submitRating() {
		$user_id = $this->session->userdata("user_id");
		$shipment_id = $this->input->post("shipment_id");
		$shipment_rating_number = $this->input->post("shipment_rating_number");
		$shipment_rating_feedback = $this->input->post("shipment_rating_feedback");
		
		$data = array(
			"shipment_id" => $shipment_id,
			"user_id" => $user_id,
			"shipment_rating_number" => $shipment_rating_number,
			"shipment_rating_feedback" => $shipment_rating_feedback
		);
		
		$affected_rows = $this->Kiriman_model->submitRating($data);
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
		$affected_rows = $this->Kiriman_model->cancelShipment($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
}