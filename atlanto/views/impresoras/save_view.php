<?php 
	$ci = &get_instance();
?>
<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab1" data-toggle="tab"><?php echo $ci->lang->line('tab_car_impresora') ?></a>
				</li>
			</ul>

	    	<?php if ($this->session->flashdata('mensaje')): ?>
	    		<?php if ($this->session->flashdata('tipo_mensaje') == 'exito'): ?>
	    			<div class="alert alert-success">
			            <button type="button" class="close" data-dismiss="alert">×</button>
			            <?php echo $this->session->flashdata('mensaje') ?>
		            </div>
	    		<?php endif ?>
			    	
				<?php if ($this->session->flashdata('tipo_mensaje') == 'error'): ?>
		            <div class="alert alert-error">
			            <button type="button" class="close" data-dismiss="alert">×</button>
			            <?php echo $this->session->flashdata('mensaje') ?>
		            </div>
		        <?php endif ?>
				
				<?php if ($this->session->flashdata('tipo_mensaje') == 'cuidado'): ?>
		            <div class="alert alert-warning">
			            <button type="button" class="close" data-dismiss="alert">×</button>
			            <?php echo $this->session->flashdata('mensaje') ?>
		            </div>
	            <?php endif ?>
	    	<?php endif ?>

	    	<div class="tab-content">
	    		<div class="tab-pane active" id="tab1">
					<article class="row">
						<form class="form-horizontal" id="frmimpresora" name="frmimpresora" action="<?php echo (isset($impresora)) ? $accion_modificar : $accion_guardar; ?>" method="POST">
							<?php if (isset($impresora)): ?>
	    						<input type="hidden" name="id_impresora" value="<?php echo $id_impresora; ?>">
	    					<?php endif ?>
							<div class="span5">

								<!-- nombre -->
								<div class="control-group">
									<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="nombre" name="nombre" value="<?php echo (isset($impresora)) ? $impresora->nombre : ''; ?>" required />
									</div>
								</div>

								<!-- ubicacion -->
								<div class="control-group">
									<label class="control-label" for="ubicacion"><?php echo $ci->lang->line('lbl_ubicacion') ?></label>
									<div class="controls">
										<input type="text" class="span1" id="iubicacion" name="iubicacion" data-url="<?php echo $accion_ubicacion; ?>" />
										<select class="span2" name="ubicacion" id="ubicacion">
											<?php if (isset($impresora)): ?>
												<option value="<?php echo $impresora->id_ubicacion ?>"><?php echo $impresora->ubicacion ?></option>											
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
											
										</select>
									</div>
								</div>
								<!-- usuario -->
								<div class="control-group">
									<label class="control-label" for="usuario"><?php echo $ci->lang->line('lbl_usuario') ?></label>
									<div class="controls">
										<input type="text" class="span1" id="iusuario" name="iusuario" data-url="<?php echo $accion_usuario; ?>" />
										<select class="span2" name="usuario" id="usuario">
											<?php if (isset($impresora)): ?>
												<option value="<?php echo $impresora->id_usuario ?>"><?php echo $impresora->usuario ?></option>											
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<!-- estado -->
								<div class="control-group">
									<label class="control-label" for="estado"><?php echo $ci->lang->line('lbl_estado') ?></label>
									<div class="controls">
										<select name="estado" id="estado" required>
											<option value=""><?php echo $ci->lang->line('slc_ninguno'); ?></option>
											<?php if (isset($estados)): ?>
												<?php foreach ($estados as $row): ?>
													<option value="<?php echo $row->id; ?>" <?php if(isset($impresora)){if($impresora->id_estado == $row->id){echo 'selected="selected"';}} ?>><?php echo $row->nombre; ?></option>
												<?php endforeach ?>
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<!-- dominio -->
								<div class="control-group">
									<label class="control-label" for="dominio"><?php echo $ci->lang->line('lbl_dominio') ?></label>
									<div class="controls">
										<select name="dominio" id="dominio">
											<option value=""><?php echo $ci->lang->line('slc_ninguno'); ?></option>
											<?php if (isset($dominios)): ?>
												<?php foreach ($dominios as $row): ?>													
													<option value="<?php echo $row->id; ?>" <?php if(isset($impresora)){if($impresora->id_dominio == $row->id){echo 'selected="selected"';}} ?> ><?php echo $row->nombre; ?></option>
												<?php endforeach ?>
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<!-- red -->
								<div class="control-group">
									<label class="control-label" for="red"><?php echo $ci->lang->line('lbl_red') ?></label>
									<div class="controls">
										<select name="red" id="red">
											<option value=""><?php echo $ci->lang->line('slc_ninguno'); ?></option>
											<?php if (isset($redes)): ?>
												<?php foreach ($redes as $row): ?>													
													<option value="<?php echo $row->id; ?>" <?php if(isset($impresora)){if($impresora->id_red == $row->id){echo 'selected="selected"';}} ?> ><?php echo $row->nombre; ?></option>
												<?php endforeach ?>
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<!-- ip -->
								<div class="control-group">
									<label class="control-label" for="ip"><?php echo $ci->lang->line('lbl_ip') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="ip" name="ip" value="<?php echo (isset($impresora)) ? $impresora->ip : ''; ?>" />
									</div>
								</div>

							</div>

							<div class="span5">
								<!-- tipo -->
								<div class="control-group">
									<label class="control-label" for="tipo"><?php echo $ci->lang->line('lbl_tipo') ?></label>
									<div class="controls">
										<select name="tipo" id="tipo" required>
											<option value=""><?php echo $ci->lang->line('slc_ninguno'); ?></option>
											<?php if (isset($tipos)): ?>
												<?php foreach ($tipos as $row): ?>
													<option value="<?php echo $row->id; ?>" <?php if(isset($impresora)){if($impresora->id_tipo_impresora == $row->id){echo 'selected="selected"';}} ?> ><?php echo $row->nombre; ?></option>
												<?php endforeach ?>
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<!-- fabricante -->
								<div class="control-group">
									<label class="control-label" for="fabricante"><?php echo $ci->lang->line('lbl_fabricante') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="fabricante" name="fabricante" value="<?php echo (isset($impresora)) ? $impresora->fabricante : ''; ?>" required />
									</div>
								</div>

								<!-- modelo -->
								<div class="control-group">
									<label class="control-label" for="modelo"><?php echo $ci->lang->line('lbl_modelo') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="modelo" name="modelo" value="<?php echo (isset($impresora)) ? $impresora->modelo : ''; ?>" required />
									</div>
								</div>

								<!-- serie -->
								<div class="control-group">
									<label class="control-label" for="serie"><?php echo $ci->lang->line('lbl_serie') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="serie" name="serie" value="<?php echo (isset($impresora)) ? $impresora->n_serie : ''; ?>" required />
									</div>
								</div>

								<!-- activo -->
								<div class="control-group">
									<label class="control-label" for="activo"><?php echo $ci->lang->line('lbl_activo') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="activo" name="activo" value="<?php echo (isset($impresora)) ? $impresora->n_activo : ''; ?>" />
									</div>
								</div>

								<!-- comentario -->
								<div class="control-group">
									<label class="control-label" for="comentario"><?php echo $ci->lang->line('lbl_comentario') ?></label>
									<div class="controls">
										<textarea class="span3" rows="4" name="comentario" id="comentario"> <?php echo (isset($impresora)) ? $impresora->comentarios : ''; ?></textarea>
									</div>
								</div>

								<div class="control-group">
									<div class="controls">
										<button type="submit" class="btn btn-inverse"><?php echo $this->lang->line('btn_guardar'); ?></button>
										<a href="<?php echo base_url().'panel/usuarios' ?>" class="btn"><?php echo $this->lang->line('btn_cancelar'); ?></a>
									</div>
								</div>
							</div>

						</form>
					</article>
				</div>
			</div>
</div>