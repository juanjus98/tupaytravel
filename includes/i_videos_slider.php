<?php
$sql_videos="SELECT * from tblvideos Where estado != 0 Order By orden Limit 8";
$rs_videos=mysql_query($sql_videos, $link);
?>
<div class="container-box">
  <h3 class="titulo_opciones">
  Ellos nos recomiendan 
  <div class="clearfix visible-xs-block"></div>
  <span><a href=""><i class="fa fa-youtube-play youtube-icon" aria-hidden="true"></i> Visita nuestro canal</a></span>
  </h3>
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
            <a href="<?php echo $video_embed;?>" title="<?php echo $fs_video['titulo'];?>" class="various video fancybox.iframe">
              <span class="fa fa-youtube-play"></span>
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
</div>