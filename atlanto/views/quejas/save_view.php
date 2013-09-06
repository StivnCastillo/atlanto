<?php 
	$ci = &get_instance();
?>

		<div class="row-fluid">
			<div class="span5">
				<form class="form-vertical" action="<?php echo $accion; ?>" name="frmTicket" method="POST">
						
						<div class="control-group">
							<label class="control-label" for="item">Item</label>
							<div class="controls">
								<input type="text" class="input-block-level" id="item" name="item" required <?php if (isset($queja)): ?>value="<?php echo $queja->item; ?>"<?php endif ?> />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="caso">Número de Caso</label>
							<div class="controls">
								<input type="text" class="input-block-level" id="caso" name="caso" required <?php if (isset($queja)): ?>value="<?php echo $queja->n_caso; ?>"<?php endif ?> />
							</div>
						</div>

						<div class="row-fluid">
							<div class="span6">
								<div class="control-group">
									<label class="control-label" for="ruta">Ruta</label>
									<div class="controls">
										<input type="text" class="input-block-level" id="ruta" name="ruta" required <?php if (isset($queja)): ?>value="<?php echo $queja->ruta; ?>"<?php endif ?> />
									</div>
								</div>
							</div>
							<div class="span6">
								<div class="control-group">
									<label class="control-label" for="placa">Número Interno/Placa</label>
									<div class="controls">
										<input type="text" class="input-block-level" id="placa" name="placa" required  <?php if (isset($queja)): ?>value="<?php echo $queja->n_bus; ?>"<?php endif ?> />
									</div>
								</div>
							</div>
						</div>						

						<div class="control-group">
							<label class="control-label" for="fecha">Fecha</label>
							<div class="controls">
								<div class="input-append date fecha">
									<input data-format="yyyy-MM-dd hh:mm:ss" name="fecha" type="text" required <?php if (isset($queja)): ?>value="<?php echo $queja->fecha; ?>"<?php endif ?> />
									<span class="add-on">
										<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
									</span>
								</div>
									<span class="help-inline">AAAA-MM-DD hh:mm:ss</span>
							</div>
						</div>					

						<div class="control-group">
							<label class="control-label" for="direccion">Estación/Dirección Punto Externo</label>
							<div class="controls">
								<input type="text" class="input-block-level" id="direccion" name="direccion" required <?php if (isset($queja)): ?>value="<?php echo $queja->estacion; ?>"<?php endif ?> />
							</div>
						</div>

					</div>
					<div class="span5">

						<div class="control-group">
							<label class="control-label" for="proceso">Proceso</label>
							<div class="controls">

								<label class="checkbox inline">
									<input type="checkbox" name="gh" id="gh" value="1"> Gestión Humana
								</label>

								<label class="checkbox inline">
									<input type="checkbox" name="op" id="op" value="2"> Operaciones
								</label>

								<label class="checkbox inline">
									<input type="checkbox" name="mtto" id="mtto" value="3"> Mentenimiento
								</label>

								<label class="checkbox inline">
									<input type="checkbox" name="gi" id="gi" value="4"> Gestión Integral
								</label>

								<label class="checkbox inline">
									<input type="checkbox" name="prev" id="prev" value="5"> Prevención Vial
								</label>

							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="descripcion">Descripción</label>
							<div class="controls">
								<textarea class="input-block-level" name="descripcion" id="descripcion" rows="4" required></textarea>
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