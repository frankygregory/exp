<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>yukirim - <?=$title?></title>
	<style>
		@font-face {
			font-family: roboto-regular;
			src: url(<?= base_url("assets/fonts/Roboto-Regular.ttf") ?>);
		}
	</style>
	<link href="<?=base_url()?>assets/front/css/default.css?v=1" rel="stylesheet">
	<link href="<?=base_url()?>assets/front/css/header.css?v=7" rel="stylesheet">
	<link href="<?=base_url()?>assets/front/css/<?= $page_name ?>.css?v=10" rel="stylesheet">
	<?= $additional_file ?>

	<script src="<?=base_url('assets/panel/js/jquery.js')?>"></script>
	<script src="<?=base_url('assets/panel/js/velocity.min.js')?>"></script>
	<?= $modules ?>
</head>
<body>
<div class="header">
	<a href="<?= base_url() ?>" class="logo" style="background-image: url('<?= base_url("assets/icons/logo2.png") ?>');"></a>
	<div class="header-right">
		<div class="header-menu-container">
<?php   if ($isLoggedIn == 1) {	?>
			<a href="<?= base_url('dashboard') ?>" class="header-menu header-menu-dashboard">My Dashboard
			</a>
<?php   }	?>
		<a href="<?= base_url("list-kiriman") ?>" class="header-menu <?= $activePage["list_kiriman"] ?>">List Kiriman
			<div class="bottom-line"></div>
		</a>
		<a href="#" class="header-menu">Kontak
			<div class="bottom-line"></div>
		</a>
<?php	if ($isLoggedIn != 1) {	?>
		<a href="<?= base_url("register") ?>" class="header-menu <?= $activePage["daftar"] ?>">Daftar
			<div class="bottom-line"></div>
		</a>
		<a class="header-menu header-menu-login" href="<?php echo base_url("login"); ?>">Login
			<div class="bottom-line"></div>
		</a>
<?php	} else {	?>
		<a class="header-menu header-menu-user"><?= $this->session->userdata("user_fullname") ?>
			<span class="dropdown-icon">
				<svg style="width:24px;height:24px" viewBox="0 -5 24 24">
					<path fill="#000" d="M7,10L12,15L17,10H7Z" />
				</svg>
			</span>
		</a>
<?php	}	?>
		</div>
	</div>
	<div class="mobile-header-right-icon" style="background-image: url('<?php echo base_url("assets/icons/header_menu_icon.svg"); ?>');"></div>
<?php
	if ($isLoggedIn == 1) {	?>
		<div class="profile-dropdown">
			<a href="<?= base_url("account-settings") ?>" class="profile-menu">Account Settings</a>
			<a href="<?= base_url("logout") ?>" class="profile-menu">Logout</a>
		</div>
<?php
	}	?>
</div>
<div class="header-overlay"></div>
<script>
var isMobile = false;
var ajaxVariable;
var verifiedIconUrl = "<?php echo base_url("assets/icons/ic_verified_user_black_24px.svg") ?>";
$(function(e) {
	var mobileHeaderRightIcon = $(".mobile-header-right-icon");
	if (mobileHeaderRightIcon.css("display") == "block") {
		isMobile = true;
	}

	mobileHeaderRightIcon[0].addEventListener("click", function() {
		var headerRight = $(".header-right");
		if (headerRight.hasClass("show")) {
			headerRight.removeClass("show");
			mobileHeaderRightIcon.css("background-image", "url('<?php echo base_url("assets/icons/header_menu_icon.svg"); ?>')");
		} else {
			headerRight.addClass("show");
			mobileHeaderRightIcon.css("background-image", "url('<?php echo base_url("assets/icons/header_menu_close_icon.svg"); ?>')");
		}
	});
<?php
	if ($isLoggedIn) {	?>
		$("body:not(.profile-dropdown)").on("click", function(e) {
			if ($(e.target).closest(".profile-dropdown").length == 0) {
				if ($(".profile-dropdown").css("display") == "block") {
					$(".profile-dropdown").css("display", "none");
				}
			}
		});

		$(".header-menu-user").on("click", function(e) {
			e.stopPropagation();
			if ($(".profile-dropdown").css("display") == "none") {
				$(".profile-dropdown").css("display", "block");
			} else {
				$(".profile-dropdown").css("display", "none");
			}
		});
<?php
	}	?>
});

function showLoading() {
	$(".loading-div").addClass("shown");
}

function hideLoading() {
	$(".loading-div").removeClass("shown");
}

function hideLoginDialog() {
	$(".login-dialog").css("display", "none");
	$(".login-dialog .login-error").html("");
}

function ajaxCall(url, data, callback) {
	ajaxVariable = $.ajax({
		url: url,
		data: data,
		type: 'POST',
		error: function(jqXHR, exception) {
			if (exception != "abort") {
				console.log(jqXHR + " : " + jqXHR.responseText + "\n" + exception);
				var error = {
					status: "error",
					reason: exception
				};
				error = JSON.stringify(error);
				callback(error);
			}
		},
		success: function(result) {
			callback(result);
		},
		timeout: 10000
	});		
}

function abortAjaxCall() {
	if (ajaxVariable) {
		ajaxVariable.abort();
	}
}

function setLoading(element) {
	var loadingSvg = '<div class="svg-loader-container"><svg version="1.1" class="svg-loader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve"><path fill="#E65100" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z"><animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.8s" repeatCount="indefinite"/></path></svg></div>';
	$(element).prepend(loadingSvg);
	$(element).addClass("shown");
}

function removeLoading(element) {
	if (element) {
		if ($(element).hasClass("default-loading-container")) {
			$(element).removeClass("shown");
		}
		$(element).find(".svg-loader-container").remove();
	} else {
		$(".svg-loader-container").remove();
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

function isNumber(e) {
	if (e.key.length == 1) {
		if ("0123456789".indexOf(e.key) < 0) {
			e.preventDefault();
		}
	}
}
</script>
<div class="container">