<?php 
$ci = &get_instance();
?>
<div class="tabbable">

			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab1" data-toggle="tab"><?php echo $ci->lang->line('tab_cor_correo') ?></a>
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
						<form class="form-horizontal" id="frmCorreo" name="frmCorreo" action="<?php echo $accion; ?>" method="POST">
							<div class="span6">

								<div class="alert alert-success" id="informacion-correo" style="display: none;">
									<p>Su correo corporativo seria:</p>
									<strong><p id="correo-final"></p></strong>
									<input type="hidden" name="correofinal"  id="correo-final2" value="0">
									<p>Recuerde que su contraseña inicial es su numero de cedula, 
										si tiene algun problema para ingresar por favor dirijase al Departamento de Informatica</p>
									<button type="submit" class="btn btn-success">Crear</button>
								</div>

								<div class="control-group">
									<label class="control-label" for="cedula">Cedula</label>
									<div class="controls">
										<input type="text" name="cedula" id="cedula" required />
										<span class="help-inline">Obligatorio</span>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="nombre1">Primer Nombre</label>
									<div class="controls">
										<input type="text" name="nombre1" id="nombre1" required />
										<span class="help-inline">Obligatorio</span>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="nombre2">Segundo Nombre</label>
									<div class="controls">
										<input type="text" name="nombre2" id="nombre2" />
										<span class="help-inline">Opcional</span>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="apellido1">Primer Apellido</label>
									<div class="controls">
										<input type="text" name="apellido1" id="apellido1" required />
										<span class="help-inline">Oligatorio</span>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="apellido2">Segundo Apellido</label>
									<div class="controls">
										<input type="text" name="apellido2" id="apellido2" required />
										<span class="help-inline">Obligatorio</span>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="cargo">Cargo</label>
									<div class="controls">
										<input type="text" name="cargo" id="cargo" required />
										<span class="help-inline">Obligatorio</span>
									</div>
								</div>

								<div class="control-group">
									<div class="controls">
										<button type="button" id="crear-correo" class="btn btn-info pull-right" data-url="<?php echo base_url().'correo/buscar' ?>">Generar Correo</button>
									</div>
								</div>

							</div>
						</form>
					</article>
				</div>
			</div>
</div>