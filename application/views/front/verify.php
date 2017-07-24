<?php
	echo "<div class='text'>";
	if ($result->status == "success") {
		if ($verifikasi_type == 2) {
			echo "Account untuk device " . $result->device_name . " telah diaktifkan<br><a href='" . base_url("alat") . "'>Kembali ke menu alat</a>";
		} else if ($verifikasi_type == 1) {
			echo $result->user_fullname . ", account anda telah diaktifkan<br><a href='" . base_url("#login") . "'>Silakan Login</a>";
		} else if ($verifikasi_type == 3) {
			echo "Password untuk email " . $result->user_email . " telah direset.<br><a href='" . base_url("#login") . "'>Silakan Login</a>";
		}
	} else {
		echo "Link ini sudah tidak berlaku<br><a href='" . base_url() . "'>Kembali ke halaman utama</a>";
	}
	echo "</div>";
?>