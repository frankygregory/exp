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
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="consumen-form-link">Konsumen</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#" id="expedisi-form-link">Expedisi</a>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="consumen-form" action="<?=base_url()?>home/doRegisterConsumer" method="post" role="form" style="display: block;">
                                <input type="hidden" name="role_id" value="1">
                                <div class="form-group" style="text-align: center">
                                    <?=form_error('type_id')?>
                                    <div id="radio">
                                        <div class="radio-inline"><input type="radio" name="type_id" value="1"/>Individu</div>
                                        <div class="radio-inline"><input type="radio" name="type_id" value="2"/> Perusahaan</div>
                                    </div>
                                    <span id="spanType_id"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('username')?>
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?=set_value('username')?>"><span id="spanusername"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('email')?>
                                    <input type="text" name="email" id="email" tabindex="2" class="form-control" placeholder="email@example.com" value="<?=set_value('email')?>"><span id="spanemail"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('name')?>
                                    <input type="text" name="name" id="name" tabindex="3" class="form-control" placeholder="Nama lengkap/perusahaan" value="<?=set_value('name')?>"><span id="spanname"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('useraddress')?>
                                    <textarea cols="71" rows="3" name="useraddress" id="useraddress" tabindex="4" placeholder="Alamat lengkap" class="form-control"><?=set_value('useraddress')?></textarea><span id="spanaddress"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('tlp')?>
                                    <input type="text" name="tlp" id="tlp" tabindex="5" class="form-control" placeholder="No Telephone" value="<?=set_value('tlp')?>"><span id="spantlp"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('hp')?>
                                    <input type="text" name="hp" id="hp" tabindex="6" class="form-control" placeholder="No Handphone" value="<?=set_value('hp')?>"><span id="spanhp"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('password')?>
                                    <input type="password" name="password" id="password" tabindex="7" class="form-control" placeholder="Password" value="<?=set_value('password')?>"><span id="spanpass"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('passconf')?>
                                    <input type="password" name="passconf" id="password-confirm" tabindex="8" class="form-control" placeholder="Konfirmasi Password"><span id="spanpassc"></span>
                                </div>
                                <div class="form-group text-center">
                                    <?=form_error('term-conditions')?>
                                    <div id="term">
                                        <input type="checkbox" tabindex="9" class="" value="1" name="term-conditions" id="term-conditions">
                                        <label for="term-conditions"> Syarat & Ketentuan</label><span id="spanterm-conditions"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="registration-submit" id="registration-submit" onclick="" tabindex="10" class="form-control btn btn-login" value="Daftar">
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

                            <form id="expedisi-form" action="<?=base_url()?>home/doRegisterExpedition" method="post" role="form" style="display: none;">
                                <input type="hidden" name="role_id" value="2">
                                <div class="form-group">
                                    <?=form_error('username_expedition')?>
                                    <input type="text" name="username_expedition" id="username_expedition" tabindex="1" class="form-control" placeholder="Username" value="<?=set_value('username_expedition')?>"><span id="spanusername"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('email_expedition')?>
                                    <input type="text" name="email_expedition" id="email_expedition" tabindex="2" class="form-control" placeholder="email@example.com" value="<?=set_value('email_expedition')?>"><span id="spanemail"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('name_expedition')?>
                                    <input type="text" name="name_expedition" id="name_expedition" tabindex="3" class="form-control" placeholder="Nama lengkap/perusahaan" value="<?=set_value('name_expedition')?>"><span id="spanname"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('address_expedition')?>
                                    <textarea cols="71" rows="3" name="address_expedition" id="address_expedition" tabindex="4" placeholder="Alamat lengkap" class="form-control"><?=set_value('address_expedition')?></textarea><span id="spanaddress"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('tlp_expedition')?>
                                    <input type="text" name="tlp_expedition" id="tlp_expedition" tabindex="5" class="form-control" placeholder="No Telephone" value="<?=set_value('tlp_expedition')?>"><span id="spantlp"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('hp_expedition')?>
                                    <input type="text" name="hp_expedition" id="hp_expedition" tabindex="6" class="form-control" placeholder="No Handphone" value="<?=set_value('hp_expedition')?>"><span id="spanhp"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('password_expedition')?>
                                    <input type="password" name="password_expedition" id="password_expedition" tabindex="7" class="form-control" placeholder="Password" value="<?=set_value('password_expedition')?>"><span id="spanpass"></span>
                                </div>
                                <div class="form-group">
                                    <?=form_error('passconf_expedition')?>
                                    <input type="password" name="passconf_expedition" id="passconf_expedition" tabindex="8" class="form-control" placeholder="Konfirmasi Password"><span id="spanpassc"></span>
                                </div>
                                <div class="form-group text-center">
                                    <?=form_error('term-conditions-expedition')?>
                                    <div id="term">
                                        <input type="checkbox" tabindex="9" class="" value="1" name="term-conditions-expedition" id="term-conditions-expedition">
                                        <label for="term-conditions"> Syarat & Ketentuan</label><span id="spanterm-conditions"></span>
                                    </div>
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
                                                <a href="#" tabindex="11" class="forgot-password">Login</a>
                                                <a href="<?=site_url('')?>" tabindex="11" class="forgot-password">Home</a>
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

    function submitRegister(){
        var role_id = $('input[name=role_id]').val();
        var usertype = $('input[name=usertype]:checked').val();
        var username = $('input[name=username]').val();
        var email = $('input[name=email]').val();
        var address = $('input[name=useraddress]').val();
        var tlp = $('input[name=tlp]').val();
        var hp = $('input[name=hp]').val();
        var password = $('input[name=password]').val();
        var password_confirm = $('input[name=password-confirm]').val();
        var term_conditions = $('input[name=term-conditions]:checked').val();

        try{

            if($('input[name=usertype]:checked').length > 0){
                resetError('radio','spanUsertype');
            }else{
                setError('radio','spanUsertype');
            }

            if(username !=""){
                resetError('username','spanusername');
            }else{
                setError('username','spanusername');
            }

            if(validateEmail(email) == true){
                resetError('email','spanemail');
            }else{
                setError('email','spanemail')
            }

            if(name !=""){
                resetError('name','spanname');
            }else{
                setError('name','spanname');
            }

            if(address !=""){
                resetError('useraddress','spanaddress');
            }else{
                setError('useraddress','spanaddress');
            }

            if(tlp !=""){
                resetError('tlp','spantlp');
            }else{
                setError('tlp','spantlp');
            }

            if(hp !=""){
                resetError('hp','spanhp');
            }else{
                setError('hp','spanhp');
            }

            if(password !=""){
                resetError('password','spanpass');
            }else{
                setError('password','spanpass');
            }

            if(password_confirm !=""){
                resetError('password-confirm','spanpassc');
            }else{
                setError('password-confirm','spanpassc');
            }

            if($('input[name=term-conditions]:checked').length > 0){
                resetError('term','spanterm-conditions');
            }else{
                setError('term','spanterm-conditions');
            }

            if(password != password_confirm){
                document.getElementById("spanpassc").innerHTML = "Password not match";
            }

            if(($('input[name=usertype]:checked').length > 0) && username !=""
                && validateEmail(email) !=false && name !="" &&
                address !="" && tlp !="" && hp !="" && password !="" &&
                password_confirm !="" &&
                ($('input[name=term-conditions]:checked').length > 0)){

            }


        }catch (e){
            throw e;
            alert(e);
            return;
        }
    }

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