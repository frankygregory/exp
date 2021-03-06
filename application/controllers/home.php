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
		$this->modules .= "<link href='" . base_url("assets/template/css/" . $moduleName . ".css?v=5") . "' rel='stylesheet'>" . "<script src='" . base_url("assets/template/js/" . $moduleName . ".js?v=5") . "'></script>";
	}

	function isMobile() {
		return preg_match("/(android|webos|avantgo|iphone|ipad|ipod|blackbe‌​rry|iemobile|bolt|bo‌​ost|cricket|docomo|f‌​one|hiptop|mini|oper‌​a mini|kitkat|mobi|palm|phone|pie|tablet|up\.browser|up\.link|‌​webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
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
		$is_mobile = $this->isMobile();
		$isLoggedIn = $this->cekLogin();
        $data = array(
            'title' => 'home',
            'page_name' => "home",
			"is_mobile" => $is_mobile,
			'additional_file' => "",
			"isLoggedIn" => $isLoggedIn,
			"modules" => $this->modules,
			"activePage" => $this->activePage
        );

		$this->load->view('front/common/header', $data);
        $this->load->view('front/home', $data);
		$this->load->view('front/common/footer', $data);
    }

	public function login() {
		$is_mobile = $this->isMobile();
		$isLoggedIn = $this->cekLogin();
		if ($isLoggedIn) {
			header("Location: " . base_url("dashboard"));
		}

        $data = array(
            'title' => 'Login',
            'page_name' => "login",
			"is_mobile" => $is_mobile,
			'additional_file' => "",
			"isLoggedIn" => $isLoggedIn,
			"modules" => $this->modules,
			"activePage" => $this->activePage
        );

		$this->load->view('front/common/header', $data);
        $this->load->view('front/login', $data);
		$this->load->view('front/common/footer', $data);
	}

	public function list_kiriman()
	{
		$is_mobile = $this->isMobile();
		$this->activePage["list_kiriman"] = "active";
		$isLoggedIn = $this->cekLogin();
		$this->loadModule("pagination");
		$data = array(
            'title' => 'List Kiriman',
            'page_name' => "kirim",
			'page_title'=> 'List Kiriman',
			"is_mobile" => $is_mobile,
			'additional_file' => '<link href="' . base_url() . 'assets/panel/css/default.css?v=9" rel="stylesheet"><link href="' . base_url() . 'assets/panel/css/kirim.css?v=29" rel="stylesheet">',
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
		$is_mobile = $this->isMobile();
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
			"is_mobile" => $is_mobile,
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
		$is_mobile = $this->isMobile();
		$this->activePage["daftar"] = "active";
		$isLoggedIn = $this->cekLogin();
        $data = array(
            'title' => 'Register',
			'page_name' => "register",
			"is_mobile" => $is_mobile,
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
		$is_mobile = $this->isMobile();
		$this->load->model("Profil_model");
		$user = $this->Profil_model->getUser($id);
		if (sizeof($user) > 0) {
			$isLoggedIn = $this->cekLogin();
			$data = array(
				'title' => 'Profil',
				'page_name' => "profil",
				'page_title'=> 'Profil',
				"is_mobile" => $is_mobile,
				'additional_file' => '<link href="' . base_url() . 'assets/panel/css/default.css?v=9" rel="stylesheet">',
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
		$is_mobile = $this->isMobile();
		$isLoggedIn = $this->cekLogin();
        $data = array(
            'title' => 'Syarat dan Ketentuan',
			'page_name' => "terms",
			'page_title'=> 'Syarat dan Ketentuan',
			"is_mobile" => $is_mobile,
			'additional_file' => "",
			"isLoggedIn" => $isLoggedIn,
			"modules" => $this->modules,
			"activePage" => $this->activePage
        );
		$this->load->view('front/common/header', $data);
        $this->load->view('front/terms', $data);
		$this->load->view('front/common/footer', $data);
    }

	public function privacy_policy(){
		$is_mobile = $this->isMobile();
		$isLoggedIn = $this->cekLogin();
        $data = array(
            'title' => 'Kebijakan Privasi',
			'page_name' => "privacy_policy",
			'page_title'=> 'Kebijakan Privasi',
			"is_mobile" => $is_mobile,
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
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header('Content-Type: text/html');
		
		$config["protocol"] = "smtp";
		$config["smtp_host"] = "mail.wahanafurniture.com";
		$config["smtp_user"] = "admin@wahanafurniture.com";
		$config["smtp_pass"] = "admin123123";
		$config["smtp_port"] = 587;
		$config["smtp_crypto"] = "tls";
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
				$this->email->from("admin@wahanafurniture.com", "Yukirim");
				$this->email->to($email);
				$this->email->subject("Verifikasi Yukirim");
				$this->email->message("Dear " . $nama . ",\n\nTerima kasih telah mendaftar. Untuk mengaktifkan account anda, silakan mengklik link di bawah ini:\n" . base_url("verify-email/" . $result->generated_token) . "\n\nBest regards,\n\nYukirim");
				if (!$this->email->send()) {
					$this->session->set_flashdata('flash_message', 'Kode verifikasi untuk mengaktifkan account anda telah dikirim ke ' . $email . "<form class='form-resend-email' action='" . base_url("resendVerificationEmail") . "' method='post'><input type='hidden' name='verifikasi_id' value='" . $result->verifikasi_id . "' /><button class='btn-resend' type='submit'>Kirim Ulang Email</button></form>");
					$this->session->keep_flashdata("flash_message");
					header("Location: " . base_url());
				} else {
					$this->session->set_flashdata('flash_message', 'Kode verifikasi untuk mengaktifkan account anda telah dikirim ke ' . $email . "<form class='form-resend-email' action='" . base_url("resendVerificationEmail") . "' method='post'><input type='hidden' name='verifikasi_id' value='" . $result->verifikasi_id . "' /><button class='btn-resend' type='submit'>Kirim Ulang Email</button></form>");
					$this->session->keep_flashdata("flash_message");
					header("Location: " . base_url());
				}
			} else {
				echo "error";
			}
		}
	}

	public function resendVerificationEmail() {
		$verifikasi_id = $this->input->post("verifikasi_id", true);
		if ($verifikasi_id) {
			$result = $this->Registration_model->getVerificationToken($verifikasi_id);
			if (sizeof($result) > 0) {
				$result = $result[0];

				$config["protocol"] = "smtp";
				$config["smtp_host"] = "mail.wahanafurniture.com";
				$config["smtp_user"] = "admin@wahanafurniture.com";
				$config["smtp_pass"] = "admin123123";
				$config["smtp_port"] = 587;
				$config["smtp_crypto"] = "tls";
				$this->load->library("email", $config);

				$this->email->set_newline("\r\n");
				$this->email->from("admin@wahanafurniture.com", "Yukirim");
				$this->email->to($result->user_email);
				$this->email->subject("Verifikasi Yukirim");
				$this->email->message("Dear " . $result->user_fullname . ",\n\nTerima kasih telah mendaftar. Untuk mengaktifkan account anda, silakan mengklik link di bawah ini:\n" . base_url("verify-email/" . $result->generated_token) . "\n\nBest regards,\n\nYukirim");
				if (!$this->email->send()) {
					$this->session->set_flashdata('flash_message', 'Kode verifikasi telah dikirim ulang ke ' . $result->user_email);
					$this->session->keep_flashdata("flash_message");
					header("Location: " . base_url());
				} else {
					$this->session->set_flashdata('flash_message', 'Kode verifikasi telah dikirim ulang ke ' . $result->user_email);
					$this->session->keep_flashdata("flash_message");
					header("Location: " . base_url());
				}
			}
		} else {
			header("Location: " . base_url());
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
		$is_mobile = $this->isMobile();
		$isLoggedIn = $this->cekLogin();
        $data = array(
            'title' => 'Verifikasi',
            'page_name' => "verify",
			"is_mobile" => $is_mobile,
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
		$is_mobile = $this->isMobile();
		$isLoggedIn = $this->cekLogin();
        $data = array(
            'title' => 'Verifikasi',
            'page_name' => "verify",
			"is_mobile" => $is_mobile,
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
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header('Content-Type: text/html');

		$is_mobile = $this->isMobile();
		$isLoggedIn = $this->cekLogin();
        $data = array(
            'title' => 'Lupa Password',
            'page_name' => "forgot_password",
			"is_mobile" => $is_mobile,
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
			$config["smtp_crypto"] = "tls";
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
				$this->email->from("admin@wahanafurniture.com", "Yukirim");
				$this->email->to($user_email);
				$this->email->subject("Reset Password Yukirim");
				$this->email->message("Dear " . $result->user_fullname . ",\n\nPassword baru anda adalah :\n\n" . $password . "\n\nUntuk mengaktifkan password baru anda, silakan mengklik link di bawah ini:\n" . base_url("reset-password/" . $result->generated_token) . "\n\nBest regards,\n\nYukirim");
				if (!$this->email->send()) {
					
				}
			}
		}

		$this->load->view('front/common/header', $data);
        $this->load->view('front/forgot_password', $data);
		$this->load->view('front/common/footer', $data);
	}

	public function reset_password($token) {
		$is_mobile = $this->isMobile();
		$isLoggedIn = $this->cekLogin();
        $data = array(
            'title' => 'Reset Password',
            'page_name' => "verify",
			"is_mobile" => $is_mobile,
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
