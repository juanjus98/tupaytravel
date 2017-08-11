<?php
/*echo '<pre>';
print_r($administrador);
echo '</pre>';*/
/*echo $wa_tipo;*/

$disabled = ($wa_tipo === 'V') ? "disabled" : "";
?>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<form class="form-horizontal" name="edit_form" id="edit_form" action="" method="post" role="form" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $post['id'];?>">
				<div class="box-header" style="padding-bottom: 0;">
					<h3 class="box-title"><?php echo $tipo; ?></h3>
					<div class="box-tools">
						<div class="pull-right">
							<?php
							if($wa_tipo == 'C' || $wa_tipo == 'E'){
								?>
								<button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
								<a href="<?php echo $back_url;?>" class="btn btn-default btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
								<?php
							}
							if($wa_tipo == 'V'){
								?>
								<a class="btn btn-success btn-sm" title="Editar registro" href="<?php echo $edit_url;?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>

								<?php }?>
							</div>
						</div> 
					</div>

					<div class="box-body">
						<?php echo msj();?>
						<div class="row">
							<div class="col-sm-12">

								<table class="table table-bordered">
									<thead class="thead-default">
										<tr>
											<th><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;Información.</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="form-group" style="margin-bottom: 0px;">
													<label for="title" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> Nombre:</label>
													<div class="col-sm-8">
														<input class="form-control input-sm" id="title" name="title" type="text" value="<?php echo $retVal = (!empty($post['title'])) ? $post['title'] : '';?>" <?php echo $disabled;?>>
														<?php echo form_error('title'); ?>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group" style="margin-bottom: 0px;">
													<label for="description" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> Descripción:</label>
													<div class="col-sm-8">
														<textarea name="description" id="description" rows="3" class="form-control input-sm" <?php echo $disabled;?>><?php echo $retVal = (!empty($post['description'])) ? $post['description'] : '';?></textarea>
														<?php echo form_error('description'); ?>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td colspan="4" style="vertical-align: middle;">
												<div class="form-group" style="margin-bottom: 0px;">
													<label for="keywords" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> Keywords:</label>
													<div class="col-sm-8">
														<input type="text" name="keywords" id="keywords" data-role="tagsinput" value="<?php echo $post['keywords'];?>" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table><br>
								<table class="table table-bordered">
									<thead class="thead-default">
										<tr>
											<th><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;Contácto.</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="form-group" style="margin-bottom: 0px;">
													<label for="telefono_1" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> Teléfono:</label>
													<div class="col-sm-4">
														<input class="form-control input-sm" id="telefono_1" name="telefono_1" type="text" value="<?php echo $retVal = (!empty($post['telefono_1'])) ? $post['telefono_1'] : '';?>" <?php echo $disabled;?>>
														<?php echo form_error('telefono_1'); ?>
													</div>
													<label for="direccion" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> Dirección:</label>
													<div class="col-sm-4">
														<input class="form-control input-sm" id="direccion" name="direccion" type="text" value="<?php echo $retVal = (!empty($post['direccion'])) ? $post['direccion'] : '';?>" <?php echo $disabled;?>>
														<?php echo form_error('direccion'); ?>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group" style="margin-bottom: 0px;">
													<label for="email_1" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> E-mail 1:</label>
													<div class="col-sm-4">
														<input class="form-control input-sm" id="email_1" name="email_1" type="text" value="<?php echo $retVal = (!empty($post['email_1'])) ? $post['email_1'] : '';?>" <?php echo $disabled;?>>
														<?php echo form_error('email_1'); ?>
													</div>
													<label for="email_2" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> E-mail 2:</label>
													<div class="col-sm-4">
														<input class="form-control input-sm" id="email_2" name="email_2" type="text" value="<?php echo $retVal = (!empty($post['email_2'])) ? $post['email_2'] : '';?>" <?php echo $disabled;?>>
														<?php echo form_error('email_2'); ?>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table><br>

								<table class="table table-bordered">
									<thead class="thead-default">
										<tr>
											<th><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;Redes Sociales.</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="form-group" style="margin-bottom: 0px;">
													<label for="url_facebook" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> Facebook:</label>
													<div class="col-sm-4">
														<input class="form-control input-sm" id="url_facebook" name="url_facebook" type="text" value="<?php echo $retVal = (!empty($post['url_facebook'])) ? $post['url_facebook'] : '';?>" <?php echo $disabled;?>>
														<?php echo form_error('url_facebook'); ?>
													</div>
													<label for="url_twitter" class="col-sm-2 control-label" style="text-align: right;"><span class="text-red">*</span> Twitter:</label>
													<div class="col-sm-4">
														<input class="form-control input-sm" id="url_twitter" name="url_twitter" type="text" value="<?php echo $retVal = (!empty($post['url_twitter'])) ? $post['url_twitter'] : '';?>" <?php echo $disabled;?>>
														<?php echo form_error('url_twitter'); ?>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="form-group" style="margin-bottom: 0px;">
													<label for="imagen_1" class="col-sm-2 control-label" style="text-align: right;"><span style="color: red; font-weight: bold;">*</span> Imagen:</label>
													<div class="col-sm-10">
														<input type="file" name="imagen_1" id="imagen_1" <?php echo $retVal = ($wa_tipo == 'V') ? "disabled" : "";?>>
														<?php
														if(!empty($post['imagen_1'])){
															?>
															<p class="help-block">
																<a href="<?php echo base_url($this->config->item('upload_path') . $post['imagen_1']);?>" target="_blank">
																	<img src="<?php echo base_url($this->config->item('upload_path') . $post['imagen_1']);?>" style="max-height: 60px;">
																</a>
															</p>
															<?php }?>
														</div>
													</div>
												</td>
											</tr>
										</tbody>
									</table><br>
								</div>
							</div>
						</div>

						<div class="box-header">
							<div class="row pad">
								<div class="col-sm-6">
									<span style="color: red; font-weight: bold;"><strong>(*)</strong> Campos obligatorios.</span></p>
								</div>
								<div class="col-sm-6">
									<div class="pull-right">
										<?php
										if($wa_tipo == 'C' || $wa_tipo == 'E'){
											?>
											<button class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
											<a href="<?php echo $back_url;?>" class="btn btn-default btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Cancelar </a>
											<?php
										}
										if($wa_tipo == 'V'){
											?>
											<a class="btn btn-success btn-sm" title="Editar registro" href="<?php echo $edit_url;?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar </a>

											<?php }?>
										</div>
									</div>
								</div>
							</div>

						</form>

					</div>
				</div>
			</div>