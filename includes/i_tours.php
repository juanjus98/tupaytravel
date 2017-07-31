<?php
$sql_tours="Select tbltours.* FROM tbltours WHERE tipo='Tradicional' and id_provincia='".$_GET['id']."' ORDER BY nombre ASC";

$rs_=mysql_query($sql_tours, $link);
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