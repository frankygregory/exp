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
	ajaxCall(getKirimanCountUrl, null, function(json) {
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
		
		var shipment_picture = (result[i].shipment_pictures == "") ? "default.gif" : result[i].shipment_pictures;
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
		
		element[tab].value += "<tr class='tr-kiriman' data-id='" + result[i].shipment_id + "' data-shipment-title='" + result[i].shipment_title + "'><td class='td-title' data-align='center' data-col='nama-kirim'><a href='" + shipmentUrl + result[i].shipment_id + "'>" + "<img class='shipment-picture' src='" + shipmentPictureUrl + shipment_picture + "' onerror='this.onerror=null; this.src=\"" + shipmentPictureUrl + "\";' /><span>" + result[i].shipment_title + "</span></a></td><td class='td-price' data-col='harga'>Bid : " + result[i].bidding_count + "<br>Low : " + addCommas(result[i].low) + " IDR</td><td class='td-asal' data-col='asal'>" + result[i].location_from_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan' data-col='tujuan'>" + result[i].location_to_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km' data-align='center' data-col='km'>" + parseInt(result[i].shipment_length) + "</td>" + additionalTd + waktu + "</tr>";
	}
	
	if (iLength == 0) {
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").addClass("shown");
	} else {
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").removeClass("shown");
	}
	
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").html("");
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").append(element[tab].value);
	
}