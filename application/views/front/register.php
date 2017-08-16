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
	<link href="<?=base_url()?>assets/front/css/<?= $page_name ?>.css" rel="stylesheet">
	<script src="<?=base_url('assets/panel/js/jquery.js')?>"></script>
	<script src="<?=base_url('assets/panel/js/velocity.min.js')?>"></script>
</head>
<body>
<div class="content">
	<div class="register-box">
		<div class="register-title">Daftar</div>
		<form class="register-role" action="<?= base_url("home/doRegisterConsumer") ?>" name="form-register" method="post">
			<div class="form-group">
				<div class="label">Sebagai</div>
				<div class="input-container" data-type="role">
					<label class="label-role">
						<input type="radio" name="role" value="1" class="input-role" <?= $konsumenChecked ?> />Pemilik Barang
					</label>
					<label class="label-role">
						<input type="radio" name="role" value="2" class="input-role" <?= $ekspedisiChecked ?>>Pemilik Kendaraan
					</label>
				</div>
			</div>
			<div class="form-group">
				<div class="label">Tipe</div>
				<div class="input-container" data-type="type">
					<label class="label-type">
						<input type="radio" name="type" value="1" class="input-type" <?= $individuChecked ?> />Individu
					</label>
					<label class="label-role">
						<input type="radio" name="type" value="2" class="input-type" <?= $perusahaanChecked ?>>Perusahaan
					</label>
				</div>
			</div>
			<div class="form-group form-group-username">
				<div class="label">Username</div>
				<div class="input-container" data-type="username">
					<input type="text" name="username" class="input-username" placeholder="My Username" autofocus="autofocus" maxlength="15" value="<?= $username ?>" />
					<div class="field-error">Username harus diisi</div>
				</div>
			</div>
			<div class="form-group">
				<div class="label">Email</div>
				<div class="input-container" data-type="email">
					<input type="text" name="email" class="input-email" placeholder="email@example.com" maxlength="30" value="<?= $email ?>" />
					<div class="field-error">Email harus diisi</div>
				</div>
			</div>
			<div class="form-group">
				<div class="label">Nama Lengkap</div>
				<div class="input-container" data-type="nama">
					<input type="text" name="nama" class="input-nama" placeholder="Nama lengkap / perusahaan" maxlength="30" value="<?= $nama ?>" />
					<div class="field-error">Nama Lengkap harus diisi</div>
				</div>
			</div>
			<div class="form-group" data-type="alamat">
				<div class="label">Alamat</div>
				<div class="input-container" data-type="alamat">
					<textarea type="text" name="alamat" class="input-alamat" placeholder="alamat lengkap" maxlength="200"><?= $alamat ?></textarea>
					<div class="field-error">Alamat harus diisi</div>
				</div>
			</div>
			<div class="form-group">
				<div class="label">No. Telp</div>
				<div class="input-container" data-type="telp">
					<input type="text" name="telp" data-type="number" class="input-telp" placeholder="031-1234567" maxlength="12" value="<?= $telp ?>" />
					<div class="field-error">No. Telpon harus diisi</div>
				</div>
			</div>
			<div class="form-group">
				<div class="label">No. Handphone</div>
				<div class="input-container" data-type="handphone">
					<input type="text" name="handphone" data-type="number" class="input-handphone" placeholder="0812345678" maxlength="14" value="<?= $handphone ?>" />
					<div class="field-error">No. Handphone harus diisi</div>
				</div>
			</div>
			<div class="form-group">
				<div class="label">Password</div>
				<div class="input-container" data-type="password">
					<input type="password" name="password" class="input-password" placeholder="Password" maxlength="40" />
					<div class="field-error">Password harus diisi</div>
				</div>
			</div>
			<div class="form-group">
				<div class="label">Konfirmasi Password</div>
				<div class="input-container" data-type="konfirmasi">
					<input type="password" name="konfirmasi" class="input-konfirmasi" placeholder="Konfirmasi Password" maxlength="40" />
					<div class="field-error">Konfirmasi password harus diisi</div>
				</div>
			</div>
			<label class="label-terms">
				Saya setuju dengan <a target="_blank" href="<?= base_url("syarat-dan-ketentuan"); ?>">Syarat dan Ketentuan</a>
				<input type="checkbox" name="terms" value="1" class="input-terms">
				<div class="field-error">Anda harus setuju Syarat dan Ketentuan</div>
			</label>
			<button class="btn btn-daftar" type="submit">Daftar</button>
		</form>
		<div class="login">
			<span>Sudah daftar? <a href="<?= base_url("login") ?>">Go To Login</a></span>
		</div>
	</div>
</div>
<script>
var cekUsernameUrl = "<?php echo base_url("home/cekUsernameKembar"); ?>";
var cekEmailUrl = "<?php echo base_url("home/cekEmailKembar"); ?>";
var validPoints = 0;
</script>
<script src="<?php echo base_url("assets/front/js/register.js"); ?>" defer></script>
</body>