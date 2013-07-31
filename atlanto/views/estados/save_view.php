<?php 
	$ci = &get_instance();
?>

		<div class="row-fluid">
		    <form class="form-horizontal" action="<?php echo (isset($estado)) ? $accion_modificar : $accion_guardar; ?>" name="frmestado" method="POST">
					<?php if (isset($estado)): ?>
						<input type="hidden" name="id_estado" value="<?php echo $id_estado; ?>">
					<?php endif ?>
					<div class="control-group">
						<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre'); ?></label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="nombre" name="nombre" <?php if (isset($estado)): ?>value="<?php echo $estado->nombre; ?>"<?php endif ?> required />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="descripcion"><?php echo $ci->lang->line('lbl_descripcion'); ?></label>
						<div class="controls">
							<textarea class="input-xlarge" name="descripcion" id="descripcion" rows="4"><?php if (isset($estado)): ?><?php echo $estado->descripcion; ?><?php endif ?></textarea>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<input type="submit" name="guardar" value="<?php echo $ci->lang->line('btn_guardar'); ?>" class="btn btn-inverse" />
							<a href="<?php echo base_url().'estado'; ?>" name="cancelar" class="btn"><?php echo $ci->lang->line('btn_cancelar'); ?></a>
						</div>
					</div>
			</form>
		</div>