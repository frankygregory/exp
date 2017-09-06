<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="dialog-background">
	<div class="dialog dialog-tambah">
		<div class="dialog-header">
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title">Tambah Driver</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama Driver</td>
						<td>
							<input type="text" class="input-nama" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Alamat Driver</td>
						<td>
							<input type="text" class="input-alamat" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">No. HP</td>
						<td>
							<input type="text" class="input-hp" maxlength="12" />
							<div class="error"></div>
						</td>
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
			<button type="button" class="btn-default btn-submit-tambah">Tambah</button>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-edit">
		<div class="dialog-header">
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title">Edit Driver</div>
		</div>
		<div class="dialog-body">
			<table>
				<tbody>
					<tr>
						<td class="">Nama Driver</td>
						<td>
							<input type="text" class="input-nama" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">Alamat Driver</td>
						<td>
							<input type="text" class="input-alamat" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="">No. HP</td>
						<td>
							<input type="text" class="input-hp" maxlength="12" />
							<div class="error"></div>
						</td>
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
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title">Delete Driver</div>
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
		<button type="button" class="btn-default btn-tambah">Tambah Driver</button>
		<div class="table-container">
			<table class="table table-driver">
				<thead>
					<tr>
						<td class="th-no" data-col="no">No.</td>
						<td data-col="nama-driver">Nama Driver</td>
						<td data-col="no-hp">No. HP</td>
						<td data-col="alamat">Alamat</td>
						<td class="th-ketersediaan" data-col="ketersediaan">Ketersediaan</td>
						<td class="th-rating" data-col="rating">Rating</td>
						<td class="th-jumlah-transaksi" data-col="jumlah-transaksi">Jumlah Transaksi</td>
						<td data-col="keterangan">Keterangan</td>
						<td class="th-status" data-col="status">Status</td>
						<td class="th-action" data-col="action">Action</td>
					</tr>
				</thead>
				<tbody class="tbody-supir">
				
				</tbody>
			</table>
			<div class="table-empty-state">Anda belum menambahkan driver</div>
		</div>
	</div>
</div>
</div>
</div>

<script type="text/javascript">
var deleteSupirUrl = "<?php echo base_url("supir/deleteSupir"); ?>";
var updateSupirUrl = "<?php echo base_url("supir/updateSupir"); ?>";
var tambahSupirUrl = "<?php echo base_url("supir/tambahSupir"); ?>";
var getSupirUrl = "<?php echo base_url("supir/getSupir"); ?>";
var shipmentUrl = "<?php echo base_url("kirim/detail/"); ?>";
</script>
<script src="<?php echo base_url("assets/panel/js/supir.js"); ?>" defer></script>