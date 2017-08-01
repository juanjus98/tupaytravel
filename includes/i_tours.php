<?php
$sql_tours="Select tbltours.* FROM tbltours ORDER BY nombre ASC";
$rs_tours=mysql_query($sql_tours, $link);
?>
<div class="container-box">
<h3 class="titulo_opciones">
  Tours 
  <div class="clearfix visible-xs-block"></div>
  <span>
    <a href="#">Ver más</a>
  </span>
</h3>
<div class="box-wscroll">
<?php
  if(mysql_num_rows($rs_tours) > 0){
    ?>
  <ul class="list-group container-list">
  <?php
      while ($fs_tour = mysql_fetch_array($rs_tours)) {
        $url_tour = 'tour/' . $fs_tour['id'] . '/' . url_amigable($fs_tour['nombre']) .'/';
    ?>
    <li class="list-group-item">
      <a href="<?php echo $url_tour;?>" class="text-capitalize to-emoji"><?php echo $fs_tour['nombre'];?></a>
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