<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="dialog-background">
	<div class="dialog dialog-tambah">
		<div class="dialog-header">
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title">Tambah Driver</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama Driver</td>
						<td>
							<input type="text" class="input-nama" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Alamat Driver</td>
						<td>
							<input type="text" class="input-alamat" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">No. HP</td>
						<td>
							<input type="text" class="input-hp" maxlength="12" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Keterangan</td>
						<td><input type="text" class="input-keterangan" /></td>
					</tr>
					<tr>
						<td class="">Status</td>
						<td>
							<select name="input-status" class="input-status">
								<option value="1">Aktif</option>
								<option value="0">Tidak Aktif</option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-tambah">Tambah</button>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-edit">
		<div class="dialog-header">
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title">Edit Driver</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama Driver</td>
						<td>
							<input type="text" class="input-nama" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Alamat Driver</td>
						<td>
							<input type="text" class="input-alamat" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">No. HP</td>
						<td>
							<input type="text" class="input-hp" maxlength="12" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Keterangan</td>
						<td><input type="text" class="input-keterangan" /></td>
					</tr>
					<tr>
						<td class="">Status</td>
						<td>
							<select name="input-status" class="input-status">
								<option value="1">Aktif</option>
								<option value="0">Tidak Aktif</option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-edit">Simpan</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-konfirmasi-delete">
		<div class="dialog-header">
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title">Delete Driver</div>
		</div>
		<div class="dialog-body">
			<div></div>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-negative btn-submit-delete">Delete</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
<div class="content">
	<div class="section-1">
		<button type="button" class="btn-default btn-tambah">Tambah Driver</button>
		<div class="table-container">
			<table class="table table-driver">
				<thead>
					<tr>
						<td class="th-no" data-col="no">No.</td>
						<td data-col="nama-driver">Nama Driver</td>
						<td data-col="no-hp">No. HP</td>
						<td data-col="alamat">Alamat</td>
						<td class="th-ketersediaan" data-col="ketersediaan">Ketersediaan</td>
						<td class="th-rating" data-col="rating">Rating</td>
						<td class="th-jumlah-transaksi" data-col="jumlah-transaksi">Jumlah Transaksi</td>
						<td data-col="keterangan">Keterangan</td>
						<td class="th-status" data-col="status">Status</td>
						<td class="th-action" data-col="action">Action</td>
					</tr>
				</thead>
				<tbody class="tbody-supir">
				
				</tbody>
			</table>
			<div class="table-empty-state">Anda belum menambahkan driver</div>
		</div>
	</div>
</div>
</div>
</div>

<script type="text/javascript">
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
	ajaxCall("<?= base_url("supir/deleteSupir") ?>", data, function(json) {
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
		ajaxCall("<?= base_url("supir/updateSupir") ?>", data, function(json) {
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
		ajaxCall("<?= base_url("supir/tambahSupir") ?>", data, function(json) {
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
	ajaxCall("<?= base_url("supir/getSupir") ?>", null, function(json) {
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
			ketersediaan += "<a class='shipment-id' href='<?= base_url("kirim/detail/") ?>" + shipment_ids[i] + "'>" + shipment_ids[i] + " (No. Kirim)</a>";
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
</script>