<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="content">
	<div class="tabs" data-id="asd">
		<div class="tabs-header">
			<div class="tabs-item-container">
				<div class="tabs-item active" data-tabs-number="1">Deal (<span class="tabs-item-count">0</span>)</div>
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
							<td>KM</td>
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
							<td>KM</td>
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
			<div class="tabs-content" data-tabs-number="3">
				<table class="table table-kiriman">
					<thead>
						<tr>
							<td>Nama Kirim</td>
							<td>Harga</td>
							<td>Asal</td>
							<td>Tujuan</td>
							<td>KM</td>
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
							<td>KM</td>
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
							<td>KM</td>
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
							<td>KM</td>
							<td>Supir</td>
							<td>Kendaraan</td>
							<td>Lacak</td>
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
							<td>KM</td>
							<td>Supir</td>
							<td>Kendaraan</td>
							<td>Lacak</td>
							<td>Waktu Kiriman (Hari)</td>
							<td>Total Waktu (Hari)</td>
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
							<td>KM</td>
							<td>Cancel by</td>
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
	kirimanUrl[1] = "<?= base_url("kiriman-ekspedisi/getDealKiriman") ?>";
	kirimanUrl[2] = "<?= base_url("kiriman-ekspedisi/getPendingKiriman") ?>";
	kirimanUrl[3] = "<?= base_url("kiriman-ekspedisi/getPesananKiriman") ?>";
	kirimanUrl[4] = "<?= base_url("kiriman-ekspedisi/getDikirimKiriman") ?>";
	kirimanUrl[5] = "<?= base_url("kiriman-ekspedisi/getDiambilKiriman") ?>";
	kirimanUrl[6] = "<?= base_url("kiriman-ekspedisi/getDiterimaKiriman") ?>";
	kirimanUrl[7] = "<?= base_url("kiriman-ekspedisi/getSelesaiKiriman") ?>";
	kirimanUrl[8] = "<?= base_url("kiriman-ekspedisi/getCancelKiriman") ?>";
	
	var kirimanTabs = [];
	kirimanTabs[1] = "deal";
	kirimanTabs[2] = "pending";
	kirimanTabs[3] = "pesanan";
	kirimanTabs[4] = "dikirim";
	kirimanTabs[5] = "diambil";
	kirimanTabs[6] = "diterima";
	kirimanTabs[7] = "selesai";
	kirimanTabs[8] = "cancel";
	
	getKirimanCount();
	getKiriman(kirimanUrl[1], 1, "deal");
	
	var kendaraan = [], supir = [], alat = [];
	
	$(".tabs-item").on("click", function() {
		var tabsNumber = $(this).data("tabs-number");
		getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
	});
	
	$(document).on("click", ".btn-deal", function() {
		submitDeal(this);
	});
	
	$(document).on("click", ".btn-pesan", function() {
		submitPesan(this);
	});
	
	$(document).on("click", ".btn-dikirim", function() {
		submitKirim(this);
	});
	
	$(document).on("click", ".btn-diambil", function() {
		submitAmbil(this);
	});
	
	$(document).on("click", ".btn-diterima", function() {
		submitTerima(this);
	});
	
	function getKendaraan() {
		$.ajax({
			url: '<?= base_url("kiriman-ekspedisi/getKendaraan") ?>',
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(json) {
				var result = jQuery.parseJSON(json);
				
				var element = "";
				var iLength = result.length;
				for (var i = 0; i < iLength; i++) {
					kendaraan.push({
						id: result[i].vehicle_id,
						name: result[i].vehicle_name
					});
					element += "<option value='" + result[i].vehicle_id + "'>" + result[i].vehicle_name + "</option>";
				}
				$(".select-kendaraan").append(element);
			}
		});
	}
	
	function getSupir() {
		$.ajax({
			url: '<?= base_url("kiriman-ekspedisi/getSupir") ?>',
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(json) {
				var result = jQuery.parseJSON(json);
				
				var element = "";
				var iLength = result.length;
				for (var i = 0; i < iLength; i++) {
					supir.push({
						id: result[i].driver_id,
						name: result[i].driver_name
					});
					element += "<option value='" + result[i].driver_id + "'>" + result[i].driver_name + "</option>";
				}
				$(".select-supir").append(element);
			}
		});
	}
	
	function getAlat() {
		$.ajax({
			url: '<?= base_url("kiriman-ekspedisi/getAlat") ?>',
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(json) {
				var result = jQuery.parseJSON(json);
				
				var element = "";
				var iLength = result.length;
				for (var i = 0; i < iLength; i++) {
					alat.push({
						id: result[i].device_id,
						name: result[i].device_name
					});
					element += "<option value='" + result[i].device_id + "'>" + result[i].device_name + "</option>";
				}
				$(".select-alat").append(element);
			}
		});
	}
	
	function submitTerima(element) {
		var shipment_id = $(element).closest(".tr-kiriman").data("id");
		$.ajax({
			url: '<?= base_url("kiriman-ekspedisi/submitTerima") ?>',
			data: {
				shipment_id: shipment_id
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					getKirimanCount();
					var tabsNumber = $(".tabs-item.active").data("tabs-number");
					getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
				} else {
					alert(result);
				}
			}
		});
	}
	
	function submitAmbil(element) {
		var shipment_id = $(element).closest(".tr-kiriman").data("id");
		$.ajax({
			url: '<?= base_url("kiriman-ekspedisi/submitAmbil") ?>',
			data: {
				shipment_id: shipment_id
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					getKirimanCount();
					var tabsNumber = $(".tabs-item.active").data("tabs-number");
					getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
				} else {
					alert(result);
				}
			}
		});
	}
	
	function submitKirim(element) {
		var shipment_id = $(element).closest(".tr-kiriman").data("id");
		$.ajax({
			url: '<?= base_url("kiriman-ekspedisi/submitKirim") ?>',
			data: {
				shipment_id: shipment_id
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					getKirimanCount();
					var tabsNumber = $(".tabs-item.active").data("tabs-number");
					getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
				} else {
					alert(result);
				}
			}
		});
	}
	
	function submitPesan(element) {
		var shipment_id = $(element).closest(".tr-kiriman").data("id");
		var driver_id = $(element).closest(".tr-kiriman").find(".select-supir").val();
		var vehicle_id = $(element).closest(".tr-kiriman").find(".select-kendaraan").val();
		var device_id = $(element).closest(".tr-kiriman").find(".select-alat").val();
		
		if (driver_id == "") {
			alert("tidak ada supir yang dipilih");
		} else if (vehicle_id == "") {
			alert("tidak ada kendaraan yang dipilih");
		} else if (device_id == "") {
			alert("tidak ada alat yang dipilih");
		} else {
			$.ajax({
				url: '<?= base_url("kiriman-ekspedisi/submitPesan") ?>',
				data: {
					shipment_id: shipment_id,
					driver_id: driver_id,
					vehicle_id: vehicle_id,
					device_id: device_id
				},
				type: 'POST',
				error: function(jqXHR, exception) {
					alert(jqXHR + " : " + jqXHR.responseText);
				},
				success: function(result) {
					if (result == "success") {
						getKirimanCount();
						var tabsNumber = $(".tabs-item.active").data("tabs-number");
						getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
					} else {
						alert(result);
					}
				}
			});
		}
	}
	
	function submitDeal(element) {
		var shipment_id = $(element).closest(".tr-kiriman").data("id");
		$.ajax({
			url: '<?= base_url("kiriman-ekspedisi/submitDeal") ?>',
			data: {
				shipment_id: shipment_id
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(result) {
				if (result == "success") {
					getKirimanCount();
					var tabsNumber = $(".tabs-item.active").data("tabs-number");
					getKiriman(kirimanUrl[tabsNumber], tabsNumber, kirimanTabs[tabsNumber]);
				} else {
					alert(result);
				}
			}
		});
	}
	
	function getKirimanCount() {
		$.ajax({
			url: '<?= base_url("kiriman-ekspedisi/getKirimanSaya") ?>',
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(json) {
				var result = jQuery.parseJSON(json);
				assignKirimanCount(result);
			}
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
		$.ajax({
			url: url,
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(json) {
				var result = jQuery.parseJSON(json);
				addKirimanToTable(result, tabsNumber, tabs);
			}
		});
	}
	
	function addKirimanToTable(result, tabsNumber, tab) {
		var iLength = result.length;
		var element = {
			"deal": {
				value: "",
				btn: "<td><button class='btn-default btn-action btn-deal'>Deal</button></td>"
			},
			"pending": {
				value: "",
				btn: "<td><button class='btn-default btn-action btn-pesan'>Pesan</button></td>"
			},
			"pesanan": {
				value: "",
				btn: "<td><button class='btn-default btn-action btn-dikirim'>Dikirim</button></td>"
			},
			"dikirim": {
				value: "",
				btn: "<td><button class='btn-default btn-action btn-diambil'>Diambil</button></td>"
			},
			"diambil": {
				value: "",
				btn: "<td><button class='btn-default btn-action btn-diterima'>Diterima</button></td>"
			},
			"diterima": {
				value: "",
				btn: "",
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
			var fullDateFrom = date_from.getDate() + " " + month[date_from.getMonth()] + " " + date_from.getFullYear();
			var date_to = new Date(result[i].shipment_delivery_date_to);
			var fullDateTo = date_to.getDate() + " " + month[date_to.getMonth()] + " " + date_to.getFullYear();
			
			var additionalTd = "";
			var tdCancelBy = "";
			var waktu = "";
			switch (tab) {
				case "pending":
					additionalTd = "<td><select class='select-supir'></select></td><td><select class='select-kendaraan'></select></td><td><select class='select-alat'></select></td>";
					break;
				case "pesanan":
					additionalTd = "<td>" + result[i].driver_names + "</td><td>" + result[i].vehicle_names + "</td><td>" + result[i].device_names + "</td>";
					break;
				case "dikirim":
					additionalTd = "<td>" + result[i].driver_names + "</td><td>" + result[i].vehicle_names + "</td><td>" + result[i].device_names + "</td>";
					break;
				case "diambil":
					additionalTd = "<td>" + result[i].driver_names + "</td><td>" + result[i].vehicle_names + "</td><td>" + result[i].device_names + "</td>";
					break;
				case "diterima":
					additionalTd = "<td>" + result[i].driver_names + "</td><td>" + result[i].vehicle_names + "</td><td>" + result[i].device_names + "</td>";
					break;
				case "selesai":
					additionalTd = "<td>" + result[i].driver_names + "</td><td>" + result[i].vehicle_names + "</td><td>" + result[i].device_names + "</td>";
					waktu = "<td>" + result[i].waktu_kiriman + "</td><td>" + result[i].total_waktu + "</td>";
					break;
				case "cancel":
					tdCancelBy = "<td class='td-cancel_by'>" + result[i].cancel_username + "</td>";
					break;
			}
			
			element[tab].value += "<tr class='tr-kiriman' data-id='" + result[i].shipment_id + "'><td class='td-title'><a href='<?= base_url("kirim/detail/") ?>" + result[i].shipment_id + "'>" + result[i].shipment_title + "</a><img class='shipment-picture' src='<?= base_url("assets/panel/images/") ?>" + result[i].shipment_pictures + "' /></td><td class='td-price'>Bid : " + result[i].bidding_count + "<br>Low : " + addCommas(result[i].shipment_price) + " IDR</td><td class='td-asal'>" + result[i].location_from_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan'>" + result[i].location_to_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km'>" + result[i].shipment_length + "</td>" + tdCancelBy + additionalTd + element[tab].btn + waktu + "</tr>";
		}
		
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").html("");
		$(".tabs-content[data-tabs-number='" + tabsNumber + "'] .tbody-kiriman").append(element[tab].value);
		
		if (tab == "pending" && iLength > 0) {
			getAlat();
			getSupir();
			getKendaraan();
		}
	}
});
</script>