<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?><span class="tag-premium-large"></span></div>
<div class="dialog-background">
	<div class="dialog dialog-tambah-user">
		<div class="dialog-header">
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title">Tambah User</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Username</td>
						<td>
							<input type="text" class="input-insert-username" maxlength="15" />
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
							<input type="text" class="input-insert-user_fullname" maxlength="30" />
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
					<tr>
						<td class="">Password</td>
						<td>
							<input type="password" class="input-insert-password" maxlength="30" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Confirm Password</td>
						<td>
							<input type="password" class="input-insert-confirm-password" maxlength="30" />
							<div class="error"></div>
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
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title">Edit User</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama</td>
						<td>
							<input type="text" class="input-edit-user_fullname" maxlength="30" />
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
			<button type="button" class="btn-negative btn-override-password">Override Password</button>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-edit-user">Simpan</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-override-password">
		<div class="dialog-header">
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title">Override Password User</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Password baru</td>
						<td>
							<input type="password" class="input-edit-password" maxlength="30" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Confirm Password baru</td>
						<td>
							<input type="password" class="input-edit-confirm-password" maxlength="30" />
							<div class="error"></div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-confirm-override-password">Override Password</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-konfirmasi-delete-user">
		<div class="dialog-header">
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
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
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title">Tambah Group</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama Grup</td>
						<td>
							<input type="text" class="input-group_name" maxlength="30" />
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
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
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
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title"></div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama Grup</td>
						<td><input type="text" class="input-group_name" maxlength="30" /></td>
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
			<div class="table-empty-state">Tidak ada user</div>
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
		<div class="table-empty-state">Tidak ada group</div>
	</div>
</div>
</div>
</div>
<script type="text/javascript">
var validPoints = 0;
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

	$(document).on("click", ".btn-override-password", function() {
		var user_id = $(".dialog-edit-user").data("id");
		$(".dialog-override-password").data("id", user_id);
		showDialog(".dialog-override-password");
	});

	$(document).on("click", ".btn-confirm-override-password", function() {
		var password = $(".input-edit-password").val().trim();
		var confirmPassword =$(".input-edit-confirm-password").val().trim();
		var valid = cekUserOverridePasswordError(password, confirmPassword);
		if (valid) {
			var user_id = $(".dialog-override-password").data("id");

			var data = {
				user_id: user_id,
				password: password
			};
			ajaxCall("<?= base_url("user/updateOtherUserPassword") ?>", data, function(json) {
				var result = JSON.parse(json);
				if (result.status == "success") {
					closeDialog();
					getUser();
				}
			});
		}
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

function cekUserOverridePasswordError(password, confirmPassword) {
	clearAllErrors();
	var valid = true;
	if (password == "") {
		valid = false;
		$(".input-edit-password").next().html("Password harus diisi");
	}
	if (confirmPassword == "") {
		valid = false;
		$(".input-edit-confirm-password").next().html("Confirm Password harus diisi");
	} else if (password != confirmPassword) {
		valid = false;
		$(".input-edit-confirm-password").next().html("Confirm Password harus sama dengan Password");
	}
	return valid;
}

function cekUserInputError(username, user_email, user_fullname, group_ids, user_level, password, confirmPassword) {
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
	if (password == "") {
		valid = false;
		$(".input-insert-password").next().html("Password harus diisi");
	}
	if (confirmPassword == "") {
		valid = false;
		$(".input-insert-confirm-password").next().html("Confirm Password harus diisi");
	} else if (password != confirmPassword) {
		valid = false;
		$(".input-insert-confirm-password").next().html("Confirm Password harus sama dengan Password");
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
	showFullscreenLoading();
	var user_id = $(".dialog-konfirmasi-delete-user").data("id");
	ajaxCall("<?= base_url("user/deleteOtherUser") ?>", {user_id: user_id}, function(result) {
		hideFullscreenLoading();
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
		showFullscreenLoading();
		var data = {
			user_id: user_id,
			user_fullname: user_fullname,
			group_ids: group_ids,
			user_level: user_level,
			user_status: user_status
		};
		
		ajaxCall("<?= base_url("user/updateOtherUser") ?>", data, function(json) {
			hideFullscreenLoading();
			closeDialog();
			var result = JSON.parse(json);
			if (result.status == "success") {
				getUser();
			}
		});
	}	
}

function insertUser() {
	var username = $(".input-insert-username").val().trim();
	var user_email = $(".input-insert-user_email").val().trim();
	var user_fullname = $(".input-insert-user_fullname").val().trim();
	var password = $(".input-insert-password").val();
	var confirmPassword = $(".input-insert-confirm-password").val();
	var group_ids = "";
	$(".input-insert-user_group_id[type='checkbox']:checked").each(function() {
		var group_id = $(this).val();
		if (group_ids != "") {
			group_ids += ";";
		}
		group_ids += group_id;
	});
	var user_level = $(".input-insert-user_level:checked").val();
	
	var valid = cekUserInputError(username, user_email, user_fullname, group_ids, user_level, password, confirmPassword);
	if (valid) {
		showFullscreenLoading();
		validPoints = 0;
		var data = {
			username: username,
			user_email: user_email,
			user_fullname: user_fullname,
			group_ids: group_ids,
			user_level: user_level,
			password: password
		};

		checkUsernameKembar(data);
		checkEmailKembar(data);
	}
}

function checkUsernameKembar(data) {
	ajaxCall("<?= base_url("user/checkUserKembar") ?>", {username: data.username}, function(json) {
		var result = JSON.parse(json);
		if (result.status == "success") {
			if (result.result == "tidak_kembar") {
				addValidPoints(data);
			} else {
				hideFullscreenLoading();
				$(".input-insert-username").next().html("Username sudah ada");
			}
		}
	});
}

function checkEmailKembar(data) {
	ajaxCall("<?= base_url("user/checkEmailKembar") ?>", {user_email: data.user_email}, function(json) {
		var result = JSON.parse(json);
		if (result.status == "success") {
			if (result.result == "tidak_kembar") {
				addValidPoints(data);
			} else {
				hideFullscreenLoading();
				$(".input-insert-user_email").next().html("Email sudah ada");
			}
		}
	});
}

function addValidPoints(data) {
	validPoints++;
	if (validPoints == 2) {
		ajaxCall("<?= base_url("user/addOtherUser") ?>", data, function(json) {
			hideFullscreenLoading();
			closeDialog();
			var result = JSON.parse(json);
			if (result.status == "success") {
				alert(result.message);
				getUser();
			} else {
				alert(result.status);
			}
		});
	}
}

function getUser() {
	$(".tbody-user").html("");
	setLoading(".section-1 .table-empty-state");
	ajaxCall("<?= base_url("user/getUser") ?>", null, function(json) {
		removeLoading(".section-1 .table-empty-state");
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
			if (group_names == "") {
				group_names = "default";
			}
			
			var user_level = "", adminChecked = "", dataUserLevel = "";
			if (result[i].user_level == 2) {
				user_level = "Super Admin";
				dataUserLevel = "super";
			} else if (result[i].user_level == 3) {
				user_level = " Admin";
				dataUserLevel = "admin";
			}
			
			var status = "Aktif";
			if (result[i].user_status == 0) {
				status = "Tidak Aktif";
			}
			
			var btnEdit = "<button class='btn-action btn-edit-user' title='edit' style='background-image: url(" + editIconUrl + ");'></button>";
			var btnDelete = "<button class='btn-action btn-delete-user' title='delete' style='background-image: url(" + deleteIconUrl + ");'></button>";
			
			element += "<tr class='tr-user' data-id='" + result[i].user_id + "'>";
			element += "<td data-col='no' data-align='center'>" + (i + 1) + "</td>";
			element += "<td class='td-user_fullname' data-col='nama'>" + result[i].user_fullname + "</td>";
			element += "<td class='td-user_email' data-col='email'>" + result[i].user_email + "</td>";
			element += "<td class='td-user_group' data-col='group' data-group_ids='" + result[i].group_ids + "'>" + group_names + "</td>";
			element += "<td class='td-user_level' data-col='level' data-user_level='" + dataUserLevel + "'>" + user_level + "</td>";
			element += "<td class='td-user_status' data-col='status' data-user_status='" + result[i].user_status + "'>" + status + "</td>";
			element += "<td data-col='action'>" + btnEdit + btnDelete + "</td>";
			element += "</tr>";
		}
	}
	
	if (iLength == 0) {
		$(".section-1 .table-empty-state").addClass("shown");
		
	} else {
		$(".section-1 .table-empty-state").removeClass("shown");
	}
	$(".tbody-user").html(element);
}

function deleteGroup() {
	showFullscreenLoading();
	var group_id = $(".dialog-konfirmasi-delete-group").data("id");
	ajaxCall("<?= base_url("user/deleteGroup") ?>", {group_id: group_id}, function(result) {
		hideFullscreenLoading();
		closeDialog();
		if (result == "success") {
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
		showFullscreenLoading();
		var data = {
			group_id: group_id,
			group_name: group_name
		};
		ajaxCall("<?= base_url("user/updateGroup") ?>", data, function(json) {
			hideFullscreenLoading();
			var result = JSON.parse(json);
			if (result.status == "success") {
				closeDialog();
				getUser();
				getMyGroups();
			} else {
				alert(result.error_message);
			}
		});
	} else {
		$(".dialog-edit-group .input-group_name").next().html("Nama Group harus diisi");
	}
}

function insertGroup() {
	var group_name = $(".dialog-tambah-group .input-group_name").val().trim();
	if (group_name != "") {
		showFullscreenLoading();
		ajaxCall("<?= base_url("user/insertGroup") ?>", {group_name: group_name}, function(json) {
			hideFullscreenLoading();
			var result = JSON.parse(json);
			if (result.status == "success") {
				closeDialog();
				getMyGroups();
			} else {
				alert(result.status);
			}
		});
	} else {
		$(".dialog-tambah-group .input-group_name").next().html("Nama Group harus diisi");
	}
}

function getMyGroups() {
	$(".tbody-group").html("");
	setLoading(".section-2 .table-empty-state");
	ajaxCall("<?= base_url("user/getMyGroups") ?>", null, function(json) {
		removeLoading(".section-2 .table-empty-state");
		var result = jQuery.parseJSON(json);
		addGroupsToTable(result);
	});
}

function addGroupsToTable(result) {
	var element = "";
	var checkbox = "", checkboxEdit = "";
	var group_name = "";
	var iLength = result.length;
	var btnDelete = "<button class='btn-action btn-delete-group' title='delete' style='background-image: url(" + deleteIconUrl + ");'></button>";
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
		element += "<td data-col='action'><button class='btn-action btn-edit-group' title='edit' style='background-image: url(" + editIconUrl + ");'></button>" + btnDelete + "</td>";
		element += "</tr>";
		
		checkbox += "<label class='label-checkbox-group'><input type='checkbox' class='input-insert-user_group_id' value='" + result[i].group_id + "' /> " + group_name + "</label>";
		checkboxEdit += "<label class='label-checkbox-group'><input type='checkbox' class='input-edit-user_group_id' value='" + result[i].group_id + "' /> " + group_name + "</label>";
	}

	if (iLength == 0) {
		$(".section-2 .table-empty-state").addClass("shown");
		
	} else {
		$(".section-2 .table-empty-state").removeClass("shown");
	}

	$(".tbody-group").html(element);
	
	$(".td-insert-grup").html(checkbox);
	$(".td-insert-grup").append("<div class='error'></div>");
	
	$(".td-edit-grup").html(checkboxEdit);
	$(".td-edit-grup").append("<div class='error'></div>");
}
</script>