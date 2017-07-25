<?php
$sql_videos="SELECT * from tblvideos Where estado != 0 Order By id Desc Limit 5";
$rs_videos=mysql_query($sql_videos, $link);
?>
<h4 class="col-sm-12 well" data-toggle="collapse" data-target="#filters">Nos recomiendan:</h4>
<?php
if(mysql_num_rows($rs_videos) > 0){
 ?>
 <div class="row">
   <?php
   while ($fs_video = mysql_fetch_array($rs_videos)) {
     $youtube_id = getYoutubeId($fs_video['url']);
     $video_embed = "http://www.youtube.com/embed/".$youtube_id."?autoplay=1";
     ?>
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
       <div style="margin: 10px 0;" class="video-item">
         <a href="<?php echo $video_embed;?>" title="<?php echo $fs_video['titulo'];?>" class="various fancybox.iframe">
           <img src="<?php echo $fs_video['imagen'];?>" alt="<?php echo $fs_video['titulo'];?>" class="img-responsive">
         </a>
       </div>
     </div>
     <?php
   }
   ?>
 </div>
 <?php
}
?>
