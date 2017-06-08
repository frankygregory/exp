<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="section">
	<div class="subsection-filter">
		<div class="subsection-title">Filter</div>
		<div class="form-item">
			<div class="form-item-label">Kota Asal</div>
			<input type="text" class="input-kota-asal input-kota-from" data-fromto="from" value="" />
			<div class="datalist from-city-dropdown">
			</div>
		</div>
		<div class="form-item">
			<div class="form-item-label">Kota Tujuan</div>
			<input type="text" class="input-kota-tujuan input-kota-to" data-fromto="to" />
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
		<div class="table-container">
			<table class="table table-kiriman">
				<thead>
					<tr>
						<td class="td-nama-kirim" data-col="nama-kirim">Nama Kirim</td>
						<td data-col="harga">Harga</td>
						<td data-col="asal">Asal</td>
						<td data-col="tujuan">Tujuan</td>
						<td class="td-km" data-col="km">Km</td>
						<td data-col="berakhir">Berakhir</td>
					</tr>
				</thead>
				<tbody class="tbody-kiriman">
				</tbody>
			</table>
		</div>
	</div>
	<div class="paging-section">
		<div class="view-per-page">
			View per page :
			<select class="select-view-per-page">
				<option value="10">10</option>
				<option value="25">25</option>
				<option value="50">50</option>
			</select>
		</div>
		<div class="page-numbers">
			Halaman : 
			<div class="page-number-item disabled" data-value="prev">Previous</div>
			<div class="page-number-item current-page-number" data-value="1">1</div>
			<div class="page-number-item" data-value="2">2</div>
			<div class="page-number-item" data-value="3">3</div>
			<div class="page-number-item" data-value="4">4</div>
			<div class="page-number-item" data-value="next">Next</div>
		</div>
	</div>
</div>
</div>
</div>


<script type="text/javascript">
var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
$(function() {
	if ($(".header").length > 0) {
		$(".header").addClass("scroll");
	}
	getKiriman();
	
	var headerHeight = parseInt($(".navigation-header").css("height"));
	var theadHeight = parseInt($(".table-kiriman thead").css("height"));
	var tbodyTop = $(".table-kiriman tbody").offset().top;
	var tbodyPosition = tbodyTop - headerHeight - theadHeight;
	
	$(".container-content").on("scroll", scrollDownEvent);

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
	
	$(".input-kota-asal").on("keypress", function(e) {
		if (e.which == 13) {
			hideDatalist();
			getKiriman();
		}
	});
	
	$(".input-kota-tujuan").on("keypress", function(e) {
		if (e.which == 13) {
			hideDatalist();
			getKiriman();
		}
	});
	
	$(".input-jarak-min, .input-jarak-max, .input-lowest-bid").on("keypress", function(e) {
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
		if ($(e.target).closest(".datalist").length == 0) {
			hideDatalist();
		}
	});

	$(document).on("click", ".datalist-item", function() {
		var value = $(this).html();
		var fromto = $(this).data("fromto");
		$(".input-kota-" + fromto).val(value);
		hideDatalist();
		getKiriman();
	});

	function scrollDownEvent() {
		var scrollTop = $(".container-content").scrollTop();
		if (scrollTop >= tbodyPosition) {
			$(".table-kiriman").addClass("fixed");
			$(".container-content").off("scroll");
			$(".container-content").on("scroll", scrollUpEvent);
		}
	}

	function scrollUpEvent() {
		var scrollTop = $(".container-content").scrollTop();
		if (scrollTop <= tbodyPosition) {
			$(".table-kiriman").removeClass("fixed");
			$(".container-content").off("scroll");
			$(".container-content").on("scroll", scrollDownEvent);
		}
	}
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
				element += "<div class='datalist-item " + fromto + "-city-dropdown-item' data-fromto='" + fromto + "'>" + result[i].city + "</div>";
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

function hideDatalist() {
	$(".datalist").css("display", "none");
}

function getKiriman() {
	var jarak_min = parseInt($(".input-jarak-min").val()) || 0;
	var jarak_max = parseInt($(".input-jarak-max").val()) || 0;
	var lowest_bid = parseInt($(".input-lowest-bid").val()) || 0;
	var order_by = $(".select-sort").val();
	var keyword_from = $(".input-kota-asal").val();
	var keyword_to = $(".input-kota-tujuan").val();
	
	var data = {
		keyword_from: keyword_from,
		keyword_to: keyword_to,
		shipment_length_min: jarak_min,
		shipment_length_max: jarak_max,
		lowest_bid: lowest_bid,
		order_by: order_by
	};
	ajaxCall("<?= base_url("kirim/getKiriman") ?>", data, function(json) {
		$(".tbody-kiriman").html("");
		var result = jQuery.parseJSON(json);
		for (var i = 0; i < result.length; i++) {
			addKirimanToTable((i + 1), result[i]);
		}
	});
}

function addKirimanToTable(no, result) {
	var date_from = new Date(result.shipment_delivery_date_from);
	var fullDateFrom = date_from.getDate() + " " + month[date_from.getMonth()] + " " + date_from.getFullYear().toString().substring(2, 4);
	var date_to = new Date(result.shipment_delivery_date_to);
	var fullDateTo = date_to.getDate() + " " + month[date_to.getMonth()] + " " + date_to.getFullYear().toString().substring(2, 4);
	
	var element = "<tr class='tr-kiriman' data-id='" + result.shipment_id + "'><td class='td-title' data-col='nama-kirim'><a href='<?= base_url("kirim/detail/") ?>" + result.shipment_id + "'>" + result.shipment_title + "<img class='shipment-picture' src='<?= base_url("assets/panel/images/") ?>" + result.shipment_pictures + "' /></a></td><td class='td-price' data-col='harga'>Bid : " + result.bidding_count + "<br>Low : " + addCommas(result.low) + " IDR</td><td class='td-asal' data-col='asal'>" + result.location_from_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan' data-col='tujuan'>" + result.location_to_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km' data-col='km'>" + parseInt(result.shipment_length) + "</td><td class='td-berakhir' data-col='berakhir'>" + result.berakhir + "</td></td></tr>";
	$(".tbody-kiriman").append(element);
}
</script>