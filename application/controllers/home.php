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
            'title' => 'home',
            'page_name' => "home",
        );

        $msg = '';
        $this->session->set_flashdata('msg', $msg);
		$this->load->view('front/common/header', $data);
        $this->load->view('front/home', $data);
		$this->load->view('front/common/footer', $data);
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
			'konsumenChecked' => 'checked',
			'ekspedisiChecked' => '',
			'individuChecked' => 'checked',
			'perusahaanChecked' => '',
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
		$konsumenChecked = "";
		$ekspedisiChecked = "";
		if ($role == "1") {
			$konsumenChecked = "checked";
		} else {
			$ekspedisiChecked = "checked";
		}
		
		$type = $this->input->post("type", true);
		$individuChecked = "";
		$perusahaanChecked = "";
		if ($type == "1") {
			$individuChecked = "checked";
		} else {
			$perusahaanChecked = "checked";
		}
		
		$username = $this->input->post("username", true);
		$email = $this->input->post("email", true);
		$nama = $this->input->post("nama", true);
		$alamat = $this->input->post("alamat", true);
		$telp = $this->input->post("telp", true);
		$handphone = $this->input->post("handphone", true);
		$password = $this->input->post("password", true);
		$konfirmasi = $this->input->post("konfirmasi", true);
		$terms = $this->input->post("terms", true);
		
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		
		if ($this->form_validation->run('form-register') == FALSE) {
			$data = array(
				'title' => 'Register',
				'active' => array('', '', '', 'active'),
				'konsumenChecked' => $konsumenChecked,
				'ekspedisiChecked' => $ekspedisiChecked,
				'individuChecked' => $individuChecked,
				'perusahaanChecked' => $perusahaanChecked,
				'username' => $username,
				'email' => $email,
				'nama' => $nama,
				'alamat' => $alamat,
				'telp' => $telp,
				'handphone' => $handphone,
				'terms' => $terms
			);
			$this->load->view('front/register', $data);
		} else {
			$insertData = array(
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
			$this->Registration_model->doRegister($insertData);
			header("Location: " . base_url("login"));
		}
	}
	
	public function cekUsernameKembar() {
		$username = $this->input->post('username', true);
		if ($username == "") {
			//header("Location: " . base_url("register"));
		} else {
			$kembar = "false";
			$other_username = $this->Registration_model->getUsername($username);
			if (count($other_username) > 0) { //berarti sudah ada username tsb di table m_user
				$kembar = "true";
			}
			echo $kembar;
		}
	}
	
	public function cekEmailKembar() {
		$email = $this->input->post('email', true);
		if ($email == "") {
			//header("Location: " . base_url("register"));
		} else {
			$kembar = "false";
			$other_email = $this->Registration_model->getEmail($email);
			if (count($other_email) > 0) { //berarti sudah ada email tsb di table m_user
				$kembar = "true";
			}
			echo $kembar;
		}
	}

    public function getValue($inputname)
    {
        return $this->input->post($inputname);
    }
}
