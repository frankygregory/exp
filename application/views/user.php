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
						<td>
							<input type="text" class="input-insert-username" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Email</td>
						<td>
							<input type="text" class="input-insert-user_email" maxlength="40" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Nama</td>
						<td>
							<input type="text" class="input-insert-user_fullname" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Group</td>
						<td class="td-insert-grup">
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Level</td>
						<td>
							<label class="label-radio"><input type="radio" name="user_level" class="input-insert-user_level" value="super" checked="checked" />Super Admin</label>
							<label class="label-radio"><input type="radio" name="user_level" class="input-insert-user_level" value="admin" />Admin</label>
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
					<td>Level</td>
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
	getUser();
	getMyGroups();
	
	$(".btn-tambah-user").on("click", function() {
		clearAllErrors();
		showDialog(".dialog-tambah-user");
	});
	
	$(".btn-submit-tambah-user").on("click", function() {
		insertUser();
	});
	
	$(".btn-tambah-group").on("click", function() {
		clearAllErrors();
		showDialog(".dialog-tambah-group");
		$(".dialog-tambah-group .input-group_name").select();
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

function cekUserInputError(username, user_email, user_fullname, group_ids) {
	clearAllErrors();
	var valid = true;
	if (username == "") {
		valid = false;
		$(".input-insert-username").next().html("Username harus diisi");
	}
	if (user_email == "") {
		valid = false;
		$(".input-insert-user_email").next().html("Email harus diisi");
	}
	if (user_fullname == "") {
		valid = false;
		$(".input-insert-user_fullname").next().html("Nama harus diisi");
	}
	if (group_ids == "") {
		valid = false;
		$(".td-insert-grup .error").html("User minimal harus berada pada 1 group");
	}
	return valid;
}

function insertUser() {
	var username = $(".input-insert-username").val().trim();
	var user_email = $(".input-insert-user_email").val().trim();
	var user_fullname = $(".input-insert-user_fullname").val().trim();
	var group_ids = "";
	$(".input-insert-user_group_id[type='checkbox']:checked").each(function() {
		var group_id = $(this).val();
		if (group_ids != "") {
			group_ids += ";";
		}
		group_ids += group_id;
	});
	var user_level = $(".input-insert-user_level:checked").val();
	
	var valid = cekUserInputError(username, user_email, user_fullname, group_ids);
	if (valid) {
		var data = {
			username: username,
			user_email: user_email,
			user_fullname: user_fullname,
			group_ids: group_ids,
			user_level: user_level
		};
		
		ajaxCall("<?= base_url("user/addOtherUser") ?>", data, function(result) {
			if (result == "success") {
				closeDialog();
				getUser();
			}
		});
	}
}

function getUser() {
	ajaxCall("<?= base_url("user/getUser") ?>", null, function(json) {
		var result = jQuery.parseJSON(json);
		addUserToTable(result);
	});
}

function addUserToTable(result) {
	var element = "";
	var iLength = result.length;
	for (var i = 0; i < iLength; i++) {
		var group_names = "";
		var group_name = result[i].group_names.split(";");
		group_names += group_name[0];
		for (var j = 1; j < group_name.length; j++) {
			group_names += ", " + group_name[j];
		}
		
		var superAdminChecked = "", adminChecked = "";
		if (result[i].user_level == 2) {
			superAdminChecked = " checked";
		} else if (result[i].user_level == 3) {
			adminChecked = " checked";
		}
		var tdUserLevel = "<label class='label-user-super-admin'><input type='radio' name='user-level' val='super'" + superAdminChecked + " /> Super Admin</label>";
		tdUserLevel += "<label class='label-user-admin'><input type='radio' name='user-level' val='admin'" + adminChecked + " /> Admin</label>";
		
		var status = "aktif";
		if (result[i].status_userGroup == 0) {
			status = "tidak aktif";
		}
		
		element += "<tr class='tr-user' data-id='" + result[i].user_id + "'>";
		element += "<td>" + (i + 1) + "</td>";
		element += "<td class='td-user_fullname'>" + result[i].user_fullname + "</td>";
		element += "<td class='td-user_email'>" + result[i].user_email + "</td>";
		element += "<td>" + group_names + "</td>";
		element += "<td class='td-user_group_ids'>" + tdUserLevel + "</td>";
		element += "<td>" + status + "</td>";
		element += "<td></td>";
		element += "</tr>";
	}
	
	$(".tbody-user").html("");
	$(".tbody-user").append(element);
}

function updateGroup() {
	var group_id = $(".dialog-edit-group").data("id");
	var group_name = $(".dialog-edit-group .input-group_name").val().trim();
	if (group_name != "") {
		var data = {
			group_id: group_id,
			group_name: group_name
		};
		ajaxCall("<?= base_url("user/updateGroup") ?>", data, function(result) {
			if (result == "success") {
				closeDialog();
				getMyGroups();
			} else {
				alert(result);
			}
		});
	} else {
		$(".dialog-edit-group .input-group_name").next().html("Nama Group harus diisi");
	}
}

function insertGroup() {
	var group_name = $(".dialog-tambah-group .input-group_name").val().trim();
	if (group_name != "") {
		ajaxCall("<?= base_url("user/insertGroup") ?>", {group_name: group_name}, function(result) {
			if (result == "success") {
				closeDialog();
				getMyGroups();
			} else {
				alert(result);
			}
		});
	} else {
		$(".dialog-tambah-group .input-group_name").next().html("Nama Group harus diisi");
	}
}

function getMyGroups() {
	ajaxCall("<?= base_url("user/getMyGroups") ?>", null, function(json) {
		$(".tbody-group").html("");
		var result = jQuery.parseJSON(json);
		addGroupsToTable(result);
	});
}

function addGroupsToTable(result) {
	var element = "";
	var checkbox = "";
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
		
		checkbox += "<label class='label-checkbox-group'><input type='checkbox' class='input-insert-user_group_id' value='" + result[i].group_id + "' /> " + group_name + "</label>";
	}
	$(".tbody-group").html("");
	$(".tbody-group").html(element);
	
	$(".td-insert-grup").html("");
	$(".td-insert-grup").html(checkbox);
	$(".td-insert-grup").append("<div class='error'></div>");
}
</script>