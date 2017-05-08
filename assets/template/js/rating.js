var rating = {
	divOpen: "<div class='stars' data-stars='5'>",
	content: "<svg height='25' width='23' class='star rating' data-rating='1'><polygon points='9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78' style='fill-rule:nonzero;'/></svg><svg height='25' width='23' class='star rating' data-rating='2'><polygon points='9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78' style='fill-rule:nonzero;'/></svg><svg height='25' width='23' class='star rating' data-rating='3'><polygon points='9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78' style='fill-rule:nonzero;'/></svg><svg height='25' width='23' class='star rating' data-rating='4'><polygon points='9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78' style='fill-rule:nonzero;'/></svg><svg height='25' width='23' class='star rating' data-rating='5'><polygon points='9.9, 1.1, 3.3, 21.78, 19.8, 8.58, 0, 8.58, 16.5, 21.78' style='fill-rule:nonzero;'/></svg>",
	divClose: "</div>",
	getRatingHTML: function(ratingClass = "") {
		this.divOpen = "<div class='stars " + ratingClass + "' data-stars='5'>";
		return this.divOpen + this.content + this.divClose;
	}
};

$(function() {
	$(document).on("click", ".star.rating", function() {
		$(this).parent().attr('data-stars', $(this).data('rating'));
	});
});

function addRatingToElement(element, ratingClass = "") {
	$(element).append(rating.getRatingHTML(ratingClass));
}

function getRatingJs(ratingClass = "") {
	return rating.getRatingHTML(ratingClass);
}

function getRatingValue(ratingClass = "") {
	return $(".stars " + ratingClass).attr("data-stars");
}