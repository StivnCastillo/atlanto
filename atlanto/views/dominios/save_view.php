<?php 
	$ci = &get_instance();
?>

		<div class="row-fluid">
		    <form class="form-horizontal" action="<?php echo (isset($dominio)) ? $accion_modificar : $accion_guardar; ?>" name="frmdominio" method="POST">
					<?php if (isset($dominio)): ?>
						<input type="hidden" name="id_dominio" value="<?php echo $id_dominio; ?>">
					<?php endif ?>
					<div class="control-group">
						<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre'); ?></label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="nombre" name="nombre" <?php if (isset($dominio)): ?>value="<?php echo $dominio->nombre; ?>"<?php endif ?> required />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="ip_server"><?php echo $ci->lang->line('tab_ip_server'); ?></label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="ip_server" name="ip_server" <?php if (isset($dominio)): ?>value="<?php echo $dominio->ip_server; ?>"<?php endif ?> required />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="ip_server_opcional"><?php echo $ci->lang->line('tab_ip_server_2'); ?></label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="ip_server_opcional" name="ip_server_opcional" <?php if (isset($dominio)): ?>value="<?php echo $dominio->ip_server_opcional; ?>"<?php endif ?> />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="descripcion"><?php echo $ci->lang->line('lbl_descripcion'); ?></label>
						<div class="controls">
							<textarea class="input-xlarge" name="descripcion" id="descripcion" rows="4"><?php if (isset($dominio)): ?><?php echo $dominio->descripcion; ?><?php endif ?></textarea>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<input type="submit" name="guardar" value="<?php echo $ci->lang->line('btn_guardar'); ?>" class="btn btn-inverse" />
							<a href="<?php echo base_url().'dominio'; ?>" name="cancelar" class="btn"><?php echo $ci->lang->line('btn_cancelar'); ?></a>
						</div>
					</div>
			</form>
		</div>