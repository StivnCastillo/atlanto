<?php 
	$ci = &get_instance();
?>
<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab1" data-toggle="tab"><?php echo $ci->lang->line('tab_mon_monitor') ?></a>
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

	    	<div class="tab-content">
	    		<div class="tab-pane active" id="tab1">
					<article class="row">
						<form class="form-horizontal" id="frmmonitor" name="frmmonitor" action="<?php echo (isset($monitor)) ? $accion_modificar : $accion_guardar; ?>" method="POST">
							<?php if (isset($monitor)): ?>
	    						<input type="hidden" name="id_monitor" value="<?php echo $id_monitor; ?>">
	    					<?php endif ?>
							<div class="span5">

								<!-- nombre -->
								<div class="control-group">
									<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="nombre" name="nombre" value="<?php echo (isset($monitor)) ? $monitor->nombre : ''; ?>" required />
									</div>
								</div>

								<!-- ubicacion -->
								<div class="control-group">
									<label class="control-label" for="ubicacion"><?php echo $ci->lang->line('lbl_ubicacion') ?></label>
									<div class="controls">
										<input type="text" class="span1" id="iubicacion" name="iubicacion" data-url="<?php echo $accion_ubicacion; ?>" />
										<select class="span2" name="ubicacion" id="ubicacion">
											<?php if (isset($monitor)): ?>
												<option value="<?php echo $monitor->idubicacion ?>"><?php echo $monitor->ubicacion ?></option>											
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
											<?php if (isset($monitor)): ?>
												<option value="<?php echo $monitor->idusuario ?>"><?php echo $monitor->usuario ?></option>											
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
													<option value="<?php echo $row->id; ?>" <?php if(isset($monitor)){if($monitor->id_estado == $row->id){echo 'selected="selected"';}} ?>><?php echo $row->nombre; ?></option>
												<?php endforeach ?>
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<!-- tipo -->
								<div class="control-group">
									<label class="control-label" for="tipo"><?php echo $ci->lang->line('lbl_tipo') ?></label>
									<div class="controls">
										<select name="tipo" id="tipo" required>
											<option value=""><?php echo $ci->lang->line('slc_ninguno'); ?></option>
											<?php if (isset($tipos)): ?>
												<?php foreach ($tipos as $row): ?>
													<option value="<?php echo $row->id; ?>" <?php if(isset($monitor)){if($monitor->id_tipo_monitor == $row->id){echo 'selected="selected"';}} ?> ><?php echo $row->nombre; ?></option>
												<?php endforeach ?>
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<!-- interfaz -->
								<div class="control-group">
									<label class="control-label" for="interfaz"><?php echo $ci->lang->line('lbl_interfaz') ?></label>
									<div class="controls">
										<select name="interfaz" id="interfaz" required>
											<option value=""><?php echo $ci->lang->line('slc_ninguno'); ?></option>
											<?php if (isset($interfaz)): ?>
												<?php foreach ($interfaz as $row): ?>
													<option value="<?php echo $row->id; ?>" <?php if(isset($monitor)){if($monitor->id_interfaz_monitor == $row->id){echo 'selected="selected"';}} ?> ><?php echo $row->nombre; ?></option>
												<?php endforeach ?>
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<!-- tamano -->
								<div class="control-group">
									<label class="control-label" for="tamano"><?php echo $ci->lang->line('lbl_tamano') ?></label>
									<div class="controls">
										<input type="text" class="span1" id="tamano" name="tamano" value="<?php echo (isset($monitor)) ? $monitor->tamano : ''; ?>" required /> "
									</div>
								</div>
							</div>

							<div class="span5">
								

								<!-- fabricante -->
								<div class="control-group">
									<label class="control-label" for="fabricante"><?php echo $ci->lang->line('lbl_fabricante') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="fabricante" name="fabricante" value="<?php echo (isset($monitor)) ? $monitor->fabricante : ''; ?>" required />
									</div>
								</div>

								<!-- modelo -->
								<div class="control-group">
									<label class="control-label" for="modelo"><?php echo $ci->lang->line('lbl_modelo') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="modelo" name="modelo" value="<?php echo (isset($monitor)) ? $monitor->modelo : ''; ?>" required />
									</div>
								</div>

								<!-- serie -->
								<div class="control-group">
									<label class="control-label" for="serie"><?php echo $ci->lang->line('lbl_serie') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="serie" name="serie" value="<?php echo (isset($monitor)) ? $monitor->n_serie : ''; ?>" required />
									</div>
								</div>

								<!-- activo -->
								<div class="control-group">
									<label class="control-label" for="activo"><?php echo $ci->lang->line('lbl_activo') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="activo" name="activo" value="<?php echo (isset($monitor)) ? $monitor->n_activo : ''; ?>" />
									</div>
								</div>

								<!-- comentario -->
								<div class="control-group">
									<label class="control-label" for="comentario"><?php echo $ci->lang->line('lbl_comentario') ?></label>
									<div class="controls">
										<textarea class="span3" rows="4" name="comentario" id="comentario"> <?php echo (isset($monitor)) ? $monitor->comentarios : ''; ?></textarea>
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