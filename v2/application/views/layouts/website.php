<?php
/**
 * Website
 * Desarrollado por Juan Julio Sandoval Layza <juanjus98@gmail.com>
 */
$website_info = $this->website_info;
$telefono_1 = $website_info['telefono_1'];
$url_facebook = 'https://www.facebook.com/' . $website_info['url_facebook'];
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
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <title><?php echo $retVal = (@$template['title'] != 'Inicio') ? @$template['title'] . ' - ' : ''; ?> <?php echo $tag_title; ?></title>
  <meta name="description" content="<?php echo $tag_description; ?>">
  <meta name="author" content="<?php echo base64_decode("d2ViQXB1LmNvbQ=="); ?>">
  <meta name="keywords" content="<?php echo strip_tags($head_info['keywords']); ?>">
  <meta name="robots" content="index, follow">
  <!--Para facebook-->
  <meta property="og:title" content="<?php echo $tag_title; ?>">
  <meta property="og:description" content="<?php echo $tag_description; ?>">
  <meta property="og:url" content="<?php echo $tag_url; ?>" />
  <meta property="og:image" content="<?php echo $tag_image; ?>">
  <!-- <title> Muebles, Estantes, Escritorios, Separadores, Archivadores, Counter, Mesa | <?php echo @$template['title']; ?> </title> -->
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/select2/css/select2.min.css'); ?>">



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
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url('assets/icons/android-icon-192x192.png') ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/icons/favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/icons/favicon-96x96.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/icons/favicon-16x16.png') ?>">
<link rel="manifest" href="<?php echo base_url('assets/icons/manifest.json') ?>">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php echo base_url('assets/icons/ms-icon-144x144.png') ?>">
<meta name="theme-color" content="#ffffff">
<link rel="shortcut icon" href="<?php echo base_url('assets/icons/favicon.ico') ?>" type="image/x-icon">
<link rel="icon" href="<?php echo base_url('assets/icons/favicon.ico') ?>" type="image/x-icon">

<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=59836a81515dc700116604dd&product=inline-share-buttons' async='async'></script>

<script type="text/javascript">var base_url='<?php echo base_url();?>';</script>
</head>
<body>
<div class="container">
<div class="main brd-lr">
<!-- header-->
<div class="tool-bar" id="tool-bar">
  <div class="boxes">
    <div class="box box1">
      <h3>Hablemos por</h3>
      <p><a href="#"><i class="fa fa-skype" aria-hidden="true"></i> Skype</a></p>
    </div>
    <div class="box box2">
      <h3>Whatsapp</h3>
      <p><a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i> +51988878850</a></p>
    </div>
    <div class="box box3 hidden-xs">
      <h3>Escríbenos</h3>
      <p><a href="#">reservas@tupaytravel.com</a></p>
    </div>
    <div class="box box4 hidden-xs">
      <ul class="social-icons">
        <li><a href="" class="social-icon"> <i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        <li><a href="" class="social-icon"> <i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <li><a href="" class="social-icon"> <i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
      </ul>
    </div>
    <div class="box box5 hidden-xs">
      <div id="google_translate_element"></div>
      <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'es', includedLanguages: 'ar,de,en,es,fr,it,ja,pt,ru,zh-TW'}, 'google_translate_element');
        }
      </script>
      <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    </div>
  </div>
</div>
<!-- Logo y banner-->
<div class="head-bar">
  <div class="col-md-12">
    <h1 class="logo pull-left">
      <a href="#" title="">
        <img src="<?php echo base_url('assets/images/logo.png');?>" alt="">
      </a>
    </h1>
  </div>      
</div>
<!-- //Logo y banner-->
<!-- Menú-->
<div class="menu-bar">
  <nav class="navbar navbar-default navbar-wa">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <?php echo crear_menu(wamenu(), $active_link);?>
      <div class="pull-right menu-r">
        <a href="contactenos" class="btn btn-contactenos"><i class="fa fa-envelope-o" aria-hidden="true"></i> Contáctenos</a>
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

</div><!-- main brd-lr-->
</div><!-- container-->

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
<script src="<?php echo base_url('assets/plugins/select2/js/select2.min.js');?>" type="text/javascript"></script>
<!-- //select2-->

<script src="<?php echo base_url('assets/js/website.min.js');?>" type="text/javascript"></script>
<!-- JavaScript-->

<link href="https://fonts.googleapis.com/css?family=Pontano+Sans" rel="stylesheet">

    </body>
    </html>
