<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="content">
	<div class="section-1">
	</div>
	<div class="section-2">
		<div class="feedback-section">
		</div>
	</div>
</div>
</div>
</div>

<script type="text/javascript">
$(function() {
	getMyFeedback();
});

function getMyFeedback() {
	ajaxCall("<?= base_url("ulasan/getMyFeedback") ?>", null, function(json) {
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
			element += '<td>' + result[i].user_rating_number + '/5</td>';
			element += '</tr>';
			element += '<tr>';
			element += '<td class="td-label">Oleh</td>';
			element += '<td class="td-value">' + result[i].username + '</td>';
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
</script>