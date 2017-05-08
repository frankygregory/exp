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
							<td>Berakhir</td>
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
							<td>Jarak</td>
							<td>Berakhir</td>
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
							<td>Berakhir</td>
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
							<td>Berakhir</td>
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
							<td>Berakhir</td>
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
			<div class="tabs-content" data-tabs-number="8">
				<table class="table table-kiriman">
					<thead>
						<tr>
							<td>Nama Kirim</td>
							<td>Harga</td>
							<td>Asal</td>
							<td>Tujuan</td>
							<td>Jarak</td>
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
	getKirimanSaya();
	
	var kendaraan = [], supir = [], alat = [];
	
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
					getKirimanSaya();
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
					getKirimanSaya();
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
					getKirimanSaya();
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
						getKirimanSaya();
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
					getKirimanSaya();
				} else {
					alert(result);
				}
			}
		});
	}
	
	function getKirimanSaya() {
		$.ajax({
			url: '<?= base_url("kiriman-ekspedisi/getKirimanSaya") ?>',
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
				console.log(jqXHR.responseText);
			},
			success: function(json) {
				var result = jQuery.parseJSON(json);
				addKirimanToTable(result);
				
				getKendaraan();
				getSupir();
				getAlat();
			}
		});
	}
	
	function addKirimanToTable(result) {
		var iLength = result.length;
		var element = {
			"deal": {
				count: 0,
				value: "",
				btn: "<td><button class='btn-default btn-action btn-deal'>Deal</button></td>"
			},
			"pending": {
				count: 0,
				value: "",
				btn: "<td><button class='btn-default btn-action btn-pesan'>Pesan</button></td>"
			},
			"pesanan": {
				count: 0,
				value: "",
				btn: "<td><button class='btn-default btn-action btn-dikirim'>Dikirim</button></td>"
			},
			"dikirim": {
				count: 0,
				value: "",
				btn: "<td><button class='btn-default btn-action btn-diambil'>Diambil</button></td>"
			},
			"diambil": {
				count: 0,
				value: "",
				btn: "<td><button class='btn-default btn-action btn-diterima'>Diterima</button></td>"
			},
			"diterima": {
				count: 0,
				value: "",
				btn: "",
			},
			"selesai": {
				count: 0,
				value: "",
				btn: ""
			},
			"cancel": {
				count: 0,
				value: "",
				btn: ""
			}
		};
		
		var tab = "";
		for (var i = 0; i < iLength; i++) {
			var date_from = new Date(result[i].shipment_delivery_date_from);
			var fullDateFrom = date_from.getDate() + " " + month[date_from.getMonth()] + " " + date_from.getFullYear();
			var date_to = new Date(result[i].shipment_delivery_date_to);
			var fullDateTo = date_to.getDate() + " " + month[date_to.getMonth()] + " " + date_to.getFullYear();
			
			var additionalTd = "";
			var tdBerakhir = "<td class='td-berakhir'>" + result[i].berakhir + "</td>";
			var tdCancelBy = "";
			switch (result[i].shipment_status) {
				case "0":
					tab = "deal";
					break;
				case "1":
					tab = "pending";
					additionalTd = "<td><select class='select-supir'></select></td><td><select class='select-kendaraan'></select></td><td><select class='select-alat'></select></td>";
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
					break;
				case "6":
					tab = "selesai";
					tdBerakhir = "";
					additionalTd = "<td>" + result[i].driver_name + "</td><td>" + result[i].vehicle_name + "</td><td>" + result[i].device_name + "</td>";
					break;
				case "7":
					tab = "cancel";
					tdBerakhir = "";
					tdCancelBy = "<td class='td-cancel_by'>" + result[i].cancel_by + "</td>";
					break;
			}
			
			element[tab].count++;
			element[tab].value += "<tr class='tr-kiriman' data-id='" + result[i].shipment_id + "'><td class='td-title'><a href='<?= base_url("kirim/detail/") ?>" + result[i].shipment_id + "'>" + result[i].shipment_title + "</a><img class='shipment-picture' src='<?= base_url("assets/panel/images/") ?>" + result[i].shipment_pictures + "' /></td><td class='td-price'>Bid : " + result[i].bidding_count + "<br>Low : " + addCommas(result[i].shipment_price) + " IDR</td><td class='td-asal'>" + result[i].location_from_name + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan'>" + result[i].location_to_name + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km'>" + result[i].shipment_length + " Km</td>" + tdBerakhir + tdCancelBy + additionalTd + element[tab].btn + "</tr>";
		}
		
		$(".tbody-kiriman").html("");
		$(".tabs-content[data-tabs-number='1'] .tbody-kiriman").append(element["deal"].value);
		$(".tabs-content[data-tabs-number='2'] .tbody-kiriman").append(element["pending"].value);
		$(".tabs-content[data-tabs-number='3'] .tbody-kiriman").append(element["pesanan"].value);
		$(".tabs-content[data-tabs-number='4'] .tbody-kiriman").append(element["dikirim"].value);
		$(".tabs-content[data-tabs-number='5'] .tbody-kiriman").append(element["diambil"].value);
		$(".tabs-content[data-tabs-number='6'] .tbody-kiriman").append(element["diterima"].value);
		$(".tabs-content[data-tabs-number='7'] .tbody-kiriman").append(element["selesai"].value);
		$(".tabs-content[data-tabs-number='8'] .tbody-kiriman").append(element["cancel"].value);
		
		updateTabsItemCount(1, element["deal"].count);
		updateTabsItemCount(2, element["pending"].count);
		updateTabsItemCount(3, element["pesanan"].count);
		updateTabsItemCount(4, element["dikirim"].count);
		updateTabsItemCount(5, element["diambil"].count);
		updateTabsItemCount(6, element["diterima"].count);
		updateTabsItemCount(7, element["selesai"].count);
		updateTabsItemCount(8, element["cancel"].count);
	}
});
</script>