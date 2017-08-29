<?php
/*echo '<pre>';
print_r($paginas);
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
                         <label for="nombre" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Nombre:</label>
                         <div class="col-sm-4">
                           <input name="nombre" id="nombre" type="text" value="<?php echo $retVal = (!empty($post['nombre'])) ? $post['nombre'] : '';?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                           <?php echo form_error('nombre', '<div class="error">', '</div>'); ?>
                         </div>
                         <label for="url_key" class="col-sm-2 control-label" style="text-align: right;"> Slug:</label>
                         <div class="col-sm-4">
                           <input type="hidden" name="url_key_pre" value="<?php echo $retVal = (!empty($post['url_key'])) ? $post['url_key'] : '' ; ?>">
                           <input name="url_key" id="url_key" type="text" value="<?php echo $retVal = (!empty($post['url_key'])) ? $post['url_key'] : '' ; ?>" class="form-control input-sm" placeholder="Automático" disabled>
                         </div>

                       </div>
                     </td>
                   </tr>
<tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="id_tbltours_categoria" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Categoría:</label>
                         <div class="col-sm-4">
                           <select name="id_tbltours_categoria" id="id_tbltours_categoria" data-placeholder="Seleccionar provincia" class="chosen-select">
                            <option value=""></option>
                            <?php
                            if(!empty($categorias)){
                              foreach ($categorias as $key => $value) {
                                $selected_categoria = ($value['id'] == $post['id_tbltours_categoria']) ? 'selected' : '' ;
                                echo '<option value="'.$value['id'].'" ' . $selected_categoria . '>'.$value['categoria'].'</option>';
                              }
                            }
                            ?>
                          </select>
                          <?php echo form_error('id_tbltours_categoria', '<div class="error">', '</div>'); ?>
                        </div>

                         <label for="id_provincia" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Provincia:</label>
                         <div class="col-sm-4">
                           <select name="id_provincia" id="id_provincia" data-placeholder="Seleccionar provincia" class="chosen-select">
                            <option value=""></option>
                            <?php
                            if(!empty($provincias)){
                              foreach ($provincias as $key => $value) {
                                $selected_provincia = ($value['id'] == $post['id_provincia']) ? 'selected' : '' ;
                                echo '<option value="'.$value['id'].'" ' . $selected_provincia . '>'.$value['provincia'].'</option>';
                              }
                            }
                            ?>
                          </select>
                          <?php echo form_error('id_provincia', '<div class="error">', '</div>'); ?>
                        </div>
                      </td>
                    </tr>
                   <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="descripcion" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Descripción:</label>
                         <div class="col-sm-10">
                           <textarea name="descripcion" id="descripcion" class="form-control" rows="3" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>><?php echo $retVal = (!empty($post['descripcion'])) ? $post['descripcion'] : '' ; ?></textarea>
                           <?php echo form_error('descripcion', '<div class="error">', '</div>'); ?>
                         </div>
                       </div>
                     </td>
                   </tr>
                    <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="estadia" class="col-sm-2 control-label" style="text-align: right;">Estadía:</label>
                         <div class="col-sm-4">
                           <?php
                           $checked = "";
                           if(!empty($post['estadia']) && $post['estadia'] == 1){
                            $checked = "checked";
                          }
                          ?>
                          <input class="form-control input-sm" id="estadia" name="estadia" type="checkbox" value="1" <?php echo $checked;?> <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>  Incluye estadía.
                          <?php echo form_error('estadia', '<div class="error">', '</div>'); ?>
                        </div>

                        <label for="precio" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Precio:</label>
                         <div class="col-sm-4">
                           <input name="precio" id="precio" type="text" value="<?php echo $retVal = (!empty($post['precio'])) ? $post['precio'] : '';?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                           <?php echo form_error('precio', '<div class="error">', '</div>'); ?>
                         </div>
                      </td>
                    </tr>

                    <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="orden" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Orden:</label>
                         <div class="col-sm-4">
                           <input name="orden" id="orden" type="text" value="<?php echo $retVal = (!empty($post['orden'])) ? $post['orden'] : '';?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                           <?php echo form_error('orden', '<div class="error">', '</div>'); ?>
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
                          <?php echo form_error('detalle', '<div class="error">', '</div>'); ?>
                          <?php
                          $detalle = (!empty($post['detalle'])) ? $post['detalle'] : '' ;
                          echo $this->ckeditor->editor('detalle', $detalle);
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
                   <th><i class="fa fa-list"></i> Imagen Principal</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                   <td>
                     <div class="form-group" style="margin-bottom: 0px;">
                       <label for="imagen" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Imagen:</label>
                       <div class="col-sm-10">
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

               <table class="table table-bordered">
                  <thead class="thead-default">
                   <tr>
                     <th><i class="fa fa-list"></i> Forma de Pago</th>
                   </tr>
                 </thead>
                 <tbody>
                   <tr>
                     <td>
                       <div class="form-group" style="margin-bottom: 0px;">
                         <label for="orden" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Forma de pago:</label>
                         <div class="col-sm-4">
                         <select name="formas_pago_id" id="formas_pago_id" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                           <option value="">Seleccionar</option>
                           <?php
                           if(!empty($paginas)){
                            foreach ($paginas as $key => $value) {
                              $selected = ($value['id'] == $post['formas_pago_id']) ? 'selected' : '' ;
                              echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['nombre_corto'].'</option>';
                            }
                           }
                           ?>
                         </select>
                           <?php echo form_error('formas_pago_id', '<div class="error">', '</div>'); ?>
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