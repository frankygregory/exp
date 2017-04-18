<?php

/**
NOTE
This model is used for general used and not tied on one or more model
This model is used by application\controllers\core\MY_Controller.php
**/

class M_GenFunc extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function insertdata($tabel, $data){
		$this->db->insert($tabel,$data);
		return $this->db->affected_rows();
	}
	
	function deletedata($tabel,$where){
		$this->db->delete($tabel,$where);
	}
	
	function updatedata($tabel,$data,$where){
		$this->db->update($tabel,$data,$where);
		return $this->db->affected_rows();
	}

	function selectdata($where = ''){
		return $this->db->query("select * from $where;");
	}

	function querydata($select = ''){
		return $this->db->query($select);
	}

	private function _get_datatables_query($table,$column_order,$column_search,$order)
	{
		$this->db->from($table);

		$i = 0;
		foreach ($column_search as $item) // loop column 
		{
			if ((isset($_POST['search']['value'])) && ($_POST['search']['value'])) // if datatable send POST for search
			{
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($order))
		{
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables($table,$column_order,$column_search,$order)
	{
		$this->_get_datatables_query($table,$column_order,$column_search,$order);
		if (isset($_POST['length']) && $_POST['length'] != -1) { $this->db->limit($_POST['length'], $_POST['start']); }
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($table,$column_order,$column_search,$order)
	{
		$this->_get_datatables_query($table,$column_order,$column_search,$order);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_all($table,$column_order,$column_search,$order)
	{
		$this->_get_datatables_query($table,$column_order,$column_search,$order);
		return $this->db->count_all_results();
	}
	
	public function getUsernameAndRoleByUserId($id) {
		$this->db->select("role_id, username");
		$this->db->where("user_id", $id);
		$this->db->limit(1);
		return $this->db->get("m_user")->result();
	}

/*	function get_by_id($table,$id)
	{
		$this->db->from($table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	function save($table,$data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	function update($table,$where,$data)
	{
		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();
	}

	function delete_by_id($table,$id)
	{
		$this->db->where('id', $id);
		$this->db->delete($table);
	}*/
}

?>