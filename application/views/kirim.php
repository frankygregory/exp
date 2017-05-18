<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="section">
	<div class="subsection-filter">
		<div class="subsection-title">Filter</div>
		<div class="form-item">
			<div class="form-item-label">Kota Asal</div>
			<input type="text" class="input-kota-asal" data-fromto="from" value="" />
			<div class="datalist from-city-dropdown">
			</div>
		</div>
		<div class="form-item">
			<div class="form-item-label">Kota Tujuan</div>
			<input type="text" class="input-kota-tujuan" data-fromto="to" />
			<div class="datalist to-city-dropdown">
			</div>
		</div>
		<div class="form-item form-item-jarak">
			<div class="form-item-label">Jarak (Km)</div>
			<span>Min</span>
			<input type="text" class="input-jarak-min" maxlength="4" />
			<span>Max</span>
			<input type="text" class="input-jarak-max" maxlength="4" />
		</div>
		<div class="form-item form-item-lowest-bid">
			<div class="form-item-label">Lowest Bid (IDR)</div>
			<input type="text" class="input-lowest-bid" maxlength="10"/>
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
<div class="content">
	<div class="section-1">
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
var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
$(function() {
	
	getKiriman();
	
	$(".select-sort").on("change", function() {
		getKiriman();
	});
	
	$(".input-jarak-min, .input-jarak-max").on("keydown", function(e) {
		isNumber(e);
	});
	
	$(".input-kota-asal").on("input", function() {
		var keyword = $(this).val();
		getKota("from", keyword);
	});
	
	$(".input-kota-tujuan").on("input", function() {
		var keyword = $(this).val();
		getKota("to", keyword);
	});
	
	$(".input-kota-asal, .input-kota-tujuan").on("keypress", function(e) {
		if (e.which == 13) {
			$(this).blur();
		}
	});
	
	$(".input-kota-asal").on("focusout", function() {
		hideDatalist("from");
		getKiriman();
	});
	
	$(".input-kota-tujuan").on("focusout", function() {
		hideDatalist("to");
		getKiriman();
	});
	
	$(".input-jarak-min, .input-jarak-max").on("keypress", function() {
		if (e.which == 13) {
			$(this).blur();
		}
	});
	
	$(".input-jarak-min, .input-jarak-max, .input-lowest-bid").on("focusout", function() {
		getKiriman();
	});
	
	$(".input-lowest-bid").on("keydown", function(e) {
		isNumber(e);
	});
	
	$(document).on("click", function(e) {
		if ($(e.target).attr("class") !== "datalist") {
			$(".datalist").css("display", "none");
		}
	});
});

function getKota(fromto, keyword) {
	var data = {
		fromto: fromto,
		keyword: keyword
	};
	
	ajaxCall("<?= base_url("kirim/getKota") ?>", data, function(json) {
		var result = jQuery.parseJSON(json);
		var element = "";
		var iLength = result.length;
		if (iLength > 0) {
			for (var i = 0; i < iLength; i++) {
				element += "<div class='datalist-item " + fromto + "-city-dropdown-item'>" + result[i].city + "</div>";
			}
		} else {
			element += "<div class='datalist-empty-state'>Tidak ada hasil</div>";
		}
		$("." + fromto + "-city-dropdown").html("");
		$("." + fromto + "-city-dropdown").append(element);
		showDatalist(fromto);
	});
}

function showDatalist(fromto) {
	$("." + fromto + "-city-dropdown").css("display", "block");
}

function hideDatalist(fromto) {
	$("." + fromto + "-city-dropdown").css("display", "none");
}

function getKiriman() {
	var jarak_min = parseInt($(".input-jarak-min").val()) || 0;
	var jarak_max = parseInt($(".input-jarak-max").val()) || 0;
	var lowest_bid = parseInt($(".input-lowest-bid").val()) || 0;
	var order_by = $(".select-sort").val();
	var keyword_from = $(".input-kota-asal").val();
	var keyword_to = $(".input-kota-tujuan").val();
	
	$.ajax({
		url: '<?= base_url("kirim/getKiriman") ?>',
		data: {
			keyword_from: keyword_from,
			keyword_to: keyword_to,
			shipment_length_min: jarak_min,
			shipment_length_max: jarak_max,
			lowest_bid: lowest_bid,
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
	
	var element = "<tr class='tr-kiriman' data-id='" + result.shipment_id + "'><td class='td-title'><a href='<?= base_url("kirim/detail/") ?>" + result.shipment_id + "'>" + result.shipment_title + "</a><img class='shipment-picture' src='<?= base_url("assets/panel/images/") ?>" + result.shipment_pictures + "' /></td><td class='td-price'>Bid : " + result.bidding_count + "<br>Low : " + addCommas(result.low) + " IDR</td><td class='td-asal'>" + result.location_from_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan'>" + result.location_to_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km'>" + parseInt(result.shipment_length) + " Km</td><td class='td-berakhir'>" + result.berakhir + "</td></td></tr>";
	$(".tbody-kiriman").append(element);
}
</script>