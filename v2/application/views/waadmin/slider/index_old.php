<?php
//echo '<pre>';
//print_r($listado);
//echo '</pre>';
?>
<?php echo msj(); ?>
<form name="index_form" id="index_form" action="<?php echo base_url(); ?>waadmin/servicios/eliminar" method="post">
    <div class="panel panel-default wapanel">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8 title_panel"><?php echo @$template['title']; ?></div>
                <div class="col-md-4">

                    <!--                    <div class="pull-right">
                                            <a href="<?php echo base_url(); ?>waadmin/servicios/agregar" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar</a>
                                            <button type="button" class="btn btn-danger btn-xs btn_eliminar"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar</button>
                                        </div>-->

                </div>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <!--<th><input type="checkbox" id="chkTodo" /></th>-->
                    <th>Imágen</th>
                    <th>Título 1</th>
                    <th>Título 2</th>
                    <th>Url</th>
                    <th>Fecha de creación</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($listado)) {
                    foreach ($listado as $item) {
                        ?>
                        <tr>
        <!--                            <td>
                                <input type="checkbox" name="items[]" id="eliminarchk" value="<?php echo $item['id'] ?>" class="chk">
                            </td>-->
                            <td><a href="<?php echo base_url();?>images/upload/<?php echo $item['imagen1']; ?>" target="_blank"><?php echo $item['imagen1']; ?></a></td>
                            <td><?php echo $item['titulo1']; ?></td>
                            <td><?php echo $item['titulo2']; ?></td>
                            <td><a href="<?php echo $item['url']; ?>" target="_blank"><?php echo $item['url']; ?></a></td>
                            <td><?php echo $item['agregar']; ?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>waadmin/slider/editar/<?php echo $item['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr><td colspan="6">Sin registros.</td></tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div><!--//panel-->
    <div class="row">
        <div class="col-lg-12">
            <?php
            echo $links;
            ?> 
        </div>
    </div>
</form>