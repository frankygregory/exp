$(function() {
	$(".tabs-item").on("click", function() {
		var offset = $(this).position();
		var tabsNumber = $(this).data("tabs-number");
		var width = parseInt($(this).css("width"));
		var tabsSelection = $(this).closest(".tabs").find(".tabs-selection");
		$(tabsSelection).stop();
		$(tabsSelection).animate({
			marginLeft: offset.left + "px",
			width: width
		}, 200);
		var currentTabsNumber = $(this).siblings(".active").data("tabs-number");
		$(this).siblings().removeClass("active");
		$(this).addClass("active");
		
		$(this).closest(".tabs").find(".tabs-content[data-tabs-number='" + currentTabsNumber + "']").animate({
			"opacity": 0
		}, 100, function() {
			$(this).css("display", "none");
			$(this).siblings("[data-tabs-number='" + tabsNumber + "']").css("display", "block");
			$(this).siblings("[data-tabs-number='" + tabsNumber + "']").animate({
				"opacity": 1
			}, 100);
		});
	});
});

function updateTabsItemCount(tabsNumber, count) {
	$(".tabs-item[data-tabs-number='" + tabsNumber + "'] .tabs-item-count").html(count);
}