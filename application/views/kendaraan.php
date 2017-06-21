<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="dialog-background">
	<div class="dialog dialog-tambah">
		<div class="dialog-header">
			<div class="dialog-title">Tambah Kendaraan</div>
		</div>
		<div class="dialog-body">
			<table class="table-tambah-kendaraan">
				<tbody>
					<tr>
						<td class="">Nama</td>
						<td>
							<input type="text" class="input-nama" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Nopol Kendaraan</td>
						<td>
							<input type="text" class="input-nopol" maxlength="12" />
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
			<div class="dialog-title">Edit Kendaraan</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama</td>
						<td>
							<input type="text" class="input-nama" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Nopol Kendaraan</td>
						<td>
							<input type="text" class="input-nopol" maxlength="12" />
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
			<div class="dialog-title">Delete Kendaraan</div>
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
		<button type="button" class="btn-default btn-tambah">Tambah Kendaraan</button>
		<div class="table-container">
			<table class="table table-kendaraan">
				<thead>
					<tr>
						<td class="td-no" data-col='no'>No.</td>
						<td data-col='nomor-kendaraan'>Nomor Kendaraan</td>
						<td data-col='nama-kendaraan'>Nama Kendaraan</td>
						<td class="td-ketersediaan" data-col='ketersediaan'>Ketersediaan</td>
						<td class="th-jumlah-transaksi" data-col='jumlah-transaksi'>Jumlah Transaksi</td>
						<td data-col='keterangan'>Keterangan</td>
						<td class="th-status" data-col='status'>Status</td>
						<td class="th-action" data-col='action'>Action</td>
					</tr>
				</thead>
				<tbody class="tbody-kendaraan">
				</tbody>
			</table>
			<div class="table-empty-state">Anda belum menambahkan kendaraan</div>
		</div>
	</div>
</div>
</div>
</div>


<script type="text/javascript">
$(function() {
	getKendaraan();
	
	$(".btn-tambah").on("click", function() {
		clearErrors();
		showDialog(".dialog-tambah");
		$(".dialog-tambah .input-nama").select();
	});
	
	$(".btn-submit-tambah").on("click", function() {
		tambahKendaraan();
	});
	
	$(document).on("click", ".btn-edit", function() {
		clearErrors();
		editKendaraan(this);
	});
	
	$(".btn-submit-edit").on("click", function() {
		updateKendaraan();
	});
	
	$(document).on("click", ".btn-toggle", function() {
		toggleKendaraanAktif(this);
	});
	
	$(document).on("click", ".btn-delete", function() {
		var namaKendaraan = $(this).closest(".tr-kendaraan").children(".td-name").html();
		var vehicle_id = $(this).closest(".tr-kendaraan").data("id");
		$(".dialog-konfirmasi-delete").data("id", vehicle_id);
		$(".dialog-konfirmasi-delete .dialog-body").html("Delete " + namaKendaraan + "?");
		showDialog(".dialog-konfirmasi-delete");
	});
	
	$(".btn-submit-delete").on("click", function() {
		deleteKendaraan(this);
	});
	
});

function toggleKendaraanAktif(element) {
	var vehicle_status = $(element).data("value");
	var vehicle_id = $(element).closest(".tr-kendaraan").data("id");
	
	var data = {
		vehicle_id: vehicle_id,
		vehicle_status: vehicle_status
	};
	ajaxCall("<?= base_url("kendaraan/toggleKendaraanAktif") ?>", data, function(result) {
		if (result == "success") {
			getKendaraan();
		} else {
			alert(result);
		}
	});
}

function clearErrors() {
	$(".error").html("");
}

function cekInputError(vehicle_name, vehicle_nomor) {
	clearErrors();
	var valid = true;
	if (vehicle_name == "") {
		valid = false;
		$(".input-nama").next().html("Nama kendaraan harus diisi");
	}
	if (vehicle_nomor == "") {
		valid = false;
		$(".input-nopol").next().html("Nopol kendaraan harus diisi");
	}
	return valid;
}

function editKendaraan(element) {
	var id = $(element).data("id");
	var vehicle_nomor = $(".tr-kendaraan[data-id='" + id + "'] .td-nomor").html();
	var vehicle_name = $(".tr-kendaraan[data-id='" + id + "'] .td-name").html();
	var vehicle_information = $(".tr-kendaraan[data-id='" + id + "'] .td-information").html();
	var vehicle_status = $(".tr-kendaraan[data-id='" + id + "'] .btn-aktif").prop("disabled");
	
	if (vehicle_status) {
		vehicle_status = "1";
	} else {
		vehicle_status = "0";
	}
	
	$(".dialog-edit").data("id", id);
	$(".dialog-edit .input-nopol").val(vehicle_nomor);
	$(".dialog-edit .input-nama").val(vehicle_name);
	$(".dialog-edit .input-keterangan").val(vehicle_information);
	$(".dialog-edit .input-status").val(vehicle_status);
	
	showDialog(".dialog-edit");
}

function updateKendaraan() {
	var vehicle_id = $(".dialog-edit").data("id");
	var vehicle_nomor = $(".dialog-edit .input-nopol").val().trim();
	var vehicle_name = $(".dialog-edit .input-nama").val().trim();
	var vehicle_information = $(".dialog-edit .input-keterangan").val().trim();
	var vehicle_status = $(".dialog-edit .input-status").val();
	
	var valid = cekInputError(vehicle_name, vehicle_nomor);
	if (valid) {
		var data = {
			submit_update: true,
			vehicle_id: vehicle_id,
			vehicle_nomor: vehicle_nomor,
			vehicle_name: vehicle_name,
			vehicle_information: vehicle_information,
			vehicle_status: vehicle_status
		};
		ajaxCall("<?= base_url("kendaraan/updateKendaraan") ?>", data, function(result) {
			if (result == "success") {
				closeDialog();
				getKendaraan();
			} else {
				alert(result);
			}
		});
	}
}

function tambahKendaraan() {
	var vehicle_nomor = $(".dialog-tambah .input-nopol").val().trim();
	var vehicle_name = $(".dialog-tambah .input-nama").val().trim();
	var vehicle_information = $(".dialog-tambah .input-keterangan").val().trim();
	var vehicle_status = $(".dialog-tambah .input-status").val();
	
	var valid = cekInputError(vehicle_name, vehicle_nomor);
	if (valid) {
		var data = {
			submit_tambah: true,
			vehicle_nomor: vehicle_nomor,
			vehicle_name: vehicle_name,
			vehicle_information: vehicle_information,
			vehicle_status: vehicle_status
		};
		ajaxCall("<?= base_url("kendaraan/tambahKendaraan") ?>", data, function(result) {
			if (result == "success") {
				closeDialog();
				getKendaraan();
			}
		});
	}
}

function deleteKendaraan(element) {
	var vehicle_id = $(".dialog-konfirmasi-delete").data("id");
	var data = {
		submit_delete: true,
		vehicle_id: vehicle_id
	};
	ajaxCall("<?= base_url("kendaraan/deleteKendaraan") ?>", data, function(result) {
		if (result == "success") {
			closeDialog();
			getKendaraan();
		}
	});
}

function getKendaraan() {
	$(".tbody-kendaraan").html("");
	setLoading(".table-empty-state");
	ajaxCall("<?= base_url("kendaraan/getKendaraan") ?>", null, function(json) {
		removeLoading();
		$(".tbody-kendaraan").html("");
		var result = jQuery.parseJSON(json);
		var iLength = result.length;
		for (var i = 0; i < iLength; i++) {
			addKendaraanToTable((i + 1), result[i]);
		}
		if (iLength == 0) {
			$(".table-empty-state").addClass("shown");
		} else {
			$(".table-empty-state").removeClass("shown");
		}
	});
}

function addKendaraanToTable(no, result) {
	var ketersediaan = "Tersedia";
	if (result.shipment_id != "") {
		ketersediaan = "<a href='<?= base_url("kirim/detail/") ?>" + result.shipment_id + "'>" + result.shipment_id + " (No. Kirim)</a>";
	}
	
	var aktifDisabled = "disabled", tidakAktifDisabled = "";
	if (result.vehicle_status == 0) {
		aktifDisabled = "";
		tidakAktifDisabled = "disabled";
	}
	
	var btnAktif = "<button class='btn-default btn-toggle btn-aktif' data-value='1' " + aktifDisabled + ">Aktif</button>";
	var btnTidakAktif = "<button class='btn-default btn-toggle btn-tidak-aktif' data-value='0' " + tidakAktifDisabled + ">Tidak Aktif</button>";
	
	var btnEdit = "<button class='btn-default btn-edit' data-id='" + result.vehicle_id + "'>Edit</button>";
	var btnDelete = "<button class='btn-negative btn-delete' data-id='" + result.vehicle_id + "'>Delete</button>";
	
	var element = "<tr class='tr-kendaraan' data-id='" + result.vehicle_id + "'><td class='td-no' data-label='No'>" + no + "</td><td class='td-nomor' data-label='Nopol'>" + result.vehicle_nomor + "</td><td class='td-name' data-label='Nama'>" + result.vehicle_name + "</td><td class='td-ketersediaan' data-label='Ketersediaan'>" + ketersediaan + "</td><td class='td-jumlah-transaksi' data-label='Jumlah Transaksi'>" + result.vehicle_jumlah_transaksi + "</td><td class='td-information' data-label='Keterangan'>" + result.vehicle_information + "</td><td>" + btnAktif + btnTidakAktif + "</td><td>" + btnEdit + btnDelete + "</td></tr>";
	$(".tbody-kendaraan").append(element);
}
</script>