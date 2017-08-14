<?php
/*echo '<pre>';
print_r($post);
echo '</pre>';*/
/*foreach ($post['ciudades'] as $key => $value) {
  echo "<pre>";
  print_r(trim($value));
  echo "</pre>";
}*/
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
                         <label for="nombre_corto" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Título:</label>
                         <div class="col-sm-4">
                           <input name="nombre_corto" id="nombre_corto" type="text" value="<?php echo $retVal = (!empty($post['nombre_corto'])) ? $post['nombre_corto'] : '';?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                           <?php echo form_error('nombre_corto', '<div class="error">', '</div>'); ?>
                         </div>

                         <label for="url_key" class="col-sm-2 control-label" style="text-align: right;"> Slug:</label>
                         <div class="col-sm-4">
                           <input name="url_key" id="url_key" type="text" value="<?php echo $retVal = (!empty($post['url_key'])) ? $post['url_key'] : '' ; ?>" class="form-control input-sm" placeholder="Automático" disabled>
                         </div>

                       </div>
                     </td>
                   </tr>

                   <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="resumen" class="col-sm-2 control-label" style="text-align: right;">Resumen:</label>
                         <div class="col-sm-10">
                           <textarea name="resumen" id="resumen" class="form-control" rows="3" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>><?php echo $retVal = (!empty($post['resumen'])) ? $post['resumen'] : '' ; ?></textarea>
                           <?php echo form_error('resumen', '<div class="error">', '</div>'); ?>
                         </div>
                       </div>
                     </td>
                   </tr>

                   <tr>
                     <td colspan="4" style="vertical-align: middle;">
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="keywords" class="col-sm-2 control-label" style="text-align: right;">Keywords:</label>
                         <div class="col-sm-10">
                           <input type="text" name="keywords" id="keywords" data-role="tagsinput" value="<?php echo $retVal = (!empty($post['keywords'])) ? $post['keywords'] : '' ; ?>" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                         </div>
                       </div>
                     </td>
                   </tr>

                 </tbody>
               </table><br>

               <table class="table table-bordered">
                <thead class="thead-default">
                 <tr>
                   <th><i class="fa fa-list"></i> Detalles</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                       <div class="col-sm-12">
                        <?php echo form_error('descripcion1', '<div class="error">', '</div>'); ?>
                        <?php
                        $detalles = (!empty($post['descripcion1'])) ? $post['descripcion1'] : '' ;
                        echo $this->ckeditor->editor('descripcion1', $detalles);
                        ?>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table><br>

            <table class="table table-bordered">
             <thead class="thead-default">
               <tr>
                 <th><i class="fa fa-list"></i> Descargable</th>
               </tr>
             </thead>
             <tbody>
               <tr>
                 <td>
                   <div class="form-group" style="margin-bottom: 0px;">
                     <label for="descargable_titulo" class="col-sm-2 control-label" style="text-align: right;">Título:</label>
                     <div class="col-sm-4">
                       <input name="descargable_titulo" id="descargable_titulo" type="text" value="<?php echo $retVal = (!empty($post['descargable_titulo'])) ? $post['descargable_titulo'] : '';?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                       <?php echo form_error('descargable_titulo', '<div class="error">', '</div>'); ?>
                     </div>
                   </div>
                 </td>
               </tr>
               <tr>
                 <td>
                   <div class="form-group" style="margin-bottom: 0px;">
                     <label for="descargable" class="col-sm-2 control-label" style="text-align: right;">Archivo:</label>
                     <div class="col-sm-10">
                       <input type="file" name="descargable" id="descargable" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>> <small>*.doc, *.docx, *.pfd</small>
                       <?php
                       if(!empty($post['descargable'])){
                         ?>
                         <p class="help-block">
                           <a href="<?php echo base_url($this->config->item('upload_path') . $post['descargable']);?>" target="_blank">
                             <?php echo $post['descargable'];?>
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