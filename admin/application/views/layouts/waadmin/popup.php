<?php
$user_info = $this->user_info;
/*echo "<pre>";
print_r($user_info);
echo "</pre>";
die();*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo @$template['title']; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1"><!--Escalable en cualquier dispositivo-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/general.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="<?php echo base_url() ?>favicon.ico">
    <script type="text/javascript">var base_url='<?php echo base_url('admin');?>';</script>
    <?php //echo notify();?>

</head>
<body class="skin-wa">
        <div class="wrapper row-offcanvas row-offcanvas-left">
          <!-- Right side column. Contains the navbar and content of the page -->
          <aside class="right-side strech">                
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?php echo $wa_menu;?>
                    <small><?php echo $wa_modulo;?></small>
                </h1>
                <!-- <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Blank page</li>
                </ol> -->
            </section>

            <!-- Main content -->
            <section class="content">
               <?php echo @$template['body']; ?>
           </section><!-- /.content -->

       </aside><!-- /.right-side -->
   </div><!-- ./wrapper -->

   <script src="<?php echo base_url() ?>plugins/jquery/jquery-3.1.1.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
   <script src="<?php echo base_url() ?>plugins/js-cookie/js.cookie.js"></script>

   <!-- <script src="<?php echo base_url() ?>plugins/ckeditor/ckeditor.js" type="text/javascript"></script> -->

   <script type="text/javascript" src="<?php echo base_url() ?>js/general.min.js"></script>
   

</body>

</html>

