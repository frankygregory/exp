<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="dialog-background">
	<div class="dialog dialog-tambah">
		<div class="dialog-header">
			<div class="dialog-title">Tambah Driver</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama Driver</td>
						<td><input type="text" class="input-nama" /></td>
					</tr>
					<tr>
						<td class="">Alamat Driver</td>
						<td><input type="text" class="input-alamat" /></td>
					</tr>
					<tr>
						<td class="">No. HP</td>
						<td><input type="text" class="input-hp" maxlength="12" /></td>
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
			<div class="dialog-title">Edit Driver</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama Driver</td>
						<td><input type="text" class="input-nama" /></td>
					</tr>
					<tr>
						<td class="">Alamat Driver</td>
						<td><input type="text" class="input-alamat" /></td>
					</tr>
					<tr>
						<td class="">No. HP</td>
						<td><input type="text" class="input-hp" maxlength="12" /></td>
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
		<table class="table">
			<thead>
				<tr>
					<td>No.</td>
					<td>Nama Driver</td>
					<td>No. HP</td>
					<td>Alamat</td>
					<td>Ketersediaan</td>
					<td>Rating</td>
					<td>Jumlah Transaksi</td>
					<td>Keterangan</td>
					<td>Status</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody class="tbody-supir">
			
			</tbody>
		</table>
	</div>
</div>
</div>
</div>


<script type="text/javascript">
$(function() {
	getSupir();
	
	$(".btn-tambah").on("click", function() {
		showDialog(".dialog-tambah");
		$(".dialog-tambah .input-nama").select();
	});
	
	$(".btn-submit-tambah").on("click", function() {
		tambahSupir();
	});
	
	$(document).on("click", ".btn-edit", function() {
		editSupir(this);
	});
	
	$(".btn-submit-edit").on("click", function() {
		updateSupir();
	});
	
	$(document).on("click", ".btn-toggle", function() {
		toggleDriverAktif(this);
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
	
	function deleteSupir(element) {
		var driver_id = $(".dialog-konfirmasi-delete").data("id");
		$.ajax({
			url: '<?= base_url("supir/deleteSupir") ?>',
			data: {
				submit_delete: true,
				driver_id: driver_id
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					getSupir();
				} else {
					alert(result);
				}
			}
		});
	}
	
	function toggleDriverAktif(element) {
		var driver_id = $(element).closest(".tr-supir").data("id");
		var driver_status = $(element).data("value");
		
		$.ajax({
			url: '<?= base_url("supir/toggleSupirAktif") ?>',
			data: {
				driver_id: driver_id,
				driver_status: driver_status
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					getSupir();
				} else {
					alert(result);
				}
			}
		});
	}
	
	function editSupir(element) {
		var id = $(element).data("id");
		
		var driver_name = $(".tr-supir[data-id='" + id + "'] .td-name").html();
		var driver_address = $(".tr-supir[data-id='" + id + "'] .td-address").html();
		var driver_handphone = $(".tr-supir[data-id='" + id + "'] .td-handphone").html();
		var driver_information = $(".tr-supir[data-id='" + id + "'] .td-information").html();
		var driver_status = $(".tr-supir[data-id='" + id + "'] .btn-aktif").prop("disabled");
		
		if (driver_status) {
			driver_status = "1";
		} else {
			driver_status = "0";
		}
		
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
		var driver_name = $(".dialog-edit .input-nama").val();
		var driver_handphone = $(".dialog-edit .input-hp").val();
		var driver_address = $(".dialog-edit .input-alamat").val();
		var driver_information = $(".dialog-edit .input-keterangan").val();
		var driver_status = $(".dialog-edit .input-status").val();
		
		$.ajax({
			url: '<?= base_url("supir/updateSupir") ?>',
			data: {
				submit_update: true,
				driver_id: driver_id,
				driver_name: driver_name,
				driver_handphone: driver_handphone,
				driver_address: driver_address,
				driver_information: driver_information,
				driver_status: driver_status
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					getSupir();
				} else {
					alert(result);
				}
			}
		});
	}
	
	function tambahSupir() {
		var driver_name = $(".dialog-tambah .input-nama").val();
		var driver_handphone = $(".dialog-tambah .input-hp").val();
		var driver_address = $(".dialog-tambah .input-alamat").val();
		var driver_information = $(".dialog-tambah .input-keterangan").val();
		var driver_status = $(".dialog-tambah .input-status").val();
		
		$.ajax({
			url: '<?= base_url("supir/tambahSupir") ?>',
			data: {
				submit_tambah: true,
				driver_name: driver_name,
				driver_handphone: driver_handphone,
				driver_address: driver_address,
				driver_information: driver_information,
				driver_status: driver_status
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					getSupir();
				} else {
					
				}
			}
		});
	}
	
	function getSupir() {
		$.ajax({
			url: '<?= base_url("supir/getSupir") ?>',
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(json) {
				$(".tbody-supir").html("");
				var result = jQuery.parseJSON(json);
				for (var i = 0; i < result.length; i++) {
					addSupirToTable((i + 1), result[i]);
				}
			}
		});
	}
	
	function addSupirToTable(no, result) {
		var ketersediaan = "Tersedia";
		if (result.shipment_id != "") {
			ketersediaan = result.shipment_id;
		}
		
		if (result.driver_rating == null) {
			result.driver_rating = "Unrated";
		}
		
		var aktifDisabled = "disabled", tidakAktifDisabled = "";
		if (result.driver_status == 0) {
			aktifDisabled = "";
			tidakAktifDisabled = "disabled";
		}
		
		var btnAktif = "<button class='btn-default btn-toggle btn-aktif' data-value='1' " + aktifDisabled + ">Aktif</button>";
		var btnTidakAktif = "<button class='btn-default btn-toggle btn-tidak-aktif' data-value='0' " + tidakAktifDisabled + ">Tidak Aktif</button>";
		
		var btnEdit = "<button class='btn-default btn-edit' data-id='" + result.driver_id + "'>Edit</button>";
		var btnDelete = "<button class='btn-negative btn-delete' data-id='" + result.driver_id + "'>Delete</button>";
		
		var element = "<tr class='tr-supir' data-id='" + result.driver_id + "'><td>" + no + "</td><td class='td-name'>" + result.driver_name + "</td><td class='td-handphone'>" + result.driver_handphone + "</td><td class='td-address'>" + result.driver_address + "</td><td class='td-ketersediaan'>" + ketersediaan + "</td><td>" + result.driver_rating + "</td><td>" + result.driver_jumlah_transaksi + "</td><td class='td-information'>" + result.driver_information + "</td><td>" + btnAktif + btnTidakAktif + "</td><td>" + btnEdit + btnDelete + "</td></tr>";
		$(".tbody-supir").append(element);
	}
	
});
</script>