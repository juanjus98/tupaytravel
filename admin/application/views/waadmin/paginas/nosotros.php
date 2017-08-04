<?php
//echo '<pre>';
//print_r($post);
//echo '</pre>';
?>
<form name="frm-editar" id="frm-editar" method="post" action="" class="form-horizontal" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8 title_panel"><?php echo @$template['title']; ?></div>

                <div class="col-md-4">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button>
                        <a href="<?php echo base_url(); ?>waadmin/paginas/nosotros" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Cancelar</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="panel-body">
            <?php echo msj(); ?>
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
                            <label for="nombre_corto" class="col-sm-2 control-label">Título:</label>
                            <div class="col-sm-5">
                                <input type="text" name="nombre_corto" id="nombre_corto" class="form-control"  placeholder="Título 1" value="<?php echo $post['nombre_corto']; ?>">
                            </div>
                            <?php echo form_error('nombre_corto'); ?>
                        </div>

                        <div class="form-group">
                            <label for="resumen" class="col-sm-2 control-label">Resumen:</label>
                            <div class="col-sm-5">
                                <textarea name="resumen" id="resumen" class="form-control" rows="3" placeholder="Resumen"><?php echo $post['resumen']; ?></textarea>
                            </div>
                            <?php echo form_error('resumen'); ?>
                        </div>

                        <div class="form-group">
                            <label for="descripcion1" class="col-sm-2 control-label">Descripción:</label>
                            <div class="col-sm-5">
                                <textarea name="descripcion1" id="descripcion1" class="form-control" rows="5" placeholder="Descripción"><?php echo $post['descripcion1']; ?></textarea>
                            </div>
                            <?php echo form_error('descripcion1'); ?>
                        </div>

                        <div class="form-group">
                            <label for="url_video" class="col-sm-2 control-label">Url video:</label>
                            <div class="col-sm-5">
                                <input type="text" name="url_video" id="url_video" class="form-control"  placeholder="Url video" value="<?php echo $post['url_video']; ?>">
                            </div>
                            <?php echo form_error('url_video'); ?>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="tab-2">
                        <div class="form-group">
                            <label for="imagen_1" class="col-sm-2 control-label">Imágen:</label>
                            <div class="col-sm-5">
                                <input type="file" name="imagen_1" id="imagen_1" class="form-control" />
                                <i>390px * 332px</i>
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