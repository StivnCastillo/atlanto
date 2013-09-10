<?php 
	$ci = &get_instance();
?>

		<div class="row-fluid">
			<!-- mensaje, error, completado, peligro -->
			<?php if ($this->session->flashdata('mensaje')): ?>
	    		<!-- mensaje de exito -->
	    		<?php if ($this->session->flashdata('tipo_mensaje') == 'exito'): ?>
	    			<div class="alert alert-success">
			            <button type="button" class="close" data-dismiss="alert">×</button>
			            <?php echo $this->session->flashdata('mensaje') ?>
		            </div>
	    		<?php endif ?>
			    <!-- mensaje de error -->
				<?php if ($this->session->flashdata('tipo_mensaje') == 'error'): ?>
		            <div class="alert alert-error">
			            <button type="button" class="close" data-dismiss="alert">×</button>
			            <?php echo $this->session->flashdata('mensaje') ?>
		            </div>
		        <?php endif ?>
				<!-- mensaje de peligro -->
				<?php if ($this->session->flashdata('tipo_mensaje') == 'warning'): ?>
		            <div class="alert alert-warning">
			            <button type="button" class="close" data-dismiss="alert">×</button>
			            <?php echo $this->session->flashdata('mensaje') ?>
		            </div>
	            <?php endif ?>
		    <?php endif ?>
			<div class="span5">

				<p>Por favor ingrese todos los datos que se le pide a continuación.</p>
				<form class="form-vertical" action="<?php echo $accion; ?>" name="frmTicket" method="POST" enctype="multipart/form-data">
						<div class="control-group">
							<label class="control-label" for="asunto">Asunto</label>
							<div class="controls">
								<input type="text" class="input-block-level" id="asunto" name="asunto" required placeholder="Asunto de la incidencia" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="mensaje">Mensaje</label>
							<div class="controls">
								<textarea class="input-block-level" name="mensaje" id="mensaje" rows="6" placeholder="Descripción de su incidencia." required></textarea>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="mensaje">Adjuntar Archivo</label>
							<div class="controls">
								<input type="file" name="archivo">
								<span class="help-block">Tipos de Archivos: (DOC, XSL, PPT, JPG, PNG, TXT, PDF) Max. 4MB</span>
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-inverse">Enviar</button>
								<a href="<?php echo base_url().'escritorio'; ?>" name="cancelar" class="btn"><?php echo $ci->lang->line('btn_cancelar'); ?></a>
							</div>
						</div>
				</form>
			</div>
				
		</div>