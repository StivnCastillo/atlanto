<?php 
	$ci = &get_instance();
?>
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab1" data-toggle="tab"><?php echo $ci->lang->line('tab_sof_software') ?></a>
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
						<form class="form-horizontal" id="frmsoftware" name="frmsoftware" action="<?php echo (isset($software)) ? $accion_modificar : $accion_guardar; ?>" method="POST">
							<?php if (isset($software)): ?>
	    						<input type="hidden" name="id_software" value="<?php echo $id_software; ?>">
	    					<?php endif ?>
							<div class="span5">

								<!-- nombre -->
								<div class="control-group">
									<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="nombre" name="nombre" value="<?php echo (isset($software)) ? $software->nombre : ''; ?>" required />
									</div>
								</div>

								<!-- version -->
								<div class="control-group">
									<label class="control-label" for="version"><?php echo $ci->lang->line('lbl_version') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="version" name="version" value="<?php echo (isset($software)) ? $software->version : ''; ?>" required />
									</div>
								</div>

								<!-- tipo -->
								<div class="control-group">
									<label class="control-label" for="tipo"><?php echo $ci->lang->line('lbl_tipo') ?></label>
									<div class="controls">
										<select name="tipo" id="tipo" required>
											<?php if (isset($tipos)): ?>
												<?php foreach ($tipos as $row): ?>
													<option value="<?php echo $row->id; ?>" <?php if(isset($software)){if($software->id_software_tipo == $row->id){echo 'selected="selected"';}} ?> ><?php echo $row->nombre; ?></option>
												<?php endforeach ?>
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<!-- aticket -->	
								<div class="control-group">
									<label class="control-label" for="aticket"><?php echo $ci->lang->line('lbl_aticket') ?></label>
									<div class="controls">
										<div class="switch" data-on="success" data-off="danger" data-on-label="SI" data-off-label="NO">
											<input type="checkbox" <?php if (isset($software) and $software->a_ticket == 'si'): ?>checked="checked"<?php endif ?> name="aticket" id="aticket" value="1" />
										</div>
									</div>
								</div>							
							</div>

							<div class="span5">
								<!-- n_licenciass -->
								<div class="control-group">
									<label class="control-label" for="n_licencias"><?php echo $ci->lang->line('lbl_n_licencias') ?></label>
									<div class="controls">
										<input type="number" data-validation-number-message="Esto no es un número" class="span1" id="n_licencias" name="n_licencias" value="<?php echo (isset($software)) ? $software->n_licencias : ''; ?>" required />
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
													<option value="<?php echo $row->id; ?>" <?php if(isset($software)){if($software->id_estado == $row->id){echo 'selected="selected"';}} ?>><?php echo $row->nombre; ?></option>
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
										<input type="text" class="span3" id="fabricante" name="fabricante" value="<?php echo (isset($software)) ? $software->fabricante : ''; ?>" required />
									</div>
								</div>

								<!-- comentario -->
								<div class="control-group">
									<label class="control-label" for="comentario">Descripción</label>
									<div class="controls">
										<textarea class="span3" rows="4" name="comentario" id="comentario"><?php echo (isset($software)) ? $software->comentarios : ''; ?></textarea>
									</div>
								</div>

								<div class="control-group">
									<div class="controls">
										<button type="submit" class="btn btn-inverse"><?php echo $this->lang->line('btn_guardar'); ?></button>
										<a href="<?php echo base_url().'software' ?>" class="btn"><?php echo $this->lang->line('btn_cancelar'); ?></a>
									</div>
								</div>
							</div>
						</form>
					</article>
				</div>
			</div>
		</div>