<?php
/*echo '<pre>';
print_r($post);
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
                         <label for="nombre_largo" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span>Nombre:</label>
                       <div class="col-sm-4">
                         <input name="nombre_largo" id="nombre_largo" type="text" value="<?php echo $retVal = (!empty($post['nombre_largo'])) ? $post['nombre_largo'] : '';?>" class="form-control input-sm" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                         <?php echo form_error('nombre_largo', '<div class="error">', '</div>'); ?>
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
                 <th colspan="4"><i class="fa fa-list"></i> Eventos

                   <span class="pull-right">
                    <a href="#" class="btn btn-info btn-xs" id="btn-agregar-especificacion">
                      Agregar<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                  </span>
                </th>
              </tr>
            </thead>
            <tbody>
             <tr>
               <td>
                 <div class="form-group" style="margin-bottom: 0px;">
                   <div class="col-sm-12">
                     <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Eventos</th>
                            <th>Capacidad</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody id="items-especificaciones">
                          <?php
                          /*$especificaciones_titulo = $post['especificaciones']['titulo'];*/
                          $especificaciones_titulo = (!empty($post['especificaciones']['titulo'])) ? $post['especificaciones']['titulo'] : '' ;
                          /*$especificaciones_descripcion = $post['especificaciones']['descripcion'];*/
                          $especificaciones_descripcion = (!empty($post['especificaciones']['descripcion'])) ? $post['especificaciones']['descripcion'] : '' ;
                          if (!empty($especificaciones_titulo)) {
                            foreach ($especificaciones_titulo as $index => $titulo) {
                              ?>
                              <tr class="row-table-rm">
                                <td><input type="text" name="especificaciones[titulo][]" class="form-control input-sm" placeholder="Título" value="<?php echo $especificaciones_titulo[$index]; ?>"></td>
                                <td><input type="text" name="especificaciones[descripcion][]" class="form-control input-sm" placeholder="Descripción" value="<?php echo $especificaciones_descripcion[$index]; ?>"></td>
                                <td>
                                  <a href="#" class="btn btn-danger btn-xs btn-quitar-tr">Quitar <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
                                </td>
                              </tr>
                              <?php
                            }
                          } else {
                            ?>
                            <tr>
                              <td><input type="text" name="especificaciones[titulo][]" class="form-control input-sm" placeholder="Título"></td>
                              <td><input type="text" name="especificaciones[descripcion][]" class="form-control input-sm" placeholder="Descripción"></td>
                              <td>
                                <a href="#" class="btn btn-danger btn-xs btn-quitar-tr">Quitar <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>
                              </td>
                            </tr>
                            <?php
                          }
                          ?>

                        </tbody>
                      </table>
                    </div>
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

         <table class="table table-bordered">
         <thead class="thead-default">
           <tr>
             <th><i class="fa fa-list"></i> Logo Principal</th>
           </tr>
         </thead>
         <tbody>
           <tr>
             <td>
               <div class="form-group" style="margin-bottom: 0px;">
                 <label for="imagen_2" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Imagen:</label>
                 <div class="col-sm-10">
                   <input type="file" name="imagen_2" id="imagen_2" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                   <?php
                   if(!empty($post['imagen_2'])){
                     ?>
                     <p class="help-block">
                       <a href="<?php echo base_url('images/uploads/' . $post['imagen_2']);?>" target="_blank">
                         <img src="<?php echo base_url('images/uploads/' . $post['imagen_2']);?>" style="max-height: 60px;">
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
             <th><i class="fa fa-list"></i> Logo Footer</th>
           </tr>
         </thead>
         <tbody>
           <tr>
             <td>
               <div class="form-group" style="margin-bottom: 0px;">
                 <label for="imagen_3" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Imagen:</label>
                 <div class="col-sm-10">
                   <input type="file" name="imagen_3" id="imagen_3" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
                   <?php
                   if(!empty($post['imagen_3'])){
                     ?>
                     <p class="help-block">
                       <a href="<?php echo base_url('images/uploads/' . $post['imagen_3']);?>" target="_blank">
                         <img src="<?php echo base_url('images/uploads/' . $post['imagen_3']);?>" style="max-height: 60px;">
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