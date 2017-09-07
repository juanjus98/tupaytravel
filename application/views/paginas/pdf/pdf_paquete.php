<?php
$nombre_servicio = $servicio['nombre_servicio'];
$descripcion_servicio = $servicio['descripcion_servicio'];
$url_servicio = $servicio['url_servicio'];
$itinerario = $servicio['itinerario'];
?>
<html>
<head>
	<title>Título de servicio.</title>
</head>
<body>
	<table>
		<tbody>

			<tr>
				<td style="text-align: center;">
					<a href="#">
						<img src="<?php echo $cabeceras['logo'];?>" alt="<?php echo $website['title'];?>">
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<h1 style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;">
						<?php echo $nombre_servicio;?>
					</h1>
				</td>
			</tr>

			<tr>
				<td>
					<?php

					if(!empty($busqueda_info)){
						$date_range = date_range($busqueda_info['dateDesde'], $busqueda_info['dateHasta']);
					}

					?>
					<table style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:12px;">
						<tr>
							<td colspan="2">
								<!-- <h2 style="margin:6px 0;"><?php echo $nombre_servicio;?></h2> -->
								<p><a href="<?php echo $url_servicio;?>" target="_blank"><?php echo 'Ver detalles en la página web.';?></a></p>
								<?php echo $descripcion_servicio;?>
							</td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">
								<h2 style="margin:6px 0;">Itinerario:</h2>
							</td>
						</tr>
						<?php
						$iiDia = 1;
						foreach ($itinerario as $key => $value) {
							$urlImagen = (!empty($value['nombre_imagen'])) ? base_url($this->config->item('upload_path') . $value['nombre_imagen']) : base_url('assets/images/no-image.jpg') ;
							$str_fecha = (!empty($date_range[$key])) ? nice_date($date_range[$key], 'd/m/Y') : 'Día ' . $iiDia;
							?>
							<tr>
								<td style="vertical-align: top;">
									<div style="padding: 0 10px 0 0;">
										<p style="color: #333;"><?php echo $str_fecha;?></p>
										<h3 style="margin:6px 0;"><?php echo $value['titulo'];?></h3>
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
				</td>
			</tr>

			<tr>
				<td colspan="2" valign="middle" style="padding:0 48px 48px 48px;border:0;color:#99b1c7;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
					<p><a href="<?php echo "//" . $cabeceras['dominio']; ?>" target="_blank"><?php echo $cabeceras['dominio']; ?></a></p>
				</td>
			</tr>
		</tbody>
	</table>

</body>
</html>

