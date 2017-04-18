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
						<div class="form-item-error"></div>
						<input type="text" name="shipment_title" class="input-judul" value="<?= $shipment_title ?>" />
					</div>
				</div>
				<div class="form-item">
					<div class="form-item-label">Keterangan</div>
					<div class="form-item-input-group">
						<div class="form-item-error"></div>
						<textarea rows="6" name="shipment_information" class="input-keterangan" ><?= $shipment_information ?></textarea>
					</div>
				</div>
				<div class="form-item">
					<div class="form-item-label">Foto Barang</div>
					<div class="form-item-input-group">
						<div class="form-item-error"></div>
						<input type="file" class="input-gambar" name="shipment_pictures" />
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
						<div class="form-item-label">Lokasi Asal <a class="saved-location">Pilih Lokasi yang sudah didaftarkan</a></div>
						<div class="form-item-error"></div>
						<input type="text" class="" id="location_from_address" name="location_from_address" value="<?= $location_from_address ?>" />
						<input type="hidden" name="location_from_name" id="location_from_name" value="" />
					</div>
					<div class="form-item">
						<div class="form-item-label">Detail Lokasi</div>
						<div class="form-item-error"></div>
						<textarea rows="3" class="input-asal-detail" name="location_from_detail" ></textarea>
					</div>
					<div class="form-item">
						<div class="form-item-label">Kontak</div>
						<div class="form-item-error"></div>
						<input type="text" class="input-asal-kontak" name="location_from_contact" value="<?= $location_from_contact ?>" />
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
						<div class="form-item-label">Lokasi Tujuan <a class="saved-location">Pilih Lokasi yang sudah didaftarkan</a></div>
						<div class="form-item-error"></div>
						<input type="text" class="" id="location_to_address" name="location_to_address" value="<?= $location_to_address ?>" />
						<input type="hidden" name="location_to_name" id="location_to_name" value="" />
					</div>
					<div class="form-item">
						<div class="form-item-label">Detail Lokasi</div>
						<div class="form-item-error"></div>
						<textarea rows="3" class="input-tujuan-detail" name="location_to_detail" ></textarea>
					</div>
					<div class="form-item">
						<div class="form-item-label">Kontak</div>
						<div class="form-item-error"></div>
						<input type="text" class="input-tujuan-kontak" name="location_to_contact" value="<?= $location_to_contact ?>" />
					</div>
					<div class="form-item">
						<div class="form-item-label">Peta Lokasi</div>
						<div class="form-group" id="map_tujuan" style="width: 100%; height: 200px"></div> 
						<input type="hidden" id="location_to_latlng" name="location_to_latlng" value="" />
					</div>
				</div>
			</div>
		</div>
		<div class="section-3">
			<div class="section-title">3 | Tambah Barang</div>
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
				<div class="form-item">
					<div class="form-item-label">Deskripsi Barang
						<div class="error" data-type="deskripsi"></div>
					</div>
					<textarea rows="3" class="input-deskripsi-barang" name="item_desc" ></textarea>
				</div>
				<div class="pilihan-container">
					<div class="pilihan-dimensi pilihan">
						<label class="label-pilihan">
							<input type="radio" name="pilihan" value="dimensi" checked="checked"/> Dimensi
						</label>
						<div class="pilihan-content">
							<div class="form-item form-panjang-barang">
								<div class="form-item-label">Panjang</div>
								<input type="text" name="" class="input-panjang-barang" data-type="number" maxlength="11" />
								<div class="error" data-type="panjang"></div>
							</div>
							<div class="form-item form-lebar-barang">
								<div class="form-item-label">Lebar</div>
								<input type="text" name="" class="input-lebar-barang" data-type="number" maxlength="11" />
								<div class="error" data-type="lebar"></div>
							</div>
							<div class="form-item form-tinggi-barang">
								<div class="form-item-label">Tinggi</div>
								<input type="text" name="" class="input-tinggi-barang" data-type="number" maxlength="11" />
								<div class="error" data-type="tinggi"></div>
							</div>
							<div class="form-item form-satuan-dimensi-barang">
								<div class="form-item-label">Satuan</div>
								<select name="satuan-dimensi-barang" class="input-satuan-dimensi-barang">
									<option value="cm">Cm</option>
									<option value="m">M</option>
								</select>
							</div>
						</div>
					</div>
					<div class="pilihan-kubikasi pilihan">
						<label class="label-pilihan">
							<input type="radio" name="pilihan" value="kubikasi" /> Kubikasi
						</label>
						<div class="pilihan-content">
							<div class="form-item form-kubikasi-barang">
								<div class="form-item-label">Kubikasi</div>
								<input type="text" name="" class="input-kubikasi-barang" data-type="number" maxlength="11" />
								<div class="error" data-type="kubikasi"></div>
							</div>
							<div class="form-item form-satuan-kubikasi-barang">
								<div class="form-item-label">Satuan</div>
								<select name="satuan-kubikasi-barang" class="input-satuan-kubikasi-barang">
									<option value="cm3">Cm3</option>
									<option value="m3">M3</option>
								</select>
							</div>
						</div>
					</div>
					<div class="pilihan-berat pilihan">
						<label class="label-pilihan">
							<input type="radio" name="pilihan" value="berat" /> Berat
						</label>
						<div class="pilihan-content">
							<div class="form-item form-berat-barang">
								<div class="form-item-label">Berat</div>
								<input type="text" name="" class="input-berat-barang" data-type="number" maxlength="11" />
								<div class="error" data-type="berat"></div>
							</div>
							<div class="form-item form-satuan-berat-barang">
								<div class="form-item-label">Satuan</div>
								<select name="satuan-berat-barang" class="input-satuan-berat-barang">
									<option value="kg">Kg</option>
									<option value="ton">Ton</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="section-3-buttons">
				<button type="button" class="section-btn btn-tambah-item" onclick="addItem()">Tambah Item</button>
				<button type="button" class="section-btn btn-reset">Reset</button>
			</div>
		</div>
		<div class="section-4">
			<div class="section-title">4 | List Barang</div>
			<div class="section-4-content">
				<input type="hidden" class="detail-count" name="detail-count" value="0" />
				<table class="section-4-table">
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
		</div>
		<div class="section-5">
			<div class="section-title">5 | Tanggal</div>
			<div class="section-5-content">
				<div class="section-5-left">
					<div class="form-item form-tanggal-kirim-awal">
						<div class="form-item-label">Tanggal Kirim</div>
						<input type="text" name="tanggal-kirim-awal" class="input-tanggal-kirim-awal" placeholder="" />
						
					</div>
					<div class="form-item form-tanggal-kirim-akhir">
						<div class="form-item-label">sampai dengan</div>
						<input type="text" name="tanggal-kirim-akhir" class="input-tanggal-kirim-akhir" placeholder="" />
						
					</div>
					<div class="form-item form-deadline">
						<div class="form-item-label">Berakhir tanggal</div>
						<input type="text" name="tanggal-deadline" class="input-tanggal-deadline" placeholder="" />
						
					</div>
				</div>
				<div class="section-5-right">
					<div class="form-item form-item-harga">
						<div class="form-item-label">Harga</div>
						<input type="text" name="shipment_price" class="input-harga" data-type="number" maxlength="11" />
					</div>
					<div class="form-item">
						<div class="form-item-label">Cara Pemesanan</div>
						<label>
							<input type="radio" class="" name="order_type" value="1" checked="checked" /> Penawaran
						</label>
						<label>
							<input type="radio" class="" name="order_type" value="2" /> Pesan secara instan
						</label>
					</div>
					<div class="form-item">
						<div class="form-item-label">Tipe Penawaran</div>
						<label>
							<input type="radio" class="" name="shipment_type" value="1" checked="checked" /> Public
						</label>
						<label>
							<input type="radio" class="" name="shipment_type" value="2" /> Private
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="buttons">
			<button class="section-btn btn-submit">Submit</button>
		</div>
	</div>
</form>
<script type="text/javascript" src=""></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBxOH8f5gil4RYVBIwPCZQ197euUsnnyUo&callback=initMap&libraries=places" async defer></script>
<script>
   var type = $("#type").val();
   var url;
   var error = {
		nama: "", qty: "", deskripsi: "", panjang: "", lebar: "", tinggi: "", kubikasi: "", berat: ""
   };
   
$(function() {
	$(".input-gambar").on("change", function() {
		var reader = new FileReader();
		reader.onload = function(e) {
			$(".image-preview").attr("src", e.target.result);
		};
		reader.readAsDataURL($(this)[0].files[0]);
	});
	
	$("input[data-type='number']").on("keydown", function(e) {
		isNumber(e);
	});
	
	$("#kirimForm").on("submit", function() {
		var from_latlng = $("#location_from_latlng").val();
	});
	
	$( ".input-tanggal-kirim-awal, .input-tanggal-kirim-akhir, .input-tanggal-deadline" ).datepicker({
		dateFormat: "yy-mm-dd"
	});

});
	
	function addItem() {
		valid = true;
		clearAllErrors();
		
		var nama = $(".input-nama-barang").val();
		var qty = $(".input-qty-barang").val();
		var deskripsi = $(".input-deskripsi-barang").val();
		var panjang, lebar, tinggi, dimensi_satuan, kubikasi, kubikasi_satuan, berat, berat_satuan;
		var select_dimensi = "", select_kubikasi = "", select_berat = "";
		
		if (nama == "") {
			error.nama = "Nama harus diisi";
			valid = false;
		}
		if (qty == "") {
			error.qty = "Qty harus diisi";
			valid = false;
		}
		if (deskripsi == "") {
			error.deskripsi = "Deskripsi harus diisi";
			valid = false;
		}
		
		var checked = $("input[name='pilihan']:checked").val();
		switch (checked) {
			case "dimensi":
				panjang = $(".input-panjang-barang").val();
				lebar = $(".input-lebar-barang").val();
				tinggi = $(".input-tinggi-barang").val();
				dimensi_satuan = $(".input-satuan-dimensi-barang").val();
				select_dimensi = panjang + " " + dimensi_satuan + "<br>" + lebar + " " + dimensi_satuan + "<br>" + tinggi + " " + dimensi_satuan;
				
				if (panjang == "") {
					valid = false;
					error.panjang = "Panjang harus diisi";
				}
				if (lebar == "") {
					valid = false;
					error.lebar = "Lebar harus diisi";
				}
				if (tinggi == "") {
					valid = false;
					error.tinggi = "Tinggi harus diisi";
				}
				
				break;
			case "kubikasi":
				kubikasi = $(".input-kubikasi-barang").val();
				kubikasi_satuan = $(".input-satuan-kubikasi-barang").val();
				select_kubikasi = kubikasi + " " + kubikasi_satuan;
				if (kubikasi == "") {
					valid = false;
					error.kubikasi = "Kubikasi harus diisi";
				}
				break;
			case "berat":
				berat = $(".input-berat-barang").val();
				berat_satuan = $(".input-satuan-berat-barang").val();
				select_berat = berat + " " + berat_satuan;
				if (berat == "") {
					valid = false;
					error.berat = "Berat harus diisi";
				}
				break;
		}
		
		showErrors();
		
		if (valid) {
			var count = parseInt($(".detail-count").val());
			
			var input_nama = "<input type='hidden' value='" + nama + "' name='item-name-" + count + "' />";
			var input_qty = "<input type='hidden' value='" + qty + "' name='item-qty-" + count + "' />";
			var input_deskripsi = "<input type='hidden' value='" + deskripsi + "' name='item-deskripsi-" + count + "' />";
			
			var input_panjang = "", input_lebar = "", input_tinggi = "", input_dimensi_satuan = "", input_kubikasi = "", input_kubikasi_satuan = "", input_berat = "", input_berat_satuan = "";
			
			if (select_dimensi != "") {
				input_panjang = "<input type='hidden' value='" + panjang + "' name='item-panjang-" + count + "' />";
				input_lebar = "<input type='hidden' value='" + lebar + "' name='item-lebar-" + count + "' />";
				input_tinggi = "<input type='hidden' value='" + tinggi + "' name='item-tinggi-" + count + "' />";
				input_dimensi_satuan = "<input type='hidden' value='" + dimensi_satuan + "' name='item-dimensi-satuan-" + count + "' />";
			} else if (select_kubikasi != "") {
				input_kubikasi = "<input type='hidden' value='" + kubikasi + "' name='item-kubikasi-" + count + "' />";
				input_kubikasi_satuan = "<input type='hidden' value='" + kubikasi_satuan + "' name='item-kubikasi-satuan-" + count + "' />";
			} else {
				input_berat = "<input type='hidden' value='" + berat + "' name='item-berat-" + count + "' />";
				input_berat_satuan = "<input type='hidden' value='" + berat_satuan + "' name='item-berat-satuan-" + count + "' />";
			}
			
			$(".section-4-table tbody").append("<tr><td>" + nama + input_nama + "</td><td>" + qty + input_qty + "</td><td>" + deskripsi + input_deskripsi + "</td><td>" + select_dimensi + input_panjang + input_lebar + input_tinggi + input_dimensi_satuan + "</td><td>" + select_kubikasi + input_kubikasi + input_kubikasi_satuan + "</td><td>" + select_berat + input_berat + input_berat_satuan + "</td><td></td></tr>");
			
			$(".detail-count").val((count + 1));
		}
	}
	
	function clearAllErrors() {
		error.nama = "";
		error.qty = "";
		error.deskripsi = "";
		error.panjang = "";
		error.lebar = "";
		error.tinggi = "";
		error.kubikasi = "";
		error.berat = "";
	}
	
	function showErrors() {
		$(".error[data-type='nama']").html(error.nama);
		$(".error[data-type='qty']").html(error.qty);
		$(".error[data-type='deskripsi']").html(error.deskripsi);
		$(".error[data-type='panjang']").html(error.panjang);
		$(".error[data-type='lebar']").html(error.lebar);
		$(".error[data-type='tinggi']").html(error.tinggi);
		$(".error[data-type='kubikasi']").html(error.kubikasi);
		$(".error[data-type='berat']").html(error.berat);
	}
	
	function isNumber(e) {
		if ((e.which >= 65 && e.which <= 90) || e.which >= 186) {
			e.preventDefault();
		}
	}

    /*function doKirim() {
	
		if(type == "new"){
			url = "<?=site_url('kirim/dokirimbarang')?>";
		}else if(type == "edit"){
			url = "<?=site_url('kirim/updatekirimbarang')?>";
		}
	
        var formData = new FormData($("#kirimForm")[0]);
        $("#btnSave").text('Proses...');

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                if (data.status) {
					$('#successResult').append(data.msg);
                } else {
                    $('#errorResult').append(data.error);
                }

                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Penyimpanan data gagal.');
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable

            }
        });
		
    }

    function editItems(id, div){
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#'+div).text("Process..");

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('panel/kirim/ajaxLoad')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('[name="shipment_id"]').val(data.shipment_id);
                $('[name="shipment_details_id"]').val(data.shipment_details_id);
                $('[name="item_name"]').val(data.item_name);
                $('[name="item_desc"]').val(data.item_desc);
                $('[name="item_length"]').val(data.item_length);
                $('[name="item_width"]').val(data.item_width);
                $('[name="item_height"]').val(data.item_height);
                $('[name="item_dimension_unit"]').val(data.item_dimension_unit);
                $('[name="item_cubic"]').val(data.item_kubikasi);
                $('[name="item_kubikasi_unit"]').val(data.item_kubikasi_unit);
                $('[name="item_weight"]').val(data.item_weight);
                $('[name="item_weight_unit"]').val(data.item_weight_unit);
                $('[name="item_qty"]').val(data.item_qty);
                $('#modal_form').modal('show'); 
                $('.modal-title').text('Ubah Items'); 
                $('#'+div).text("Edit");
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error dalam mengunduh data');
            }
        });
    }

    function updateItems(){
        var url = "<?=site_url('kirim/update-items')?>";
        $("#btnUpdate").text('Mengupdate...');

        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                if (data.status) {
                    $('#modal_form').modal('hide');
                    editData($('#shipment_id').val());
                } else {
                    alert('Penyimpanan data gagal, cek isian item');
                }

                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Penyimpanan data gagal.');
                $('#btnSave').attr('disabled', false); //set button enable

            }
        });
    }*/

    var map_asal,map_tujuan;
    var marker_asal,marker_tujuan;
	var autocomplete_asal, autocomplete_tujuan;
    var center_from = {lat: 0, lng: 0};
    var center_to = {lat: 0, lng: 0};//{lat: -7.2653524, lng: 112.7454884};

    function updatePosition(div, lat, lng) {
        $("#"+div).val(lat.toFixed(4)+', '+lng.toFixed(4));
    }

    function initialize() {
        input = document.getElementById('location_from_address');
        autocomplete_asal = new google.maps.places.Autocomplete(input);
        input = document.getElementById('location_to_address');
        autocomplete_tujuan = new google.maps.places.Autocomplete(input);
		
		autocomplete_asal.addListener('place_changed', function() {
			var place = autocomplete_asal.getPlace();
			$("#location_from_name").val(place.name);
		});
		
		autocomplete_tujuan.addListener('place_changed', function() {
			var place = autocomplete_tujuan.getPlace();
			$("#location_to_name").val(place.name);
		});
    }

    function initMap() {
        latlng = "<?=$location_from_latlng;?>";
        if (latlng.length>0) {
            lat = latlng.substr(0,latlng.indexOf(",")-1)*1;
            lng = latlng.substr(latlng.indexOf(" ")+1)*1;
            center_from = {lat: lat, lng: lng};
        }

        latlng = "<?=$location_to_latlng;?>";
        if (latlng.length>0) {
            lat = latlng.substr(0,latlng.indexOf(",")-1)*1;
            lng = latlng.substr(latlng.indexOf(" ")+1)*1;
            center_to = {lat: lat, lng: lng};
        }

        map_asal = new google.maps.Map(document.getElementById('map_asal'), {
          center: center_from,
          streetViewControl: false,
          disableDefaultUI: true,
          zoom: 17
        });

        marker_asal = new google.maps.Marker({
            position: center_from,
            draggable: true,
            map: map_asal
        });

        google.maps.event.addListener(marker_asal, 'dragend', function () {
            map_asal.setCenter(this.getPosition()); // Set map center to marker position
            updatePosition("location_from_latlng",this.getPosition().lat(), this.getPosition().lng()); // update position display
            latlng = {lat: parseFloat(this.getPosition().lat()),lng: parseFloat(this.getPosition().lng())};
            var geocoder = new google.maps.Geocoder;
            geocoder.geocode({'location': latlng}, function(results, status) {
              if (status === 'OK') {
                if (results[1]) {
                  $("#location_from_address").val(results[0].formatted_address);
                } else {
                  window.alert('No results found');
                }
              } else {
                window.alert('Geocoder failed due to: ' + status);
              }
            });
        });

        map_tujuan = new google.maps.Map(document.getElementById('map_tujuan'), {
          center: center_to,
          streetViewControl: false,
          disableDefaultUI: true,
          zoom: 17
        });

        marker_tujuan = new google.maps.Marker({
            position: center_to,
            draggable: true,
            map: map_tujuan
        });

        google.maps.event.addListener(marker_tujuan, 'dragend', function () {
            map_tujuan.setCenter(this.getPosition()); // Set map center to marker position
            updatePosition("location_to_latlng",this.getPosition().lat(), this.getPosition().lng()); // update position display
            latlng = {lat: parseFloat(this.getPosition().lat()),lng: parseFloat(this.getPosition().lng())};
            var geocoder = new google.maps.Geocoder;
            geocoder.geocode({'location': latlng}, function(results, status) {
              if (status === 'OK') {
                if (results[1]) {
                  $("#location_to_address").val(results[0].formatted_address);
                } else {
                  window.alert('No results found');
                }
              } else {
                window.alert('Geocoder failed due to: ' + status);
              }
            });
        });

        updatePosition("location_from_latlng",center_from.lat,center_from.lng);
        updatePosition("location_to_latlng",center_to.lat,center_to.lng);
        google.maps.event.addDomListener(window, 'load', initialize);
    }

    function get_lat_long(mode,address) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'address': address}, function(results, status) {
            var lat = results[0].geometry.location.lat()*1;
            var lng = results[0].geometry.location.lng()*1;

            if (mode=="from") {
                $("#location_from_latlng").val(lat.toFixed(4)+", "+lng.toFixed(4));
                marker_asal.setPosition( new google.maps.LatLng(lat,lng) );
                map_asal.panTo( new google.maps.LatLng(lat,lng) );
            }
            else if (mode=="to") {
                $("#location_to_latlng").val(lat.toFixed(4)+", "+lng.toFixed(4));
                marker_tujuan.setPosition( new google.maps.LatLng(lat,lng) );
                map_tujuan.panTo( new google.maps.LatLng(lat,lng) );
            }
            //alert(lat+" and "+lng);
			
        });
    }

    $("#location_from_address").change(function() {
        get_lat_long('from',$(this).val());
    });

    $("#location_to_address").change(function() {
        get_lat_long('to',$(this).val());
    });

    $("#location_from_address").blur(function() {
        $("#location_from_address").change();
    });

    $("#location_to_address").blur(function() {
        $("#location_to_address").change();
    });

    $("#location_from_latlng").on("change",function() {
        latlng = $("#location_from_latlng").val();
        lat = substr(latlng,0,strpos(latlng,",")-1)*1;
        lng = substr(latlng,strpos(latlng," ")+1)*1;
        marker_asal.setPosition( new google.maps.LatLng(lat,lng) );
        map_asal.panTo( new google.maps.LatLng(lat,lng) );
    });

    $("#location_to_latlng").change(function() {
        latlng = $("#location_to_latlng").val();
        lat = substr(latlng,0,strpos(latlng,",")-1)*1;
        lng = substr(latlng,strpos(latlng," ")+1)*1;
        marker_tujuan.setPosition( new google.maps.LatLng(lat,lng) );
        map_tujuan.panTo( new google.maps.LatLng(lat,lng) );
    });

    $(".location_history").change(function() {
        str = $(this).val();
        sContact = str.substr(0,str.indexOf('###'));
        str = str.substr(str.indexOf('###')+3);
        sAddr = str.substr(0,str.indexOf('###'));
        str = str.substr(str.indexOf('###')+3);
        sDetail = str.substr(0,str.indexOf('###'));
        str = str.substr(str.indexOf('###')+3);
        sLat = str.substr(0,str.indexOf('###'));
        sLng = str.substr(str.indexOf('###')+3);

        if ($(this).attr('name')=='history_first_place') {
            $('#location_from_contact').val(sContact);
            $('#location_from_address').val(sAddr);
            $('#location_from_name').val(sDetail);
            $('#location_from_latlng').val(sLat+','+sLng);
            $("#location_from_address").change();
        }
        else if ($(this).attr('name')=='history_last_place') {
            $('#location_to_contact').val(sContact);
            $('#location_to_address').val(sAddr);
            $('#location_to_name').val(sDetail);
            $('#location_to_latlng').val(sLat+','+sLng);
            $("#location_to_address").change();
        }
    });
</script>

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->