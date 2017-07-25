<?php
$sql_videos="SELECT * from tblvideos Where estado != 0 Order By orden Limit 8";
$rs_videos=mysql_query($sql_videos, $link);
?>
<div class="container-videos">
  <h3>Nos recomiendan:</h3>
  <?php
  if(mysql_num_rows($rs_videos) > 0){
    ?>
    <ul id="content-slider" class="content-slider">
      <?php
      while ($fs_video = mysql_fetch_array($rs_videos)) {
        $youtube_id = getYoutubeId($fs_video['url']);
        $video_embed = "http://www.youtube.com/embed/".$youtube_id."?autoplay=1"; 
        ?>
        <li>
          <div class="video-item">
            <a href="<?php echo $video_embed;?>" title="<?php echo $fs_video['titulo'];?>" class="various fancybox.iframe">
              <img src="<?php echo $fs_video['imagen'];?>" alt="<?php echo $fs_video['titulo'];?>" class="img-responsive">
            </a>
          </div>
        </li>
        <?php
      }
      ?>
    </ul>
    <?php
  }
  ?>
  <div align="right">
    <a href="https://www.youtube.com/channel/UCRIeYohcJ_u31-wDiOwRAFA" target="_blank">
      <img src="images/ver-mas.png" alt="Ver mas videos"><br />
    </a>
  </div>
  <!-- <div align="center">
    <a href="http://tupaytravel.com/fotos/" target="_blank">
      <img src="images/fotos.png" alt="Ver mas videos"><br />
    </a>
  </div> -->
</div>