<?php 
	$ci = &get_instance();
?>
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

			<article class="tabbable"> <!-- Only required for left/right tabs -->
			    <ul class="nav nav-tabs">
				    <li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
				    <li><a href="#tab2" data-toggle="tab">Notificaciones</a></li>
				    <li><a href="#tab3" data-toggle="tab">Reportes</a></li>
			    </ul>
			    <div class="tab-content">
				    <div class="tab-pane active" id="tab1">
				    	<form class="form-horizontal" id="frmUsuario" name="frmUsuario" action="<?php echo $accion_general; ?>" method="POST">
					    	<div class="row-fluid">

								<div class="span12">

									<div class="control-group">
										<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre_sistema') ?></label>
										<div class="controls">
											<input type="text" id="nombre" name="nombre" value="<?php echo $config->nombre_sistema; ?>" required />
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="texto_inicio"><?php echo $ci->lang->line('lbl_texto_inicio') ?></label>
										<div class="controls">
											<textarea class="span9 editorhtml" rows="6" name="texto_inicio" id="texto_inicio"><?php echo $config->texto_inicio; ?></textarea>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="pie_pagina"><?php echo $ci->lang->line('lbl_pie_pagina') ?></label>
										<div class="controls">
											<textarea class="span9 editorhtml" rows="2" name="pie_pagina" id="pie_pagina"><?php echo $config->texto_pie_pagina; ?></textarea>
										</div>
									</div>

									<button class="btn btn-inverse" type="submit">Guardar</button>	
								</div>

							</div>
						</form>
				    </div>
				    <div class="tab-pane" id="tab2">
				    	<p>Howdy, I'm in Section 2.</p>
				    </div>
				    <div class="tab-pane" id="tab3">
				    	<p>Howdy, I'm in Section 3.</p>
				    </div>
			    </div>
		    </article>