<div class="content">
    <div class="page-title">Login</div>
	<div class="section">
        <div class="form-item">
            <div class="label">Email</div>
            <input type="text" class="section-login-user-email" maxlength="50" autofocus/>
            <div class="error error-username"></div>
        </div>
        <div class="form-item">
            <div class="label">Password</div>
            <input type="password" class="section-login-password" maxlength="30" />
            <div class="error error-password"></div>
        </div>
        <a class="forgot-password" href="<?php echo base_url("forgot-password"); ?>">Lupa Password</a>
        <button class="btn-default btn-login">LOGIN</button>
        <div class="loading-div">
            <div class="loading-circle"></div>
        </div>
    </div>
</div>
<script>
var doLoginUrl = "<?php echo base_url('login/doLogin'); ?>";
var dashboardUrl = "<?php echo base_url('dashboard'); ?>";
</script>
<script src="<?php echo base_url("assets/front/js/login.js"); ?>" defer></script>