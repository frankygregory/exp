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
						<td class="">Alamat</td>
						<td><input type="text" class="input-user_address" /></td>
					</tr>
					<tr>
						<td class="">Telepon</td>
						<td><input type="text" class="input-user_telephone" /></td>
					</tr>
					<tr>
						<td class="">Handphone</td>
						<td><input type="text" class="input-user_handphone" /></td>
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
						<td><input type="text" class="input-group_name" /></td>
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
			<div class="dialog-title">Delete User</div>
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
		<button type="button" class="btn-default btn-tambah-user">Tambah User</button>
		<table class="table table-user">
			<thead>
				<tr>
					<td>No.</td>
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
					<td>No.</td>
					<td>Nama</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody class="tbody-user">
			</tbody>
		</table>
	</div>
</div>
</div>
</div>


<script type="text/javascript">
$(function() {
	$(".btn-tambah-user").on("click", function() {
		showDialog(".dialog-tambah-user");
	});
	
	$(".btn-tambah-group").on("click", function() {
		showDialog(".dialog-tambah-group");
	});
	
	$(".dialog-background").on("click", function(e) {
		if (e.target.className == "dialog-background") {
			closeDialog();
		}
	});
});
</script>