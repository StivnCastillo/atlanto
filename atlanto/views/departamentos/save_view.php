<?php 
$ci = &get_instance();
?>

		<div class="row-fluid">
		    <form class="form-horizontal" action="<?php echo (isset($departamento)) ? $accion_modificar : $accion_guardar; ?>" name="frmdepartamento" method="POST">
					<?php if (isset($departamento)): ?>
						<input type="hidden" name="id_departamento" value="<?php echo $id_departamento; ?>">
					<?php endif ?>
					<div class="control-group">
						<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre'); ?></label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="nombre" name="nombre" <?php if (isset($departamento)): ?>value="<?php echo $departamento->nombre; ?>"<?php endif ?> required />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="descripcion"><?php echo $ci->lang->line('lbl_descripcion'); ?></label>
						<div class="controls">
							<textarea class="input-xlarge" name="descripcion" id="descripcion" rows="4"><?php if (isset($departamento)): ?><?php echo $departamento->descripcion; ?><?php endif ?></textarea>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<input type="submit" name="guardar" value="<?php echo $ci->lang->line('btn_guardar'); ?>" class="btn btn-inverse" />
							<a href="<?php echo base_url().'departamento'; ?>" name="cancelar" class="btn"><?php echo $ci->lang->line('btn_cancelar'); ?></a>
						</div>
					</div>
			</form>
		</div>