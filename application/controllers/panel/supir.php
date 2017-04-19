<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supir extends MY_Controller
{

    public function __construct(){
        parent::__construct();
		$this->load->model("Driver_model");
    }

    public function index()
    {
        $data = array(
            'title' => 'Driver',
			"page_title" => "Driver"
        );

        parent::template('supir', $data);
    }
	
	public function tambahSupir() {
		$submit_tambah = $this->input->post("submit_tambah");
		if ($submit_tambah != null) {
			$driver_name = $this->input->post("driver_name");
			$driver_handphone = $this->input->post("driver_handphone");
			$driver_address = $this->input->post("driver_address");
			$driver_information = intval($this->input->post("driver_information"));
			$driver_status = intval($this->input->post("driver_status"));
			$user_id = $this->session->userdata("user_id");
			
			$insertData = array(
				"driver_name" => $driver_name,
				"driver_handphone" => $driver_handphone,
				"driver_address" => $driver_address,
				"driver_information" => $driver_information,
				"driver_status" => $driver_status,
				"user_id" => $user_id,
				"created_by" => $user_id,
				"modified_by" => $user_id
			);
			$this->Driver_model->addDriver($insertData);
			
		} else {
			
		}
	}
	
	public function ajaxList()
    {
        $table = 'm_driver';
        $column_order = array('driver_handphone', 'driver_name', null);
        $column_search = array('driver_handphone', 'driver_name');
        $order = array('driver_id' => 'desc'); // default order 
        $list = $this->getDataTables($table, $column_order, $column_search, $order);
        $datalist = array();
        $no = 0;
        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = $data->driver_id;
            $row[] = $data->driver_name;
            $row[] = $data->driver_handphone;
			
			if($data->driver_status == 1){
                    $row[] = "<div id='status" . $data->driver_id . "'><a title='Status' href='javascript:void(0)' onclick='toggleActive(" . $data->driver_id . ",0);' class='btn btn-success'>Aktif</a></div>";
            } else {
                    $row[] = "<div id='status" . $data->driver_id . "\'><a title='Status' href='javascript:void(0)' onclick='toggleActive(" . $data->driver_id . ",1);' class='btn btn-danger'>Tidak Aktif</a></div>";
            }			

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Ubah" onclick="editData(' . "'" . $data->driver_id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="deleteData(' . "'" . $data->driver_id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';
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
	
	public function ajaxToggleActive($id, $newStatus)
    {
        $newStatus = $newStatus * 1;
        $id = $id * 1;
        $query = 'update m_driver a set driver_status=' . $newStatus . ' where driver_id=' . $id ;
        $this->db->query($query);

        echo json_encode(array("status" => TRUE));
    }
	
	public function ajaxAdd()
    {
        $this->validasi();
        $data = array(
            'driver_name' => $this->input->post('driver_name'),
            'driver_handphone' => $this->input->post('driver_handphone'),
            'driver_address' => $this->input->post('driver_address'),
            'driver_information' => $this->input->post('driver_information'),
            'driver_status' => (int)$this->input->post('driver_status'),
            'created_date' => date('Y-m-d G:i:s'),
            'created_by' => (int)$this->session->userdata('user_id'),
        );
        $this->insertData('m_driver', $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajaxUpdate()
    {
        $this->validasi();        
        $data = array(
            'driver_name' => $this->input->post('driver_name'),
            'driver_handphone' => $this->input->post('driver_handphone'),
            'driver_address' => $this->input->post('driver_address'),
            'driver_information' => $this->input->post('driver_information'),
            'driver_status' => (int)$this->input->post('driver_status'),
            'modified_date' => date('Y-m-d G:i:s'),
            'modified_by' => (int)$this->session->userdata('user_id')
        );
				
        $this->updateData('m_driver', $data, array('driver_id' => $this->input->post('driver_id')));
        echo json_encode(array("status" => TRUE));
    }
	
	public function ajaxDelete($id)
    {
        $this->deleteData("m_driver", array('driver_id' => $id));
        echo json_encode(array("status" => TRUE));
    }
	
	public function ajaxLoad($id)
    {
        $data = $this->queryData('select * from m_driver where driver_id=' . $id)->row();
        echo json_encode($data);
    }
	
	private function validasi()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;


        if ($this->input->post('driver_name') == '') {
            $data['inputerror'][] = 'driver_name';
            $data['error_string'][] = 'Nama wajib diisi!';
            $data['status'] = FALSE;
        }

        if ($this->input->post('driver_handphone') == '') {
            $data['inputerror'][] = 'driver_handphone';
            $data['error_string'][] = 'No. Handphone wajib diisi!';
            $data['status'] = FALSE;
        }

        if ($this->input->post('driver_address') == '') {
            $data['inputerror'][] = 'driver_address';
            $data['error_string'][] = 'Alamat wajib diisi!';
            $data['status'] = FALSE;
        }
		
		if ($this->input->post('driver_information') == '') {
            $data['inputerror'][] = 'driver_information';
            $data['error_string'][] = 'Keterangan wajib diisi!';
            $data['status'] = FALSE;
        }

        if ($this->input->post('driver_status') == '') {
            $data['inputerror'][] = 'driver_status';
            $data['error_string'][] = 'Status wajib diisi!';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}