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
						<span class="span-value"><?= $data->type_name ?></span>
						<span class="edit-icon" data-table="1" data-field="type_name" data-input-type="tipe" data-value="<?= $data->type_id ?>">Edit</span>
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
					<td class="td-value"><span class="span-value"></span><span class="edit-icon" data-table="2" data-field="" data-input-type="text">Edit</span></td>
				</tr>
				<tr>
					<td class="td-label">SIUP</td>
					<td class="td-value"><span class="span-value"></span><span class="edit-icon" data-table="2" data-field="" data-input-type="text">Edit</span></td>
				</tr>
				<tr>
					<td class="td-label">TDP</td>
					<td class="td-value"><span class="span-value"></span><span class="edit-icon" data-table="2" data-field="" data-input-type="text">Edit</span></td>
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
		}
		
		$(".dialog-edit .dialog-body").html(element);
		$(".dialog-edit").data("field", field);
		$(".dialog-edit").data("type", type);
		$(".dialog-edit").data("table", table);
		showDialog(".dialog-edit");
	});
	
	$(document).on("keydown", "input[data-type='number']", function(e) {
		isNumber(e);
	});
	
	$(".btn-submit-simpan").on("click", function() {
		updateData();
	});
	
	$(".dialog-background").on("click", function(e) {
		if (e.target.className == "dialog-background") {
			closeDialog();
		}
	});
	
	$(".btn-batal").on("click", function() {
		closeDialog();
	});
});

function cekInput() {
	var valid = true;
	var type = $(".dialog-edit").data("type");
	if (type == "text" || type == "textarea") {
		var label = $(".dialog-edit .dialog-title").html();
		var value = $(".dialog-edit " + type).val();
		if (value == "" || value === undefined) {
			valid = false;
			$(".dialog-edit .error").html(label + " harus diisi");
		}
	}
	return valid;
}

function updateData() {
	var field = $(".dialog-edit").data("field");
	var table = $(".dialog-edit").data("table");
	var value = $(".dialog-edit .input-value").val();
	
	var valid = cekInput();
	if (valid) {
		$.ajax({
			url: '<?= base_url("account-settings/updateCertainField") ?>',
			data: {
				field: field,
				value: value,
				table: table
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					window.location.reload(true);
				} else {
					alert(result);
				}
			}
		});
	}
}
</script>