$(function() {
	$(".tabs-item").on("click", function() {
		var thisElement = $(this);
		var offset = thisElement.position();
		var tabsNumber = thisElement.data("tabs-number");
		var currentTabsNumber = thisElement.siblings(".active").data("tabs-number");
		if (currentTabsNumber !== undefined) {
			var width = parseInt(thisElement.css("width"));
			var uri = thisElement.data("label");
			window.history.replaceState(null, null, "#" + uri);
			var tabsSelection = thisElement.closest(".tabs").find(".tabs-selection");
			$(tabsSelection).stop();
			$(tabsSelection).animate({
				marginLeft: offset.left + "px",
				width: width
			}, 200);
			
			thisElement.siblings().removeClass("active");
			thisElement.addClass("active");
			
			thisElement.closest(".tabs").find(".tabs-content[data-tabs-number='" + currentTabsNumber + "']").animate({
				"opacity": 0
			}, 100, function() {
				$(this).css("display", "none");
				$(this).siblings("[data-tabs-number='" + tabsNumber + "']").css("display", "block");
				$(this).siblings("[data-tabs-number='" + tabsNumber + "']").animate({
					"opacity": 1
				}, 100);
			});
			thisElement.trigger("tabs-item-click");
		}
	});
});

function updateTabsItemCount(tabsNumber, count) {
	$(".tabs-item[data-tabs-number='" + tabsNumber + "'] .tabs-item-count").html(count);
}