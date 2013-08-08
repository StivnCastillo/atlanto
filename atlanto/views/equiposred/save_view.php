<?php 
	$ci = &get_instance();
?>
<div class="tabbable">
			<!-- MENU AGREGAR equipored -->
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab1" data-toggle="tab"><?php echo $ci->lang->line('tab_equ_equipored') ?></a>
				</li>
			</ul>

	    	<?php if ($this->session->flashdata('mensaje')): ?>
	    		<!-- mensaje, error, completado, peligro -->
	    		<!-- mensaje de exito -->
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

            <!-- DATOS DIRECTOS DEL equipored -->
	    	<div class="tab-content">
	    		<div class="tab-pane active" id="tab1">
					<article class="row">
						<form class="form-horizontal" id="frmequipored" name="frmequipored" action="<?php echo (isset($equipored)) ? $accion_modificar : $accion_guardar; ?>" method="POST">
							<?php if (isset($equipored)): ?>
	    						<input type="hidden" name="id_equipored" value="<?php echo $id_equipored; ?>">
	    					<?php endif ?>
							<div class="span5">

								<!-- nombre -->
								<div class="control-group">
									<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="nombre" name="nombre" value="<?php echo (isset($equipored)) ? $equipored->nombre : ''; ?>" required />
									</div>
								</div>

								<!-- ubicacion -->
								<div class="control-group">
									<label class="control-label" for="ubicacion"><?php echo $ci->lang->line('lbl_ubicacion') ?></label>
									<div class="controls">
										<input type="text" class="span1" id="iubicacion" name="iubicacion" data-url="<?php echo $accion_ubicacion; ?>" />
										<select class="span2" name="ubicacion" id="ubicacion">
											<?php if (isset($equipored)): ?>
												<option value="<?php echo $equipored->id_ubicacion ?>"><?php echo $equipored->ubicacion ?></option>											
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
											<?php if (isset($equipored)): ?>
												<option value="<?php echo $equipored->id_usuario ?>"><?php echo $equipored->usuario ?></option>											
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
													<option value="<?php echo $row->id; ?>" <?php if(isset($equipored)){if($equipored->id_estado == $row->id){echo 'selected="selected"';}} ?>><?php echo $row->nombre; ?></option>
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
													<option value="<?php echo $row->id; ?>" <?php if(isset($equipored)){if($equipored->id_dominio == $row->id){echo 'selected="selected"';}} ?> ><?php echo $row->nombre; ?></option>
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
													<option value="<?php echo $row->id; ?>" <?php if(isset($equipored)){if($equipored->id_red == $row->id){echo 'selected="selected"';}} ?> ><?php echo $row->nombre; ?></option>
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
										<input type="text" class="span3" id="ip" name="ip" value="<?php echo (isset($equipored)) ? $equipored->ip : ''; ?>" required />
									</div>
								</div>
							</div>

							<div class="span5">
								<!-- mac -->
								<div class="control-group">
									<label class="control-label" for="mac"><?php echo $ci->lang->line('lbl_mac') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="mac" name="mac" value="<?php echo (isset($equipored)) ? $equipored->mac : ''; ?>" />
									</div>
								</div>

								<!-- fabricante -->
								<div class="control-group">
									<label class="control-label" for="fabricante"><?php echo $ci->lang->line('lbl_fabricante') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="fabricante" name="fabricante" value="<?php echo (isset($equipored)) ? $equipored->fabricante : ''; ?>" required />
									</div>
								</div>

								<!-- modelo -->
								<div class="control-group">
									<label class="control-label" for="modelo"><?php echo $ci->lang->line('lbl_modelo') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="modelo" name="modelo" value="<?php echo (isset($equipored)) ? $equipored->modelo : ''; ?>" required />
									</div>
								</div>

								<!-- serie -->
								<div class="control-group">
									<label class="control-label" for="serie"><?php echo $ci->lang->line('lbl_serie') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="serie" name="serie" value="<?php echo (isset($equipored)) ? $equipored->n_serie : ''; ?>" required />
									</div>
								</div>

								<!-- activo -->
								<div class="control-group">
									<label class="control-label" for="activo"><?php echo $ci->lang->line('lbl_activo') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="activo" name="activo" value="<?php echo (isset($equipored)) ? $equipored->n_activo : ''; ?>" />
									</div>
								</div>

								<!-- comentario -->
								<div class="control-group">
									<label class="control-label" for="comentario"><?php echo $ci->lang->line('lbl_comentario') ?></label>
									<div class="controls">
										<textarea class="span3" rows="4" name="comentario" id="comentario"> <?php echo (isset($equipored)) ? $equipored->comentarios : ''; ?></textarea>
									</div>
								</div>

								<div class="control-group">
									<div class="controls">
										<button type="submit" class="btn btn-inverse"><?php echo $this->lang->line('btn_guardar'); ?></button>
										<a href="<?php echo base_url().'equipored' ?>" class="btn"><?php echo $this->lang->line('btn_cancelar'); ?></a>
									</div>
								</div>
							</div>

						</form>
					</article>
				</div>
			</div>
</div>