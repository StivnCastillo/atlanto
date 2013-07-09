<?php 
$ci = &get_instance();
?>
<div class="tabbable">
			<!-- MENU AGREGAR USUARIO -->
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab1" data-toggle="tab"><?php echo $ci->lang->line('tab_usu_usuario') ?></a>
				</li>
			</ul>
			<br>

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

            <!-- DATOS DIRECTOS DEL USUARIO -->
	    	<div class="tab-content">
	    		<div class="tab-pane active" id="tab1">
					<article class="row">
						<form class="form-horizontal" id="frmUsuario" name="frmUsuario" action="<?php echo (isset($usuario)) ? $accion_modificar : $accion_guardar; ?>" method="POST">
							<?php if (isset($usuario)): ?>
	    						<input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
	    					<?php endif ?>
							<div class="span5">
								    
								<div class="control-group">
									<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="nombre" name="nombre" value="<?php echo (isset($usuario)) ? $usuario->nom_usuario : ''; ?>" required />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="apellido"><?php echo $ci->lang->line('lbl_apellido') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="apellido" name="apellido" value="<?php echo (isset($usuario)) ? $usuario->apellido : ''; ?>" required  />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="telefono"><?php echo $ci->lang->line('lbl_telefono') ?></label>
									<div class="controls">
										<input type="number" class="span3" id="telefono" name="telefono" value="<?php echo (isset($usuario)) ? $usuario->telefono : ''; ?>" />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="email"><?php echo $ci->lang->line('lbl_mail') ?></label>
									<div class="controls">
										<input type="email" class="span3" id="email" name="email" value="<?php echo (isset($usuario)) ? $usuario->email : ''; ?>" required  />
									</div>
								</div>

								<hr>

								<div class="control-group">
									<label class="control-label" for="usuario"><?php echo $ci->lang->line('lbl_usuario') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="usuario" name="usuario" value="<?php echo (isset($usuario)) ? $usuario->usuario : ''; ?>" required  />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="password"><?php echo $ci->lang->line('lbl_password') ?></label>
									<div class="controls">
										<input type="password" class="span3" id="password" name="password" <?php if (!isset($usuario)): ?>required<?php endif ?>/>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="password2"><?php echo $ci->lang->line('lbl_comf_password') ?></label>
									<div class="controls">
										<input type="password" class="span3" id="password2" name="password2" data-validation-match-match="password" <?php if (!isset($usuario)): ?>required<?php endif ?> />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="activado"><?php echo $ci->lang->line('lbl_activado') ?></label>
									<div class="controls">
										<div class="switch" data-on="success" data-off="danger" data-on-label="SI" data-off-label="NO">
											<input type="checkbox" <?php if (isset($usuario) and $usuario->activo == 1): ?>checked="checked"<?php endif ?> name="activado" id="activado" value="1" />
										</div>
									</div>
								</div>
							</div>

							<div class="span5">
								<div class="control-group">
									<label class="control-label" for="ubicacion"><?php echo $ci->lang->line('lbl_ubicacion') ?></label>
									<div class="controls">
										<input type="text" class="span1" id="iubicacion" name="iubicacion" data-url="<?php echo $accion_ubicacion; ?>" />
										<select class="span2" name="ubicacion" id="ubicacion">
											<?php if (isset($usuario)): ?>
												<option value="<?php echo $usuario->id_lugar ?>"><?php echo $usuario->lugar ?></option>											
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
											
										</select>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="departamento"><?php echo $ci->lang->line('lbl_departamento') ?></label>
									<div class="controls">
										<input type="text" class="span1" id="idepartamento" name="idepartamento" data-url="<?php echo $accion_departamento; ?>" />
										<select class="span2" name="departamento" id="departamento">
											<?php if (isset($usuario)): ?>
												<option value="<?php echo $usuario->id_departamento ?>"><?php echo $usuario->departamento ?></option>											
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="cargo"><?php echo $ci->lang->line('lbl_cargo') ?></label>
									<div class="controls">
										<input type="text" class="span1" id="icargo" name="icargo" data-url="<?php echo $accion_cargo; ?>" />
										<select class="span2" name="cargo" id="cargo">
											<?php if (isset($usuario)): ?>
												<option value="<?php echo $usuario->id_cargo?>"><?php echo $usuario->cargo ?></option>											
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="rol"><?php echo $ci->lang->line('lbl_rol') ?></label>
									<div class="controls">
										<select class="span3" name="rol" id="rol">
											<?php foreach ($roles as $row): ?>
												<option value="<?php echo $row->id ?>" <?php echo (isset($usuario) and $usuario->id_rol == $row->id) ? 'selected="selected"' : ''; ?>><?php echo $row->nombre; ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="nota_interna"><?php echo $ci->lang->line('lbl_notas') ?></label>
									<div class="controls">
										<textarea class="span3" rows="4" name="nota_interna" id="nota_interna" placeholder="<?php echo $ci->lang->line('plc_nota_interna') ?>"> <?php echo (isset($usuario)) ? $usuario->nota_interna : ''; ?></textarea>
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