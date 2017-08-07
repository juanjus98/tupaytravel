<?php
/*echo "<hr><pre>";
print_r($galeria);
echo "</pre>";*/
if(!empty($producto)){
	$imagen_file = "no-imagen.jpg";
	if (!empty($producto['imagen'])) {
		$imagen_file = $producto['imagen'];
	}

	$link =  base_url('p/' . $producto['url_key']);
}
?>
<section>
	<div class="container">
		<div class="cont-principal cont-detalle">
			<h1>DETALLE <small>PRODUCTO</small></h1>
			<div class="cont-producto">
				<div class="row">
					<div class="col-sm-5 col-md-5">
						<div class="cont-galeria">
							<img id="zoom_01" src="<?php echo base_url();?>imagens/w460_h460_at__<?php echo $imagen_file;?>" alt="<?php echo $item['nombre_largo']; ?>" data-zoom-image="<?php echo base_url('images/uploads/' . $imagen_file);?>" class="img-responsive">
						</div>
						<div id="gallery_01" class="cont-galeria-thumb">
							<a href="#" class="elevatezoom-gallery active" data-update="" data-image="<?php echo base_url();?>imagens/w460_h460_at__<?php echo $imagen_file;?>" data-zoom-image="<?php echo base_url('images/uploads/' . $imagen_file);?>">
								<img src="<?php echo base_url();?>imagens/w100_h100_at__<?php echo $imagen_file;?>" width="100"></a>
								<?php
								if(!empty($galeria)){
									foreach ($galeria as $key => $galeria_item) {
										$galeria_file = $galeria_item['imagen'];
										?>
										<a href="#" class="elevatezoom-gallery active" data-update="" data-image="<?php echo base_url();?>imagens/w460_h460_at__<?php echo $galeria_file;?>" data-zoom-image="<?php echo base_url('images/uploads/' . $galeria_file);?>">
											<img src="<?php echo base_url();?>imagens/w100_h100_at__<?php echo $galeria_file;?>" width="100"></a>
											<?php
										}
									}
									?>
								</div>
							</div>
							<div class="col-sm-7 col-md-7 padding-l-0">
								<div class="detalles-producto">
									<div class="cabecera-producto">
										<div class="row">
											<div class="col-sm-9 col-md-9">
												<h1><?php echo $producto['nombre_largo'];?></h1>
											</div>
											<div class="col-sm-3 col-md-3 padding-l-0">
												<div class="pull-right codigo-producto" data-toggle="tooltip" data-placement="top" title="Código del Producto"><span>Código:</span> <?php echo $producto['codigo'];?></div>
											</div>
										</div>
									</div>
									<p><?php echo str_replace("\n", "<br/>", $producto['resumen']);?></p>
									<div class="box-opciones">
										<div class="row">
											<div class="col-sm-4 col-md-4">
												<div class="box-colores">
													<h3>Colores</h3>
													<hr>
													<ul class="colores">
														<li class="active">
															<a href="#" class="option-color" data-color="Natural"><img src="<?php echo base_url('images/colores/Natural.png');?>" class="img-responsive"></a>
														</li>
														<li>
															<a href="#" class="option-color" data-color="Nogal"><img src="<?php echo base_url('images/colores/Nogal.png');?>" class="img-responsive"></a>
														</li>
														<li>
															<a href="#" class="option-color" data-color="Wengue"><img src="<?php echo base_url('images/colores/Wengue.jpg');?>" class="img-responsive"></a>
														</li>
														<li>
															<a href="#" class="option-color" data-color="Aya"><img src="<?php echo base_url('images/colores/Aya.jpg');?>" class="img-responsive"></a>
														</li>
														<li>
															<a href="#" class="option-color" data-color="Madera"><img src="<?php echo base_url('images/colores/Madera.jpg');?>" class="img-responsive"></a>
														</li>
													</ul>
												</div>
											</div>
											<div class="col-sm-8 col-md-8 padding-l-0">
												<form name="frm-product" id="frm-product" action="" method="post">
													<div class="box-cotizar">
														<h3>CANTIDAD</h3>
														<hr>
														<div class="box-cantidad">
															<div class="row">
																<div class="col-sm-5 col-md-5">
																	<div class="input-group" data-trigger="spinner">
																		<a href="javascript:;" class="btn input-group-addon" data-spin="down"><i class="fa fa-minus" aria-hidden="true"></i></a>
																		<input type="text" name="product[qty]" id="cantidad" class="form-control text-center input-cantidad" data-rule="quantity" data-max="10" value="1" readonly>
																		<a href="javascript:;" class="btn input-group-addon" data-spin="up"><i class="fa fa-plus" aria-hidden="true"></i></a>
																	</div>
																</div>
																<div class="col-sm-4 col-md-4 padding-l-0">
																	<p class="unidad-medida">Unidad(es)</p>
																</div>
															</div>

															<!--Producto infomaton-->
															<input type="hidden" name="product[id]" value="<?php echo $producto['id'];?>">
															<input type="hidden" name="product[code]" value="<?php echo $producto['codigo'];?>">
															<input type="hidden" name="product[price]" value="0">
															<input type="hidden" name="product[name]" value="<?php echo $producto['nombre_corto'];?>">

															<input type="hidden" name="product[options][color]" id="color" value="">
															<input type="hidden" name="product[options][img]" value="<?php echo base_url();?>imagens/w100_h100_at__<?php echo $imagen_file;?>">
															<input type="hidden" name="product[options][url]" value="<?php echo $link;?>">

															<div class="cont-btncotizar">
																<button type="button" class="btn btn-cotizar btn-block addtocart" data-idform="frm-product"><i class="fa fa-cart-plus"></i> Agregar para cotizar</button>
															</div>

														</div>
													</div>
												</form>
											</div>
										</div>
									</div>

									<div class="box-otros">
										<ul class="icons-opciones">
											<li><i class="fa fa-truck" aria-hidden="true"></i> ENVÍO GRATIS <span>Solo lima metropolitana.</span></li>
											<li><i class="fa fa-map-marker" aria-hidden="true"></i> Compra en tienda <span><a href="#" class="example21-t-2">Ver mapa</a></span></li>
											<li><i class="fa fa-volume-control-phone" aria-hidden="true"></i> Venta teléfonica <span>982536705</span></li>
										</ul>
									</div>

									<hr>
									<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=58d4b06d1a830a001152539b&product=inline-share-buttons"></script>
									<div class="sharethis-inline-share-buttons"></div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12 col-md-12">
								<!-- Nav tabs -->
								<div class="cont-tabs">
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active">
											<a href="#descripcion" aria-controls="descripcion" role="tab" data-toggle="tab">Descripción</a>
										</li>
										<li role="presentation">
											<a href="#especificaciones" aria-controls="especificaciones" role="tab" data-toggle="tab">Especificaciones</a>
										</li>
										<li role="presentation">
											<a href="#entrega" aria-controls="entrega" role="tab" data-toggle="tab">Entrega</a>
										</li>
										<li role="presentation">
											<a href="#pagos" aria-controls="pagos" role="tab" data-toggle="tab">Pagos</a>
										</li>
									</ul>

									<!-- Tab panes -->
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="descripcion">
											<?php
											echo $producto['descripcion'];
											?>
										</div>
										<div role="tabpanel" class="tab-pane fade" id="especificaciones">
											<table class="table table-striped">
		<!-- <thead>
		  <tr>
		    <th>Titulo</th>
		    <th>Descripción</th>
		    <th></th>
		  </tr>
		</thead> -->
		<tbody>
			<?php
			$especificaciones_titulo = $producto['especificaciones']['titulo'];
			$especificaciones_descripcion = $producto['especificaciones']['descripcion'];
			if (!empty($especificaciones_titulo)) {
				foreach ($especificaciones_titulo as $index => $titulo) {
					?>
					<tr class="row-table-rm">
						<th><?php echo $especificaciones_titulo[$index]; ?>:</th>
						<td><?php echo $especificaciones_descripcion[$index]; ?></td>
					</tr>
					<?php
				}
			} else {
				?>
				<tr>
					<th colspan="2"><center>Sin especificaciones.</center></th>
				</tr>
				<?php
			}
			?>

		</tbody>
	</table>
</div>
<div role="tabpanel" class="tab-pane fade" id="entrega">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
<div role="tabpanel" class="tab-pane fade" id="pagos">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passage..</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>