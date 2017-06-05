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
				<div class="tabs-item" data-tabs-number="2">On Progress (<span class="tabs-item-count">0</span>)</div>
				<div class="tabs-item" data-tabs-number="3">Selesai (<span class="tabs-item-count">0</span>)</div>
				<div class="tabs-item" data-tabs-number="4">Cancel (<span class="tabs-item-count">0</span>)</div>
			</div>
			<div class="tabs-selection"></div>
		</div>
		<div class="tabs-body">
			<div class="tabs-content active" data-tabs-number="1">
				<div class="table-container">
					<table class="table table-kiriman">
						<thead>
							<tr>
								<td data-align="center" data-col='nama-kirim'>Nama Kirim</td>
								<td data-col='harga'>Harga</td>
								<td data-col='asal'>Asal</td>
								<td data-col='tujuan'>Tujuan</td>
								<td data-align="center" data-col='km'>KM</td>
								<td data-col='berakhir'>Berakhir</td>
								<td data-align="center" data-col='action'>Action</td>
							</tr>
						</thead>
						<tbody class="tbody-kiriman">
						</tbody>
					</table>
				</div>
			</div>
			<div class="tabs-content" data-tabs-number="2">
				<div class="table-container">
					<table class="table table-kiriman">
						<thead>
							<tr>
								<td data-col='nama-kirim' data-align="center">Nama Kirim</td>
								<td data-col='harga'>Harga</td>
								<td data-col='asal'>Asal</td>
								<td data-col='tujuan'>Tujuan</td>
								<td data-col='km' data-align="center">Km</td>
								<td data-col='status' data-align='center'>Status</td>
								<td data-col='keterangan'>Keterangan</td>
								<td data-col='action' data-align='center'>Action</td>
							</tr>
						</thead>
						<tbody class="tbody-kiriman">
						</tbody>
					</table>
				</div>
			</div>
			<div class="tabs-content" data-tabs-number="3">
				<div class="table-container">
					<table class="table table-kiriman">
						<thead>
							<tr>
								<td data-col='nama-kirim' data-align="center">Nama Kirim</td>
								<td data-col='harga'>Harga</td>
								<td data-col='asal'>Asal</td>
								<td data-col='tujuan'>Tujuan</td>
								<td data-col='km' data-align="center">Km</td>
								<td data-col='status' data-align='center'>Status</td>
								<td data-col='keterangan'>Keterangan</td>
							</tr>
						</thead>
						<tbody class="tbody-kiriman">
						</tbody>
					</table>
				</div>
			</div>
			<div class="tabs-content" data-tabs-number="4">
				<div class="table-container">
					<table class="table table-kiriman">
						<thead>
							<tr>
								<td data-align="center" data-col='nama-kirim'>Nama Kirim</td>
								<td data-col='harga'>Harga</td>
								<td data-col='asal'>Asal</td>
								<td data-col='tujuan'>Tujuan</td>
								<td data-align="center" data-col='km'>KM</td>
								<td data-col='cancel-by'>Cancel by</td>
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
</div>
<script>
var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
var kirimanUrl = [];
kirimanUrl[1] = "<?= base_url("kiriman-saya/getOpenKiriman") ?>";
kirimanUrl[2] = "<?= base_url("kiriman-saya/getProgressKiriman") ?>";
kirimanUrl[3] = "<?= base_url("kiriman-saya/getSelesaiKiriman") ?>";
kirimanUrl[4] = "<?= base_url("kiriman-saya/getCancelKiriman") ?>";

var kirimanTabs = [];
kirimanTabs[1] = "open";
kirimanTabs[2] = "progress";
kirimanTabs[3] = "selesai";
kirimanTabs[4] = "cancel";

var statusDetail = {
	"-1": "Open",
	"0": {
		"darat": "Pending",
		"laut": "Pending"
	},
	"1": {
		"darat": "Konfirmasi",
		"laut": "Konfirmasi"
	},
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

$(function() {
	getKirimanCount();
	getKiriman(kirimanUrl[1], 1, "open");

	$(".tabs-item").on("click", function() {
		var tabsNumber = $(this).data("tabs-number");
		getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
	});

	var headerHeight = parseInt($(".navigation-header").css("height"));
	var theadHeight = parseInt($(".table-kiriman thead").css("height"));
	var tbodyTop = $(".table-kiriman tbody").offset().top;
	var tbodyPosition = tbodyTop - headerHeight - theadHeight;
	
	$(".container-content").on("scroll", scrollDownEvent);

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

	function scrollDownEvent() {
		var scrollTop = $(".container-content").scrollTop();
		if (scrollTop >= tbodyPosition) {
			$(".table-kiriman").addClass("fixed");
			$(".container-content").off("scroll");
			$(".container-content").on("scroll", scrollUpEvent);
		}
	}

	function scrollUpEvent() {
		var scrollTop = $(".container-content").scrollTop();
		if (scrollTop <= tbodyPosition) {
			$(".table-kiriman").removeClass("fixed");
			$(".container-content").off("scroll");
			$(".container-content").on("scroll", scrollDownEvent);
		}
	}
});

function cancelShipment() {
	var shipment_id = $(".dialog-konfirmasi-cancel-transaction").data("id");
	var data = {
		shipment_id: shipment_id
	};
	ajaxCall("<?= base_url("kiriman-saya/cancelShipment") ?>", data, function(result) {
		if (result == "success") {
			closeDialog();
			refreshData();
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
			refreshData();
		} else {
			alert(result);
		}
	});
}

function refreshData() {
	getKirimanCount();
	var tabsNumber = $(".tabs-item.active").data("tabs-number");
	getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
}

function getKirimanCount() {
	ajaxCall("<?= base_url("kiriman-saya/getKirimanCount") ?>", null, function(json) {
		var result = jQuery.parseJSON(json);
		assignKirimanCount(result);
	});
}

function assignKirimanCount(result) {
	var tabs = {
		t1: 0,
		t2: 0,
		t3: 0,
		t4: 0
	};
	
	for (var i = 0; i < result.length; i++) {
		switch (result[i].shipment_status) {
			case "-1":
				tabs.t1 = result[i].count;
				break;
			case "6":
				tabs.t3 = result[i].count;
				break;
			case "7":
				tabs.t4 = result[i].count;
				break;
			default:
				tabs.t2 += parseInt(result[i].count);
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
	var element = {
		"open": "",
		"progress": "",
		"selesai": "",
		"cancel": ""
	};
	
	for (var i = 0; i < iLength; i++) {
		var date_from = new Date(result[i].shipment_delivery_date_from);
		var fullDateFrom = date_from.getDate() + " " + month[date_from.getMonth()] + " " + date_from.getFullYear().toString().substring(2);
		var date_to = new Date(result[i].shipment_delivery_date_to);
		var fullDateTo = date_to.getDate() + " " + month[date_to.getMonth()] + " " + date_to.getFullYear().toString().substring(2);
		
		var jenis_muatan = "Penuh";
		if (result[i].shipment_jenis_muatan == 0) {
			jenis_muatan = "Parsial";
		} else if (result[i].shipment_jenis_muatan == -1) {
			jenis_muatan = "";
		}
		
		var bidding_type = result[i].bidding_type;
		var keteranganTd = "";
		var status = result[i].shipment_status;
		var statusTd = "";
		var actionTd = "<td data-col='action'><button class='btn-negative btn-cancel-transaction'>Batalkan Kiriman</button></td>";
		var berakhirTd = "";
		var cancelByTd = "";

		var ratingSection = "";

		var keterangan = {};
		keterangan["darat"] = "Supir : " + result[i].driver_names + "<br>Kendaraan : " + result[i].vehicle_names + "<br>Alat : " + result[i].device_names;
		keterangan["laut"] = "Kapal : " + result[i].ship_id + "<br>No. Kontainer : " + result[i].shipment_details_container_number;
		var low = "Low : ";
		switch (tab) {
			case "open":
				berakhirTd = "<td data-col='berakhir'>" + result[i].berakhir + "</td>";
				break;
			case "progress":
				low = "";
				keteranganTd = "<td data-col='keterangan'>";
				if (status > 1) {
					keteranganTd += keterangan[bidding_type];
				}
				keteranganTd += "</td>";
				
				if (status == 5) {
					actionTd = "<td data-col='action'><div class='rating-section'>" + getRatingJs() + "<textarea class='input-rating-feedback'></textarea><button class='btn-default btn-submit-rating'>Submit</button></div></td>";
				} else if (status >= 3) {
					actionTd = "<td data-col='action'></td>";
				} else if (status == 2) {
					if (bidding_type == "laut") {
						actionTd = "<td data-col='action'></td>";
					}
				}
				
				statusTd = "<td data-col='status' data-align='center'>" + statusDetail[status][bidding_type] + "</td>";
				break;
			case "selesai":
				low = "";
				keteranganTd = "<td data-col='keterangan'>" + keterangan[bidding_type];
				
				var waktu_kiriman = "";
				if (bidding_type == "darat") {
					waktu_kiriman = "<br>Waktu Kiriman : " + result[i].waktu_kiriman + " hari";
				}
				keteranganTd += waktu_kiriman + "<br>Total Waktu : " + result[i].total_waktu + " hari";
				keteranganTd += "</td>";

				actionTd = "";
				statusTd = "<td data-col='status' data-align='center'>" + statusDetail[status] + "</td>";
				break;
			case "cancel":
				cancelByTd += "<td data-col='cancel-by'>" + result[i].cancel_username + "</td>";
				actionTd = "";
				break;
		}
		
		element[tab] += "<tr class='tr-kiriman' data-id='" + result[i].shipment_id + "'><td class='td-title' data-col='nama-kirim' data-align='center'><a href='<?= base_url("kirim/detail/") ?>" + result[i].shipment_id + "'>" + result[i].shipment_title + "<img class='shipment-picture' src='<?= base_url("assets/panel/images/") ?>" + result[i].shipment_pictures + "' /></a></td><td class='td-price' data-col='harga'>Bid : " + result[i].bidding_count + "<br>" + low + addCommas(result[i].low) + " IDR</td><td class='td-asal' data-col='asal'>" + result[i].location_from_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan' data-col='tujuan'>" + result[i].location_to_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km' data-col='km' data-align='center'>" + parseInt(result[i].shipment_length) + "</td>" + statusTd + keteranganTd + berakhirTd + actionTd + cancelByTd + "</tr>";
	}
	
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").html("");
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").append(element[tab]);
}
</script>