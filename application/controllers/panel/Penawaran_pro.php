<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penawaran_pro extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Penawaran_pro_model");
		$this->loadModule("tabs");
    }

    public function index()
    {   
		$this->activeMenu["penawaran_bisnis"] = "active";
		$data = array(
            'title' => 'Penawaran',
			'page_title' => "Penawaran",
        );
		
        parent::template('penawaran_pro', $data);
	}

	public function getOpenKiriman() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Penawaran_pro_model->getOpenKiriman($user_id);
		$iLength = sizeof($kiriman);
		for ($i = 0; $i < $iLength; $i++) {
			$berakhir = $kiriman[$i]->berakhir;
			$kiriman[$i]->berakhir = $this->secondsToTime($berakhir);
		}
		echo json_encode($kiriman);
	}

	public function getClosedKiriman() {
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Penawaran_pro_model->getClosedKiriman($user_id);
		echo json_encode($kiriman);
	}

	public function getKirimanCount() {
		parent::checkAjaxRequest();
		
		$user_id = $this->session->userdata("user_id");
		$kiriman = $this->Penawaran_pro_model->getKirimanCount($user_id);
		echo json_encode($kiriman);
	}

	function secondsToTime($seconds) {
		$dtF = new \DateTime('@0');
		$dtT = new \DateTime("@$seconds");
		return $dtF->diff($dtT)->format('%a hari, %h jam, %i menit');
	}
}