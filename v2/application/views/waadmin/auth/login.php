<?php
$username = array(
    'name'  => 'username',
    'id'    => 'username',
    //'size'  => 30,
    'value' => set_value('username'),
    'class' => "form-control text-login",
    'placeholder' => 'Usuario'
    );

$password = array(
    'name'  => 'password',
    'id'    => 'password',
    //'size'  => 30,
    'class' => "form-control text-login",
    'placeholder' => 'Contraseña'
    );

$remember = array(
    'name'  => 'remember',
    'id'    => 'remember',
    'value' => 1,
    'checked'   => set_value('remember'),
    //'style' => 'margin:0;padding:0'
    );

$confirmation_code = array(
    'name'  => 'captcha',
    'id'    => 'captcha',
    'maxlength' => 8
    );

    ?>
    <div class="bg-home">

        <div class="container">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-7 girl-cont">
                <img src="<?php echo base_url(); ?>images/chica.png" class="img-responsive" />
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">

                    <div class="form-box" id="login-box">
                    <div class="header bg-header-login">Acceder</div>
                        <form name="frm-login" id="frm-login" action="<?php echo base_url("waadmin/login");?>" method="post">
                            <div class="body bg-gray">
                                <?php echo msj();?>
                                
                                <div class="form-group">
                                    <?php echo form_input($username)?>
                                     <?php echo form_error('username');  ?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_password($password)?>
                                    <?php echo form_error('password');  ?>
                                </div>          
                    <!-- <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div> -->
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in" aria-hidden="true"></i> Acceder ahora</button>
                    <!-- <p><?php echo anchor("registro", 'Registrarme.');?></p> -->
                    <p><?php echo anchor("cambiar_contraseña", 'Restablecer contraseña.');?></p>
                </div>
            </form>

            <!-- <div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div> -->
        </div>


</div>
</div>
</div>