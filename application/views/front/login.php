	<div class="loginmodal-container">
		<h1>Login Yukirim</h1><br>
		<div class="error_prefix"><?=$error;?></div>
		<form method="post" action="<?=base_url()?>dologin">
			<?=form_error('username')?>
			<input type="text" name="username" placeholder="Username">
			<?=form_error('password')?>
			<input type="password" name="password" placeholder="Password">
			<input type="submit" name="login" class="login loginmodal-submit" value="Login">
		</form>
		<div class="login-help">
			<a href="<?=base_url().'register/';?>">Register</a> - <a href="#">Forgot Password</a>
		</div>
	</div>
<script>
$(function() {
	$(".header").addClass("scroll");
});
</script>