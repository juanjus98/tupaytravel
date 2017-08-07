<?php
//echo '<pre>';
//print_r($listado);
//echo '</pre>';
?>
<div class="panel panel-warning">
    <div class="panel-heading">
        Busqueda
    </div>
    <div class="panel-body">
        <div class="row">
            <form name="frm-buscar" id="frm-buscar" method="post" action="" role="search">
                <div class="col-md-2">
                    <select name="campo" class="form-control input-sm">
                        <?php
                        $campos = array(
                            "t1.nombres" => "Nombres",
                            "t1.email" => "E-mail"
                        );
                        foreach ($campos as $indice => $campo) {
                            $selected_campo = "";
                            if ($post['campo'] == $indice) {
                                $selected_campo = "selected";
                            }
                            echo '<option value="' . $indice . '" ' . $selected_campo . '>' . $campo . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" name="busqueda" class="form-control input-sm" placeholder="Busqueda" value="<?php //echo $post['busqueda']; ?>">
                </div>
                <div class="col-md-2">
                    <select name="ordenar_por" class="form-control input-sm">
                        <?php
                        $ordenar = array(
                            "t1.agregar" => "Fecha de creación",
                            "t1.nombres" => "Nombres"
                        );
                        foreach ($ordenar as $indice => $ordenar_por) {
                            $selected_ordenar = "";
                            if ($post['ordenar_por'] == $indice) {
                                $selected_ordenar = "selected";
                            }
                            echo '<option value="' . $indice . '" ' . $selected_ordenar . '>' . $ordenar_por . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="ordentipo" class="form-control input-sm">
                        <?php
                        $ordentipos = array(
                            "DESC" => "DESC",
                            "ASC" => "ASC"
                        );
                        foreach ($ordentipos as $indice => $ordentipo) {
                            $selected_ordentipo = "";
                            if ($post['ordentipo'] == $indice) {
                                $selected_ordentipo = "selected";
                            }
                            echo '<option value="' . $indice . '" ' . $selected_ordentipo . '>' . $ordentipo . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button> 
                    <a href="<?php echo base_url(); ?>waadmin/contactos/index" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Restablecer</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php echo msj(); ?>
<form name="index_form" id="index_form" action="<?php echo base_url(); ?>waadmin/contactos/eliminar" method="post">
    <div class="panel panel-default wapanel">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8 title_panel"><?php echo @$template['title']; ?></div>
                <div class="col-md-4">

                    <div class="pull-right">
                        <!--<a href="<?php echo base_url(); ?>waadmin/contactos/agregar" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar</a>-->
                        <button type="button" class="btn btn-danger btn-xs btn_eliminar"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Eliminar</button>
                    </div>

                </div>
            </div>
        </div>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th><input type="checkbox" id="chkTodo" /></th>
                    <th>Nombres</th>
                    <th>E-mail</th>
                    <th>País</th>
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
                            <td>
                                <input type="checkbox" name="items[]" id="eliminarchk" value="<?php echo $item['id'] ?>" class="chk">
                            </td>
                            <td><?php echo $item['nombres']; ?></td>
                            <td><?php echo $item['email']; ?></td>
                            <td><?php echo $item['pais']; ?></td>
                            <td><?php echo $item['agregar']; ?></td>
                            <td>
                                <a href="<?php echo base_url(); ?>waadmin/contactos/editar/<?php echo $item['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>
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