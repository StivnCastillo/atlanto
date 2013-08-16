<?php 
	$ci = &get_instance();
?>
<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab1" data-toggle="tab"><?php echo $ci->lang->line('tab_comp_dd') ?></a>
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
						<form class="form-horizontal" id="frmcomponente" name="frmcomponente" action="<?php echo (isset($componente)) ? $accion_modificar : $accion_guardar; ?>" method="POST">
							<?php if (isset($componente)): ?>
	    						<input type="hidden" name="id_discoduro" value="<?php echo $id_discoduro; ?>">
	    					<?php endif ?>
							<div class="span5">

								<!-- nombre -->
								<div class="control-group">
									<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="nombre" name="nombre" value="<?php echo (isset($componente)) ? $componente->nombre : ''; ?>" required />
									</div>
								</div>

								<!-- capacidad -->
								<div class="control-group">
									<label class="control-label" for="capacidad"><?php echo $ci->lang->line('lbl_capacidad') ?></label>
									<div class="controls">
										<div class="input-append">
											<input type="number" class="span2" id="capacidad" name="capacidad" value="<?php echo (isset($componente)) ? $componente->capacidad : ''; ?>" required />
											<span class="add-on">GB</span>
										</div>
									</div>
								</div>

								<!-- rpm -->
								<div class="control-group">
									<label class="control-label" for="rpm"><?php echo $ci->lang->line('lbl_rpm') ?></label>
									<div class="controls">
										<div class="input-append">
											<input type="number" class="span2" id="rpm" name="rpm" value="<?php echo (isset($componente)) ? $componente->rpm : ''; ?>" />
											<span class="add-on">RPM</span>
										</div>
									</div>
								</div>

								<!-- cache -->
								<div class="control-group">
									<label class="control-label" for="cache"><?php echo $ci->lang->line('lbl_cache') ?></label>
									<div class="controls">
										<div class="input-append">
											<input type="number" class="span2" id="cache" name="cache" value="<?php echo (isset($componente)) ? $componente->cache : ''; ?>" />
											<span class="add-on">MB</span>
										</div>
									</div>
								</div>

							</div>

							<div class="span5">

								<!-- fabricante -->
								<div class="control-group">
									<label class="control-label" for="fabricante"><?php echo $ci->lang->line('lbl_fabricante') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="fabricante" name="fabricante" value="<?php echo (isset($componente)) ? $componente->fabricante : ''; ?>" required />
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
													<option value="<?php echo $row->id; ?>" <?php if(isset($componente)){if($componente->id_interfaz == $row->id){echo 'selected="selected"';}} ?>><?php echo $row->nombre; ?></option>
												<?php endforeach ?>
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>													
							

								<!-- comentario -->
								<div class="control-group">
									<label class="control-label" for="comentario"><?php echo $ci->lang->line('lbl_comentario') ?></label>
									<div class="controls">
										<textarea class="span3" rows="4" name="comentario" id="comentario"><?php echo (isset($componente)) ? $componente->comentarios : ''; ?></textarea>
									</div>
								</div>

								<div class="control-group">
									<div class="controls">
										<button type="submit" class="btn btn-inverse"><?php echo $this->lang->line('btn_guardar'); ?></button>
										<a href="<?php echo base_url().'componente' ?>" class="btn"><?php echo $this->lang->line('btn_cancelar'); ?></a>
									</div>
								</div>
							</div>

						</form>
					</article>
				</div>
			</div>
</div>