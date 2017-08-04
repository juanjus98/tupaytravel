<?php
/*echo '<pre>';
print_r($condominios);
echo '</pre>';*/
?>
<div class="row">
 <div class="col-xs-12">
   <div class="box">

     <form class="form-horizontal" name="edit_form" id="edit_form" action="<?php echo $current_url;?>" method="post" role="form" enctype="multipart/form-data">

       <?php if($wa_tipo == 'E'){ ?> <input type="hidden" name="id" value="<?php echo $post['id'];?>"><?php }?>

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
               <a class="btn btn-success btn-sm" title="Editar registro" href="<?php echo $editar_url;?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>

               <?php }?>

               <a href="<?php echo $back_url;?>" class="btn btn-default btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
             </div>
           </div> 
         </div>

         <div class="box-body">
           <div class="row pad" style="padding: 0px;">
             <fieldset <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
               <div class="col-sm-12">

                 <table class="table table-bordered">
                   <thead class="thead-default">
                     <tr>
                       <th colspan="4"><i class="fa fa-list"></i> Información</th>
                     </tr>
                   </thead>
                   <tbody>
                  <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                       <label for="titulo1" class="col-sm-2 control-label" style="text-align: right;"> Título:</label>
                       <div class="col-sm-4">
                         <input name="titulo1" id="titulo1" type="text" value="<?php echo $retVal = (!empty($post['titulo1'])) ? $post['titulo1'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('titulo1', '<div class="error">', '</div>'); ?>
                       </div>
                       <label for="orden" class="col-sm-2 control-label" style="text-align: right;"> Orden:</label>
                       <div class="col-sm-4">
                         <input name="orden" id="orden" type="text" value="<?php echo $retVal = (!empty($post['orden'])) ? $post['orden'] : '';?>" class="form-control input-sm">
                         <?php echo form_error('orden', '<div class="error">', '</div>'); ?>
                       </div>
                     </div>
                   </td>
                 </tr>
               </tbody>
             </table><br>

             <table class="table table-bordered">
         <thead class="thead-default">
           <tr>
             <th><i class="fa fa-list"></i> Imagen Slide</th>
           </tr>
         </thead>
         <tbody>
           <tr>
             <td>
               <div class="form-group" style="margin-bottom: 0px;">
                 <label for="imagen_1" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Imagen:</label>
                 <div class="col-sm-10">
                   <input type="file" name="imagen_1" id="imagen_1" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                   <?php
                   if(!empty($post['imagen_1'])){
                     ?>
                     <p class="help-block">
                       <a href="<?php echo base_url('images/uploads/' . $post['imagen_1']);?>" target="_blank">
                         <img src="<?php echo base_url('images/uploads/' . $post['imagen_1']);?>" style="max-height: 60px;">
                       </a>
                     </p>
                     <?php }?>
                   </div>
                 </div>
               </td>
             </tr>
           </tbody>
         </table><br>

           </div>
         </fieldset >
       </div><!--end pad-->
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
               <a class="btn btn-success btn-sm" title="Editar registro" href="<?php echo $editar_url;?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>

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