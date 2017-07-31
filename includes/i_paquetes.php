<?php
$sql_pquetes="SELECT count(tblpaquete_tour.id_paquete) as cant,tblpaquete_tour.id_paquete,
tblpaquete.nombre as name,tblpaquete.orden, tblpaquete.precio FROM tblpaquete_tour 
inner join tblpaquete on tblpaquete.id=tblpaquete_tour.id_paquete GROUP BY tblpaquete_tour.id_paquete";

$rs_paquetes=mysql_query($sql_pquetes, $link);
?>
<div class="container-box">
<h3 class="titulo_opciones">
  Paquetes Tour Perú 
  <div class="clearfix visible-xs-block"></div>
  <span>
    <a href="#">Ver más</a>
  </span>
</h3>
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