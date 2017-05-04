<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'title' => 'User',
			"page_title" => "User"
        );

        parent::template('user', $data);
    }
	
	public function ajaxGroupList(){
		$table = 'm_group';
        $column_order = array('group_name', null);
        $column_search = array('group_name');
        $order = array('group_id' => 'desc'); // default order 
        $list = $this->getDataTables($table, $column_order, $column_search, $order);
        $datalist = array();
        $no = 0;
        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = $data->group_id;
            $row[] = $data->group_name;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Ubah" onclick="editGroup(' . "'" . $data->group_id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>';

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
	
	public function ajaxGroupAdd()
    {
        $this->group_validasi();
        $data = array(
            'group_name' => $this->input->post('group_name'),
            'user_id' => (int)$this->session->userdata('user_id'),
            'created_date' => date('Y-m-d G:i:s'),
            'created_by' => (int)$this->session->userdata('user_id'),
        );
        $this->insertData('m_group', $data);
        echo json_encode(array("status" => TRUE));
    }
	
	public function ajaxGroupLoad($id){

        $data = $this->queryData('select * from m_group where group_id=' . $id)->row();
        echo json_encode($data);
	}
	
    public function ajaxGroupUpdate()
    {
        $this->group_validasi();        
        $data = array(
            'group_name' => $this->input->post('group_name'),
            'modified_date' => date('Y-m-d G:i:s'),
            'modified_by' => (int)$this->session->userdata('user_id')
        );
				
        $this->updateData('m_group', $data, array('group_id' => $this->input->post('group_id')));
        echo json_encode(array("status" => TRUE));
    }	
	
	private function group_validasi()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;


        if ($this->input->post('group_name') == '') {
            $data['inputerror'][] = 'group_name';
            $data['error_string'][] = 'Nama Group wajib diisi!';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
	
	public function ajaxUserList(){
		$table = 'm_user_sub';
        $column_order = array('user_fullname', 'user_sub_email', null);
        $column_search = array('user_fullname', 'user_sub_email');
        $order = array('user_sub_id' => 'desc'); // default order 
        $list = $this->getDataTables($table, $column_order, $column_search, $order);
        $datalist = array();
        $no = 0;
        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }
        foreach ($list as $data) {
            $no++;
            $row = array();
            $row[] = $data->user_sub_id;
            $row[] = $data->user_sub_fullname;
            $row[] = $data->user_sub_email;
            $row[] = 'Group Malang';
			
			if($data->user_sub_status == 1){
                    $row[] = "<div id='status" . $data->user_sub_id . "'><a title='Status' href='javascript:void(0)' onclick='toggleActive(" . $data->user_sub_id . ",0);' class='btn btn-success'>Aktif</a></div>";
            } else {
                    $row[] = "<div id='status" . $data->user_sub_id . "\'><a title='Status' href='javascript:void(0)' onclick='toggleActive(" . $data->user_sub_id . ",1);' class='btn btn-danger'>Tidak Aktif</a></div>";
            }

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Ubah" onclick="editUser(' . "'" . $data->user_sub_id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i></a>';

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
	
	public function ajaxUserAdd()
    {
        $this->user_validasi();
		$data = array(
            'user_sub_email' => $this->input->post('user_sub_email'),
            'user_id' => (int)$this->session->userdata('user_id'),
            'user_group' => (int)$this->input->post('user_group'),
            'user_sub_status' => '0',
            'created_date' => date('Y-m-d G:i:s'),
            'created_by' => (int)$this->session->userdata('user_id'),
        );
        $this->insertData('m_user_sub', $data);
        echo json_encode(array("status" => TRUE));
    }
	
	public function ajaxUserAddLoad(){	   
			$data = $this->queryData('select * from m_group')->row();
             echo json_encode($data);
	}
	
	public function ajaxUserLoad($id)
    {
        $data = $this->queryData('select * from m_user_sub where user_sub_id=' . $id)->row();
        echo json_encode($data);
    }
	
	public function ajaxToggleActive($id, $newStatus)
    {
        $newStatus = $newStatus * 1;
        $id = $id * 1;
        $query = 'update m_user_sub a set user_sub_status=' . $newStatus . ' where user_sub_id=' . $id ;
        $this->db->query($query);

        echo json_encode(array("status" => TRUE));
    }
	
	private function user_validasi()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;


        if ($this->input->post('user_sub_email') == '') {
            $data['inputerror'][] = 'user_sub_email';
            $data['error_string'][] = 'Email wajib diisi!';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}