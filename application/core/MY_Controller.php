<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
    ini adalah controller umum.
    Semua controller dalam folder controllers/panel extends controller ini.
*/

class MY_Controller extends CI_Controller
{
	protected $modules = "";
    protected $activeMenu = array(
        "admin" => "",
        "dashboard" => "",
        "kirim_barang" => "",
        "kiriman_saya" => "",
        "kiriman_saya_bisnis" => "",
        "lokasi" => "",
        "cari_kiriman" => "",
        "cari_kiriman_bisnis" => "",
        "penawaran" => "",
        "penawaran_bisnis" => "",
        "kiriman_darat" => "",
        "kiriman_laut" => "",
        "kendaraan" => "",
        "supir" => "",
        "alat" => "",
        "user" => "",
        "rekanan" => "",
        "ulasan" => "",
        "verifikasi" => "",
        "statistik" => ""
    );

    /*
        Secara default, semua controller dalam folder controllers/panel mengharuskan login, sehingga function ini pasti dipanggil.
    */
    public function __construct()
    {
        parent::__construct();
        $this->cekLogin();
        $this->load->model('M_GenFunc','',TRUE);
    }

    /*
        controller Kirim memakai function ini, karena ada beberapa halaman yang bisa dilihat tanpa login, yaitu halaman list kiriman dan detail kiriman
    */
    public function __partial_construct()
    {
        parent::__construct();
    }

    public function __second_construct()
    {
        $this->cekLogin();
        $this->load->model('M_GenFunc','',TRUE);
    }

    /*
        mengecek apakah user sudah login, yg dicek adalah session 'isLoggedIn'
    */
    public function cekLogin()
    {
        if ($this->session->userdata('isLoggedIn') != 1) {
            redirect(base_url("login"));
        }
    }
    
    /*
        function untuk load modul / plugin untuk suatu halaman. Modul yg tersedia adalah : 
        1. datepicker (untuk memunculkan datepicker di textbox)
        2. pagination (untuk halaman yg memerlukan pagination, misal list kiriman, yang isinya tidak diload semua, melainkan ditampilkan max 50 per halaman)
        3. rating (untuk memunculkan rating, memberikan rating yang berupa bintang)
        4. tabs (untuk halaman yg memerlukan tab. Misal halaman kiriman ekspedisi, ada tab konfirmasi, pesanan, dikirim, diambil, diterima, selesai, cancel.)

        Setiap modul terdiri dari file css (terdapat di assets/template/css/nama_modul.css) dan js (terdapat di assets/template/js/nama_modul.js).
    */
	public function loadModule($moduleName) {
		$this->modules .= "<link href='" . base_url("assets/template/css/" . $moduleName . ".css?v=5") . "' rel='stylesheet'>" . "<script src='" . base_url("assets/template/js/" . $moduleName . ".js?v=9") . "'></script>";
	}

    /*
        Settingan untuk upload gambar / file. ini dipakai ketika end user mau membuat kiriman.
        Juga dipakai di menu "Account Settings" ketika mau upload file NPWP, TDP, SIUP
    */
    public function upload_file_settings($path = '', $max_size = '', $file_name = "")
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = '*';
        $config['max_size'] = $max_size;
        $config['remove_spaces'] = true;
        $config['overwrite'] = true;
        $config['encrypt_name'] = false;
        $config['max_width'] = '';
        $config['max_height'] = '';
        if ($file_name != "") {
            $config["file_name"] = $file_name;
        }
        $this->load->library('upload', $config);
    }

    /*
        Controller pada folder controllers/panel, ketika mau load view, tidak secara lgsg $this->load->view('nama_view');
        Melainkan dengan parent::template('nama_view', $data);
        Karena function ini berguna utk load file header, footer, dan modul

        Header melakukan load file2 js dan css yg diperlukan.
    */
    public function template($file, $data){
		$data["pageName"] = $file;
		$data["modules"] = $this->modules;
        $data["activeMenu"] = $this->activeMenu;
        $this->load->view('template/top', $data);
        $this->load->view($file, $data);
        $this->load->view('template/bottom');
    }

    /*
        Pada controller, untuk mendapatkan data dari database, perlu melalui model.
        Setelah mendapatkan data dari model, jika query pada model menggunakan query builder yg disediakan codeigniter,
        dan hasil yang diinginkan hanya berupa status 'success/error', maka bisa menggunakan function ini.
        Misal model melakukan update nama kendaraan menggunakan query builder yg disediakan codeigniter,
        maka yg diperlukan adalah status 'success/error'.
    */
    public function generate_common_results($db, $source = "ci") {
        if ($source == "ci") {
            if ($db->error()["code"] == "0") {
                echo json_encode(array(
                    "status" => "success"
                ));
            } else {
                echo json_encode(array(
                    "status" => "error",
                    "error_code" => $db->error()["code"],
                    "error_message" => $db->error()["message"]
                ));
            }
        }
    }

    /*
        Settingan untuk mengirim email
    */
    public function get_default_email_config() {
        $config["protocol"] = "smtp";
		$config["smtp_host"] = "mail.wahanafurniture.com";
		$config["smtp_user"] = "admin@wahanafurniture.com";
		$config["smtp_pass"] = "admin123123";
		$config["smtp_port"] = 587;
        $config["smtp_crypto"] = "tls";
        return $config;
    }

    /*
        Function umum yg dapat dipakai di mana saja untuk mengecek apakah suatu username sudah ada / belum.
    */
    public function checkUserKembar() {
        $this->load->model("Common_model");
		$username = $this->input->post("username", true);
		if ($username) {
			$user = $this->Common_model->getUsername($username);
			if (sizeof($user) > 0) {
				echo json_encode(array(
					"status" => "success",
					"result" => "kembar"
				));
			} else {
				echo json_encode(array(
					"status" => "success",
					"result" => "tidak_kembar"
				));
			}
		}
	}

    /*
        Function umum yg dapat dipakai di mana saja untuk mengecek email kembar.
        Bisa dipakai ketika user register, register alat
    */
	public function checkEmailKembar() {
        $this->load->model("Common_model");
		$email = $this->input->post("user_email", true);
		if ($email) {
			$email = $this->Common_model->getEmail($email);
			if (sizeof($email) > 0) {
				echo json_encode(array(
					"status" => "success",
					"result" => "kembar"
				));
			} else {
				echo json_encode(array(
					"status" => "success",
					"result" => "tidak_kembar"
				));
			}
		}
	}

    function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyz') {
		$str = '';
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$str .= $keyspace[mt_rand(0, $max)];
		}
		return $str;
	}

    /*
        Untuk mengecek apakah suatu url dipanggil melalui ajax, atau diketikkan secara langsung di browser.
        Jika diketikkan secara langsung di browser, maka akan diredirect ke halaman utama
    */
    function checkAjaxRequest() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {
            return true;
        } else {
            header("Location: " . base_url());
        }
    }

    /*
        Untuk mengecek apakah halaman diakses menggunakan mobile atau tidak.
        Kembalian berupa true/false
    */
    function isMobile() {
		return preg_match("/(android|webos|avantgo|iphone|ipad|ipod|blackbe‌​rry|iemobile|bolt|bo‌​ost|cricket|docomo|f‌​one|hiptop|mini|oper‌​a mini|kitkat|mobi|palm|phone|pie|tablet|up\.browser|up\.link|‌​webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}

    public function queryData($select) {
        return $this->M_GenFunc->querydata($select);
    }

    public function queryArray($select) {
        return $this->M_GenFunc->querydata($select)->result_array();
    }

    public function selectData($where) {
        return $this->M_GenFunc->selectdata($where);
    }

    public function selectArray($where) {
        return $this->M_GenFunc->selectdata($where)->result_array();
    }

    public function insertData($tabel, $data){
        return $this->M_GenFunc->insertdata($tabel,$data);
    }

    public function deleteData($tabel, $where){
        return $this->M_GenFunc->deletedata($tabel,$where);
    }

    public function updateData($tabel, $data, $where){
        return $this->M_GenFunc->updatedata($tabel,$data,$where);
    }

    public function getDataTables($table,$column_order,$column_search,$order){
        return $this->M_GenFunc->get_datatables($table,$column_order,$column_search,$order);
    }

    public function countFiltered($table,$column_order,$column_search,$order){
        return $this->M_GenFunc->count_filtered($table,$column_order,$column_search,$order);
    }

    public function countAll($table,$column_order,$column_search,$order){
        return $this->M_GenFunc->count_all($table,$column_order,$column_search,$order);
    }
}