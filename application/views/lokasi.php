<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="dialog-background">
	<div class="dialog dialog-tambah">
		<div class="dialog-header">
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title"></div>
		</div>
		<div class="dialog-body">
			<table class="table-tambah-lokasi">
				<tbody>
					<tr>
						<td class="td-label">Nama Lokasi</td>
						<td>
							<input type="text" class="input-nama" id="location_address" />
							<div class="error"></div>
							<input type="hidden" name="location_name" id="location_name" value="" />
							<input type="hidden" name="location_city" id="location_city" value="" />
						</td>
					</tr>
					<tr>
						<td></td>
						<td class="td-map">
							<div id="map" style="width: 100%; height: 200px"></div>
							<input type="hidden" id="location_latlng" name="location_latlng" value="" />
						</td>
					</tr>
					<tr>
						<td class="td-label">Detail Lokasi</td>
						<td>
							<textarea class="input-detail" id="location_detail"></textarea>
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="td-label">Kontak</td>
						<td>
							<input type="text" class="input-kontak" id="location_contact" />
							<div class="error"></div>
						</td>
					</tr>
					<tr>
						<td class="td-label">Jenis</td>
						<td>
							<label class="label-asal">
								<input type="checkbox" class="input-asal" id="location_from" checked="checked" /> Asal
							</label class="label-tujuan">
							<label>
								<input type="checkbox" class="input-tujuan" id="location_to" checked="checked" /> Tujuan
							</label>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-tambah">Tambah</button>
			<button type="button" class="btn-default btn-submit-edit">Simpan</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
<div class="dialog-background">
	<div class="dialog dialog-konfirmasi-delete">
		<div class="dialog-header">
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title">Delete Lokasi</div>
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
		<button type="button" class="btn-default btn-tambah">Tambah Lokasi</button>
		<div class="table-container">
			<table class="table table-lokasi">
				<thead>
					<tr>
						<td data-col='no' data-align='center'>No.</td>
						<td data-col='nama-lokasi'>Nama Lokasi</td>
						<td data-col='lokasi-google-map'>Lokasi Google Map</td>
						<td data-col='detail-lokasi'>Detail Lokasi</td>
						<td data-col='kontak'>Kontak</td>
						<td data-col='asal' data-align='center'>Asal</td>
						<td data-col='tujuan' data-align='center'>Tujuan</td>
						<td data-col='action' data-align='center'>Action</td>
					</tr>
				</thead>
				<tbody class="tbody-lokasi">
				
				</tbody>
			</table>
			<div class="table-empty-state">Anda belum menambahkan lokasi</div>
		</div>
	</div>
</div>
</div>
</div>

<script src="<?php echo base_url("assets/panel/js/lokasi.js"); ?>" defer></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBxOH8f5gil4RYVBIwPCZQ197euUsnnyUo&callback=initMap&libraries=places" async defer></script>