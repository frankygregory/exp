<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="content">
	<div class="section-1">
		<div class="rating-total">
			<span class="rating-label">Rating : </span>
			<span class="rating-total-number"></span>
		</div>
	</div>
	<div class="section-2">
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
			<div class="feedback-data"></div>
			<div class="default-empty-state">Tidak ada ulasan</div>
		</div>
	</div>
</div>
</div>
</div>

<script type="text/javascript">
var profilUrl = "<?= base_url("profil/") ?>";
$(function() {
	getMyRating();
	getMyFeedback();
	
	$(".select-sort").on("change", function() {
		getMyFeedback();
	});
});

function getMyRating() {
	ajaxCall("<?= base_url("ulasan/getMyRating") ?>", null, function(json) {
		var result = jQuery.parseJSON(json);
		var rating = parseFloat(parseFloat(result[0].user_details_rating).toFixed(2));
		$(".rating-total-number").html(rating);
	});
}

function getMyFeedback() {
	$(".feedback-data").html("");
	setLoading(".default-empty-state");
	var sort = $(".select-sort").val();
	ajaxCall("<?= base_url("ulasan/getMyFeedback") ?>", {sort: sort}, function(json) {
		removeLoading();
		var result = jQuery.parseJSON(json);
		var element = "";
		var iLength = result.length;
		for (var i = 0; i < iLength; i++) {
			element += '<div class="feedback-item">';
			element += '<div class="feedback-item-left">';
			element += '<table>';
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
</script>