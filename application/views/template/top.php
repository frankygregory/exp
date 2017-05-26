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
	<link href="<?=base_url()?>assets/template/css/top.css" rel="stylesheet" media="(orientation: landscape)">
	<link href="<?=base_url()?>assets/template/css/top - portrait.css" rel="stylesheet" media="(orientation: portrait)">
	<link href="<?=base_url()?>assets/panel/css/<?= $pageName ?>.css" rel="stylesheet">
	
	<script src="<?=base_url('assets/panel/js/jquery.js')?>"></script>
	<script src="<?=base_url('assets/panel/js/velocity.min.js')?>"></script>
	<?= $modules ?>
</head>
<body>
<div class="container">
    <div class="navigation-header">
		<svg class="menu-hamburger" fill="#FFF" width="30" height="30" viewBox="0 0 20 20" >
			<path d="M0 0h24v24H0z" fill="none"/>
			<path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
		</svg>
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
			<a href="<?= base_url("lokasi") ?>">
				<div>Lokasi</div>
			</a>
	<?php	if ($this->session->userdata("user_level") != 3) { ?>
				<a href="<?= base_url("user") ?>">
					<div class="">User</div>
				</a>
	<?php	}	?>
<?php	}	?>
	<?php
		if ($this->session->userdata("role_id") == 2) { ?>
			<a href="<?= base_url("kirim") ?>">
				<div>Cari Kiriman</div>
			</a>
			<a href="<?= base_url("kiriman-darat-ekspedisi") ?>">
				<div>Kiriman Darat</div>
			</a>
			<a href="<?= base_url("kiriman-laut-ekspedisi") ?>">
				<div>Kiriman Laut</div>
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
	<?php	if ($this->session->userdata("user_level") != 3) { ?>
				<a href="<?= base_url("user") ?>">
					<div class="">User</div>
				</a>
	<?php	}	?>
			<a href="<?= base_url("ulasan") ?>">
				<div class="">Ulasan</div>
			</a>
<?php	}	?>
			<a href="<?= base_url("statistik") ?>">
				<div class="">Statistik</div>
			</a>
		</div>
		<div class="container-content">
<script>
String.prototype.padLeft = function(l,c) {return Array(l-this.length+1).join(c||" ")+this}
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
	
	$(document).on("click", ".dialog .btn-batal", function() {
		closeDialog();
	});
	
	$(".menu-hamburger").on("click", function() {
		toggleNavigationDrawer();
	});
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

</script>
