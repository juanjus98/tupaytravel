<?php
/*echo '<pre>';
print_r($estrellas);
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
               <a class="btn btn-success btn-sm" title="Editar registro" href="<?php echo $edit_url;?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>

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
                         <label for="titulo" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Título:</label>
                         <div class="col-sm-10">
                           <input name="titulo" id="titulo" type="text" value="<?php echo $retVal = (!empty($post['titulo'])) ? $post['titulo'] : '';?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                           <?php echo form_error('titulo', '<div class="error">', '</div>'); ?>
                         </div>
                       </div>
                     </td>
                   </tr>

                    <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="url" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Url:</label>
                         <div class="col-sm-4">
                           <input name="url" id="url" type="text" value="<?php echo $retVal = (!empty($post['url'])) ? $post['url'] : '';?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                           <?php echo form_error('url', '<div class="error">', '</div>'); ?>
                         </div>

                         <label for="target" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Target:</label>
                         <div class="col-sm-4">
                           <select name="target" id="target" data-placeholder="Seleccionar" class="form-control input-sm">
                            <?php
                                $targets = array('_self' => 'Abrir en la misma página', '_blank' => 'Abrir en una nueva página');
                                foreach ($targets as $index=>$value) {
                                    $selected = ($index == $post['target']) ? 'selected' : '' ;
                                    echo '<option value="' . $index . '" ' . $selected . '>' . $value . '</option>';
                                }
                                ?>
                          </select>
                           <?php echo form_error('target', '<div class="error">', '</div>'); ?>
                         </div>
                       </td>
                     </tr>

                     <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="orden" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Url:</label>
                         <div class="col-sm-4">
                           <input name="orden" id="orden" type="text" value="<?php echo $retVal = (!empty($post['orden'])) ? $post['orden'] : '99';?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                           <?php echo form_error('orden', '<div class="error">', '</div>'); ?>
                         </div>
                       </td>
                     </tr>

                   </tbody>
                 </table><br>

                 <table class="table table-bordered">
               <thead class="thead-default">
                 <tr>
                   <th><i class="fa fa-list"></i> Imagen</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                       <label for="imagen" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Imagen:</label>
                       <div class="col-sm-10">
                       <div class="alert alert-warning alert-dismissable">
                            <i class="fa fa-info-circle"></i> 
                            <b>Atención!</b> Peso máximo 500KB (jpg, png, gif), Dimensiones 600px * 600px.
                          </div>
                         <input type="file" name="imagen" id="imagen" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                         <?php
                         if(!empty($post['imagen'])){
                           ?>
                           <p class="help-block">
                             <a href="<?php echo base_url($this->config->item('upload_path') . $post['imagen']);?>" target="_blank">
                               <img src="<?php echo base_url($this->config->item('upload_path') . $post['imagen']);?>" style="max-height: 60px;">
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
                 <a class="btn btn-success btn-sm" title="Editar registro" href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>

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