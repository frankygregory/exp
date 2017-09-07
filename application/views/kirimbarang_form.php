<div id="page-wrapper">

<div class="container-fluid">

<div class="page-title">Kirim Barang</div>

<div id="successResult"></div>
<div id="errorResult" class="has-error"></div>
<form role="form" id="kirimForm" name="kirimForm" method="post" action="<?= site_url('kirim/dokirimbarang') ?>"
      enctype="multipart/form-data">
	<input type="hidden" id="type" name="type" value="<?= $type ?>">
	<input type="hidden" name="id" value="<?= $id ?>">
	
	<div class="content">
		<div class="section-1">
			<div class="form-header">
				<div class="form-item">
					<div class="form-item-label">Judul Kiriman</div>
					<div class="form-item-input-group">
						<input type="text" name="shipment_title" class="input-judul" value="<?= $shipment_title ?>" />
						<div class="error"></div>
					</div>
				</div>
				<div class="form-item">
					<div class="form-item-label">Keterangan</div>
					<div class="form-item-input-group">
						<textarea rows="6" name="shipment_information" class="input-keterangan" ><?= $shipment_information ?></textarea>
						<div class="error"></div>
					</div>
				</div>
				<div class="form-item">
					<div class="form-item-label">Foto Barang</div>
					<div class="form-item-input-group">
						<div class="error"></div>
						<input type="file" class="input-gambar" name="shipment_pictures" accept="image/jpeg, image/png" />
						<input type="hidden" class="input-gambar-nama" name="shipment_pictures_name" value="<?= $shipment_pictures ?>" />
					</div>
				</div>
			</div>
			<div class="image-preview-container">
				<img class="image-preview" />
			</div>
		</div>
		<div class="section-2">
			<div class="section-asal">
				<div class="section-title">
					1 | Tentukan Lokasi Asal
				</div>
				<div class="section-asal-form">
					<div class="form-item">
						<div class="form-item-label">Lokasi Asal
							<a class="saved-location" data-fromto="location_from">Pilih Lokasi yang sudah didaftarkan</a>
							<div class="saved-location-container">
							</div>
						</div>
						<div class="form-item-error"></div>
						<input type="text" class="" id="location_from_address" name="location_from_address" value="<?= $location_from_address ?>" />
						<div class="error"></div>
						<input type="hidden" name="location_from_name" id="location_from_name" value="" />
						<input type="hidden" name="location_from_city" id="location_from_city" value="" />
					</div>
					<div class="form-item">
						<div class="form-item-label">Detail Lokasi</div>
						<textarea rows="3" class="input-asal-detail" name="location_from_detail" id="location_from_detail" ></textarea>
						<div class="error"></div>
					</div>
					<div class="form-item">
						<div class="form-item-label">Kontak</div>
						<input type="text" class="input-asal-kontak" name="location_from_contact" id="location_from_contact" value="<?= $location_from_contact ?>" />
						<div class="error"></div>
					</div>
					<div class="form-item">
						<div class="form-item-label">Peta Lokasi</div>
						<div class="form-group" id="map_asal" style="width: 100%; height: 200px"></div>
						<input type="hidden" id="location_from_latlng" name="location_from_latlng" value="" />
					</div>
				</div>
			</div>
			<div class="section-tujuan">
				<div class="section-title">
					2 | Tentukan Lokasi Tujuan
				</div>
				<div class="section-tujuan-form">
					<div class="form-item">
						<div class="form-item-label">Lokasi Tujuan
							<a class="saved-location" data-fromto="location_to">Pilih Lokasi yang sudah didaftarkan</a>
							<div class="saved-location-container">	
							</div>
						</div>
						<input type="text" class="" id="location_to_address" name="location_to_address" value="<?= $location_to_address ?>" />
						<div class="error"></div>
						<input type="hidden" name="location_to_name" id="location_to_name" value="" />
						<input type="hidden" name="location_to_city" id="location_to_city" value="" />
					</div>
					<div class="form-item">
						<div class="form-item-label">Detail Lokasi</div>
						<textarea rows="3" class="input-tujuan-detail" name="location_to_detail" id="location_to_detail" ></textarea>
						<div class="error"></div>
					</div>
					<div class="form-item">
						<div class="form-item-label">Kontak</div>
						<input type="text" class="input-tujuan-kontak" name="location_to_contact" id="location_to_contact" value="<?= $location_to_contact ?>" />
						<div class="error"></div>
					</div>
					<div class="form-item">
						<div class="form-item-label">Peta Lokasi</div>
						<div class="form-group" id="map_tujuan" style="width: 100%; height: 200px"></div> 
						<input type="hidden" id="location_to_latlng" name="location_to_latlng" value="" />
					</div>
				</div>
			</div>
			<input type="hidden" id="shipment_length" name="shipment_length" value="" />
		</div>
		<div class="section-4">
			<div class="section-title">3 | List Barang</div>
			<div class="section-4-content">
				<input type="hidden" class="detail-count" name="detail-count" value="0" />
				<table class="section-4-table table">
					<thead>
						<tr>
							<td>Nama</td>
							<td>Qty</td>
							<td>Deskripsi</td>
							<td>Dimensi</td>
							<td>Kubikasi</td>
							<td>Berat</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<div class="error"></div>
		</div>
		<button type="button" class="btn-positive btn-show-tambah-barang">Tambah Barang</button>
		<div class="section-3">
			<div class="section-title">Tambah Barang</div>
			<div class="section-3-content">
				<div class="form-item form-nama-barang">
					<div class="form-item-label">Nama Barang
						<div class="error" data-type="nama"></div>
					</div>
					
					<input type="text" class="input-nama-barang" name="item_name" />
				</div>
				<div class="form-item form-qty-barang">
					<div class="form-item-label">Qty
						<div class="error" data-type="qty"></div>
					</div>
					<input type="text" class="input-qty-barang" name="item_qty" data-type="number" maxlength="11" />
				</div>
				<div class="form-item form-deskripsi-barang">
					<div class="form-item-label">Deskripsi Barang
						<div class="error" data-type="deskripsi"></div>
					</div>
					<textarea rows="3" class="input-deskripsi-barang" name="item_desc" ></textarea>
				</div>
				<div class="pilihan-pengisian">
					<div class="pilihan-pengisian-judul">Pilihan Pengisian : </div>
					<label class="pilihan-pengisian-label">
						<input type="radio" name="pilihan-pengisian" class="pilihan-pengisian-1" data-value="1" checked />
						<span class="pilihan-pengisian-text"> Dimensi dan Berat</span>
					</label>
					<label class="pilihan-pengisian-label">
						<input type="radio" name="pilihan-pengisian" class="pilihan-pengisian-2" data-value="2" />
						<span class="pilihan-pengisian-text"> Kubikasi dan Berat</span>
					</label>
					<label class="pilihan-pengisian-label">
						<input type="radio" name="pilihan-pengisian" class="pilihan-pengisian-3" data-value="3" />
						<span class="pilihan-pengisian-text"> Kubikasi saja</span>
					</label>
					<label class="pilihan-pengisian-label">
						<input type="radio" name="pilihan-pengisian" class="pilihan-pengisian-4" data-value="4" />
						<span class="pilihan-pengisian-text"> Berat saja</span>
					</label>
				</div>
				<div class="pilihan-container">
					<div class="pilihan-dimensi pilihan" data-checked="1">
						<label class="label-pilihan">Dimensi</label>
						<div class="pilihan-content">
							<div class="form-item form-panjang-barang">
								<div class="form-item-label">Panjang</div>
								<input type="text" name="" class="input-panjang-barang" data-type="number" maxlength="11" />
							</div>
							<div class="form-item form-lebar-barang">
								<div class="form-item-label">Lebar</div>
								<input type="text" name="" class="input-lebar-barang" data-type="number" maxlength="11" />
							</div>
							<div class="form-item form-tinggi-barang">
								<div class="form-item-label">Tinggi</div>
								<input type="text" name="" class="input-tinggi-barang" data-type="number" maxlength="11" />
							</div>
							<div class="form-item form-satuan-dimensi-barang">
								<div class="form-item-label">Satuan</div>
								<select name="satuan-dimensi-barang" class="input-satuan-dimensi-barang">
									<option value="cm">Cm</option>
									<option value="m">M</option>
								</select>
							</div>
						</div>
						<div class="error" data-type="dimensi"></div>
					</div>
					<div class="pilihan-kubikasi pilihan">
						<label class="label-pilihan">Kubikasi</label>
						<div class="pilihan-content">
							<div class="form-item form-kubikasi-barang">
								<div class="form-item-label">Kubikasi</div>
								<input type="text" name="" class="input-kubikasi-barang" data-type="number" maxlength="11" />
							</div>
							<div class="form-item form-satuan-kubikasi-barang">
								<div class="form-item-label">Satuan</div>
								<select name="satuan-kubikasi-barang" class="input-satuan-kubikasi-barang">
									<option value="cm3">Cm&sup3</option>
									<option value="m3">M&sup3</option>
								</select>
							</div>
						</div>
						<div class="error" data-type="kubikasi"></div>
					</div>
					<div class="pilihan-berat pilihan" data-checked="1">
						<label class="label-pilihan">Berat</label>
						<div class="pilihan-content">
							<div class="form-item form-berat-barang">
								<div class="form-item-label">Berat</div>
								<input type="text" name="" class="input-berat-barang" data-type="number" maxlength="11" />
							</div>
							<div class="form-item form-satuan-berat-barang">
								<div class="form-item-label">Satuan</div>
								<select name="satuan-berat-barang" class="input-satuan-berat-barang">
									<option value="kg">Kg</option>
									<option value="ton">Ton</option>
								</select>
							</div>
						</div>
						<div class="error" data-type="berat"></div>
					</div>
				</div>
			</div>
			<div class="section-3-buttons">
				<button type="button" class="section-btn btn-positive btn-tambah-item" onclick="addItem()">Masukkan ke List Barang</button>
				<button type="button" class="section-btn btn-neutral btn-reset" onclick="clearTambahBarang()">Reset</button>
			</div>
		</div>
		
		<div class="section-5">
			<div class="section-title">4 | Tentukan Tanggal</div>
			<div class="section-5-content">
				<div class="section-5-left">
					<div class="form-item form-tanggal-kirim-awal">
						<div class="form-item-label">Tanggal Kirim</div>
						<input type="text" name="tanggal-kirim-awal" class="input-tanggal-kirim-awal" placeholder="" />
						<div class="error"></div>
					</div>
					<div class="form-item form-tanggal-kirim-akhir">
						<div class="form-item-label">sampai dengan</div>
						<input type="text" name="tanggal-kirim-akhir" class="input-tanggal-kirim-akhir" placeholder="" />
						<div class="error"></div>
					</div>
					<div class="form-item form-deadline">
						<div class="form-item-label">Berakhir tanggal</div>
						<input type="text" name="tanggal-deadline" class="input-tanggal-deadline" placeholder="" />
						<div class="error"></div>
					</div>
				</div>
				<div class="section-5-right">
					<div class="form-item form-item-harga">
						<div class="form-item-label">Harga yang ditawarkan</div>
						<input type="text" name="shipment_price" class="input-harga" data-type="number" maxlength="11" /><span>IDR<span>
					</div>
					<div class="form-item">
						<div class="form-item-label">Tipe Penawaran</div>
						<label class="label-shipment-type">
							<input type="radio" class="radio-shipment-type" name="shipment_type" value="1" checked="checked" data-text="Terbuka" /> <span>Terbuka</span>
						</label>
						<label class="label-shipment-type">
							<input type="radio" class="radio-shipment-type" name="shipment_type" value="2" data-text="Tertutup" /> <span>Tertutup</span>
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="buttons">
			<button class="section-btn btn-submit" type="button">Submit</button>
		</div>
	</div>
</form>
<div class="dialog-background">
	<div class="dialog dialog-konfirmasi-submit">
		<div class="dialog-header">
			<div class="dialog-header-close-btn" style="background-image: url(<?php echo base_url("assets/icons/close_icon.svg"); ?>);"></div>
			<div class="dialog-title">Konfirmasi</div>
		</div>
		<div class="dialog-body">
			<div class="dialog-item">
				<div class="dialog-label">Judul</div>
				<div class="dialog-value" data-label="judul"></div>
			</div>
			<div class="dialog-item">
				<div class="dialog-label">Keterangan</div>
				<div class="dialog-value" data-label="keterangan"></div>
			</div>
			<div class="dialog-item">
				<div class="dialog-label">Foto</div>
				<div class="dialog-value" data-label="foto"><img class="dialog-image" /></div>
			</div>
			<div class="dialog-item-section">Lokasi Asal</div>
			<div class="dialog-item">
				<div class="dialog-label">Nama Lokasi</div>
				<div class="dialog-value" data-label="nama-lokasi-asal"></div>
			</div>
			<div class="dialog-item">
				<div class="dialog-label">Detail Lokasi</div>
				<div class="dialog-value" data-label="detail-lokasi-asal"></div>
			</div>
			<div class="dialog-item">
				<div class="dialog-label">Kontak</div>
				<div class="dialog-value" data-label="kontak-asal"></div>
			</div>
			<div class="dialog-item-section">Lokasi Tujuan</div>
			<div class="dialog-item">
				<div class="dialog-label">Nama Lokasi</div>
				<div class="dialog-value" data-label="nama-lokasi-tujuan"></div>
			</div>
			<div class="dialog-item">
				<div class="dialog-label">Detail Lokasi</div>
				<div class="dialog-value" data-label="detail-lokasi-tujuan"></div>
			</div>
			<div class="dialog-item">
				<div class="dialog-label">Kontak</div>
				<div class="dialog-value" data-label="kontak-tujuan"></div>
			</div>
			<div class="dialog-item-section">Tanggal</div>
			<div class="dialog-item">
				<div class="dialog-label">Tanggal Kirim</div>
				<div class="dialog-value" data-label="tanggal-kirim"></div>
			</div>
			<div class="dialog-item">
				<div class="dialog-label">Sampai Dengan</div>
				<div class="dialog-value" data-label="sampai-dengan"></div>
			</div>
			<div class="dialog-item">
				<div class="dialog-label">Berakhir Tanggal</div>
				<div class="dialog-value" data-label="berakhir-tanggal"></div>
			</div>
			<div class="dialog-item">
				<div class="dialog-label">Harga</div>
				<div class="dialog-value" data-label="harga"></div>
			</div>
			<div class="dialog-item">
				<div class="dialog-label">Tipe Penawaran</div>
				<div class="dialog-value" data-label="tipe-penawaran"></div>
			</div>
			<div class="dialog-item-section">Group</div>
			<div class="dialog-item">
				<div class="dialog-label dialog-label-sebagai-group">Sebagai Group</div>
				<div class="dialog-value">
					<select class="select-group"></select>
				</div>
			</div>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-submit">Submit</button>
			<button type="button" class="btn-neutral btn-batal">Batal</button>
		</div>
	</div>
</div>
<script>
var getGroupIdsUrl = "<?php echo base_url("kirim/getGroupIds"); ?>";
var toggleSavedLocationUrl = "<?php echo base_url("kirim/getSavedLocation"); ?>";
var type = $("#type").val();
var url;
var error = {
	nama: "", qty: "", deskripsi: "", dimensi: "", kubikasi: "", berat: ""
};

var location_from_address = {
	autocomplete_clicked: false,
	changed: false
}

var location_to_address = {
	autocomplete_clicked: false,
	changed: false
}

var geocoder;
</script>
<script src="<?php echo base_url("assets/panel/js/kirimbarang_form.js?v=1"); ?>" defer></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBxOH8f5gil4RYVBIwPCZQ197euUsnnyUo&callback=initMap&libraries=geometry,places&language=id-ID" defer></script>
</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->