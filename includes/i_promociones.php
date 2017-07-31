<h3 class="titulo_opciones">Nuestras promociones:</h3>
<?php
$sql_promociones="SELECT * FROM tblpromociones WHERE estado != 0 ORDER BY orden LIMIT 6";
$rs_promociones=mysql_query($sql_promociones, $link);
?>
 <?php
 if(mysql_num_rows($rs_promociones) > 0){
   ?>
   <div class="row">
     <?php
     while ($fs_promocion = mysql_fetch_array($rs_promociones)) {
       ?>
        <div class="col-xs-6 col-md-4">
        <a href="<?php echo $fs_promocion['url'];?>" target="<?php echo $fs_promocion['target'];?>">
        <div class="cont-promo">
         <span class="btn-block titulo-block"><?php echo $fs_promocion['titulo'];?></span>
         <img src="images/uploads/<?php echo $fs_promocion['imagen'];?>" alt="<?php echo $fs_promocion['titlo'];?>" class="img-responsive">
        </div>
        </a>
        </div>
       <?php
     }
     ?>
   </div>
   <?php
 }
 ?>