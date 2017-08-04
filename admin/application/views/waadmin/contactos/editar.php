<?php
//echo '<pre>';
//print_r($post);
//echo '</pre>';
?>
<form name="frm-editar" id="frm-editar" method="post" action="<?php echo base_url(); ?>waadmin/contactos/editar/<?php echo $post['id']; ?>" class="form-horizontal" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8 title_panel"><?php echo @$template['title']; ?></div>
                <div class="col-md-4">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Guardar</button>
                        <a href="<?php echo base_url(); ?>waadmin/contactos/index" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Cancelar</a>
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
                    <!--<li role="presentation"><a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">Imágenes</a></li>-->
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tab-wa">
                    <div role="tabpanel" class="tab-pane active" id="tab-1">
                        
                        <div class="form-group">
                            <label for="nombres" class="col-sm-2 control-label">Nombres:</label>
                            <div class="col-sm-5">
                                <input type="text" name="nombres" id="nombres" class="form-control"  placeholder="Nombres" value="<?php echo $post['nombres']; ?>">
                            </div>
                            <?php echo form_error('nombres'); ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="telefono" class="col-sm-2 control-label">Teléfono:</label>
                            <div class="col-sm-5">
                                <input type="text" name="telefono" id="telefono" class="form-control"  placeholder="Teléfono" value="<?php echo $post['telefono']; ?>">
                            </div>
                            <?php echo form_error('telefono'); ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">E-mail:</label>
                            <div class="col-sm-5">
                                <input type="text" name="email" id="email" class="form-control"  placeholder="E-mail" value="<?php echo $post['email']; ?>">
                            </div>
                            <?php echo form_error('email'); ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="nombre_corto" class="col-sm-2 control-label">País:</label>
                            <div class="col-sm-5">
                                <select name="pais" id="pais" class="form-control">
                                    <?php
                                    $paises = listado_paises();
                                    if (!empty($paises)) {
                                        foreach ($paises as $pais) {
                                            $selected = "";
                                            if ($post['pais'] == $pais) {
                                                $selected = "selected";
                                            }
                                            echo '<option value="'.$pais.'" ' . $selected . '>' . $pais . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php echo form_error('pais'); ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="asunto" class="col-sm-2 control-label">Tema:</label>
                            <div class="col-sm-5">
                                <input type="text" name="asunto" id="email" class="form-control"  placeholder="Tema" value="<?php echo $post['asunto']; ?>">
                            </div>
                            <?php echo form_error('asunto'); ?>
                        </div>

                        <div class="form-group">
                            <label for="mensaje" class="col-sm-2 control-label">Mensaje:</label>
                            <div class="col-sm-5">
                                <textarea name="mensaje" id="mensaje" class="form-control" rows="6" placeholder="Mensaje"><?php echo $post['mensaje']; ?></textarea>
                            </div>
                            <?php echo form_error('mensaje'); ?>
                        </div>

                    </div>
                    <!--                    <div role="tabpanel" class="tab-pane" id="tab-2">
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
                    
                                        </div>-->
                </div>
            </div>
            <!--//Tabs-->
        </div>
    </div><!--//panel-->
</form>