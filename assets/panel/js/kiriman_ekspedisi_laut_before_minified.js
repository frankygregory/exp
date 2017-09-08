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
			getKiriman(kirimanUrl[1], 1, "deal");
		}
	} else {
		getKiriman(kirimanUrl[1], 1, "deal");
	}
	getKirimanCount();

	$(document).on("click", ".btn-deal", function() {
		submitDeal(this);
	});

	$(".dialog-ubah-input-waktu").datepicker({
		disableDateAfter: new Date()
	});
	
	$(document).on("click", ".btn-ubah", function(e) {
		e.stopPropagation();
		showUbahDialog(this);
	});

	$("body").on("click", function(e) {
		if ($(e.target).closest(".dialog-ubah").length == 0 && $(e.target).closest(".datepicker").length == 0 && $(e.target).closest(".dialog-konfirmasi-ubah").length == 0) {
			hideUbahDialog();
		}
	});
	
	$(document).on("click", ".btn-batal-pengiriman", function() {
		var shipment_id = $(this).closest(".tr-kiriman").data("id");
		var shipment_title = $(this).closest(".tr-kiriman").data("shipment-title");
		
		$(".dialog-konfirmasi-cancel-transaction").data("shipment_id", shipment_id);
		$(".dialog-konfirmasi-cancel-transaction .dialog-body").html("Batalkan kiriman " + shipment_title + "?");
		showDialog(".dialog-konfirmasi-cancel-transaction");
	});

	$(".btn-ubah2").on("click", function() {
		var shipment_id = $(".dialog-ubah").data("id");
		var shipment_title = $(".dialog-ubah").data("shipment_title");
		var shipment_status = $(".dialog-ubah-input-status-value").val();
		var shipment_status_name = $(".dialog-ubah-input-status").val();
		var datetime = $(".dialog-ubah-input-waktu").val();
		var shipment_details_container_number = $(".dialog-ubah").data("shipment_details_container_number");
		var ship_id = $(".dialog-ubah").data("ship_id");

		$(".dialog-konfirmasi-ubah").data("shipment_id", shipment_id);
		$(".dialog-konfirmasi-ubah").data("shipment_status", shipment_status);
		$(".dialog-konfirmasi-ubah").data("datetime", datetime);
		$(".dialog-konfirmasi-ubah").data("shipment_details_container_number", shipment_details_container_number);
		$(".dialog-konfirmasi-ubah").data("ship_id", ship_id);
		
		$(".dialog-konfirmasi-ubah .value[data-label='nama']").html(shipment_title);
		$(".dialog-konfirmasi-ubah .value[data-label='status']").html(shipment_status_name);
		$(".dialog-konfirmasi-ubah .value[data-label='tanggal']").html(datetime);
		showDialog(".dialog-konfirmasi-ubah");
	});

	$(".btn-submit-ubah").on("click", function() {
		submitUbah();
	});
	
	$(".btn-submit-cancel-transaction").on("click", function() {
		cancelShipment();
	});

	$(".dialog-ubah-button").on("click", function() {
		var text = $(this).data("text");
		var value = $(this).data("value");
		$(".dialog-ubah-input-status").val(text);
		$(".dialog-ubah-input-status-value").val(value);
	});

	$(document).on("click", ".tabs-content:not([data-tabs-number='7']):not([data-tabs-number='8']) .btn-view-kontak", function() {
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

	$(document).on("click", ".tabs-content[data-tabs-number='7'] .btn-view-kontak", function() {
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
});

function getAllStatusKiriman(tr, element) {
	var shipment_id = $(tr).data("id");
	ajaxCall(getAllStatusKirimanUrl, {shipment_id: shipment_id}, function(json) {
		var result = JSON.parse(json);
		if (result.status == "success") {
			var status_0 = result.pending_date;
			var status_1 = result.confirmation_date;
			var status_2, status_2_name, status_3, status_3_name, status_4, status_4_name, status_5, status_5_name;
			
			status_2 = result.door_start_date;
			status_2_name = "Door 1";
			status_3 = result.port_start_date;
			status_3_name = "Port 1";
			status_4 = result.port_finish_date;
			status_4_name = "Diambil";
			status_5 = result.door_finish_date;
			status_5_name = "Door 2";
			
			var status_6 = result.ending_date;

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
		content += "<div class='detail-title'>Info Pemilik Barang</div>";
		content += "<div class='detail-row'><span class='detail-label'>Nama</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["user_fullname"] + "</span></div>";
		content += "<div class='detail-row'><span class='detail-label'>Alamat</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["user_address"] + "</span></div>";
		content += "<div class='detail-row'><span class='detail-label'>Telepon</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["user_telephone"] + "</span></div>";
		content += "<div class='detail-row'><span class='detail-label'>Handphone</span><span class='detail-titikdua'> : </span><span class='detail-value'>" + result["user_handphone"] + "</span></div>";
		content += "</div>";

		var status_0 = result["pending_date"];
		var status_1 = result["confirmation_date"];
		var status_2, status_2_name, status_3, status_3_name, status_4, status_4_name, status_5, status_5_name;

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

function submitUbah() {
	var shipment_id = $(".dialog-konfirmasi-ubah").data("shipment_id");
	var shipment_status = $(".dialog-konfirmasi-ubah").data("shipment_status");
	var datetime = $(".dialog-konfirmasi-ubah").data("datetime");
	var shipment_details_container_number = $(".dialog-konfirmasi-ubah").data("shipment_details_container_number");
	var ship_id = $(".dialog-konfirmasi-ubah").data("ship_id");

	showFullscreenLoading();
	var data = {
		shipment_id: shipment_id,
		shipment_status: shipment_status,
		datetime: datetime,
		shipment_details_container_number: shipment_details_container_number,
		ship_id: ship_id
	};

	ajaxCall(submitUbahUrl, data, function(result) {
		hideFullscreenLoading();
		if (result == "success") {
			closeDialog();
			hideUbahDialog();
			refreshData();
		}
	});
}

function showUbahDialog(element) {
	var trKiriman = $(element).closest(".tr-kiriman");
	var top = $(element).offset().top + $(element).outerHeight();
	$(".dialog-ubah").css({top: top});
	var status = $(trKiriman).data("status");
	$(".dialog-ubah").data("status", status);

	var valid = true;
	if (status == 1) {
		var inputNoKontainer = $(trKiriman).find(".input-no-kontainer");
		var noKontainer = $(inputNoKontainer).val().trim();
		if (noKontainer == "") {
			valid = false;
			alert("Nomor Kontainer harus diisi");
			$(inputNoKontainer).select();
		} else {
			var ship_id = $(trKiriman).find(".select-kapal").val();
			$(".dialog-ubah").data("ship_id", ship_id);
			$(".dialog-ubah").data("shipment_details_container_number", noKontainer);
		}
	}

	if (valid) {
		var id = $(trKiriman).data("id");
		var nama = $(trKiriman).data("shipment-title");
		$(".dialog-ubah").data("id", id);
		$(".dialog-ubah").data("shipment_title", nama);

		for (var i = 2; i <= status; i++) {
			$(".dialog-ubah-button[data-value='" + i + "']").prop("disabled", true);
		}

		$(".dialog-ubah-button[data-value='" + (status + 1) + "']").click();
		var date = new Date();
		var month = (date.getMonth() + 1) + "";
		month = (month.length == 1) ? "0" + month : month;
		var tgl = date.getDate() + "";
		tgl = (tgl.length == 1) ? "0" + tgl : tgl;

		var hour = date.getHours() + "";
		hour = (hour.length == 1) ? "0" + hour : hour;
		var minute = date.getMinutes() + "";
		minute = (minute.length == 1) ? "0" + minute : minute;
		var strDate = tgl + "-" + month + "-" + date.getFullYear() + " " + hour + ":" + minute;
		$(".dialog-ubah-input-waktu").val(strDate);
		$(".dialog-ubah").css("display", "block");
	}
}

function hideUbahDialog() {
	$(".dialog-ubah").css("display", "none");
}

function cancelShipment() {
	showFullscreenLoading();
	var shipment_id = $(".dialog-konfirmasi-cancel-transaction").data("shipment_id");
	ajaxCall(cancelShipmentUrl, {shipment_id: shipment_id}, function(result) {
		hideFullscreenLoading();
		if (result == "success") {
			closeDialog();
			refreshData();
		}
	});
}

function submitDeal(element) {
	var shipment_id = $(element).closest(".tr-kiriman").data("id");
	var data = {
		shipment_id: shipment_id
	};
	ajaxCall(submitDealUrl, data, function(result) {
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
		t4: 0,
		t5: 0,
		t6: 0,
		t7: 0,
		t8: 0
	};
	
	for (var i = 0; i < result.length; i++) {
		switch (result[i].shipment_status) {
			case "0":
				tabs.t1 = result[i].count;
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
		"deal": {
			value: "",
			btn: "<td><button class='btn-default btn-deal'>Deal</button><button class='btn-negative btn-batal-pengiriman'>Tolak</button></td>"
		},
		"pending": {
			value: "",
			btn: "<td><button class='btn-default btn-ubah'>Ubah</button><button class='btn-negative btn-batal-pengiriman'>Batalkan</button></td>"
		},
		"door1": {
			value: "",
			btn: "<td><button class='btn-default btn-ubah'>Ubah</button></td>"
		},
		"port1": {
			value: "",
			btn: "<td><button class='btn-default btn-ubah'>Ubah</button></td>"
		},
		"port2": {
			value: "",
			btn: "<td><button class='btn-default btn-ubah'>Ubah</button></td>"
		},
		"door2": {
			value: "",
			btn: ""
		},
		"selesai": {
			value: "",
			btn: ""
		},
		"cancel": {
			value: "",
			btn: ""
		}
	};
	
	for (var i = 0; i < iLength; i++) {
		
		var date_from = new Date(result[i].shipment_delivery_date_from);
		var fullDateFrom = date_from.getDate() + " " + month[date_from.getMonth()] + " " + date_from.getFullYear().toString().substring(2);
		var date_to = new Date(result[i].shipment_delivery_date_to);
		var fullDateTo = date_to.getDate() + " " + month[date_to.getMonth()] + " " + date_to.getFullYear().toString().substring(2);
		
		var shipment_picture = (result[i].shipment_pictures == "") ? "default.gif" : result[i].shipment_pictures;
		var additionalTd = "";
		var tdStatus = "";
		var tdCancelBy = "";
		var waktu = "";
		var btnViewKontak = "<button class='btn-default btn-view-kontak'>Info Kiriman</button>";
		switch (tab) {
			case "deal":
				btnViewKontak = "";
				break;
			case "pending":
				additionalTd = "<td><select class='select-kapal'><option value='1'>Meratus</option><option value='2'>SPIL</option></select></td><td><input type='text' class='input-no-kontainer' maxlength='11' /></td>";
				tdStatus = "<td>D1 &rarr; P1 &rarr; P2 &rarr; D2</td>";
				break;
			case "door1":
				additionalTd = "<td>" + result[i].ship_id + "</td><td>" + result[i].shipment_details_container_number + "</td>";
				tdStatus = "<td><strong>D1</strong> &rarr; P1 &rarr; P2 &rarr; D2</td>";
				break;
			case "port1":
				additionalTd = "<td>" + result[i].ship_id + "</td><td>" + result[i].shipment_details_container_number + "</td>";
				tdStatus = "<td><strong>D1 &rarr; P1</strong> &rarr; P2 &rarr; D2</td>";
				break;
			case "port2":
				additionalTd = "<td>" + result[i].ship_id + "</td><td>" + result[i].shipment_details_container_number + "</td>";
				tdStatus = "<td><strong>D1 &rarr; P1 &rarr; P2</strong> &rarr; D2</td>";
				break;
			case "door2":
				additionalTd = "<td>" + result[i].ship_id + "</td><td>" + result[i].shipment_details_container_number + "</td>";
				tdStatus = "<td><strong>D1 &rarr; P1 &rarr; P2 &rarr; D2</strong></td>";
				break;
			case "selesai":
				additionalTd = "<td>" + result[i].ship_id + "</td><td>" + result[i].shipment_details_container_number + "</td>";
				tdStatus = "<td><strong>D1 &rarr; P1 &rarr; P2 &rarr; D2</strong></td>";
				waktu = "<td data-align='center'>" + result[i].total_waktu + " hari</td>";
				break;
			case "cancel":
				btnViewKontak = "";
				var icon = (result[i].user_verified == 0) ? "" : "<span class='verified-icon' style='background-image: url(" + verifiedIconUrl + ");'><div></div></span>";
				tdCancelBy = "<td class='td-cancel_by'><a href='" + profilUrl + result[i].cancel_by + "'>" + result[i].cancel_username + icon + "</a></td>";
				break;
		}
		
		element[tab].value += "<tr class='tr-kiriman' data-id='" + result[i].shipment_id + "' data-shipment-title='" + result[i].shipment_title + "' data-status='" + result[i].shipment_status + "'><td class='td-title'><a href='" + shipmentUrl + result[i].shipment_id + "'>" + "<img class='shipment-picture' src='" + shipmentPictureUrl + shipment_picture + "' onerror='this.onerror=null; this.src=\"" + defaultPictureUrl + "\";' /><span>" + result[i].shipment_title + "</span></a></td><td class='td-price'>Bid : " + result[i].bidding_count + "<br>Low : " + addCommas(result[i].low) + " IDR" + btnViewKontak + "</td><td class='td-asal'>" + result[i].location_from_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan'>" + result[i].location_to_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km' data-align='center'>" + parseInt(result[i].shipment_length) + "</td>" + tdCancelBy + additionalTd + tdStatus + element[tab].btn + waktu + "</tr>";
		element[tab].value += "<tr class='row-detail-tr'><td class='row-detail-td' colspan='20'><div class='row-detail-td-content'></div></td></tr>";
	}
	
	if (iLength == 0) {
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").addClass("shown");
	} else {
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").removeClass("shown");
	}
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").html("");
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").append(element[tab].value);
	
	if (tab == "pending" && iLength > 0) {
		getKendaraan();
	}
}