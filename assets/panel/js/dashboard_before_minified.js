$(function() {
	getKirimanCount();
	if (isEkspedisi) {
		getMyRating();
	}
	getStatistik();
});

function getKirimanCount() {
	ajaxCall(getKirimanCountUrl, null, function(json) {
		var result = jQuery.parseJSON(json);
		if (isEkspedisi) {
			$(".kiriman-open .value").html(result.kiriman_open);
		} else {
			$(".kiriman-total .value").html(result.kiriman_total);
		}
		$(".kiriman-berjalan .value").html(result.kiriman_berjalan);
	});
}

function getMyRating() {
	ajaxCall(getMyRatingUrl, null, function(json) {
		var result = jQuery.parseJSON(json);
		var rating = parseFloat(parseFloat(result[0].user_details_rating).toFixed(2));
		$(".rating-total-number").html(rating);
	});
}

function getStatistik() {
	setLoading(".table-statistik-kiriman, .table-statistik-bidding");
	ajaxCall(getStatistikUrl, null, function(result) {
		removeLoading();
		result = jQuery.parseJSON(result);
	
		var total = result[0].jumlah_transaksi_total;
		var berhasil = result[0].jumlah_transaksi_berhasil;
		var gagal = result[0].jumlah_transaksi_gagal;
		var total_30 = result[0].jumlah_transaksi_total_1_bulan;
		var berhasil_30 = result[0].jumlah_transaksi_berhasil_1_bulan;
		var gagal_30 = result[0].jumlah_transaksi_gagal_1_bulan;
		var total_180 = result[0].jumlah_transaksi_total_6_bulan;
		var berhasil_180 = result[0].jumlah_transaksi_berhasil_6_bulan;
		var gagal_180 = result[0].jumlah_transaksi_gagal_6_bulan;
		var total_365 = result[0].jumlah_transaksi_total_12_bulan;
		var berhasil_365 = result[0].jumlah_transaksi_berhasil_12_bulan;
		var gagal_365 = result[0].jumlah_transaksi_gagal_12_bulan;
		
		var element = "";
		element += "<td class='td-row-header'>Berhasil</td>";
		element += "<td>" + berhasil + "</td>";
		element += "<td>" + berhasil_30 + "</td>";
		element += "<td>" + berhasil_180 + "</td>";
		element += "<td>" + berhasil_365 + "</td>";
		$(".tr-kiriman-berhasil").html("");
		$(".tr-kiriman-berhasil").html(element);
		
		element = "";
		element += "<td class='td-row-header'>Gagal</td>";
		element += "<td>" + gagal + "</td>";
		element += "<td>" + gagal_30 + "</td>";
		element += "<td>" + gagal_180 + "</td>";
		element += "<td>" + gagal_365 + "</td>";
		$(".tr-kiriman-gagal").html("");
		$(".tr-kiriman-gagal").html(element);
		
		element = "";
		element += "<td class='td-row-header'>Total</td>";
		element += "<td>" + total + "</td>";
		element += "<td>" + total_30 + "</td>";
		element += "<td>" + total_180 + "</td>";
		element += "<td>" + total_365 + "</td>";
		$(".tr-kiriman-total").html("");
		$(".tr-kiriman-total").html(element);
		
		element = "";
		var persen = +(berhasil * 100 / total).toFixed(2) || 0;
		var persen_30 = +(berhasil_30 * 100 / total_30).toFixed(2) || 0;
		var persen_180 = +(berhasil_180 * 100 / total_180).toFixed(2) || 0;
		var persen_365 = +(berhasil_365 * 100 / total_365).toFixed(2) || 0;
		
		element += "<td class='td-row-header'>Persen</td>";
		element += "<td>" + persen + "%</td>";
		element += "<td>" + persen_30 + "%</td>";
		element += "<td>" + persen_180 + "%</td>";
		element += "<td>" + persen_365 + "%</td>";
		$(".tr-kiriman-persen").html("");
		$(".tr-kiriman-persen").html(element);

		if (isEkspedisi) {
			var bidding_total = result[0].jumlah_bid_total;
			var bidding_berhasil = result[0].jumlah_bid_diterima;
			var bidding_gagal = result[0].jumlah_bid_gagal;
			var bidding_total_30 = result[0].jumlah_bid_total_1_bulan;
			var bidding_berhasil_30 = result[0].jumlah_bid_diterima_1_bulan;
			var bidding_gagal_30 = result[0].jumlah_bid_gagal_1_bulan;
			var bidding_total_180 = result[0].jumlah_bid_total_6_bulan;
			var bidding_berhasil_180 = result[0].jumlah_bid_diterima_6_bulan;
			var bidding_gagal_180 = result[0].jumlah_bid_gagal_6_bulan;
			var bidding_total_365 = result[0].jumlah_bid_total_12_bulan;
			var bidding_berhasil_365 = result[0].jumlah_bid_diterima_12_bulan;
			var bidding_gagal_365 = result[0].jumlah_bid_gagal_12_bulan;
			
			element = "";
			element += "<td class='td-row-header'>Berhasil</td>";
			element += "<td>" + bidding_berhasil + "</td>";
			element += "<td>" + bidding_berhasil_30 + "</td>";
			element += "<td>" + bidding_berhasil_180 + "</td>";
			element += "<td>" + bidding_berhasil_365 + "</td>";
			$(".tr-bidding-berhasil").html("");
			$(".tr-bidding-berhasil").html(element);
			
			element = "";
			element += "<td class='td-row-header'>Gagal</td>";
			element += "<td>" + bidding_gagal + "</td>";
			element += "<td>" + bidding_gagal_30 + "</td>";
			element += "<td>" + bidding_gagal_180 + "</td>";
			element += "<td>" + bidding_gagal_365 + "</td>";
			$(".tr-bidding-gagal").html("");
			$(".tr-bidding-gagal").html(element);
			
			element = "";
			element += "<td class='td-row-header'>Total</td>";
			element += "<td>" + bidding_total + "</td>";
			element += "<td>" + bidding_total_30 + "</td>";
			element += "<td>" + bidding_total_180 + "</td>";
			element += "<td>" + bidding_total_365 + "</td>";
			$(".tr-bidding-total").html("");
			$(".tr-bidding-total").html(element);
			
			element = "";
			var persen = +(bidding_berhasil * 100 / bidding_total).toFixed(2) || 0;
			var persen_30 = +(bidding_berhasil_30 * 100 / bidding_total_30).toFixed(2) || 0;
			var persen_180 = +(bidding_berhasil_180 * 100 / bidding_total_180).toFixed(2) || 0;
			var persen_365 = +(bidding_berhasil_365 * 100 / bidding_total_365).toFixed(2) || 0;
			element += "<td class='td-row-header'>Persen</td>";
			element += "<td>" + persen + "%</td>";
			element += "<td>" + persen_30 + "%</td>";
			element += "<td>" + persen_180 + "%</td>";
			element += "<td>" + persen_365 + "%</td>";
			$(".tr-bidding-persen").html("");
			$(".tr-bidding-persen").html(element);
		}
	});
}