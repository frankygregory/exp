<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ulasan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->model("Ulasan_model");
    }

    public function index()
    {
		$this->activeMenu["ulasan"] = "active";
        $data = array(
            'title' => 'Ulasan',
			'page_title' => "Ulasan"
        );
        parent::template('ulasan', $data);
    }
	
	public function getMyRating() {
		$user_id = $this->session->userdata("user_id");
		$rating = $this->Ulasan_model->getMyRating($user_id);
		echo json_encode($rating);
	}
	
	public function getMyFeedback() {
		$sort = $this->input->post("sort");
		$user_id = $this->session->userdata("user_id");
		$feedbacks = $this->Ulasan_model->getMyFeedback($sort, $user_id);
		echo json_encode($feedbacks);
	}
}