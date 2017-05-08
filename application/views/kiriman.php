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
	<div class="tabs" data-id="asd">
		<div class="tabs-header">
			<div class="tabs-item-container">
				<div class="tabs-item active" data-tabs-number="1">Open (<span class="tabs-item-count">0</span>)</div>
				<div class="tabs-item" data-tabs-number="2">Pending (<span class="tabs-item-count">0</span>)</div>
				<div class="tabs-item" data-tabs-number="3">Pesanan (<span class="tabs-item-count">0</span>)</div>
				<div class="tabs-item" data-tabs-number="4">Dikirim (<span class="tabs-item-count">0</span>)</div>
				<div class="tabs-item" data-tabs-number="5">Diambil (<span class="tabs-item-count">0</span>)</div>
				<div class="tabs-item" data-tabs-number="6">Diterima (<span class="tabs-item-count">0</span>)</div>
				<div class="tabs-item" data-tabs-number="7">Selesai (<span class="tabs-item-count">0</span>)</div>
			</div>
			<div class="tabs-selection"></div>
		</div>
		<div class="tabs-body">
			<div class="tabs-content active" data-tabs-number="1">
				<table class="table table-kiriman">
					<thead>
						<tr>
							<td>Nama Kirim</td>
							<td>Harga</td>
							<td>Asal</td>
							<td>Tujuan</td>
							<td>Jarak</td>
							<td>Berakhir</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody class="tbody-kiriman">
					</tbody>
				</table>
			</div>
			<div class="tabs-content" data-tabs-number="2">
				<table class="table table-kiriman">
					<thead>
						<tr>
							<td>Nama Kirim</td>
							<td>Harga</td>
							<td>Asal</td>
							<td>Tujuan</td>
							<td>Jarak</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody class="tbody-kiriman">
					</tbody>
				</table>
			</div>
			<div class="tabs-content" data-tabs-number="3">
				<table class="table table-kiriman">
					<thead>
						<tr>
							<td>Nama Kirim</td>
							<td>Harga</td>
							<td>Asal</td>
							<td>Tujuan</td>
							<td>Jarak</td>
							<td>Supir</td>
							<td>Kendaraan</td>
							<td>Lacak</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody class="tbody-kiriman">
					</tbody>
				</table>
			</div>
			<div class="tabs-content" data-tabs-number="4">
				<table class="table table-kiriman">
					<thead>
						<tr>
							<td>Nama Kirim</td>
							<td>Harga</td>
							<td>Asal</td>
							<td>Tujuan</td>
							<td>Jarak</td>
							<td>Supir</td>
							<td>Kendaraan</td>
							<td>Lacak</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody class="tbody-kiriman">
					</tbody>
				</table>
			</div>
			<div class="tabs-content" data-tabs-number="5">
				<table class="table table-kiriman">
					<thead>
						<tr>
							<td>Nama Kirim</td>
							<td>Harga</td>
							<td>Asal</td>
							<td>Tujuan</td>
							<td>Jarak</td>
							<td>Supir</td>
							<td>Kendaraan</td>
							<td>Lacak</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody class="tbody-kiriman">
					</tbody>
				</table>
			</div>
			<div class="tabs-content" data-tabs-number="6">
				<table class="table table-kiriman">
					<thead>
						<tr>
							<td>Nama Kirim</td>
							<td>Harga</td>
							<td>Asal</td>
							<td>Tujuan</td>
							<td>Jarak</td>
							<td>Supir</td>
							<td>Kendaraan</td>
							<td>Lacak</td>
							<td>Rating</td>
						</tr>
					</thead>
					<tbody class="tbody-kiriman">
					</tbody>
				</table>
			</div>
			<div class="tabs-content" data-tabs-number="7">
				<table class="table table-kiriman">
					<thead>
						<tr>
							<td>Nama Kirim</td>
							<td>Harga</td>
							<td>Asal</td>
							<td>Tujuan</td>
							<td>Jarak</td>
							<td>Supir</td>
							<td>Kendaraan</td>
							<td>Lacak</td>
						</tr>
					</thead>
					<tbody class="tbody-kiriman">
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
</div>
</div>
</div>
<script>
$(function() {
	var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	getKirimanSaya();
	
	$(document).on("click", ".btn-submit-rating", function() {
		submitRating(this);
	});
	
	$(".dialog-background").on("click", function(e) {
		if (e.target.className == "dialog-background") {
			closeDialog();
		}
	});
	
	$(".btn-batal").on("click", function() {
		closeDialog();
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
		$.ajax({
			url: '<?= base_url("kiriman-saya/cancelShipment") ?>',
			data: {
				shipment_id: shipment_id
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					closeDialog();
					getKirimanSaya();
				} else {
					alert(result);
				}
			}
		});
	}
	
	function submitRating(element) {
		var shipment_rating_number = getRatingValue();
		var shipment_rating_feedback = $(element).parent().find("textarea.input-rating-feedback").val();
		var shipment_id = $(element).closest(".tr-kiriman").data("id");
		
		$.ajax({
			url: '<?= base_url("kiriman-saya/submitRating") ?>',
			data: {
				shipment_id: shipment_id,
				shipment_rating_number: shipment_rating_number,
				shipment_rating_feedback: shipment_rating_feedback
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					getKirimanSaya();
				} else {
					alert(result);
				}
			}
		});
	}
	
	function getKirimanSaya() {
		$.ajax({
			url: '<?= base_url("kiriman-saya/getKirimanSaya") ?>',
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(json) {
				var result = jQuery.parseJSON(json);
				addKirimanToTable(result);
			}
		});
	}
	
	function addKirimanToTable(result) {
		var iLength = result.length;
		var element = {
			"open": {
				count: 0,
				value: ""
			},
			"pending": {
				count: 0,
				value: ""
			},
			"pesanan": {
				count: 0,
				value: ""
			},
			"dikirim": {
				count: 0,
				value: ""
			},
			"diambil": {
				count: 0,
				value: ""
			},
			"diterima": {
				count: 0,
				value: ""
			},
			"selesai": {
				count: 0,
				value: ""
			},
			"cancel": {
				count: 0,
				value: ""
			}
		};
		
		var tab = "";
		for (var i = 0; i < iLength; i++) {
			var date_from = new Date(result[i].shipment_delivery_date_from);
			var fullDateFrom = date_from.getDate() + " " + month[date_from.getMonth()] + " " + date_from.getFullYear();
			var date_to = new Date(result[i].shipment_delivery_date_to);
			var fullDateTo = date_to.getDate() + " " + month[date_to.getMonth()] + " " + date_to.getFullYear();
			
			var additionalTd = "";
			var berakhir = "";
			var ratingSection = "";
			var action = "<td><button class='btn-negative btn-cancel-transaction'>Batalkan Kiriman</button></td>";
			switch (result[i].shipment_status) {
				case "-1":
					tab = "open";
					berakhir = "<td class='td-berakhir'>" + result[i].berakhir + "</td>";
					break;
				case "0":
					tab = "pending";
					break;
				case "1":
					tab = "pending";
					break;
				case "2":
					tab = "pesanan";
					additionalTd = "<td>" + result[i].driver_name + "</td><td>" + result[i].vehicle_name + "</td><td>" + result[i].device_name + "</td>";
					break;
				case "3":
					tab = "dikirim";
					additionalTd = "<td>" + result[i].driver_name + "</td><td>" + result[i].vehicle_name + "</td><td>" + result[i].device_name + "</td>";
					break;
				case "4":
					tab = "diambil";
					additionalTd = "<td>" + result[i].driver_name + "</td><td>" + result[i].vehicle_name + "</td><td>" + result[i].device_name + "</td>";
					break;
				case "5":
					tab = "diterima";
					additionalTd = "<td>" + result[i].driver_name + "</td><td>" + result[i].vehicle_name + "</td><td>" + result[i].device_name + "</td>";
					ratingSection = "<td><div class='rating-section'>" + getRatingJs() + "<textarea class='input-rating-feedback'></textarea><button class='btn-default btn-submit-rating'>Submit</button></div></td>";
					action = "";
					break;
				case "6":
					tab = "selesai";
					additionalTd = "<td>" + result[i].driver_name + "</td><td>" + result[i].vehicle_name + "</td><td>" + result[i].device_name + "</td>";
					action = "";
					break;
				case "7":
					tab = "cancel";
					break;
			}
			
			element[tab].count++;
			element[tab].value += "<tr class='tr-kiriman' data-id='" + result[i].shipment_id + "'><td class='td-title'><a href='<?= base_url("kirim/detail/") ?>" + result[i].shipment_id + "'>" + result[i].shipment_title + "</a><img class='shipment-picture' src='<?= base_url("assets/panel/images/") ?>" + result[i].shipment_pictures + "' /></td><td class='td-price'>Bid : " + result[i].bidding_count + "<br>Low : " + addCommas(result[i].shipment_price) + " IDR</td><td class='td-asal'>" + result[i].location_from_name + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan'>" + result[i].location_to_name + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km'>" + result[i].shipment_length + " Km</td>" + additionalTd + berakhir + ratingSection + action + "</tr>";
		}
		
		$(".tbody-kiriman").html("");
		$(".tabs-content[data-tabs-number='1'] .tbody-kiriman").append(element["open"].value);
		$(".tabs-content[data-tabs-number='2'] .tbody-kiriman").append(element["pending"].value);
		$(".tabs-content[data-tabs-number='3'] .tbody-kiriman").append(element["pesanan"].value);
		$(".tabs-content[data-tabs-number='4'] .tbody-kiriman").append(element["dikirim"].value);
		$(".tabs-content[data-tabs-number='5'] .tbody-kiriman").append(element["diambil"].value);
		$(".tabs-content[data-tabs-number='6'] .tbody-kiriman").append(element["diterima"].value);
		$(".tabs-content[data-tabs-number='7'] .tbody-kiriman").append(element["selesai"].value);
		updateTabsItemCount(1, element["open"].count);
		updateTabsItemCount(2, element["pending"].count);
		updateTabsItemCount(3, element["pesanan"].count);
		updateTabsItemCount(4, element["dikirim"].count);
		updateTabsItemCount(5, element["diambil"].count);
		updateTabsItemCount(6, element["diterima"].count);
		updateTabsItemCount(7, element["selesai"].count);
	}
});
</script>