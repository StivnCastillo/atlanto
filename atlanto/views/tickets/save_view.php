<?php 
	$ci = &get_instance();
?>

		<div class="row-fluid">
			<div class="span5">
				<p>Por favor ingrese todos los datos que se le pide a continuación.</p>
				<form class="form-vertical" action="<?php echo $accion; ?>" name="frmTicket" method="POST">
						<div class="control-group">
							<label class="control-label" for="asunto">Asunto</label>
							<div class="controls">
								<input type="text" class="input-block-level" id="asunto" name="asunto" required />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="mensaje">Mensaje</label>
							<div class="controls">
								<textarea class="input-block-level" name="mensaje" id="mensaje" rows="6"></textarea>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="mensaje">Adjuntar Archivo</label>
							<div class="controls">
								<input type="file" name="archivo">
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