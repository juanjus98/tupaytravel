<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo @$template['title']; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1"><!--Escalable en cualquier dispositivo-->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/waadmin.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css') ?>">

    <link rel="shortcut icon" href="<?php echo base_url('assets/icons/favicon.ico') ?>">
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

    <script src="<?php echo base_url('assets/plugins/jquery/jquery-3.1.1.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/icheck/icheck.js?v=1.0.2');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/waadmin.min.js') ?>"></script>

</body>
</html>