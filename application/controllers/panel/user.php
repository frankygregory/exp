<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct(){
        parent::__construct();
		$this->load->model("User_model");
    }
	
	function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
		$str = '';
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$str .= $keyspace[random_int(0, $max)];
		}
		return $str;
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
	
	public function addOtherUser() {
		$username = $this->input->post("username");
		$user_email = $this->input->post("user_email");
		$group_ids = $this->input->post("group_ids");
		$user_level = $this->input->post("user_level");
		$role_id = $this->session->userdata("role_id");
		$type_id = $this->session->userdata("type_id");
		$user_id_ref = $this->session->userdata("user_id");
		$password = $this->random_str(6);
		
		$data = array(
			"username" => $username,
			"user_email" => $user_email,
			"group_ids" => $group_ids,
			"user_level" => $user_level,
			"role_id" => $role_id,
			"type_id" => $type_id,
			"user_id_ref" => $user_id_ref,
			"password" => $password
		);
		
		$affected_rows = $this->User_model->add_other_user($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
}