<?php 
	$ci = &get_instance();
?>

		<div class="row-fluid">
		    <form class="form-horizontal" action="<?php echo (isset($red)) ? $accion_modificar : $accion_guardar; ?>" name="frmred" method="POST">
					<?php if (isset($red)): ?>
						<input type="hidden" name="id_red" value="<?php echo $id_red; ?>">
					<?php endif ?>
					<div class="control-group">
						<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre'); ?></label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="nombre" name="nombre" <?php if (isset($red)): ?>value="<?php echo $red->nombre; ?>"<?php endif ?> required />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="descripcion"><?php echo $ci->lang->line('lbl_descripcion'); ?></label>
						<div class="controls">
							<textarea class="input-xlarge" name="descripcion" id="descripcion" rows="4"><?php if (isset($red)): ?><?php echo $red->descripcion; ?><?php endif ?></textarea>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<input type="submit" name="guardar" value="<?php echo $ci->lang->line('btn_guardar'); ?>" class="btn btn-inverse" />
							<a href="<?php echo base_url().'red'; ?>" name="cancelar" class="btn"><?php echo $ci->lang->line('btn_cancelar'); ?></a>
						</div>
					</div>
			</form>
		</div>