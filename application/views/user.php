<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="dialog-background">
	<div class="dialog dialog-tambah-user">
		<div class="dialog-header">
			<div class="dialog-title">Tambah User</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Username</td>
						<td><input type="text" class="input-username" /></td>
					</tr>
					<tr>
						<td class="">Email</td>
						<td><input type="text" class="input-user_email" maxlength="12" /></td>
					</tr>
					<tr>
						<td class="">Nama</td>
						<td><input type="text" class="input-user_fullname" /></td>
					</tr>
					<tr>
						<td class="">Group</td>
						<td class="td-grup"></td>
					</tr>
					<tr>
						<td class="">Level</td>
						<td>
							<label class="label-radio"><input type="radio" name="user_level" class="input-user_level" value="super" checked="checked" />Super Admin</label>
							<label class="label-radio"><input type="radio" name="user_level" class="input-user_level" value="admin" />Admin</label>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-tambah-user">Tambah</button>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-tambah-group">
		<div class="dialog-header">
			<div class="dialog-title">Tambah Group</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama Grup</td>
						<td>
							<input type="text" class="input-group_name" />
							<div class="error"></div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-tambah-group">Tambah</button>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-konfirmasi-delete-user">
		<div class="dialog-header">
			<div class="dialog-title">Delete User</div>
		</div>
		<div class="dialog-body">
			<div></div>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-negative btn-submit-delete-user">Delete</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-edit-group">
		<div class="dialog-header">
			<div class="dialog-title"></div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama Grup</td>
						<td><input type="text" class="input-group_name" /></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-edit-group">Simpan</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
<div class="content">
	<div class="section-1">
		<button type="button" class="btn-default btn-tambah-user">Tambah User</button>
		<table class="table table-user">
			<thead>
				<tr>
					<td class='td-no'>No.</td>
					<td>Nama</td>
					<td>Email</td>
					<td>Group</td>
					<td>Super Admin</td>
					<td>Admin</td>
					<td>Status</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody class="tbody-user">
			</tbody>
		</table>
	</div>
	<div class="section-2">
		<button type="button" class="btn-default btn-tambah-group">Tambah Group</button>
		<table class="table table-group">
			<thead>
				<tr>
					<td class='td-no'>No.</td>
					<td>Nama</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody class="tbody-group">
			</tbody>
		</table>
	</div>
</div>
</div>
</div>


<script type="text/javascript">
$(function() {
	getMyGroups();
	
	$(".btn-tambah-user").on("click", function() {
		clearAllErrors();
		showDialog(".dialog-tambah-user");
	});
	
	$(".btn-tambah-group").on("click", function() {
		clearAllErrors();
		showDialog(".dialog-tambah-group");
	});
	
	$(".btn-submit-tambah-group").on("click", function() {
		insertGroup();
	});
	
	$(".btn-submit-edit-group").on("click", function() {
		updateGroup();
	});
	
	$(document).on("click", ".btn-edit-group", function() {
		var group_id = $(this).closest(".tr-group").data("id");
		var group_name = $(this).closest(".tr-group").find(".td-group_name").html();
		$(".dialog-edit-group").data("id", group_id);
		$(".dialog-edit-group .dialog-title").html("Edit Group " + group_name);
		$(".dialog-edit-group input.input-group_name").val(group_name);
		showDialog(".dialog-edit-group");
	});
});

function clearAllErrors() {
	$(".error").html("");
}

function updateGroup() {
	var group_id = $(".dialog-edit-group").data("id");
	var group_name = $(".dialog-edit-group .input-group_name").val().trim();
	if (group_name != "") {
		$.ajax({
			url: '<?= base_url("user/updateGroup") ?>',
			data: {
				group_id: group_id,
				group_name: group_name
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					getMyGroups();
				} else {
					alert(result);
				}
			}
		});
	} else {
		$(".dialog-edit-group .input-group_name").next().html("Nama Group harus diisi");
	}
}

function insertGroup() {
	var group_name = $(".dialog-tambah-group .input-group_name").val().trim();
	if (group_name != "") {
		$.ajax({
			url: '<?= base_url("user/insertGroup") ?>',
			data: {
				group_name: group_name
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					getMyGroups();
				} else {
					alert(result);
				}
			}
		});
	} else {
		$(".dialog-tambah-group .input-group_name").next().html("Nama Group harus diisi");
	}
}

function getMyGroups() {
	$.ajax({
		url: '<?= base_url("user/getMyGroups") ?>',
		type: 'POST',
		error: function(jqXHR, exception) {
			alert(jqXHR + " : " + jqXHR.responseText);
		},
		success: function(json) {
			$(".tbody-group").html("");
			var result = jQuery.parseJSON(json);
			addGroupsToTable(result);
		}
	});
}

function addGroupsToTable(result) {
	var element = "";
	var option = "";
	var group_name = "";
	var iLength = result.length;
	var btnDelete = "<button class='btn-negative btn-delete'>Delete</button>";
	if (iLength == 1) {
		btnDelete = "";
	}
	for (var i = 0; i < iLength; i++) {
		group_name = result[i].group_name;
		if (group_name == "") {
			group_name = "default";
		}
		element += "<tr class='tr-group' data-id='" + result[i].group_id + "'>";
		element += "<td>" + (i + 1) + "</td>";
		element += "<td class='td-group_name'>" + group_name + "</td>";
		element += "<td><button class='btn-default btn-edit-group'>Edit</button>" + btnDelete + "</td>";
		element += "</tr>";
		
		option += "<option value='" + result[i].group_id + "'>" + group_name + "</option>";
	}
	$(".tbody-group").html("");
	$(".tbody-group").html(element);
	
	
	$(".input-group_id").html("");
	$(".input-group_id").html(option);
}
</script>