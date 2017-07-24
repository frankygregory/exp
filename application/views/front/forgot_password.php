<div class="content">
	<div class="section-1">
		<?php if ($post == 0) { ?>
			<form method="POST" action="<?php echo base_url("forgot-password") ?>">
				<div class="label">Masukkan email anda :</div>
				<input type="text" class="input-user-email" name="user_email" placeholder="asd@example.com" maxlength="50" />
				<button class="btn btn-reset-password">Reset password</button>
			</form>
		<?php } else { 
				if ($result->status == "success") { ?>
					<div>Link untuk reset password telah dikirimkan ke email <?php echo $result->user_email; ?></div>
		<?php 	} else { ?>
					<div>Email <?php echo $result->user_email ?> belum terdaftar</div>
		<?php 	} ?>
		<?php } ?>
	</div>
</div>
<script>

</script>