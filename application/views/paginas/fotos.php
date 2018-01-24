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
<?php
/*echo "<pre>";
print_r($galerias);
echo "</pre>";*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="IE=Edge">
 <title>Tupay Travel en Fotos</title>
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
 <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fancybox/dist/jquery.fancybox.min.css');?>" type="text/css" />
 

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


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-106441653-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-106441653-1');
</script>

 </head>
<body>

<div class="grid">

    <a data-fancybox="group" href="http://farm6.staticflickr.com/5444/17679973232_568353a624_b.jpg" data-caption="My caption1">
        <img src="http://st.houzz.com/simgs/7f618e340caf8d1c_15-1000/asian-landscape.jpg" width="250">
    </a>

    <a data-fancybox="group" href="http://farm8.staticflickr.com/7367/16426879675_e32ac817a8_b.jpg" data-caption="My caption2">
        <img src="http://st.houzz.com/simgs/7f618e340caf8d1c_15-1000/asian-landscape.jpg" width="250">
    </a>

    <a data-fancybox="group" href="http://farm8.staticflickr.com/7289/16207238089_0124105172_b.jpg" data-caption="My caption3">
        <img src="http://st.houzz.com/simgs/7f618e340caf8d1c_15-1000/asian-landscape.jpg" width="250">
    </a>

    <a href="#"><img src="http://st.houzz.com/simgs/63a18a8a008d4d2d_15-3579/traditional-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/bcf119ed013946de_15-1739/contemporary-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/af01732a0d23a798_15-6669/rustic-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/9351dd1300226ca7_15-5051/traditional-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/8511c53003205296_15-7228/beach-style-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/b151d63e02691dae_15-7522/farmhouse-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/17713aee00b8b8b7_15-7678/contemporary-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/9001c607024373e9_15-2696/traditional-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/93111938017af9bc_15-9856/contemporary-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/f3512a1300052564_15-4587/contemporary-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/52f1cab4020de25b_15-3918/mediterranean-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/7981aa8403c058e1_15-6222/mediterranean-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/0551552400b55756_15-5380/contemporary-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/5fa170b000f051c0_15-6732/farmhouse-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/3c3153270da524b2_15-9720/traditional-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/d931c502035da8da_15-1082/contemporary-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/db1177f003612e1b_15-7727/asian-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/7851611700608718_15-7654/farmhouse-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/36f1f14a036a87fd_15-1802/tropical-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/56b19bf80f7c817c_15-6711/traditional-landscape.jpg" width="250"></a>
    <a href="#"><img src="http://st.houzz.com/simgs/f601583f01cbd891_15-3060/traditional-landscape.jpg" width="250"></a>
</div>


</body>
<!-- JavaScript-->
<script src="//code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap.min.js');?>" type="text/javascript"></script>

<script src="<?php echo base_url('assets/plugins/fancybox/dist/jquery.fancybox.min.js');?>"></script>


<!-- Core JS file -->
<script type="text/javascript" src="<?php echo base_url('assets/plugins/gridify/gridify.js');?>"></script>
<script type="text/javascript">
    window.onload = function(){
        document.querySelector('.grid').gridify({srcNode: 'a img', margin: '20px', width: '250px', resizable: true});
    }
</script>


</html>