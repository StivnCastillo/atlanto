<?php 
	$ci = &get_instance();
?>

		<form action="<?php echo $accion; ?>" method="POST">
			<div class="row">
				<div class="span6">
					<table style="width: 100%;">
						<tr>
							<th class=" tabla-left">Numero de Caso</th>
							<td><?php echo $queja->n_caso; ?></td>
						</tr>
						<tr>
							<th class=" tabla-left">Ruta</th>
							<td><?php echo $queja->ruta; ?></td>
						</tr>
						<tr>
							<th class=" tabla-left">Placa/Numero Insterno de Bus</th>
							<td><?php echo $queja->n_bus; ?></td>
						</tr>
						<tr>
							<th class=" tabla-left">Fecha y Hora</th>
							<td><?php echo $queja->fecha; ?></td>
						</tr>
						<tr>
							<th class=" tabla-left">Estación/Dirección Punto Externo</th>
							<td><?php echo $queja->estacion; ?></td>
						</tr>
						<tr>
							<th class=" tabla-left">Descripción</th>
							<td><?php echo $queja->descripcion; ?></td>
						</tr>
					</table>
					<br>
					<form class="form-vertical" action="<?php echo $accion; ?>" name="frmTicket" method="POST">
						<input type="hidden" name="id_queja" value="<?php echo $queja->id; ?>">

						<div class="control-group">
							<label class="control-label" for="solucion">Solución</label>
							<div class="controls">
								<textarea class="input-block-level" name="solucion" id="solucion" rows="4"></textarea>
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-inverse">Enviar</button>
								<a href="<?php echo base_url().'quejas'; ?>" name="cancelar" class="btn"><?php echo $ci->lang->line('btn_cancelar'); ?></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</form>