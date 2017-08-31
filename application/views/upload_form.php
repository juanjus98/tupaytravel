<html>
<head>
<title>Cargar imagen</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('welcome/upload/');?>

<input type="text" name="titulo"><br /><br />
<input type="file" name="userfile"/>

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>