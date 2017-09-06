$(function() {
	getKiriman(kirimanUrl[1], 1, "deal");
	getKirimanCount();
	
	$(".tabs-item").on("click", function() {
		var tabsNumber = $(this).data("tabs-number");
		getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
	});
	
	$(document).on("click", ".btn-deal", function() {
		var trKiriman = $(this).closest(".tr-kiriman");
		var shipment_id = trKiriman.data("id");
		var shipment_title = trKiriman.data("shipment-title");
		var shipment_from = trKiriman.data("asal");
		var shipment_to = trKiriman.data("tujuan");
		var shipment_length = trKiriman.find(".td-km").html();
		
		$(".dialog-konfirmasi-deal-kiriman").data("id", shipment_id);
		$(".dialog-konfirmasi-deal-kiriman .dialog-body").html("Nama Kiriman : " + shipment_title + "<br>Asal : " + shipment_from + "<br>Tujuan : " + shipment_to + "<br>Jarak : " + shipment_length + " Km");
		showDialog(".dialog-konfirmasi-deal-kiriman");
	});

	$(document).on("click", ".btn-submit-deal-kiriman", function() {
		submitDeal();
	});

	$(document).on("change", ".select-jenis-muatan", function() {
		var value = $(this).val();
		var tr = $(this).closest(".tr-kiriman");
		var selectSupir = tr.find(".select-supir");
		var selectKendaraan = tr.find(".select-kendaraan");
		var selectAlat = tr.find(".select-alat");
		var elementSupir = "", elementKendaraan = "", elementAlat = "";
		var iLength = supir.length;
		var jLength = kendaraan.length;
		var kLength = alat.length;
		if (value == 0) {
			elementSupir += "<option value='0' data-shipment-ids=''>Pilih Supir... </option>";
			for (var i = 0; i < iLength; i++) {
				if (supir[i].status == 0 || (supir[i].status == 1 && supir[i].jenis_muatan == 0)) {
					var no_kirim = (supir[i].shipment_ids == "") ? "" : " (No. Kirim : " + supir[i].shipment_ids + ")";
					elementSupir += "<option value='" + supir[i].id + "' data-shipment-ids='" + supir[i].shipment_ids + "'>" + supir[i].name + no_kirim + " </option>";
				}
			}

			elementKendaraan += "<option value='0' data-shipment-ids=''>Pilih Kendaraan... </option>";
			for (var j = 0; j < jLength; j++) {
				if (kendaraan[j].status == 0 || (kendaraan[j].status == 1 && kendaraan[j].jenis_muatan == 0)) {
					var no_kirim = (kendaraan[j].shipment_ids == "") ? "" : " (No. Kirim : " + kendaraan[j].shipment_ids + ")";
					elementKendaraan += "<option value='" + kendaraan[j].id + "' data-shipment-ids='" + kendaraan[j].shipment_ids + "'>" + kendaraan[j].name + no_kirim + " </option>";
				}
			}

			elementAlat += "<option value='0' data-shipment-ids=''>Pilih Alat... </option>";
			for (var k = 0; k < kLength; k++) {
				if (alat[k].status == 0 || (alat[k].status == 1 && alat[k].jenis_muatan == 0)) {
					var no_kirim = (alat[k].shipment_ids == "") ? "" : " (No. Kirim : " + alat[k].shipment_ids + ")";
					elementAlat += "<option value='" + alat[k].id + "' data-shipment-ids='" + alat[k].shipment_ids + "'>" + alat[k].name + no_kirim + " </option>";
				}
			}
		} else {
			elementSupir += "<option value='0' data-shipment-ids=''>Pilih Supir... </option>";
			for (var i = 0; i < iLength; i++) {
				if (supir[i].status == 0) {
					elementSupir += "<option value='" + supir[i].id + "' data-shipment-ids=''>" + supir[i].name + " </option>";
				}
			}

			elementKendaraan += "<option value='0' data-shipment-ids=''>Pilih Kendaraan... </option>";
			for (var j = 0; j < jLength; j++) {
				if (kendaraan[j].status == 0) {
					elementKendaraan += "<option value='" + kendaraan[j].id + "' data-shipment-ids=''>" + kendaraan[j].name + " </option>";
				}
			}

			elementAlat += "<option value='0' data-shipment-ids=''>Pilih Alat... </option>";
			for (var k = 0; k < kLength; k++) {
				if (alat[k].status == 0) {
					elementAlat += "<option value='" + alat[k].id + "' data-shipment-ids=''>" + alat[k].name + " </option>";
				}
			}
		}
		selectSupir.html(elementSupir);
		selectKendaraan.html(elementKendaraan);
		selectAlat.html(elementAlat);
	});

	$(document).on("change", ".select-supir", function() {
		var tr = $(this).closest(".tr-kiriman");
		var shipment_ids = $(this).find(":selected").data("shipment-ids") + "";
		if (shipment_ids != "") {
			shipment_ids = shipment_ids.split(",");
			var shipment_id = shipment_ids[0];
			
			var kendaraan_shipment_ids = "";
			var kendaraan_found = false;
			for (var i = 0; i < kendaraan.length; i++) {
				kendaraan_shipment_ids = kendaraan[i].shipment_ids;
				if (kendaraan_shipment_ids != "") {
					if (kendaraan_shipment_ids.indexOf(shipment_id) != -1) {
						tr.find(".select-kendaraan").val(kendaraan[i].id);
						kendaraan_found = true;
						break;
					}
				}
			}
			if (!kendaraan_found) {
				tr.find(".select-kendaraan").val(0);
			}
			
			var alat_shipment_ids = "";
			var alat_found = false;
			for (var i = 0; i < alat.length; i++) {
				alat_shipment_ids = alat[i].shipment_ids;
				if (alat_shipment_ids != "") {
					if (alat_shipment_ids.indexOf(shipment_id) != -1) {
						tr.find(".select-alat").val(alat[i].id);
						alat_found = true;
						break;
					}
				}
			}
			if (!alat_found) {
				tr.find(".select-alat").val(0);
			}
		} else {
			if (tr.find(".select-jenis-muatan").val() == 0) {
				var selectKendaraan = tr.find(".select-kendaraan");
				var selectedKendaraanShipmentIds = selectKendaraan.find(":selected").data("shipment-ids");
				if (selectedKendaraanShipmentIds != "") {
					selectKendaraan.val(0);
				}

				var selectAlat = tr.find(".select-alat");
				var selectedAlatShipmentIds = selectAlat.find(":selected").data("shipment-ids");
				if (selectedAlatShipmentIds != "") {
					selectAlat.val(0);
				}
			}
		}
	});

	$(document).on("change", ".select-kendaraan", function() {
		var tr = $(this).closest(".tr-kiriman");
		var shipment_ids = $(this).find(":selected").data("shipment-ids") + "";
		if (shipment_ids != "") {
			shipment_ids = shipment_ids.split(",");
			var shipment_id = shipment_ids[0];
			
			var supir_shipment_ids = "";
			var supir_found = false;
			for (var i = 0; i < supir.length; i++) {
				supir_shipment_ids = supir[i].shipment_ids;
				if (supir_shipment_ids != "") {
					if (supir_shipment_ids.indexOf(shipment_id) != -1) {
						tr.find(".select-supir").val(supir[i].id);
						supir_found = true;
						break;
					}
				}
			}
			if (!supir_found) {
				tr.find(".select-supir").val(0);
			}
			
			var alat_shipment_ids = "";
			var alat_found = false;
			for (var i = 0; i < alat.length; i++) {
				alat_shipment_ids = alat[i].shipment_ids;
				if (alat_shipment_ids != "") {
					if (alat_shipment_ids.indexOf(shipment_id) != -1) {
						tr.find(".select-alat").val(alat[i].id);
						alat_found = true;
						break;
					}
				}
			}
			if (!alat_found) {
				tr.find(".select-alat").val(0);
			}
		} else {
			if (tr.find(".select-jenis-muatan").val() == 0) {
				var selectSupir = tr.find(".select-supir");
				var selectedSupirShipmentIds = selectSupir.find(":selected").data("shipment-ids");
				if (selectedSupirShipmentIds != "") {
					selectSupir.val(0);
				}

				var selectAlat = tr.find(".select-alat");
				var selectedAlatShipmentIds = selectAlat.find(":selected").data("shipment-ids");
				if (selectedAlatShipmentIds != "") {
					selectAlat.val(0);
				}
			}
		}
	});

	$(document).on("change", ".select-alat", function() {
		var tr = $(this).closest(".tr-kiriman");
		var shipment_ids = $(this).find(":selected").data("shipment-ids") + "";
		if (shipment_ids != "") {
			shipment_ids = shipment_ids.split(",");
			var shipment_id = shipment_ids[0];

			var supir_shipment_ids = "";
			var supir_found = false;
			for (var i = 0; i < supir.length; i++) {
				supir_shipment_ids = supir[i].shipment_ids;
				if (supir_shipment_ids != "") {
					if (supir_shipment_ids.indexOf(shipment_id) != -1) {
						tr.find(".select-supir").val(supir[i].id);
						supir_found = true;
						break;
					}
				}
			}
			if (!supir_found) {
				tr.find(".select-supir").val(0);
			}
			
			var kendaraan_shipment_ids = "";
			var kendaraan_found = false;
			for (var i = 0; i < kendaraan.length; i++) {
				kendaraan_shipment_ids = kendaraan[i].shipment_ids;
				if (kendaraan_shipment_ids != "") {
					if (kendaraan_shipment_ids.indexOf(shipment_id) != -1) {
						tr.find(".select-kendaraan").val(kendaraan[i].id);
						kendaraan_found = true;
						break;
					}
				}
			}
			if (!kendaraan_found) {
				tr.find(".select-kendaraan").val(0);
			}
		} else {
			if (tr.find(".select-jenis-muatan").val() == 0) {
				var selectSupir = tr.find(".select-supir");
				var selectedSupirShipmentIds = selectSupir.find(":selected").data("shipment-ids");
				if (selectedSupirShipmentIds != "") {
					selectSupir.val(0);
				}

				var selectKendaraan = tr.find(".select-kendaraan");
				var selectedKendaraanShipmentIds = selectKendaraan.find(":selected").data("shipment-ids");
				if (selectedKendaraanShipmentIds != "") {
					selectKendaraan.val(0);
				}
			}
		}
	});
	
	$(document).on("click", ".btn-pesan", function() {
		var trKiriman = $(this).closest(".tr-kiriman");
		var shipment_id = trKiriman.data("id");
		var shipment_title = trKiriman.data("shipment-title");
		var shipment_from = trKiriman.data("asal");
		var shipment_to = trKiriman.data("tujuan");
		var shipment_length = trKiriman.find(".td-km").html();
		var jenis_muatan = trKiriman.find(".select-jenis-muatan").val();
		var jenis_muatan_text = trKiriman.find(".select-jenis-muatan option:selected").text();
		var driver_id = trKiriman.find(".select-supir").val();
		var driver_id_text = (driver_id == 0) ? "" : trKiriman.find(".select-supir option:selected").text();
		var vehicle_id = trKiriman.find(".select-kendaraan").val();
		var vehicle_id_text = (vehicle_id == 0) ? "" : trKiriman.find(".select-kendaraan option:selected").text();
		var device_id = trKiriman.find(".select-alat").val();
		var device_id_text = (device_id == 0) ? "" : trKiriman.find(".select-alat option:selected").text();

		$(".dialog-konfirmasi-pesan-kiriman").data("id", shipment_id);
		$(".dialog-konfirmasi-pesan-kiriman").data("jenis_muatan", jenis_muatan);
		$(".dialog-konfirmasi-pesan-kiriman").data("driver_id", driver_id);
		$(".dialog-konfirmasi-pesan-kiriman").data("vehicle_id", vehicle_id);
		$(".dialog-konfirmasi-pesan-kiriman").data("device_id", device_id);

		$(".dialog-konfirmasi-pesan-kiriman .dialog-body").html("Nama Kiriman : " + shipment_title + "<br>Asal : " + shipment_from + "<br>Tujuan : " + shipment_to + "<br>Jarak : " + shipment_length + " Km<br>Jenis Muatan : " + jenis_muatan_text + "<br>Supir : " + driver_id_text + "<br>Kendaraan : " + vehicle_id_text + "<br>Alat : " + device_id_text);
		showDialog(".dialog-konfirmasi-pesan-kiriman");
	});

	$(document).on("click", ".btn-submit-pesan-kiriman", function() {
		submitPesan();
	});
	
	$(document).on("click", ".btn-dikirim", function() {
		var trKiriman = $(this).closest(".tr-kiriman");
		var shipment_id = trKiriman.data("id");
		var shipment_title = trKiriman.data("shipment-title");
		var shipment_from = trKiriman.data("asal");
		var shipment_to = trKiriman.data("tujuan");
		var shipment_length = trKiriman.find(".td-km").html();
		var jenis_muatan = trKiriman.find(".td-jenis-muatan").html();
		var driver_name = trKiriman.find(".td-supir").html();
		var vehicle_name = trKiriman.find(".td-kendaraan").html();
		var device_name = trKiriman.find(".td-alat").html();

		$(".dialog-konfirmasi-kirim-kiriman").data("id", shipment_id);
		$(".dialog-konfirmasi-kirim-kiriman .dialog-body").html("Nama Kiriman : " + shipment_title + "<br>Asal : " + shipment_from + "<br>Tujuan : " + shipment_to + "<br>Jarak : " + shipment_length + " Km<br>Jenis Muatan : " + jenis_muatan + "<br>Supir : " + driver_name + "<br>Kendaraan : " + vehicle_name + "<br>Alat : " + device_name);
		showDialog(".dialog-konfirmasi-kirim-kiriman");
	});

	$(document).on("click", ".btn-submit-kirim-kiriman", function() {
		submitKirim();
	});
	
	$(document).on("click", ".btn-diambil", function() {
		var trKiriman = $(this).closest(".tr-kiriman");
		var shipment_id = trKiriman.data("id");
		var shipment_title = trKiriman.data("shipment-title");
		var shipment_from = trKiriman.data("asal");
		var shipment_to = trKiriman.data("tujuan");
		var shipment_length = trKiriman.find(".td-km").html();
		var jenis_muatan = trKiriman.find(".td-jenis-muatan").html();
		var driver_name = trKiriman.find(".td-supir").html();
		var vehicle_name = trKiriman.find(".td-kendaraan").html();
		var device_name = trKiriman.find(".td-alat").html();

		$(".dialog-konfirmasi-ambil-kiriman").data("id", shipment_id);
		$(".dialog-konfirmasi-ambil-kiriman .dialog-body").html("Nama Kiriman : " + shipment_title + "<br>Asal : " + shipment_from + "<br>Tujuan : " + shipment_to + "<br>Jarak : " + shipment_length + " Km<br>Jenis Muatan : " + jenis_muatan + "<br>Supir : " + driver_name + "<br>Kendaraan : " + vehicle_name + "<br>Alat : " + device_name);
		showDialog(".dialog-konfirmasi-ambil-kiriman");
	});

	$(document).on("click", ".btn-submit-ambil-kiriman", function() {
		submitAmbil();
	});
	
	$(document).on("click", ".btn-diterima", function() {
		var trKiriman = $(this).closest(".tr-kiriman");
		var shipment_id = trKiriman.data("id");
		var shipment_title = trKiriman.data("shipment-title");
		var shipment_from = trKiriman.data("asal");
		var shipment_to = trKiriman.data("tujuan");
		var shipment_length = trKiriman.find(".td-km").html();
		var jenis_muatan = trKiriman.find(".td-jenis-muatan").html();
		var driver_name = trKiriman.find(".td-supir").html();
		var vehicle_name = trKiriman.find(".td-kendaraan").html();
		var device_name = trKiriman.find(".td-alat").html();

		$(".dialog-konfirmasi-terima-kiriman").data("id", shipment_id);
		$(".dialog-konfirmasi-terima-kiriman .dialog-body").html("Nama Kiriman : " + shipment_title + "<br>Asal : " + shipment_from + "<br>Tujuan : " + shipment_to + "<br>Jarak : " + shipment_length + " Km<br>Jenis Muatan : " + jenis_muatan + "<br>Supir : " + driver_name + "<br>Kendaraan : " + vehicle_name + "<br>Alat : " + device_name);
		showDialog(".dialog-konfirmasi-terima-kiriman");
	});

	$(document).on("click", ".btn-submit-terima-kiriman", function() {
		submitTerima();
	});
	
	$(document).on("click", ".btn-batal-pengiriman", function() {
		var shipment_id = $(this).closest(".tr-kiriman").data("id");
		var shipment_title = $(this).closest(".tr-kiriman").data("shipment-title");
		
		$(".dialog-konfirmasi-cancel-transaction").data("shipment_id", shipment_id);
		$(".dialog-konfirmasi-cancel-transaction .dialog-body").html("Batalkan kiriman " + shipment_title + "?");
		showDialog(".dialog-konfirmasi-cancel-transaction");
	});
	
	$(".btn-submit-cancel-transaction").on("click", function() {
		cancelShipment();
	});

	$(document).on("click", ".tabs-content:not([data-tabs-number='7']):not([data-tabs-number='8']) .btn-view-kontak", function() {
		var tr = $(this).closest(".tr-kiriman");
		var detailElement = $(tr).next();
		if ($(detailElement).height() == 0) {
			$(detailElement).addClass("show");
			if ($(detailElement).find(".row-detail-td-content").html().trim() == "") {
				getDetailPengirim(tr);
			}
		} else {
			$(detailElement).removeClass("show");
		}
	});

	$(document).on("click", ".tabs-content[data-tabs-number='7'] .btn-view-kontak", function() {
		var tr = $(this).closest(".tr-kiriman");
		var detailElement = $(tr).next();
		if (detailElement.height() == 0) {
			detailElement.addClass("show");
			if (detailElement.find(".row-detail-td-content").html().trim() == "") {
				getAllStatusKiriman(tr, detailElement);
			}
		} else {
			detailElement.removeClass("show");
		}
	});
});

function getAllStatusKiriman(tr, element) {
	var shipment_id = $(tr).data("id");
	ajaxCall(getAllStatusKirimanUrl, {shipment_id: shipment_id}, function(json) {
		var result = JSON.parse(json);
		if (result.status == "success") {
			var status_0 = result.pending_date;
			var status_1 = result.confirmation_date;
			var status_2, status_2_name, status_3, status_3_name, status_4, status_4_name, status_5, status_5_name;
			status_2 = result.order_date;
			status_2_name = "Pesanan";
			status_3 = result.delivery_date;
			status_3_name = "Dikirim";
			status_4 = result.pickup_date;
			status_4_name = "Diambil";
			status_5 = result.receive_date;
			status_5_name = "Diterima";
			var status_6 = result.end_date;

			var content = "";
			content += "<div class='detail-status'>";
			content += "<div class='detail-status-title'>Status</div>";
			content += "<div class='status-item'><span class='status-badge' data-status='0'>Pending</span><span class='status-time'>" + status_0 + "</span></div>";
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='1'>Konfirmasi</span><span class='status-time'>" + status_1 + "</span></div>";
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='2'>" + status_2_name + "</span><span class='status-time'>" + status_2 + "</span></div>";
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='3'>" + status_3_name + "</span><span class='status-time'>" + status_3 + "</span></div>";
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='4'>" + status_4_name + "</span><span class='status-time'>" + status_4 + "</span></div>";
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='5'>" + status_5_name + "</span><span class='status-time'>" + status_5 + "</span></div>";
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='6'>Selesai</span><span class='status-time'>" + status_6 + "</span></div>";
			content += "</div>";
			$(element).find(".row-detail-td-content").html(content);
		}
	});
}

function getDetailPengirim(element) {
	var shipment_id = $(element).data("id");
	
	ajaxCall(getDetailPengirimUrl, {shipment_id: shipment_id}, function(json) {
		
		var result = jQuery.parseJSON(json);
		var content = "";
		content += "<div class='detail-col'>";
		content += "<div class='detail-title'>Info Pemilik Barang</div>";
		content += "<div class='detail-row'><span class='detail-label'>Nama</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["user_fullname"] + "</span></div>";
		content += "<div class='detail-row'><span class='detail-label'>Alamat</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["user_address"] + "</span></div>";
		content += "<div class='detail-row'><span class='detail-label'>Telepon</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["user_telephone"] + "</span></div>";
		content += "<div class='detail-row'><span class='detail-label'>Handphone</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["user_handphone"] + "</span></div>";
		content += "</div>";

		var status_0 = result["pending_date"];
		var status_1 = result["confirmation_date"];
		var status_2, status_2_name, status_3, status_3_name, status_4, status_4_name, status_5, status_5_name;

		status_2 = result["order_date"];
		status_2_name = "Pesanan";
		status_3 = result["delivery_date"];
		status_3_name = "Dikirim";
		status_4 = result["pickup_date"];
		status_4_name = "Diambil";
		status_5 = result["receive_date"];
		status_5_name = "Diterima";

		var jenis_muatan = (result["shipment_jenis_muatan"] == 1) ? "Penuh" : "Parsial";

		if (result["shipment_status"] > 1) {
			content += "<div class='detail-col'>";
			content += "<div class='detail-title'>Detail Kiriman</div>";
			content += "<div class='detail-row'><span class='detail-label'>Jenis Muatan</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + jenis_muatan + "</span></div>";
			content += "<div class='detail-row'><span class='detail-label'>Supir</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["driver_name"] + "</span></div>";
			content += "<div class='detail-row'><span class='detail-label'>Kendaraan</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["vehicle_name"] + "</span></div>";
			content += "<div class='detail-row'><span class='detail-label'>Lacak</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["device_name"] + "</span></div>";
			content += "</div>";
		}
		
		content += "<div class='detail-status'>";
		content += "<div class='detail-status-title'>Status</div>";
		content += "<div class='status-item'><span class='status-badge' data-status='0'>Pending</span><span class='status-time'>" + status_0 + "</span></div>";
		if (result["shipment_status"] >= 1) {
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='1'>Konfirmasi</span><span class='status-time'>" + status_1 + "</span></div>";
		}
		if (result["shipment_status"] >= 2) {
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='2'>" + status_2_name + "</span><span class='status-time'>" + status_2 + "</span></div>";
		}
		if (result["shipment_status"] >= 3) {
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='3'>" + status_3_name + "</span><span class='status-time'>" + status_3 + "</span></div>";
		}
		if (result["shipment_status"] >= 4) {
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='4'>" + status_4_name + "</span><span class='status-time'>" + status_4 + "</span></div>";
		}
		if (result["shipment_status"] >= 5) {
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='5'>" + status_5_name + "</span><span class='status-time'>" + status_5 + "</span></div>";
		}
		content += "</div>";
		
		$(element).next().find(".row-detail-td-content").html(content);
	});
}

function cancelShipment() {
	showFullscreenLoading();
	var shipment_id = $(".dialog-konfirmasi-cancel-transaction").data("shipment_id");
	ajaxCall(cancelShipmentUrl, {shipment_id: shipment_id}, function(result) {
		hideFullscreenLoading();
		if (result == "success") {
			closeDialog();
			refreshData();
		}
	});
}

function getKendaraan() {
	ajaxCall(getKendaraanUrl, null, function(json) {
		var result = jQuery.parseJSON(json);
			
		var element = "";
		var iLength = result.length;
		kendaraan = [];
		element += "<option value='0'>Pilih Kendaraan... </option>";
		for (var i = 0; i < iLength; i++) {
			kendaraan.push({
				id: result[i].vehicle_id,
				name: result[i].vehicle_name,
				status: result[i].vehicle_details_status,
				jenis_muatan: result[i].shipment_jenis_muatan,
				shipment_ids: result[i].shipment_ids
			});
			if (result[i].vehicle_details_status == 0) {
				element += "<option value='" + result[i].vehicle_id + "' data-shipment-ids=''>" + result[i].vehicle_name + " </option>";
			}
		}
		$(".select-kendaraan").append(element);
	});
}

function getSupir() {
	ajaxCall(getSupirUrl, null, function(json) {
		var result = jQuery.parseJSON(json);
			
		var element = "";
		var iLength = result.length;
		supir = [];
		element += "<option value='0'>Pilih Supir... </option>";
		for (var i = 0; i < iLength; i++) {
			supir.push({
				id: result[i].driver_id,
				name: result[i].driver_name,
				status: result[i].driver_details_status,
				jenis_muatan: result[i].shipment_jenis_muatan,
				shipment_ids: result[i].shipment_ids
			});
			if (result[i].driver_details_status == 0) {
				element += "<option value='" + result[i].driver_id + "' data-shipment-ids=''>" + result[i].driver_name + " </option>";
			}
		}
		$(".select-supir").append(element);
	});
}

function getAlat() {
	ajaxCall(getAlatUrl, null, function(json) {
		var result = jQuery.parseJSON(json);
			
		var element = "";
		var iLength = result.length;
		alat = [];
		element += "<option value='0'>Pilih Alat... </option>";
		for (var i = 0; i < iLength; i++) {
			alat.push({
				id: result[i].device_id,
				name: result[i].device_name,
				status: result[i].device_details_status,
				jenis_muatan: result[i].shipment_jenis_muatan,
				shipment_ids: result[i].shipment_ids
			});
			if (result[i].device_details_status == 0) {
				element += "<option value='" + result[i].device_id + "' data-shipment-ids=''>" + result[i].device_name + " </option>";
			}
		}
		$(".select-alat").append(element);
	});
}

function submitTerima() {
	showFullscreenLoading();
	var shipment_id = $(".dialog-konfirmasi-terima-kiriman").data("id");
	var data = {
		shipment_id: shipment_id
	};
	ajaxCall(submitTerimaUrl, data, function(result) {
		closeDialog();
		hideFullscreenLoading();
		if (result == "success") {
			refreshData();
		} else {
			console.log(result);
		}
	});
}

function submitAmbil() {
	showFullscreenLoading();
	var shipment_id = $(".dialog-konfirmasi-ambil-kiriman").data("id");
	var data = {
		shipment_id: shipment_id
	};
	ajaxCall(submitAmbilUrl, data, function(result) {
		closeDialog();
		hideFullscreenLoading();
		if (result == "success") {
			refreshData();
		} else {
			console.log(result);
		}
	});
}

function submitKirim() {
	showFullscreenLoading();
	var shipment_id = $(".dialog-konfirmasi-kirim-kiriman").data("id");
	var data = {
		shipment_id: shipment_id
	};
	ajaxCall(submitKirimUrl, data, function(result) {
		closeDialog();
		hideFullscreenLoading();
		if (result == "success") {
			refreshData();
		} else {
			console.log(result);
		}
	});
}

function submitPesan() {
	var shipment_id = $(".dialog-konfirmasi-pesan-kiriman").data("id");
	var jenis_muatan =$(".dialog-konfirmasi-pesan-kiriman").data("jenis_muatan");
	var driver_id = $(".dialog-konfirmasi-pesan-kiriman").data("driver_id");
	var vehicle_id = $(".dialog-konfirmasi-pesan-kiriman").data("vehicle_id");
	var device_id =$(".dialog-konfirmasi-pesan-kiriman").data("device_id");
	
	if (driver_id == 0 || driver_id == "") {
		alert("tidak ada supir yang dipilih");
	} else if (vehicle_id == 0 || vehicle_id == "") {
		alert("tidak ada kendaraan yang dipilih");
	} else {
		showFullscreenLoading();
		var data = {
			shipment_id: shipment_id,
			jenis_muatan: jenis_muatan,
			driver_id: driver_id,
			vehicle_id: vehicle_id,
			device_id: device_id
		};
		ajaxCall(submitPesanUrl, data, function(result) {
			closeDialog();
			hideFullscreenLoading();
			if (result == "success") {
				refreshData();
			} else {
				console.log(result);
			}
		});
	}
}

function submitDeal() {
	showFullscreenLoading();
	var shipment_id = $(".dialog-konfirmasi-deal-kiriman").data("id");
	var data = {
		shipment_id: shipment_id
	};
	ajaxCall(submitDealUrl, data, function(result) {
		closeDialog();
		hideFullscreenLoading();
		if (result == "success") {
			refreshData();
		} else {
			console.log(result);
		}
	});
}

function refreshData() {
	var tabsNumber = $(".tabs-item.active").data("tabs-number");
	getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
	getKirimanCount();
}

function getKirimanCount() {
	ajaxCall(getKirimanCountUrl, null, function(json) {
		var result = jQuery.parseJSON(json);
		assignKirimanCount(result);
	});
}

function assignKirimanCount(result) {
	var tabs = {
		t1: 0,
		t2: 0,
		t3: 0,
		t4: 0,
		t5: 0,
		t6: 0,
		t7: 0,
		t8: 0
	};
	
	for (var i = 0; i < result.length; i++) {
		switch (result[i].shipment_status) {
			case "0":
				tabs.t1 = result[i].count;
				break;
			case "1":
				tabs.t2 = result[i].count;
				break;
			case "2":
				tabs.t3 = result[i].count;
				break;
			case "3":
				tabs.t4 = result[i].count;
				break;
			case "4":
				tabs.t5 = result[i].count;
				break;
			case "5":
				tabs.t6 = result[i].count;
				break;
			case "6":
				tabs.t7 = result[i].count;
				break;
			case "7":
				tabs.t8 = result[i].count;
				break;
		}
	}
	
	for (var i = 1; i <= 8; i++) {
		updateTabsItemCount(i, tabs["t" + i]);
	}
}

function getKiriman(url, tabsNumber, tabs) {
	abortAjaxCall();
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").html("");
	setLoading(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state");
	ajaxCall(url, null, function(json) {
		removeLoading();
		var result = jQuery.parseJSON(json);
		addKirimanToTable(result, tabsNumber, tabs);
	});
}

function addKirimanToTable(result, tabsNumber, tab) {
	var iLength = result.length;
	var element = {
		"deal": {
			value: "",
			btn: "<td><button class='btn-default btn-deal'>Konfirmasi</button><button class='btn-negative btn-batal-pengiriman'>Tolak</button></td>"
		},
		"pending": {
			value: "",
			btn: "<td><button class='btn-default btn-pesan'>Pesan</button><button class='btn-negative btn-batal-pengiriman'>Batalkan</button></td>"
		},
		"pesanan": {
			value: "",
			btn: "<td><button class='btn-default btn-dikirim'>Dikirim</button><button class='btn-negative btn-batal-pengiriman'>Batalkan</button></td>"
		},
		"dikirim": {
			value: "",
			btn: "<td><button class='btn-default btn-diambil'>Diambil</button><button class='btn-negative btn-batal-pengiriman'>Batalkan</button></td>"
		},
		"diambil": {
			value: "",
			btn: "<td><button class='btn-default btn-diterima'>Diterima</button></td>"
		},
		"diterima": {
			value: "",
			btn: "",
		},
		"selesai": {
			value: "",
			btn: ""
		},
		"cancel": {
			value: "",
			btn: ""
		}
	};
	
	for (var i = 0; i < iLength; i++) {
		
		var date_from = new Date(result[i].shipment_delivery_date_from);
		var fullDateFrom = date_from.getDate() + " " + month[date_from.getMonth()] + " " + date_from.getFullYear().toString().substring(2);
		var date_to = new Date(result[i].shipment_delivery_date_to);
		var fullDateTo = date_to.getDate() + " " + month[date_to.getMonth()] + " " + date_to.getFullYear().toString().substring(2);
		
		var shipment_picture = (result[i].shipment_pictures == "") ? "default.gif" : result[i].shipment_pictures;
		var jenis_muatan = "Penuh";
		if (result[i].shipment_jenis_muatan == 0) {
			jenis_muatan = "Parsial";
		}
		
		var btnViewKontak = "<button class='btn-default btn-view-kontak'>Info Kiriman</button>";
		var tdJenisMuatan = "<td class='td-jenis-muatan'>" + jenis_muatan + "</td>";
		var additionalTd = "";
		var tdCancelBy = "";
		var waktu = "";
		switch (tab) {
			case "deal":
				btnViewKontak = "";
				tdJenisMuatan = "";
				break;
			case "pending":
				tdJenisMuatan = "<td><select class='select-jenis-muatan'><option value='1'>Penuh</option><option value='0'>Parsial</option></select></td>";
				additionalTd = "<td><div class='td-detail-div'><select class='select-supir'></select></div><div class='td-detail-div'><select class='select-kendaraan'></select></div><div class='td-detail-div'><select class='select-alat'></select></div></td>";
				break;
			case "pesanan":
				additionalTd = "<td class='td-supir'>" + result[i].driver_names + "</td><td class='td-kendaraan'>" + result[i].vehicle_names + "</td><td class='td-alat'>" + result[i].device_names + "</td>";
				break;
			case "dikirim":
				additionalTd = "<td class='td-supir'>" + result[i].driver_names + "</td><td class='td-kendaraan'>" + result[i].vehicle_names + "</td><td class='td-alat'>" + result[i].device_names + "</td>";
				break;
			case "diambil":
				additionalTd = "<td class='td-supir'>" + result[i].driver_names + "</td><td class='td-kendaraan'>" + result[i].vehicle_names + "</td><td class='td-alat'>" + result[i].device_names + "</td>";
				break;
			case "diterima":
				additionalTd = "<td class='td-supir'>" + result[i].driver_names + "</td><td class='td-kendaraan'>" + result[i].vehicle_names + "</td><td class='td-alat'>" + result[i].device_names + "</td>";
				break;
			case "selesai":
				additionalTd = "<td class='td-supir'>" + result[i].driver_names + "</td><td class='td-kendaraan'>" + result[i].vehicle_names + "</td><td class='td-alat'>" + result[i].device_names + "</td>";
				waktu = "<td data-align='center'>" + result[i].waktu_kiriman + " hari</td><td data-align='center'>" + result[i].total_waktu + " hari</td>";
				break;
			case "cancel":
				btnViewKontak = "";
				tdJenisMuatan = "";
				var icon = (result[i].user_verified == 0) ? "" : "<span class='verified-icon' style='background-image: url(" + verifiedIconUrl + ");'><div></div></span>";
				tdCancelBy = "<td class='td-cancel_by'><a href='" + profilUrl + result[i].cancel_by + "'>" + result[i].cancel_username + icon + "</a></td>";
				break;
		}
		
		element[tab].value += "<tr class='tr-kiriman' data-id='" + result[i].shipment_id + "' data-shipment-title='" + result[i].shipment_title + "' data-asal='" + result[i].location_from_city + "' data-tujuan='" + result[i].location_to_city + "'><td class='td-title' data-col='nama-kirim'><a href='" + shipmentUrl + result[i].shipment_id + "'>" + "<img class='shipment-picture' src='" + shipmentPictureUrl + shipment_picture + "' onerror='this.onerror=null; this.src=\"" + defaultPictureUrl + "\";' /><span>" + result[i].shipment_title + "</span></a></td><td class='td-price' data-col='harga'>Bid : " + result[i].bidding_count + "<br>Low : " + addCommas(result[i].low) + " IDR" + btnViewKontak + "</td><td class='td-asal' data-col='asal'>" + result[i].location_from_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan' data-col='tujuan'>" + result[i].location_to_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km' data-align='center' data-col='km'>" + parseInt(result[i].shipment_length) + "</td>" + tdJenisMuatan + tdCancelBy + additionalTd + element[tab].btn + waktu + "</tr>";

		element[tab].value += "<tr class='row-detail-tr'><td class='row-detail-td' colspan='20'><div class='row-detail-td-content'></div></td></tr>";
	}
	
	if (iLength == 0) {
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").addClass("shown");
	} else {
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").removeClass("shown");
	}
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").html("");
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").append(element[tab].value);
	
	if (tab == "pending" && iLength > 0) {
		getAlat();
		getSupir();
		getKendaraan();
	}
}