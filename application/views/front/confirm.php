<html>
<head>
    <title>yukirim - <?=$title?></title>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/front/assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/front/css/custom.css"/>
</head>
<body id="form-register">
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?=$this->session->flashdata('msg')?>
            <div class="panel panel-login">
                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="confirm-form" action="<?=base_url()?>doconfirm" method="post" role="form" style="display: block;">
                                <div class="form-group">
                                    <?=form_error('username')?>
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?=set_value('username')?>"><span id="spanusername"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('name')?>
                                    <input type="text" name="name" id="name" tabindex="3" class="form-control" placeholder="Nama lengkap" value="<?=set_value('name')?>"><span id="spanname"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('password')?>
                                    <input type="password" name="password" id="password" tabindex="7" class="form-control" placeholder="Password" value="<?=set_value('password')?>"><span id="spanpass"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('passconf')?>
                                    <input type="password" name="passconf" id="password-confirm" tabindex="8" class="form-control" placeholder="Konfirmasi Password"><span id="spanpassc"></span>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="registration-submit" id="registration-submit" tabindex="10" class="form-control btn btn-login" value="Daftar">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="<?=base_url().'login/'?>" tabindex="11" class="forgot-password">Login</a>
                                                <a href="<?=site_url()?>" tabindex="11" class="forgot-password">Home</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=base_url()?>assets/front/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/front/assets/js/bootstrap.min.js"></script>
<script>

    $(function() {
        $('#consumen-form-link').click(function(e) {
            $("#consumen-form").delay(100).fadeIn(100);
            $("#expedisi-form").fadeOut(100);
            $('#expedisi-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });
        $('#expedisi-form-link').click(function(e) {
            $("#expedisi-form").delay(100).fadeIn(100);
            $("#consumen-form").fadeOut(100);
            $('#consumen-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });

    });

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function setError(id, spanid){
        document.getElementById(spanid).innerHTML = 'required';
        document.getElementById(spanid).style.color = 'red';
        document.getElementById(id).style.border = '1px solid red';
    }

    function resetError(id, spanid){
        document.getElementById(spanid).innerHTML = '';
        document.getElementById(spanid).style.color = '';
        document.getElementById(id).style.border = '';
    }

</script>

</body>
</html>