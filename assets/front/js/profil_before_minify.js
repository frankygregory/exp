$(function() {
    getStatistik();
    if (isEkspedisi) {
        getMyRating();
        getMyFeedback();

		$(".select-sort").on("change", function() {
			getMyFeedback();
		});
	}
});

function getStatistik() {
	setLoading(".table-statistik-kiriman-container, .table-statistik-bidding-container");
	ajaxCall(getStatistikUrl, {user_id: user_id}, function(result) {
		removeLoading(".table-statistik-kiriman-container, .table-statistik-bidding-container");
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
		$(".tr-kiriman-berhasil").html(element);
		
		element = "";
		element += "<td class='td-row-header'>Gagal</td>";
		element += "<td>" + gagal + "</td>";
		element += "<td>" + gagal_30 + "</td>";
		element += "<td>" + gagal_180 + "</td>";
		element += "<td>" + gagal_365 + "</td>";
		$(".tr-kiriman-gagal").html(element);
		
		element = "";
		element += "<td class='td-row-header'>Total</td>";
		element += "<td>" + total + "</td>";
		element += "<td>" + total_30 + "</td>";
		element += "<td>" + total_180 + "</td>";
		element += "<td>" + total_365 + "</td>";
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
			$(".tr-bidding-berhasil").html(element);
			
			element = "";
			element += "<td class='td-row-header'>Gagal</td>";
			element += "<td>" + bidding_gagal + "</td>";
			element += "<td>" + bidding_gagal_30 + "</td>";
			element += "<td>" + bidding_gagal_180 + "</td>";
			element += "<td>" + bidding_gagal_365 + "</td>";
			$(".tr-bidding-gagal").html(element);
			
			element = "";
			element += "<td class='td-row-header'>Total</td>";
			element += "<td>" + bidding_total + "</td>";
			element += "<td>" + bidding_total_30 + "</td>";
			element += "<td>" + bidding_total_180 + "</td>";
			element += "<td>" + bidding_total_365 + "</td>";
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
			$(".tr-bidding-persen").html(element);
		}
	});
}

function getMyRating() {
	ajaxCall(getMyRatingUrl, {user_id: user_id}, function(json) {
		removeLoading(".default-empty-state");
		var result = jQuery.parseJSON(json);
		var rating = parseFloat(parseFloat(result[0].user_details_rating).toFixed(2));
		$(".rating-total-number").html(rating);
	});
}

function getMyFeedback() {
	$(".feedback-data").html("");
	$(".default-empty-state").addClass("shown");
	setLoading(".default-empty-state");
	var sort = $(".select-sort").val();
	ajaxCall(getMyFeedbackUrl, {sort: sort, user_id: user_id}, function(json) {
		removeLoading(".default-empty-state");
		var result = jQuery.parseJSON(json);
		var element = "";
		var iLength = result.length;
		for (var i = 0; i < iLength; i++) {
			element += '<div class="feedback-item">';
			element += '<div class="feedback-item-left">';
			element += '<table class="table-feedback">';
			element += '<tbody>';
			element += '<tr>';
			element += '<td class="td-label">Rating</td>';
			element += '<td><div class="stars-container">' + getStars(result[i].user_rating_number) + "</div><span class='rating-number'>" + result[i].user_rating_number + '</span>/5</td>';
			element += '</tr>';
			element += '<tr>';
			element += '<td class="td-label">Oleh</td>';
			element += '<td class="td-value"><a href="' + profilUrl + result[i].created_by + '">' + result[i].username + '</a></td>';
			element += '</tr>';
			element += '<tr>';
			element += '<td class="td-label">Kiriman</td>';
			element += '<td class="td-value"><a href="' + shipmentUrl + result[i].shipment_id + '" >' + result[i].shipment_title + '</a></td>';
			element += '</tr>';
			element += '</tbody>';
			element += '</table>';
			element += '</div>';
			element += '<div class="feedback-item-right">';
			element += '<div class="feedback-text">' + result[i].user_rating_feedback + '</div>';
			element += '</div>';
			element += '<div class="feedback-datetime">Reviewed on : ' + result[i].created_date + '</div>';
			element += '</div>';
		}
		
		if (iLength == 0) {
			$(".default-empty-state").addClass("shown");
		} else {
			$(".default-empty-state").removeClass("shown");
		}
		$(".feedback-data").html(element);
	});
}

function getStars(count) {
	var star = "<svg height='15' width='15' viewbox='0 0 24 24' class='star rating' data-rating='1'><polygon points='9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78' style='fill-rule:nonzero;'/></svg>";
	var result = "";
	for (var i = 0; i < count; i++) {
		result += star;
	}
	return result;
}