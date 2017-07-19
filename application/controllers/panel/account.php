<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		$field = $this->input->post("field", true);
		$value = $this->input->post("value", true);
		$table = $this->input->post("table", true);
		$user_id = $this->session->userdata("user_id");
		$old = "";
		if ($field == "password") {
			$old = md5($this->input->post("old"));
			$value = md5($value);
		} else if ($field == "user_details_npwp" || $field == "user_details_siup" || $field == "user_details_tdp") {
			$file_name = $_FILES["file"]["name"];
			parent::upload_file_settings('assets/panel/files/', '5000000');
			if (!$this->upload->do_upload('file')) {
				echo json_encode(array("error" => 'Cek type atau ukuran gambar. Type harus JPG/JPEG, PNG. Ukuran Maks.300kB!'));
				$err = 1;
			} else {
				$image = $this->upload->data();
				if ($image['file_name']) {
					$shipment_pictures = $image['file_name'];
				}
			}
		}
		
		$data = array(
			"field" => $field,
			"value" => $value,
			"table" => $table,
			"user_id" => $user_id,
			"old" => $old
		);
		
		$affected_rows = $this->Account_model->updateCertainField($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "null";
		}
	}
}
