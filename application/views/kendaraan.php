<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="dialog-background">
	<div class="dialog dialog-tambah">
		<div class="dialog-header">
			<div class="dialog-title">Tambah Kendaraan</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama</td>
						<td><input type="text" class="input-nama" /></td>
					</tr>
					<tr>
						<td class="">Nopol Kendaraan</td>
						<td><input type="text" class="input-nopol" maxlength="12" /></td>
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
						<td><input type="text" class="input-nama" /></td>
					</tr>
					<tr>
						<td class="">Nopol Kendaraan</td>
						<td><input type="text" class="input-nopol" maxlength="12" /></td>
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
		<table class="table">
			<thead>
				<tr>
					<td>No.</td>
					<td>Nomor Kendaraan</td>
					<td>Nama Kendaraan</td>
					<td>Ketersediaan</td>
					<td>Jumlah Transaksi</td>
					<td>Keterangan</td>
					<td>Status</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody class="tbody-kendaraan">
			</tbody>
		</table>
	</div>
</div>
</div>
</div>


<script type="text/javascript">
$(function() {
	getKendaraan();
	
	$(".btn-tambah").on("click", function() {
		showDialog(".dialog-tambah");
		$(".dialog-tambah .input-nama").select();
	});
	
	$(".btn-submit-tambah").on("click", function() {
		tambahKendaraan();
	});
	
	$(document).on("click", ".btn-edit", function() {
		editKendaraan(this);
	});
	
	$(".btn-batal").on("click", function() {
		closeDialog();
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
	
	function toggleKendaraanAktif(element) {
		var vehicle_status = $(element).data("value");
		var vehicle_id = $(element).closest(".tr-kendaraan").data("id");
		
		$.ajax({
			url: '<?= base_url("kendaraan/toggleKendaraanAktif") ?>',
			data: {
				vehicle_id: vehicle_id,
				vehicle_status: vehicle_status
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					getKendaraan();
				} else {
					alert(result);
				}
			}
		});
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
		var vehicle_nomor = $(".dialog-edit .input-nopol").val();
		var vehicle_name = $(".dialog-edit .input-nama").val();
		var vehicle_information = $(".dialog-edit .input-keterangan").val();
		var vehicle_status = $(".dialog-edit .input-status").val();
		
		$.ajax({
			url: '<?= base_url("kendaraan/updateKendaraan") ?>',
			data: {
				submit_update: true,
				vehicle_id: vehicle_id,
				vehicle_nomor: vehicle_nomor,
				vehicle_name: vehicle_name,
				vehicle_information: vehicle_information,
				vehicle_status: vehicle_status
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					getKendaraan();
				} else {
					alert(result);
				}
			}
		});
	}
	
	function tambahKendaraan() {
		var vehicle_nomor = $(".dialog-tambah .input-nopol").val();
		var vehicle_name = $(".dialog-tambah .input-nama").val();
		var vehicle_information = $(".dialog-tambah .input-keterangan").val();
		var vehicle_status = $(".dialog-tambah .input-status").val();
		
		$.ajax({
			url: '<?= base_url("kendaraan/tambahKendaraan") ?>',
			data: {
				submit_tambah: true,
				vehicle_nomor: vehicle_nomor,
				vehicle_name: vehicle_name,
				vehicle_information: vehicle_information,
				vehicle_status: vehicle_status
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					getKendaraan();
				}
			}
		});
	}
	
	function deleteKendaraan(element) {
		var vehicle_id = $(".dialog-konfirmasi-delete").data("id");
		$.ajax({
			url: '<?= base_url("kendaraan/deleteKendaraan") ?>',
			data: {
				submit_delete: true,
				vehicle_id: vehicle_id
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					getKendaraan();
				}
			}
		});
	}
	
	function getKendaraan() {
		$.ajax({
			url: '<?= base_url("kendaraan/getKendaraan") ?>',
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(json) {
				$(".tbody-kendaraan").html("");
				var result = jQuery.parseJSON(json);
				for (var i = 0; i < result.length; i++) {
					addKendaraanToTable((i + 1), result[i]);
				}
			}
		});
	}
	
	function addKendaraanToTable(no, result) {
		var ketersediaan = "Tersedia";
		if (result.vehicle_in_use == 1) {
			ketersediaan = "Sedang Digunakan";
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
		
		var element = "<tr class='tr-kendaraan' data-id='" + result.vehicle_id + "'><td>" + no + "</td><td class='td-nomor'>" + result.vehicle_nomor + "</td><td class='td-name'>" + result.vehicle_name + "</td><td class='td-ketersediaan'>" + ketersediaan + "</td><td class='td-jumlah-transaksi'>" + result.vehicle_jumlah_transaksi + "</td><td class='td-information'>" + result.vehicle_information + "</td><td>" + btnAktif + btnTidakAktif + "</td><td>" + btnEdit + btnDelete + "</td></tr>";
		$(".tbody-kendaraan").append(element);
	}
	
});
</script>