<?php
$nombre = $servicio_info['nombre'];
$id_info = $servicio_info['id'];
$tipo_info = $servicio_info['tipo_info'];
?>
<div class="modal fade wa-modal" id="modal-reservar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form name="form-reservar-completar" id="form-reservar-completar" action="<?php echo base_url('reservar');?>" method="post" data-toggle="validator">
        <input type="hidden" name="tipo_info" value="<?php echo $tipo_info;?>">
        <input type="hidden" name="id_info" value="<?php echo $id_info;?>">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Por último solo completa el siguiente formulario.</h4>
        </div>
        <div class="modal-body">
          <?php
          /*echo "<hr><pre>";
          print_r($servicio_info);
          echo "</pre>AQUI";*/
          ?>
          <div class="row">
            <div class="col-xs-12 col-md-5">
              <p class="lead">Reservar <span class="text-success"><?php echo $nombre;?></span></p>
              <ul id="list-form-data" class="list-unstyled" style="line-height: 2">
                <?php
                if(!empty($busqueda_info)){
                  ?>
                  <li>
                    <span class="fa fa-check text-success"></span> Fechas elegidas: <?php echo date('d/m/Y',strtotime($busqueda_info['dateDesde']))?> - <?php echo date('d/m/Y',strtotime($busqueda_info['dateHasta']))?>
                    <input type="hidden" name="dateDesde" value="<?php echo $busqueda_info['dateDesde'];?>">
                    <input type="hidden" name="dateHasta" value="<?php echo $busqueda_info['dateHasta'];?>">
                  </li>
                  <?php }?>
                  <!-- <li><span class="fa fa-check text-success"></span> See all your orders</li>-->
                </ul>
              </div>
              <div class="col-xs-12 col-md-7">
                <div class="well">
                  <div class="form-group has-feedback">
                    <label for="nombres" class="control-label">Nombres y apellidos:</label>
                    <input type="text" name="nombres" id="nombres" class="form-control" value="" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group has-feedback">
                        <label for="telefono" class="control-label">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="form-group has-feedback">
                        <label for="celular" class="control-label">Celular:</label>
                        <input type="text" name="celular" id="celular" class="form-control" value="" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group has-feedback">
                    <label for="email" class="control-label">Correo electrónico:</label>
                    <input type="email" name="email" id="email" class="form-control" value="" required>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  </div>

                  <div class="form-group">
                    <label for="email" class="control-label">Mensaje:</label>
                    <textarea name="mensaje" id="mensaje" class="form-control" rows="4"></textarea>
                  </div>
                </div>
              </div>

            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              <i class="fa fa-times" aria-hidden="true"></i> Cancelar
            </button>
            <!-- <button type="button" class="btn btn-primary">Enviar</button> -->
            <button class="btn btn-primary-1" type="submit">
              <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Enviar.
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>