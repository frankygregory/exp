<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ulasan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->model("Ulasan_model");
		$this->loadModule("rating");
    }

    public function index()
    {
        $data = array(
            'title' => 'Ulasan',
			'page_title' => "Ulasan"
        );
        parent::template('ulasan', $data);
    }
	
	public function getMyFeedback() {
		$user_id = $this->session->userdata("user_id");
		$feedbacks = $this->Ulasan_model->getMyFeedback($user_id);
		echo json_encode($feedbacks);
	}
}