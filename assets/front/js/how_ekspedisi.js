var section2Top = 0;
var scrollTop = 0, showOffset = 400;
var innerHeight = window.innerHeight;
$(function() {
	initialize();

	$(document).on("scroll", function() {
		scrollTop = window.scrollY;
	});

	$(document).on("scroll", showSection2);
});

function initialize() {
	if (isMobile) {
		showOffset = 300;
	}
	scrollTop = window.scrollY;
	section2Top = $(".section-2").offset().top;
	
	showSection2();
}

function showSection2() {
	var section2 = section2Top - scrollTop;
	if (section2 < innerHeight - showOffset) {
		$(".section-2 .section-content").addClass("show");
		$(document).off("scroll", showSection2);
	}
}