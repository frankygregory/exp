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
						<td>
							<input type="text" class="input-nama" maxlength="20" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Keterangan</td>
						<td>
							<input type="text" class="input-keterangan" maxlength="100" />
						</td>
					</tr>
					<tr>
						<td class="">Email</td>
						<td>
							<input type="text" class="input-email" maxlength="50" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Password</td>
						<td>
							<input type="password" class="input-password" maxlength="30" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Confirm Password</td>
						<td>
							<input type="password" class="input-confirm-password" maxlength="30" />
							<div class="error"></div>
						</td>
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
						<td>
							<input type="text" class="input-nama" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Keterangan</td>
						<td><input type="text" class="input-keterangan" /></td>
					</tr>
					<tr>
						<td class="">Email</td>
						<td>
							<span class="input-email"></span>
							<div class="error"></div>
						</td>
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
			<button type="button" class="btn-negative btn-ganti-password">Ganti Password</button>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-edit">Simpan</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-ganti-password">
		<div class="dialog-header">
			<div class="dialog-title">Ganti Password</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Password baru</td>
						<td>
							<input type="password" class="input-ganti-password" maxlength="30" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Confirm Password baru</td>
						<td>
							<input type="password" class="input-confirm-ganti-password" maxlength="30" />
							<div class="error"></div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-confirm-ganti-password">Ganti Password</button>
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
		<div class="table-container">
			<table class="table table-alat">
				<thead>
					<tr>
						<td class="th-no" data-col='no'>No.</td>
						<td data-col='nama-alat'>Nama Alat</td>
						<td data-col='keterangan'>Keterangan</td>
						<td data-col='email'>Email</td>
						<td class="th-ketersediaan" data-col='ketersediaan'>Ketersediaan</td>
						<td class="th-status" data-col='status'>Status</td>
						<td class="th-action" data-col='action'>Action</td>
					</tr>
				</thead>
				<tbody class="tbody-alat">
				
				</tbody>
			</table>
			<div class="table-empty-state">Anda belum menambahkan alat</div>
		</div>
	</div>
</div>
</div>
</div>


<script type="text/javascript">
$(function() {
	getAlat();
	
	$(".btn-tambah").on("click", function() {
		clearErrors();
		showDialog(".dialog-tambah");
		$(".dialog-tambah .input-nama").select();
	});
	
	$(".btn-submit-tambah").on("click", function() {
		tambahAlat();
	});
	
	$(document).on("click", ".btn-edit", function() {
		clearErrors();
		editAlat(this);
	});
	
	$(".btn-submit-edit").on("click", function() {
		updateAlat();
	});
	
	$(document).on("click", ".btn-delete", function() {
		var namaAlat = $(this).closest(".tr-alat").children(".td-name").html();
		var device_id = $(this).closest(".tr-alat").data("id");
		$(".dialog-konfirmasi-delete").data("id", device_id);
		$(".dialog-konfirmasi-delete .dialog-body").html("Delete " + namaAlat + "?");
		showDialog(".dialog-konfirmasi-delete");
	});

	$(document).on("click", ".btn-ganti-password", function() {
		var device_id = $(".dialog-edit").data("id");
		$(".dialog-ganti-password").data("id", device_id);
		showDialog(".dialog-ganti-password");
	});

	$(document).on("click", ".btn-confirm-ganti-password", function() {
		var device_password = $(".input-ganti-password").val().trim();
		var device_confirm_password = $(".input-confirm-ganti-password").val().trim();

		var valid = cekInputGantiPassword(device_password, device_confirm_password);
		if (valid) {
			showFullscreenLoading();
			var device_id = $(".dialog-ganti-password").data("id");
			var data = {
				device_id: device_id,
				device_password: device_password
			};

			ajaxCall("<?= base_url("alat/gantiPassword") ?>", data, function(json) {
				hideFullscreenLoading();
				var result = JSON.parse(json);
				if (result.status == "success") {
					closeDialog();
					getAlat();
				}
			});
		}

	});
	
	$(".btn-submit-delete").on("click", function() {
		deleteAlat(this);
	});
	
});

function checkEmailKembar(data) {
	ajaxCall("<?= base_url("alat/checkEmailKembar") ?>", {user_email: data.device_email}, function(json) {
		var result = JSON.parse(json);
		if (result.status == "success") {
			if (result.result == "tidak_kembar") {
				addValidPoints(data);
			} else {
				hideFullscreenLoading();
				$(".input-email").next().html("Email sudah ada");
			}
		}
	});
}

function addValidPoints(data) {
	ajaxCall("<?= base_url("alat/tambahAlat") ?>", data, function(json) {
		hideFullscreenLoading();
		var result = JSON.parse(json);
		if (result.status == "success") {
			alert(result.message);
			closeDialog();
			getAlat();
		}
	});
}

function deleteAlat(element) {
	showFullscreenLoading();
	var device_id = $(".dialog-konfirmasi-delete").data("id");
	var data = {
		submit_delete: true,
		device_id: device_id
	};
	ajaxCall("<?= base_url("alat/deleteAlat") ?>", data, function(json) {
		hideFullscreenLoading();
		var result = JSON.parse(json);
		if (result.status == "success") {
			closeDialog();
			getAlat();
		}
	});
}

function clearErrors() {
	$(".error").html("");
}

function cekInputGantiPassword(device_password, device_confirm_password) {
	clearErrors();
	var valid = true;
	if (device_password == "") {
		valid = false;
		$(".input-ganti-password").next().html("Password harus diisi");
	}
	if (device_confirm_password == "") {
		valid = false;
		$(".input-confirm-ganti-password").next().html("Confirm Password harus diisi");
	} else if (device_confirm_password != device_password) {
		valid = false;
		$(".input-confirm-ganti-password").next().html("Confirm Password harus sama dengan password");
	}
	return valid;
}

function cekInsertInputError(device_name, device_email, device_password, device_confirm_password) {
	clearErrors();
	var valid = true;
	if (device_name == "") {
		valid = false;
		$(".input-nama").next().html("Nama alat harus diisi");
	}
	if (device_email == "") {
		valid = false;
		$(".input-email").next().html("Email harus diisi");
	}
	if (device_password == "") {
		valid = false;
		$(".input-password").next().html("Password harus diisi");
	}
	if (device_confirm_password == "") {
		valid = false;
		$(".input-confirm-password").next().html("Confirm Password harus diisi");
	} else if (device_confirm_password != device_password) {
		valid = false;
		$(".input-confirm-password").next().html("Confirm Password harus sama dengan password");
	}
	return valid;
}

function cekUpdateInputError(device_name) {
	clearErrors();
	var valid = true;
	if (device_name == "") {
		valid = false;
		$(".input-nama").next().html("Nama alat harus diisi");
	}
	return valid;
}

function editAlat(element) {
	var id = $(element).data("id");
	var trAlat = $(element).closest(".tr-alat");
	var device_name = trAlat.find(".td-name").html();
	var device_email = trAlat.find(".td-email").html();
	var device_information = trAlat.find(".td-information").html();
	var device_status = trAlat.data("status");
	
	$(".dialog-edit").data("id", id);
	$(".dialog-edit .input-nama").val(device_name);
	$(".dialog-edit .input-email").html(device_email);
	$(".dialog-edit .input-keterangan").val(device_information);
	$(".dialog-edit .input-status").val(device_status);
	
	showDialog(".dialog-edit");
}

function updateAlat() {
	var device_id = $(".dialog-edit").data("id");
	var device_name = $(".dialog-edit .input-nama").val();
	var device_information = $(".dialog-edit .input-keterangan").val();
	var device_status = $(".dialog-edit .input-status").val();
	
	var valid = cekUpdateInputError(device_name);
	if (valid) {
		showFullscreenLoading();
		var data = {
			submit_update: true,
			device_id: device_id,
			device_name: device_name,
			device_information: device_information,
			device_status: device_status
		};
		ajaxCall("<?= base_url("alat/updateAlat") ?>", data, function(json) {
			hideFullscreenLoading();
			var result = JSON.parse(json);
			if (result.status == "success") {
				closeDialog();
				getAlat();
			}
		});
	}
}

function tambahAlat() {
	var device_name = $(".dialog-tambah .input-nama").val();
	var device_email = $(".dialog-tambah .input-email").val();
	var device_password = $(".dialog-tambah .input-password").val();
	var device_confirm_password = $(".dialog-tambah .input-confirm-password").val();
	var device_information = $(".dialog-tambah .input-keterangan").val();
	var device_status = $(".dialog-tambah .input-status").val();
	
	var valid = cekInsertInputError(device_name, device_email, device_password, device_confirm_password);
	if (valid) {
		showFullscreenLoading();
		var data = {
			submit_tambah: true,
			device_name: device_name,
			device_email: device_email,
			device_password: device_password,
			device_information: device_information,
			device_status: device_status
		};

		checkEmailKembar(data);
	}
}

function getAlat() {
	showFullscreenLoading();
	ajaxCall("<?= base_url("alat/getAlat") ?>", null, function(json) {
		hideFullscreenLoading();
		$(".tbody-alat").html("");
		var result = jQuery.parseJSON(json);
		var iLength = result.length;
		for (var i = 0; i < iLength; i++) {
			addAlatToTable((i + 1), result[i]);
		}
		if (iLength == 0) {
			$(".table-empty-state").addClass("shown");
		} else {
			$(".table-empty-state").removeClass("shown");
		}
	});
}

function addAlatToTable(no, result) {
	var ketersediaan = "Tersedia";
	if (result.shipment_id != "") {
		ketersediaan = "<a href='<?= base_url("kirim/detail/") ?>" + result.shipment_id + "'>" + result.shipment_id + " (No. Kirim)</a>";
	}
	
	var status = (result.device_status == 0) ? "Tidak Aktif" : "Aktif";
	
	var btnEdit = "<button class='btn-action btn-edit' title='edit' style='background-image: url(" + editIconUrl + ");' data-id='" + result.device_id + "'></button>";
	var btnDelete = "<button class='btn-action btn-delete' title='delete' style='background-image: url(" + deleteIconUrl + ");' data-id='" + result.device_id + "'></button>";
	
	var element = "<tr class='tr-alat' data-id='" + result.device_id + "' data-status='" + result.device_status + "'><td class='td-no'>" + no + "</td><td class='td-name'>" + result.device_name + "</td><td class='td-information'>" + result.device_information + "</td><td class='td-email'>" + result.device_email + "</td><td class='td-ketersediaan'>" + ketersediaan + "</td><td class='td-status'>" + status + "</td><td class='td-action'>" + btnEdit + btnDelete + "</td></tr>";
	$(".tbody-alat").append(element);
}
</script>