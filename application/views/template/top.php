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
	<link href="<?=base_url()?>assets/panel/css/default.css?v=13" rel="stylesheet">
	<link href="<?=base_url()?>assets/template/css/top.css?v=3" rel="stylesheet">
	<link href="<?=base_url()?>assets/panel/css/<?= $pageName ?>.css?v=36" rel="stylesheet">
	
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
		<a href="<?= base_url() ?>" class="logo" style="background-image:url('<?= base_url("assets/icons/logo.png") ?>');"></a>
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
<?php	if ($this->session->userdata("role_id") == 1) { ?>
			<a href="<?= base_url("dashboard") ?>" class="<?= $activeMenu["dashboard"] ?>">
				<div>Dashboard</div>
			</a>
			<a href="<?= base_url("kirim/kirimbarang") ?>" class="<?= $activeMenu["kirim_barang"] ?>">
				<div>Kirim Barang</div>
			</a>
			<a href="<?= base_url("kiriman-saya") ?>" class="<?= $activeMenu["kiriman_saya"] ?>">
				<div>Kiriman Terbuka</div>
			</a>
			<a href="<?= base_url("kiriman-saya-bisnis") ?>" class="<?= $activeMenu["kiriman_saya_bisnis"] ?>">
				<div>Kiriman Tertutup <span class="tag-premium"></span></div>
			</a>
			<a href="<?= base_url("lokasi") ?>" class="<?= $activeMenu["lokasi"] ?>">
				<div>Lokasi</div>
			</a>
	<?php	if ($this->session->userdata("user_level") != 3) { ?>
				<a href="<?= base_url("user") ?>" class="<?= $activeMenu["user"] ?>">
					<div class="">User <span class="tag-premium"></span></div>
				</a>
	<?php	}	?>
			<a href="<?= base_url("rekanan") ?>" class="<?= $activeMenu["rekanan"] ?>">
				<div>Rekanan <span class="tag-premium"></span></div>
			</a>
			<a href="<?= base_url("statistik") ?>" class="<?= $activeMenu["statistik"] ?>">
				<div class="">Statistik</div>
			</a>
<?php	} else if ($this->session->userdata("role_id") == 2) { ?>
			<a href="<?= base_url("dashboard") ?>" class="<?= $activeMenu["dashboard"] ?>">
				<div>Dashboard</div>
			</a>
			<a href="<?= base_url("cari-kiriman-bisnis") ?>" class="<?= $activeMenu["cari_kiriman_bisnis"] ?>">
				<div>Cari Kiriman <span class="tag-premium"></span></div>
			</a>
			<a href="<?= base_url("kirim") ?>" class="<?= $activeMenu["cari_kiriman"] ?>">
				<div>Cari Kiriman</div>
			</a>
			<a href="<?= base_url("penawaran-bisnis") ?>" class="<?= $activeMenu["penawaran_bisnis"] ?>">
				<div>Penawaran <span class="tag-premium"></span></div>
			</a>
			<a href="<?= base_url("penawaran") ?>" class="<?= $activeMenu["penawaran"] ?>">
				<div>Penawaran</div>
			</a>
			<a href="<?= base_url("kiriman-darat-ekspedisi") ?>" class="<?= $activeMenu["kiriman_darat"] ?>">
				<div>Kiriman Darat</div>
			</a>
			<a href="<?= base_url("kiriman-laut-ekspedisi") ?>" class="<?= $activeMenu["kiriman_laut"] ?>">
				<div>Kiriman Laut</div>
			</a>
			<a href="<?= base_url("kendaraan") ?>" class="<?= $activeMenu["kendaraan"] ?>">
				<div class="">Kendaraan</div>
			</a>
			<a href="<?= base_url("supir") ?>" class="<?= $activeMenu["supir"] ?>">
				<div class="">Supir</div>
			</a>
			<a href="<?= base_url("alat") ?>" class="<?= $activeMenu["alat"] ?>">
				<div class="">Alat</div>
			</a>
	<?php	if ($this->session->userdata("user_level") != 3) { ?>
				<a href="<?= base_url("user") ?>" class="<?= $activeMenu["user"] ?>">
					<div class="">User & Group <span class="tag-premium"></span></div>
				</a>
	<?php	}	?>
			<a href="<?= base_url("rekanan") ?>" class="<?= $activeMenu["rekanan"] ?>">
				<div>Rekanan <span class="tag-premium"></span></div>
			</a>
			<a href="<?= base_url("ulasan") ?>" class="<?= $activeMenu["ulasan"] ?>">
				<div class="">Ulasan</div>
			</a>
			<a href="<?= base_url("statistik") ?>" class="<?= $activeMenu["statistik"] ?>">
				<div class="">Statistik</div>
			</a>
<?php	} else if ($this->session->userdata("role_id") == 3) { ?>
			<a href="<?= base_url("admin") ?>" class="<?= $activeMenu["admin"] ?>">
				<div>Admin</div>
			</a>
			<a href="<?= base_url("admin/verifikasi-user") ?>" class="<?= $activeMenu["verifikasi"] ?>">
				<div>Verifikasi User</div>
			</a>
<?php   } ?>
		</div>
		<div class="container-content">
			<div class="fullscreen-transparent-loader">
				<div class="loader-container-absolute">
					<div class="loader-container-relative"><div class="svg-loader-container-2"><svg version="1.1" class="svg-loader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 50 50" xml:space="preserve"><path fill="#fbe700" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z"><animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.8s" repeatCount="indefinite"/></path></svg></div></div>
				</div>
			</div>
			<div class="verified-icon-explanation"></div>
<script>
String.prototype.padLeft = function(l,c) {return Array(l-this.length+1).join(c||" ")+this}
var dialog = {
	shown: false
};
var ajaxVariable;
var verifiedIconUrl = "<?php echo base_url("assets/icons/ic_verified_user_black_24px.svg"); ?>";
var editIconUrl = "<?php echo base_url("assets/icons/ic_edit_black_24px.svg"); ?>";
var deleteIconUrl = "<?php echo base_url("assets/icons/ic_delete_forever_black_24px.svg"); ?>";
</script>
<script src="<?php echo base_url("assets/template/js/top.js"); ?>"></script>