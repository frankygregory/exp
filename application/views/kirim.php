<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="content">
	<div class="section-1">
	<?php
		if ($this->session->userdata("role_id") == 1) { ?>
		<a class="btn-kirim-barang" href="<?= base_url("kirim/kirimbarang") ?>">
			<button type="button" class="btn-default">Kirim Barang</button>
		</a>
<?php	}	?>
		<div class="section">
			<div class="subsection-filter">
				<div class="subsection-title">Filter</div>
				<div class="form-item">
					<div class="form-item-label">Lokasi Asal</div>
					<input type="text" class="input" />
				</div>
				<div class="form-item">
					<div class="form-item-label">Lokasi Tujuan</div>
					<input type="text" class="input" />
				</div>
				<div class="form-item form-item-jarak">
					<div class="form-item-label">Jarak (Km)</div>
					<input type="text" class="input" maxlength="4" />
				</div>
				<div class="form-item">
					<div class="form-item-label">Tanggal Berakhir</div>
					<input type="text" class="input" />
				</div>
			</div>
			<div class="subsection-sort">
				<div class="subsection-title">Sort</div>
				<div class="form-item">
					<div class="form-item-label" style="visibility: hidden">sort</div>
					<select class="select-sort">
						<option value="created_date desc">Terbaru</option>
						<option value="created_date asc">Terlama</option>
						<option value="shipment_end_date asc">Tanggal Berakhir Asc</option>
						<option value="shipment_end_date desc">Tanggal Berakhir Desc</option>
						<option value="shipment_length asc">Jarak Asc</option>
						<option value="shipment_length desc">Jarak Desc</option>
					</select>
				</div>
			</div>
		</div>
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


<script type="text/javascript">
$(function() {
	var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	getKiriman();
	
	$(".select-sort").on("change", function() {
		getKiriman();
	});
	
	function getKiriman() {
		var order_by = $(".select-sort").val();
		$.ajax({
			url: '<?= base_url("kirim/getKiriman") ?>',
			data: {
				order_by: order_by
			},
			type: 'POST',
			error: function(jqXHR, exception) {
				alert(jqXHR + " : " + jqXHR.responseText);
			},
			success: function(json) {
				$(".tbody-kiriman").html("");
				var result = jQuery.parseJSON(json);
				for (var i = 0; i < result.length; i++) {
					addKirimanToTable((i + 1), result[i]);
				}
			}
		});
	}
	
	function addKirimanToTable(no, result) {
		var date_from = new Date(result.shipment_delivery_date_from);
		var fullDateFrom = date_from.getDate() + " " + month[date_from.getMonth()] + " " + date_from.getFullYear();
		var date_to = new Date(result.shipment_delivery_date_to);
		var fullDateTo = date_to.getDate() + " " + month[date_to.getMonth()] + " " + date_to.getFullYear();
		
		var element = "<tr class='tr-kiriman' data-id='" + result.shipment_id + "'><td class='td-title'><a href='<?= base_url("kirim/detail/") ?>" + result.shipment_id + "'>" + result.shipment_title + "</a><img class='shipment-picture' src='<?= base_url("assets/panel/images/") ?>" + result.shipment_pictures + "' /></td><td class='td-price'>Bid : " + result.bidding_count + "<br>Low : " + addCommas(result.shipment_price) + " IDR</td><td class='td-asal'>" + result.location_from_name + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan'>" + result.location_to_name + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km'>" + parseInt(result.shipment_length) + " Km</td><td class='td-berakhir'>" + result.berakhir + "</td></td></tr>";
		$(".tbody-kiriman").append(element);
	}
	
});
</script>