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
$(function() {
    $(".btn-login").on("click", function() {
        doLoginMobile();
    });

    $(".section-login-user-email, .section-login-password").on("keypress", function(e) {
        if (e.which == 13) {
            doLoginMobile();
        }
    });
});

function doLoginMobile() {
    $(".error").html("");
    var user_email = $(".section-login-user-email").val().trim();
    var password = $(".section-login-password").val().trim();
    
    var valid = true;
    if (user_email == "") {
        valid = false;
        $(".error-username").html("Username harus diisi");
    }
    if (password == "") {
        valid = false;
        $(".error-password").html("Password harus diisi");
    }

    if (valid) {
        $(".loading-div").addClass("shown");
        var data = {
            user_email: user_email,
            password: password
        };
        ajaxCall("<?= base_url('login/doLogin') ?>", data, function(json) {
            var result = jQuery.parseJSON(json);
            if (result.status == "error") {
                $(".loading-div").removeClass("shown");
                $(".error-password").html(result.reason);
            } else if (result.status == "success") {
                window.location = "<?= base_url('dashboard') ?>";
            }
        });
    }
}
</script>