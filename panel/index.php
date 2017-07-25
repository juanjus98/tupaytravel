<?php
session_start();
include ("./../conectar.php");

$conexion = conectar(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE)or die('No pudo conectarse : '. mysql_error());

if(isset($_POST['error'])){
  $error = $_POST['error'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Acceso</title>
<link rel="icon" type="image/png" href="/images/favicon.ico" />
<script src="http://code.jquery.com/jquery.js"></script>
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
<script src="../js/bootstrap.min.js"></script>
</head>
<body background="../images/fondo.jpg">
<div class="container">
          <form id="form1" name="form1" method="post" >
              <div align="center">
                  <img src="../images/logo_1.png" class="img-responsive"/>
              </div>
              
          <div class="panel panel-primary">
                <table width="40%" height="40%" border="0" align="center" cellpadding="5" cellspacing="5" class="table">
                  
             <tr>
               <div class="panel-heading"> 
                  <td colspan="2" align="center">
                <h2 class="form-signin-heading">Acceso al Sistema</h2>
                <?php
                if(isset($error) == 1)
                echo '<div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    ¡Error! Por favor revise los datos de acceso.
                  </div>';
                  ?>
                </td>
               </div>
            <div class="panel-body" align="center">
            </tr>
            <tr>
            <td>
            <table width="40%" border="0" align="center">
                <tr>
                    <td width="18%" align="center"><span class="glyphicon glyphicon-user"></td>
                    <td width="82%" align="left"><input name="usuario" type="text" class="form-control" placeholder="Nombre de usuario" id="usuario"  maxlength="20" data-toggle="tooltip" data-placement="right" title="Ingrese su nombre de usuario" autofocus="autofocus" />
                      </td>
                  </tr>
                  <tr><td colspan="2">&nbsp;</td></tr>
                  <tr>
                    <td align="center"><span class="glyphicon glyphicon-eye-open"></td>
                    <td align="left"><input name="contrasenna" type="password" class="form-control" placeholder="Contraseña" id="contrasenna" maxlength="20" data-toggle="tooltip" data-placement="right" title="Ingrese su contraseÃ±a" />
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td align="center">
                        <button name="button" class="btn btn-lg btn-primary btn-block" type="submit"  id="button" data-toggle="tooltip" data-placement="right" title="Entrar al Sistema">Entrar</button>
                    </td>
                  </tr>          
                  </table>
             </td>
           </tr>
           </table>
           <div class="panel-heading">
              <div class="contenedor" align="center">
                <strong>Tupay <span class="glyphicon glyphicon-registration-mark" aria-hidden="true"></span> 2016</strong>
                <br>
                <strong><a href=""  style="color:white">Info</a> <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></strong>
              </div>
           </div> 
        </div>
        <input type="hidden" name="error" id="error" value="<?php echo $error;?>">

        </form>

        <?php
        if(isset($_POST['button'])){
            $user = trim($_POST['usuario']);
            $passwd = $_POST['contrasenna'];		
            			
            $sql_chk = mysql_query("SELECT id FROM tblusuario WHERE user='$user' AND password = '$passwd'",$conexion);// or die(mysql_error());
            if(!$sql_chk)
               $error=1;
            if(mysql_num_rows($sql_chk)==0){ // no esta disponible
                     $error=1;
            } else {
                echo "<script> window.location.href='main.php'</script>";
            }
        }
        ?>
</div> <!-- /container -->
</body>
</html>