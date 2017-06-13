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
				Saya setuju dengan <a target="_blank" href="<?= base_url("kebijakan-privasi"); ?>">Syarat dan Ketentuan</a>
				<input type="checkbox" name="terms" value="1" class="input-terms">
				<div class="field-error">Anda harus setuju Syarat dan Ketentuan</div>
			</label>
			<button class="btn btn-daftar" type="submit">Daftar</button>
		</form>
		<div class="login">
			<span>Sudah daftar? <a href="<?= base_url() ?>#login">Go To Login</a></span>
		</div>
	</div>
</div>
<script>
$(function() {
	var hash = window.location.hash;
	if (hash == "#pemilik-kendaraan") {
		$(".input-role[value='2']").prop("checked", true);
	}

	$("input.input-username").on("focusout", function() {
		var valid = cekUsername();
	});
	$("input.input-email").on("focusout", function() {
		var valid = cekEmail();
	});
	$("input.input-nama").on("focusout", function() {
		var valid = cekNama();
	});
	$(".input-alamat").on("focusout", function() {
		var valid = cekAlamat();
	});
	$("input.input-telp").on("focusout", function() {
		var valid = cekTelp();
	});
	$("input.input-handphone").on("focusout", function() {
		var valid = cekHandphone();
	});
	$("input.input-password").on("focusout", function() {
		var valid = cekPassword();
	});
	$("input.input-konfirmasi").on("focusout", function() {
		var valid = cekKonfirmasi();
	});
	$(".input-terms").on("change", function() {
		var valid = cekTerms();
		if (valid) {
			$(this).next().removeClass("active");
		}
	});
	$("input").on("input", function() {
		$(this).next().removeClass("active");
	});
	$("textarea").on("input", function() {
		$(this).next().removeClass("active");
	});
	$("input[data-type='number']").on("keydown", function(e) {
		isNumber(e);
	});
	
	
	$(".btn-daftar").on("click", function(e) {
		var valid = true;
		valid &= cekUsername();
		valid &= cekEmail();
		valid &= cekNama();
		valid &= cekAlamat();
		valid &= cekTelp();
		valid &= cekHandphone();
		valid &= cekPassword();
		valid &= cekKonfirmasi();
		valid &= cekTerms();
		
		if (!valid) {
			e.preventDefault();
		}
	});
});

function cekUsername() {
	var valid = true;
	var username = $(".input-username").val();
	if (username == "") {
		valid = false;
		displayError($(".input-username").next(), "Username harus diisi");
	} else {
		if (!isAlphaOrNumeric(username)) {
			valid = false;
			displayError($(".input-username").next(), "Username hanya boleh huruf atau angka");
		} else {
			$.ajax({
				url: '<?= base_url("home/cekUsernameKembar") ?>',
				data: {username: username},
				type: 'POST',
				error: function() {
					valid = false;
					displayError($(".input-username").next(), "Unknown Error saat pengecekan kembar");
				},
				success: function(data) {
					if (data == "true") { //berarti username kembar
						valid = false;
						displayError($(".input-username").next(), "Username sudah ada");
					}
				}
			});
		}
	}
	return valid;
}

function cekEmail() {
	var valid = true;
	var email = $(".input-email").val();
	if (email == "") {
		valid = false;
		displayError($(".input-email").next(), "Email harus diisi");
	} else {
		var validEmail = validateEmail(email);
		if (!validEmail) {
			valid = false;
			displayError($(".input-email").next(), "Email tidak valid");
		} else {
			$.ajax({
				url: '<?= base_url("home/cekEmailKembar") ?>',
				data: {email: email},
				type: 'POST',
				error: function() {
					valid = false;
					displayError($(".input-username").next(), "Unknown Error saat pengecekan kembar");
				},
				success: function(data) {
					if (data == "true") { //berarti email kembar
						valid = false;
						displayError($(".input-email").next(), "Email sudah ada");
					}
				}
			});
		}
	}
	return valid;
}

function cekNama() {
	var valid = true;
	var nama = $(".input-nama").val();
	if (nama == "") {
		valid = false;
		displayError($(".input-nama").next(), "Nama Lengkap harus diisi");
	}
	return valid;
}

function cekAlamat() {
	var valid = true;
	var alamat = $(".input-alamat").val();
	if (alamat == "") {
		valid = false;
		displayError($(".input-alamat").next(), "Alamat harus diisi");
	}
	return valid;
}

function cekTelp() {
	var valid = true;
	var telp = $(".input-telp").val();
	if (telp == "") {
		valid = false;
		displayError($(".input-telp").next(), "No. Telp harus diisi");
	} else {
		if (telp.length < 6) {
			valid = false;
			displayError($(".input-telp").next(), "No. Telp minimal 6 angka");
		}
	}
	return valid;
}

function cekHandphone() {
	var valid = true;
	var hp = $(".input-handphone").val();
	if (hp == "") {
		valid = false;
		displayError($(".input-handphone").next(), "No. Handphone harus diisi");
	} else {
		if (hp.length < 10) {
			valid = false;
			displayError($(".input-handphone").next(), "No. Handphone minimal 10 angka");
		}
	}
	return valid;
}

function cekPassword() {
	var valid = true;
	var password = $(".input-password").val();
	if (password == "") {
		valid = false;
		displayError($(".input-password").next(), "Password harus diisi");
	} else {
		if (!isAlphaOrNumeric(password)) {
			valid = false;
			displayError($(".input-password").next(), "Password harus huruf atau angka");
		}
	}
	return valid;
}

function cekKonfirmasi() {
	var valid = true;
	var konfirmasi = $(".input-konfirmasi").val();
	if (konfirmasi == "") {
		valid = false;
		displayError($(".input-konfirmasi").next(), "Konfirmasi Password harus diisi");
	} else {
		if (konfirmasi != $(".input-password").val()) {
			valid = false;
			displayError($(".input-konfirmasi").next(), "Konfirmasi Password harus sama dengan Password");
		}
	}
	return valid;
}

function cekTerms() {
	var valid = true;
	var checked = $(".input-terms").is(":checked");
	if (!checked) {
		valid = false;
		displayError($(".input-terms").next(), "Anda harus setuju dengan Syarat dan Ketentuan");
	}
	return valid;
}

function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function displayError(element, message) {
	element.html(message);
	element.addClass("active");
}

function isAlphaOrNumeric(text) {
	if (text.match(/^[a-z0-9]+$/i)) {
		return true;
	}
	return false;
}

function isNumber(e) {
	if ((e.which >= 65 && e.which <= 90) || e.which >= 186) {
		e.preventDefault();
	}
}
</script>
</body>