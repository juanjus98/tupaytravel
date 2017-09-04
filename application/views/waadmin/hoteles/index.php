<?php
/*echo '<pre>';
print_r($provincias);
echo '</pre>';*/
?>
<?php echo msj(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <form name="frm-buscar" id="frm-buscar" method="post" action="" role="search">
                    <div class="row pad" style="padding-bottom: 0px;">

                        <div class="col-sm-2">
                            <select name="estrellas" class="form-control input-sm chosen-select"  data-placeholder="Seleccionar">
                            <option value=""></option>
                                <?php
                                foreach ($estrellas as $index=>$value) {
                                    $selected = ($index == $post['estrellas']) ? 'selected' : '' ;
                                    echo '<option value="' . $index . '" ' . $selected . '>' . $value . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                    <div class="col-sm-2">
                            <select name="id_provincia" class="form-control input-sm chosen-select" data-placeholder="Seleccionar provincia">
                            <option value=""></option>
                                <?php
                                foreach ($provincias as $index => $value) {
                                    $selected = "";
                                if ($post['id_provincia'] == $value['id']) {
                                    $selected = "selected";
                                }
                                echo '<option value="' . $value['id'] . '" ' . $selected . '>' . $value['provincia'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" name="busqueda" class="form-control input-sm" placeholder="Busqueda" value="<?php if(!empty($post['busqueda'])){ echo $post['busqueda'];} ?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <a href="<?php echo base_url('waadmin/hoteles/index?refresh');?>" class="btn btn-default btn-sm" title="Restablecer"><i class="fa fa-undo" aria-hidden="true"></i> Restablecer </a>
                        </div>

                        <div class="col-sm-3">
                            <div class="pull-right">
                                <!-- <button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar </button> -->
                                <a href="<?php echo base_url('waadmin/hoteles/editar/C');?>" class="btn btn-success btn-sm" title="Agregar"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar </a>

                                <a href="#" class="btn btn-danger btn-sm" id="btn-eliminar" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar </a>

                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.box-header -->
            <form name="index_form" id="index_form" action="<?php echo base_url(); ?>waadmin/hoteles/eliminar" method="post">
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th><input type="checkbox" id="chkTodo" /></th>
                                <th>N° Estrellas</th>
                                <th>Nombre</th>
                                <th>Provincia</th>
                                <th class="text-center">Orden</th>
                                <th></th>
                            </tr>
                            <?php
                            if(!empty($listado)){
                                foreach ($listado as $key => $item) {
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="items[]" id="eliminarchk-<?php echo $item['id_hotel'] ?>" value="<?php echo $item['id_hotel'] ?>" class="chk">
                                        </td>
                                        <td>
                                        <?php 
                                        echo $estrellas[$item['estrellas']];
                                        ?>
                                        </td>
                                        <td><?php echo $item['nombre']; ?></td>
                                        <td><?php echo $item['provincia']; ?></td>
                                        <td class="text-center" data-controller="/hoteles/uporden" data-identificador="<?php echo $item['id_hotel'];?>">
                                            <div class="box_orden">
                                                <?php echo $item['orden']; ?>
                                            </div>
                                            <input type="text" name="orden_<?php echo $item['id_hotel'];?>" value="<?php echo $item['orden'];?>" style="display: none; max-width: 40px; margin: 0 auto;" class="form-control input-sm text-center input-order">
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url(); ?>waadmin/hoteles/editar/V/<?php echo $item['id_hotel']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="Visualizar"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="<?php echo base_url(); ?>waadmin/hoteles/editar/E/<?php echo $item['id_hotel']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                            <a class="btn btn-info btn-xs wapopup" data-width="800" data-height="600" href="<?php echo base_url(); ?>waadmin/hoteles_galeria/index/<?php echo $item['id_hotel']; ?>" data-toggle="tooltip" title="Galería"><i class="fa fa-picture-o" aria-hidden="true"></i></a>

                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6" class="text-center"><small>No se encontro ningún registro.</small></td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="pull-right">
                    <?php
                    echo $links;
                    ?>
                </div>
            </form>
        </div><!-- /.box -->
    </div>
</div>