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
			"activePage" => $this->activePage
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
			'additional_file' => '<link href="' . base_url() . 'assets/panel/css/default.css" rel="stylesheet"><link href="' . base_url() . 'assets/panel/css/kirim.css?v=1" rel="stylesheet">',
			"isLoggedIn" => $isLoggedIn,
			"modules" => $this->modules,
			"activePage" => $this->activePage
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
			"activePage" => $this->activePage
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
			"activePage" => $this->activePage
        );
		$this->load->view('front/common/header', $data);
        $this->load->view('front/register', $data);
		$this->load->view('front/common/footer', $data);
    }

	public function profil($id) {
		$this->load->model("Profil_model");
		$user = $this->Profil_model->getUser($id);
		if (sizeof($user) > 0) {
			$isLoggedIn = $this->cekLogin();
			$data = array(
				'title' => 'Profil',
				'page_name' => "profil",
				'page_title'=> 'Profil',
				'additional_file' => '<link href="' . base_url() . 'assets/panel/css/default.css" rel="stylesheet">',
				"user" => $user,
				"isLoggedIn" => $isLoggedIn,
				"modules" => $this->modules,
				"activePage" => $this->activePage
			);
			$this->load->view('front/common/header', $data);
			$this->load->view('front/profil', $data);
			$this->load->view('front/common/footer', $data);
		} else {
			header("Location: " . base_url());
		}
	}

	public function getStatistik() {
		$this->load->model("Statistik_model");
		$user_id = $this->input->post("user_id");
		$statistik = $this->Statistik_model->getStatistik($user_id);
		echo json_encode($statistik);
	}

	public function getProfilRating() {
		$this->load->model("Ulasan_model");
		$user_id = $this->input->post("user_id");
		$rating = $this->Ulasan_model->getMyRating($user_id);
		echo json_encode($rating);
	}
	
	public function getProfilFeedback() {
		$this->load->model("Ulasan_model");
		$sort = $this->input->post("sort");
		$user_id = $this->input->post("user_id");
		$feedbacks = $this->Ulasan_model->getMyFeedback($sort, $user_id);
		echo json_encode($feedbacks);
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
			"activePage" => $this->activePage
        );
		$this->load->view('front/common/header', $data);
        $this->load->view('front/privacy_policy', $data);
		$this->load->view('front/common/footer', $data);
    }
	
	public function doRegisterConsumer() {
		$config["protocol"] = "smtp";
		$config["smtp_host"] = "mail.wahanafurniture.com";
		$config["smtp_user"] = "admin@wahanafurniture.com";
		$config["smtp_pass"] = "admin123123";
		$config["smtp_port"] = 587;
		$this->load->library("email", $config);

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
			$result = $this->Registration_model->doRegister($insertData)[0];
			if ($result->status == "success") {
				$this->email->set_newline("\r\n");
				$this->email->from("admin@wahanafurniture.com");
				$this->email->to($email);
				$this->email->subject("Verifikasi Yukirim");
				$this->email->message("Terima kasih telah mendaftar. Untuk mengaktifkan account anda, silakan mengklik link di bawah ini:\n" . base_url("verify-email/" . $result->generated_token));
				if ($this->email->send()) {
					$this->session->set_flashdata('flash_message', 'Kode verifikasi untuk mengaktifkan account anda telah dikirim ke ' . $email);
				} else {
					$this->session->set_flashdata('flash_message', "gagal mengirim email");
				}

				$this->session->keep_flashdata("flash_message");
				header("Location: " . base_url());
			} else {
				echo "error";
			}
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

	public function verify_email($token) {
		$isLoggedIn = $this->cekLogin();
        $data = array(
            'title' => 'Verifikasi',
            'page_name' => "verify",
			'additional_file' => "",
			"isLoggedIn" => $isLoggedIn,
			"modules" => $this->modules,
			"activePage" => $this->activePage,
			"verifikasi_type" => 1
        );

		$result = $this->Registration_model->verifyEmail($token)[0];
		$data["result"] = $result;

		$this->load->view('front/common/header', $data);
        $this->load->view('front/verify', $data);
		$this->load->view('front/common/footer', $data);
	}

	public function verify_device_email($token) {
		$isLoggedIn = $this->cekLogin();
        $data = array(
            'title' => 'Verifikasi',
            'page_name' => "verify",
			'additional_file' => "",
			"isLoggedIn" => $isLoggedIn,
			"modules" => $this->modules,
			"activePage" => $this->activePage,
			"verifikasi_type" => 2
        );

		$result = $this->Registration_model->verifyDeviceEmail($token)[0];
		$data["result"] = $result;

		$this->load->view('front/common/header', $data);
        $this->load->view('front/verify', $data);
		$this->load->view('front/common/footer', $data);
	}

	function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyz') {
		$str = '';
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$str .= $keyspace[mt_rand(0, $max)];
		}
		return $str;
	}

	public function forgot_password() {
		$isLoggedIn = $this->cekLogin();
        $data = array(
            'title' => 'Lupa Password',
            'page_name' => "forgot_password",
			'additional_file' => "",
			"isLoggedIn" => $isLoggedIn,
			"modules" => $this->modules,
			"activePage" => $this->activePage,
			"post" => 0
        );

		$user_email = $this->input->post("user_email", true);
		if ($user_email) {
			$config["protocol"] = "smtp";
			$config["smtp_host"] = "mail.wahanafurniture.com";
			$config["smtp_user"] = "admin@wahanafurniture.com";
			$config["smtp_pass"] = "admin123123";
			$config["smtp_port"] = 587;
			$this->load->library("email", $config);

			$data["post"] = 1;
			$password = $this->random_str(6);
			$resetData = array(
				"user_email" => $user_email,
				"password" => $password
			);
			$result = $this->Registration_model->forgotPassword($resetData)[0];
			$data["result"] = $result;

			if ($result->status == "success") {
				$this->email->set_newline("\r\n");
				$this->email->from("admin@wahanafurniture.com");
				$this->email->to($user_email);
				$this->email->subject("Reset Password Yukirim");
				$this->email->message("Password baru anda adalah :\n\n" . $password . "\n\nUntuk mengaktifkan password baru anda, silakan mengklik link di bawah ini:\n" . base_url("reset-password/" . $result->generated_token));
				$this->email->send();
			}
		}

		$this->load->view('front/common/header', $data);
        $this->load->view('front/forgot_password', $data);
		$this->load->view('front/common/footer', $data);
	}

	public function reset_password($token) {
		$isLoggedIn = $this->cekLogin();
        $data = array(
            'title' => 'Reset Password',
            'page_name' => "verify",
			'additional_file' => "",
			"isLoggedIn" => $isLoggedIn,
			"modules" => $this->modules,
			"activePage" => $this->activePage,
			"verifikasi_type" => 3
        );

		$result = $this->Registration_model->verifyResetPassword($token)[0];
		$data["result"] = $result;
		$this->load->view('front/common/header', $data);
        $this->load->view('front/verify', $data);
		$this->load->view('front/common/footer', $data);
	}

    public function getValue($inputname)
    {
        return $this->input->post($inputname);
    }
}
