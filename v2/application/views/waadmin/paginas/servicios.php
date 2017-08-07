<?php
echo '<pre>';
print_r($post);
echo '</pre>';
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
                        <a href="<?php echo base_url(); ?>waadmin/paginas/clientes" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Cancelar</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="panel-body">
            <?php echo msj(); ?>
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

        </div>
    </div><!--//panel-->
</form>