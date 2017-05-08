<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="dialog-background">
	<div class="dialog dialog-tambah">
		<div class="dialog-header">
			<div class="dialog-title">Tambah Alat</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama Alat</td>
						<td><input type="text" class="input-nama" /></td>
					</tr>
					<tr>
						<td class="">Keterangan</td>
						<td><input type="text" class="input-keterangan" /></td>
					</tr>
					<tr>
						<td class="">Email</td>
						<td><input type="text" class="input-email" /></td>
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
			<div class="dialog-title">Edit Alat</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama Alat</td>
						<td><input type="text" class="input-nama" /></td>
					</tr>
					<tr>
						<td class="">Keterangan</td>
						<td><input type="text" class="input-keterangan" /></td>
					</tr>
					<tr>
						<td class="">Email</td>
						<td><input type="text" class="input-email" /></td>
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
			<div class="dialog-title">Delete Alat</div>
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
		<button type="button" class="btn-default btn-tambah">Tambah Alat</button>
		<table class="table">
			<thead>
				<tr>
					<td>No.</td>
					<td>Nama Alat</td>
					<td>Keterangan</td>
					<td>Email</td>
					<td>Status</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody class="tbody-alat">
			
			</tbody>
		</table>
	</div>
</div>
</div>
</div>


<script type="text/javascript">
$(function() {
	getAlat();
	
	$(".btn-tambah").on("click", function() {
		showDialog(".dialog-tambah");
		$(".dialog-tambah .input-nama").select();
	});
	
	$(".btn-submit-tambah").on("click", function() {
		tambahAlat();
	});
	
	$(document).on("click", ".btn-edit", function() {
		editAlat(this);
	});
	
	$(".btn-submit-edit").on("click", function() {
		updateAlat();
	});
	
	$(document).on("click", ".btn-toggle", function() {
		toggleAlatAktif(this);
	});
	
	$(document).on("click", ".btn-delete", function() {
		var namaAlat = $(this).closest(".tr-alat").children(".td-name").html();
		var device_id = $(this).closest(".tr-alat").data("id");
		$(".dialog-konfirmasi-delete").data("id", device_id);
		$(".dialog-konfirmasi-delete .dialog-body").html("Delete " + namaAlat + "?");
		showDialog(".dialog-konfirmasi-delete");
	});
	
	$(".btn-submit-delete").on("click", function() {
		deleteAlat(this);
	});
	
	function deleteAlat(element) {
		var device_id = $(".dialog-konfirmasi-delete").data("id");
		$.ajax({
			url: '<?= base_url("alat/deleteAlat") ?>',
			data: {
				submit_delete: true,
				device_id: device_id
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					getAlat();
				} else {
					alert(result);
				}
			}
		});
	}
	
	function toggleAlatAktif(element) {
		var device_id = $(element).closest(".tr-alat").data("id");
		var device_status = $(element).data("value");
		
		$.ajax({
			url: '<?= base_url("alat/toggleAlatAktif") ?>',
			data: {
				device_id: device_id,
				device_status: device_status
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					getAlat();
				} else {
					alert(result);
				}
			}
		});
	}
	
	function editAlat(element) {
		var id = $(element).data("id");
		
		var device_name = $(".tr-alat[data-id='" + id + "'] .td-name").html();
		var device_email = $(".tr-alat[data-id='" + id + "'] .td-email").html();
		var device_information = $(".tr-alat[data-id='" + id + "'] .td-information").html();
		var device_status = $(".tr-alat[data-id='" + id + "'] .btn-aktif").prop("disabled");
		
		if (device_status) {
			device_status = "1";
		} else {
			device_status = "0";
		}
		
		$(".dialog-edit").data("id", id);
		$(".dialog-edit .input-nama").val(device_name);
		$(".dialog-edit .input-email").val(device_email);
		$(".dialog-edit .input-keterangan").val(device_information);
		$(".dialog-edit .input-status").val(device_status);
		
		showDialog(".dialog-edit");
	}
	
	function updateAlat() {
		var device_id = $(".dialog-edit").data("id");
		var device_name = $(".dialog-edit .input-nama").val();
		var device_email = $(".dialog-edit .input-email").val();
		var device_information = $(".dialog-edit .input-keterangan").val();
		var driver_status = $(".dialog-edit .input-status").val();
		
		$.ajax({
			url: '<?= base_url("alat/updateAlat") ?>',
			data: {
				submit_update: true,
				device_id: device_id,
				device_name: device_name,
				device_email: device_email,
				device_information: device_information,
				driver_status: driver_status
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					getAlat();
				} else {
					alert(result);
				}
			}
		});
	}
	
	function tambahAlat() {
		var device_name = $(".dialog-tambah .input-nama").val();
		var device_email = $(".dialog-tambah .input-email").val();
		var device_information = $(".dialog-tambah .input-keterangan").val();
		var device_status = $(".dialog-tambah .input-status").val();
		
		$.ajax({
			url: '<?= base_url("alat/tambahAlat") ?>',
			data: {
				submit_tambah: true,
				device_name: device_name,
				device_email: device_email,
				device_information: device_information,
				device_status: device_status
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					getAlat();
				}
			}
		});
	}
	
	function getAlat() {
		$.ajax({
			url: '<?= base_url("alat/getAlat") ?>',
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(json) {
				$(".tbody-alat").html("");
				var result = jQuery.parseJSON(json);
				for (var i = 0; i < result.length; i++) {
					addAlatToTable((i + 1), result[i]);
				}
			}
		});
	}
	
	function addAlatToTable(no, result) {
		
		var aktifDisabled = "disabled", tidakAktifDisabled = "";
		if (result.device_status == 0) {
			aktifDisabled = "";
			tidakAktifDisabled = "disabled";
		}
		
		var btnAktif = "<button class='btn-default btn-toggle btn-aktif' data-value='1' " + aktifDisabled + ">Aktif</button>";
		var btnTidakAktif = "<button class='btn-default btn-toggle btn-tidak-aktif' data-value='0' " + tidakAktifDisabled + ">Tidak Aktif</button>";
		
		var btnEdit = "<button class='btn-default btn-edit' data-id='" + result.device_id + "'>Edit</button>";
		var btnDelete = "<button class='btn-negative btn-delete' data-id='" + result.device_id + "'>Delete</button>";
		
		var element = "<tr class='tr-alat' data-id='" + result.device_id + "'><td>" + no + "</td><td class='td-name'>" + result.device_name + "</td><td class='td-information'>" + result.device_information + "</td><td class='td-email'>" + result.device_email + "</td><td>" + btnAktif + btnTidakAktif + "</td><td>" + btnEdit + btnDelete + "</td></tr>";
		$(".tbody-alat").append(element);
	}
	
});
</script>