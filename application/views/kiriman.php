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
				<div class="tabs-item" data-tabs-number="8">Cancel (<span class="tabs-item-count">0</span>)</div>
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
							<td>Jenis Muatan</td>
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
							<td>Jenis Muatan</td>
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
							<td>Jenis Muatan</td>
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
							<td>Jenis Muatan</td>
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
							<td>Jenis Muatan</td>
							<td>Supir</td>
							<td>Kendaraan</td>
							<td>Lacak</td>
							<td>Waktu Kiriman</td>
							<td>Total Waktu</td>
						</tr>
					</thead>
					<tbody class="tbody-kiriman">
					</tbody>
				</table>
			</div>
			<div class="tabs-content" data-tabs-number="8">
				<table class="table table-kiriman">
					<thead>
						<tr>
							<td>Nama Kirim</td>
							<td>Harga</td>
							<td>Asal</td>
							<td>Tujuan</td>
							<td>Jarak</td>
							<td>Cancel By</td>
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
	var kirimanUrl = [];
	kirimanUrl[1] = "<?= base_url("kiriman-saya/getOpenKiriman") ?>";
	kirimanUrl[2] = "<?= base_url("kiriman-saya/getPendingKiriman") ?>";
	kirimanUrl[3] = "<?= base_url("kiriman-saya/getPesananKiriman") ?>";
	kirimanUrl[4] = "<?= base_url("kiriman-saya/getDikirimKiriman") ?>";
	kirimanUrl[5] = "<?= base_url("kiriman-saya/getDiambilKiriman") ?>";
	kirimanUrl[6] = "<?= base_url("kiriman-saya/getDiterimaKiriman") ?>";
	kirimanUrl[7] = "<?= base_url("kiriman-saya/getSelesaiKiriman") ?>";
	kirimanUrl[8] = "<?= base_url("kiriman-saya/getCancelKiriman") ?>";
	
	var kirimanTabs = [];
	kirimanTabs[1] = "open";
	kirimanTabs[2] = "pending";
	kirimanTabs[3] = "pesanan";
	kirimanTabs[4] = "dikirim";
	kirimanTabs[5] = "diambil";
	kirimanTabs[6] = "diterima";
	kirimanTabs[7] = "selesai";
	kirimanTabs[8] = "cancel";
	
	getKirimanCount();
	getKiriman(kirimanUrl[1], 1, "open");
	
	$(".tabs-item").on("click", function() {
		var tabsNumber = $(this).data("tabs-number");
		getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
		
	});
	
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
				getKirimanCount();
				var tabsNumber = $(".tabs-item.active").data("tabs-number");
				getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
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
				getKirimanCount();
				var tabsNumber = $(".tabs-item.active").data("tabs-number");
				getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
			} else {
				alert(result);
			}
		});
	}
	
	function getKirimanCount() {
		ajaxCall("<?= base_url("kiriman-saya/getKirimanSaya") ?>", null, function(json) {
			var result = jQuery.parseJSON(json);
			assignKirimanCount(result);
		});
	}
	
	function assignKirimanCount(result) {
		var tabs = {
			t1: 0,
			t2: 0,
			t3: 0,
			t4: 0,
			t5: 0,
			t6: 0,
			t7: 0,
			t8: 0
		};
		
		for (var i = 0; i < result.length; i++) {
			switch (result[i].shipment_status) {
				case "-1":
					tabs.t1= result[i].count;
					break;
				case "0":
					tabs.t2 = result[i].count;
					break;
				case "1":
					tabs.t2 = result[i].count;
					break;
				case "2":
					tabs.t3 = result[i].count;
					break;
				case "3":
					tabs.t4 = result[i].count;
					break;
				case "4":
					tabs.t5 = result[i].count;
					break;
				case "5":
					tabs.t6 = result[i].count;
					break;
				case "6":
					tabs.t7 = result[i].count;
					break;
				case "7":
					tabs.t8 = result[i].count;
					break;
			}
		}
		
		for (var i = 1; i <= 8; i++) {
			updateTabsItemCount(i, tabs["t" + i]);
		}
	}
	
	function getKiriman(url, tabsNumber, tabs) {
		ajaxCall(url, null, function(json) {
			var result = jQuery.parseJSON(json);
			addKirimanToTable(result, tabsNumber, tabs);
		});
	}
	
	function addKirimanToTable(result, tabsNumber, tab) {
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
				jenis_muatan = "Undefined";
			}
			
			var tdJenisMuatan = "<td class='td-jenis-muatan'>" + jenis_muatan + "</td>";
			var additionalTd = "";
			var berakhir = "";
			var cancelBy = "";
			var ratingSection = "";
			var action = "<td><button class='btn-negative btn-cancel-transaction'>Batalkan Kiriman</button></td>";
			var waktu = "";
			switch (tab) {
				case "open":
					berakhir = "<td class='td-berakhir'>" + result[i].berakhir + "</td>";
					tdJenisMuatan = "";
					break;
				case "pending":
					tdJenisMuatan = "";
					break;
				case "pesanan":
					additionalTd = "<td>" + result[i].driver_names + "</td><td>" + result[i].vehicle_names + "</td><td>" + result[i].device_names + "</td>";
					break;
				case "dikirim":
					tab = "dikirim";
					additionalTd = "<td>" + result[i].driver_names + "</td><td>" + result[i].vehicle_names + "</td><td>" + result[i].device_names + "</td>";
					break;
				case "diambil":
					additionalTd = "<td>" + result[i].driver_names + "</td><td>" + result[i].vehicle_names + "</td><td>" + result[i].device_names + "</td>";
					break;
				case "diterima":
					additionalTd = "<td>" + result[i].driver_names + "</td><td>" + result[i].vehicle_names + "</td><td>" + result[i].device_names + "</td>";
					ratingSection = "<td><div class='rating-section'>" + getRatingJs() + "<textarea class='input-rating-feedback'></textarea><button class='btn-default btn-submit-rating'>Submit</button></div></td>";
					action = "";
					break;
				case "selesai":
					additionalTd = "<td>" + result[i].driver_names + "</td><td>" + result[i].vehicle_names + "</td><td>" + result[i].device_names + "</td>";
					action = "";
					waktu = "<td>" + result[i].waktu_kiriman + "</td><td>" + result[i].total_waktu + "</td>";
					break;
				case "cancel":
					action = "";
					tdJenisMuatan = "";
					cancelBy = "<td>" + result[i].cancel_username + "</td>";
					break;
			}
			
			element += "<tr class='tr-kiriman' data-id='" + result[i].shipment_id + "'><td class='td-title'><a href='<?= base_url("kirim/detail/") ?>" + result[i].shipment_id + "'>" + result[i].shipment_title + "</a><img class='shipment-picture' src='<?= base_url("assets/panel/images/") ?>" + result[i].shipment_pictures + "' /></td><td class='td-price'>Bid : " + result[i].bidding_count + "<br>Low : " + addCommas(result[i].low) + " IDR</td><td class='td-asal'>" + result[i].location_from_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan'>" + result[i].location_to_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km'>" + result[i].shipment_length + " Km</td>" + tdJenisMuatan + additionalTd + berakhir + ratingSection + action + waktu + cancelBy + "</tr>";
		}
		
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").html("");
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").append(element);
	}
});
</script>