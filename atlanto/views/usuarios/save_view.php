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
						<form class="form-horizontal" id="frmUsuario" name="frmUsuario" action="<?php echo $accion ?>" method="POST">
							<div class="span5">
								    
								<div class="control-group">
									<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="nombre" name="nombre" required />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="apellido"><?php echo $ci->lang->line('lbl_apellido') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="apellido" name="apellido" required  />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="telefono"><?php echo $ci->lang->line('lbl_telefono') ?></label>
									<div class="controls">
										<input type="number" class="span3" id="telefono" name="telefono" />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="email"><?php echo $ci->lang->line('lbl_mail') ?></label>
									<div class="controls">
										<input type="email" class="span3" id="email" name="email" required  />
									</div>
								</div>

								<hr>

								<div class="control-group">
									<label class="control-label" for="usuario"><?php echo $ci->lang->line('lbl_usuario') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="usuario" name="usuario" required  />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="password"><?php echo $ci->lang->line('lbl_password') ?></label>
									<div class="controls">
										<input type="password" class="span3" id="password" name="password" required  />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="password2"><?php echo $ci->lang->line('lbl_comf_password') ?></label>
									<div class="controls">
										<input type="password" class="span3" id="password2" name="password2" data-validation-match-match="password" required  />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="activado"><?php echo $ci->lang->line('lbl_activado') ?></label>
									<div class="controls">
										<div class="switch" data-on="success" data-off="danger" data-on-label="SI" data-off-label="NO">
											<input type="checkbox" checked="checked" name="activado" id="activado" value="1" />
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
											<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="departamento"><?php echo $ci->lang->line('lbl_departamento') ?></label>
									<div class="controls">
										<input type="text" class="span1" id="idepartamento" name="idepartamento" data-url="<?php echo $accion_departamento; ?>" />
										<select class="span2" name="departamento" id="departamento">
											<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="cargo"><?php echo $ci->lang->line('lbl_cargo') ?></label>
									<div class="controls">
										<input type="text" class="span1" id="icargo" name="icargo" data-url="<?php echo $accion_cargo; ?>" />
										<select class="span2" name="cargo" id="cargo">
											<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="rol"><?php echo $ci->lang->line('lbl_rol') ?></label>
									<div class="controls">
										<select class="span3" name="rol" id="rol">
											<?php foreach ($roles as $row): ?>
												<option value="<?php echo $row->id ?>"><?php echo $row->nombre; ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="nota_interna"><?php echo $ci->lang->line('lbl_notas') ?></label>
									<div class="controls">
										<textarea class="span3" rows="4" name="nota_interna" id="nota_interna" placeholder="<?php echo $ci->lang->line('plc_nota_interna') ?>"></textarea>
									</div>
								</div>

								<div class="control-group">
									<div class="controls">
										<button type="submit" class="btn btn-inverse">Guardar</button>
										<a href="#" class="btn">Cancelar</a>
									</div>
								</div>
								
							</div>
						</form>
					</article>
				</div>
			</div>
		</div>