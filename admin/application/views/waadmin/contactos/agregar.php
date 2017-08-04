<?php
//echo '<pre>';
//print_r($categorias_servicios);
//echo '</pre>';
?>
<form name="frm-agregar" id="frm-agregar" method="post" action="" class="form-horizontal" enctype="multipart/form-data">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8 title_panel"><?php echo @$template['title']; ?></div>
                <div class="col-md-4">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button>
                        <a href="<?php echo base_url(); ?>waadmin/clientes/index" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <!--Tabs-->
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">Información</a></li>
                    <li role="presentation"><a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">Imágenes</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content tab-wa">
                    <div role="tabpanel" class="tab-pane active" id="tab-1">
                        <div class="form-group">
                            <label for="nombre_corto" class="col-sm-2 control-label">Servicios:</label>
                            <div class="col-sm-5">
                                <?php
                                if (!empty($categorias_servicios)) {
                                    foreach ($categorias_servicios as $categoria_servicio) {
                                        $id = $categoria_servicio['id'];
                                        $checked_ck = "";
                                        if (isset($post['servicios'][$id])) {
                                            $checked_ck = "checked";
                                        }
                                        ?>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="servicios[<?php echo $categoria_servicio['id']; ?>]" id="servicio_<?php echo $categoria_servicio['id']; ?>" value="<?php echo $categoria_servicio['id']; ?>" <?php echo $checked_ck;?>> <?php echo $categoria_servicio['nombre']; ?>
                                        </label>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <?php echo form_error('servicios'); ?>
                        </div>

                        
                        <div class="form-group">
                            <label for="nombre_corto" class="col-sm-2 control-label">Nombre cliente:</label>
                            <div class="col-sm-5">
                                <input type="text" name="nombre_corto" id="nombre_corto" class="form-control"  placeholder="Nombre cliente" value="<?php echo $post['nombre_corto']; ?>">
                            </div>
                            <?php echo form_error('nombre_corto'); ?>
                        </div>

                        <div class="form-group">
                            <label for="fecha_entrega" class="col-sm-2 control-label">Fecha de entrega:</label>
                            <div class="col-sm-5">
                                <input type="text" name="fecha_entrega" id="fecha_entrega" class="form-control"  placeholder="dd/mm/aaaa" value="<?php echo $post['fecha_entrega']; ?>">
                            </div>
                            <?php echo form_error('fecha_entrega'); ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="url" class="col-sm-2 control-label">Url:</label>
                            <div class="col-sm-5">
                                <input type="text" name="url" id="url" class="form-control"  placeholder="Url" value="<?php echo $post['url']; ?>">
                            </div>
                            <?php echo form_error('url'); ?>
                        </div>

                        <div class="form-group">
                            <label for="descripcion" class="col-sm-2 control-label">Descripción:</label>
                            <div class="col-sm-5">
                                <textarea name="descripcion" id="descripcion" class="form-control" rows="6" placeholder="Descripción"><?php echo $post['descripcion']; ?></textarea>
                            </div>
                            <?php echo form_error('descripcion'); ?>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab-2">
                        <div class="form-group">
                            <label for="imagen_1" class="col-sm-2 control-label">Imágen:</label>
                            <div class="col-sm-5">
                                <input type="file" name="imagen_1" id="imagen_1" class="form-control" />
                                <i>400px * 400px</i>
                            </div>
                            <?php echo form_error('imagen_1'); ?>
                        </div>

                        <?php
                        if (!empty($post['imagen_1'])) {
                            ?>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <a href="<?php echo base_url(); ?>images/upload/<?php echo $post['imagen_1']; ?>" target="_blank">
                                        <img src="<?php echo base_url(); ?>images/upload/<?php echo $post['imagen_1']; ?>" alt="" class="preview-image" />
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>

            </div>
            <!--//Tabs-->
        </div>
    </div><!--//panel-->
</form>