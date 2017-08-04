<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?><span class="tag-premium-large"></span></div>
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
								<td data-col='nama-kirim'>Nama Kirim</td>
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
					<div class="table-empty-state">Tidak ada data</div>
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
								<td data-col='km' data-align="center">Km</td>
								<td data-col='status' data-align='center'>Status</td>
								<td data-col='action' data-align='center'>Action</td>
							</tr>
						</thead>
						<tbody class="tbody-kiriman">
						</tbody>
					</table>
					<div class="table-empty-state">Tidak ada data</div>
				</div>
			</div>
			<div class="tabs-content" data-tabs-number="3">
				<div class="table-container">
					<table class="table table-kiriman">
						<thead>
							<tr>
								<td data-col='nama-kirim'>Nama Kirim</td>
								<td data-col='harga'>Harga</td>
								<td data-col='asal'>Asal</td>
								<td data-col='tujuan'>Tujuan</td>
								<td data-col='km' data-align="center">Km</td>
								<td data-col='status' data-align='center'>Status</td>
							</tr>
						</thead>
						<tbody class="tbody-kiriman">
						</tbody>
					</table>
					<div class="table-empty-state">Tidak ada data</div>
				</div>
			</div>
			<div class="tabs-content" data-tabs-number="4">
				<div class="table-container">
					<table class="table table-kiriman">
						<thead>
							<tr>
								<td data-col='nama-kirim'>Nama Kirim</td>
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
					<div class="table-empty-state">Tidak ada data</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script>
var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
var profilUrl = "<?= base_url("profil/") ?>";
var kirimanUrl = [];
kirimanUrl[1] = "<?= base_url("kiriman-saya-bisnis/getOpenKiriman") ?>";
kirimanUrl[2] = "<?= base_url("kiriman-saya-bisnis/getProgressKiriman") ?>";
kirimanUrl[3] = "<?= base_url("kiriman-saya-bisnis/getSelesaiKiriman") ?>";
kirimanUrl[4] = "<?= base_url("kiriman-saya-bisnis/getCancelKiriman") ?>";

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
	getKiriman(kirimanUrl[1], 1, "open");
	getKirimanCount();

	$(".tabs-item").on("click", function() {
		abortAjaxCall();
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
	ajaxCall("<?= base_url("kiriman-saya-bisnis/getAllStatusKiriman") ?>", {shipment_id: shipment_id}, function(json) {
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
	ajaxCall("<?= base_url("kiriman-saya-bisnis/getInfoEkspedisi") ?>", {shipment_id: shipment_id}, function(json) {
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
	ajaxCall("<?= base_url("kiriman-saya-bisnis/cancelShipment") ?>", data, function(result) {
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
	ajaxCall("<?= base_url("kiriman-saya-bisnis/submitRating") ?>", data, function(result) {
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
	ajaxCall("<?= base_url("kiriman-saya-bisnis/getKirimanCount") ?>", null, function(json) {
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
				btnViewKontak = "";
				low = "";

				actionTd = "";
				statusTd = "<td data-col='status' data-align='center'>" + statusDetail[status] + "</td>";
				break;
			case "cancel":
				btnViewKontak = "";
				cancelByTd += "<td data-col='cancel-by'><a href='" + profilUrl + result[i].cancel_by + "'>" + result[i].cancel_username + "</a></td>";
				actionTd = "";
				break;
		}
		
		element[tab] += "<tr class='tr-kiriman' data-id='" + result[i].shipment_id + "'><td class='td-title' data-col='nama-kirim'><a href='<?= base_url("kirim/detail/") ?>" + result[i].shipment_id + "'>" + "<img class='shipment-picture' src='<?= base_url("assets/panel/images/") ?>" + shipment_picture + "' onerror='this.onerror=null; this.src=\"<?php echo base_url("assets/panel/images/default.gif"); ?>\";' /><span>" + result[i].shipment_title + "</span></a></td><td class='td-price' data-col='harga'>Bid : " + result[i].bidding_count + "<br>" + low + addCommas(result[i].low) + " IDR" + btnViewKontak + "</td><td class='td-asal' data-col='asal'>" + result[i].location_from_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan' data-col='tujuan'>" + result[i].location_to_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km' data-col='km' data-align='center'>" + parseInt(result[i].shipment_length) + "</td>" + statusTd + berakhirTd + actionTd + cancelByTd + "</tr>";

		element[tab] += "<tr class='row-detail-tr'><td class='row-detail-td' colspan='9'><div class='row-detail-td-content'></div></td></tr>";
	}
	
	if (iLength == 0) {
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").addClass("shown");
	} else {
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .table-empty-state").removeClass("shown");
	}
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").html("");
	$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").append(element[tab]);
}
</script>