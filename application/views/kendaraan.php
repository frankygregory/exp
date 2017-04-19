<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="dialog-background">
	<div class="dialog dialog-tambah">
		<div class="dialog-header">
			<div class="dialog-title">Tambah Kendaraan</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama</td>
						<td><input type="text" /></td>
					</tr>
					<tr>
						<td class="">Nopol Kendaraan</td>
						<td><input type="text" class="input-nopol-kendaraan" maxlength="12" /></td>
					</tr>
					<tr>
						<td class="">Keterangan</td>
						<td><input type="text" /></td>
					</tr>
					<tr>
						<td class="">Ketersediaan</td>
						<td>
							<select name="input-ketersediaan">
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
<div class="content">
	<div class="section-1">
		<button type="button" class="btn-default btn-tambah">Tambah Kendaraan</button>
		<table class="table">
			<thead>
				<tr>
					<td>No.</td>
					<td>Nomor Kendaraan</td>
					<td>Nama Kendaraan</td>
					<td>Ketersediaan</td>
					<td>Jumlah Transaksi</td>
					<td>Keterangan</td>
					<td>Status</td>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
</div>
</div>
</div>


<script type="text/javascript">
$(function() {
	$(".btn-tambah").on("click", function() {
		showDialog(".dialog-tambah");
	});
	
	$(".dialog-background").on("click", function(e) {
		if (e.target.className == "dialog-background") {
			closeDialog();
		}
	});
});
</script>