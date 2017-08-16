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
        ajaxCall(doLoginUrl, data, function(json) {
            var result = jQuery.parseJSON(json);
            if (result.status == "error") {
                $(".loading-div").removeClass("shown");
                $(".error-password").html(result.reason);
            } else if (result.status == "success") {
                window.location = dashboardUrl;
            }
        });
    }
}