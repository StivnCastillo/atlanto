<?php 
$ci = &get_instance();
?>
		<div class="row-fluid">
		    <form class="form-horizontal" action="<?php echo $accion; ?>" name="frmListaTareas" method="POST">
			    <div class="row">
				    <div class="span5">
				    	<!-- fecha inicio -->
						<div class="control-group">
							<label class="control-label" for="fecha_inicio"><?php echo $ci->lang->line('lbl_fecha_inicio') ?></label>
							<div class="controls">
								<div class="input-append date fecha">
									<input data-format="yyyy-MM-dd hh:mm:ss" name="fecha_inicio" type="text" />
									<span class="add-on">
										<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
									</span>
								</div>
							</div>
						</div>
						<!-- usuario -->
						<div class="control-group">
							<label class="control-label" for="id_usuario"><?php echo $ci->lang->line('lbl_usuario') ?></label>
							<div class="controls">
								<select name="id_usuario" id="id_usuario">
									<option value="all" selected="selected"><?php echo $ci->lang->line('slc_todos') ?></option>
									<?php foreach ($usuarios as $row): ?>
										<option value="<?php echo $row->id; ?>"><?php echo $row->nombre." ".$row->apellido; ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<!-- columnas 
						<div class="control-group">
							<label class="control-label" for="columnas[]"><?php echo $ci->lang->line('lbl_columna'); ?></label>
							<div class="controls">
								<select name="columnas[]" id="columnas" multiple="multiple" size="6" >
									<option value="1" selected="selected"><?php echo $ci->lang->line('tab_estado'); ?></option>
									<option value="2" selected="selected"><?php echo $ci->lang->line('tab_titulo'); ?></option>
									<option value="3" selected="selected"><?php echo $ci->lang->line('tab_usuario_asignado'); ?></option>
									<option value="4" selected="selected"><?php echo $ci->lang->line('tab_fecha_inicio'); ?></option>
									<option value="5" selected="selected"><?php echo $ci->lang->line('tab_fecha_fin'); ?></option>
									<option value="6" selected="selected"><?php echo $ci->lang->line('tab_duracion'); ?></option>
								</select>
							</div>
						</div>-->

				    </div>
				    <div class="span5">
				    	<!-- fecha fin -->
						<div class="control-group">
							<label class="control-label" for="fecha_fin"><?php echo $ci->lang->line('lbl_fecha_fin') ?></label>
							<div class="controls">
								<div class="input-append date fecha">
									<input data-format="yyyy-MM-dd hh:mm:ss" name="fecha_fin" type="text" />
									<span class="add-on">
										<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
									</span>
								</div>
							</div>
						</div>
						<!-- estado -->
						<div class="control-group">
							<label class="control-label" for="estado"><?php echo $ci->lang->line('lbl_estado') ?></label>
							<div class="controls">
								<select name="estado" id="estado">
									<option value="all" selected="selected"><?php echo $ci->lang->line('slc_todos') ?></option>
									<option value="1"><?php echo $ci->lang->line('slc_terminada') ?></option>
									<option value="0"><?php echo $ci->lang->line('slc_no_terminada') ?></option>
								</select>
							</div>
						</div>						
				    </div>
				</div>
				<hr />
				<div class="row">
					<div class="span5">
						<!-- horientacion -->
						<div class="control-group">
							<label class="control-label" for="horientacion"><?php echo $ci->lang->line('lbl_horientacion'); ?></label>
							<div class="controls">
								<select name="horientacion" id="horientacion" required>
									<option value="PORTRAIT" <?php echo ($config->repo_horientacion == 'P') ? 'selected="selected"': ''; ?>><?php echo $ci->lang->line('rep_vertical'); ?></option>
									<option value="LANDSCAPE" <?php echo ($config->repo_horientacion == 'L') ? 'selected="selected"': ''; ?>><?php echo $ci->lang->line('rep_horizontal'); ?></option>
								</select>
							</div>
						</div>
						<!-- formato -->
						<div class="control-group">
							<label class="control-label" for="formato"><?php echo $ci->lang->line('lbl_formato'); ?></label>
							<div class="controls">
								<select name="formato" id="formato" required>
									<option value="P" <?php echo ($config->repo_formato == 'A4') ? 'selected="selected"': ''; ?>><?php echo $config->repo_formato ?></option>
								</select>
							</div>
						</div>
						<!-- creador -->
						<div class="control-group">
							<label class="control-label" for="creador"><?php echo $ci->lang->line('lbl_creador'); ?></label>
							<div class="controls">
								<input type="text" name="creador" id="creador" value="<?php echo $this->session->userdata('nombre'); ?>" required />
							</div>
						</div>
						<!-- nombre de archivo -->
						<div class="control-group">
							<label class="control-label" for="nombre_archivo"><?php echo $ci->lang->line('lbl_nombre_archivo'); ?></label>
							<div class="controls">
								<div class="input-append">
									<input class="span6" type="text" name="nombre_archivo" id="nombre_archivo" value="<?php echo $ci->lang->line('rep_men_personalizar'); ?>" required />
									<span class="add-on"><?php echo date('Y-m-d'); ?>.pdf</span>
								</div>
							</div>
						</div>
					</div>
					
					<div class="span5">
						<!-- autor -->
						<div class="control-group">
							<label class="control-label" for="autor"><?php echo $ci->lang->line('lbl_autor'); ?></label>
							<div class="controls">
								<input type="text" name="autor" id="autor" value="<?php echo $this->session->userdata('nombre'); ?>" required />
							</div>
						</div>
						<!-- titulo -->
						<div class="control-group">
							<label class="control-label" for="titulo"><?php echo $ci->lang->line('lbl_titulo'); ?></label>
							<div class="controls">
								<input type="text" name="titulo" id="titulo" value="<?php echo $this->lang->line('rep_tareas_lista'); ?>" required />
							</div>
						</div>
						<!-- leyenda -->
						<div class="control-group">
							<label class="control-label" for="leyenda"><?php echo $ci->lang->line('lbl_leyenda'); ?></label>
							<div class="controls">
								<input type="text" name="leyenda" id="leyenda" value="<?php echo $config->repo_leyenda; ?>" required />
							</div>
						</div>
						<!-- botones -->
						<div class="control-group">
							<div class="controls">
								<button type="submit" name="guardar" class="btn btn-inverse"><i class="icon icon-download-alt icon-white"></i> <?php echo $ci->lang->line('btn_guardar'); ?></button>
								<a href="<?php echo base_url().'reporte'; ?>" name="cancelar" class="btn"><?php echo $ci->lang->line('btn_cancelar'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>