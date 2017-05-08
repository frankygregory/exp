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
	<link href="<?=base_url()?>assets/panel/css/default.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/template/css/top.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/panel/css/<?= $pageName ?>.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/panel/jqueryui/jquery-ui.datetimepicker.min.css" rel="stylesheet" >
	<script src="<?=base_url('assets/panel/js/jquery.js')?>"></script>
	<script src="<?= base_url('assets/panel/jqueryui/jquery-ui.datetimepicker.min.js')?>"></script>
	<?= $modules ?>
</head>
<body>
<div class="container">
    <div class="navigation-header">
		<a href="<?= base_url() ?>" class="logo">Yukirim</a>
		<div class="nav-account">
			<div class="fullname"><?= $this->session->userdata("user_fullname") ?></div>
			<span class="dropdown-icon">
				<svg style="width:24px;height:24px" viewBox="0 0 24 24">
					<path fill="#FFFFFF" d="M7,10L12,15L17,10H7Z" />
				</svg>
			</span>
			<div class="profile-dropdown">
				<a href="<?= base_url("account-settings") ?>" class="profile-menu">Account Settings</a>
				<a href="<?= base_url("logout") ?>" class="profile-menu">Logout</a>
			</div>
		</div>
	</div>
	<div class="navigation-header-space"></div>
	<div class="container-body">
		<div class="navigation-menu">
			<a href="<?= base_url("dashboard") ?>">
				<div>Dashboard</div>
			</a>
<?php	if ($this->session->userdata("role_id") == 1) { ?>
			<a href="<?= base_url("kirim/kirimbarang") ?>">
				<div>Kirim Barang</div>
			</a>
			<a href="<?= base_url("kiriman-saya") ?>">
				<div>Kiriman Saya</div>
			</a>
<?php	}	?>
	<?php
		if ($this->session->userdata("role_id") == 2) { ?>
			<a href="<?= base_url("kirim") ?>">
				<div>Cari Kiriman</div>
			</a>
			<a href="<?= base_url("kiriman-ekspedisi") ?>">
				<div>Kiriman</div>
			</a>
			<a href="<?= base_url("kendaraan") ?>">
				<div class="">Kendaraan</div>
			</a>
			<a href="<?= base_url("supir") ?>">
				<div class="">Supir</div>
			</a>
			<a href="<?= base_url("alat") ?>">
				<div class="">Alat</div>
			</a>
<?php	}	?>
			<a href="<?= base_url("user") ?>">
				<div class="">User</div>
			</a>
		</div>
		<div class="container-content">
<script>
var dialog = {
	shown: false
};

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
});

function toggleProfileDropdown(e) {
	if ($(".nav-account .profile-dropdown").css("display") == "none") {
		$(".nav-account .profile-dropdown").css("display", "block");
	} else {
		$(".nav-account .profile-dropdown").css("display", "none");
	}
	e.stopPropagation();
}

function isNumber(e) {
	if ((e.which >= 65 && e.which <= 90) || e.which >= 186) {
		e.preventDefault();
	}
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
	
	$(".dialog input, .dialog textarea").val("");
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

</script>
