<html>
<head>
	<title>Título de servicio.</title>
	<style type="text/css">
		body {
			font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
		}

		.formas_pago {
			padding: 10px 30px;
			margin: 0 auto;
			font-size: 12px;
			display: block;
			float: left;
			border: solid 3px #392713;
		}

		.formas_pago p {
			font-size: 12px;	
		}

		.formas_pago h2 {
			font-size: 14px;
			text-transform: uppercase;
			text-align: center;	
		}

	</style>
</head>
<body>
<section class="formas_pago">
	<h2><?php echo $formas_pago['nombre_corto']?></h2>
	<p><?php echo $formas_pago['resumen']?></p>
	<?php echo $formas_pago['descripcion1']?>
</section>
</body>
</html>

