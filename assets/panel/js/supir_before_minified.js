$(function() {
	getSupir();
	
	$(".btn-tambah").on("click", function() {
		clearErrors();
		showDialog(".dialog-tambah");
		$(".dialog-tambah .input-nama").select();
	});
	
	$(".btn-submit-tambah").on("click", function() {
		tambahSupir();
	});
	
	$(".input-hp").on("keydown", function(e) {
		isNumber(e);
	});
	
	$(document).on("click", ".btn-edit", function() {
		clearErrors();
		editSupir(this);
	});
	
	$(".btn-submit-edit").on("click", function() {
		updateSupir();
	});
	
	$(document).on("click", ".btn-delete", function() {
		var namaSupir = $(this).closest(".tr-supir").children(".td-name").html();
		var driver_id = $(this).closest(".tr-supir").data("id");
		$(".dialog-konfirmasi-delete").data("id", driver_id);
		$(".dialog-konfirmasi-delete .dialog-body").html("Delete " + namaSupir + "?");
		showDialog(".dialog-konfirmasi-delete");
	});
	
	$(".btn-submit-delete").on("click", function() {
		deleteSupir(this);
	});
});

function deleteSupir(element) {
	showFullscreenLoading();
	var driver_id = $(".dialog-konfirmasi-delete").data("id");
	var data = {
		submit_delete: true,
		driver_id: driver_id
	};
	ajaxCall(deleteSupirUrl, data, function(json) {
		hideFullscreenLoading();
		closeDialog();
		var result = JSON.parse(json);
		if (result.status == "success") {
			getSupir();
		} else {
			alert("terjadi kesalahan");
		}
	});
}

function clearErrors() {
	$(".error").html("");
}

function cekInputError(driver_name, driver_address, driver_handphone) {
	clearErrors();
	var valid = true;
	if (driver_name == "") {
		valid = false;
		$(".input-nama").next().html("Nama supir harus diisi");
	}
	if (driver_address == "") {
		valid = false;
		$(".input-alamat").next().html("Alamat supir harus diisi");
	}
	if (driver_handphone == "") {
		valid = false;
		$(".input-hp").next().html("No. HP supir harus diisi");
	}
	return valid;
}

function editSupir(element) {
	var id = $(element).data("id");
	var trSupir = $(element).closest(".tr-supir");
	var driver_name = trSupir.find(".td-name").html();
	var driver_address = trSupir.find(".td-address").html();
	var driver_handphone = trSupir.find(".td-handphone").html();
	var driver_information = trSupir.find(".td-information").html();
	var driver_status = trSupir.data("status");
	
	$(".dialog-edit").data("id", id);
	$(".dialog-edit .input-nama").val(driver_name);
	$(".dialog-edit .input-alamat").val(driver_address);
	$(".dialog-edit .input-hp").val(driver_handphone);
	$(".dialog-edit .input-keterangan").val(driver_information);
	$(".dialog-edit .input-status").val(driver_status);
	
	showDialog(".dialog-edit");
}

function updateSupir() {
	var driver_id = $(".dialog-edit").data("id");
	var driver_name = $(".dialog-edit .input-nama").val().trim();
	var driver_handphone = $(".dialog-edit .input-hp").val().trim();
	var driver_address = $(".dialog-edit .input-alamat").val().trim();
	var driver_information = $(".dialog-edit .input-keterangan").val().trim();
	var driver_status = $(".dialog-edit .input-status").val();
	
	var valid = cekInputError(driver_name, driver_address, driver_handphone);
	if (valid) {
		showFullscreenLoading();
		var data = {
			submit_update: true,
			driver_id: driver_id,
			driver_name: driver_name,
			driver_handphone: driver_handphone,
			driver_address: driver_address,
			driver_information: driver_information,
			driver_status: driver_status
		};
		ajaxCall(updateSupirUrl, data, function(json) {
			hideFullscreenLoading();
			closeDialog();
			var result = JSON.parse(json);
			if (result.status == "success") {
				getSupir();
			} else {
				alert("terjadi kesalahan");
			}
		});
	}
}

function tambahSupir() {
	var driver_name = $(".dialog-tambah .input-nama").val().trim();
	var driver_handphone = $(".dialog-tambah .input-hp").val().trim();
	var driver_address = $(".dialog-tambah .input-alamat").val().trim();
	var driver_information = $(".dialog-tambah .input-keterangan").val().trim();
	var driver_status = $(".dialog-tambah .input-status").val();
	
	var valid = cekInputError(driver_name, driver_address, driver_handphone);
	if (valid) {
		showFullscreenLoading();
		var data = {
			submit_tambah: true,
			driver_name: driver_name,
			driver_handphone: driver_handphone,
			driver_address: driver_address,
			driver_information: driver_information,
			driver_status: driver_status
		};
		ajaxCall(tambahSupirUrl, data, function(json) {
			hideFullscreenLoading();
			var result = JSON.parse(json);
			closeDialog();
			if (result.status == "success") {
				getSupir();
			} else {
				alert("terjadi kesalahan");
			}
		});
	}
}

function getSupir() {
	showFullscreenLoading();
	ajaxCall(getSupirUrl, null, function(json) {
		hideFullscreenLoading();
		$(".tbody-supir").html("");
		var result = jQuery.parseJSON(json);
		var iLength = result.length;
		for (var i = 0; i < iLength; i++) {
			addSupirToTable((i + 1), result[i]);
		}
		if (iLength == 0) {
			$(".table-empty-state").addClass("shown");
		} else {
			$(".table-empty-state").removeClass("shown");
		}
	});
}

function addSupirToTable(no, result) {
	var ketersediaan = "Tersedia";
	var shipment_ids = result.shipment_ids.split(",");
	if (shipment_ids.length > 0 && shipment_ids != "") {
		ketersediaan = "";
		for (var i = 0; i < shipment_ids.length; i++) {
			ketersediaan += "<a class='shipment-id' href='" + shipmentUrl + shipment_ids[i] + "'>" + shipment_ids[i] + " (No. Kirim)</a>";
		}
	}
	
	if (result.driver_rating == null) {
		result.driver_rating = "Unrated";
	}
	
	var status = (result.driver_status == 0) ? "Tidak Aktif" : "Aktif"; 

	var btnEdit = "<button class='btn-action btn-edit' title='edit' style='background-image: url(" + editIconUrl + ");' data-id='" + result.driver_id + "'></button>";
	var btnDelete = "<button class='btn-action btn-delete' title='delete' style='background-image: url(" + deleteIconUrl + ");' data-id='" + result.driver_id + "'></button>";
	
	var element = "<tr class='tr-supir' data-id='" + result.driver_id + "' data-status='" + result.driver_status + "'><td class='td-no'>" + no + "</td><td class='td-name'>" + result.driver_name + "</td><td class='td-handphone'>" + result.driver_handphone + "</td><td class='td-address'>" + result.driver_address + "</td><td class='td-ketersediaan'>" + ketersediaan + "</td><td class='td-rating'>" + result.driver_rating + "</td><td class='td-jumlah-transaksi'>" + result.driver_jumlah_transaksi + "</td><td class='td-information'>" + result.driver_information + "</td><td>" + status + "</td><td>" + btnEdit + btnDelete + "</td></tr>";
	$(".tbody-supir").append(element);
}