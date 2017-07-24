<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="content">
	<div class="section-1">
		<table>
			<tbody>
				<tr>
					<td class="td-label">Tipe</td>
					<td class="td-value">
						<span class="span-value"><?= ucfirst($data->type_name) ?></span>
						<span class="edit-icon" data-table="1" data-field="type_id" data-input-type="tipe" data-value="<?= $data->type_id ?>">Edit</span>
					</td>
				</tr>
				<tr>
					<td class="td-label">Username</td>
					<td class="td-value"><?= $data->username ?></td>
				</tr>
				<tr>
					<td class="td-label">Email</td>
					<td class="td-value"><?= $data->user_email ?></td>
				</tr>
				<tr>
					<td class="td-label">Nama Lengkap</td>
					<td class="td-value">
						<span class="span-value"><?= $data->user_fullname ?></span>
						<span class="edit-icon" data-table="1" data-field="user_fullname" data-input-type="text">Edit</span>
					</td>
				</tr>
				<tr>
					<td class="td-label">Alamat</td>
					<td class="td-value">
						<span class="span-value"><?= $data->user_address ?></span>
						<span class="edit-icon" data-table="1" data-field="user_address" data-input-type="textarea">Edit</span>
					</td>
				</tr>
				<tr>
					<td class="td-label">Nomor Telepon</td>
					<td class="td-value">
						<span class="span-value"><?= $data->user_telephone ?></span>
						<span class="edit-icon" data-table="1" data-field="user_telephone" data-input-type="text" data-type="number">Edit</span>
					</td>
				</tr>
				<tr>
					<td class="td-label">Nomor Handphone</td>
					<td class="td-value">
						<span class="span-value"><?= $data->user_handphone ?></span>
						<span class="edit-icon" data-table="1" data-field="user_handphone" data-input-type="text" data-type="number">Edit</span>
					</td>
				</tr>
				<tr>
					<td class="td-label">Password</td>
					<td class="td-value">* * * * *<span class="edit-icon" data-table="1" data-field="password" data-input-type="password">Edit</span></td>
				</tr>
			</tbody>
		</table>
		<table>
			<tbody>
				<tr>
					<td class="td-label">Keterangan</td>
					<td class="td-value">
						<span class="span-value"><?= $data->user_details_information ?></span>
						<span class="edit-icon" data-table="2" data-field="user_details_information" data-input-type="textarea">Edit</span>
					</td>
				</tr>
				<tr>
					<td class="td-label">NPWP</td>
					<td class="td-value"><span class="span-value"><?php echo ($data->user_details_npwp == "") ? "Anda belum mengupload NPWP" : "Sudah terupload" ?></span><span class="edit-icon" data-table="2" data-field="user_details_npwp" data-input-type="file">Edit</span></td>
				</tr>
				<tr>
					<td class="td-label">SIUP</td>
					<td class="td-value"><span class="span-value"><?php echo ($data->user_details_siup == "") ? "Anda belum mengupload SIUP" : "Sudah terupload" ?></span><span class="edit-icon" data-table="2" data-field="user_details_siup" data-input-type="file">Edit</span></td>
				</tr>
				<tr>
					<td class="td-label">TDP</td>
					<td class="td-value"><span class="span-value"><?php echo ($data->user_details_tdp == "") ? "Anda belum mengupload TDP" : "Sudah terupload" ?></span><span class="edit-icon" data-table="2" data-field="user_details_tdp" data-input-type="file">Edit</span></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-edit">
		<div class="dialog-header">
			<div class="dialog-title"></div>
		</div>
		<div class="dialog-body">
			<div></div>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-simpan">Simpan</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
</div>
</div>
<script>
$(function() {
	$(".edit-icon").on("click", function() {
		var label = $(this).closest("tr").find(".td-label").html();
		$(".dialog-edit .dialog-title").html(label);
		
		var value = $(this).closest("td").find(".span-value").html();
		var field = $(this).data("field");
		var table = $(this).data("table");
		var type = $(this).data("input-type");
		var inputType = $(this).data("type");
		if (inputType == "number") {
			inputType = "data-type='number'";
		}
		var element;
		switch (type) {
			case "text":
				element = "<input class='input-value' type='text' name='" + field + "' value='" + value + "' " + inputType + " /><div class='error'></div>";
				break;
			case "textarea":
				element = "<textarea class='input-value' name='" + field + "'>" + value + "</textarea><div class='error'></div>";
				break;
			case "tipe":
				value = $(this).data("value");
				var checked1 = "", checked2 = "";
				if (value == "1") {
					checked1 = " checked";
				} else if (value == 2) {
					checked2 = " checked";
				}
				element = "<label><input class='input-value' type='radio' name='" + field + "' value='1' " + checked1 + "/>Individu</label>";
				element += "<label><input class='input-value' type='radio' name='" + field + "' value='2' " + checked2 + "/>Perusahaan</label>";
				break;
			case "password":
				element = "<div class='form-item'>";
				element += "<div class='form-item-label'>Password lama</div>";
				element += "<input type='password' class='input-value-old input-password-lama' maxlength='30' />";
				element += "<div class='error'></div>";
				element += "</div>";
				element += "<div class='form-item'>";
				element += "<div class='form-item-label'>Password baru</div>";
				element += "<input type='password' class='input-value input-password-baru' maxlength='30' />";
				element += "<div class='error'></div>";
				element += "</div>";
				element += "<div class='form-item'>";
				element += "<div class='form-item-label'>Konfirmasi password baru</div>";
				element += "<input type='password' class='input-konfirmasi-password' maxlength='30' />";
				element += "<div class='error'></div>";
				element += "</div>";
				break;
			case "file":
				element = "<input class='input-value' type='file' name='file' /><div class='error'></div>";
				break;
		}
		
		$(".dialog-edit .dialog-body").html(element);
		$(".dialog-edit").data("field", field);
		$(".dialog-edit").data("type", type);
		$(".dialog-edit").data("table", table);
		showDialog(".dialog-edit");
	});

	$(document).on("change", "input[type='file']", function(e) {
		var value = $(this).val();
		if (!value) {
			alert("Tidak ada file yang dipilih");
		}
	});
	
	$(document).on("keydown", "input[data-type='number']", function(e) {
		isNumber(e);
	});
	
	$(".btn-submit-simpan").on("click", function() {
		updateData();
	});
});

function cekInput() {
	var valid = true;
	var type = $(".dialog-edit").data("type");
	if (type == "text" || type == "textarea") {
		var label = $(".dialog-edit .dialog-title").html();
		var value = (type == "text") ? $(".dialog-edit input[type='text']").val() : $(".dialog-edit " + type).val();
		if (value == "" || value === undefined) {
			valid = false;
			$(".dialog-edit .error").html(label + " harus diisi");
		}
	} else if (type == "password") {
		var lama = $(".dialog-edit .input-password-lama").val();
		var baru = $(".dialog-edit .input-password-baru").val();
		var konfirm = $(".dialog-edit .input-konfirmasi-password").val();
		
		var kosong = false;
		if (lama == "" || lama == undefined) {
			valid = false;
			kosong = true;
			$(".dialog-edit .input-password-lama").next().html("Password lama harus diisi");
		}
		if (baru == "" || baru == undefined) {
			valid = false;
			kosong = true;
			$(".dialog-edit .input-password-baru").next().html("Password baru harus diisi");
		}
		if (konfirm == "" || konfirm == undefined) {
			valid = false;
			kosong = true;
			$(".dialog-edit .input-konfirmasi-password").next().html("Konfirmasi password baru harus diisi");
		}
		
		if (!kosong) {
			if (baru != konfirm) {
				valid = false;
				$(".dialog-edit .input-konfirmasi-password").next().html("Konfirmasi password baru harus sama dengan password baru");
			}
		}
	}
	
	return valid;
}

function updateData() {
	var valid = cekInput();
	if (valid) {
		var field = $(".dialog-edit").data("field");
		var table = $(".dialog-edit").data("table");
		var type = $(".dialog-edit").data("type");
		var old = "";
		var value;
		if (type == "text" || type == "textarea") {
			value = $(".dialog-edit .input-value").val();
		} else if (type == "tipe") {
			value = $(".dialog-edit .input-value[name='" + field + "']:checked").val();
		} else if (type == "file") {
			value = $(".dialog-edit .input-value")[0].files[0];
		} else if (type == "password") {
			value = $(".dialog-edit .input-value").val();
			old = $(".dialog-edit .input-value-old").val();
		}
		
		var data = {
			field: field,
			value: value,
			old: old,
			table: table
		};

		if (type != "file") {
			ajaxCall("<?= base_url("account-settings/updateCertainField") ?>", data, function(json) {
				var result = JSON.parse(json);
				if (result.status == "success") {
					if (type == "password" && result.affected_rows == 0) {
						alert("Password lama salah");
					} else {
						window.location.reload(true);
					}
				} else if (result.status == "error") {
					alert(result.error_message);
				}
			});
		} else {
			var formData = new FormData();
			formData.append("field", field);
			formData.append("value", value);
			formData.append("table", table);
			$.ajax({
				url: "<?= base_url("account-settings/updateCertainField") ?>",
				type: "POST",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function (json) {
					var result = JSON.parse(json);
					if (result.status == "success") {
						window.location.reload(true);
					} else {
						alert(JSON.stringify(result.error_message));
					}
				}
			});
		}
	}
}
</script>