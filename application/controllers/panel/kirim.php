<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kirim extends MY_Controller
{

    public function __construct()
    {
        parent::__partial_construct();
		$this->load->model("Kirim_model");
		$this->loadModule("datepicker");
    }

    public function index()
    {
		if ($this->session->userdata("user_id")) {
			$this->loadModule("pagination");
			$role_id = $this->session->userdata("role_id");
			$page_title = "List Kiriman";
			if ($role_id == 2) {
				$page_title = "Cari Kiriman";
				$this->activeMenu["cari_kiriman"] = "active";
			}
			
			$data = array(
				'title' => 'All',
				'role_id' => $role_id,
				'page_title' => $page_title,
			);

			parent::template('kirim', $data);
		} else {
			header("Location: " . base_url("list-kiriman"));
		}
    }

	public function pro() {
		parent::__second_construct();

		$this->loadModule("pagination");
		$role_id = $this->session->userdata("role_id");
		$page_title = "Cari Kiriman";
		$this->activeMenu["cari_kiriman_bisnis"] = "active";
		
		$data = array(
			'title' => 'All',
			'role_id' => $role_id,
			'page_title' => $page_title,
		);

		parent::template('kirim_pro', $data);
	}

	public function getKirimanPro() {
		parent::__second_construct();
		parent::checkAjaxRequest();

		$location_from_city = $this->input->post("keyword_from");
		$location_to_city = $this->input->post("keyword_to");
		$shipment_length_max = $this->input->post("shipment_length_max");
		$order_by = $this->input->post("order_by");
		$limit = $this->input->post("view_per_page");
		$page = $this->input->post("page");
		$change_page = $this->input->post("change_page");
		$offset = ($page - 1) * $limit;
		$user_id = $this->session->userdata("user_id");
		
		$data = array(
			"location_from_city" => $location_from_city,
			"location_to_city" => $location_to_city,
			"shipment_length_max" => $shipment_length_max,
			"order_by" => $order_by,
			"limit" => $limit,
			"offset" => $offset,
			"user_id" => $user_id
		);
		$kirim = $this->Kirim_model->getListKirimanUmumPro($data);
		$iLength = sizeof($kirim);
		for ($i = 0; $i < $iLength; $i++) {
			$berakhir = $kirim[$i]->berakhir;
			$kirim[$i]->berakhir = $this->secondsToTime($berakhir);
		}
		$result = new stdClass();
		$result->data = $kirim;

		if ($change_page == "false") {
			$count = $this->Kirim_model->getListKirimanUmumCountPro($data)[0]->count;
			$result->count = $count;
		}
		echo json_encode($result);
	}

	public function getKotaPro() {
		$fromto = $this->input->post("fromto");
		$keyword = $this->input->post("keyword");
		$kota;
		if ($fromto == "from") {
			$kota = $this->Kirim_model->getFromKotaPro($keyword);
		} else {
			$kota = $this->Kirim_model->getToKotaPro($keyword);
		}
		echo json_encode($kota);
	}
	
	function secondsToTime($seconds) {
		$dtF = new \DateTime('@0');
		$dtT = new \DateTime("@$seconds");
		return $dtF->diff($dtT)->format('%a hari, %h jam, %i menit');
	}
	
	public function getKiriman() {
		$location_from_city = $this->input->post("keyword_from");
		$location_to_city = $this->input->post("keyword_to");
		$shipment_length_max = $this->input->post("shipment_length_max");
		$order_by = $this->input->post("order_by");
		$limit = $this->input->post("view_per_page");
		$page = $this->input->post("page");
		$change_page = $this->input->post("change_page");
		$offset = ($page - 1) * $limit;
		
		$data = array(
			"location_from_city" => $location_from_city,
			"location_to_city" => $location_to_city,
			"shipment_length_max" => $shipment_length_max,
			"order_by" => $order_by,
			"limit" => $limit,
			"offset" => $offset
		);
		$kirim = $this->Kirim_model->getListKirimanUmum($data);
		$iLength = sizeof($kirim);
		for ($i = 0; $i < $iLength; $i++) {
			$berakhir = $kirim[$i]->berakhir;
			$kirim[$i]->berakhir = $this->secondsToTime($berakhir);
		}
		$result = new stdClass();
		$result->data = $kirim;

		if ($change_page == "false") {
			$count = $this->Kirim_model->getListKirimanUmumCount($data)[0]->count;
			$result->count = $count;
		}
		echo json_encode($result);
	}
	
	public function getKota() {
		$fromto = $this->input->post("fromto");
		$keyword = $this->input->post("keyword");
		$kota;
		if ($fromto == "from") {
			$kota = $this->Kirim_model->getFromKota($keyword);
		} else {
			$kota = $this->Kirim_model->getToKota($keyword);
		}
		echo json_encode($kota);
	}
	
	public function getRangeHarga() {
		$range = $this->Kirim_model->getRangeHarga();
		echo json_encode($range);
	}

    public function kirimbarang()
    {
		parent::__second_construct();

        $user_id = (int) $this->session->userdata('user_id');
       	$dataHistoryAsal = $this->queryArray("select * from m_location where location_from = 1 and user_id=$user_id");
       	$dataHistoryAkhir = $this->queryArray("select * from m_location where location_to = 1 and user_id=$user_id");
		$this->activeMenu["kirim_barang"] = "active";
        $data = array(
            'title' => 'Kirim Barang',
            'type' => 'new',
            'id' => '',
            'shipment_title' => '',
            'shipment_information' => '',
            'location_from_contact' => '',
            'location_from_name' => '',
            'location_from_address' => '',
            'location_from_latlng' => '',
            'location_from_history' => $dataHistoryAsal,
            'location_to_contact' => '',
            'location_to_name' => '',
            'location_to_address' => '',
            'location_to_latlng' => '',
            'location_to_history' => $dataHistoryAkhir,
            'shipment_delivery_date_from' => '',
            'shipment_delivery_date_to' => '',
            'shipment_end_date' => '',
            'shipment_price' => 0,
            'shipment_pictures' => '',
            'checked_pemesanan' => '',
            'checked_penawaran' => '',
            'btnSave' => 'Simpan',
        );

        parent::template('kirimbarang_form', $data);
    }
	
	function getDiscussions() {
		$shipment_id = $this->input->post("shipment_id");
		$questions = $this->Kirim_model->getQuestions($shipment_id);
		$answers = [];
		if (sizeof($questions) > 0) {
			for ($i = 0; $i < sizeof($questions); $i++) {
				$questions[$i]->created_date = date_format(new DateTime($questions[$i]->created_date), "d-m-Y H:i");
				$questions_id = $questions[$i]->questions_id;
				$answer = $this->Kirim_model->getAnswers($questions_id);
				
				for ($j = 0; $j < sizeof($answer); $j++) {
					$answer[$j]->created_date = date_format(new DateTime($answer[$j]->created_date), "d-m-Y H:i");
				}
				array_push($answers, $answer);
			}
		}
		
		$discussions = array(
			"questions" => $questions,
			"answers" => $answers
		);
		
		echo json_encode($discussions);
	}
	
	function getBiddingList() {
		$shipment_id = $this->input->post("shipment_id");
		$user_id = $this->session->userdata("user_id");
		$bidding = $this->Kirim_model->getBidding($shipment_id);
		$canBid = true;
		for ($i = 0; $i < sizeof($bidding); $i++) {
			if ($bidding[$i]->bidding_status == 0 && $bidding[$i]->user_id == $user_id) {
				$canBid = false;
				break;
			}
		}

		for ($i = 0; $i < sizeof($bidding); $i++) {
			$bidding[$i]->bidding_pickupdate = date_format(new DateTime($bidding[$i]->bidding_pickupdate), "d-m-Y H:i");
			$bidding[$i]->created_date = date_format(new DateTime($bidding[$i]->created_date), "d-m-Y H:i");
			$bidding[$i]->modified_date = date_format(new DateTime($bidding[$i]->modified_date), "d-m-Y H:i");
		}

		$result = new stdClass();
		$result->data = $bidding;
		$result->canBid = $canBid;
		echo json_encode($result);
	}

	function cancelBidding() {
		parent::__second_construct();
		parent::checkAjaxRequest();

		$bidding_id = $this->input->post("bidding_id");
		$user_id = $this->session->userdata("user_id");
		$data = array(
			"bidding_id" => $bidding_id,
			"user_id" => $user_id
		);
		$affected_rows = $this->Kirim_model->cancelBidding($data);
		if ($affected_rows > 0) {
			echo "success";
		} else {
			echo "no rows affected. WHY??";
		}
	}
	
	function getKendaraan() {
		parent::__second_construct();
		parent::checkAjaxRequest();

		$user_id = $this->session->userdata("user_id");
		$this->load->model("Kendaraan_model");
		$vehicles = $this->Kendaraan_model->getKendaraanByUserId($user_id);
		echo json_encode($vehicles);
	}

	function cekLogin()
    {
		$isLoggedIn = false;
        if ($this->session->userdata('isLoggedIn') == 1) {
            $isLoggedIn = true;
		}
		return $isLoggedIn;
    }

    function detail($id)
    {
		$isLoggedIn = $this->cekLogin();
		if (!$isLoggedIn) {
			$this->detail_umum($id);
		} else {
			$data = $this->getDetailData($id);
			parent::template('kirimbarang_detail', $data);
		}
    }

	private function detail_umum($id) {
		$activePage = ["home" => "", "list_kiriman" => "", "contact_us" => "", "daftar" => "", "login" => ""];
		$isLoggedIn = $this->cekLogin();
		$data = array(
			'title' => 'home',
			'page_name' => "kirimbarang_detail",
			'page_title'=> 'Detail Kiriman',
			'additional_file' => '<link href="' . base_url() . 'assets/panel/css/default.css?v=10" rel="stylesheet"><link href="' . base_url() . 'assets/panel/css/kirimbarang_detail.css?v=20" rel="stylesheet">',
			"isLoggedIn" => $isLoggedIn,
			"modules" => "",
			"activePage" => $activePage,
			"headerScroll" => "scroll white-background"
		);

		$detailData = $this->getDetailData($id);
		$data = $data + $detailData;

		$this->load->view('front/common/header', $data);
		$this->load->view('kirimbarang_detail', $data);
		$this->load->view('front/common/footer', $data);
	}

	private function getDetailData($id) {
		$data = $this->Kirim_model->getShipment($id);
		$items = $this->Kirim_model->getShipmentDetail($id);
		$user_id = $this->session->userdata("user_id");
		$user_username = $this->session->userdata("username");
		$user_role = $this->session->userdata("role_id");
		
		$order_type = $data[0]->order_type;
		$order_type_name = "Penawaran";
		if ($order_type == 2) {
			$order_type_name = "Pesan Instan";
		}
		
		$shipment_id = $id;
				
		$isOwner = false;
		if ($user_id == $data[0]->created_by) {
			$isOwner = true;
		}
		
		$data = array(
			'title' => 'Kirim Barang',
			'page_title' => $data[0]->shipment_title,
			'type' => 'edit',
			'shipment_id' => $shipment_id,
			'shipment_user_id' => $data[0]->user_id,
			'user_id' => $user_id,
			'username' => $user_username,
			'role_id' => $user_role,
			'isOwner' => $isOwner,
			'expedition_id' => $data[0]->expedition_id,
			'shipment_owner_id' => $data[0]->created_by,
			'shipment_owner_username' => $data[0]->username,
			'created_date' => $data[0]->created_date,
			'modified_date' => $data[0]->modified_date,
			'shipment_title' => $data[0]->shipment_title,
			'order_type_name' => $order_type_name,
			'shipment_information' => $data[0]->shipment_information,
			'shipment_status' => $data[0]->shipment_status,
			'shipment_length' => $data[0]->shipment_length,
			'location_from_contact' => $data[0]->location_from_contact,
			'location_from_name' => $data[0]->location_from_name,
			'location_from_city' => $data[0]->location_from_city,
			'location_from_address' => $data[0]->location_from_address,
			'location_from_detail' => $data[0]->location_from_detail,
			'location_from_lat' => $data[0]->location_from_lat,
			'location_from_lng' => $data[0]->location_from_lng,
			'location_to_contact' => $data[0]->location_to_contact,
			'location_to_name' => $data[0]->location_to_name,
			'location_to_city' => $data[0]->location_to_city,
			'location_to_address' => $data[0]->location_to_address,
			'location_to_detail' => $data[0]->location_to_detail,
			'location_to_lat' => $data[0]->location_to_lat,
			'location_to_lng' => $data[0]->location_to_lng,
			'shipment_delivery_date_from' => $data[0]->shipment_delivery_date_from,
			'shipment_delivery_date_to' => $data[0]->shipment_delivery_date_to,
			'shipment_end_date' => $data[0]->shipment_end_date,
			'shipment_price' => $data[0]->shipment_price,
			'bidding_price' => $data[0]->bidding_price,
			'shipment_pictures' => ($data[0]->shipment_pictures == "") ? "default.gif" : $data[0]->shipment_pictures,
			'items' => $items
		);

		return $data;
	}

	public function getAllStatusKiriman() {
		parent::checkAjaxRequest();

		$shipment_id = $this->input->post("shipment_id");
		if ($shipment_id) {
			$result = $this->Kirim_model->getAllStatusKiriman($shipment_id)[0];
			if ($result->status == "success") {
				$result->pending_date = date_format(new DateTime($result->pending_date), "d-m-Y H:i");
				$result->confirmation_date = date_format(new DateTime($result->confirmation_date), "d-m-Y H:i");
				if ($result->bidding_type == 1) {
					$result->order_date = date_format(new DateTime($result->order_date), "d-m-Y H:i");
					$result->delivery_date = date_format(new DateTime($result->delivery_date), "d-m-Y H:i");
					$result->pickup_date = date_format(new DateTime($result->pickup_date), "d-m-Y H:i");
					$result->receive_date = date_format(new DateTime($result->receive_date), "d-m-Y H:i");
					$result->end_date = date_format(new DateTime($result->end_date), "d-m-Y H:i");
				} else {
					$result->door_start_date = date_format(new DateTime($result->door_start_date), "d-m-Y H:i");
					$result->port_start_date = date_format(new DateTime($result->port_start_date), "d-m-Y H:i");
					$result->port_finish_date = date_format(new DateTime($result->port_finish_date), "d-m-Y H:i");
					$result->door_finish_date = date_format(new DateTime($result->door_finish_date), "d-m-Y H:i");
					$result->ending_date = date_format(new DateTime($result->ending_date), "d-m-Y H:i");
				}
			}
			echo json_encode($result);
		}
	}

	public function getSavedLocation() {
		parent::__second_construct();

		$user_id = $this->session->userdata("user_id");
		$fromto = $this->input->post("fromto");
		$locations = $this->Kirim_model->getSavedLocation($user_id, $fromto);
		echo json_encode($locations);
	}

    public function doKirimBarang()
    {
        parent::__second_construct();
		$user_id = $this->session->userdata("user_id");
		$item_count = intval($this->input->post("detail-count", true));
		if ($item_count > 0) {
			$uploaded_file_name = "";
			$error_upload = false;
			if (!empty($_FILES["shipment_pictures"]["name"])) {
				$file_name = "image_" . $user_id . "_" . parent::random_str(6);
				parent::upload_file_settings('assets/panel/images/', '5000000', $file_name);
				if (!$this->upload->do_upload('shipment_pictures')) {
					$error_upload = true;
				} else {
					$uploaded_file_name = $this->upload->data("file_name");
				}
			}
			
			if (!$error_upload) {
				$shipment_length = $this->input->post('shipment_length');
				$location_from_latlng = $this->input->post('location_from_latlng');
				$location_from_lat = substr($location_from_latlng,0,strpos($location_from_latlng,",")-1);
				$location_from_lng = substr($location_from_latlng,strpos($location_from_latlng," ")+1);
				$location_to_latlng = $this->input->post('location_to_latlng');
				$location_to_lat = substr($location_to_latlng,0,strpos($location_to_latlng,",")-1);
				$location_to_lng = substr($location_to_latlng,strpos($location_to_latlng," ")+1);
				$ship_status = -1;
				
				$user_id = $this->session->userdata('user_id');

				$shipment_delivery_date_from = date_format(new DateTime($this->input->post('tanggal-kirim-awal')), "Y-m-d H:i:s");
				$shipment_delivery_date_to = date_format(new DateTime($this->input->post('tanggal-kirim-akhir')), "Y-m-d H:i:s");
				$shipment_end_date = date_format(new DateTime($this->input->post('tanggal-deadline')), "Y-m-d H:i:s");

				$shipment_type = $this->input->post("shipment_type");
				$data = array(
					'shipment_title' => $this->input->post('shipment_title'),
					'shipment_information' => $this->input->post('shipment_information'),
					'shipment_pictures' => $uploaded_file_name,
					'user_id' => $user_id,
					'shipment_length' => $shipment_length,
					'location_from_name' => $this->input->post('location_from_name'),
					'location_from_city' => $this->input->post('location_from_city'),
					'location_from_contact' => $this->input->post('location_from_contact'),
					'location_from_address' => $this->input->post('location_from_address'),
					'location_from_detail' => $this->input->post('location_from_detail'),
					'location_from_lat' => $location_from_lat,
					'location_from_lng' => $location_from_lng,
					'location_to_name' => $this->input->post('location_to_name'),
					'location_to_city' => $this->input->post('location_to_city'),
					'location_to_contact' => $this->input->post('location_to_contact'),
					'location_to_address' => $this->input->post('location_to_address'),
					'location_to_detail' => $this->input->post('location_to_detail'),
					'location_to_lat' => $location_to_lat,
					'location_to_lng' => $location_to_lng,
					'shipment_delivery_date_from' => $shipment_delivery_date_from,//date('Y-m-d G:i:s'),
					'shipment_delivery_date_to' => $shipment_delivery_date_to,
					'shipment_end_date' => $shipment_end_date,
					'shipment_price' => $this->input->post('shipment_price'),
					'shipment_status' => $ship_status,
					'shipment_type' => $this->input->post('shipment_type'),
					'user_id' => $user_id,
					'created_by' => $user_id,
					'modified_by' => $user_id
				);

				$this->insertData('m_shipment', $data);
				
				//Insert detail data
				$lastid = $this->db->insert_id();
				for ($i = 0; $i < $item_count; $i++) {
					$data = array(
						'item_name' => $this->input->post('item-name-' . $i),
						'item_desc' => $this->input->post('item-deskripsi-' . $i),
						'item_length' => $this->input->post('item-panjang-' . $i),
						'item_width' => $this->input->post('item-lebar-' . $i),
						'item_height' => $this->input->post('item-tinggi-' . $i),
						'item_dimension_unit' => $this->input->post('item-dimensi-satuan-' . $i),
						'item_kubikasi' => $this->input->post('item-kubikasi-' . $i),
						'item_kubikasi_unit' => $this->input->post('item-kubikasi-satuan-' . $i),
						'item_weight' => $this->input->post('item-berat-' . $i),
						'item_weight_unit' => $this->input->post('item-berat-satuan-' . $i),
						'item_qty' => $this->input->post('item-qty-' . $i),
						'shipment_id' => $lastid,
						'created_by' => $user_id,
						'modified_by' => $user_id
					);

					$this->insertData('m_shipment_details', $data);
				}
				
				if ($shipment_type == "1") {
					header("Location: " . base_url("kiriman-saya"));
				} else {
					header("Location: " . base_url("kiriman-saya-bisnis"));
				}
			} else {
				echo json_encode(array(
					"status" => "error",
					"error_message" => $this->upload->display_errors()
				));
			}
		}
    }
	
	public function setujuPenawaran() {
		parent::__second_construct();
		parent::checkAjaxRequest();

		$shipment_id = $this->input->post("shipment_id");
		$bidding_id = $this->input->post("bidding_id");
		$user_id = $this->session->userdata("user_id");
		
		if ($shipment_id != null && $bidding_id != null && $user_id != null) {
			$data = array(
				"shipment_id" => $shipment_id,
				"bidding_id" => $bidding_id,
				"user_id" => $user_id
			);
			$result = $this->Kirim_model->acceptBidding($data)[0];
			if ($result->status == "success") {
				if ($result->shipment_type == 1) {
					header("Location: " . base_url("kiriman-saya"));
				} else {
					header("Location: " . base_url("kiriman-saya-bisnis"));
				}
			}
			
		} else {
			header("Location: " . base_url("dashboard"));
		}
	}
	
	public function tolakPenawaran() {
		parent::__second_construct();
		parent::checkAjaxRequest();

		$submit_tolak = $this->input->post("submit_tolak");
		if ($submit_tolak != null) {
			$bidding_id = $this->input->post("bidding_id");
			$bidding_reason = $this->input->post("bidding_reason");
			
			$data = array(
				"bidding_id" => $bidding_id,
				"bidding_reason" => $bidding_reason
			);
			
			$affected_rows = $this->Kirim_model->rejectBidding($data);
			if ($affected_rows > 0) {
				echo "success";
			} else {
				echo "no rows affected. WHY??";
			}
			
		} else {
			header("Location: " . base_url("dashboard"));
		}
	}
	
	public function kirimPenawaran() {
		parent::__second_construct();
		parent::checkAjaxRequest();

		$submit_bid = $this->input->post("submit_bid");
		if ($submit_bid != null) {
			$bidding_type = $this->input->post("bidding_type");
			$bidding_price = $this->input->post("bidding_price");
			$bidding_pickupdate = $this->input->post("bidding_pickupdate");
			$bidding_pickupdate = date_format(new DateTime($bidding_pickupdate), "Y-m-d H:i:s");
			$bidding_information = $this->input->post("bidding_information");
			$shipment_id = $this->input->post("shipment_id");
			$user_id = $this->session->userdata("user_id");
			
			$data = array(
				"bidding_type" => $bidding_type,
				"bidding_price" => $bidding_price,
				"bidding_pickupdate" => $bidding_pickupdate,
				"bidding_information" => $bidding_information,
				"shipment_id" => $shipment_id,
				"user_id" => $user_id
			);
			
			$affected_rows = $this->Kirim_model->doBidding($data);
			if ($affected_rows > 0) {
				echo "success";
			} else {
				echo "no rows affected. WHY??";
			}
		} else {
			header("Location: " . base_url("dashboard"));
		}
	}
	
	public function jawabPertanyaan() {
		parent::__second_construct();
		parent::checkAjaxRequest();

		$submit_jawaban = $this->input->post("submit_jawaban");
		if ($submit_jawaban != null) {
			$questions_id = $this->input->post("questions_id");
			$answers_text = $this->input->post("answers_text");
			$user_id = $this->session->userdata("user_id");
			
			$insertData = array(
				"questions_id" => $questions_id,
				"answers_text" => $answers_text,
				"user_id" => $user_id
			);
			$affected_rows = $this->Kirim_model->insertAnswers($insertData);
			if ($affected_rows > 0) {
				echo "success";
			} else {
				echo "no rows affected. WHY??";
			}
		}
	}
	
	public function kirimPertanyaan() {
		parent::__second_construct();
		parent::checkAjaxRequest();

		$submit_pertanyaan = $this->input->post("submit_pertanyaan");
		if ($submit_pertanyaan != null) {
			$questions_text = $this->input->post("questions_text");
			$shipment_id = $this->input->post("shipment_id");
			$user_id = $this->session->userdata("user_id");
			
			$insertData = array(
				"questions_text" => $questions_text,
				"shipment_id" => $shipment_id,
				"user_id" => $user_id
			);
			
			$affected_rows = $this->Kirim_model->insertQuestions($insertData);
			if ($affected_rows > 0) {
				echo "success";
			} else {
				echo "no rows affected. WHY??";
			}
			
		} else {
			
		}
	}
}
