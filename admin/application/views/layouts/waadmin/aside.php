<?php
$user_info = $this->user_info;

//collpase_cookie (mostrar / ocultar menu)
$collapse_left = "";
if(isset($_COOKIE["collpase_cookie"])){
    $collapse_left = ($_COOKIE["collpase_cookie"] == 2) ? "collapse-left" : "";
}
?>
<aside class="left-side sidebar-offcanvas <?php echo $collapse_left?>">                
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- <div class="user-panel">
            <div class="pull-left image">
            <img src="<?php echo base_url('images/avatar3.png');?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $user_info['nombre'];?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div> -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <?php echo modulos_menus();?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>