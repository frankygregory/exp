<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct(){
        parent::__construct();
		$this->load->model("User_model");
    }

    public function index()
    {
        $data = array(
            'title' => 'User',
			"page_title" => "User"
        );

        parent::template('user', $data);
    }
	
	public function getMyGroups() {
		$user_id = $this->session->userdata("user_id");
		$data = $this->User_model->getMyGroups($user_id);
		echo json_encode($data);
	}
	
	public function insertGroup() {
		$group_name = $this->input->post("group_name");
		$user_id = $this->session->userdata("user_id");
		
		$data = array(
			"group_name" => $group_name,
			"user_id" => $user_id
		);
		$affected_rows = $this->User_model->insertGroup($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
	
	public function updateGroup() {
		$group_id = $this->input->post("group_id");
		$group_name = $this->input->post("group_name");
		$user_id = $this->session->userdata("user_id");
		
		$data = array(
			"group_id" => $group_id,
			"group_name" => $group_name,
			"user_id" => $user_id
		);
		$affected_rows = $this->User_model->updateGroup($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
}