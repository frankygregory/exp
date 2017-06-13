<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//ini_set('max_execution_time', 0); 
//ini_set('memory_limit','2048M');

class Home extends CI_Controller
{
	protected $modules = "";
	protected $activePage = ["home" => "", "list_kiriman" => "", "contact_us" => "", "daftar" => "", "login" => ""];
    public function __construct()
    {
        parent::__construct();
    }

	public function loadModule($moduleName) {
		$this->modules .= "<link href='" . base_url("assets/template/css/" . $moduleName . ".css") . "' rel='stylesheet'>" . "<script src='" . base_url("assets/template/js/" . $moduleName . ".js") . "'></script>";
	}

	public function cekLogin()
    {
		$isLoggedIn = false;
        if ($this->session->userdata('isLoggedIn') == 1) {
            $isLoggedIn = true;
		}
		return $isLoggedIn;
    }

    public function index()
    {
		$isLoggedIn = $this->cekLogin();
        $data = array(
            'title' => 'home',
            'page_name' => "home",
			'additional_file' => "",
			"isLoggedIn" => $isLoggedIn,
			"modules" => $this->modules,
			"activePage" => $this->activePage,
			"headerScroll" => ""
        );

		$this->load->view('front/common/header', $data);
        $this->load->view('front/home', $data);
		$this->load->view('front/common/footer', $data);
    }

	public function list_kiriman()
	{
		$this->activePage["list_kiriman"] = "active";
		$isLoggedIn = $this->cekLogin();
		$this->loadModule("pagination");
		$data = array(
            'title' => 'List Kiriman',
            'page_name' => "kirim",
			'page_title'=> 'List Kiriman',
			'additional_file' => '<link href="' . base_url() . 'assets/panel/css/default.css" rel="stylesheet"><link href="' . base_url() . 'assets/panel/css/kirim.css" rel="stylesheet">',
			"isLoggedIn" => $isLoggedIn,
			"modules" => $this->modules,
			"activePage" => $this->activePage,
			"headerScroll" => "scroll white-background"
        );

		$this->load->view('front/common/header', $data);
        $this->load->view('kirim', $data);
		$this->load->view('front/common/footer', $data);
	}

	public function how($role)
	{
		$isLoggedIn = $this->cekLogin();
		$segment = $this->uri->segment(2);
		$page_name;
		if ($segment == "pemilik-barang") {
			$page_name = "how_konsumen";
		} else if ($segment == "pemilik-kendaraan") {
			$page_name = "how_ekspedisi";
		}

		$data = array(
            'title' => 'How It Works',
            'page_name' => $page_name,
			'page_title'=> 'How It Works - Pemilik Barang',
			'additional_file' => "",
			"isLoggedIn" => $isLoggedIn,
			"modules" => $this->modules,
			"activePage" => $this->activePage,
			"headerScroll" => "scroll white-background"
        );
		$this->load->view('front/common/header', $data);
		$this->load->view('front/' . $page_name, $data);
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
		$this->activePage["daftar"] = "active";
		$isLoggedIn = $this->cekLogin();
        $data = array(
            'title' => 'Register',
			'page_name' => "register",
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
			'handphone' => '',
			'additional_file' => "",
			"isLoggedIn" => $isLoggedIn,
			"modules" => $this->modules,
			"activePage" => $this->activePage,
			"headerScroll" => "scroll white-background"
        );
		$this->load->view('front/common/header', $data);
        $this->load->view('front/register', $data);
		$this->load->view('front/common/footer', $data);
    }

    public function terms(){
		$isLoggedIn = $this->cekLogin();
        $data = array(
            'title' => 'Syarat dan Ketentuan',
			'page_name' => "terms",
			'page_title'=> 'Syarat dan Ketentuan',
			'additional_file' => "",
			"isLoggedIn" => $isLoggedIn,
			"modules" => $this->modules,
			"activePage" => $this->activePage,
			"headerScroll" => "scroll white-background"
        );
		$this->load->view('front/common/header', $data);
        $this->load->view('front/privacy_policy', $data);
		$this->load->view('front/common/footer', $data);
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
