<section class="main-container">
 <div class="row">
   <div class="col-md-4 col-sm-6">
     <form class="form-vertical" name="buscador" id="buscador" action="paquetes" method="post">
       <fieldset class="form-home">
         <div class="form-group">
           <label>Inicio de Tour desde Lima - Perú</label>
           <div class="input-group date">
             <input type="text" class="form-control" name="fecha_inicio" id="date_from" value="" >
             <span class="input-group-addon">
               <a href="javascript:;" id="fecha_inicio_show">
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
               <a href="javascript:;" id="fecha_fin_show">
                 <!-- <span class="glyphicon glyphicon-calendar"></span> -->
                 <i class="fa fa-calendar" aria-hidden="true"></i>
               </a>
             </span>
           </div>
         </div>
         <div class="form-group">
           <label for="nacionalidad">Nacionalidad</label>
           <input type="text" id="nacionalidad" name="nacionalidad" class="form-control">
         </div>
         <!-- <div class="row">
           <div class="col-xs-3">
             <label class="text-center btn-block">Adultos</label>
             <select name="adultos" id="adultos" class="form-control">
               <option value="0">0</option>
               <option value="1">1</option>
               <option value="2">2</option>
               <option value="3">3</option>
               <option value="4">4</option>
               <option value="5">5</option>
             </select>
             <p class="help-block text-center">+18 años.</p>
           </div>
           <div class="col-xs-3">
             <label class="text-center btn-block">Adolecentes</label>
             <select name="adolecentes" id="adolecentes" class="form-control">
               <option value="0">0</option>
               <option value="1">1</option>
               <option value="2">2</option>
               <option value="3">3</option>
               <option value="4">4</option>
               <option value="5">5</option>
             </select>
             <p class="help-block text-center">12-17</p>
           </div>
           <div class="col-xs-3">
             <label class="text-center btn-block">Ñiños</label>
             <select name="ninios" id="ninios" class="form-control">
               <option value="0">0</option>
               <option value="1">1</option>
               <option value="2">2</option>
               <option value="3">3</option>
               <option value="4">4</option>
               <option value="5">5</option>
             </select>
             <p class="help-block text-center">8-11</p>
           </div>
           <div class="col-xs-3">
             <label class="text-center btn-block">Infantes</label>
             <select name="infantes" id="infantes" class="form-control">
               <option value="0">0</option>
               <option value="1">1</option>
               <option value="2">2</option>
               <option value="3">3</option>
               <option value="4">4</option>
               <option value="5">5</option>
             </select>
             <p class="help-block text-center">3-7</p>
           </div>
         </div> -->
         <!-- <div class="row mrg-bot-15">
           <div class="col-md-12">
             <label>¿Con Estadia?</label> &nbsp;&nbsp;&nbsp;
             <label class="radio-inline">
               <input type="radio" name="estadia" id="estadia1" value="Si" checked> SI
             </label>
             <label class="radio-inline">
               <input type="radio" name="estadia" id="estadia2" value="No"> NO
             </label>
           </div>
         </div> -->
         <div class="row"> 
           <div class="col-md-12">
             <button id="buscar" class="btn btn-primary-1 btn-block" type="submit"><i class="fa fa-search" aria-hidden="true"></i> BUSCAR TOUR</button>
           </div>
         </div>
       </fieldset>
     </form>
   </div>
   <div class="col-md-8 col-sm-6">
     <h3 class="titulo_opciones">Nuestras promociones:</h3>
     <?php
     if(!empty($promociones)){
       ?>
       <div class="row">
         <?php
         foreach ($promociones as $key => $value) {
           $tituloPromo = $value['titulo'];
           /*$urlImagen = base_url('assets/images/uploads/' . $value['imagen']);*/
           $urlImagen = 'assets/images/uploads/' . $value['imagen'];
           ?>
           <div class="col-xs-6 col-md-4">
             <a href="<?php echo $value['url'];?>" target="<?php echo $value['target'];?>">
               <div class="cont-promo">
                 <span class="btn-block titulo-block"><?php echo $tituloPromo;?></span>
                 <img alt="<?php echo $tituloPromo;?>" data-src="<?php echo $urlImagen;?>" class="lozad img-responsive">
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
   </div>
 </div>
 <!--Nos recomiendan-->
 <div class="row">
   <div class="col-md-12">
     <div class="container-box">
       <h3 class="titulo_opciones">
         Ellos nos recomiendan
         <span class="clearfix visible-xs-block"></span>
         <span>
          <a href="https://www.youtube.com/channel/UCRIeYohcJ_u31-wDiOwRAFA" target="_blank">
            <i class="fa fa-youtube-play youtube-icon" aria-hidden="true"></i> Visita nuestro canal
          </a>
        </span>
      </h3>
      <?php
      if(!empty($videos)){
       ?>
       <ul id="content-slider" class="content-slider">
         <?php
           /*echo "<pre>";
           print_r($videos);
           echo "</pre>";*/
           foreach ($videos as $key => $value) {
             $youtube_id = getYoutubeId($value['url']);
             $video_embed = "http://www.youtube.com/embed/".$youtube_id."?autoplay=1"; 
             $video_titulo = $value['titulo'];
             //$video_imagen = 'http://img.youtube.com/vi/' . $youtube_id . '/0.jpg';
             //imagen
             $video_imagen = 'assets/images/uploads/' . $value['imagen'] ;
             ?>
             <li>
               <div class="cont-item">
                 <a data-fancybox href="<?php echo $video_embed;?>" title="<?php echo $video_titulo;?>" class="video">
                   <span class="fa fa-youtube-play"></span>
                   <img alt="<?php echo $video_titulo;?>" src="<?php echo $video_imagen;?>" class="img-responsive">
                 </a>
                 <?php //echo $youtube_id;?>
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
   </div>
 </div>
 <!-- Galería de fotos-->
 <div class="row">
   <div class="col-md-12">
     <div class="container-box">
       <h3 class="titulo_opciones">
         Galería de fotos
         <span class="clearfix visible-xs-block"></span>
         <span><a href="#"><i class="fa fa-camera-retro galeria-icon" aria-hidden="true"></i> Ver galería</a></span>
       </h3>
       <?php
       $fotos = array(
        array('titulo' => 'Fotos','imagen' => 'assets/images/fotos/2.jpg', 'url' => 'http://tupaytravel.com/fotos/', 'target' => '_blank'),
        array('titulo' => 'Fotos','imagen' => 'assets/images/fotos/3.jpg', 'url' => 'http://tupaytravel.com/fotos/', 'target' => '_blank'),
        array('titulo' => 'Fotos','imagen' => 'assets/images/fotos/4.jpg', 'url' => 'http://tupaytravel.com/fotos/', 'target' => '_blank'),
        array('titulo' => 'Fotos','imagen' => 'assets/images/fotos/5.jpg', 'url' => 'http://tupaytravel.com/fotos/', 'target' => '_blank'),
        array('titulo' => 'Fotos','imagen' => 'assets/images/fotos/6.jpg', 'url' => 'http://tupaytravel.com/fotos/', 'target' => '_blank'),
        array('titulo' => 'Fotos','imagen' => 'assets/images/fotos/7.jpg', 'url' => 'http://tupaytravel.com/fotos/', 'target' => '_blank'),
        array('titulo' => 'Fotos','imagen' => 'assets/images/fotos/8.jpg', 'url' => 'http://tupaytravel.com/fotos/', 'target' => '_blank'),
        array('titulo' => 'Fotos','imagen' => 'assets/images/fotos/9.jpg', 'url' => 'http://tupaytravel.com/fotos/', 'target' => '_blank'),
        array('titulo' => 'Fotos','imagen' => 'assets/images/fotos/10.jpg', 'url' => 'http://tupaytravel.com/fotos/', 'target' => '_blank'),
        array('titulo' => 'Fotos','imagen' => 'assets/images/fotos/11.jpg', 'url' => 'http://tupaytravel.com/fotos/', 'target' => '_blank'),
        array('titulo' => 'Fotos','imagen' => 'assets/images/fotos/12.jpg', 'url' => 'http://tupaytravel.com/fotos/', 'target' => '_blank'),
        array('titulo' => 'Fotos','imagen' => 'assets/images/fotos/13.jpg', 'url' => 'http://tupaytravel.com/fotos/', 'target' => '_blank'),
        array('titulo' => 'Fotos','imagen' => 'assets/images/fotos/14.jpg', 'url' => 'http://tupaytravel.com/fotos/', 'target' => '_blank'),
      );
      ?>
      <ul id="content-slider-fotos" class="content-slider">
        <?php
        foreach ($fotos as $key => $value) {
          ?>
          <li>
           <div class="cont-item">
             <a href="<?php echo $value['url'];?>" target="<?php echo $value['target'];?>" title="<?php echo $value['titulo'];?>" class="foto">
               <span class="fa fa-camera-retro"></span>
               <img alt="<?php echo $value['titulo'];?>" src="<?php echo $value['imagen'];?>" class="img-responsive">
             </a>
           </div>
         </li>
         <?php
       }
       ?>
       
     </ul>
   </div><!-- //container-box-->
 </div>
</div>
<!-- Paquetes, Tours y estadía-->
<div class="row">
 <div class="col-md-4">
   <div class="container-box">
     <h3 class="titulo_opciones">
       Paquetes Tour Perú 
       <span class="clearfix visible-xs-block"></span>
       <span>
         <a href="paquetes-tours">Ver más</a>
       </span>
     </h3>
     <div class="box-wscroll">
       <?php
       if(!empty($paquetes)){
         ?>
         <ul class="list-group container-list">
           <?php
           foreach ($paquetes as $key => $value) {
             $url_paquete = 'paquete-tour/' . $value['url_key'];
             ?>
             <li class="list-group-item">
               <a href="<?php echo $url_paquete;?>" class="text-capitalize to-emoji"><?php echo $value['nombre'];?></a>
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
 </div>
 <div class="col-md-4">
  <div class="container-box">
    <h3 class="titulo_opciones">
     Tours 
     <span class="clearfix visible-xs-block"></span>
     <span>
       <a href="<?php echo base_url('tours');?>">Ver más</a>
     </span>
   </h3>
   <div class="box-wscroll">
    <?php
    if(!empty($tours)){
     ?>
     <ul class="list-group container-list">
       <?php
       foreach ($tours as $key => $value) {
         $url_tour = 'tour/' . $value['url_key'];
         ?>
         <li class="list-group-item">
           <a href="<?php echo $url_tour;?>" class="text-capitalize to-emoji"><?php echo $value['nombre'];?></a>
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
</div>
<div class="col-md-4">
  <div class="container-box">
    <h3 class="titulo_opciones">
     Hoteles 
     <span class="clearfix visible-xs-block"></span>
 <!-- <span>
 <a href="#">Ver más</a>
</span> -->
</h3>
<div class="box-wscroll">
  <?php
  if(!empty($hoteles)){
   ?>
   <ul class="list-group container-list">
     <?php
     foreach ($hoteles as $key => $value) {
       /*$url_hotel = 'hotel/' . $value['url_key'];*/
       $url_hotel = base_url('hotel/' . $value['id_hotel'] . '/' . $value['url_key']);
       ?>
       <li class="list-group-item">
         <a href="<?php echo $url_hotel;?>" class="text-capitalize to-emoji"><?php echo $value['nombre'];?></a>
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
</div>
</div>
<!-- Bloques rápidos-->
<div class="row marg-t20 boxs-fast">
 <div class="col-md-6">
   <div class="box box-1 brd-2 text-center">
     <a href="p/formas-de-pago-rp" class="btn btn-lg btn-wa1" title="Formas de pago.">
       <i class="fa fa-credit-card" aria-hidden="true"></i> Formas de pago
     </a>
   </div>
 </div>
 <div class="col-md-6">
   <div class="box box-3 brd-2 text-center">
     <a href="<?php echo base_url('assets/images/cert-1.jpg');?>" class="btn btn-lg btn-wa2" title="Cetificados y Licencias" data-fancybox="images">
       <i class="fa fa-id-card" aria-hidden="true"></i> Cetificados y Licencias
     </a>
     <a href="<?php echo base_url('assets/images/cert-2.jpg');?>" data-fancybox="images"></a>
   </div>
 </div>
</div>
</section>