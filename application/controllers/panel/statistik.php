<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik extends MY_Controller
{
	
    public function __construct(){
        parent::__construct();
		$this->load->model("Statistik_model");
    }

    public function index()
    {
        $data = array(
            'title' => 'Statistik',
			"page_title" => "Statistik",
			"user_id" => $this->session->userdata("user_id"),
			"role_id" => $this->session->userdata("role_id")
        );

        parent::template('statistik', $data);
    }
	
	public function getStatistikKiriman() {
		$user_id = $this->session->userdata("user_id");
		$statistik;
		if ($this->session->userdata("role_id") == 1) {
			$statistik = $this->Statistik_model->getStatistikKirimanKonsumen($user_id);
		} else {
			$statistik = $this->Statistik_model->getStatistikKirimanEkspedisi($user_id);
		}
		echo json_encode($statistik);
	}
	
	public function getStatistikBidding() {
		$user_id = $this->session->userdata("user_id");
		$statistik = $this->Statistik_model->getStatistikBidding($user_id);
		echo json_encode($statistik);
	}
}