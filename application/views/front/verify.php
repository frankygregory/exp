<?php
	echo "<div class='text'>";
	if ($result->status == "success") {
		echo $result->user_fullname . ", account anda telah diaktifkan<br><a href='" . base_url("#login") . "'>Silakan Login</a>";
	} else {
		echo "Link ini sudah tidak berlaku<br><a href='" . base_url() . "'>Kembali ke halaman utama</a>";
	}
	echo "</div>";
?>