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
<?php	if ($role_id == 2) { ?>
		<div class="detail-pertanyaan">
			<div class="form-item">
				<div class="form-item-label">Pertanyaan</div>
				<textarea class="input-pertanyaan"></textarea>
			</div>
			<button class="btn-default btn-submit-pertanyaan">Submit Pertanyaan</button>
		</div>
<?php	}	?>
		<div class="discussions">
		</div>
	</div>
	<div class="section-4">
		<div class="section-title">Penawaran</div>
		<?php
		if ($role_id == 2) { ?>
			<button type="button" class="btn-default btn-tawar">Kirim Penawaran</button>
			<div class="detail-penawaran">
				<table class="table-detail-penawaran">
					<tbody>
						<tr>
							<td class="td-label">Harga</td>
							<td class="td-titikdua"> : </td>
							<td>
								<input type="text" class="input-bidding-price" data-type="number" />
								<div class="error penawaran-error error-bidding-price"></div>
							</td>
						</tr>
						<tr>
							<td class="td-label">Tanggal Ambil</td>
							<td class="td-titikdua"> : </td>
							<td>
								<input type="text" class="input-bidding-pickupdate" />
								<div class="error penawaran-error error-bidding-pickupdate"></div>
							</td>
						</tr>
						<tr>
							<td class="td-label">List Kendaraan</td>
							<td class="td-titikdua"> : </td>
							<td>
								<input type="text" class="input-kendaraan" />
								<div class="error penawaran-error error-kendaraan"></div>
							</td>
						</tr>
						<tr>
							<td class="td-label">Keterangan</td>
							<td class="td-titikdua"> : </td>
							<td>
								<input type="text" class="input-bidding-information" />
								<div class="error penawaran-error error-bidding-information"></div>
							</td>
						</tr>
					</tbody>
				</table>
				<button type="button" class="btn-default btn-kirim-penawaran">Kirim</button>
			</div>
<?php	}	?>
		<table class='table table-list-penawaran'>
			<thead>
				<tr>
					<td class="td-harga">Harga</td>
					<td>Ekspedisi</td>
					<td>Detail</td>
					<td class="td-action">Status</td>
				</tr>
			</thead>
			<tbody class="tbody-list-penawaran">
			
			</tbody>
		</table>
	</div>
</div>

<script>
var map_asal, map_tujuan;
var marker_asal, marker_tujuan;
var lat, lng, center_from, center_to;

getDiscussions();
getBiddingList();
//getKendaraan();

<?php
$btnJawabPertanyaan = "";
$detailJawabPertanyaan = "";
$divQuestions = "element += \"<div class='questions'>\";";

if ($role_id == 1 && $isOwner) { 
	$btnJawabPertanyaan = "element += \"<button class='btn-neutral btn-jawab-pertanyaan'>Jawab</button>\";";
	$detailJawabPertanyaan = "element += \"<div class='detail-jawab-pertanyaan'>\";" .
		"element += \"<textarea class='input-jawab-pertanyaan'></textarea>\";" .
		"element += \"<button class='btn-default btn-submit-jawab-pertanyaan'>Submit Jawaban</button>\";" .
		"element += \"</div>\";";
	$divQuestions = "element += \"<div class='questions' data-questions-id='\" + questions[i].questions_id + \"'>\";";
?>
	
	$(document).on("click", ".btn-tolak", function() {
		showAlasanTolak(this);
	});
	
	$(document).on("click", ".btn-batal-tolak", function() {
		hideAlasanTolak(this);
	});
	
	$(document).on("click", ".btn-submit-tolak", function() {
		submitTolak(this);
	});
	
	$(document).on("click", ".btn-jawab-pertanyaan", function() {
		$(".detail-jawab-pertanyaan").css("display", "none");
		var element = $(this).closest(".discussions-item").children(".detail-jawab-pertanyaan");
		$(element).css("display", "block");
		$(element).children("textarea").select();
	});
	
	$(document).on("click", ".btn-submit-jawab-pertanyaan", function() {
		jawabPertanyaan(this);
	});
	
	function jawabPertanyaan(element) {
		var questions_id = $(element).closest(".discussions-item").children(".questions").data("questions-id");
		var answers_text = $(element).closest(".discussions-item").children(".input-jawab-pertanyaan").val();
		
		
	}
	
	function submitTolak(element) {
		var bidding_id = $(element).data("bidding_id");
		var bidding_reason = $(".input-alasan[data-bidding_id='" + bidding_id + "']").val();
		$.ajax({
			url: '<?= base_url("kirim/tolakPenawaran") ?>',
			data: {
				submit_tolak: true,
				bidding_id: bidding_id,
				bidding_reason: bidding_reason
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					getBiddingList();
				}
			}
		});
	}
	
	function showAlasanTolak(element) {
		$(element).next().css("display", "block");
		$(element).next().children(".input-alasan").select();
	}
	
	function hideAlasanTolak(element) {
		$(element).parent().css("display", "none");
	}
<?php
} else if ($role_id == 2) { ?>
	var detailPenawaranShown = false;
	
	$(document).on("click", ".btn-tawar", function() {
		toggleDetailPenawaran();
	});
	
	$(document).on("keydown", "input[data-type='number']", function(e) {
		isNumber(e);
	});
	
	$( ".input-bidding-pickupdate" ).datepicker({
		dateFormat: "yy-mm-dd"
	});
	
	$(document).on("click", ".btn-kirim-penawaran", function() {
		kirimPenawaran();
	});
	
	$(".btn-submit-pertanyaan").on("click", function() {
		kirimPertanyaan();
	});
	
	function kirimPertanyaan() {
		var questions_text = $(".input-pertanyaan").val();
		var shipment_id = <?= $shipment_id ?>;
		
		$.ajax({
			url: '<?= base_url("kirim/kirimPertanyaan") ?>',
			data: {
				submit_pertanyaan: true,
				questions_text: questions_text,
				shipment_id: shipment_id
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					clearQuestion();
					getDiscussions();
				}
			}
		});
	}
	
	function clearQuestion() {
		$(".input-pertanyaan").val("");
	}
	
	function getKendaraan() {
		$.ajax({
			url: '<?= base_url("kirim/getKendaraan") ?>',
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(json) {
				var result = jQuery.parseJSON(json);
				addKendaraanToOption(result);
			}
		});
	}
	
	function addKendaraanToOption(result) {
		var element = "";
		var iLength = result.length;
		for (var i = 0; i < iLength; i++) {
			element += "<option value='" + result[i].vehicle_id + "'>" + result[i].vehicle_name + "</option>";
		}
		$(".input-kendaraan").html("");
		$(".input-kendaraan").append(element);
	}
	
	function toggleDetailPenawaran() {
		if (!detailPenawaranShown) {
			$(".detail-penawaran").css("display", "block");
		} else {
			$(".detail-penawaran").css("display", "none");
		}
		detailPenawaranShown = !detailPenawaranShown;
	}
	
	function kirimPenawaran() {		
		var bidding_price = $(".input-bidding-price").val();
		var bidding_pickupdate = $(".input-bidding-pickupdate").val();
		var bidding_vehicle = $(".input-kendaraan").val();
		var bidding_information = $(".input-bidding-information").val();
		
		var data = {
			bidding_price: bidding_price,
			bidding_pickupdate: bidding_pickupdate,
			bidding_vehicle: bidding_vehicle,
			bidding_information: bidding_information
		};
		var valid = cekInputPenawaran(data);
		
		if (valid) {
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
					alert(jqXHR + " : " + jqXHR.responseText);
				},
				success: function(result) {
					if (result == "success") {
						toggleDetailPenawaran();
						getBiddingList();
					}
				}
			});
		}
	}
	
	function cekInputPenawaran(data) {
		clearErrors();
		
		var valid = true;
		if (data.bidding_price == "") {
			valid = false;
			$(".error-bidding-price").html("Harga harus diisi");
		}
		if (data.bidding_pickupdate == "") {
			valid = false;
			$(".error-bidding-pickupdate").html("Tanggal Ambil harus diisi");
		}
		if (data.bidding_vehicle == "") {
			valid = false;
			$(".error-kendaraan").html("Kendaraan harus diisi");
		}
		return valid;
	}
	
	function clearErrors() {
		$(".error").html("");
	}
	
	$("input")
<?php } ?>

function getDiscussions() {
	var shipment_id = <?= $shipment_id ?>;
	$.ajax({
		url: '<?= base_url("kirim/getDiscussions") ?>',
		data: {			
			shipment_id: shipment_id
		},
		type: 'POST',
		error: function(jqXHR, exception) {
			alert(jqXHR + " : " + jqXHR.responseText);
		},
		success: function(json) {
			var result = jQuery.parseJSON(json);
			addDiscussionToTable(result);
		}
	});
}

function addDiscussionToTable(result) {
	var questions = result.questions;
	var iLength = questions.length;
	var element = "";
	for (var i = 0; i < iLength; i++) {
		element += "<div class='discussions-item'>";
		<?= $divQuestions ?>
		element += "<div class='questions-user-id'>" + questions[i].username + "</div>";
		element += "<div class='questions-text'>" + questions[i].questions_text + "</div>";
		<?= $btnJawabPertanyaan ?>
		element += "</div>";
		
		var answers = result.answers[i];
		var jLength = answers.length;
		for (var j = 0; j < jLength; j++) {
			element += "<div class='answers'>";
			element += "<div class='answers-user-id'><?= $shipment_owner_username ?></div>";
			element += "<div class='answers-text'>" + answers[j].answers_text + "</div>";
			element += "</div>";
		}
		<?= $detailJawabPertanyaan ?>
		element += "</div>";
	}
	
	$(".discussions").html("");
	$(".discussions").append(element);
}

function getBiddingList() {
	var shipment_id = <?= $shipment_id ?>;
	$.ajax({
		url: '<?= base_url("kirim/getBiddingList") ?>',
		data: {			
			shipment_id: shipment_id
		},
		type: 'POST',
		error: function(jqXHR, exception) {
			alert(jqXHR + " : " + jqXHR.responseText);
		},
		success: function(json) {
			var result = jQuery.parseJSON(json);
			addBiddingListToTable(result);
		}
	});
}

function addBiddingListToTable(result) {
	var iLength = result.length;
	var element = "";
	for (var i = 0; i < iLength; i++) {
		element += "<tr>";
		element += "<td>" + addCommas(result[i].bidding_price) + " IDR</td>";
		element += "<td>" + result[i].username + "</td>";
		element += "<td>";
		element += "<div>Tanggal Ambil : " + result[i].bidding_pickupdate + "</div>";
		element += "<div>Keterangan : " + result[i].bidding_information + "</div>";
		element += "</td>";
		element += "<td>";
		if (result[i].bidding_status == 2) {
			element += "<div class='alasan-tolak'>DITOLAK<br><strong>Alasan : </strong>" + result[i].bidding_reason + "</div>";
		}
		element += "</td>";
		element += "</tr>";
	}
	
	$(".tbody-list-penawaran").html("");
	$(".tbody-list-penawaran").append(element);
}

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