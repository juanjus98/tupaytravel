<?php
/*echo "<pre>";
print_r($carrito);
echo "</pre>";*/
?>
<section>
<div class="container">
<div class="cont-principal">
<h1>Solicitar <small>Cotización</small></h1>
<div class="cont-cotizador">
<div class="row">
<div class="col-sm-12 col-md-12">
<h3>Solicitar cotización: <span class="gratis pull-right">¡Es gratis!</span></h3>
<hr>
</div>
<div class="col-sm-8 col-md-8">
<div class="alert alert-warning" role="alert">Si desea realizar una cotización ahora mismo, complete el siguiente formulario. Somos FyB Mueblería Belén S.A.C., especialistas en muebles para la oficina y el hogar.</div>
<form name="cart-form" id="cart-form" action=""  method="post">
<div class="table-responsive">
      <table class="table table-striped table-carrito">            
        <thead>
          <tr>
            <th colspan="2" class="text-center">Producto</th>
            <th class="text-center" style="width: 130px;">Cantidad</th>
            <th class="text-center">Eliminar</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $btn_disabled = 'disabled';
        if(!empty($carrito)){
          $btn_disabled = '';
          $ii=0;
          foreach ($carrito as $key => $values) {
            $ii++;
            $imagen = $values['options']['img'];
            $link = $values['options']['url'];
        ?>
          <tr id="row_<?php echo $values['rowid'];?>">
            <td class="text-center">
              <a href="<?php echo $link;?>" title="<?php echo $values['name'];?>">
                <img src="<?php echo $imagen;?>" alt="<?php echo $values['name'];?>" style="max-height: 60px;">
              </a>
            </td>
            <td>
            <a href="<?php echo $link;?>" title="<?php echo $values['name'];?>">
              <?php echo $values['name'];?>
            </a>
            </td>
            <td class="text-center">
            <!-- <form name="frm_<?php echo $ii;?>" id="frm_<?php echo $ii;?>"> -->
              <input type="hidden" name="rowid" id="rowid" value="<?php echo $values['rowid'];?>">
              <div class="input-group" style="margin: 0 auto;" data-trigger="spinner">
                <a href="javascript:;" class="btn btn-change-qty input-group-addon" data-spin="down" data-rowid="<?php echo $values['rowid'];?>">
                  <i class="fa fa-minus" aria-hidden="true"></i>
                </a>
                <input type="text" name="qty" id="qty" class="form-control text-center input-cantidad" data-rule="quantity" data-max="10" value="<?php echo $values['qty'];?>" readonly>
                <a href="javascript:;" class="btn btn-change-qty input-group-addon" data-spin="up" data-rowid="<?php echo $values['rowid'];?>">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
              </div>
              <!-- </form> -->
            </td>
            <td class="text-center">
              <a href="javascript:;" class="del-cart" data-rowid="<?php echo $values['rowid'];?>" data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</a>
            </td>
          </tr>
          <?php
          }
        }else{
          ?>
          <tr>
            <td colspan="4" class="text-center"><h4>Sin registros.</h4></td>
          </tr>
          <?php
        }
          ?>
        </tbody>
      </table>
      </div>
    </form>
</div>

<div class="col-sm-4 col-md-4">
<div class="form-right">
<h3 class="text-center">Información de contácto</h3>
<hr>
<form name="form-cotizar" id="form-cotizar" action="" method="post">
  <div class="form-group">
    <label for="empresa">Empresa:</label>
    <input type="text" name="empresa" id="empresa" class="form-control" placeholder="Empresa">
    <?php echo form_error('empresa', '<div class="text-danger">', '</div>'); ?>
  </div>
  <div class="form-group">
    <label for="nombres">Nombres y Apellidos:</label>
    <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres y Apellidos">
    <?php echo form_error('nombres', '<div class="text-danger">', '</div>'); ?>
  </div>
  <div class="form-group">
    <label for="email">Correo:</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="Ejm: juanjus@gmail.com">
    <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
  </div>

  <div class="form-group">
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono">
    <?php echo form_error('telefono', '<div class="text-danger">', '</div>'); ?>
  </div>

  <div class="form-group">
    <label for="mensaje">Mensaje:</label>
    <textarea name="mensaje" id="mensaje" class="form-control" placeholder="Teléfono"></textarea>
    <!-- <input type="text" name="mensaje" id="mensaje" class="form-control" placeholder="Teléfono"> -->
  </div>

  <button type="submit" class="btn btn-lg btn-form btn-block" <?php echo $btn_disabled;?>>Solicitar cotización</button>
</form>
</div>
</div>
</div>

</div>
</div>
</div>
</section>