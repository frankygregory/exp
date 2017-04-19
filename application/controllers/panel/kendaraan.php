<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan extends MY_Controller
{
    public $query;

    public function __construct()
    {
        parent::__construct();
        $this->query = 'select a.*,if((isVehichleInUsed(a.vehicle_id)<>0),"Tidak","Ya") available_status,' .
            'if((getVehicleInUsedTrx(a.vehicle_id)<0),"-",getVehicleInUsedTrx(a.vehicle_id)) ref_transaksi ' .
            'from m_vehicle a';
    }

    public function index()
    {
        $data = array(
            'title' => 'Kendaraan',
			'page_title' => "Kendaraan",
            'data' => '',
        );

        parent::template('kendaraan', $data);
    }

    public function ajaxList()
    {
        $table = '(' . $this->query . ') a';
        $column_order = array('vehicle_nomor', 'vehicle_name', null);
        $column_search = array('vehicle_nomor', 'vehicle_name');
        $order = array('vehicle_id' => 'desc'); // default order 
        $list = $this->getDataTables($table, $column_order, $column_search, $order);
        $datalist = array();
        $no = 0;
        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = $data->vehicle_id;
            $row[] = $data->vehicle_nomor;
            $row[] = $data->vehicle_name;
            $row[] = $data->available_status;
            $row[] = $data->ref_transaksi;
            $row[] = $data->vehicle_information;

            //add html for status
            if (strtoupper($data->available_status) === 'YA') {
                if ($data->vehicle_status == 1) {
                    $row[] = "<div id='status" . $data->vehicle_id . "'><a title='Status' href='javascript:void(0)' onclick='toggleActive(" . $data->vehicle_id . ",0);' class='btn btn-success'>Aktif</a></div>";
                } else {
                    $row[] = "<div id='status" . $data->vehicle_id . "\'><a title='Status' href='javascript:void(0)' onclick='toggleActive(" . $data->vehicle_id . ",1);' class='btn btn-danger'>Tidak Aktif</a></div>";
                }
            } else {
                $row[] = "In Used";
            }

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Ubah" onclick="editData(' . "'" . $data->vehicle_id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="deleteData(' . "'" . $data->vehicle_id . "'" . ')"><i class="glyphicon glyphicon-trash"></i></a>';
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
        $data = $this->queryData($this->query . ' where vehicle_id=' . $id)->row();
        echo json_encode($data);
    }

    public function ajaxAdd()
    {
        $this->validasi();
        $data = array(
            'vehicle_nomor' => $this->input->post('vehicleNomor'),
            'vehicle_name' => $this->input->post('vehicleName'),
            'vehicle_information' => $this->input->post('vehicleInformation'),
            'vehicle_status' => (int)$this->input->post('vehicleStatus'),
            'created_by' => (int)$this->session->userdata('user_id'),
        );
        $this->insertData('m_vehicle', $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajaxUpdate()
    {
        $this->validasi();
        $time = date('Y-m-d G:i:s');
        $data = array(
            'vehicle_nomor' => $this->input->post('vehicleNomor'),
            'vehicle_name' => $this->input->post('vehicleName'),
            'vehicle_information' => $this->input->post('vehicleInformation'),
            'vehicle_status' => (int)$this->input->post('vehicleStatus'),
            'modified_by' => (int)$this->session->userdata('user_id'),
            'modified_date' => $time, //'now()',
        );
        $this->updateData('m_vehicle', $data, array('vehicle_id' => $this->input->post('vehicleId')));
        echo json_encode(array("status" => TRUE));
    }

    public function ajaxDelete($id)
    {
        $this->deleteData("m_vehicle", array('vehicle_id' => $id));
        echo json_encode(array("status" => TRUE));
    }

    public function ajaxToggleActive($id, $newStatus)
    {
        $newStatus = $newStatus * 1;
        $id = $id * 1;
        //$this->updateData('m_vehicle',array('vehicle_status'=>$newStatus),array('vehicle_id'=>$id));
        $query = 'update m_vehicle a set vehicle_status=' . $newStatus . ' where vehicle_id=' . $id . ' and isVehichleInUsed(a.vehicle_id)=0';
        $this->db->query($query);

        //redirect('panel/kendaraan');
        echo json_encode(array("status" => TRUE));
    }

    private function validasi()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;


        if ($this->input->post('vehicleNomor') == '') {
            $data['inputerror'][] = 'vehicleNomor';
            $data['error_string'][] = 'Nomor Kendaraan is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('vehicleName') == '') {
            $data['inputerror'][] = 'vehicleName';
            $data['error_string'][] = 'Nama Kendaraan is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('vehicleInformation') == '') {
            $data['inputerror'][] = 'vehicleInformation';
            $data['error_string'][] = 'Keterangan is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('vehicleStatus') == '') {
            $data['inputerror'][] = 'vehicleStatus';
            $data['error_string'][] = 'Status Kendaraan is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    private function  preg_match($string = '')
    {
        return !preg_match('/^[a-zA-Z0-9_\.]+$/', $string);
    }
}