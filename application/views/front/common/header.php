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

	<script src="<?=base_url('assets/panel/js/jquery.js')?>"></script>
	<script src="<?=base_url('assets/panel/js/velocity.min.js')?>"></script>
</head>
<body>
<div class="header">
	<div class="logo">Yukirim</div>
	<div class="header-right">
		<a href="<?= base_url("login") ?>" class="header-menu">Login
			<div class="bottom-line"></div>
		</a>
		<a href="#" class="header-menu">What we do
			<div class="bottom-line"></div>
		</a>
		<a href="#" class="header-menu">Contact Us
			<div class="bottom-line"></div>
		</a>
	</div>
</div>
<script>
var hasChangedColor = false;
$(function() {
	checkHeaderColor();
	
	$(document).on("scroll", function() {
		checkHeaderColor();
	});
});

function checkHeaderColor() {
	var scrollTop = $(document).scrollTop();
	if (scrollTop > 0) {
		if (!hasChangedColor) {
			hasChangedColor = true;
			$(".header").addClass("scroll");
		}
	} else {
		hasChangedColor = false;
		$(".header").removeClass("scroll");
	}
}
</script>
<div class="container">