var paginationCallback;

$(function() {
	$(document).on("click", ".page-number-item:not(.current-page-number):not(.disabled)", changeCurrentPage);
	$(document).on("click", ".page-number-next:not(.disabled)", nextPage);
	$(document).on("click", ".page-number-prev:not(.disabled)", prevPage);
});

function nextPage() {
	var page = parseInt($(".page-number-item.current-page-number").data("value"));
	page++;
	$(".page-number-item[data-value='" + page + "']").click();
}

function prevPage() {
	var page = parseInt($(".page-number-item.current-page-number").data("value"));
	page--;
	$(".page-number-item[data-value='" + page + "']").click();
}

function changeCurrentPage() {
	var page = $(this).data("value");
	$(".page-number-item.current-page-number").removeClass("current-page-number");
	$(this).addClass("current-page-number");
	paginationCallback();
}

function setAvailablePages(count, view_per_page) {
	$(".result-count").html(count);
	var pageCount = Math.ceil(count / view_per_page);
	var element = "";
	element += '<div class="page-number-item current-page-number" data-value="1">1</div>';
	for (var i = 2; i <= pageCount; i++) {
		element += '<div class="page-number-item" data-value="' + i + '">' + i + '</div>';
	}
	$(".available-pages").html(element);
	$(".available-pages").data("value", pageCount);
	
	disablePrevPage();
	if (pageCount <= 1) {
		disableNextPage();
	} else {
		enableNextPage();
	}
}

function disableNextPage() {
	$(".page-number-next").addClass("disabled");
}

function enableNextPage() {
	$(".page-number-next").removeClass("disabled");
}

function disablePrevPage() {
	$(".page-number-prev").addClass("disabled");
}

function enablePrevPage() {
	$(".page-number-prev").removeClass("disabled");
}