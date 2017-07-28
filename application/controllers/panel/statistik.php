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
        $this->activeMenu["statistik"] = "active";
        $data = array(
            'title' => 'Statistik',
			"page_title" => "Statistik",
			"user_id" => $this->session->userdata("user_id"),
			"role_id" => $this->session->userdata("role_id")
        );

        parent::template('statistik', $data);
    }
	
	public function getStatistik() {
        
		$user_id = $this->session->userdata("user_id");
		$statistik = $this->Statistik_model->getStatistik($user_id);
		echo json_encode($statistik);
	}
}