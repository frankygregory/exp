<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alat extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'title' => 'Alat'
        );
        parent::template('alat', $data);
    }
	
	public function ajaxList()
    {
        $table = 'm_device_customer';
        $column_order = array('device_name', 'device_email', null);
        $column_search = array('device_name', 'device_email');
        $order = array('device_id' => 'desc'); // default order 
        $list = $this->getDataTables($table, $column_order, $column_search, $order);
        $datalist = array();
        $no = 0;
        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = $data->device_id;
            $row[] = $data->device_name;
            $row[] = $data->device_information;
            $row[] = $data->device_email;
			
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Ubah" onclick="editData(' . "'" . $data->device_id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="deleteData(' . "'" . $data->device_id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';
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
	
	public function ajaxAdd()
    {
        $this->validasi();
        $data = array(
            'device_name' => $this->input->post('device_name'),
            'device_information' => $this->input->post('device_information'),
            'device_email' => $this->input->post('device_email'),
            'created_date' => date('Y-m-d G:i:s'),
            'created_by' => (int)$this->session->userdata('user_id'),
        );
        $this->insertData('m_device_customer', $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajaxUpdate()
    {
        $this->validasi();        
        $data = array(
            'device_name' => $this->input->post('device_name'),
            'device_information' => $this->input->post('device_information'),
            'device_email' => $this->input->post('device_email'),
            'modified_date' => date('Y-m-d G:i:s'),
            'modified_by' => (int)$this->session->userdata('user_id')
        );
				
        $this->updateData('m_device_customer', $data, array('device_id' => $this->input->post('device_id')));
        echo json_encode(array("status" => TRUE));
    }
	
	public function ajaxDelete($id)
    {
        $this->deleteData("m_device_customer", array('device_id' => $id));
        echo json_encode(array("status" => TRUE));
    }
	
	public function ajaxLoad($id)
    {
        $data = $this->queryData('select * from m_device_customer where device_id=' . $id)->row();
        echo json_encode($data);
    }
	
	private function validasi()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;


        if ($this->input->post('device_name') == '') {
            $data['inputerror'][] = 'device_name';
            $data['error_string'][] = 'Nama Alat wajib diisi!';
            $data['status'] = FALSE;
        }

        if ($this->input->post('device_information') == '') {
            $data['inputerror'][] = 'device_information';
            $data['error_string'][] = 'Keterangan wajib diisi!';
            $data['status'] = FALSE;
        }

        if ($this->input->post('device_email') == '') {
            $data['inputerror'][] = 'device_email';
            $data['error_string'][] = 'Email wajib diisi!';
            $data['status'] = FALSE;
        }
		
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}