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
	<div class="dialog dialog-edit-user">
		<div class="dialog-header">
			<div class="dialog-title">Edit User</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama</td>
						<td>
							<input type="text" class="input-edit-user_fullname" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Group</td>
						<td class="td-edit-grup">
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Level</td>
						<td>
							<label class="label-radio"><input type="radio" name="edit_user_level" class="input-edit-user_level" value="super" checked="checked" />Super Admin</label>
							<label class="label-radio"><input type="radio" name="edit_user_level" class="input-edit-user_level" value="admin" />Admin</label>
						</td>
					</tr>
					<tr>
						<td>Status</td>
						<td>
							<select class="select-edit-user_status">
								<option value="1">Aktif</option>
								<option value="0">Tidak Aktif</option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-edit-user">Simpan</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
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
	<div class="dialog dialog-konfirmasi-delete-group">
		<div class="dialog-header">
			<div class="dialog-title">Delete Group</div>
		</div>
		<div class="dialog-body">
			<div></div>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-negative btn-submit-delete-group">Delete Group</button>
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
		<div class="table-container">
			<table class="table table-user">
				<thead>
					<tr>
						<td class='td-no' data-col='no' data-align='center'>No.</td>
						<td data-col='nama'>Nama</td>
						<td data-col='email'>Email</td>
						<td data-col='group'>Group</td>
						<td data-col='level'>Level</td>
						<td data-col='status'>Status</td>
						<td data-col='action'>Action</td>
					</tr>
				</thead>
				<tbody class="tbody-user">
				</tbody>
			</table>
		</div>
	</div>
	<div class="section-2">
		<button type="button" class="btn-default btn-tambah-group">Tambah Group</button>
		<table class="table table-group">
			<thead>
				<tr>
					<td class='td-no' data-col='no' data-align='center'>No.</td>
					<td data-col='nama'>Nama</td>
					<td data-col='action'>Action</td>
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
		$(".dialog-tambah-user input[type='checkbox']").prop("checked", false);
		showDialog(".dialog-tambah-user");
		$(".input-insert-username").select();
	});
	
	$(".btn-submit-tambah-user").on("click", function() {
		insertUser();
	});
	
	$(document).on("click", ".btn-edit-user", function() {
		var trUser = $(this).closest(".tr-user");
		var user_id = $(trUser).data("id");
		var user_fullname = $(trUser).find(".td-user_fullname").html();
		var user_group_ids = $(trUser).find(".td-user_group").data("group_ids") + "";
		var user_level = $(trUser).find(".td-user_level").data("user_level");
		var user_status = $(trUser).find(".td-user_status").data("user_status");
		
		$(".dialog-edit-user").data("id", user_id);
		$(".dialog-edit-user .input-edit-user_fullname").val(user_fullname);
		var user_group_id = user_group_ids.split(";");
		for (var i = 0; i < user_group_id.length; i++) {
			$(".dialog-edit-user .input-edit-user_group_id[value='" + user_group_id[i] + "']").prop("checked", true);
		}
		$(".dialog-edit-user .input-edit-user_level[value='" + user_level + "']").prop("checked", true);
		$(".dialog-edit-user .select-edit-user_status").val(user_status);
		showDialog(".dialog-edit-user");
	});
	
	$(".btn-submit-edit-user").on("click", function() {
		updateUser();
	});
	
	$(document).on("click", ".btn-delete-user", function() {
		var user_id = $(this).closest(".tr-user").data("id");
		var user_fullname = $(this).closest(".tr-user").find(".td-user_fullname").html();
		$(".dialog-konfirmasi-delete-user").data("id", user_id);
		$(".dialog-konfirmasi-delete-user .dialog-body").html("Delete user " + user_fullname + "?");
		showDialog(".dialog-konfirmasi-delete-user");
	});
	
	$(".btn-submit-delete-user").on("click", function() {
		deleteUser();
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
	
	$(document).on("click", ".btn-delete-group", function() {
		var group_id = $(this).closest(".tr-group").data("id");
		var group_name = $(this).closest(".tr-group").data("name");
		
		$(".dialog-konfirmasi-delete-group").data("id", group_id);
		$(".dialog-konfirmasi-delete-group .dialog-body").html("Delete group " + group_name + "?");
		showDialog(".dialog-konfirmasi-delete-group");
	});
	
	$(".btn-submit-delete-group").on("click", function() {
		deleteGroup();
	});
});

function clearAllErrors() {
	$(".error").html("");
}

function cekUserInputError(username, user_email, user_fullname, group_ids, user_level) {
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
	} else if (user_level == "admin" && group_ids.indexOf(";") >= 0) {
		valid = false;
		$(".td-insert-grup .error").html("Admin hanya boleh berada pada 1 group");
	}
	return valid;
}

function cekUserEditInputError(user_fullname, group_ids, user_level) {
	clearAllErrors();
	var valid = true;
	if (user_fullname == "") {
		valid = false;
		$(".input-edit-user_fullname").next().html("Nama harus diisi");
	}
	if (group_ids == "") {
		valid = false;
		$(".td-edit-grup .error").html("User minimal harus berada pada 1 group");
	} else if (user_level == "admin" && group_ids.indexOf(";") >= 0) {
		valid = false;
		$(".td-edit-grup .error").html("Admin hanya boleh berada pada 1 group");
	}
	return valid;
}

function deleteUser() {
	var user_id = $(".dialog-konfirmasi-delete-user").data("id");
	ajaxCall("<?= base_url("user/deleteOtherUser") ?>", {user_id: user_id}, function(result) {
		if (result == "success") {
			closeDialog();
			getUser();
		}
	});
}

function updateUser() {
	var user_id = $(".dialog-edit-user").data("id");
	var user_fullname = $(".dialog-edit-user .input-edit-user_fullname").val().trim();
	var group_ids = "";
	$(".dialog-edit-user .input-edit-user_group_id[type='checkbox']:checked").each(function() {
		var group_id = $(this).val();
		if (group_ids != "") {
			group_ids += ";";
		}
		group_ids += group_id;
	});
	var user_level = $(".dialog-edit-user .input-edit-user_level:checked").val();
	var user_status = $(".dialog-edit-user .select-edit-user_status").val();
	
	var valid = cekUserEditInputError(user_fullname, group_ids, user_level);
	if (valid) {
		var data = {
			user_id: user_id,
			user_fullname: user_fullname,
			group_ids: group_ids,
			user_level: user_level,
			user_status: user_status
		};
		
		ajaxCall("<?= base_url("user/updateOtherUser") ?>", data, function(result) {
			if (result == "success") {
				closeDialog();
				getUser();
			}
		});
	}	
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
	
	var valid = cekUserInputError(username, user_email, user_fullname, group_ids, user_level);
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
		if (result[i].user_id != null) {
			var group_names = "";
			var group_name = (result[i].group_names + "").split(";");
			group_names += group_name[0];
			for (var j = 1; j < group_name.length; j++) {
				group_names += ", " + group_name[j];
			}
			
			var superAdminChecked = "", adminChecked = "", dataUserLevel = "";
			if (result[i].user_level == 2) {
				superAdminChecked = " checked";
				dataUserLevel = "super";
			} else if (result[i].user_level == 3) {
				adminChecked = " checked";
				dataUserLevel = "admin";
			}
			var tdUserLevel = "<label class='label-user-super-admin'><input type='radio' name='user-level' val='super'" + superAdminChecked + " /> Super Admin</label>";
			tdUserLevel += "<label class='label-user-admin'><input type='radio' name='user-level' val='admin'" + adminChecked + " /> Admin</label>";
			
			var status = "aktif";
			if (result[i].user_status == 0) {
				status = "tidak aktif";
			}
			
			var btnEdit = "<button class='btn-default btn-edit-user'>Edit</button>";
			var btnDelete = "<button class='btn-negative btn-delete-user'>Delete</button>";
			
			element += "<tr class='tr-user' data-id='" + result[i].user_id + "'>";
			element += "<td data-col='no' data-align='center'>" + (i + 1) + "</td>";
			element += "<td class='td-user_fullname' data-col='nama'>" + result[i].user_fullname + "</td>";
			element += "<td class='td-user_email' data-col='email'>" + result[i].user_email + "</td>";
			element += "<td class='td-user_group' data-col='group' data-group_ids='" + result[i].group_ids + "'>" + group_names + "</td>";
			element += "<td class='td-user_level' data-col='level' data-user_level='" + dataUserLevel + "'>" + tdUserLevel + "</td>";
			element += "<td class='td-user_status' data-col='status' data-user_status='" + result[i].user_status + "'>" + status + "</td>";
			element += "<td data-col='action'>" + btnEdit + btnDelete + "</td>";
			element += "</tr>";
		}
	}
	
	$(".tbody-user").html("");
	$(".tbody-user").append(element);
}

function deleteGroup() {
	var group_id = $(".dialog-konfirmasi-delete-group").data("id");
	ajaxCall("<?= base_url("user/deleteGroup") ?>", {group_id: group_id}, function(result) {
		if (result == "success") {
			closeDialog();
			getMyGroups();
		} else {
			alert("Grup ini masih memiliki anggota");
		}
	});
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
	var checkbox = "", checkboxEdit = "";
	var group_name = "";
	var iLength = result.length;
	var btnDelete = "<button class='btn-negative btn-delete-group'>Delete</button>";
	if (iLength == 1) {
		btnDelete = "";
	}
	for (var i = 0; i < iLength; i++) {
		group_name = result[i].group_name;
		if (group_name == "") {
			group_name = "default";
		}
		element += "<tr class='tr-group' data-id='" + result[i].group_id + "' data-name='" + group_name + "'>";
		element += "<td data-col='no' data-align='center'>" + (i + 1) + "</td>";
		element += "<td class='td-group_name' data-col='nama'>" + group_name + "</td>";
		element += "<td data-col='action'><button class='btn-default btn-edit-group'>Edit</button>" + btnDelete + "</td>";
		element += "</tr>";
		
		checkbox += "<label class='label-checkbox-group'><input type='checkbox' class='input-insert-user_group_id' value='" + result[i].group_id + "' /> " + group_name + "</label>";
		checkboxEdit += "<label class='label-checkbox-group'><input type='checkbox' class='input-edit-user_group_id' value='" + result[i].group_id + "' /> " + group_name + "</label>";
	}
	$(".tbody-group").html("");
	$(".tbody-group").html(element);
	
	$(".td-insert-grup").html("");
	$(".td-insert-grup").html(checkbox);
	$(".td-insert-grup").append("<div class='error'></div>");
	
	$(".td-edit-grup").html("");
	$(".td-edit-grup").html(checkboxEdit);
	$(".td-edit-grup").append("<div class='error'></div>");
}
</script>