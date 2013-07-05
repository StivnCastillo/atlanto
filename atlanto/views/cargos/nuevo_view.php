<?php 
$ci = &get_instance();
?>
<div class="tabbable">
			<!-- MENU AGREGAR NUEVO -->
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab1" data-toggle="tab"><?php echo $ci->lang->line('tab_car_cargos') ?></a>
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

            <!-- DATOS -->
	    	<div class="tab-content">
	    		<div class="tab-pane active" id="tab1">
					<article class="row">
						<form class="form-horizontal" id="frmCargos" name="frmCargos" action="<?php //echo (isset($cargos)) ? $accion_modificar : $accion_guardar; ?>" method="POST">
							<?php if (isset($cargos)): ?>
	    						<input type="hidden" name="id_cargo" value="<?php echo $id_cargo; ?>">
	    					<?php endif ?>
							<div class="span5">
								    
								<div class="control-group">
									<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="nombre" name="nombre" value="<?php echo (isset($cargos)) ? $cargos->nom_usuario : ''; ?>" required />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="activado"><?php echo $ci->lang->line('lbl_descripcion') ?></label>
									<div class="controls">
										<div class="switch" data-on="success" data-off="danger" data-on-label="SI" data-off-label="NO">
											<textarea class="span3" rows="4" name="descripcion" id="descripcion" placeholder="<?php echo $ci->lang->line('plc_descripcion') ?>"> <?php echo (isset($cargos)) ? $cargos->descripcion : ''; ?></textarea>
										</div>
									</div>
								</div>
							</div>
						</form>
					</article>
				</div>
			</div>
</div>