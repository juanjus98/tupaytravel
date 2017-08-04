<?php 
/*echo "<pre>";
print_r($listado);
echo "</pre>";*/
?>
<section>
<div class="container">
<div class="cont-principal cont-productos">
	<?php
	$titulos = divideTexto($categoria['nombre']);
	?>
	<h1><?php if(!empty($titulos[0])){ echo $titulos[0];}?> <small><?php if(!empty($titulos[1])){ echo $titulos[1];}?></small></h1>
	<div class="row">
		<?php
		if(!empty($listado)){
			foreach ($listado as $key => $item) {
			$imagen_file = "no-imagen.jpg";
			if (!empty($item['imagen'])) {
			  $imagen_file = $item['imagen'];
			}

			if($categoria['parent_id'] != 0){

			$link =  base_url('p/' . $item['url_key']);

		?>
		<div class="col-sm-6 col-md-3">
			<div class="thumbnail hvr-float-shadow">
				<a href="<?php echo $link;?>" title="<?php echo $item['nombre_largo']; ?>">
				<img src="<?php echo base_url();?>imagens/w367_h367_at__<?php echo $imagen_file;?>" alt="<?php echo $item['nombre_largo']; ?>">
				</a>
				<div class="caption">
					<h3><?php echo word_limiter($item['nombre_corto'], 4); ?></h3>
					<p>CÓDIGO:<?php echo $item['codigo'];?></p>
				</div>
				<div class="cont-buttons">
				<a href="<?php echo $link;?>" class="btn btn-detalles" role="button" title="<?php echo $item['nombre_largo']; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Detalles</a> 
				<a href="javascript:;" class="btn btn-cotizar addtocart pull-right" role="button" data-idform="form-<?php echo $item['id']; ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i> Cotizar</a>
				</div>
			</div>
			<!--Formulario para carrito-->
			<div style="display: none;">
			<form name="form-<?php echo $item['id']; ?>" id="form-<?php echo $item['id']; ?>" action="" method="post">
				<input type="hidden" name="product[qty]" value="1">
				<input type="hidden" name="product[id]" value="<?php echo $item['id']; ?>">
				<input type="hidden" name="product[code]" value="<?php echo $item['codigo']; ?>">
				<input type="hidden" name="product[price]" value="0">
				<input type="hidden" name="product[name]" value="<?php echo $item['nombre_corto']; ?>">
				<input type="hidden" name="product[options][color]" id="color" value="">
				<input type="hidden" name="product[options][img]" value="<?php echo base_url();?>imagens/w100_h100_at__<?php echo $imagen_file;?>">
				<input type="hidden" name="product[options][url]" value="<?php echo $link;?>">
			</form>
			</div>
			<!--//Formulario para carrito-->
		</div>

		<?php
	}else{
		$link =  base_url('c/' . $item['url_key']);
	?>
		<div class="col-sm-6 col-md-4 content-slider">
			<div class="thumbnail wa-thumbnail hvr-float-shadow">
				<a href="<?php echo $link;?>" title="<?php echo $item['nombre_largo']; ?>">
				<img src="<?php echo base_url();?>imagens/w400_h300_at__<?php echo $imagen_file;?>" alt="<?php echo $item['nombre_largo']; ?>">
				</a>
				<div class="caption bg-1">
					<h3><?php echo word_limiter($item['nombre'], 4); ?></h3>
					<!-- <p>CÓDIGO:<?php echo $item['codigo'];?></p> -->
				</div>
				<!-- <div class="cont-buttons">
					<a href="<?php echo $url_producto;?>" class="btn btn-detalles" role="button" title="<?php echo $item['nombre_largo']; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Detalles</a> 
					<a href="#" class="btn btn-cotizar pull-right" role="button"><i class="fa fa-cart-plus" aria-hidden="true"></i> Cotizar</a>
				</div> -->
			</div>
		</div>
	<?php
	} // End if parent_id
	} // End foreach $listado
	}else {
		?>
		<div class="col-sm-12 col-md-12">
		<div class="sin-registros">
			<i class="fa fa-frown-o" aria-hidden="true"></i> No se encontrarón registros.
		</div>
		</div>
		<?php
	}
		?>
	</div>

	<div class="row">
	<div class="col-sm-12 col-md-12">
		<nav aria-label="Page navigation">
			<?php echo $links; ?>
		</nav>
	</div>
	</div>

</div>
</div>
</section>