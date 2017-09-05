var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
var headerHeight, sectionHeight, sectionTop, sectionPosition, theadHeight, tbodyTop, tbodyPosition;
var alreadyRefresh = false;
$(function() {
	if ($(".header").length > 0) {
		headerHeight = parseInt($(".header").css("height")) || 0;
	} else {
		headerHeight = parseInt($(".navigation-header").css("height")) || 0;
	}
	
	sectionHeight = parseInt($(".section").css("height")) || 0;
	sectionTop = $(".section").offset().top;
	sectionPosition = sectionTop - headerHeight;
	theadHeight = parseInt($(".table-kiriman thead").css("height")) || 0;
	tbodyTop = $(".table-kiriman tbody").offset().top;
	tbodyPosition = tbodyTop - headerHeight - theadHeight - sectionHeight;

	getKiriman();
	
	if ($(".container-content").length > 0) {
		$(".container-content").on("scroll", scrollDownEvent);
	} else {
		$(document).on("scroll", scrollDownEvent);
	}
	
	$(".select-sort").on("change", function() {
		getKiriman();
	});
	
	$(".input-kota-asal").on("input", function() {
		var keyword = $(this).val();
		getKota("from", keyword);
	});
	
	$(".input-kota-tujuan").on("input", function() {
		var keyword = $(this).val();
		getKota("to", keyword);
	});
	
	$(".input-kota-asal, .input-kota-tujuan, .input-jarak-max").on("keypress", function(e) {
		if (e.which == 13) {
			var datalistItem = $(this).next().find(".datalist-item.active");
			if (datalistItem.length > 0) {
				$(datalistItem).mousedown();
			}  else {
				$(this).blur();
			}
		}
	});
	
	$(".input-kota-asal, .input-kota-tujuan").on("keydown", function(e) {
		if (e.which == 40) { //DOWN
			setActiveDatalistItem(this, 1);
		} else if (e.which == 38) { //UP
			setActiveDatalistItem(this, -1);
		}
	});

	$(".input-kota-asal, .input-kota-tujuan").on("focusout", function() {
		hideDatalist();
		if (!alreadyRefresh) {
			getKiriman();
		} else {
			alreadyRefresh = false;
		}
	});

	$(".input-jarak-slider").on("input", function() {
		var value = $(this).val();
		$(".input-jarak-max").val(value);
	});

	$(".input-jarak-slider").on("change", function() {
		getKiriman();
	});
	
	$(".input-jarak-max").on("change", function(e) {
		var value = $(this).val();
		$(".input-jarak-slider").val(value);
		getKiriman();
	});

	$(".input-jarak-max").on("change", function() {
		var value = parseInt($(this).val());
		if (value > 5000) {
			$(this).val("5000");
		}
	});

	$(".input-jarak-max").on("keydown", function(e) {
		isNumber(e);
	});
	
	$(document).on("click", function(e) {
		if ($(e.target).closest(".datalist").length == 0) {
			hideDatalist();
		}
	});

	$(document).on("mousedown", ".datalist-item", function() {
		alreadyRefresh = true;
		var value = $(this).html();
		var fromto = $(this).data("fromto");
		$(".input-kota-" + fromto).val(value);
		hideDatalist();
		$(this).parent().prev().blur();
		getKiriman();
	});

	$("td[data-sortable='true']").on("click", function() {
		var col = $(this).data("col");
		var sort = $(this).data("sort-value");
		if (sort == "" || sort == "desc") {
			sort = "asc";
		} else {
			sort = "desc";
		}
	});

	$(".select-view-per-page").on("change", function() {
		getKiriman();
	});

	paginationCallback = function() {
		getKiriman(true);
	};

});

function setActiveDatalistItem(element, arah) {
	var parent = $(element).next();
	var count = $(parent).find(".datalist-item").length;
	if (count > 0) {
		var current = parseInt($(parent).find(".datalist-item.active").data("index")) || 0;
		current += arah;
		if (current <= 0) {
			current = 1;
		} else if (current >= count) {
			current = count;
		}
		
		$(parent).find(".datalist-item.active").removeClass("active");
		$(parent).find(".datalist-item[data-index='" + current + "']").addClass("active");
	}
}

function scrollDownEvent() {
	var scrollTop = $(this).scrollTop();
	if (scrollTop >= sectionPosition) {
		$(".section, .table-kiriman").addClass("fixed");
		$(".section").css("top", headerHeight);
		$(".table-kiriman thead").css("top", headerHeight + sectionHeight);
		$(this).off("scroll");
		$(this).on("scroll", scrollUpEvent);
	}
}

function scrollUpEvent() {
	var scrollTop = $(this).scrollTop();
	if (scrollTop <= sectionPosition) {
		$(".section, .table-kiriman").removeClass("fixed");
		$(this).off("scroll");
		$(this).on("scroll", scrollDownEvent);
	}
}

function getKota(fromto, keyword) {
	var data = {
		fromto: fromto,
		keyword: keyword
	};
	
	ajaxCall(getKotaUrl, data, function(json) {
		var result = jQuery.parseJSON(json);
		var element = "";
		var iLength = result.length;
		if (iLength > 0) {
			for (var i = 0; i < iLength; i++) {
				element += "<div class='datalist-item " + fromto + "-city-dropdown-item' data-fromto='" + fromto + "' data-index='" + (i + 1) + "'>" + result[i].city + "</div>";
			}
		} else {
			element += "<div class='datalist-empty-state'>Tidak ada hasil</div>";
		}
		$("." + fromto + "-city-dropdown").html(element);
		showDatalist(fromto);
	});
}

function showDatalist(fromto) {
	$("." + fromto + "-city-dropdown").css("display", "block");
}

function hideDatalist() {
	$(".datalist").css("display", "none");
}

function scrollToTop() {
	if ($(".container-content").length > 0) {
		$(".container-content").scrollTop(0);
	} else {
		$(document).scrollTop(0);
	}
}

function getKiriman(changePage) {
	if (changePage === undefined) {
        changePage = false;
    }
	abortAjaxCall();
	$(".tbody-kiriman").html("");
	setLoading(".table-empty-state");
	var jarak_max = parseInt($(".input-jarak-max").val()) || 0;
	var order_by = $(".select-sort").val();
	var keyword_from = $(".input-kota-asal").val();
	var keyword_to = $(".input-kota-tujuan").val();
	var view_per_page = parseInt($(".select-view-per-page").val());
	var page = 1;
	if (changePage) {
		page = parseInt($(".page-number-item.current-page-number").data("value"));
		var availablePages = parseInt($(".available-pages").data("value"));
		if (page == availablePages) {
			disableNextPage();
		} else {
			enableNextPage();
		}

		if (page > 1) {
			enablePrevPage();
		} else {
			disablePrevPage();
		}
	}
	
	var data = {
		keyword_from: keyword_from,
		keyword_to: keyword_to,
		shipment_length_max: jarak_max,
		order_by: order_by,
		view_per_page: view_per_page,
		page: page,
		change_page: changePage
	};
	ajaxCall(getKirimanUrl, data, function(json) {
		removeLoading();
		var result = jQuery.parseJSON(json);
		scrollToTop();
		if (!changePage) {
			var count = result.count;
			setAvailablePages(count, view_per_page);
		}

		var resultPagingFrom = ((page - 1) * view_per_page) + 1;
		var resultPagingTo = resultPagingFrom + view_per_page - 1;
		var count = parseInt($(".result-count").html());
		if (resultPagingTo > count) {
			resultPagingTo = count;
		}
		$(".result-paging").html(resultPagingFrom + " - " + resultPagingTo);

		$(".tbody-kiriman").html("");
		var iLength = result.data.length;
		for (var i = 0; i < iLength; i++) {
			addKirimanToTable((i + 1), result.data[i]);
		}
		if (iLength == 0) {
			$(".table-empty-state").addClass("shown");
		} else {
			$(".table-empty-state").removeClass("shown");
		}
	});
}

function addKirimanToTable(no, result) {
	var date_from = new Date(result.shipment_delivery_date_from);
	var fullDateFrom = date_from.getDate() + " " + month[date_from.getMonth()] + " " + date_from.getFullYear().toString().substring(2, 4);
	var date_to = new Date(result.shipment_delivery_date_to);
	var fullDateTo = date_to.getDate() + " " + month[date_to.getMonth()] + " " + date_to.getFullYear().toString().substring(2, 4);
	
	var shipment_picture = (result.shipment_pictures == "") ? "default.gif" : result.shipment_pictures;
	var element = "<tr class='tr-kiriman' data-id='" + result.shipment_id + "'><td class='td-title' data-col='nama-kirim'><a href='" + shipmentUrl + result.shipment_id + "'>" + "<img class='shipment-picture' src='" + shipmentPictureUrl + shipment_picture + "' onerror='this.onerror=null; this.src=\"" + defaultPictureUrl + "\";' /><span>" + result.shipment_title + "</span></a></td><td class='td-price' data-col='harga'>Bid : " + result.bidding_count + "<br>Low : " + addCommas(result.low) + " IDR</td><td class='td-asal' data-col='asal'>" + result.location_from_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-tujuan' data-col='tujuan'>" + result.location_to_city + "<br>" + fullDateFrom + " - " + fullDateTo + "</td><td class='td-km' data-col='km'>" + parseInt(result.shipment_length) + "</td><td class='td-berakhir' data-col='berakhir'>" + result.berakhir + "</td></td></tr>";
	$(".tbody-kiriman").append(element);
}