<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="content">
	<div class="section-1">
		<div class="section-1a">
			<table class="table-section-1a">
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
			<div class="subsection">
				<div class="section-title">Item</div>
				<?php
				for ($i = 0; $i < sizeof($items); $i++)
				{	
					$item_dimension = "";
					if ($items[$i]["item_length"] != "") {
						$item_dimension = $items[$i]["item_length"] . " " . $items[$i]["item_dimension_unit"] . " X " . $items[$i]["item_width"] . " " . $items[$i]["item_dimension_unit"] . " X " . $items[$i]["item_height"] . " " . $items[$i]["item_dimension_unit"];
					}
					?>
					<div class="item">
						<table class="table-section-left">
							<tbody>
								<tr>
									<td class="td-item-label">Nama</td>
									<td class="td-titikdua">:</td>
									<td class="td-item-value"><?= $items[$i]['item_name'] ?></td>
								</tr>
								<tr>
									<td class="td-item-label">Deskripsi</td>
									<td class="td-titikdua">:</td>
									<td class="td-item-value"><?= $items[$i]['item_desc'] ?></td>
								</tr>
								<tr>
									<td class="td-item-label">Qty</td>
									<td class="td-titikdua">:</td>
									<td class="td-item-value"><?= $items[$i]['item_qty'] ?></td>
								</tr>
							</tbody>
						</table>
						<table class="table-section-right">
							<tbody>
								<tr>
									<td class="td-item-label">Dimensi</td>
									<td class="td-titikdua">:</td>
									<td class="td-item-value"><?= $item_dimension ?></td>
								</tr>
								<tr>
									<td class="td-item-label">Total Kubikasi</td>
									<td class="td-titikdua">:</td>
									<td class="td-item-value"><?= $items[$i]['item_kubikasi'] ?>  <?= $items[$i]['item_kubikasi_unit'] ?></td>
								</tr>
								<tr>
									<td class="td-item-label">Total Berat</td>
									<td class="td-titikdua">:</td>
									<td class="td-item-value"><?= $items[$i]['item_weight'] ?>  <?= $items[$i]['item_weight_unit'] ?></td>
								</tr>
							</tbody>
						</table>
					</div>
		<?php	}	?>
			</div>
		</div>
		<div class="section-1b">
			<div class="unage-container">
				<img class="shipment_picture" src="<?= base_url("assets/panel/images/") . $shipment_pictures ?>" />
			</div>
			<div class="asal">
				<div class="asal-title">Lokasi</div>
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
		</div>
	
		
	</div>
	<div class="section-3">
		<div class="section-title">Diskusi</div>
<?php	if ($role_id == 2 && $shipment_status == -1) { ?>
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
		if ($role_id == 2 && $shipment_status == -1) { ?>
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
				<button type="button" class="btn-default btn-kirim-penawaran">Kirim Penawaran</button>
				<button type="button" class="btn-neutral btn-batal-kirim-penawaran">Batal</button>
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
<div class="dialog-background">
	<div class="dialog dialog-konfirmasi-setuju">
		<div class="dialog-header">
			<div class="dialog-title">Setuju Bid</div>
		</div>
		<div class="dialog-body">
			<div></div>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-default btn-submit-setuju">Setuju</button>
			<button type="button" class="btn-neutral btn-batal">Batal Setuju</button>
		</div>
	</div>
</div>
<script>
var map;
var marker;
var lat, lng, center_from;

getDiscussions();
getBiddingList();
//getKendaraan();

<?php
$btnJawabPertanyaan = "";
$detailJawabPertanyaan = "";
$divQuestions = "element += \"<div class='questions'>\";";
$tr_bidding = "";
$btnSetujuBidding = "";

if ($role_id == 1 && $isOwner && $shipment_status == -1) { 
	$btnJawabPertanyaan = "element += \"<button class='btn-neutral btn-jawab-pertanyaan'>Jawab</button>\";";
	$detailJawabPertanyaan = "element += \"<div class='detail-jawab-pertanyaan'>\";" .
		"element += \"<textarea class='input-jawab-pertanyaan'></textarea>\";" .
		"element += \"<button class='btn-default btn-submit-jawab-pertanyaan'>Submit Jawaban</button>\";" .
		"element += \"</div>\";";
	$divQuestions = "element += \"<div class='questions' data-questions-id='\" + questions[i].questions_id + \"'>\";";

	$tr_bidding = " data-bidding_id='\" + result[i].bidding_id + \"'";
	$btnSetujuBidding = "element += \"";
	$btnSetujuBidding .= "<button class='btn-default btn-setuju'>Setuju</button>";
	$btnSetujuBidding .= "<button class='btn-negative btn-tolak'>Tolak</button>";
	$btnSetujuBidding .= "<div class='container-tolak'>";
	$btnSetujuBidding .= "<textarea class='input-alasan' data-bidding_id='\" + result[i].bidding_id + \"'></textarea>";
	$btnSetujuBidding .= "<button class='btn-negative btn-submit-tolak' data-bidding_id='\" + result[i].bidding_id + \"'>Tolak</button>";
	$btnSetujuBidding .= "<button class='btn-neutral btn-batal-tolak'>Batal Tolak</button>";
	$btnSetujuBidding .= "</div>";
	$btnSetujuBidding .= "\";";
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
		showDetailJawabPertanyaan(this);
	});
	
	$(document).on("click", ".btn-submit-jawab-pertanyaan", function() {
		jawabPertanyaan(this);
	});
	
	$(document).on("click", ".btn-setuju", function() {
		
		var tr_bidding = $(this).closest(".tr-bidding");
		var bidding_id = $(tr_bidding).data("bidding_id");
		var username = $(tr_bidding).children(".td-bidding-username").html();
		var harga = $(tr_bidding).children(".td-bidding-price").html();
		var text = "Setuju penawaran " + username + " seharga " + harga + "?";
		
		$(".dialog-konfirmasi-setuju").data("bidding_id", bidding_id);
		$(".dialog-konfirmasi-setuju .dialog-body").html(text);
		showDialog(".dialog-konfirmasi-setuju");
	});
	
	$(".btn-submit-setuju").on("click", function() {
		setujuBidding(this);
	});
	
	function setujuBidding(element) {
		var bidding_id = $(element).closest(".dialog-konfirmasi-setuju").data("bidding_id");
		var shipment_id = "<?= $shipment_id ?>";
		var form = "<form action='<?= base_url("kirim/setujuPenawaran") ?>' method='POST'>";
		var input_shipment = "<input type='hidden' name='shipment_id' value='" + shipment_id + "' />";
		var input_bidding = "<input type='hidden' name='bidding_id' value='" + bidding_id + "' />";
		form += "</form>";
		
		$("<form>", {
			"action": "<?= base_url("kirim/setujuPenawaran") ?>",
			"method": "POST",
			"html": input_shipment + input_bidding
		}).appendTo(document.body).submit();
		
		//$(form).appendTo("body").submit();
	}
	
	function jawabPertanyaan(element) {
		var discussions_item = $(element).closest(".discussions-item");
		var questions_id = $(discussions_item).children(".questions").data("questions-id");
		var answers_text = $(discussions_item).find("textarea").val();
		
		if (answers_text != "") {
			$.ajax({
				url: '<?= base_url("kirim/jawabPertanyaan") ?>',
				data: {
					submit_jawaban: true,
					questions_id: questions_id,
					answers_text: answers_text
				},
				type: 'POST',
				error: function(jqXHR, exception) {
					alert(jqXHR + " : " + jqXHR.responseText);
				},
				success: function(result) {
					if (result == "success") {
						getDiscussions();
					}
				}
			});
		} else {
			alert("Jawaban tidak boleh kosong");
			$(discussions_item).find("textarea").select();
		}
	}
	
	function showDetailJawabPertanyaan(element) {
		$(".detail-jawab-pertanyaan").css("display", "none");
		var detailJawabPertanyaan = $(element).closest(".discussions-item").children(".detail-jawab-pertanyaan");
		$(detailJawabPertanyaan).css("display", "block");
		$(detailJawabPertanyaan).children("textarea").select();
	}
	
	function closeDetailJawabPertanyaan() {
		$(".detail-jawab-pertanyaan").css("display", "none");
	}
	
	function submitTolak(element) {
		var bidding_id = $(element).data("bidding_id");
		var bidding_reason = $(element).siblings(".input-alasan").val();
		
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
		showDetailPenawaran(this);
	});
	
	$(document).on("click", ".btn-batal-kirim-penawaran", function() {
		hideDetailPenawaran();
	});
	
	$(document).on("keydown", "input[data-type='number']", function(e) {
		isNumber(e);
	});
	
	$( ".input-bidding-pickupdate" ).datepicker();
	
	$(document).on("click", ".btn-kirim-penawaran", function() {
		kirimPenawaran();
	});
	
	$(".btn-submit-pertanyaan").on("click", function() {
		kirimPertanyaan();
	});
	
	function kirimPertanyaan() {
		var questions_text = $(".input-pertanyaan").val();
		var shipment_id = <?= $shipment_id ?>;
		
		if (questions_text != "") {
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
		} else {
			alert("Pertanyaan tidak boleh kosong");
			$(".input-pertanyaan").select();
		}
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
	
	function showDetailPenawaran(element) {
		$(element).css("display", "none");
		$(".detail-penawaran").css("display", "block");
		$(".input-bidding-price").select();
	}
	
	function hideDetailPenawaran() {
		$(".btn-tawar").css("display", "block");
		$(".detail-penawaran").css("display", "none");
		clearErrors();
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
						hideDetailPenawaran();
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
		element += "<tr class='tr-bidding' <?= $tr_bidding ?>>";
		element += "<td class='td-bidding-price'>" + addCommas(result[i].bidding_price) + " IDR</td>";
		element += "<td class='td-bidding-username'>" + result[i].username + "</td>";
		element += "<td class='td-bidding-tanggal-ambil'>";
		element += "<div>Tanggal Ambil : " + result[i].bidding_pickupdate + "</div>";
		element += "<div>Keterangan : " + result[i].bidding_information + "</div>";
		element += "</td>";
		element += "<td>";
		if (result[i].bidding_status == 1) {
			element += "DITERIMA";
		}
		else if (result[i].bidding_status == 2) {
			element += "<div class='alasan-tolak'>DITOLAK<br><strong>Alasan : </strong>" + result[i].bidding_reason + "</div>";
		} else {
		<?= $btnSetujuBidding ?>
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
	
	map = new google.maps.Map(document.getElementById('map_asal'), {
		scrollwheel: false,
		disableDoubleClickZoom: true,
		draggable: false,
		panControl: false,
		clickableIcons: false,
		streetViewControl: false,
		disableDefaultUI: true
	});
	
	map.addListener("click", function(e) {
		return false;
	});

	var directionsService = new google.maps.DirectionsService;
	var directionsDisplay = new google.maps.DirectionsRenderer;
	directionsDisplay.setMap(map);
	calculateAndDisplayRoute(directionsService, directionsDisplay);
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
	directionsService.route({
		origin: new google.maps.LatLng(<?= $location_from_lat ?>, <?= $location_from_lng ?>),
		destination: new google.maps.LatLng(<?= $location_to_lat ?>, <?= $location_to_lng ?>),
		travelMode: "DRIVING"
	}, function(response, status) {
		if (status === "OK") {
			directionsDisplay.setDirections(response);
			var result = "";
			for (var p in response) {
				if ( response.hasOwnProperty(p) ) {
					result += p + " , " + response[p] + "\n";
				} 
			}
			alert(result);
		} else {
			alert(status);
		}
	});
}
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCt0M5ZsAQf8_sLJXsviGEOJHQn15QUKXM&callback=initMap" async defer></script>
</div>
</div>