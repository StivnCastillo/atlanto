<?php 
$ci = &get_instance();
?>

		<div class="row-fluid">
		    <form class="form-horizontal" action="<?php echo (isset($ubicacion)) ? $accion_modificar : $accion_guardar; ?>" name="frmUbicacion" method="POST">
					<?php if (isset($ubicacion)): ?>
						<input type="hidden" name="id_ubicacion" value="<?php echo $id_ubicacion; ?>">
					<?php endif ?>
					<div class="control-group">
						<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre'); ?></label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="nombre" name="nombre" <?php if (isset($ubicacion)): ?>value="<?php echo $ubicacion->nombre; ?>"<?php endif ?> required />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="id_padre"><?php echo $ci->lang->line('lbl_debajo'); ?></label>
						<div class="controls">
							<select name="id_padre" id="id_padre" class="input-xlarge">
								<option value="0">Ninguno</option>
								<?php foreach ($ubicaciones as $row): ?>
									<option value="<?php echo $row->id; ?>" <?php if(isset($ubicacion)){if($ubicacion->id_padre == $row->id){echo 'selected="selected"';}} ?>> <?php echo $row->nombre; ?></option>
								<?php endforeach ?>										
							</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="piso"><?php echo $ci->lang->line('lbl_piso'); ?></label>
						<div class="controls">
							<!-- colocar el numero de pisos segun configuracion -->
							<select name="piso" id="piso" class="input-xlarge">
								<option value="1" <?php if (isset($ubicacion) and $ubicacion->piso == 1): ?>selected="selected"<?php endif ?>>Piso 1</option>
								<option value="2" <?php if (isset($ubicacion) and $ubicacion->piso == 2): ?>selected="selected"<?php endif ?>>Piso 2</option>
							</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="descripcion"><?php echo $ci->lang->line('lbl_descripcion'); ?></label>
						<div class="controls">
							<textarea class="input-xlarge" name="descripcion" id="descripcion" rows="4"><?php if (isset($ubicacion)): ?><?php echo $ubicacion->descripcion; ?><?php endif ?></textarea>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<input type="submit" name="guardar" value="<?php echo $ci->lang->line('btn_guardar'); ?>" class="btn btn-inverse" />
							<a href="<?php echo base_url().'ubicacion'; ?>" name="cancelar" class="btn"><?php echo $ci->lang->line('btn_cancelar'); ?></a>
						</div>
					</div>
			</form>
		</div>