<?php
	echo "<div class='text'>";
	if ($result->status == "success") {
		echo "Account anda telah diaktifkan<br><a href='" . base_url("#login") . "'>Silakan Login</a>";
	} else {
		echo "Link ini sudah tidak berlaku<br><a href='" . base_url() . "'>Kembali ke halaman utama</a>";
	}
	echo "</div>";
?>