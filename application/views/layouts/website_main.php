<?php
/**
 * Website
 * Desarrollado por Juan Julio Sandoval Layza <juanjus98@gmail.com>
 */
$website_info = $this->website_info;
$direccion = $website_info['direccion'];
$telefono_1 = $website_info['telefono_1'];
$telefono_2 = $website_info['telefono_2'];
$email_1 = $website_info['email_1'];
$email_2 = $website_info['email_2'];
$skype_user = 'skype:'.$website_info['skype'].'?call';
$facebook_messenger = 'https://m.me/' . $website_info['messenger']; //Messenger facebook
$whatsapp_messenger = 'https://api.whatsapp.com/send?phone=' . $telefono_2;
$url_facebook = 'https://www.facebook.com/' . $website_info['url_facebook'];
$url_twitter = 'https://twitter.com/' . $website_info['url_twitter'];
$url_youtube = 'https://www.youtube.com/user/' . $website_info['url_youtube'];
/**
 * Preparar tags en header
 */
$tag_title = str_replace(array('\r\n', '\r', '\n'), " ",strip_tags($head_info['title']));
$tag_description = $head_info['description'];
$tag_keywords = str_replace(array('\r\n', '\r', '\n'), " ",strip_tags($head_info['keywords']));
$tag_url = base_url() . uri_string();
$tag_image = $head_info['image'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="IE=Edge">
 <title><?php echo $retVal = (@$template['title'] != 'Inicio') ? @$template['title'] . ' - ' : ''; ?> <?php echo $tag_title; ?></title>
 <meta name="description" content="<?php echo $tag_description; ?>">
 <meta name="author" content="<?php echo base64_decode("d2ViQXB1LmNvbQ=="); ?>">
 <meta name="keywords" content="<?php echo strip_tags($head_info['keywords']); ?>">
 <meta name="robots" content="index, follow">
 <!--Para facebook-->
 <meta property="og:title" content="<?php echo $tag_title; ?>"/>
 <meta property="og:site_name" content="<?php echo $tag_title; ?>"/>
 <meta property="og:description" content="<?php echo $tag_description; ?>"/>
 <meta property="og:url" content="<?php echo $tag_url; ?>" />
 <meta property="og:image" content="<?php echo $tag_image; ?>"/>

 <meta property="fb:app_id" content="872929552871590" />

 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.min.css'); ?>">
 
 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
 <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('assets/icons/apple-icon-57x57.png') ?>">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('assets/icons/apple-icon-60x60.png') ?>">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('assets/icons/apple-icon-72x72.png') ?>">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/icons/apple-icon-76x76.png') ?>">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('assets/icons/apple-icon-114x114.png') ?>">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('assets/icons/apple-icon-120x120.png') ?>">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('assets/icons/apple-icon-144x144.png') ?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('assets/icons/apple-icon-152x152.png') ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/icons/apple-icon-180x180.png') ?>">
<link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url('assets/icons/android-icon-192x192.png') ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/icons/favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/icons/favicon-96x96.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/icons/favicon-16x16.png') ?>">
<link rel="manifest" href="<?php echo base_url('assets/icons/manifest.json') ?>">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo base_url('assets/icons/ms-icon-144x144.png') ?>">
<meta name="theme-color" content="#ffffff">
<link rel="shortcut icon" href="<?php echo base_url('assets/icons/favicon.ico') ?>" type="image/x-icon">
<link rel="icon" href="<?php echo base_url('assets/icons/favicon.ico') ?>" type="image/x-icon">

<script src="<?php echo base_url('assets/plugins/lozad/lozad.min.js');?>" type="text/javascript"></script>

<!--SHARE API-->
<?php if($actual_link == 'detalles'){ ?>
<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=59836a81515dc700116604dd&product=inline-share-buttons' async='async'></script>
<?php } ?>
<!--Start of Zendesk Chat Script-->
<script type="text/javascript">
 window.$zopim||(function(d,s){var z=$zopim=function(c){
   z._.push(c)},$=z.s=
   d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
     _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
     $.src='https://v2.zopim.com/?4djBSec4OHl4b786bXDsRHxsqN4T47rj';z.t=+new Date;$.
     type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
   </script>
   <!--End of Zendesk Chat Script-->
   <script type="text/javascript">
     var base_url='<?php echo base_url();?>';
     <?php echo $ack_msj = (isset($_GET['ack'])) ? "var ack_msj='" . $_GET['ack'] . "'" : '' ;?>
   </script>

 </head>
 <body>
  <div id="fb-root"></div>
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '872929552871590',
        xfbml      : true,
        version    : 'v2.10'
      });
      FB.AppEvents.logPageView();
    };

    (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
 </script>

 <div class="container">
   <div class="main brd-lr">
     <!-- header-->
     <div class="tool-bar" id="tool-bar">
       <div class="boxes">
         <div class="box box1">
           <h3>Hablemos por</h3>
           <p><a href="<?php echo $retVal = (!empty($skype_user)) ? $skype_user : '#' ; ?>" target="_blank" title="Hablemos por skype"><i class="fa fa-skype" aria-hidden="true"></i> Skype</a></p>
         </div>
         <div class="box box2">
           <h3>Whatsapp</h3>
           <p><a href="<?php echo $retVal = (!empty($whatsapp_messenger)) ? $whatsapp_messenger : '' ; ?>" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i> <?php echo $retVal = (!empty($telefono_2)) ? $telefono_2 : '' ; ?></a></p>
         </div>
         <div class="box box3 hidden-xs">
           <h3>Escríbenos</h3>
           <p><a href="mailto:<?php echo $retVal = (!empty($email_1)) ? $email_1 : '' ;?>?Subject=Contáctar"><?php echo $retVal = (!empty($email_1)) ? $email_1 : '' ;?></a></p>
         </div>
         <div class="box box4 hidden-xs">
           <ul class="social-icons">
             <li><a href="<?php echo $retVal = (!empty($url_facebook)) ? $url_facebook : '#' ; ?>" target="_blank" class="social-icon"> <i class="fa fa-facebook" aria-hidden="true"></i></a></li>
             <li><a href="<?php echo $retVal = (!empty($url_twitter)) ? $url_twitter : '#' ; ?>" target="_blank" class="social-icon"> <i class="fa fa-twitter" aria-hidden="true"></i></a></li>
             <li><a href="<?php echo $retVal = (!empty($url_youtube)) ? $url_youtube : '#' ; ?>" target="_blank" class="social-icon"> <i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
           </ul>
         </div>
         <!-- <div class="box box5 hidden-xs"></div> -->
       </div>
     </div>
     <!-- Logo y banner-->
     <div class="head-bar">
       <div class="col-md-12">
         <div class="logo pull-left">
           <a href="<?php echo base_url();?>" title="<?php echo $website_info['title']; ?>">
             <img alt="<?php echo $website_info['title']; ?>" data-src="<?php echo base_url('assets/images/logo.png');?>" class="lozad">
           </a>
         </div>
       </div> 
     </div>
     <!-- //Logo y banner-->
     <!-- Menú-->
     <div class="menu-bar">
       <nav class="navbar navbar-default navbar-wa">
         <div class="navbar-header">
           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
             <span class="sr-only">Menú</span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
         </div>
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"><?php echo crear_menu(wamenu(), $active_link);?>
           <div class="pull-right menu-r">
             <a href="<?php echo base_url('contactenos');?>" class="btn btn-contactenos"><i class="fa fa-envelope-o" aria-hidden="true"></i> Contáctenos</a>
           </div>
         </div>
         <!-- /.navbar-collapse -->
       </nav>
     </div>
     <!-- //Menu-->
     <!-- //header-->
     <!-- body-->
     <?php echo @$template['body']; ?>
     <!-- //body-->
     <!-- Footer-->
     <footer>
       <section class="nb-footer">
         <div class="row">
           <div class="col-md-4 col-sm-6">
             <div class="footer-single">
               <div class="footer-title"><h2>Información de Contácto</h2></div>
               <h1>
                 <?php echo $website_info['title'];?>
                 <?php //echo $website_info['description'];?>
               </h1>
               <address>
                 <strong>Oficina:</strong> <?php echo $retVal = (!empty($direccion)) ? $direccion : '' ; ?> <br>
                 <i class="fa fa-whatsapp"></i> <?php echo $retVal = (!empty($telefono_2)) ? $telefono_2 : '' ; ?><br>
                 <i class="fa fa-envelope"></i> <a href="mailto:<?php echo $retVal = (!empty($email_1)) ? $email_1 : '' ; ?>"><?php echo $retVal = (!empty($email_1)) ? $email_1 : '' ; ?></a><br>
               </address>
               <!-- <div class="fb-like" data-share="true" data-show-faces="false"></div> -->
           </div>
         </div>
         <div class="col-md-4 col-sm-6">
           <div class="footer-single useful-links">
             <div class="footer-title"><h2>Promociones</h2></div>
             <?php
             $promociones = $this->Promociones->listado(6,0);
             if(!empty($promociones)){
               ?>
               <ul class="list-unstyled">
                 <?php
                 foreach ($promociones as $key => $value) {
                   $tituloPromo = $value['titulo'];
                   ?>
                   <li><a href="<?php echo $value['url'];?>" title="<?php echo $tituloPromo;?>"><?php echo $tituloPromo;?> <i class="fa fa-angle-right pull-right"></i></a></li>
                   <?php } ?>
                 </ul>
                 <?php
               }
               ?>
             </div>
           </div>
           <div class="col-md-4 col-sm-6">
             <div class="footer-single useful-links">
               <div class="footer-title"><h2>Links Importantes<?php //echo $website_info['title'];?></h2></div>
               <ul class="list-unstyled">
                 <?php
                 $links = array(
                   array('title' => 'Formas de pago', 'url' => 'http://tupaytravel.com/p/formas-de-pago-rp', 'target' => '_self'),
                   array('title' => 'Contáctenos', 'url' => 'http://tupaytravel.com/contactenos', 'target' => '_self'),
                   array('title' => 'Facebook', 'url' => 'https://www.facebook.com/tupay.travel/', 'target' => '_blank'),
                   array('title' => 'Youtube', 'url' => 'https://www.youtube.com/channel/UCRIeYohcJ_u31-wDiOwRAFA', 'target' => '_blank'),
                 );
                 foreach ($links as $key => $value) {
                   echo '<li><a href="'.$value['url'].'" target="'.$value['target'].'">'.$value['title'].' <i class="fa fa-angle-right pull-right"></i></a></li>';
                 }
                 ?>
               </ul>
             </div>
           </div>
         </div>
       </section>
     </footer>
     <!-- //Footer-->
   </div><!-- main brd-lr-->
 </div><!-- container-->
 <!-- Multichat-->
 <div class="cont-multichat">
   <a href="https://m.me/tupay.travel" title="Facebook messenger" target="_blank">
     <img src="<?php echo base_url('assets/images/icon-messenger48.png');?>" alt="Facebook messenger">
   </a>
   <a href="<?php echo $retVal = (!empty($whatsapp_messenger)) ? $whatsapp_messenger : '' ; ?>" title="Whatsapp" target="_blank">
     <img src="<?php echo base_url('assets/images/icon-whatsapp48.png');?>" alt="Whatsapp">
   </a>
 </div>
 <!-- //Multichat-->

 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">

 <!-- JavaScript-->
 <script src="<?php echo base_url('assets/plugins/jquery/jquery-3.1.1.min.js');?>" type="text/javascript"></script>
 <script src="<?php echo base_url('assets/plugins/bootstrap.min.js');?>" type="text/javascript"></script>
 <!-- jquery-ui-->
 <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jquery-ui/jquery-ui.min.css');?>">
 <script src="<?php echo base_url('assets/plugins/jquery-ui/jquery-ui.min.js');?>"></script>
 <!-- //jquery-ui-->
 <!-- lightslider-->
 <link href="<?php echo base_url('assets/plugins/lightslider/css/lightslider.min.css');?>" rel="stylesheet"/>
 <script src="<?php echo base_url('assets/plugins/lightslider/js/lightslider.min.js');?>"></script>
 <!-- //lightslider-->
 <!-- fancybox-->
 <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fancybox/dist/jquery.fancybox.min.css');?>" />
 <script src="<?php echo base_url('assets/plugins/fancybox/dist/jquery.fancybox.min.js');?>"></script>
 <!-- //fancybox-->
 
 <!-- sticky-->
 <script type="text/javascript" src="<?php echo base_url('assets/plugins/sticky/jquery.sticky.js');?>"></script>
 <!-- sticky-->

 <!-- slimscroll-->
 <script type="text/javascript" src="<?php echo base_url('assets/plugins/slimscroll/jquery.slimscroll.js');?>"></script>
 <!-- //slimscroll-->
 <!-- emoji-->
 <script src="<?php echo base_url('assets/plugins/emoji/emoji.js');?>" type="text/javascript"></script>
 <!-- //emoji-->
 <!-- select2-->
 <?php //if($actual_link == 'detalles'){ ?>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/select2/css/select2.min.css'); ?>">
 <script src="<?php echo base_url('assets/plugins/select2/js/select2.min.js');?>" type="text/javascript"></script>
 <?php //} ?>
 <!-- //select2-->
 <!-- bootstrap-validator-->
 <?php //if($actual_link == 'detalles'){ ?>
 <script src="<?php echo base_url('assets/plugins/bootstrap-validator/validator.min.js');?>" type="text/javascript"></script>
 <?php //} ?>
 <!-- //bootstrap-validator-->
 <script src="<?php echo base_url('assets/js/website.min.js');?>" type="text/javascript"></script>
 <!-- JavaScript-->
 <!-- <link href="https://fonts.googleapis.com/css?family=Pontano+Sans" rel="stylesheet"> -->
 <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,300i,600,700,800" rel="stylesheet">
</body>
</html>
<?php
//echo $actual_link;
?>