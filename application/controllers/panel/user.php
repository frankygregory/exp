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
		$this->activeMenu["user"] = "active";
        $data = array(
            'title' => 'User',
			"page_title" => "User"
        );

        parent::template('user', $data);
    }
	
	public function getUser() {
		$user_level = $this->session->userdata("user_level");
		$group_ids = $this->session->userdata("group_ids");
		$user_id = $this->session->userdata("user_id");
		$data = array(
			"user_level" => $user_level,
			"group_ids" => $group_ids,
			"user_id" => $user_id
		);
		$users = $this->User_model->getOtherUser($data);
		echo json_encode($users);
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
		$result = $this->User_model->insertGroup($data)[0];
		if ($result->status == "success") {
			$this->session->set_userdata("group_ids", $result->group_ids);
		}
		echo json_encode($result);
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
		$db = $this->User_model->updateGroup($data);
		parent::generate_common_results($db, "ci");
	}
	
	public function deleteGroup() {
		$group_id = $this->input->post("group_id");
		$user_id = $this->session->userdata("user_id");
		
		$data = array(
			"group_id" => $group_id,
			"user_id" => $user_id
		);
		$affected_rows = $this->User_model->deleteGroup($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}

	public function checkUserKembar() {
		parent::checkUserKembar();
	}

	public function checkEmailKembar() {
		parent::checkEmailKembar();
	}
	
	public function addOtherUser() {
		$config = parent::get_default_email_config();
		$this->load->library("email", $config);

		$username = $this->input->post("username");
		$user_email = $this->input->post("user_email");
		$user_fullname = $this->input->post("user_fullname");
		$group_ids = $this->input->post("group_ids");
		$user_level = $this->input->post("user_level");
		if ($user_level == "super") {
			$user_level = 2;
		} else {
			$user_level = 3;
		}
		$password = $this->input->post("password");
		$role_id = $this->session->userdata("role_id");
		$type_id = $this->session->userdata("type_id");
		$user_id_ref = $this->session->userdata("user_id");
		
		$data = array(
			"username" => $username,
			"user_email" => $user_email,
			"group_ids" => $group_ids,
			"user_level" => $user_level,
			"role_id" => $role_id,
			"type_id" => $type_id,
			"user_id_ref" => $user_id_ref,
			"password" => $password,
			"user_fullname" => $user_fullname
		);
		
		$result = $this->User_model->add_other_user($data)[0];
		if ($result->status == "success") {
			$this->email->set_newline("\r\n");
			$this->email->from("admin@wahanafurniture.com", "Yukirim");
			$this->email->to($user_email);
			$this->email->subject("Verifikasi Yukirim");
			$this->email->message("Dear " . $user_fullname . ",\n\nTerima kasih telah mendaftar.\nUntuk mengaktifkan account anda, silakan mengklik link di bawah ini:\n" . base_url("verify-email/" . $result->generated_token) . "\n\nBest regards,\n\nYukirim");
			$this->email->send();

			$this->session->set_flashdata('flash_message', 'Kode verifikasi untuk mengaktifkan account anda telah dikirim ke ' . $user_email);
			echo json_encode(array(
				"status" => "success",
				"message" => "Kode verifikasi untuk mengaktifkan account anda telah dikirim ke " . $user_email
			));
		} else {
			echo json_encode(array(
				"status" => $result->status
			));
		}
	}
	
	public function updateOtherUser() {
		$other_user_id = $this->input->post("user_id");
		$other_user_fullname = $this->input->post("user_fullname");
		$group_ids = $this->input->post("group_ids");
		$other_user_level = $this->input->post("user_level");
		if ($other_user_level == "super") {
			$other_user_level = 2;
		} else {
			$other_user_level = 3;
		}
		$other_user_status = $this->input->post("user_status");
		$user_id = $this->session->userdata("user_id");
		
		$data = array(
			"other_user_id" => $other_user_id,
			"other_user_fullname" => $other_user_fullname,
			"group_ids" => $group_ids,
			"other_user_level" => $other_user_level,
			"other_user_status" => $other_user_status,
			"user_id" => $user_id
		);
		$result = $this->User_model->updateUser($data)[0];
		echo json_encode($result);
	}

	public function updateOtherUserPassword() {
		$other_user_id = $this->input->post("user_id", true);
		$other_user_password = $this->input->post("password", true);
		if ($other_user_id && $other_user_password) {
			$user_id = $this->session->userdata("user_id");
			$data = array(
				"other_user_id" => $other_user_id,
				"other_user_password" => $other_user_password,
				"user_id" => $user_id
			);
			$result = $this->User_model->updateUserPassword($data);
			if ($result->error()["code"] == 0) {
				echo json_encode(array(
					"status" => "success"
				));
			} else {
				echo json_encode(array(
					"status" => "error",
					"error_message" => $result->error()["message"]
				));
			}
		}
	}
	
	public function deleteOtherUser() {
		$other_user_id = $this->input->post("user_id");
		$user_id = $this->session->userdata("user_id");
		$data = array(
			"other_user_id" => $other_user_id,
			"user_id" => $user_id
		);
		$affected_rows = $this->User_model->deleteUser($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
}