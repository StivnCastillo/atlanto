<?php 
$ci = &get_instance();
?>

		<form class="form-horizontal" action="<?php echo $accion; ?>" name="frmListaTareas" method="POST">
			<div class="row-fluid">
			    <div class="span5">
					<div class="control-group">
						<label class="control-label" for="horientacion"><?php echo $ci->lang->line('lbl_horientacion'); ?></label>
						<div class="controls">
							<select name="horientacion" id="horientacion" required>
								<option value="PORTRAIT" <?php echo ($config->repo_horientacion == 'P') ? 'selected="selected"': ''; ?>><?php echo $ci->lang->line('rep_vertical'); ?></option>
								<option value="LANDSCAPE" <?php echo ($config->repo_horientacion == 'L') ? 'selected="selected"': ''; ?>><?php echo $ci->lang->line('rep_horizontal'); ?></option>
							</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="formato"><?php echo $ci->lang->line('lbl_formato'); ?></label>
						<div class="controls">
							<select name="formato" id="formato" required>
								<option value="P" <?php echo ($config->repo_formato == 'A4') ? 'selected="selected"': ''; ?>><?php echo $config->repo_formato ?></option>
							</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="creador"><?php echo $ci->lang->line('lbl_creador'); ?></label>
						<div class="controls">
							<input type="text" name="creador" id="creador" value="<?php echo $this->session->userdata('nombre'); ?>" required />
						</div>
					</div>
				</div>
				<div class="span5">

					<div class="control-group">
						<label class="control-label" for="autor"><?php echo $ci->lang->line('lbl_autor'); ?></label>
						<div class="controls">
							<input type="text" name="autor" id="autor" value="<?php echo $this->session->userdata('nombre'); ?>" required />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="titulo"><?php echo $ci->lang->line('lbl_titulo'); ?></label>
						<div class="controls">							
							<select name="titulo" id="titulo" required>
								<option value="1">'Computador (fecha)'</option>
								<option value="2">Nombre del Equipo (fecha)</option>
								<option value="3">Nombre del Usuario (fecha)</option>
							</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="leyenda"><?php echo $ci->lang->line('lbl_leyenda'); ?></label>
						<div class="controls">
							<input type="text" name="leyenda" id="leyenda" value="<?php echo $config->repo_leyenda; ?>" required />
						</div>
					</div>
					
				</div>
			</div>

			<hr>

			<div class="row-fluid">
				<!-- Si no esta definido el computador -->
				<?php if (!isset($id_computador)): ?>
					<div class="span5">
						<!-- computador -->
						<div class="control-group">
							<label class="control-label" for="computador">Elegir Computador</label>
							<div class="controls">
								<input type="text" class="span3" id="icomputador" name="icomputador" data-url="<?php echo $accion_computador; ?>" />
								<select class="span9" name="id_computador" id="computador">
									<?php if (isset($computador)): ?>
										<option value="<?php echo $computador->idcomputador ?>"><?php echo $computador->ubicacion ?></option>											
									<?php else: ?>
										<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
									<?php endif ?>								
								</select>
							</div>
						</div>
					</div>
				<?php else: ?>
					<input type="hidden" name="id_computador" value="<?php echo $id_computador; ?>">
				<?php endif ?>
				<div class="span5">
					<div class="control-group">
						<div class="controls">
							<label class="checkbox" for="componentes">
								<input type="checkbox" name="componentes" id="componentes" checked> Componentes
							</label>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<label class="checkbox" for="conexiones">
								<input type="checkbox" name="conexiones" id="conexiones" checked> Conexiones
							</label>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<label class="checkbox" for="software">
								<input type="checkbox" name="software" id="software" checked> Software
							</label>
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<label class="checkbox" for="historial">
								<input type="checkbox" name="historial" id="historial" checked> Historial (en desarrollo)
							</label>
						</div>
					</div>
				</div>
			</div>

			<hr>

			<div class="row-fluid">
				<div class="span5 offset5">
					<div class="control-group">
						<div class="controls">
							<button type="submit" name="guardar" class="btn btn-inverse"><i class="icon icon-download-alt icon-white"></i> <?php echo $ci->lang->line('btn_guardar'); ?></button>
							<a href="<?php echo base_url().'reporte'; ?>" name="cancelar" class="btn"><?php echo $ci->lang->line('btn_cancelar'); ?></a>
						</div>
					</div>
				</div>
			</div>
		</form>