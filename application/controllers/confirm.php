<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Confirm extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }
	
	public function index(){
	  $data = array(
	    'title' => 'Confirmation'
	  );
	  
	  $this->load->view('front/Confirm', $data);
	}
	
	public function doconfirm(){
	  	if ($this->form_validation->run('confirm') == FALSE) {
			$data = array(
                'title' => 'Confirm'
            );
            $this->load->view('front/confirm', $data);
		}else{
			$id = $this->input->post('id'); // id otomatis terselect saat link di email diklik
			$username = $this->input->post('username');
			$name = $this->input->post('name');
			$password = $this->input->post('password');
			
			$data = array(
			  'username' => $username,
			  'password' => $password,
			  'user_sub_fullname' => $name			  
			);
			
			$this->db->update('m_user_sub', $data, array('m_user_id' => $id));
			
			$msg = '<div class="alert alert-success fade in block-inner">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<i class="icon-checkmark-circle"></i> Sukses! Data berhasil tersimpan. Silahkan login melalui halaman login.
							 </div>';

            $this->session->set_flashdata('msg', $msg);
            redirect(base_url() . "confirm");
		}
	}
	
}