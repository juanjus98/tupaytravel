<?php
/*echo "<pre>";
print_r($post);
echo "</pre>";*/
/*$user_info = $this->user_info;*/
?>
<?php echo msj(); ?>
<div class="row">
<div class="col-xs-12">
<div class="box">

 <form class="form-horizontal" name="edit_form" id="edit_form" action="<?php echo $current_url;?>" method="post" role="form" enctype="multipart/form-data">

   <?php if($wa_tipo == 'E'){ ?>
    <input type="hidden" name="id_usuario" value="<?php echo $post['id_usuario'];?>">
    <input type="hidden" name="id_personal" value="<?php echo $post['id_personal'];?>">
   <?php }?>

   <div class="box-header" style="padding-bottom: 0;">
     <h3 class="box-title"><?php echo $tipo; ?></h3>
     <div class="box-tools">
       <div class="pull-right">
         <?php
         if($wa_tipo == 'C' || $wa_tipo == 'E'){
           ?>
           <button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
           <?php
         }
         if($wa_tipo == 'V'){
           ?>
           <a class="btn btn-success btn-sm" title="Editar registro" href="<?php echo $edit_url;?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>

           <?php }?>

           <a href="<?php echo $back_url;?>" class="btn btn-default btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
         </div>
       </div> 
     </div>

     <div class="box-body">
       <div class="row pad" style="padding: 0px;">
         <div class="col-sm-12">

           <table class="table table-bordered">
             <thead class="thead-default">
               <tr>
                 <th colspan="4"><i class="fa fa-list"></i> Información personal</th>
               </tr>
             </thead>
             <tbody>

               <tr>
                 <td>
                   <div class="form-group" style="margin-bottom: 0px;">
                     <label for="nombre" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Nombre:</label>
                     <div class="col-sm-4">
                       <input name="nombre" id="nombre" type="text" value="<?php echo $post['nombre'];?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                       <?php echo form_error('nombre', '<div class="error">', '</div>'); ?>
                     </div>
                     <label for="apellido" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Apellidos:</label>
                     <div class="col-sm-4">
                       <input name="apellido" id="apellido" type="text" value="<?php echo $post['apellido'];?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                       <?php echo form_error('apellido', '<div class="error">', '</div>'); ?>
                     </div>
                   </div>
                 </td>
               </tr>

               <tr>
                 <td>
                   <div class="form-group" style="margin-bottom: 0px;">
                     <label for="telefono" class="col-sm-2 control-label" style="text-align: right;">Teléfono:</label>
                     <div class="col-sm-4">
                       <input name="telefono" id="telefono" type="text" value="<?php echo $post['telefono'];?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                       <?php echo form_error('telefono', '<div class="error">', '</div>'); ?>
                     </div>
                     <label for="email" class="col-sm-2 control-label" style="text-align: right;">E-mail:</label>
                     <div class="col-sm-4">
                       <input name="email" id="email" type="text" value="<?php echo $post['email'];?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                       <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                     </div>
                   </div>
                 </td>
               </tr>

             </tbody>
           </table><br>
           <table class="table table-bordered">
             <thead class="thead-default">
               <tr>
                 <th colspan="4"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Información de usuario</th>
               </tr>
             </thead>
             <tbody>

               <tr>
                 <td>
                   <div class="form-group" style="margin-bottom: 0px;">
                     <label for="usuario" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Usuario:</label>
                     <div class="col-sm-4">
                        <input type="hidden" name="usuario" value="<?php echo $post['usuario'];?>">
                       <input name="usuario_pre" id="usuario_pre" type="text" value="<?php echo $post['usuario'];?>" class="form-control input-sm" disabled>
                       <?php echo form_error('usuario', '<div class="error">', '</div>'); ?>
                     </div>
                     <label for="ck_cambiar_pass" class="col-sm-2 control-label" style="text-align: right;">Cambiar contraseña:</label>
                    <div class="col-sm-4">
                     <?php
                     $checked_cambiar = "";
                     if(@$post['ck_cambiar_pass'] == 1){
                      $checked_cambiar = "checked";
                    }
                    ?>
                    <input class="form-control input-sm" id="ck_cambiar_pass" name="ck_cambiar_pass" type="checkbox" value="1" <?php echo $checked_cambiar;?> <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>> 
                    </div>
                   </div>
                 </td>
               </tr>
               <?php
               //Mostrar/Ocultar passwords
               $style_pass = "display: none;";
               if(@$post['ck_cambiar_pass']){
                $style_pass = "";
               }
               ?>
               <tr id="cont-passwords" style="<?php echo $style_pass;?>">
                 <td>
                   <div class="form-group" style="margin-bottom: 0px;">
                     <label for="password" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Contraseña actual:</label>
                     <div class="col-sm-4">
                       <input name="password" id="password" type="password" value="<?php echo $retVal = (!empty($post['password'])) ? $post['password'] : '' ;?>" class="form-control input-sm">
                       <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                     </div>
                     <label for="new_password" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Nueva contraseña:</label>
                     <div class="col-sm-4">
                       <input name="new_password" id="new_password" type="password" value="<?php echo $retVal = (!empty($post['new_password'])) ? $post['new_password'] : '' ; ?>" class="form-control input-sm">
                       <?php echo form_error('new_password', '<div class="error">', '</div>'); ?>
                     </div>
                   </div>
                 </td>
               </tr>

             </tbody>
           </table>
           </div>
         </div>
       </div>

       <div class="box-header">
         <div class="row pad" style="padding-top: 0px; padding-bottom: 0px;">
           <div class="col-sm-6">

             <p><span style="color: red; font-weight: bold;"><strong>(*)</strong> Campos obligatorios.</span></p>

           </div>
           <div class="col-sm-6">

             <div class="pull-right">
               <?php
               if($wa_tipo == 'C' || $wa_tipo == 'E'){
                 ?>
                 <button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                 <?php
               }
               if($wa_tipo == 'V'){
                 ?>
                 <a class="btn btn-success btn-sm" title="Editar registro" href="<?php echo $edit_url;?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>

                 <?php }?>

                 <a href="<?php echo $back_url;?>" class="btn btn-default btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
               </div>

             </div>

           </div>
         </div>

       </form>

     </div>
   </div>
 </div>