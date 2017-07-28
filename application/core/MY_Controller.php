<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
NOTE
Just put general function which frequently used in this class
**/

class MY_Controller extends CI_Controller
{
	protected $modules = "";
    protected $activeMenu = array(
        "dashboard" => "",
        "kirim_barang" => "",
        "kiriman_saya" => "",
        "kiriman_saya_bisnis" => "",
        "lokasi" => "",
        "cari_kiriman" => "",
        "cari_kiriman_bisnis" => "",
        "penawaran" => "",
        "penawaran_bisnis" => "",
        "kiriman_darat" => "",
        "kiriman_laut" => "",
        "kendaraan" => "",
        "supir" => "",
        "alat" => "",
        "user" => "",
        "ulasan" => "",
        "statistik" => ""
    );
    public function __construct()
    {
        parent::__construct();
        $this->cekLogin();
        $this->load->model('M_GenFunc','',TRUE);
    }

    public function __partial_construct()
    {
        parent::__construct();
    }

    public function __second_construct()
    {
        $this->cekLogin();
        $this->load->model('M_GenFunc','',TRUE);
    }

    public function cekLogin()
    {
        if ($this->session->userdata('isLoggedIn') != 1) {
            redirect(base_url("#login"));
        }
    }
	
	public function loadModule($moduleName) {
		$this->modules .= "<link href='" . base_url("assets/template/css/" . $moduleName . ".css?v=5") . "' rel='stylesheet'>" . "<script src='" . base_url("assets/template/js/" . $moduleName . ".js?v=5") . "'></script>";
	}

    public function upload_file_settings($path = '', $max_size = '', $file_name = "")
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['max_size'] = $max_size;
        $config['remove_spaces'] = true;
        $config['overwrite'] = true;
        $config['encrypt_name'] = false;
        $config['max_width'] = '';
        $config['max_height'] = '';
        if ($file_name != "") {
            $config["file_name"] = $file_name;
        }
        $this->load->library('upload', $config);
    }

    public function template($file, $data){
		$data["pageName"] = $file;
		$data["modules"] = $this->modules;
        $data["activeMenu"] = $this->activeMenu;
        $this->load->view('template/top', $data);
        $this->load->view($file, $data);
        $this->load->view('template/bottom');
    }

    public function generate_common_results($db, $source = "ci") {
        if ($source == "ci") {
            if ($db->error()["code"] == "0") {
                echo json_encode(array(
                    "status" => "success"
                ));
            } else {
                echo json_encode(array(
                    "status" => "error",
                    "error_code" => $db->error()["code"],
                    "error_message" => $db->error()["message"]
                ));
            }
        }
    }

    public function get_default_email_config() {
        $config["protocol"] = "smtp";
		$config["smtp_host"] = "mail.wahanafurniture.com";
		$config["smtp_user"] = "admin@wahanafurniture.com";
		$config["smtp_pass"] = "admin123123";
		$config["smtp_port"] = 587;
        $config["smtp_crypto"] = "tls";
        return $config;
    }

    public function checkUserKembar() {
        $this->load->model("Common_model");
		$username = $this->input->post("username", true);
		if ($username) {
			$user = $this->Common_model->getUsername($username);
			if (sizeof($user) > 0) {
				echo json_encode(array(
					"status" => "success",
					"result" => "kembar"
				));
			} else {
				echo json_encode(array(
					"status" => "success",
					"result" => "tidak_kembar"
				));
			}
		}
	}

	public function checkEmailKembar() {
        $this->load->model("Common_model");
		$email = $this->input->post("user_email", true);
		if ($email) {
			$email = $this->Common_model->getEmail($email);
			if (sizeof($email) > 0) {
				echo json_encode(array(
					"status" => "success",
					"result" => "kembar"
				));
			} else {
				echo json_encode(array(
					"status" => "success",
					"result" => "tidak_kembar"
				));
			}
		}
	}

    function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyz') {
		$str = '';
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$str .= $keyspace[mt_rand(0, $max)];
		}
		return $str;
	}

    function checkAjaxRequest() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {
            return true;
        } else {
            header("Location: " . base_url());
        }
    }

    public function queryData($select) {
        return $this->M_GenFunc->querydata($select);
    }

    public function queryArray($select) {
        return $this->M_GenFunc->querydata($select)->result_array();
    }

    public function selectData($where) {
        return $this->M_GenFunc->selectdata($where);
    }

    public function selectArray($where) {
        return $this->M_GenFunc->selectdata($where)->result_array();
    }

    public function insertData($tabel, $data){
        return $this->M_GenFunc->insertdata($tabel,$data);
    }

    public function deleteData($tabel, $where){
        return $this->M_GenFunc->deletedata($tabel,$where);
    }

    public function updateData($tabel, $data, $where){
        return $this->M_GenFunc->updatedata($tabel,$data,$where);
    }

    public function getDataTables($table,$column_order,$column_search,$order){
        return $this->M_GenFunc->get_datatables($table,$column_order,$column_search,$order);
    }

    public function countFiltered($table,$column_order,$column_search,$order){
        return $this->M_GenFunc->count_filtered($table,$column_order,$column_search,$order);
    }

    public function countAll($table,$column_order,$column_search,$order){
        return $this->M_GenFunc->count_all($table,$column_order,$column_search,$order);
    }
}