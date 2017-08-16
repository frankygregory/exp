$(function() {
	var hash = window.location.hash;
	if (hash == "#pemilik-kendaraan") {
		$(".input-role[value='2']").prop("checked", true);
	}

	$("input.input-username").on("focusout", function() {
		validPoints = 0;
		var valid = cekUsername();
	});
	$("input.input-email").on("focusout", function() {
		validPoints = 0;
		var valid = cekEmail();
	});
	$("input.input-nama").on("focusout", function() {
		validPoints = 0;
		var valid = cekNama();
	});
	$(".input-alamat").on("focusout", function() {
		validPoints = 0;
		var valid = cekAlamat();
	});
	$("input.input-telp").on("focusout", function() {
		validPoints = 0;
		var valid = cekTelp();
	});
	$("input.input-handphone").on("focusout", function() {
		validPoints = 0;
		var valid = cekHandphone();
	});
	$("input.input-password").on("focusout", function() {
		validPoints = 0;
		var valid = cekPassword();
	});
	$("input.input-konfirmasi").on("focusout", function() {
		validPoints = 0;
		var valid = cekKonfirmasi();
	});
	$(".input-terms").on("change", function() {
		validPoints = 0;
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
		validPoints = 0;
		var valid = true;
		valid &= cekUsername(true);
		valid &= cekEmail(true);
		valid &= cekNama();
		valid &= cekAlamat();
		valid &= cekTelp();
		valid &= cekHandphone();
		valid &= cekPassword();
		valid &= cekKonfirmasi();
		valid &= cekTerms();
	});

	$("form.register-role").on("submit", function(e) {
		if (validPoints < 9) {
			return false;
		}
	});
});

function addValidPoints() {
	validPoints++;
	if (validPoints == 9) {
		$("form.register-role").submit();
	}
}

function cekUsername(cekKembar) {
    if (cekKembar === undefined) {
        cekKembar = false;
    }

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
			if (cekKembar) {
				$.ajax({
					url: cekUsernameUrl,
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
						} else {
							addValidPoints();
						}
					}
				});
			}
		}
	}
	return valid;
}

function cekEmail(cekKembar) {
    if (cekKembar === undefined) {
        cekKembar = false;
    }

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
			if (cekKembar) {
				$.ajax({
					url: cekEmailUrl,
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
						} else {
							addValidPoints();
						}
					}
				});
			}
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
	if (valid) {
		addValidPoints();
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
	if (valid) {
		addValidPoints();
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
	if (valid) {
		addValidPoints();
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
	if (valid) {
		addValidPoints();
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
	if (valid) {
		addValidPoints();
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
	if (valid) {
		addValidPoints();
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
	if (valid) {
		addValidPoints();
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