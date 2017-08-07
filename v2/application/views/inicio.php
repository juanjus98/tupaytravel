<?php
//echo '<pre>';
//print_r($descargas_chart);
//echo '</pre>';
?>
<div class="container">
    <div class="row title-row">
        <div class="col-md-8 titulo">Bienvenido <?php echo $user_info['name']; ?></div>
        <div class="col-md-4 ultimo_acceso">
            <?php echo fecha_es(date("Y-m-d"), "L d F a"); ?><br/> 
            ULTIMO ACCESO: <?php echo fecha_es($user_info['lastlogin'], "d M a", TRUE); ?>
        </div>
    </div>
    <div class="clearfix" style="height: 10px;"></div>
    <div class="row">
        <div class="col-md-12">
            <fieldset>
                <legend><?php echo @$template['title']; ?></legend>
<!--                <form name="frm-filtrar" id="frm-filtrar" method="post" action="<?php echo base_url(); ?>index.php/inicio" role="form">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php
                                if (empty($post['fechainicio'])) {
                                    $fechainicio = date("Y-m-d");
                                } else {
                                    $fechainicio = $post['fechainicio'];
                                }
                                ?>
                                <label for="fechainicio">De:</label>
                                <input type="text" name="fechainicio"  data-date-format="yyyy-mm-dd"  class="form-control input-sm calendario" value="<?php echo $fechainicio; ?>" class="form-control input-sm" placeholder="Fecha Inicio">
                            </div>


                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?php
                                if (empty($post['fechafin'])) {
                                    $fechafin = date("Y-m-d");
                                } else {
                                    $fechafin = $post['fechafin'];
                                }
                                ?>
                                <label for="fechafin">A:</label>
                                <input type="text" name="fechafin"   data-date-format="yyyy-mm-dd"  value="<?php echo $fechafin; ?>" class="form-control input-sm calendario" placeholder="Fecha Fin">
                            </div> 
                        </div>
                        <div class="col-lg-2">

                            <button type="submit" class="btn btn-primary btn-sm">Aplicar</button> 
                            <a href="<?php echo base_url(); ?>index.php/inicio/limpiar" class="btn btn-default btn-sm">Restablecer</a>

                        </div>

                    </div>

                </form>-->
            </fieldset>
        </div>
    </div>

    <div class="clearfix" style="height: 10px;"></div>

    <?php
    if (!empty($descargas)) {
        ?>
        <div class="row">
            <div class="col-lg-4">
                <div style="height: 14px;"></div>
                <h4 style="text-align: center;">Detalles</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list-group">
<!--                            <li class="list-group-item">
                                <span class="badge"><?php echo $fechainicio; ?></span>
                                Desde:
                            </li>
                            <li class="list-group-item">
                                <span class="badge"><?php echo $fechafin; ?></span>
                                Hasta:
                            </li>-->

                            <li class="list-group-item">
                                <span class="badge"><?php echo $total_llamadas; ?> Llamadas</span>
                                Total llamadas:
                            </li>

                            <?php
                            foreach ($descargas_chart['totales'] as $indice => $cant_total) {
                                ?>
                                <li class="list-group-item">
                                    <span class="badge"><?php echo $cant_total; ?></span>
                                    <?php echo get_estados($indice); ?>:
                                </li>
                                <?php
                            }
                            ?>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4" id="container-chart">
                Grafico Llamadas
            </div>

            <div class="col-lg-4" id="container-chart-tiempo">
                Duración de llamadas
            </div>

        </div>

        <?php
    }
    ?>

    <div class="clearfix" style="height: 10px;"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php echo @$template['title']; ?>
                    <div class="pull-right">
                        <a href="<?php echo base_url(); ?>index.php/inicio/excel_descargas" target="_blank" class="btn btn-success btn-xs">Exportar CVS</a>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                        <tr>
                            <th>Numero</th>
                            <th>Tipo</th>
                            <th>Fecha Hora Llamada</th>
                            <th>Duración LLamada</th>
                            <th>Resultado</th>
                            <th>Estado</th>
                        </tr>
                        <?php
                        $estados = get_estados();
                        if (!empty($descargas)) {
                            foreach ($descargas as $item) {
                                ?>
                                <tr>
                                    <td><?php echo $item['numero']; ?></td>
                                    <td><?php echo get_tipo(trim($item['numero'])); ?></td>
                                    <td><?php echo date("Y-m-d H:i", strtotime($item['llamada_fecha_hora'])); ?></td>
                                    <td><?php echo $item['llamada_duracion']; ?></td>
                                    <td>
                                        <?php
                                        if ($item['estado'] == 2) {
                                            echo get_estados_list($item['llamada_duracion']);
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $estados[$item['estado']]; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6">Sin registros</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div>
                <?php echo $links; ?>
            </div>
        </div>
    </div>
</div>