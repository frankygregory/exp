$(function() {
	$(".nav-account").on("click", function(e) {
		toggleProfileDropdown(e);
	});
	
	$(document).on("click", function(e) {
		if ($(e.target).attr("class") !== "profile-dropdown") {
			if ($(".nav-account .profile-dropdown").css("display") == "block") {
				$(".nav-account .profile-dropdown").css("display", "none");
			}
		}
	});
	
	$(".dialog-background").on("click", function(e) {
		if (e.target.className == "dialog-background") {
			closeDialog();
		}
	});
	
	$(document).on("keydown", function(e) {
		if (e.which == 27) {
			closeDialog();
		}
	});
	
	$(document).on("click", ".dialog .btn-batal, .dialog .dialog-header-close-btn", function() {
		closeDialog();
	});
	
	$(".menu-hamburger").on("click", function() {
		toggleNavigationDrawer();
	});

	/*$(document).on("mouseenter", ".verified-icon", function() {
		var offset = $(this).offset();
		$(".verified-icon-explanation").css({
			"top": offset.top,
			"left": offset.left
		})
		$(".verified-icon-explanation").addClass("visible");
	});

	$(document).on("mouseleave", ".verified-icon", function() {
		$(".verified-icon-explanation").removeClass("visible");
	});*/
});

function toggleNavigationDrawer() {
	var marginLeft = parseInt($(".navigation-menu").css("margin-left"));
	if (marginLeft < 0) {
		$(".navigation-menu").animate({
			marginLeft: 0
		}, 200);
	} else {
		$(".navigation-menu").animate({
			marginLeft: -220
		}, 200);
	}
}

function toggleProfileDropdown(e) {
	if ($(".nav-account .profile-dropdown").css("display") == "none") {
		$(".nav-account .profile-dropdown").css("display", "block");
	} else {
		$(".nav-account .profile-dropdown").css("display", "none");
	}
	e.stopPropagation();
}

function isNumber(e) {
	if (e.key.length == 1) {
		if ("0123456789".indexOf(e.key) < 0) {
			e.preventDefault();
		}
	}
}

function isInputNumber(element) {
	var value = element.val();
	
}

function showDialog(dialog) {
	$(dialog).parent(".dialog-background").css("display", "block");
	$(dialog).css("display", "block");
	dialog.shown = true;
}

function closeDialog() {
	$(".dialog-background").css("display", "none");
	$(".dialog").css("display", "none");
	dialog.shown = false;
	
	$(".dialog input[type='text'], .dialog input[type='password'], .dialog textarea").val("");
	if ($("select").length > 0) {
		$("select")[0].selectedIndex = 0;
	}
}

function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

function ajaxCall(url, data, callback) {
	ajaxVariable = $.ajax({
		url: url,
		data: data,
		type: 'POST',
		error: function(jqXHR, exception) {
			if (exception != "abort") {
				console.log(jqXHR + " : " + jqXHR.responseText);
			}
		},
		success: function(result) {
			callback(result);
		}
	});
	return ajaxVariable;
}

function abortAjaxCall() {
	if (ajaxVariable) {
		ajaxVariable.abort();
	}
}

function showFullscreenLoading() {
	$(".fullscreen-transparent-loader").addClass("shown");
}

function hideFullscreenLoading() {
	$(".fullscreen-transparent-loader").removeClass("shown");
}

function setLoading(element) {
	var loadingSvg = '<div class="svg-loader-container"><svg version="1.1" class="svg-loader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 50 50" xml:space="preserve"><path fill="#fbe700" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z"><animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.8s" repeatCount="indefinite"/></path></svg></div>';
	$(element).prepend(loadingSvg);
	$(element).addClass("shown");
}

function removeLoading(element) {
    if (element === undefined) {
        element = false;
    }
	if (element) {
		if ($(element).hasClass("default-loading-container")) {
			$(element).removeClass("shown");
		}
		$(element).find(".svg-loader-container").remove();
	} else {
		$(".svg-loader-container").remove();
	}
}