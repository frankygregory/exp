<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="content">
	<div class="tabs" data-id="">
		<div class="tabs-header">
			<div class="tabs-item-container">
				<div class="tabs-item active" data-tabs-number="1">Open (<span class="tabs-item-count">0</span>)</div>
				<div class="tabs-item" data-tabs-number="2">Closed (<span class="tabs-item-count">0</span>)</div>
			</div>
			<div class="tabs-selection"></div>
		</div>
		<div class="tabs-body">
			<div class="tabs-content active" data-tabs-number="1">
				<div class="table-container">
					<table class="table table-kiriman">
						<thead>
							<tr>
								<td data-col='nama-kirim'>Nama Kirim</td>
								<td data-col='harga'>Harga</td>
								<td data-col='asal'>Asal</td>
								<td data-col='tujuan'>Tujuan</td>
								<td data-align="center" data-col='km'>KM</td>
								<td data-col='berakhir'>Berakhir</td>
							</tr>
						</thead>
						<tbody class="tbody-kiriman">
						</tbody>
					</table>
					<div class="table-empty-state shown">tidak ada data</div>
				</div>
			</div>
			<div class="tabs-content" data-tabs-number="2">
				<div class="table-container">
					<table class="table table-kiriman">
						<thead>
							<tr>
								<td data-col='nama-kirim'>Nama Kirim</td>
								<td data-col='harga'>Harga</td>
								<td data-col='asal'>Asal</td>
								<td data-col='tujuan'>Tujuan</td>
								<td data-align="center" data-col='km'>KM</td>
							</tr>
						</thead>
						<tbody class="tbody-kiriman">
						</tbody>
					</table>
					<div class="table-empty-state shown">tidak ada data</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script>
var month = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"];
var profilUrl = "<?= base_url("profil/") ?>";
var kirimanUrl = [];
kirimanUrl[1] = "<?= base_url("penawaran/getOpenKiriman") ?>";
kirimanUrl[2] = "<?= base_url("penawaran/getClosedKiriman") ?>";

var kirimanTabs = [];
kirimanTabs[1] = "open";
kirimanTabs[2] = "closed";
	
$(function() {
	getKiriman(kirimanUrl[1], 1, "open");
	getKirimanCount();
	
	$(".tabs-item").on("click", function() {
		var tabsNumber = $(this).data("tabs-number");
		getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
	});
});

function refreshData() {
	var tabsNumber = $(".tabs-item.active").data("tabs-number");
	getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
	getKirimanCount();
}

function getKirimanCount() {
	ajaxCall("<?= base_url("penawaran/getKirimanCount") ?>", null, function(json) {
		var result = jQuery.parseJSON(json);
		assignKirimanCount(result);
	});
}

function assignKirimanCount(result) {
	var tabs = {
		t1: 0,
		t2: 0
	};

	tabs.t1 = result[0].count_open;
	tabs.t2 = result[0].count_closed;
	
	for (var i = 1; i <= 2; i++) {
		updateTabsItemCount(i, tabs["t" + i]);
	}
}

function getKiriman(url, tabsNumber, tabs) {
	abortAjaxCall();
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").html("");
	setLoading(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state");
	ajaxCall(url, null, function(json) {
		removeLoading();
		var result = jQuery.parseJSON(json);
		addKirimanToTable(result, tabsNumber, tabs);
	});
}

function addKirimanToTable(result, tabsNumber, tab) {
	var iLength = result.length;
	var element = {
		"open": {
			value: ""
		},
		"closed": {
			value: ""
		}
	};
	
	for (var i = 0; i < iLength; i++) {
		
		var date_from = new Date(result[i].shipment_delivery_date_from);
		var fullDateFrom = date_from.getDate() + " " + month[date_from.getMonth()] + " " + date_from.getFullYear().toString().substring(2);
		var date_to = new Date(result[i].shipment_delivery_date_to);
		var fullDateTo = date_to.getDate() + " " + month[date_to.getMonth()] + " " + date_to.getFullYear().toString().substring(2);
		
		var jenis_muatan = "Penuh";
		if (result[i].shipment_jenis_muatan == 0) {
			jenis_muatan = "Parsial";
		}
		
		var additionalTd = "";
		var waktu = "";
		switch (tab) {
			case "open":
				var tdBerakhir = "<td>" + result[i].berakhir + "</td>";
				additionalTd += tdBerakhir;
				break;
			case "closed":
				
				break;
		}
		
		element[tab].value += "<tr class='tr-kiriman' data-id='" + result[i].shipment_id + "' data-shipment-title='" + result[i].shipment_title + "'><td class='td-title' data-align='center' data-col='nama-kirim'><a href='<?= base_url("kirim/detail/") ?>" + result[i].shipment_id + "'>" + "<img class='shipment-picture' src='<?= base_url("assets/panel/images/") ?>" + result[i].shipment_pictures + "' /><span>" + result[i].shipment_title + "</span></a></td><td class='td-price' data-col='harga'>Bid : " + result[i].bidding_count + "<br>Low : " + addCommas(result[i].low) + " IDR</td><td class='td-asal' data-col='asal'>" + result[i].location_from_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan' data-col='tujuan'>" + result[i].location_to_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km' data-align='center' data-col='km'>" + parseInt(result[i].shipment_length) + "</td>" + additionalTd + waktu + "</tr>";
	}
	
	if (iLength == 0) {
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").addClass("shown");
	} else {
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").removeClass("shown");
	}
	
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").html("");
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").append(element[tab].value);
	
}
</script>