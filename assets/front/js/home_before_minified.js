var section2Top = 0, section3Top = 0, section4Top = 0;
var scrollTop = 0, showOffset = 300;
var innerHeight = window.innerHeight;

$(function() {
	initialize();
	
	$(window).on("resize", function() {
		initialize();
	});
	
	$(document).on("scroll", function() {
		scrollTop = window.scrollY;
	});

	$(document).on("scroll", showSection2);
	$(document).on("scroll", showSection3);
	$(document).on("scroll", showSection4);
});

function initialize() {
	if (isMobile) {
		showOffset = 150;
	}

	scrollTop = window.scrollY;
	section2Top = $(".section-2").offset().top;
	section3Top = $(".section-3").offset().top;
	section4Top = $(".section-4").offset().top;
	showSection2();
	showSection3();
	showSection4();
}

function showSection2() {
	var section2 = section2Top - scrollTop;

	if (section2 < innerHeight - showOffset) {
		$(".section-2 .section-content").addClass("show");
		$(document).off("scroll", showSection2);
	}
}

function showSection3() {
	var section3 = section3Top - scrollTop;

	if (section3 < innerHeight - showOffset) {
		$(".section-3 .section-content").addClass("show");
		$(document).off("scroll", showSection3);
	}
}

function showSection4() {
	var section4 = section4Top - scrollTop;

	if (section4 < innerHeight - showOffset) {
		$(".section-4-content").addClass("show");
		$(document).off("scroll", showSection3);
	}
}