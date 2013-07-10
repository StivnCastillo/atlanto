<?php 
$ci = &get_instance();
?>
<div class="tabbable">
			<!-- MENU AGREGAR TAREA -->
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab1" data-toggle="tab"><?php echo $ci->lang->line('tab_usu_tarea') ?></a>
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

            <!-- DATOS DIRECTOS DE LA TAREA -->
	    	<div class="tab-content">
	    		<div class="tab-pane active" id="tab1">
					<article class="row">
						<form class="form-horizontal" id="frmTarea" name="frmTarea" action="<?php echo  (isset($tarea)) ? $accion_modificar : $accion_guardar; ?>" method="POST">
							<?php if (isset($tarea)): ?>
								<!-- ID TAREA PARA MODIFICAR -->
	    						<input type="hidden" name="id_tarea" value="<?php echo $id_tarea; ?>">
	    					<?php endif ?>
							<div class="span5">
								    
								<div class="control-group">
									<label class="control-label" for="titulo"><?php echo $ci->lang->line('lbl_titulo') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="titulo" name="titulo" value="<?php echo (isset($tarea)) ? $tarea->titulo : ''; ?>" required  />
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="fecha_inicio"><?php echo $ci->lang->line('lbl_fecha_inicio') ?></label>
									<div class="controls">
										<div class="input-append date fecha">
											<input data-format="yyyy-MM-dd hh:mm:ss" name="fecha_inicio" type="text" value="<?php echo (isset($tarea)) ? $tarea->fecha_inicio : ''; ?>" required />
											<span class="add-on">
												<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
											</span>
										</div>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="fecha_fin"><?php echo $ci->lang->line('lbl_fecha_fin') ?></label>
									<div class="controls">
										<div class="input-append date fecha">
											<input data-format="yyyy-MM-dd hh:mm:ss" name="fecha_fin" type="text" value="<?php echo (isset($tarea)) ? $tarea->fecha_inicio : ''; ?>" />
											<span class="add-on">
												<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
											</span>
										</div>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="fecha_fin"><?php echo $ci->lang->line('lbl_asignar') ?></label>
									<div class="controls">
										<select name="id_usuario" id="id_usuario">
											<?php foreach ($usuarios as $row): ?>
												<option value="<?php echo $row->id; ?>"><?php echo $row->nombre." ".$row->apellido; ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>

							<div class="span5">
								<div class="control-group">
									<label class="control-label" for="descripcion"><?php echo $ci->lang->line('lbl_descripcion') ?></label>
									<div class="controls">
										<textarea class="span3" rows="4" name="descripcion" id="descripcion" required><?php echo (isset($tarea)) ? $tarea->descripcion : ''; ?></textarea>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="nota"><?php echo $ci->lang->line('lbl_nota') ?></label>
									<div class="controls">
										<textarea class="span3" rows="4" name="nota" id="nota"><?php echo (isset($tarea)) ? $tarea->nota : ''; ?></textarea>
									</div>
								</div>

								<div class="control-group">
									<div class="controls">
										<button type="submit" class="btn btn-inverse"><?php echo $this->lang->line('btn_guardar'); ?></button>
										<a href="<?php echo base_url().'panel/tareas' ?>" class="btn"><?php echo $this->lang->line('btn_cancelar'); ?></a>
									</div>
								</div>	
							</div>
						</form>
					</article>
				</div>
			</div>
</div>