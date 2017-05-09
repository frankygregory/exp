<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="content">
	<div class="section-1 section">
		<div class="section-title">Statistik Kiriman</div>
		<table class="table-statistik-kiriman">
			<tbody>
				<tr class="tr-col-header">
					<td class="td-row-header"></td>
					<td class="td">Total</td>
					<td>1 Bulan</td>
					<td>6 Bulan</td>
					<td>12 Bulan</td>
				</tr>
				<tr class="tr-kiriman-berhasil">
					<td class="td-row-header">Berhasil</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
				</tr>
				<tr class="tr-kiriman-gagal">
					<td class="td-row-header">Gagal</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
				</tr>
				<tr class="tr-kiriman-total">
					<td class="td-row-header">Total</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
				</tr>
				<tr class="tr-kiriman-persen">
					<td class="td-row-header">Persen</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
				</tr>
			</tbody>
		</table>
	</div>
<?php	if ($role_id == 2) { ?>
		<div class="section-2 section">
			<div class="section-title">Statistik Penawaran</div>
			<table class="table-statistik-bidding">
				<tbody>
					<tr class="tr-col-header">
						<td class="td-row-header"></td>
						<td class="td">Total</td>
						<td>1 Bulan</td>
						<td>6 Bulan</td>
						<td>12 Bulan</td>
					</tr>
					<tr class="tr-bidding-berhasil">
						<td class="td-row-header">Berhasil</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
					</tr>
					<tr class="tr-bidding-gagal">
						<td class="td-row-header">Gagal</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
					</tr>
					<tr class="tr-bidding-total">
						<td class="td-row-header">Total</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
					</tr>
					<tr class="tr-bidding-persen">
						<td class="td-row-header">Persen</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
					</tr>
				</tbody>
			</table>
		</div>
<?php	}	?>
</div>
</div>
</div>
<script>
$(function() {
	ajaxCall("statistik/getStatistikKiriman", null, ajaxStatistikKirimanCallback);
<?php if ($role_id == 2) {
	echo "ajaxCall('statistik/getStatistikBidding', null, ajaxStatistikBiddingCallback);";
}	?>
	
});
function ajaxStatistikKirimanCallback(result) {
	result = jQuery.parseJSON(result);
	
	var total = result[0].total;
	var berhasil = result[0].berhasil;
	var gagal = result[0].gagal;
	
	var element = "";
	element += "<td class='td-row-header'>Berhasil</td>";
	element += "<td>" + berhasil + "</td>";
	element += "<td>" + result[0].berhasil_30 + "</td>";
	element += "<td>" + result[0].berhasil_180 + "</td>";
	element += "<td>" + result[0].berhasil_365 + "</td>";
	$(".tr-kiriman-berhasil").html("");
	$(".tr-kiriman-berhasil").html(element);
	
	element = "";
	element += "<td class='td-row-header'>Gagal</td>";
	element += "<td>" + gagal + "</td>";
	element += "<td>" + result[0].gagal_30 + "</td>";
	element += "<td>" + result[0].gagal_180 + "</td>";
	element += "<td>" + result[0].gagal_365 + "</td>";
	$(".tr-kiriman-gagal").html("");
	$(".tr-kiriman-gagal").html(element);
	
	element = "";
	element += "<td class='td-row-header'>Total</td>";
	element += "<td>" + total + "</td>";
	element += "<td>" + result[0].total_30 + "</td>";
	element += "<td>" + result[0].total_180 + "</td>";
	element += "<td>" + result[0].total_365 + "</td>";
	$(".tr-kiriman-total").html("");
	$(".tr-kiriman-total").html(element);
	
	element = "";
	var persen = +(berhasil * 100 / total).toFixed(2) || 0;
	var persen_30 = +(result[0].berhasil_30 * 100 / result[0].total_30).toFixed(2) || 0;
	var persen_180 = +(result[0].berhasil_180 * 100 / result[0].total_180).toFixed(2) || 0;
	var persen_365 = +(result[0].berhasil_365 * 100 / result[0].total_365).toFixed(2) || 0;
	
	element += "<td class='td-row-header'>Persen</td>";
	element += "<td>" + persen + "%</td>";
	element += "<td>" + persen_30 + "%</td>";
	element += "<td>" + persen_180 + "%</td>";
	element += "<td>" + persen_365 + "%</td>";
	$(".tr-kiriman-persen").html("");
	$(".tr-kiriman-persen").html(element);
}


<?php
	if ($role_id == 2) { ?>
	function ajaxStatistikBiddingCallback(result) {
		result = jQuery.parseJSON(result);
		
		var bidding_total = result[0].total;
		var bidding_berhasil = result[0].berhasil;
		var bidding_gagal = result[0].gagal;
		
		element = "";
		element += "<td class='td-row-header'>Berhasil</td>";
		element += "<td>" + bidding_berhasil + "</td>";
		element += "<td>" + result[0].berhasil_30 + "</td>";
		element += "<td>" + result[0].berhasil_180 + "</td>";
		element += "<td>" + result[0].berhasil_365 + "</td>";
		$(".tr-bidding-berhasil").html("");
		$(".tr-bidding-berhasil").html(element);
		
		element = "";
		element += "<td class='td-row-header'>Gagal</td>";
		element += "<td>" + bidding_gagal + "</td>";
		element += "<td>" + result[0].gagal_30 + "</td>";
		element += "<td>" + result[0].gagal_180 + "</td>";
		element += "<td>" + result[0].gagal_365 + "</td>";
		$(".tr-bidding-gagal").html("");
		$(".tr-bidding-gagal").html(element);
		
		element = "";
		element += "<td class='td-row-header'>Total</td>";
		element += "<td>" + bidding_total + "</td>";
		element += "<td>" + result[0].total_30 + "</td>";
		element += "<td>" + result[0].total_180 + "</td>";
		element += "<td>" + result[0].total_365 + "</td>";
		$(".tr-bidding-total").html("");
		$(".tr-bidding-total").html(element);
		
		element = "";
		var persen = +(bidding_berhasil * 100 / bidding_total).toFixed(2) || 0;
		var persen_30 = +(result[0].berhasil_30 * 100 / result[0].total_30).toFixed(2) || 0;
		var persen_180 = +(result[0].berhasil_180 * 100 / result[0].total_180).toFixed(2) || 0;
		var persen_365 = +(result[0].berhasil_365 * 100 / result[0].total_365).toFixed(2) || 0;
		element += "<td class='td-row-header'>Persen</td>";
		element += "<td>" + persen + "%</td>";
		element += "<td>" + persen_30 + "%</td>";
		element += "<td>" + persen_180 + "%</td>";
		element += "<td>" + persen_365 + "%</td>";
		$(".tr-bidding-persen").html("");
		$(".tr-bidding-persen").html(element);
	};
<?php	
	} ?>


</script>