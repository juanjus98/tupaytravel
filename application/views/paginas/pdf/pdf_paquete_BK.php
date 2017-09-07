<?php
/*echo "<pre>";
print_r();
echo "</pre>";*/

$nombre_servicio = $servicio['nombre_servicio'];
$descripcion_servicio = $servicio['descripcion_servicio'];
$url_servicio = $servicio['url_servicio'];
$itinerario = $servicio['itinerario'];

?>
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
	<tbody>
		<tr>
			<td align="center" valign="top">
				<div>
					<a href="#">
						<img src="<?php echo $cabeceras['logo'];?>" alt="<?php echo utf8_decode($website['title']);?>" style="max-height: 100px;">
					</a>
				</div>
				<table border="0" cellpadding="0" cellspacing="0" style="background-color:#fdfdfd;border:1px solid #dcdcdc;border-radius:3px!important; margin-top: 10px;">
					<tbody>
						<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:<?php echo $cabeceras['color'];?>;border-radius:3px 3px 0 0!important;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif">
									<tbody>
										<tr>
											<td style="padding:36px 48px;display:block">
												<h1 style="color:#ffffff;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;text-align:left">
													<?php echo utf8_decode($nombre_servicio);?>
												</h1>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" >
									<tbody>
										<tr>
											<td valign="top" style="background-color:#fdfdfd">
												<table border="0" cellpadding="20" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td style="padding: 0 40px;">
																<?php

																if(!empty($busqueda_info)){
																	$date_range = date_range($busqueda_info['dateDesde'], $busqueda_info['dateHasta']);
																}

																?>
																<table style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:12px;">
																	<tr>
																		<td colspan="2">
																			<!-- <h2 style="margin:6px 0;"><?php echo $nombre_servicio;?></h2> -->
																			<p><a href="<?php echo $url_servicio;?>" target="_blank"><?php echo utf8_decode('Ver detalles en la página web.');?></a></p>
																			<?php echo $descripcion_servicio;?>
																		</td>
																	</tr>
																	<tr>
																		<td colspan="2">&nbsp;</td>
																	</tr>
																	<tr>
																		<td colspan="2">&nbsp;</td>
																	</tr>
																	<!-- <tr>
																		<td colspan="2">
																			<hr>
																		</td>
																	</tr> -->
																	<tr>
																		<td colspan="2">
																			<h2 style="margin:6px 0;">Itinerario:</h2>
																		</td>
																	</tr>
																	<?php
																	$iiDia = 1;
																	foreach ($itinerario as $key => $value) {
																		$urlImagen = (!empty($value['nombre_imagen'])) ? base_url($this->config->item('upload_path') . $value['nombre_imagen']) : base_url('assets/images/no-image.jpg') ;
																		$str_fecha = (!empty($date_range[$key])) ? nice_date($date_range[$key], 'd/m/Y') : utf8_decode('Día ') . $iiDia;
																		?>
																		<tr>
																			<td style="vertical-align: top;">
																				<div style="padding: 0 10px 0 0;">
																					<p style="color: #333;"><?php echo $str_fecha;?></p>
																					<h3 style="margin:6px 0;"><?php echo utf8_decode($value['titulo']);?></h3>
																					<p style="text-align: justify;"><?php echo utf8_decode($value['descripcion']);?></p>
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
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
								<span style="font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif; font-size: 12px; margin-top:20px; display: block;">
									<font color="#888888">&copy; <?php echo utf8_decode($website['title']);?></font>
								</span>
							</td>
						</tr>
						<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="10" cellspacing="0" width="600"><tbody><tr>
									<td valign="top" style="padding:0">
										<table border="0" cellpadding="10" cellspacing="0" width="100%">
											<tbody>
												<tr>
													<td colspan="2" valign="middle" style="padding:0 48px 48px 48px;border:0;color:#99b1c7;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
														<p><a href="<?php echo "//" . $cabeceras['dominio']; ?>" target="_blank"><?php echo $cabeceras['dominio']; ?></a></p>
													</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</td>
</tr>
</tbody>
</table>