<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
NOTE
Just put general function which frequently used in this class
**/

class MY_Controller extends CI_Controller
{
	protected $modules = "";
    public function __construct()
    {
        parent::__construct();
        $this->cekLogin();
        $this->load->model('M_GenFunc','',TRUE);
    }

    public function cekLogin()
    {
        if ($this->session->userdata('isLoggedIn') != 1) {
            redirect('login');
        }
    }
	
	public function loadModule($moduleName) {
		$this->modules .= "<link href='" . base_url("assets/template/css/" . $moduleName . ".css") . "' rel='stylesheet'>" . "<script src='" . base_url("assets/template/js/" . $moduleName . ".js") . "'></script>";
	}

    public function upload_file_settings($path = '', $max_size = '')
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = $max_size;
        $config['remove_spaces'] = true;
        $config['overwrite'] = false;
        $config['encrypt_name'] = false;
        $config['max_width'] = '';
        $config['max_height'] = '';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
    }

    public function template($file, $data){
		$data["pageName"] = $file;
		$data["modules"] = $this->modules;
        $this->load->view('template/top', $data);
        $this->load->view($file, $data);
        $this->load->view('template/bottom');
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