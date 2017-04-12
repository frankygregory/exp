<html>
<head>
    <title>yukirim - <?=$title?></title>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/front/css/default.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/front/css/register.css"/>
</head>
<body id="form-register">
<div class="container">
	<div class="register-box">
		<div class="register-title">REGISTER</div>
		<form class="register-role" action="<?= base_url("home/doRegisterConsumer") ?>" name="form-register" method="post">
			<div class="form-group">
				<div class="label">Sebagai</div>
				<div class="input-container" data-type="role">
					<label class="label-role">
						<input type="radio" name="role" value="1" class="input-role" checked="checked" />Konsumen
					</label>
					<label class="label-role">
						<input type="radio" name="role" value="2" class="input-role">Ekspedisi
					</label>
				</div>
			</div>
			<div class="form-group">
				<div class="label">Tipe</div>
				<div class="input-container" data-type="type">
					<label class="label-type">
						<input type="radio" name="type" value="1" class="input-type" checked="checked" />Individu
					</label>
					<label class="label-role">
						<input type="radio" name="type" value="2" class="input-type">Perusahaan
					</label>
				</div>
			</div>
			<div class="form-group">
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
				Saya setuju dengan <a target="_blank" href="<?= base_url("kebijakan-privasi"); ?>">Syarat dan Ketentuan</a><input type="checkbox" name="terms" value="1" class="input-terms">
				<div class="field-error">Anda harus setuju Syarat dan Ketentuan</div>
			</label>
			<button class="btn btn-daftar" type="submit">Daftar</button>
		</form>
	</div>
</div>
<script type="text/javascript" src="<?=base_url()?>assets/front/js/jquery-2.1.4.min.js"></script>
<script>
    $(function() {
		
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
		$("input").on("input", function() {
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

    /*function submitRegister(){
        var role_id = $('input[name=role_id]').val();
        var usertype = $('input[name=usertype]:checked').val();
        var username = $('input[name=username]').val();
        var email = $('input[name=email]').val();
        var address = $('input[name=useraddress]').val();
        var tlp = $('input[name=tlp]').val();
        var hp = $('input[name=hp]').val();
        var password = $('input[name=password]').val();
        var password_confirm = $('input[name=password-confirm]').val();
        var term_conditions = $('input[name=term-conditions]:checked').val();

        try{

            if($('input[name=usertype]:checked').length > 0){
                resetError('radio','spanUsertype');
            }else{
                setError('radio','spanUsertype');
            }

            if(username !=""){
                resetError('username','spanusername');
            }else{
                setError('username','spanusername');
            }

            if(validateEmail(email) == true){
                resetError('email','spanemail');
            }else{
                setError('email','spanemail')
            }

            if(name !=""){
                resetError('name','spanname');
            }else{
                setError('name','spanname');
            }

            if(address !=""){
                resetError('useraddress','spanaddress');
            }else{
                setError('useraddress','spanaddress');
            }

            if(tlp !=""){
                resetError('tlp','spantlp');
            }else{
                setError('tlp','spantlp');
            }

            if(hp !=""){
                resetError('hp','spanhp');
            }else{
                setError('hp','spanhp');
            }

            if(password !=""){
                resetError('password','spanpass');
            }else{
                setError('password','spanpass');
            }

            if(password_confirm !=""){
                resetError('password-confirm','spanpassc');
            }else{
                setError('password-confirm','spanpassc');
            }

            if($('input[name=term-conditions]:checked').length > 0){
                resetError('term','spanterm-conditions');
            }else{
                setError('term','spanterm-conditions');
            }

            if(password != password_confirm){
                document.getElementById("spanpassc").innerHTML = "Password not match";
            }

            if(($('input[name=usertype]:checked').length > 0) && username !=""
                && validateEmail(email) !=false && name !="" &&
                address !="" && tlp !="" && hp !="" && password !="" &&
                password_confirm !="" &&
                ($('input[name=term-conditions]:checked').length > 0)){

            }


        }catch (e){
            throw e;
            alert(e);
            return;
        }
    }*/

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    /*function setError(id, spanid){
        document.getElementById(spanid).innerHTML = 'required';
        document.getElementById(spanid).style.color = 'red';
        document.getElementById(id).style.border = '1px solid red';
    }*/
	
	function displayError(element, message) {
		element.html(message);
		element.addClass("active");
	}

    /*function resetError(id, spanid){
        document.getElementById(spanid).innerHTML = '';
        document.getElementById(spanid).style.color = '';
        document.getElementById(id).style.border = '';
    }*/
	
	function isNumber(e)
	{
		if ((e.which >= 65 && e.which <= 90) || e.which >= 186) {
			e.preventDefault();
		}
	}
</script>

</body>
</html>