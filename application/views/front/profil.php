<div class="content">
    <div class="section-1">
        <div class="username"><?= $user[0]->username ?></div>
    </div>
    <div class="section-2 section">
        <div class="subsection subsection-kiriman">
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
    <?php	if ($user[0]->role_id == 2) { ?>
		<div class="subsection">
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
 <?php	if ($user[0]->role_id == 2) { ?>
    <div class="section-3">
        <div class="subsection-rating-total">
            <div class="rating-total">
                <span class="rating-label">Rating : </span>
                <span class="rating-total-number"></span>
            </div>
        </div>
        <div class="subsection-rating-feedback">
            <div class="sort">
                <span class="sort-label">Urutkan : </span>
                <select class="select-sort">
                    <option value="created_date_desc">Tanggal Terbaru</option>
                    <option value="created_date_asc">Tanggal Terlama</option>
                    <option value="user_details_rating_number_desc">Rating Tertinggi</option>
                    <option value="user_details_rating_number_asc">Rating Terendah</option>
                </select>
            </div>
            <div class="feedback-section">
            </div>
        </div>
    </div>
<?php   }   ?>
</div>
<script>
var profilUrl = "<?= base_url("profil/") ?>";
$(function() {
    getStatistik();
<?php
    if ($user[0]->role_id == 2) { ?>
        getMyRating();
        getMyFeedback();
<?php } ?>
});

function getStatistik() {
	ajaxCall("<?= base_url("home/getStatistik") ?>", {user_id: <?= $user[0]->user_id ?>}, function(result) {
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

<?php	if ($user[0]->role_id == 2) { ?>
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
<?php	}	?>
	});
}

<?php	if ($user[0]->role_id == 2) { ?>
function getMyRating() {
	ajaxCall("<?= base_url("home/getProfilRating") ?>", {user_id: <?= $user[0]->user_id ?>}, function(json) {
		var result = jQuery.parseJSON(json);
		var rating = parseFloat(parseFloat(result[0].user_details_rating).toFixed(2));
		$(".rating-total-number").html(rating);
	});
}

function getMyFeedback() {
	var sort = $(".select-sort").val();
	ajaxCall("<?= base_url("home/getProfilFeedback") ?>", {sort: sort, user_id: <?= $user[0]->user_id ?>}, function(json) {
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
			element += '<td class="td-value"><a href="<?= base_url("kirim/detail/"); ?>' + result[i].shipment_id + '" >' + result[i].shipment_title + '</a></td>';
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
		
		$(".feedback-section").html("");
		$(".feedback-section").append(element);
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
<?php } ?>
</script>