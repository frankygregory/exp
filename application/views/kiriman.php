<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="dialog-background">
	<div class="dialog dialog-konfirmasi-cancel-transaction">
		<div class="dialog-header">
			<div class="dialog-title">Pembatalan Kiriman</div>
		</div>
		<div class="dialog-body">
			<div></div>
		</div>
		<div class="dialog-footer">
			<button type="button" class="btn-negative btn-submit-cancel-transaction">Batalkan Kiriman</button>
			<button type="button" class="btn-neutral btn-batal">Tidak</button>
		</div>
	</div>
</div>
<div class="content">
	<div class="table-container">
		<table class="table table-kiriman">
			<thead>
				<tr>
					<td data-align="center">Nama Kirim</td>
					<td>Harga</td>
					<td>Asal</td>
					<td>Tujuan</td>
					<td data-align="center">Km</td>
					<td>Keterangan</td>
					<td>Status</td>
					<td data-align='center'>Action</td>
				</tr>
			</thead>
			<tbody class="tbody-kiriman">
			</tbody>
		</table>
	</div>
</div>
</div>
</div>
<script>
$(function() {
	var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	var kirimanUrl = "<?= base_url("kiriman-saya/getOpenKiriman") ?>";
	
	getKiriman(kirimanUrl, 1, "open");
	
	$(document).on("click", ".btn-submit-rating", function() {
		submitRating(this);
	});
	
	$(document).on("click", ".btn-cancel-transaction", function() {
		var shipment_id = $(this).closest(".tr-kiriman").data("id");
		var shipment_title = $(this).closest(".tr-kiriman").find(".td-title").html();
		$(".dialog-konfirmasi-cancel-transaction .dialog-body").html("Batalkan pengiriman untuk<br>" + shipment_title);
		$(".dialog-konfirmasi-cancel-transaction").data("id", shipment_id);
		showDialog(".dialog-konfirmasi-cancel-transaction");
	});
	
	$(".btn-submit-cancel-transaction").on("click", function() {
		cancelShipment();
	});
	
	function cancelShipment() {
		var shipment_id = $(".dialog-konfirmasi-cancel-transaction").data("id");
		var data = {
			shipment_id: shipment_id
		};
		ajaxCall("<?= base_url("kiriman-saya/cancelShipment") ?>", data, function(result) {
			if (result == "success") {
				closeDialog();
				getKiriman(kirimanUrl);
			} else {
				alert(result);
			}
		});
	}
	
	function submitRating(element) {
		var shipment_rating_number = getRatingValue();
		var shipment_rating_feedback = $(element).parent().find("textarea.input-rating-feedback").val();
		var shipment_id = $(element).closest(".tr-kiriman").data("id");
		
		var data = {
			shipment_id: shipment_id,
			shipment_rating_number: shipment_rating_number,
			shipment_rating_feedback: shipment_rating_feedback
		};
		ajaxCall("<?= base_url("kiriman-saya/submitRating") ?>", data, function(result) {
			if (result == "success") {
				getKiriman(kirimanUrl);
			} else {
				alert(result);
			}
		});
	}

	function getKiriman(url) {
		ajaxCall(url, null, function(json) {
			var result = jQuery.parseJSON(json);
			addKirimanToTable(result);
		});
	}
	
	function addKirimanToTable(result) {
		var iLength = result.length;
		var element = "";
		
		for (var i = 0; i < iLength; i++) {
			var date_from = new Date(result[i].shipment_delivery_date_from);
			var fullDateFrom = date_from.getDate() + " " + month[date_from.getMonth()] + " " + date_from.getFullYear();
			var date_to = new Date(result[i].shipment_delivery_date_to);
			var fullDateTo = date_to.getDate() + " " + month[date_to.getMonth()] + " " + date_to.getFullYear();
			
			var jenis_muatan = "Penuh";
			if (result[i].shipment_jenis_muatan == 0) {
				jenis_muatan = "Parsial";
			} else if (result[i].shipment_jenis_muatan == -1) {
				jenis_muatan = "";
			}
			
			var bidding_type = result[i].bidding_type;
			var additionalTd = "";
			var berakhir = "";
			var cancelBy = "";
			var ratingSection = "";
			var status = result[i].shipment_status;
			var statusDetail = {
				"-1": "Open",
				"0": "Pending",
				"1": "Konfirmasi",
				"2": {
					"darat": "Pesanan",
					"laut": "Door 1"
				},
				"3": {
					"darat": "Dikirim",
					"laut": "Port 1"
				},
				"4": {
					"darat": "Diambil",
					"laut": "Port 2"
				},
				"5": {
					"darat": "Diterima",
					"laut": "Door 2"
				},
				"6": "Selesai",
				"7": "Cancel"
			};
			var action = "<button class='btn-negative btn-cancel-transaction'>Batalkan Kiriman</button>";

			var keterangan = {};
			keterangan["darat"] = "Supir : " + result[i].driver_names + "<br>Kendaraan : " + result[i].vehicle_names + "<br>Alat : " + result[i].device_names;
			keterangan["laut"] = "Kapal : " + result[i].ship_id + "<br>No. Kontainer : " + result[i].shipment_details_container_number;
			switch (result[i].shipment_status) {
				case "-1":
					additionalTd += "Berakhir : " + result[i].berakhir;
					status = statusDetail["-1"];
					break;
				case "0":
					status = statusDetail["0"];
					break;
				case "1":
					status = statusDetail["1"];
					break;
				case "2":
					additionalTd += keterangan[bidding_type];
					status = statusDetail["1"] + "<br>" + statusDetail["2"][bidding_type];
					break;
				case "3":
					additionalTd += keterangan[bidding_type];
					status = statusDetail["1"] + "<br>" + statusDetail["2"][bidding_type] + "<br>" + statusDetail["3"][bidding_type];
					break;
				case "4":
					additionalTd += keterangan[bidding_type];
					status = statusDetail["1"] + "<br>" + statusDetail["2"][bidding_type] + "<br>" + statusDetail["3"][bidding_type] + "<br>" + statusDetail["4"][bidding_type];
					break;
				case "5":
					additionalTd += keterangan[bidding_type];
					ratingSection = "<div class='rating-section'>" + getRatingJs() + "<textarea class='input-rating-feedback'></textarea><button class='btn-default btn-submit-rating'>Submit</button></div>";
					action = "";
					status = statusDetail["1"] + "<br>" + statusDetail["2"][bidding_type] + "<br>" + statusDetail["3"][bidding_type] + "<br>" + statusDetail["4"][bidding_type] + "<br>" + statusDetail["5"][bidding_type];
					break;
				case "6":
					additionalTd += keterangan[bidding_type];
					
					var waktu_kiriman = "";
					if (bidding_type == "darat") {
						waktu_kiriman = "<br>Waktu Kiriman : " + result[i].waktu_kiriman;
					}
					additionalTd  += waktu_kiriman + "<br>Total Waktu : " + result[i].total_waktu;

					action = "";
					status = statusDetail["1"] + "<br>" + statusDetail["2"][bidding_type] + "<br>" + statusDetail["3"][bidding_type] + "<br>" + statusDetail["4"][bidding_type] + "<br>" + statusDetail["5"][bidding_type] + "<br>" + statusDetail["6"];
					break;
				case "7":
					additionalTd += "Cancel By : " + result[i].cancel_username;
					action = "";
					status = statusDetail["7"];
					break;
			}
			
			element += "<tr class='tr-kiriman' data-id='" + result[i].shipment_id + "'><td class='td-title' data-align='center'><a href='<?= base_url("kirim/detail/") ?>" + result[i].shipment_id + "'>" + result[i].shipment_title + "<img class='shipment-picture' src='<?= base_url("assets/panel/images/") ?>" + result[i].shipment_pictures + "' /></a></td><td class='td-price'>Bid : " + result[i].bidding_count + "<br>Low : " + addCommas(result[i].low) + " IDR</td><td class='td-asal'>" + result[i].location_from_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan'>" + result[i].location_to_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km' data-align='center'>" + parseInt(result[i].shipment_length) + "</td><td>" + additionalTd + "</td><td>" + status + "</td><td>" + ratingSection + action + "</td></tr>";
		}
		
		$(".tbody-kiriman").html("");
		$(".tbody-kiriman").append(element);
	}
});
</script>