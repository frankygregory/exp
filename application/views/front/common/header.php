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
	<link href="<?=base_url()?>assets/front/css/header - portrait.css" rel="stylesheet" media="(orientation: portrait)">
	<link href="<?=base_url()?>assets/front/css/<?= $page_name ?>.css" rel="stylesheet">
	<?= $additional_file ?>

	<script src="<?=base_url('assets/panel/js/jquery.js')?>"></script>
	<script src="<?=base_url('assets/panel/js/velocity.min.js')?>"></script>
</head>
<body>
<div class="header">
	<a href="<?= base_url() ?>" class="logo">Yukirim</a>
	<div class="header-right">
<?php   if ($isLoggedIn == 1) {	?>
			<a href="<?= base_url('dashboard') ?>" class="header-menu header-menu-dashboard">My Dashboard
			</a>
<?php   }	?>
		<a href="<?= base_url("list-kiriman") ?>" class="header-menu">List Kiriman
			<div class="bottom-line"></div>
		</a>
		<a href="#" class="header-menu">Contact Us
			<div class="bottom-line"></div>
		</a>
<?php	if ($isLoggedIn != 1) {	?>
		<a href="<?= base_url("register") ?>" class="header-menu">Daftar
			<div class="bottom-line"></div>
		</a>
		<a class="header-menu header-menu-login">Login
			<div class="bottom-line"></div>
		</a>
<?php	} else {	?>
		<a class="header-menu header-menu-user"><?= $this->session->userdata("user_fullname") ?>
			<span class="dropdown-icon">
				<svg style="width:24px;height:24px" viewBox="0 -5 24 24">
					<path fill="#FFFFFF" d="M7,10L12,15L17,10H7Z" />
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
		<input type="text" class="input-username" placeholder="username" />
		<input type="password" class="input-password" placeholder="password" />
		<div class="remember-me">
			<label>
				<input type="checkbox" class="input-remember-me" value="remember-me" /> Ingat saya
			</label>
		</div>
		<button type="button" class="btn-default btn-login">Login</button>
	</div>
</div>
<div class="header-overlay"></div>
<script>
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
					$(".login-dialog").css("display", "none");
				}
			}
		});

		$(".header-menu-login").on("click", function(e) {
			e.stopPropagation();
			toggleLoginDialog();
		});

		$(".input-username, .input-password").on("keypress", function(e) {
			if (e.which == 13) {
				doLogin();
			}
		});

		$(".btn-login").on("click", function() {
			doLogin();
		});

		function doLogin() {
			var username = $(".input-username").val().trim();
			var password = $(".input-password").val().trim();
			
			var valid = true;
			if (username == "") {
				valid = false;
			}
			if (password == "") {
				valid = false;
			}

			if (valid) {
				var data = {
					username: username,
					password: password
				};
				ajaxCall("<?= base_url('login/doLogin') ?>", data, function(result) {
					if (result == "error") {

					} else if (result == "success") {
						window.location = "<?= base_url('dashboard') ?>";
					}
				});
			}
		}
<?php
	}	?>
});
function toggleLoginDialog() {
	if ($(".login-dialog").css("display") == "none") {
		$(".login-dialog").css("display", "block");
		$(".input-username").select();
	} else {
		$(".login-dialog").css("display", "none");
	}
}

function ajaxCall(url, data, callback) {
	$.ajax({
		url: url,
		data: data,
		type: 'POST',
		error: function(jqXHR, exception) {
			alert(jqXHR + " : " + jqXHR.responseText);
		},
		success: function(result) {
			callback(result);
		}
	});
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
</script>
<div class="container">