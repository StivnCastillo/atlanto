<?php 
	$ci = &get_instance();
?>

		<div class="row-fluid">
		    <form class="form-horizontal" action="<?php echo (isset($sistema_operativo)) ? $accion_modificar : $accion_guardar; ?>" name="frmsistema_operativo" method="POST">
					<?php if (isset($sistema_operativo)): ?>
						<input type="hidden" name="id_sistema_operativo" value="<?php echo $id_sistema_operativo; ?>">
					<?php endif ?>
					<div class="control-group">
						<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre'); ?></label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="nombre" name="nombre" <?php if (isset($sistema_operativo)): ?>value="<?php echo $sistema_operativo->nombre; ?>"<?php endif ?> required />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="version"><?php echo $ci->lang->line('lbl_version'); ?></label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="version" name="version" <?php if (isset($sistema_operativo)): ?>value="<?php echo $sistema_operativo->version; ?>"<?php endif ?> required />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="tipo"><?php echo $ci->lang->line('lbl_tipo'); ?></label>
						<div class="controls">
							<select name="tipo" id="tipo">
								<?php foreach ($tipos as $row): ?>
									<option value="<?php echo $row->id; ?>" <?php if (isset($sistema_operativo)){if($sistema_operativo->id_tipo_so == $row->id){echo "selected";}} ?>><?php echo $row->nombre; ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="descripcion"><?php echo $ci->lang->line('lbl_descripcion'); ?></label>
						<div class="controls">
							<textarea class="input-xlarge" name="descripcion" id="descripcion" rows="4"><?php if (isset($sistema_operativo)): ?><?php echo $sistema_operativo->descripcion; ?><?php endif ?></textarea>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<input type="submit" name="guardar" value="<?php echo $ci->lang->line('btn_guardar'); ?>" class="btn btn-inverse" />
							<a href="<?php echo base_url().'sistema_operativo'; ?>" name="cancelar" class="btn"><?php echo $ci->lang->line('btn_cancelar'); ?></a>
						</div>
					</div>
			</form>
		</div>