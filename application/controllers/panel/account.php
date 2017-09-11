<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
	Controller Account mengcover halaman Account Settings.
*/

class Account extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model("Account_model");
    }

    public function index()
    {
		$user_id = $this->session->userdata("user_id");
		$info = $this->Account_model->getMyInfo($user_id)[0];
		
		$data = array(
            'title' => 'Account Settings',
			'page_title' => "Account Settings",
			"data" => $info
        );
		
        parent::template('account', $data);
    }
	
	public function updateCertainField() {
		parent::checkAjaxRequest();
		
		$field = $this->input->post("field", true);
		$value = $this->input->post("value", true);
		$table = $this->input->post("table", true);
		$user_id = $this->session->userdata("user_id");
		$old = "";
		if ($user_id) {
			$error_upload = false;

			if ($field == "password") {
				$old = md5($this->input->post("old", true));
				$value = md5($value);
			} else if ($field == "user_details_npwp" || $field == "user_details_siup" || $field == "user_details_tdp") {
				$kolom = ($field == "user_details_npwp") ? "npwp" : (($field == "user_details_siup") ? "siup" : "tdp");
				$file_name = $kolom . "_" . $user_id;
				$uploaded_file_name = "";
				parent::upload_file_settings('assets/panel/files/', '5000000', $file_name);
				if (!$this->upload->do_upload('value')) {
					$error_upload = true;
				} else {
					$uploaded_file_name = $this->upload->data("file_name");
				}

				$value = $uploaded_file_name;
			}
			
			if (!$error_upload) {
				$data = array(
					"field" => $field,
					"value" => $value,
					"table" => $table,
					"user_id" => $user_id,
					"old" => $old
				);
				
				$db = $this->Account_model->updateCertainField($data);
				if ($db->error()["code"] == "0") {
					echo json_encode(array(
						"status" => "success",
						"affected_rows" => $db->affected_rows()
					));
				} else {
					echo json_encode(array(
						"status" => "error",
						"error_message" => $db->error()["message"]
					));
				}
			} else {
				echo json_encode(array(
					"status" => "error",
					"error_message" => $this->upload->display_errors()
				));
			}
		}
	}
}
