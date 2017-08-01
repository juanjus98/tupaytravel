<form class="form-vertical" name="buscador" id="buscador" action="tours/" method="post">
 <fieldset class="form-home">
  <div class="form-group">
    <label>Inicio de Tour desde Lima - Perú</label>
    <div class="input-group date">
      <input type="text" class="form-control" name="fecha_inicio" id="date_from" value="" >
      <span class="input-group-addon">
        <a href="#" id="fecha_inicio_show">
          <!-- <span class="glyphicon glyphicon-calendar"></span> -->
          <i class="fa fa-calendar" aria-hidden="true"></i>
        </a>
      </span>
    </div>
  </div>

  <div class="form-group">
    <label>Fin de Tour desde Lima - Perú</label>
    <div class="input-group date">
      <input type="text" class="form-control" name="fecha_fin" id="date_to" value="">
      <span class="input-group-addon">
        <a href="#" id="fecha_fin_show">
          <!-- <span class="glyphicon glyphicon-calendar"></span> -->
          <i class="fa fa-calendar" aria-hidden="true"></i>
        </a>
      </span>
    </div>
  </div>

  <div class="row"> 
    <div class="col-md-12">
      <button id="buscar" class="btn btn-primary-1 btn-block" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Filtrar</button>
    </div>
  </div>
</fieldset>
<!-- Provincias tblprovincia-->
<fieldset>
<?php
$sql_pquetes="SELECT count(tblpaquete_tour.id_paquete) as cant,tblpaquete_tour.id_paquete,
tblpaquete.nombre as name,tblpaquete.orden, tblpaquete.precio FROM tblpaquete_tour 
inner join tblpaquete on tblpaquete.id=tblpaquete_tour.id_paquete GROUP BY tblpaquete_tour.id_paquete";

$rs_paquetes=mysql_query($sql_pquetes, $link);
?>
<div class="container-box">
<h3 class="titulo_opciones">Seleccionar Provincia</h3>
<div class="box-wscroll">
<?php
  if(mysql_num_rows($rs_paquetes) > 0){
    ?>
  <ul class="list-group container-list">
  <?php
      while ($fs_paquete = mysql_fetch_array($rs_paquetes)) {
        $url_paquete = 'paquete/' . $fs_paquete['id_paquete'] . '/' . url_amigable($fs_paquete['name']) .'/';
    ?>
    <li class="list-group-item">
      <a href="<?php echo $url_paquete;?>" class="text-capitalize to-emoji"><?php echo $fs_paquete['name'];?></a>
    </li>
    <?php
      }
    ?>
  </ul>
<?php
 }
?>
</div>
</div>
</fieldset>
</form>