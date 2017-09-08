<?php
$nombre_servicio = $servicio['nombre_servicio'];
$descripcion_servicio = $servicio['descripcion_servicio'];
$url_servicio = $servicio['url_servicio'];
$itinerario = $servicio['itinerario'];
?>
<html>
<head>
	<title>Título de servicio.</title>
	<style type="text/css">
		body {
			font-family:Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
		}
		.header {
			padding: 0;
			margin: 0 0 6px 0;
			text-align: center;
		}

		.content {
			margin:0;
			padding: 0;
			font-size: 12px;
		}

		.content h1 {
			font-size: 20px;
			text-align: center;
			padding: 10px;
			margin: 0;
			color:#fff;
			background: #99C115;
			font-weight: normal;
		}

		.content .column-1, .content .column-2 {
			float: left;
		}

		.content .column-1 {
			background: #fff;
			width: 100%;
		}

		.content .column-2 {
			background: #D1F264;
			width: 100%;
			border-radius: 8px;
			border: solid 1px #5B7700;
		}

		.detalles {
			padding: 10px;
			font-size: 12px;
		}

		.detalles h4{
			font-size: 18px;
			font-weight: bold;
			color: #000;
			margin: 0;
			padding: 10px 0;
			text-align: center;
		}

		.detalles h3{
			font-size: 14px;
			font-weight: bold;
			color: #333;
			margin: 0;
			padding: 0;
		}

		.detalles p, .detalles ul li {
			font-size: 12px;
		}

		table tr td, table tr td div, , table tr td div p {
			font-size: 12px;
		}

		.footer {
			padding: 20px 0;
			text-align: center;
			display: block;
			float: left;
			width: 100%;
		}

		.footer a {
				color: #99C115;
				font-size: 14px;
				font-weight: bold;
				text-align: center;
		}

	</style>
</head>
<body>
<section class="header">
	<a href="<?php echo base_url();?>">
		<img src="<?php echo $cabeceras['logo'];?>" alt="<?php echo $website['title'];?>">
	</a>
</section>
<section class="content">
	<h1><?php echo $nombre_servicio;?></h1>
	<div style="text-align: center;"><a href="<?php echo $url_servicio;?>"><b>Ver en nuestro website.</b></a></div>
	<div class="column-1">
		<div class="detalles">
			<?php echo $descripcion_servicio;?>
		</div>
	</div>
	<div class="column-2">
		<div class="detalles">
			<h4>ITINERARIO</h4>
			<table>
			<?php
			if(!empty($busqueda_info)){
			$date_range = date_range($busqueda_info['dateDesde'], $busqueda_info['dateHasta']);
			}
			$iiDia = 1;
			foreach ($itinerario as $key => $value) {
				$urlImagen = (!empty($value['nombre_imagen'])) ? base_url($this->config->item('upload_path') . $value['nombre_imagen']) : base_url('assets/images/no-image.jpg') ;
				$str_fecha = (!empty($date_range[$key])) ? nice_date($date_range[$key], 'd/m/Y') : 'Día ' . $iiDia;
				?>
				<tr>
					<td>
						<div style="padding: 0 10px 0 0;">
							<p><strong><?php echo $str_fecha;?></strong></p>
							<h3><?php echo $value['titulo'];?></h3>
							<p style="text-align: justify;"><?php echo $value['descripcion'];?></p>
						</div>
					</td>
					<td style="width: 200px; vertical-align: middle;">
						<img src="<?php echo $urlImagen;?>" style="max-width: 200px;">
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<?php 
				$iiDia++;
			}
			?>
			</table>
		</div>
	</div>
</section>

</body>
</html>

