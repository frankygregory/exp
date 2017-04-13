<div id="page-wrapper">

<div class="container-fluid">

<div class="page-title">
Kirim Barang
</div>

<div id="successResult"></div>
<div id="errorResult" class="has-error"></div>
<form role="form" id="kirimForm" name="kirimForm" method="post" action="<?= site_url('kirim/dokirimbarang') ?>"
      enctype="multipart/form-data">
	<input type="hidden" id="type" name="type" value="<?= $type ?>">
	<input type="hidden" name="id" value="<?= $id ?>">
	
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
				</div>
			</div>
		</div>
	</div>
	<div class="section-3">
		<div class="section-title">Detail Barang</div>
		<div class="section-3-content">
			<div class="form-item form-nama-barang">
				<div class="form-item-label">Nama Barang</div>
				<input type="text" class="input-nama-barang" name="item_name" />
			</div>
			<div class="form-item form-qty-barang">
				<div class="form-item-label">Qty</div>
				<input type="text" class="input-qty-barang" name="item_qty" />
			</div>
			<div class="form-item">
				<div class="form-item-label">Deskripsi Barang</div>
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
							<input type="text" name="" class="input-panjang-barang" />
						</div>
						<div class="form-item form-lebar-barang">
							<div class="form-item-label">Lebar</div>
							<input type="text" name="" class="input-lebar-barang" />
						</div>
						<div class="form-item form-tinggi-barang">
							<div class="form-item-label">Tinggi</div>
							<input type="text" name="" class="input-tinggi-barang" />
						</div>
						<div class="form-item form-satuan-dimensi-barang">
							<div class="form-item-label">Satuan</div>
							<input type="text" name="" class="input-satuan-dimensi-barang" />
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
							<input type="text" name="" class="input-kubikasi-barang" />
						</div>
						<div class="form-item form-satuan-kubikasi-barang">
							<div class="form-item-label">Satuan</div>
							<input type="text" name="" class="input-satuan-kubikasi-barang" />
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
							<input type="text" name="" class="input-berat-barang" />
						</div>
						<div class="form-item form-satuan-berat-barang">
							<div class="form-item-label">Satuan</div>
							<input type="text" name="" class="input-satuan-berat-barang" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--
<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label>Judul Kiriman</label>
            <input class="form-control" name="shipment_title" id="shipment_title" value="<?= $shipment_title ?>">
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <textarea cols="3" rows="6" name="shipment_information" id="shipment_information" class="form-control"><?= $shipment_information ?></textarea>
        </div>

        <div class="form-group">
            <label>Foto Barang</label>
            <input type="file" id="shipment_pictures" name="shipment_pictures" class="form-control">
            <input type="hidden" id="shipment_pictures_name" name="shipment_pictures_name" value="<?=$shipment_pictures?>">
        </div>
    </div>
    <div class="col-md-6">
        <div id="image-holder">
            <?php
            /*if (strlen($shipment_pictures)>0) {
              echo "<img src='".base_url()."/assets/panel/images/".$shipment_pictures."' width='100%'>";
            }*/
            ?>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Asal Lokasi</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Contact</label>
                    <input type="text" class="form-control" id="location_from_contact" name="location_from_contact"
                           value="<?= $location_from_contact ?>">
                </div>
                <!--<div class="form-group">
                    <label>Detail Lokasi</label>
                    <textarea class="form-control" cols="3" rows="3" id="location_from_address"
                              name="location_from_address"><?= $location_from_address ?></textarea>
                </div>
                <div class="form-group">
                    <label>Keterangan (gedung, lantai, dst.)</label>
                    <input type="text" class="form-control" id="location_from_name" name="location_from_name"
                           value="<?= $location_from_name ?>">
                </div>
                <div class="form-group">
                    <label>History</label>
                    <select name="history_first_place" id="history_first_place" class="form-control location_history">
                        <option selected></option>
                        <?php
                        /*$length = count($location_from_history);
                        for ($i = 0; $i < $length; $i++) {
                          $str = $location_from_history[$i]['location_contact'].'###'.
                                 $location_from_history[$i]['location_address'].'###'.
                                 $location_from_history[$i]['location_detail'].'###'.
                                 $location_from_history[$i]['location_lat'].'###'.
                                 $location_from_history[$i]['location_lng'];
                          echo '<option value="'.$str.'">'.$location_from_history[$i]['location_name'].' ['.$location_from_history[$i]['location_address'].']</option>';
                        }*/
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Map Lokasi</label>
                    <input type="hidden" name="location_from_latlng" id="location_from_latlng" class="form-control" value="<?=$location_from_latlng;?>" readonly>
                </div>
                <div class="form-group" id="map_asal" style="width: 100%; height: 200px"></div> 
                <span class="form-group" id="latlng_asal"></span> 
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Tujuan Lokasi</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Contact</label>
                    <input type="text" class="form-control" id="location_to_contact" name="location_to_contact"
                           value="<?= $location_to_contact ?>">
                </div>
                <div class="form-group">
                    <label>Detail Lokasi</label>
                    <textarea class="form-control" cols="3" rows="3" id="location_to_address" name="location_to_address" ><?= $location_to_address ?></textarea>
                </div>
                <div class="form-group">
                    <label>Keterangan (gedung, lantai, dst.)</label>
                    <input type="text" class="form-control" id="location_to_name" name="location_to_name"
                           value="<?= $location_to_name ?>">
                </div>
                <div class="form-group">
                    <label>History</label>
                    <select name="history_last_place" id="history_last_place" class="form-control location_history">
                        <option selected></option>
                        <?php
                        /*$length = count($location_to_history);
                        for ($i = 0; $i < $length; $i++) {
                          $str = $location_to_history[$i]['location_contact'].'###'.
                                 $location_to_history[$i]['location_address'].'###'.
                                 $location_to_history[$i]['location_detail'].'###'.
                                 $location_to_history[$i]['location_lat'].'###'.
                                 $location_to_history[$i]['location_lng'];
                          echo '<option value="'.$str.'">'.$location_to_history[$i]['location_name'].' ['.$location_to_history[$i]['location_address'].']</option>';
                        }*/
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Map Lokasi</label>
                    <input type="hidden" name="location_to_latlng" id="location_to_latlng" class="form-control" value="<?=$location_from_latlng;?>" readonly>
                </div>
                <div class="form-group" id="map_tujuan" style="width: 100%; height: 200px"></div> 
                <span class="form-group" id="latlng_tujuan"></span> 
            </div>
        </div>
    </div>-->
</div>
<!-- /.row -->

<hr>

<?php if ($type == "new") { ?>
    <div class="row">
        <div class="col-md-3">&nbsp;</div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Detail Barang</h3>
                </div>
                <div class="panel-body">
                    <div class="items">
                        <div class="form-group row">
                            <div class="col-md-9">
                                <label>Nama Barang</label>
                                <input type="text" id="item_name" name="item_name" class="form-control"><span
                                    id="span_item_name"></span>
                            </div>
                            <div class="col-md-3">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" id="item_qty" name="item_qty"><span
                                    id="span_item_qty"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Tambahan</label>
                            <textarea class="form-control" id="item_desc" name="item_desc" cols="3" rows="3"></textarea><span
                                id="span_item_desc"></span>
                        </div>
                        <div class="form-group row well">
                            <div class="col-md-3">
                                <label>Panjang</label>
                                <input type="number" id="item_length" name="item_length" class="form-control"><span
                                    id="span_item_length"></span>
                            </div>
                            <div class="col-md-3">
                                <label>Lebar</label>
                                <input type="number" id="item_width" name="item_width" class="form-control"><span
                                    id="span_item_width"></span>
                            </div>
                            <div class="col-md-3">
                                <label>Tinggi</label>
                                <input type="number" id="item_height" name="item_height" class="form-control"><span
                                    id="span_item_height"></span>
                            </div>
                            <div class="col-md-3">
                                <label for="item_dimension_unit">Satuan</label>
                                <select class="form-control" name="item_dimension_unit" id="item_dimension_unit">
                                    <option value="M">M</option>
                                    <option value="Cm">Cm</option>
                                </select>
                                <span id="span_item_dimension_unit"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="row well">
                                    <div class="col-md-6">
                                        <label>Kubikasi</label>
                                        <input type="number" id="item_cubic" name="item_cubic" class="form-control"><span
                                            id="span_item_kubikasi"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="item_kubikasi_unit">Satuan</label>
                                        <select class="form-control" name="item_kubikasi_unit" id="item_kubikasi_unit">
                                            <option value="M3">M3</option>
                                            <option value="Cm3">Cm3</option>
                                        </select>
                                        <span id="span_item_kubikasi_unit"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row well">
                                    <div class="col-md-6">
                                        <label>Berat</label>
                                        <input type="number" class="form-control" id="item_weight" name="item_weight"><span
                                            id="span_item_weight"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="item_weight_unit">Satuan</label>
                                        <select class="form-control" name="item_weight_unit" id="item_weight_unit">
                                            <option value="Kg">Kg</option>
                                            <option value="Ton">Ton</option>
                                        </select>
                                        <span id="span_item_weight_unit"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="errMsg"></div>
                    <div class="form-group" style="float: right">
                        <button type="reset" class="btn btn-danger"><span class="fa fa-remove"></span> Reset</button>
                        <a class="btn btn-success" onclick="postItems()"><i class="fa fa-plus"></i> Tambahkan Item</a>
                    </div>
                    <input type="hidden" id="temporaryItems" name="temporaryItems">

                    <script>
                        $( document ).ready(function() {
                            $('#item_length').blur(function() { this.focusout(); });
                            $('#item_width').blur(function() { $('#item_length').focusout(); });
                            $('#item_height').blur(function() { $('#item_length').focusout(); });
                            $('#item_width').focusout(function() { $('#item_length').focusout(); });
                            $('#item_height').focusout(function() { $('#item_length').focusout(); });
                            $('#item_length').focusout(function() {
                                var p = 0;
                                if ($('#item_length').val().length>0) {
                                    p = $('#item_length').val()*1;
                                }
                                var l = 0;
                                if ($('#item_width').val().length>0) {
                                    l = $('#item_width').val()*1;
                                }
                                var t = 0;
                                if ($('#item_height').val().length>0) {
                                    t = $('#item_height').val()*1;
                                }

                                if (p*l*t>0) {
                                    $("#item_cubic").val(p*l*t);
                                    $("#item_cubic").prop('disabled', true);
                                    $("#item_kubikasi_unit").prop('disabled', true);
                                    $("#item_cubic").attr('disabled','disabled');
                                    $("#item_kubikasi_unit").attr('disabled','disabled');
                                }
                                else {
                                    $("#item_cubic").prop('disabled', false);
                                    $("#item_kubikasi_unit").prop('disabled', false);
                                    $("#item_cubic").removeAttr('disabled');
                                    $("#item_kubikasi_unit").removeAttr('disabled');
                                }
                            });

                            $('#item_dimension_unit').change(function() {
                                $('#item_kubikasi_unit').val($('#item_dimension_unit').val()+"3");
                            });

                            $('#item_kubikasi_unit').change(function() {
                                $('#item_dimension_unit').val($('#item_kubikasi_unit').val().replace("3",""));
                            });
                        });

                        var i = 0;
                        var arrayItems = [];

                        function postItems() {
                            var item_name = $('#item_name').val().toUpperCase();
                            var item_desc = $('#item_desc').val().toUpperCase();
                            var item_length = $('#item_length').val();
                            var item_width = $('#item_width').val();
                            var item_height = $('#item_height').val();
                            var item_dimension_unit = $('#item_dimension_unit').val();
                            var satuan = $('#item_dimension_unit option:selected').text();
                            var item_kubikasi = $('#item_cubic').val();
                            if (item_length && item_width && item_height) {
                                item_kubikasi = item_length*item_width*item_height;
                            }

                            var item_kubikasi_unit = $('#item_dimension_unit').val()+"3";
                            if ($('#item_kubikasi_unit').val()) {item_kubikasi_unit = $('#item_kubikasi_unit').val();}
                            var item_weight = $('#item_weight').val();
                            var item_weight_unit = $('#item_weight_unit').val();
                            var satuan_berat = $('#item_weight_unit option:selected').text();
                            var item_qty = $('#item_qty').val();

                            try {
                                if (item_name == "") {
                                    $('#item_name').focus();
                                    throw "Nama Barang harus diisi";
                                }
                                if (item_qty == "") {
                                    $('#item_qty').focus();
                                    throw "Jumlah harus diisi";
                                }
                                if (item_desc == "") {
                                    $('#item_desc').focus();
                                    throw "Deskripsi Barang harus diisi";
                                }
                                /*if (item_length == "") throw "Panjang field required";
                                if (item_width == "") throw "Lebar field required";
                                if (item_height == "") throw "Tinggi field required";
                                if (item_dimension_unit == false) throw "Satuan tinggi required";*/
                                if (item_kubikasi == "") {
                                    $('#item_cubic').focus();
                                    throw "Kubikasi harus diisi";
                                }
                                //if (item_kubikasi_unit == false) throw "Satuan kubikasi required";
                                if (item_weight == "") {
                                    $('#item_weight').focus();
                                    throw "Berat harus diisi";
                                }
                                //if (item_weight_unit == false) throw "satuan berat required";
                                $('#errMsg').html('');
                            } catch (err) {
                                //alert(err);
                                $('#errMsg').html('<font color="#f00"> * '+err+'</font>');
                                return;
                            }
							
                            arrayItems.push({
                                "item_name": item_name,
                                "item_desc": item_desc,
                                "item_length": item_length,
                                "item_width": item_width,
                                "item_height": item_height,
                                "item_dimension_unit": item_dimension_unit,
                                "item_kubikasi": item_kubikasi,
                                "item_kubikasi_unit": item_kubikasi_unit,
                                "item_weight": item_weight,
                                "item_weight_unit": item_weight_unit,
                                "item_qty": item_qty
                            });

                            document.getElementById("temporaryItems").value = JSON.stringify(arrayItems);
                            console.log(arrayItems);
							
							var rowCount = table.rows.length;
                            var row = table.insertRow(rowCount);
							
							console.log("=>"+rowCount);

                            row.insertCell(0).innerHTML = item_name+"<br>=> "+item_desc;
                            row.insertCell(1).innerHTML = item_qty;
                            if (item_length*item_width*item_height*1>0) {
                                row.insertCell(2).innerHTML = item_length+" "+satuan+" x "+item_width+" "+satuan+" x "+item_height+" "+satuan;
                            }
                            else {
                                row.insertCell(2).innerHTML = "";
                            }
                            row.insertCell(3).innerHTML = item_kubikasi+" "+satuan+"3";
                            row.insertCell(4).innerHTML = item_weight+" "+satuan_berat;
                            row.insertCell(5).innerHTML = '<a class="btn btn-danger" onClick="javacsript:deleteRow(this,i)"><i class="fa fa-remove"></i> Remove</a>';
							
						}

                        function deleteRow(obj, i) {
                            index = obj.parentNode.parentNode.rowIndex;
                            table = document.getElementById("table");
                            table.deleteRow(index);

                            arrayItems.splice(i - 1, 1);

                            document.getElementById("temporaryItems").value = JSON.stringify(arrayItems);
                        }

                        function clearText() {
                            document.getElementById("item_name").value = "";
                            document.getElementById("item_desc").value = "";
                            document.getElementById("item_length").value = "";
                            document.getElementById("item_width").value = "";
                            document.getElementById("item_height").value = "";
                            document.getElementById("item_dimension_unit").value = "";
                            document.getElementById("item_cubic").value = "";
                            document.getElementById("item_kubikasi_unit").value = "";
                            document.getElementById("item_weight").value = "";
                            document.getElementById("item_weight_unit").value = "";
                            document.getElementById("item_qty").value = "";
                        }

                        function setStyle(inputId, spanId, label, display, borderColor) {
                            document.getElementById(spanId).innerHTML = label;
                            document.getElementById(spanId).style.display = display;
                            document.getElementById(inputId).style.borderColor = borderColor;
                        }
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-3">&nbsp;</div>
    </div>

<?php } ?>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Deskripsi Barang</th>
                    <th>Jumlah</th>
                    <th>Dimensi</th>
                    <th>Kubikasi</th>
                    <th>Berat</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($type == "edit") {
                    $i = 0;
                    foreach ($shipment_detail as $sd) {
                        ?>
                        <tr>
                            <?php
                            $uom = $sd['item_dimension_unit'];
                            ?>
                            <td><?= $sd['item_name'] ?></td>
                            <td><?= $sd['item_qty'] ?></td>
                            <td><?= $sd['item_length']." ".$uom." x ".$sd['item_width']." ".$uom." x ".$sd['item_height']." ".$uom ?></td>
                            <td><?= $sd['item_kubikasi']." ".$sd['item_kubikasi_unit'] ?></td>
                            <td><?= $sd['item_weight']." ".$sd['item_weight_unit'] ?></td>
                            <td>
                                <button type="button" id="btnEdit<?=$sd['shipment_details_id']?>" class="btn btn-primary" onclick="editItems(<?=$sd['shipment_details_id']?>, this.id)">Edit</button>
                                <button type="button" id="btnDelete<?=$sd['shipment_details_id']?>" class="btn btn-danger" onclick="deleteItems(<?=$sd['shipment_details_id']?>, this.id)">Delete</button>
                            </td>
                        </tr>
                    <?php
                    }

                } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-3">
        <div class="form-group">
            <label>Tanggal Kirim</label>
            <input type="text" class="form-control" id="shipment_delivery_date_from" name="shipment_delivery_date_from"
                   onmouseover="getTanggal(this.id)" width="50px"
                   placeholder="Tanggal awal" value="<?= $shipment_delivery_date_from ?>">
            <label>&nbsp;</label>
            <input type="text" class="form-control" id="shipment_delivery_date_to" name="shipment_delivery_date_to"
                   onmouseover="getTanggal(this.id)" width="50px"
                   placeholder="Tanggal akhir" value="<?= $shipment_delivery_date_to ?>">
        </div>
    </div>
    <div class="col-xs-3">
        <div class="form-group">
            <label>Tanggal Max. Kiriman</label>
            <input type="text" class="form-control" id="shipment_end_date" name="shipment_end_date"
                   onmouseover="getTanggal(this.id)" width="50px"
                   placeholder="Tanggal max. kiriman" value="<?= $shipment_end_date ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Harga</label>
            <input type="text" class="form-control" id="shipment_price" name="shipment_price"
                   value="<?= number_format($shipment_price, 2, '.', ',') ?>">
        </div>

        <div class="form-group">
            <label>Cara Pemesanan</label>&nbsp;

            <input type="radio" name="order_type" value="1" <?= ($checked_pemesanan == 1) ? "checked" : "" ?>> Penawaran
            &nbsp;&nbsp;
            <input type="radio" name="order_type" value="2" <?= ($checked_pemesanan == 2) ? "checked" : "" ?>> Pesan
            secara instan

        </div>

        <div class="form-group">
            <label>Type Penawaran</label>&nbsp;

            <input type="radio" name="shipment_type" value="1" <?= ($checked_penawaran == 1) ? "checked" : "" ?>> Public
            &nbsp;&nbsp;
            <input type="radio" name="shipment_type" value="2" <?= ($checked_penawaran == 2) ? "checked" : "" ?>>
            Private

        </div>
    </div>
</div>
<div class='row'>
    <div class='col-md-12 text-right'>
<button type="button" onclick="doKirim()" id="btnSave" class="btn btn-success"><span
        class="fa fa-save"></span> <?= $btnSave ?></button>
<button type="reset" class="btn btn-danger"><span class="fa fa-remove"></span> Reset</button>
<button type="button" onclick="location.href='<?=site_url('kirim/');?>';" class="btn btn-warning"><span class="fa fa-minus-circle"></span> Batal</button>
    </div>
</div>
</form>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBxOH8f5gil4RYVBIwPCZQ197euUsnnyUo&callback=initMap&libraries=places" async defer></script>
<script>
   var type = $("#type").val();
   var url;
   
	$(".input-gambar").on("change", function() {
		var reader = new FileReader();
		reader.onload = function(e) {
			$(".image-preview").attr("src", e.target.result);
		};
		reader.readAsDataURL($(this)[0].files[0]);
	});

    function doKirim() {
	
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
    }

    var map_asal,map_tujuan;
    var marker_asal,marker_tujuan;
    var center_from = {lat: 0, lng: 0};
    var center_to = {lat: 0, lng: 0};//{lat: -7.2653524, lng: 112.7454884};

    function updatePosition(div, lat, lng) {
        $("#"+div).val(lat.toFixed(4)+', '+lng.toFixed(4));
    }

    function initialize() {
        input = document.getElementById('location_from_address');
        new google.maps.places.Autocomplete(input);
        input = document.getElementById('location_to_address');
        new google.maps.places.Autocomplete(input);
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
            //alert(latitude+" and "+longitude);
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



<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Item Details</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="shipment_id" id="shipment_id"/>
                    <input type="hidden" value="" name="shipment_details_id"/>

                    <div class="form-body">
                        <div class="form-group col-md-12">
                            <label>Items</label>
                            <input type="text" id="item_name" name="item_name" class="form-control">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Deskripsi</label>
                            <textarea class="form-control" id="item_desc" name="item_desc" cols="3" rows="3"></textarea>
                                <span class="help-block"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Panjang</label>
                            <input type="number" id="item_length" name="item_length" class="form-control">
                                <span class="help-block"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Lebar</label>
                            <input type="number" id="item_width" name="item_width" class="form-control">
                                <span class="help-block"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Tinggi</label>
                                    <input type="number" id="item_height" name="item_height" class="form-control">
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6"><br><br>
                                    <input type="radio" name="item_dimension_unit" value="1"> Meter &nbsp;&nbsp;
                                    <input type="radio" name="item_dimension_unit" value="2"> Centimeter
                                    <span class="help-block"></span>
                                </div>
                            </div>
                                <span class="help-block"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Kubikasi</label>
                                    <input type="number" id="item_cubic" name="item_cubic" class="form-control">
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6"><br><br>
                                    <input type="radio" name="item_kubikasi_unit" value="1"> m3 &nbsp;&nbsp;
                                    <input type="radio" name="item_kubikasi_unit" value="2"> cm3
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Berat</label>
                                    <input type="number" class="form-control" id="item_weight" name="item_weight">
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-md-6"><br><br>
                                    <input type="radio" name="item_weight_unit" value="1"> Kilogram &nbsp;&nbsp;
                                    <input type="radio" name="item_weight_unit" value="2"> Ton
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Qty</label>
                            <input type="number" class="form-control" id="item_qty" name="item_qty">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnUpdate" onclick="updateItems()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
