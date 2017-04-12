<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//ini_set('max_execution_time', 0); 
//ini_set('memory_limit','2048M');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array(
            'title' => 'Home',
            'active' => array('active', '', '', ''),
        );

        $msg = '';
        $this->session->set_flashdata('msg', $msg);

        $this->load->view('front/home', $data);
    }

    public function contact()
    {
        $data = array(
            'title' => 'Contact',
            'active' => array('', '', 'active', ''),
        );
        $this->load->view('front/contact', $data);
    }

    public function register()
    {
        $data = array(
            'title' => 'Register',
            'active' => array('', '', '', 'active'),
			'username' => '',
			'email' => '',
			'nama' => '',
			'alamat' => '',
			'telp' => '',
			'handphone' => ''
        );
        $this->load->view('front/register', $data);
    }

    public function privacy_policy(){
        $data = array(
            'title' => 'Kebijakan Privasi',
            'active' => array('', '', '', 'active'),
        );
        $this->load->view('front/privacy_policy', $data);
    }
	
	public function doRegisterConsumer() {
		$role = $this->input->post("role", true);
		$type = $this->input->post("type", true);
		$username = $this->input->post("username", true);
		$email = $this->input->post("email", true);
		$nama = $this->input->post("nama", true);
		$alamat = $this->input->post("alamat", true);
		$telp = $this->input->post("telp", true);
		$handphone = $this->input->post("handphone", true);
		$password = $this->input->post("password", true);
		$konfirmasi = $this->input->post("konfirmasi", true);
		$terms = $this->input->post("terms", true);
		
		$data = array(
            'title' => 'Register',
            'active' => array('', '', '', 'active'),
			'role' => $role,
			'type' => $type,
			'username' => $username,
			'email' => $email,
			'nama' => $nama,
			'alamat' => $alamat,
			'telp' => $telp,
			'handphone' => $handphone,
			'password' => $password,
			'terms' => $terms
        );
		
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		
		if ($this->form_validation->run('form-register') == FALSE) {
			$this->load->view('front/register', $data);
		} else {
			$this->Registration_model->doRegister($data);
			$this->load->view('front/login', $data);
		}
	}

   /* public function doRegisterConsumer()
    {
        if ($this->form_validation->run('registration_consumer') == FALSE) {
			
            $data = array(
                'title' => 'Register',
                'active' => array('', '', '', 'active'),
            );
            $this->load->view('front/register', $data);
        } else {
			
          //  $this->load->model('Registration_model');
            $this->Registration_model->doRegisterConsumer_model();

            $msg = '<div class="alert alert-success fade in block-inner">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<i class="icon-checkmark-circle"></i> Sukses! Data berhasil tersimpan.
							 </div>';

            $this->session->set_flashdata('msg', $msg);
            redirect(base_url() . "register");
        }
    }*/

   /* public function doRegisterExpedition()
    {
       // $this->load->model('Registration_model');
	    
		if ($this->form_validation->run('registration_expedition') == FALSE) {
            $data = array(
                'title' => 'Register',
                'active' => array('', '', '', 'active'),
            );
            $this->load->view('front/register', $data);
        } else {
            $this->load->model('Login_model');
            $this->Registration_model->doRegisterExpedition_model();

            $msg = '<div class="alert alert-success fade in block-inner">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<i class="icon-checkmark-circle"></i> Sukses! Data berhasil tersimpan.
							 </div>';

            $this->session->set_flashdata('msg', $msg);
            redirect(base_url() . "register");
        }
    }*/

    public function getValue($inputname)
    {
        return $this->input->post($inputname);
    }
}
