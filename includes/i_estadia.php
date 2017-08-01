<?php
$sql_hoteles="Select * FROM tblhotel Order By nombre ASC";
$rs_hoteles=mysql_query($sql_hoteles, $link);
?>
<div class="container-box">
<h3 class="titulo_opciones">
  Estadía 
  <div class="clearfix visible-xs-block"></div>
  <span>
    <a href="#">Ver más</a>
  </span>
</h3>
<div class="box-wscroll">
<?php
  if(mysql_num_rows($rs_hoteles) > 0){
    ?>
  <ul class="list-group container-list">
  <?php
      while ($fs_hotel = mysql_fetch_array($rs_hoteles)) {
        $url_hotel = 'hotel/' . $fs_hotel['id_hotel'] . '/' . url_amigable($fs_hotel['nombre']) .'/';
    ?>
    <li class="list-group-item">
      <a href="<?php echo $url_hotel;?>" class="text-capitalize to-emoji"><?php echo $fs_hotel['nombre'];?></a>
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