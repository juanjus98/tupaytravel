<?php
$user_info = $this->user_info;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header">
                <i class="fa fa-smile-o" aria-hidden="true"></i>
                <h3 class="box-title">Bienvenido <?php echo $user_info['nombre'] . ' ' . $user_info['apellido'];?></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <blockquote>
                    <p>Administrador de contenidos para <strong><?php echo $website['title'];?></strong>.</p>
                    <small><?php echo $website['description'];?></small>
                </blockquote>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- ./col -->
</div>