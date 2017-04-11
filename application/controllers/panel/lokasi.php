<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends MY_Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'title' => 'Lokasi'
        );

        parent::template('lokasi', $data);
    }
	
	public function ajaxList(){
		$table = 'm_location';
        $column_order = array('location_name', 'location_address', null);
        $column_search = array('location_name', 'location_address');
        $order = array('location_id' => 'desc'); // default order 
        $list = $this->getDataTables($table, $column_order, $column_search, $order);
        $datalist = array();
        $no = 0;
        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = $data->location_id;
            $row[] = $data->location_name;
            $row[] = $data->location_address;
            $row[] = $data->location_detail;
            $row[] = $data->location_contact;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Ubah" onclick="editData(' . "'" . $data->location_id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="deleteData(' . "'" . $data->location_id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';
            $datalist[] = $row;
        }

        $draw = null;
        if (isset($_POST['draw'])) {
            $draw = $_POST['draw'];
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->countAll($table, $column_order, $column_search, $order),
            "recordsFiltered" => $this->countFiltered($table, $column_order, $column_search, $order),
            "data" => $datalist,
        );
        //output to json format
        echo json_encode($output);	
	}
	
	public function ajaxLoad($id)
    {
        $data = $this->queryData('select * from m_location where location_id = ' . $id)->row();
        echo json_encode($data);
    }
	
	public function ajaxAdd(){
	  $this->validation();
	  $data = array(
            'location_name' => $this->input->post('location_name'),
            'location_address' => $this->input->post('location_address'),
            'location_lat' => $this->input->post('location_x'),
            'location_lng' => $this->input->post('location_y'),
            'location_detail' => $this->input->post('location_detail'),
            'location_contact' => $this->input->post('location_contact'),
            'location_from' => $this->input->post('location_from'),
            'location_to' => $this->input->post('location_to'),
            'user_id' => (int)$this->session->userdata('user_id'),
            'created_date' => date('Y-m-d G:i:s'),
            'created_by' => (int)$this->session->userdata('user_id'),
        );
        $this->insertData('m_location', $data);
        echo json_encode(array("status" => TRUE));
	}
	
	public function ajaxUpdate(){
		$this->validation();
		  $data = array(
	            'location_name' => $this->input->post('location_name'),
	            'location_address' => $this->input->post('location_address'),
	            'location_lat' => $this->input->post('location_x'),
	            'location_lng' => $this->input->post('location_y'),
	            'location_detail' => $this->input->post('location_detail'),
	            'location_contact' => $this->input->post('location_contact'),
	            'location_from' => $this->input->post('location_from'),
	            'location_to' => $this->input->post('location_to'),
	            'user_id' => (int)$this->session->userdata('user_id'),
	            'modified_date' => date('Y-m-d G:i:s'),
	            'modified_by' => (int)$this->session->userdata('user_id'),
	        );
	        $this->updateData('m_location', $data, array("location_id" => $this->input->post("location_id")));
	        echo json_encode(array("status" => TRUE));
	}
	
	public function ajaxDelete($id)
    {
        $this->deleteData("m_location", array('location_id' => $id));
        echo json_encode(array("status" => TRUE));
    }
	
	private function validation(){
		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;


        if ($this->input->post('location_name') == '') {
            $data['inputerror'][] = 'location_name';
            $data['error_string'][] = 'Nama is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('location_address') == '') {
            $data['inputerror'][] = 'location_address';
            $data['error_string'][] = 'Alamat is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('location_x') == '') {
            $data['inputerror'][] = 'location_x';
            $data['error_string'][] = 'Latitude is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('location_y') == '') {
            $data['inputerror'][] = 'location_y';
            $data['error_string'][] = 'Longitude is required';
            $data['status'] = FALSE;
        }
		
		if ($this->input->post('location_detail') == '') {
            $data['inputerror'][] = 'location_detail';
            $data['error_string'][] = 'Location Detail is required';
            $data['status'] = FALSE;
        }
		
		if ($this->input->post('location_contact') == '') {
            $data['inputerror'][] = 'location_contact';
            $data['error_string'][] = 'LocationContact is required';
            $data['status'] = FALSE;
        }
		
		if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
	}
}