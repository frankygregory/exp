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

</head>
<body>
<div class="container">
    <div class="navigation-header">
		<a href="<?= base_url() ?>" class="logo">Yukirim</a>
		<a href="<?= base_url("logout") ?>" class="logout">Logout</a>
		<div class="nav-account"><?= $this->session->userdata("user_fullname") ?></div>
	</div>
	<div class="navigation-header-space"></div>
	<div class="container-body">
		<div class="navigation-menu">
			<a href="<?= base_url("dashboard") ?>">
				<div>Dashboard</div>
			</a>
			<a href="<?= base_url("kirim") ?>">
				<div>Kiriman</div>
			</a>
	<?php
		if ($this->session->userdata("role_id") == 2) { ?>
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

function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Distance in km
  return d;
}

function deg2rad(deg) {
  return deg * (Math.PI/180);
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
	$("select")[0].selectedIndex = 0;
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
