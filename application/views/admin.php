<div id="page-wrapper">
<div class="container-fluid">
<div class="page-title"><?= $page_title ?></div>
<div class="content">
	<?php
	if ($this->session->flashdata("flash_message")) {
		echo "<div class='flash-message'>";
		echo $this->session->flashdata("flash_message");
		echo "</div>";
	}
	?>
	<form action="<?php echo base_url("admin/login_as"); ?>" method="POST">
		<div class="form-item form-item-login-as">
			<div class="form-item-label">Login sebagai : </div>
			<input type="text" name="username_or_email" class="" placeholder="username / email" />
			<button class="btn-default btn-login-as">Login</button>
		</div>
	</form>
</div>
</div>
</div>