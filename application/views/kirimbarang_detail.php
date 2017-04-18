<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="content">
	<div class="section-1">
		<div class="section-1a">
			<table>
				<tbody>
					<tr>
						<td class="td-label">Keterangan</td>
						<td class="td-titikdua">:</td>
						<td><?= $shipment_information ?></td>
					</tr>
					<tr>
						<td class="td-label">Pelanggan</td>
						<td class="td-titikdua">:</td>
						<td><?= $shipment_owner_username ?></td>
					</tr>
					<tr>
						<td class="td-label">Tanggal Buat</td>
						<td class="td-titikdua">:</td>
						<td><?= $created_date ?></td>
					</tr>
					<tr>
						<td class="td-label">Perubahan Terakhir</td>
						<td class="td-titikdua">:</td>
						<td><?= $modified_date ?></td>
					</tr>
					<tr>
						<td class="td-label">Berakhir</td>
						<td class="td-titikdua">:</td>
						<td><?= $shipment_end_date ?></td>
					</tr>
					<tr>
						<td class="td-label">Cara Pesan</td>
						<td class="td-titikdua">:</td>
						<td><?= $order_type_name ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="section-1b">
			<div class="asal">
				<div class="asal-title">Asal</div>
				<table>
					<tbody>
						<tr>
							<td class="td-address-label">Nama Lokasi</td>
							<td class="td-titikdua">:</td>
							<td><?= $location_from_name ?></td>
						</tr>
						<tr>
							<td class="td-address-label">Alamat Lokasi</td>
							<td class="td-titikdua">:</td>
							<td><?= $location_from_address ?></td>
						</tr>
					</tbody>
				</table>
				<div class="form-group" id="map_asal" style="width: 100%; height: 200px"></div>
			</div>
			<div class="tujuan">
				<div class="tujuan-title">Tujuan</div>
				<table>
					<tbody>
						<tr>
							<td class="td-address-label">Nama Lokasi</td>
							<td class="td-titikdua">:</td>
							<td><?= $location_to_name ?></td>
						</tr>
						<tr>
							<td class="td-address-label">Alamat Lokasi</td>
							<td class="td-titikdua">:</td>
							<td><?= $location_to_address ?></td>
						</tr>
					</tbody>
				</table>
				<div class="form-group" id="map_tujuan" style="width: 100%; height: 200px"></div> 
			</div>
		</div>
	</div>
	<div class="section-2">
		<div class="section-title">Item</div>
		<?php
		for ($i = 0; $i < sizeof($items); $i++)
		{	?>
			<div class="item">
				<table>
					<tbody>
						<tr>
							<td class="td-item-label">Nama</td>
							<td class="td-titikdua">:</td>
							<td><?= $items[$i]['item_name'] ?></td>
						</tr>
						<tr>
							<td class="td-item-label">Deskripsi</td>
							<td class="td-titikdua">:</td>
							<td><?= $items[$i]['item_desc'] ?></td>
						</tr>
					</tbody>
				</table>
				<table>
					<tbody>
						<tr>
							<td class="td-item-label">Qty</td>
							<td class="td-titikdua">:</td>
							<td><?= $items[$i]['item_qty'] ?></td>
						</tr>
					</tbody>
				</table>
				<table>
					<tbody>
						<tr>
							<td class="td-item-label">Panjang</td>
							<td class="td-titikdua">:</td>
							<td><?= $items[$i]['item_length'] ?> <?= $items[$i]['item_dimension_unit'] ?></td>
						</tr>
						<tr>
							<td class="td-item-label">Lebar</td>
							<td class="td-titikdua">:</td>
							<td><?= $items[$i]['item_width'] ?> <?= $items[$i]['item_dimension_unit'] ?></td>
						</tr>
						<tr>
							<td class="td-item-label">Tinggi</td>
							<td class="td-titikdua">:</td>
							<td><?= $items[$i]['item_height'] ?> <?= $items[$i]['item_dimension_unit'] ?></td>
						</tr>
					</tbody>
				</table>
				<table>
					<tbody>
						<tr>
							<td class="td-item-label">Total Kubikasi</td>
							<td class="td-titikdua">:</td>
							<td><?= $items[$i]['item_kubikasi'] ?>  <?= $items[$i]['item_kubikasi_unit'] ?></td>
						</tr>
					</tbody>
				</table>
				<table>
					<tbody>
						<tr>
							<td class="td-item-label">Total Berat</td>
							<td class="td-titikdua">:</td>
							<td><?= $items[$i]['item_weight'] ?>  <?= $items[$i]['item_weight_unit'] ?></td>
						</tr>
					</tbody>
				</table>
			</div>
<?php	}	?>
	</div>
	<div class="section-3">
		<div class="section-title">Diskusi</div>
		<div class="discussions">
		<?php
		for ($i = 0; $i < sizeof($discussions["questions"]); $i++) { ?>
			<div class="questions">
				<div class="questions-user-id"><?= $discussions["questions"][$i]->username ?> </div>
				<div class="questions-text"><?= $discussions["questions"][$i]->questions_text ?></div>
				<?php
				if ($isOwner == "true") {
					echo "<div class='btn-jawab'>Jawab</div>";
				}
				?>
			</div>
			<div class="answers">
				<div class="answers_text"><?= $discussions["answers"][$i][0]->answers_text ?></div>
			</div>
<?php	}	?>
		</div>
	</div>
	<div class="section-4">
		<div class="section-title">Penawaran</div>
		<?php
		if ($role_id == 2) { ?>
			<button type="button" class="btn-tawar">Kirim Penawaran</button>
			<div class="detail-penawaran">
				<table>
					<tbody>
						<tr>
							<td>Harga</td>
							<td> : </td>
							<td><input type="text" class="input-bidding-price" data-type="number-with-thousand" /></td>
						</tr>
						<tr>
							<td>Tanggal Ambil</td>
							<td> : </td>
							<td><input type="text" class="input-bidding-pickupdate" class="input-tanggal-ambil" data-type="number-with-thousand" /></td>
						</tr>
						<tr>
							<td>List Kendaraan</td>
							<td> : </td>
							<td><input type="text" class="input-bidding-listkendaraan" data-type="number-with-thousand" /></td>
						</tr>
						<tr>
							<td>Keterangan</td>
							<td> : </td>
							<td><input type="text" class="input-bidding-information" data-type="number-with-thousand" /></td>
						</tr>
					</tbody>
				</table>
				<button type="button" class="btn-kirim-penawaran">Kirim</button>
			</div>
<?php	}	?>
		<table>
			<thead>
				<tr>
					<td>Harga</td>
					<td>Ekspedisi</td>
				</tr>
			</thead>
			<tbody>
			<?php
			for ($i = 0; $i < sizeof($bidding); $i++) { ?>
				<tr>
					<td><?= $bidding[$i]->bidding_price ?></td>
					<td><?= $bidding[$i]->username ?></td>
				</tr>
	<?php	}	?>
			</tbody>
		</table>
	</div>
</div>

<script>
var map_asal, map_tujuan;
var marker_asal, marker_tujuan;
var lat, lng, center_from, center_to;

<?php
if ($role_id == 2) { ?>
	$( ".input-tanggal-ambil" ).datepicker({
		dateFormat: "yy-mm-dd"
	});
	
	$(".btn-kirim-penawaran").on("click", function() {
		kirimPenawaran();
	});
	
	function kirimPenawaran() {
		var bidding_price = $(".input-bidding-price").val();
		var bidding_pickupdate = $(".input-bidding-pickupdate").val();
		var bidding_information = $(".input-bidding-information").val();
		var shipment_id = <?= $shipment_id ?>;
		var user_id = <?= $user_id ?>;
		$.ajax({
			url: '<?= base_url("kirim/kirimPenawaran") ?>',
			data: {
				submit_bid: true,
				bidding_price: bidding_price,
				bidding_pickupdate: bidding_pickupdate,
				bidding_information: bidding_information,
				shipment_id: shipment_id,
				user_id: user_id
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				valid = false;
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					
				}
				alert(result);
			}
		});
	}
<?php } ?>

function initMap() {	
	lat = <?= $location_from_lat ?>;
	lng = <?= $location_from_lng ?>;
	center_from = {lat: lat, lng: lng};
	
	lat = <?= $location_to_lat ?>;
	lng = <?= $location_to_lng ?>;
	center_to = {lat: lat, lng: lng};
	
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
}
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBxOH8f5gil4RYVBIwPCZQ197euUsnnyUo&callback=initMap" async defer></script>
</div>
</div>