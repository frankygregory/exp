<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>yukirim - <?=$title?></title>
	<style>
		@font-face {
			font-family: roboto-regular;
			src: url(<?= base_url("assets/fonts/Roboto-Regular.ttf") ?>);
		}
	</style>
	<link href="<?=base_url()?>assets/front/css/default.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/front/css/header.css" rel="stylesheet" media="(orientation: landscape)">
	<!--<link href="<?=base_url()?>assets/front/css/header - portrait.css" rel="stylesheet" media="(orientation: portrait)">-->
	<link href="<?=base_url()?>assets/front/css/<?= $page_name ?>.css?v=1" rel="stylesheet">
	<?= $additional_file ?>

	<script src="<?=base_url('assets/panel/js/jquery.js')?>"></script>
	<script src="<?=base_url('assets/panel/js/velocity.min.js')?>"></script>
	<?= $modules ?>
</head>
<body>
<div class="header">
	<a href="<?= base_url() ?>" class="logo" style="background-image: url('<?= base_url("assets/icons/logo2.png") ?>');"></a>
	<div class="header-right">
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
		<a class="header-menu header-menu-login">Login
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
<?php
	if ($isLoggedIn == 1) {	?>
		<div class="profile-dropdown">
			<a href="<?= base_url("account-settings") ?>" class="profile-menu">Account Settings</a>
			<a href="<?= base_url("logout") ?>" class="profile-menu">Logout</a>
		</div>
<?php
	}	?>
	<div class="login-dialog">
		<input type="text" class="input-login-user_email" placeholder="email" />
		<div class="login-error login-error-username error"></div>
		<input type="password" class="input-login-password" placeholder="password" />
		<div class="login-error login-error-password error"></div>
		<a class="forgot-password-link" href="<?php echo base_url("forgot-password"); ?>">Lupa Password</a>
		<div class="remember-me">
			<label>
				<input type="checkbox" class="input-remember-me" value="remember-me" /> Ingat saya
			</label>
		</div>
		<button type="button" class="btn-login">Login</button>
		<div class="loading-div">
			<div class="loading-circle"></div>
		</div>
	</div>
</div>
<div class="header-overlay"></div>
<script>
var ajaxVariable;
$(function() {
	
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
	} else {	?>
		$("body:not(.login-dialog)").on("click", function(e) {
			if ($(e.target).closest(".login-dialog").length == 0) {
				if ($(".login-dialog").css("display") == "block") {
					hideLoginDialog();
				}
			}
		});

		$(".header-menu-login").on("click", function(e) {
			e.stopPropagation();
			toggleLoginDialog();
		});

		$(".input-login-user_email, .input-login-password").on("keypress", function(e) {
			if (e.which == 13) {
				doLogin();
			}
		});

		$(".btn-login").on("click", function() {
			doLogin();
		});

		function doLogin() {
			$(".login-dialog .login-error").html("");
			var user_email = $(".input-login-user_email").val().trim();
			var password = $(".input-login-password").val().trim();
			
			var valid = true;
			if (user_email == "") {
				valid = false;
				$(".login-error.login-error-username").html("Username harus diisi");
			}
			if (password == "") {
				valid = false;
				$(".login-error.login-error-password").html("Password harus diisi");
			}

			if (valid) {
				showLoading();
				var data = {
					user_email: user_email,
					password: password
				};
				ajaxCall("<?= base_url('login/doLogin') ?>", data, function(json) {
					var result = jQuery.parseJSON(json);
					if (result.status == "error") {
						hideLoading();
						$(".login-error.login-error-password").html(result.reason);
					} else if (result.status == "success") {
						window.location = "<?= base_url('dashboard') ?>";
					}
				});
			}
		}
<?php
	}	?>
});

function showLoading() {
	$(".loading-div").addClass("shown");
}

function hideLoading() {
	$(".loading-div").removeClass("shown");
}

function toggleLoginDialog() {
	if ($(".login-dialog").css("display") == "none") {
		$(".login-dialog").css("display", "block");
		$(".input-login-user_email").select();
	} else {
		hideLoginDialog();
	}
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
			//alert(jqXHR + " : " + jqXHR.responseText + "\n" + exception);
			if (exception != "abort") {
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

function removeLoading(element = null) {
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

/*function isNumber(e) {
	if ((e.which >= 65 && e.which <= 90) || e.which >= 186) {
		e.preventDefault();
	}
}*/

function isNumber(e) {
	if (e.key.length == 1) {
		if ("0123456789".indexOf(e.key) < 0) {
			e.preventDefault();
		}
	}
}
</script>
<div class="container">