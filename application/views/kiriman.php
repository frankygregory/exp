<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="content">
	<div class="tabs" data-id="asd">
		<div class="tabs-header">
			<div class="tabs-item-container">
				<div class="tabs-item active" data-tabs-number="1">Open</div>
				<div class="tabs-item" data-tabs-number="2">Pending</div>
				<div class="tabs-item" data-tabs-number="3">Pesanan</div>
				<div class="tabs-item" data-tabs-number="4">Dikirim</div>
				<div class="tabs-item" data-tabs-number="5">Diambil</div>
				<div class="tabs-item" data-tabs-number="6">Diterima</div>
				<div class="tabs-item" data-tabs-number="7">Selesai</div>
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
							<td>Berakhir</td>
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
			"open": "",
			"pending": "",
			"pesanan": "",
			"dikirim": "",
			"diambil": "",
			"diterima": "",
			"selesai": "",
			"cancel": ""
		};
		
		var tab = "";
		for (var i = 0; i < iLength; i++) {
			var date_from = new Date(result[i].shipment_delivery_date_from);
			var fullDateFrom = date_from.getDate() + " " + month[date_from.getMonth()] + " " + date_from.getFullYear();
			var date_to = new Date(result[i].shipment_delivery_date_to);
			var fullDateTo = date_to.getDate() + " " + month[date_to.getMonth()] + " " + date_to.getFullYear();
			
			switch (result[i].shipment_status) {
				case "-1":
					tab = "open";
					break;
				case "0":
					tab = "pending";
					break;
				case "1":
					tab = "pending";
					break;
				case "2":
					tab = "pesanan";
					break;
				case "3":
					tab = "dikirim";
					break;
				case "4":
					tab = "diambil";
					break;
				case "5":
					tab = "diterima";
					break;
				case "6":
					tab = "selesai";
					break;
				case "7":
					tab = "cancel";
					break;
			}
			
			element[tab] += "<tr class='tr-kiriman' data-id='" + result[i].shipment_id + "'><td class='td-title'><a href='<?= base_url("kirim/detail/") ?>" + result[i].shipment_id + "'>" + result[i].shipment_title + "</a><img class='shipment-picture' src='<?= base_url("assets/panel/images/") ?>" + result[i].shipment_pictures + "' /></td><td class='td-price'>Bid : " + result[i].bidding_count + "<br>Low : " + addCommas(result[i].shipment_price) + " IDR</td><td class='td-asal'>" + result[i].location_from_name + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan'>" + result[i].location_to_name + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km'>" + result[i].shipment_length + " Km</td><td class='td-berakhir'>" + result[i].berakhir + "</td></td></tr>";
		}
		
		$(".tbody-kiriman").html("");
		$(".tabs-content[data-tabs-number='1'] .tbody-kiriman").append(element["open"]);
		$(".tabs-content[data-tabs-number='2'] .tbody-kiriman").append(element["pending"]);
		$(".tabs-content[data-tabs-number='3'] .tbody-kiriman").append(element["pesanan"]);
		$(".tabs-content[data-tabs-number='4'] .tbody-kiriman").append(element["dikirim"]);
		$(".tabs-content[data-tabs-number='5'] .tbody-kiriman").append(element["diambil"]);
		$(".tabs-content[data-tabs-number='6'] .tbody-kiriman").append(element["diterima"]);
		$(".tabs-content[data-tabs-number='7'] .tbody-kiriman").append(element["selesai"]);
	}
});
</script>