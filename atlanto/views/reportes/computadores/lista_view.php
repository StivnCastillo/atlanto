<?php 
	$ci = &get_instance();
?>

		<div class="row-fluid">
		    <form class="form-horizontal" action="<?php echo $accion; ?>" name="frmListaComputadores" method="POST">
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
							<input type="text" name="titulo" id="titulo" value="Lista de computadores" required />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="leyenda"><?php echo $ci->lang->line('lbl_leyenda'); ?></label>
						<div class="controls">
							<input type="text" name="leyenda" id="leyenda" value="<?php echo $config->repo_leyenda; ?>" required />
						</div>
					</div>

					<div class="control-group">
						<div class="controls">
							<button type="submit" name="guardar" class="btn btn-inverse"><i class="icon icon-download-alt icon-white"></i> <?php echo $ci->lang->line('btn_guardar'); ?></button>
							<a href="<?php echo base_url().'reporte'; ?>" name="cancelar" class="btn"><?php echo $ci->lang->line('btn_cancelar'); ?></a>
						</div>
					</div>
				</div>
			</form>
		</div>