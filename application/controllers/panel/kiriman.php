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
		$data = array(
            'title' => 'Kiriman Saya',
			'page_title' => "Kiriman Saya",
        );
		
        parent::template('kiriman', $data);
	}
	
	function secondsToTime($seconds) {
		$dtF = new \DateTime('@0');
		$dtT = new \DateTime("@$seconds");
		return $dtF->diff($dtT)->format('%a hari, %h jam, %i menit');
	}
	
	public function getKirimanSaya() {
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Kiriman_model->getKirimanSaya($user_id);
		$iLength = sizeof($kiriman);
		 for ($i = 0; $i < $iLength; $i++) {
			 $berakhir = $kiriman[$i]->berakhir;
			 $kiriman[$i]->berakhir = $this->secondsToTime($berakhir);
		 }
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