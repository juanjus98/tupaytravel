<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo @$template['title']; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1"><!--Escalable en cualquier dispositivo-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/general.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/font-awesome.min.css">

    <link rel="shortcut icon" href="<?php echo base_url() ?>favicon.ico">
    <script> var base_url = '<?php echo base_url(); ?>';</script>
    <?php //echo notify();?>
</head>

<body class="skin-wa">
    <header class="header">
        <a href="<?php echo base_url('waadmin');?>" class="logo">
            <?php echo $this->config->item('admin_name');?>
            <!-- <img src="<?php echo $this->config->item('admin_logo');?>" alt="<?php echo $this->config->item('admin_name');?>"> -->
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation"></nav>
    </header>

    <div class="clearfix"></div>   
    <?php echo @$template['body']; ?>
    <div class="clearfix"></div>

    <script src="<?php echo base_url() ?>plugins/jquery/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo base_url() ?>plugins/sticky/jquery.sticky.js"></script> -->

    <script type="text/javascript" src="<?php echo base_url() ?>js/general.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo base_url() ?>js/main.js"></script> -->

</body>
</html>