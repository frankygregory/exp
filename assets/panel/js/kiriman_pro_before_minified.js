$(function() {
	$(".tabs-item").on("tabs-item-click", function() {
		var tabsNumber = $(this).data("tabs-number");
		getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
	});

	var hash = window.location.hash;
	if (hash != "") {
		hash = hash.substring(1);
		$(".tabs-item[data-label='" + hash + "']").click();
		if ($(".tabs-item[data-label='" + hash + "']").length == 0) {
			getKiriman(kirimanUrl[1], 1, "open");
		}
	} else {
		getKiriman(kirimanUrl[1], 1, "open");
	}
	getKirimanCount();

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
		var shipment_title = $(this).closest(".tr-kiriman").find(".td-title span").html();
		$(".dialog-konfirmasi-cancel-transaction .dialog-body").html("Batalkan pengiriman untuk<br><strong>" + shipment_title + "</strong>");
		$(".dialog-konfirmasi-cancel-transaction").data("id", shipment_id);
		showDialog(".dialog-konfirmasi-cancel-transaction");
	});
	
	$(".btn-submit-cancel-transaction").on("click", function() {
		cancelShipment();
	});

	$(document).on("click", ".tabs-content[data-tabs-number='2'] .btn-view-kontak", function() {
		var tr = $(this).closest(".tr-kiriman");
		var detailElement = $(tr).next();
		if ($(detailElement).height() == 0) {
			$(detailElement).addClass("show");
			if ($(detailElement).find(".row-detail-td-content").html().trim() == "") {
				getDetailPengirim(tr);
			}
		} else {
			$(detailElement).removeClass("show");
		}
	});

	$(document).on("click", ".tabs-content[data-tabs-number='3'] .btn-view-kontak", function() {
		var tr = $(this).closest(".tr-kiriman");
		var detailElement = $(tr).next();
		if (detailElement.height() == 0) {
			detailElement.addClass("show");
			if (detailElement.find(".row-detail-td-content").html().trim() == "") {
				getAllStatusKiriman(tr, detailElement);
			}
		} else {
			detailElement.removeClass("show");
		}
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

function getAllStatusKiriman(tr, element) {
	var shipment_id = $(tr).data("id");
	ajaxCall(getAllStatusKirimanUrl, {shipment_id: shipment_id}, function(json) {
		var result = JSON.parse(json);
		if (result.status == "success") {
			var status_0 = result.pending_date;
			var status_1 = result.confirmation_date;
			var status_2, status_2_name, status_3, status_3_name, status_4, status_4_name, status_5, status_5_name, status_6;
			if (result.bidding_type == 1) {
				status_2 = result.order_date;
				status_2_name = "Pesanan";
				status_3 = result.delivery_date;
				status_3_name = "Dikirim";
				status_4 = result.pickup_date;
				status_4_name = "Diambil";
				status_5 = result.receive_date;
				status_5_name = "Diterima";
				status_6 = result.end_date;
			} else {
				status_2 = result.door_start_date;
				status_2_name = "Door 1";
				status_3 = result.port_start_date;
				status_3_name = "Port 1";
				status_4 = result.port_finish_date;
				status_4_name = "Diambil";
				status_5 = result.door_finish_date;
				status_5_name = "Door 2";
				status_6 = result.ending_date;
			}

			var content = "";
			content += "<div class='detail-status'>";
			content += "<div class='detail-status-title'>Status</div>";
			content += "<div class='status-item'><span class='status-badge' data-status='0'>Pending</span><span class='status-time'>" + status_0 + "</span></div>";
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='1'>Konfirmasi</span><span class='status-time'>" + status_1 + "</span></div>";
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='2'>" + status_2_name + "</span><span class='status-time'>" + status_2 + "</span></div>";
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='3'>" + status_3_name + "</span><span class='status-time'>" + status_3 + "</span></div>";
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='4'>" + status_4_name + "</span><span class='status-time'>" + status_4 + "</span></div>";
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='5'>" + status_5_name + "</span><span class='status-time'>" + status_5 + "</span></div>";
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='6'>Selesai</span><span class='status-time'>" + status_6 + "</span></div>";
			content += "</div>";
			$(element).find(".row-detail-td-content").html(content);
		}
	});
}

function getDetailPengirim(element) {
	var shipment_id = $(element).data("id");
	ajaxCall(getDetailPengirimUrl, {shipment_id: shipment_id}, function(json) {
		var result = jQuery.parseJSON(json);
		var content = "";
		content += "<div class='detail-col'>";
		content += "<div class='detail-title'>Info Ekspedisi</div>";
		content += "<div class='detail-row'><span class='detail-label'>Nama</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["user_fullname"] + "</span></div>";
		content += "<div class='detail-row'><span class='detail-label'>Alamat</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["user_address"] + "</span></div>";
		content += "<div class='detail-row'><span class='detail-label'>Telepon</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["user_telephone"] + "</span></div>";
		content += "<div class='detail-row'><span class='detail-label'>Handphone</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["user_handphone"] + "</span></div>";
		content += "</div>";

		var status_0 = result["pending_date"];
		var status_1 = result["confirmation_date"];
		var status_2, status_2_name, status_3, status_3_name, status_4, status_4_name, status_5, status_5_name;

		if (result["bidding_type"] == "1") {
			status_2 = result["order_date"];
			status_2_name = "Pesanan";
			status_3 = result["delivery_date"];
			status_3_name = "Dikirim";
			status_4 = result["pickup_date"];
			status_4_name = "Diambil";
			status_5 = result["receive_date"];
			status_5_name = "Diterima";

			if (result["shipment_status"] > 1) {
				content += "<div class='detail-col'>";
				content += "<div class='detail-title'>Detail Supir</div>";
				content += "<div class='detail-row'><span class='detail-label'>Nama</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["driver_name"] + "</span></div>";
				content += "<div class='detail-row'><span class='detail-label'>Handphone</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["driver_handphone"] + "</span></div>";
				content += "<div class='detail-row'><span class='detail-label'>Kendaraan</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["vehicle_name"] + " (" + result["vehicle_nomor"] + ")</span></div>";
				content += "</div>";
			}
		} else {
			status_2 = result["door_start_date"];
			status_2_name = "Door 1";
			status_3 = result["port_start_date"];
			status_3_name = "Port 1";
			status_4 = result["port_finish_date"];
			status_4_name = "Port 2";
			status_5 = result["door_finish_date"];
			status_5_name = "Door 2";

			if (result["shipment_status"] > 1) {
				content += "<div class='detail-col'>";
				content += "<div class='detail-title'>Detail Kiriman</div>";
				content += "<div class='detail-row'><span class='detail-label'>No. Kontainer</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["shipment_details_container_number"] + "</span></div>";
				content += "</div>";
			}
		}

		content += "<div class='detail-status'>";
		content += "<div class='detail-status-title'>Status</div>";
		content += "<div class='status-item'><span class='status-badge' data-status='0'>Pending</span><span class='status-time'>" + status_0 + "</span></div>";
		if (result["shipment_status"] >= 1) {
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='1'>Konfirmasi</span><span class='status-time'>" + status_1 + "</span></div>";
		}
		if (result["shipment_status"] >= 2) {
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='2'>" + status_2_name + "</span><span class='status-time'>" + status_2 + "</span></div>";
		}
		if (result["shipment_status"] >= 3) {
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='3'>" + status_3_name + "</span><span class='status-time'>" + status_3 + "</span></div>";
		}
		if (result["shipment_status"] >= 4) {
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='4'>" + status_4_name + "</span><span class='status-time'>" + status_4 + "</span></div>";
		}
		if (result["shipment_status"] >= 5) {
			content += '<svg class="svg-right-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" width="22" height="22" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="m40.4,121.3c-0.8,0.8-1.8,1.2-2.9,1.2s-2.1-0.4-2.9-1.2c-1.6-1.6-1.6-4.2 0-5.8l51-51-51-51c-1.6-1.6-1.6-4.2 0-5.8 1.6-1.6 4.2-1.6 5.8,0l53.9,53.9c1.6,1.6 1.6,4.2 0,5.8l-53.9,53.9z"/></g></svg>';
			content += "<div class='status-item'><span class='status-badge' data-status='5'>" + status_5_name + "</span><span class='status-time'>" + status_5 + "</span></div>";
		}
		content += "</div>";
		
		$(element).next().find(".row-detail-td-content").html(content);
	});
}

function cancelShipment() {
	showFullscreenLoading();
	var shipment_id = $(".dialog-konfirmasi-cancel-transaction").data("id");
	var data = {
		shipment_id: shipment_id
	};
	ajaxCall(cancelShipmentUrl, data, function(result) {
		if (result == "success") {
			hideFullscreenLoading();
			closeDialog();
			refreshData();
		} else {
			alert(result);
		}
	});
}

function submitRating(element) {
	showFullscreenLoading();
	var shipment_rating_number = getRatingValue();
	var shipment_rating_feedback = $(element).parent().find("textarea.input-rating-feedback").val();
	var shipment_id = $(element).closest(".tr-kiriman").data("id");
	
	var data = {
		shipment_id: shipment_id,
		shipment_rating_number: shipment_rating_number,
		shipment_rating_feedback: shipment_rating_feedback
	};
	ajaxCall(submitRatingUrl, data, function(result) {
		hideFullscreenLoading();
		if (result == "success") {
			refreshData();
		} else {
			alert(result);
		}
	});
}

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
		t2: 0,
		t3: 0,
		t4: 0
	};
	
	tabs.t1 = result.open_kiriman_count;
	tabs.t2 = result.progress_kiriman_count;
	tabs.t3 = result.selesai_kiriman_count;
	tabs.t4 = result.cancel_kiriman_count;
	
	for (var i = 1; i <= 4; i++) {
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
		
		var shipment_picture = (result[i].shipment_pictures == "") ? "default.gif" : result[i].shipment_pictures;
		var bidding_type = result[i].bidding_type;
		var status = result[i].shipment_status;
		var statusTd = "";
		var actionTd = "<td data-col='action'><button class='btn-negative btn-cancel-transaction'>Batalkan Kiriman</button></td>";
		var berakhirTd = "";
		var cancelByTd = "";

		var ratingSection = "";

		var btnViewKontak = "<button class='btn-default btn-view-kontak'>Info Kiriman</button>";
		var low = "Low : ";
		switch (tab) {
			case "open":
				berakhirTd = "<td data-col='berakhir'>" + result[i].berakhir + "</td>";
				btnViewKontak = "";
				break;
			case "progress":
				low = "";
				if (status == 0) {
					btnViewKontak = "";
				}
				
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

				actionTd = "";
				statusTd = "<td data-col='status' data-align='center'>" + statusDetail[status] + "</td>";
				break;
			case "cancel":
				btnViewKontak = "";
				var icon = (result[i].user_verified == 0) ? "" : "<span class='verified-icon' style='background-image: url(" + verifiedIconUrl + ");'><div></div></span>";
				cancelByTd += "<td data-col='cancel-by'><a href='" + profilUrl + result[i].cancel_by + "'>" + result[i].cancel_username + icon + "</a></td>";
				actionTd = "";
				break;
		}
		
		element[tab] += "<tr class='tr-kiriman' data-id='" + result[i].shipment_id + "'><td class='td-title' data-col='nama-kirim'><a href='" + shipmentUrl + result[i].shipment_id + "'>" + "<img class='shipment-picture' src='" + shipmentPictureUrl + shipment_picture + "' onerror='this.onerror=null; this.src=\"" + defaultPictureUrl + "\";' /><span>" + result[i].shipment_title + "</span></a></td><td class='td-price' data-col='harga'>Bid : " + result[i].bidding_count + "<br>" + low + addCommas(result[i].low) + " IDR" + btnViewKontak + "</td><td class='td-asal' data-col='asal'>" + result[i].location_from_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan' data-col='tujuan'>" + result[i].location_to_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km' data-col='km' data-align='center'>" + parseInt(result[i].shipment_length) + "</td>" + statusTd + berakhirTd + actionTd + cancelByTd + "</tr>";

		element[tab] += "<tr class='row-detail-tr'><td class='row-detail-td' colspan='20'><div class='row-detail-td-content'></div></td></tr>";
	}
	
	if (iLength == 0) {
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").addClass("shown");
	} else {
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").removeClass("shown");
	}
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").html("");
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").append(element[tab]);
}