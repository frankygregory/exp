<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekanan extends MY_Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'title' => 'Rekanan'
        );
		
		//$rekan = $this->db->query("select user_id, party_id from m_user_party where user_id = 1 or party_id = 1")->result_array();
		parent::template('rekanan', $data);
    }
	
	public function ajaxList()
    {
		
		if($this->session->userdata('role_id') == 1){
			$query = 'select * from m_user where role_id = 2';
		}else if($this->session->userdata('role_id') == 2){
			$query = 'select * from m_user where role_id = 1';
		}else if($this->session->userdata('role_id') == 0){
			$query = 'select * from m_user';
		}		
		
        $table = '(' . $query . ') a';
        $column_order = array('user_fullname', 'user_email', 'user_address', null);
        $column_search = array('user_fullname', 'user_email', 'user_address');
        $order = array('user_id' => 'desc'); // default order 
        $list = $this->getDataTables($table, $column_order, $column_search, $order);
        $datalist = array();
        $no = 0;
        if (isset($_POST['start'])) {
            $no = $_POST['start'];
        }		
				
        foreach ($list as $data) {
		
		$rekan = $this->db->query("select user_id, party_id from m_user_party where user_id = " . $data->user_id . " or party_id = " . $data->user_id)->row();	
		if(!empty($rekan)){
		  if($data->user_email == "interisty91@gmail.com"){
		     $a = "Teman";
		  }else {
			 $a = "Tunggu Konfirmasi";
		  }
		}else{
		  $a = "Bukan Teman";
		}
			
			$no++;
            $row = array();
            $row[] = $data->user_fullname;
            $row[] = $data->user_address;
            $row[] = $data->user_email;
            $row[] = $a;
            
            //add html for action
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
}