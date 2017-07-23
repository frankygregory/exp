<?php
	echo "<div class='text'>";
	if ($result->status == "success") {
		if (isset($is_device)) {
			echo "Account untuk device " . $result->device_name . " telah diaktifkan<br><a href='" . base_url("alat") . "'>Kembali ke menu alat</a>";
		} else {
			echo $result->user_fullname . ", account anda telah diaktifkan<br><a href='" . base_url("#login") . "'>Silakan Login</a>";
		}
	} else {
		echo "Link ini sudah tidak berlaku<br><a href='" . base_url() . "'>Kembali ke halaman utama</a>";
	}
	echo "</div>";
?>