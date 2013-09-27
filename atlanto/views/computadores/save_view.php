<?php 
	$ci = &get_instance();
?>
<?php if (isset($computador)): ?>
	<article class="well">
		<form class="form-inline">
			<a href="<?php echo base_url().'reporte/computador/'.$computador->id;; ?>" id="btn_agregar" class="btn btn-inverse" title="Imprimir"><i class="icon icon-print icon-white"></i></a>
		</form>
	</article>
<?php endif ?>
		<div class="tabbable">
			<!-- MENU AGREGAR COMPUTADOR -->
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#tab1" data-toggle="tab"><?php echo $ci->lang->line('tab_com_computador'); ?></a>
				</li>
				<?php if (isset($computador)): ?>
					<li>
						<a href="#tab2" data-toggle="tab">Historial</a>
					</li>
				<?php endif ?>									
			</ul>

	    	<?php if ($this->session->flashdata('mensaje')): ?>
	    		<!-- mensaje, error, completado, peligro -->
	    		<!-- mensaje de exito -->
	    		<?php if ($this->session->flashdata('tipo_mensaje') == 'exito'): ?>
	    			<div class="alert alert-success">
			            <button type="button" class="close" data-dismiss="alert">×</button>
			            <?php echo $this->session->flashdata('mensaje') ?>
		            </div>
	    		<?php endif ?>
			    	
				<?php if ($this->session->flashdata('tipo_mensaje') == 'error'): ?>
		            <div class="alert alert-error">
			            <button type="button" class="close" data-dismiss="alert">×</button>
			            <?php echo $this->session->flashdata('mensaje') ?>
		            </div>
		        <?php endif ?>
				
				<?php if ($this->session->flashdata('tipo_mensaje') == 'cuidado'): ?>
		            <div class="alert alert-warning">
			            <button type="button" class="close" data-dismiss="alert">×</button>
			            <?php echo $this->session->flashdata('mensaje') ?>
		            </div>
	            <?php endif ?>
	    	<?php endif ?>

            <!-- DATOS DIRECTOS DEL COMPUTADOR -->
	    	<div class="tab-content">

	    		<!-- PESTAÑA 1 -->
	    		<div class="tab-pane active" id="tab1">
					<article class="row">
						<form class="form-horizontal" id="frmComputador" name="frmComputador" action="<?php echo (isset($computador)) ? $accion_modificar : $accion_guardar; ?>" method="POST">
							<?php if (isset($computador)): ?>
	    						<input type="hidden" name="id_computador" value="<?php echo $id_computador; ?>">
	    					<?php endif ?>
							<div class="span5">

								<!-- nombre -->
								<div class="control-group">
									<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="nombre" name="nombre" value="<?php echo (isset($computador)) ? $computador->nombre_computador : ''; ?>" required />
									</div>
								</div>

								<!-- ubicacion -->
								<div class="control-group">
									<label class="control-label" for="ubicacion"><?php echo $ci->lang->line('lbl_ubicacion') ?></label>
									<div class="controls">
										<input type="text" class="span1" id="iubicacion" name="iubicacion" data-url="<?php echo $accion_ubicacion; ?>" />
										<select class="span2" name="ubicacion" id="ubicacion">
											<?php if (isset($computador)): ?>
												<option value="<?php echo $computador->idubicacion ?>"><?php echo $computador->ubicacion ?></option>											
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
											
										</select>
									</div>
								</div>
								<!-- usuario -->
								<div class="control-group">
									<label class="control-label" for="usuario"><?php echo $ci->lang->line('lbl_usuario') ?></label>
									<div class="controls">
										<input type="text" class="span1" id="iusuario" name="iusuario" data-url="<?php echo $accion_usuario; ?>" />
										<select class="span2" name="usuario" id="usuario">
											<?php if (isset($computador)): ?>
												<option value="<?php echo $computador->idusuario ?>"><?php echo $computador->nombre_usuario ?></option>											
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<!-- estado -->
								<div class="control-group">
									<label class="control-label" for="estado"><?php echo $ci->lang->line('lbl_estado') ?></label>
									<div class="controls">
										<select name="estado" id="estado" required>
											<option value=""><?php echo $ci->lang->line('slc_ninguno'); ?></option>
											<?php if (isset($estados)): ?>
												<?php foreach ($estados as $row): ?>
													<option value="<?php echo $row->id; ?>" <?php if(isset($computador)){if($computador->id_estado == $row->id){echo 'selected="selected"';}} ?>><?php echo $row->nombre; ?></option>
												<?php endforeach ?>
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<!-- dominio -->
								<div class="control-group">
									<label class="control-label" for="dominio"><?php echo $ci->lang->line('lbl_dominio') ?></label>
									<div class="controls">
										<select name="dominio" id="dominio">
											<option value=""><?php echo $ci->lang->line('slc_ninguno'); ?></option>
											<?php if (isset($dominios)): ?>
												<?php foreach ($dominios as $row): ?>													
													<option value="<?php echo $row->id; ?>" <?php if(isset($computador)){if($computador->id_dominio == $row->id){echo 'selected="selected"';}} ?> ><?php echo $row->nombre; ?></option>
												<?php endforeach ?>
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<!-- red -->
								<div class="control-group">
									<label class="control-label" for="red"><?php echo $ci->lang->line('lbl_red') ?></label>
									<div class="controls">
										<select name="red" id="red">
											<option value=""><?php echo $ci->lang->line('slc_ninguno'); ?></option>
											<?php if (isset($redes)): ?>
												<?php foreach ($redes as $row): ?>													
													<option value="<?php echo $row->id; ?>" <?php if(isset($computador)){if($computador->id_red == $row->id){echo 'selected="selected"';}} ?> ><?php echo $row->nombre; ?></option>
												<?php endforeach ?>
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<!-- sistema operativo -->
								<div class="control-group">
									<label class="control-label" for="so"><?php echo $ci->lang->line('lbl_so') ?></label>
									<div class="controls">
										<select name="so" id="so" required>
											<option value=""><?php echo $ci->lang->line('slc_ninguno'); ?></option>
											<?php if (isset($sistema_o)): ?>
												<?php foreach ($sistema_o as $row): ?>													
													<option value="<?php echo $row->id; ?>" <?php if(isset($computador)){if($computador->id_SO == $row->id){echo 'selected="selected"';}} ?> ><?php echo $row->nombre.' '.$row->version.' '.$row->tipo_so; ?></option>
												<?php endforeach ?>
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

							</div>

							<div class="span5">
								<!-- tipo -->
								<div class="control-group">
									<label class="control-label" for="tipo"><?php echo $ci->lang->line('lbl_tipo') ?></label>
									<div class="controls">
										<select name="tipo" id="tipo" required>
											<option value=""><?php echo $ci->lang->line('slc_ninguno'); ?></option>
											<?php if (isset($tipos)): ?>
												<?php foreach ($tipos as $row): ?>
													<option value="<?php echo $row->id; ?>" <?php if(isset($computador)){if($computador->id_tipo == $row->id){echo 'selected="selected"';}} ?> ><?php echo $row->nombre; ?></option>
												<?php endforeach ?>
											<?php else: ?>
												<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
											<?php endif ?>
										</select>
									</div>
								</div>

								<!-- fabricante -->
								<div class="control-group">
									<label class="control-label" for="fabricante"><?php echo $ci->lang->line('lbl_fabricante') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="fabricante" name="fabricante" value="<?php echo (isset($computador)) ? $computador->fabricante : ''; ?>" required />
									</div>
								</div>

								<!-- modelo -->
								<div class="control-group">
									<label class="control-label" for="modelo"><?php echo $ci->lang->line('lbl_modelo') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="modelo" name="modelo" value="<?php echo (isset($computador)) ? $computador->modelo : ''; ?>" required />
									</div>
								</div>

								<!-- serie -->
								<div class="control-group">
									<label class="control-label" for="serie"><?php echo $ci->lang->line('lbl_serie') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="serie" name="serie" value="<?php echo (isset($computador)) ? $computador->n_serie : ''; ?>" required />
									</div>
								</div>

								<!-- activo -->
								<div class="control-group">
									<label class="control-label" for="activo"><?php echo $ci->lang->line('lbl_activo') ?></label>
									<div class="controls">
										<input type="text" class="span3" id="activo" name="activo" value="<?php echo (isset($computador)) ? $computador->n_activo : ''; ?>" />
									</div>
								</div>

								<!-- comentario -->
								<div class="control-group">
									<label class="control-label" for="comentario"><?php echo $ci->lang->line('lbl_comentario') ?></label>
									<div class="controls">
										<textarea class="span3" rows="4" name="comentario" id="comentario"><?php echo (isset($computador)) ? $computador->comentarios : ''; ?></textarea>
									</div>
								</div>

								<div class="control-group">
									<div class="controls">
										<button type="submit" class="btn btn-inverse"><?php echo $this->lang->line('btn_guardar'); ?></button>
										<a href="<?php echo base_url().'panel/usuarios' ?>" class="btn"><?php echo $this->lang->line('btn_cancelar'); ?></a>
									</div>
								</div>
							</div>

						</form>
					</article>

					<?php if (isset($computador)): ?>
						<article class="row">
							<div class="span12">
								<div class="accordion" id="conexiones">
									<!-- pestaña 1 -->
									<div class="accordion-group">
										<div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#conexiones" href="#pes_monitor">
												<i class="icon-desktop"></i>
												Monitor
											</a>
										</div>
										<div id="pes_monitor" class="accordion-body collapse in">
											<div class="accordion-inner">
												<!-- monitor -->
												<div class="well">
													<?php if (isset($con_monitores)): ?>

														<!-- alertas -->
														<?php if ($this->session->flashdata('mensaje_con_monitor')): ?>
												    		<?php if ($this->session->flashdata('tipo_mensaje') == 'exito'): ?>
												    			<div class="alert alert-success">
														            <button type="button" class="close" data-dismiss="alert">×</button>
														            <?php echo $this->session->flashdata('mensaje_con_monitor') ?>
													            </div>
												    		<?php endif ?>
														    	
															<?php if ($this->session->flashdata('tipo_mensaje') == 'error'): ?>
													            <div class="alert alert-error">
														            <button type="button" class="close" data-dismiss="alert">×</button>
														            <?php echo $this->session->flashdata('mensaje_con_monitor') ?>
													            </div>
													        <?php endif ?>
												    	<?php endif ?>

														<?php if ($con_monitores): ?>
															<table class="table table-bordered">
																<thead>
																	<tr>
																		<th>Nombre</th>
																		<th># Serie</th>
																		<th>Fabricante</th>
																		<th>Modelo</th>
																		<th>&nbsp;</th>
																	</tr>									
																</thead>
																<tbody>
																	<?php $i = 0;$monitores_conectados = array(); ?>
																	<?php foreach ($con_monitores as $row):?>
																		<tr>
																			<td><a href="<?php echo base_url().'monitor/nuevo/'.$row->id_monitor; ?>"><?php echo $row->nombre; ?></a></td>
																			<td><?php echo $row->n_serie; ?></td>
																			<td><?php echo $row->fabricante; ?></td>
																			<td><?php echo $row->modelo; ?></td>
																			<td colspan="4">
																				<a href="<?php echo base_url().'computador/eliminar_monitor/'.$id_computador.'/'.$row->id; ?>" class="btn btn-danger btn-mini"><i class="icon-remove"></i></a>
																			</td>
																		</tr>
																		<?php $monitores_conectados[$i++] = $row->id_monitor;?>
																	<?php endforeach ?>																		
																</tbody>
															</table>
														<?php else: ?>
															<p>No se Encontraron Monitores</p>
														<?php endif ?>

														<form class="form-inline">
															<label for="id_monitor">Conectar Monitor</label>
															<select name="id_monitor" id="slc_com_mon" data-url="<?php echo base_url().'computador/conectar_monitor/'.$id_computador; ?>">
																<option value="">--</option>
																<?php foreach ($lis_monitores as $row): ?>
																	<option value="<?php echo $row->id ?>"><?php echo $row->nombre; ?> - <?php echo $row->n_serie; ?></option>
																<?php endforeach ?>
															</select>
															<button type="button" class="btn btn-info" id="btn_com_mon"><i class="icon-ok"></i></button>
															<a href="#new_monitor" data-toggle="modal" class="btn btn-info"><i class="icon-plus"></i></a>
														</form>

														<!-- POPUP MONITOR -->
														<div id="new_monitor" class="modal hide fade modal-970" >
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																<h3 id="myModalLabel">Nuevo Monitor</h3>
															</div>
															<div class="modal-body">
																<form class="form-horizontal" id="frmmonitor" name="frmmonitor" action="<?php echo $accion_monitor; ?>" method="POST">
																	<input type="hidden" name="usuario" value="<?php echo $computador->idusuario ?>" />
																	<input type="hidden" name="ubicacion" value="<?php echo $computador->idubicacion ?>" />
																	<div class="span4">

																		<!-- nombre -->
																		<div class="control-group">
																			<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre') ?></label>
																			<div class="controls">
																				<input type="text" class="span3" id="nombre" name="nombre" value="<?php echo (isset($monitor)) ? $monitor->nombre : ''; ?>" required />
																			</div>
																		</div>

																		<!-- estado -->
																		<div class="control-group">
																			<label class="control-label" for="estado"><?php echo $ci->lang->line('lbl_estado') ?></label>
																			<div class="controls">
																				<select name="estado" id="estado" required>
																					<option value=""><?php echo $ci->lang->line('slc_ninguno'); ?></option>
																					<?php if (isset($estados)): ?>
																						<?php foreach ($estados as $row): ?>
																							<option value="<?php echo $row->id; ?>" <?php if(isset($monitor)){if($monitor->id_estado == $row->id){echo 'selected="selected"';}} ?>><?php echo $row->nombre; ?></option>
																						<?php endforeach ?>
																					<?php else: ?>
																						<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
																					<?php endif ?>
																				</select>
																			</div>
																		</div>

																		<!-- tipo -->
																		<div class="control-group">
																			<label class="control-label" for="tipo"><?php echo $ci->lang->line('lbl_tipo') ?></label>
																			<div class="controls">
																				<select name="tipo" id="tipo" required>
																					<option value=""><?php echo $ci->lang->line('slc_ninguno'); ?></option>
																					<?php if (isset($tipo_mon)): ?>
																						<?php foreach ($tipo_mon as $row): ?>
																							<option value="<?php echo $row->id; ?>" <?php if(isset($monitor)){if($monitor->id_tipo_monitor == $row->id){echo 'selected="selected"';}} ?> ><?php echo $row->nombre; ?></option>
																						<?php endforeach ?>
																					<?php else: ?>
																						<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
																					<?php endif ?>
																				</select>
																			</div>
																		</div>

																		<!-- interfaz -->
																		<div class="control-group">
																			<label class="control-label" for="interfaz"><?php echo $ci->lang->line('lbl_interfaz') ?></label>
																			<div class="controls">
																				<select name="interfaz" id="interfaz" required>
																					<option value=""><?php echo $ci->lang->line('slc_ninguno'); ?></option>
																					<?php if (isset($interfaz)): ?>
																						<?php foreach ($interfaz as $row): ?>
																							<option value="<?php echo $row->id; ?>" <?php if(isset($monitor)){if($monitor->id_interfaz_monitor == $row->id){echo 'selected="selected"';}} ?> ><?php echo $row->nombre; ?></option>
																						<?php endforeach ?>
																					<?php else: ?>
																						<option value=""><?php echo $ci->lang->line('msj_error_resultado'); ?></option>
																					<?php endif ?>
																				</select>
																			</div>
																		</div>

																		<!-- tamano -->
																		<div class="control-group">
																			<label class="control-label" for="tamano"><?php echo $ci->lang->line('lbl_tamano') ?></label>
																			<div class="controls">
																				<input type="text" class="span1" id="tamano" name="tamano" value="<?php echo (isset($monitor)) ? $monitor->tamano : ''; ?>" required /> "
																			</div>
																		</div>
																	</div>

																	<div class="span4">
																		<!-- fabricante -->
																		<div class="control-group">
																			<label class="control-label" for="fabricante"><?php echo $ci->lang->line('lbl_fabricante') ?></label>
																			<div class="controls">
																				<input type="text" class="span3" id="fabricante" name="fabricante" value="<?php echo (isset($monitor)) ? $monitor->fabricante : ''; ?>" required />
																			</div>
																		</div>

																		<!-- modelo -->
																		<div class="control-group">
																			<label class="control-label" for="modelo"><?php echo $ci->lang->line('lbl_modelo') ?></label>
																			<div class="controls">
																				<input type="text" class="span3" id="modelo" name="modelo" value="<?php echo (isset($monitor)) ? $monitor->modelo : ''; ?>" required />
																			</div>
																		</div>

																		<!-- serie -->
																		<div class="control-group">
																			<label class="control-label" for="serie"><?php echo $ci->lang->line('lbl_serie') ?></label>
																			<div class="controls">
																				<input type="text" class="span3" id="serie" name="serie" value="<?php echo (isset($monitor)) ? $monitor->n_serie : ''; ?>" required />
																			</div>
																		</div>

																		<!-- activo -->
																		<div class="control-group">
																			<label class="control-label" for="activo"><?php echo $ci->lang->line('lbl_activo') ?></label>
																			<div class="controls">
																				<input type="text" class="span3" id="activo" name="activo" value="<?php echo (isset($monitor)) ? $monitor->n_activo : ''; ?>" />
																			</div>
																		</div>

																		<div class="control-group">
																			<div class="controls">
																				<button type="submit" class="btn btn-inverse"><?php echo $this->lang->line('btn_guardar'); ?></button>
																				<a href="<?php echo base_url().'panel/usuarios' ?>" class="btn"><?php echo $this->lang->line('btn_cancelar'); ?></a>
																			</div>
																		</div>
																	</div>

																</form>
															</div>
															<div class="modal-footer">
																<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $ci->lang->line('btn_cerrar'); ?></button>
																<a href="<?php echo base_url().'computador/eliminar/'.$row->id ?>" class="btn btn-primary"><?php echo $ci->lang->line('btn_eliminar'); ?></a>
															</div>
														</div>

													<?php endif ?>
												</div>
											</div>
										</div>
									</div>
									<!-- pestaña 2 -->
									<div class="accordion-group">
										<div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#conexiones" href="#pes_impresora">
												<i class="icon-print"></i>
												Impresora
											</a>
										</div>
										<div id="pes_impresora" class="accordion-body collapse">
											<div class="accordion-inner">
												<!-- impresora -->
												<div class="well">
													<?php if (isset($con_impresoras)): ?>

														<!-- alertas -->
														<?php if ($this->session->flashdata('mensaje_con_impresora')): ?>
												    		<?php if ($this->session->flashdata('tipo_mensaje') == 'exito'): ?>
												    			<div class="alert alert-success">
														            <button type="button" class="close" data-dismiss="alert">×</button>
														            <?php echo $this->session->flashdata('mensaje_con_impresora') ?>
													            </div>
												    		<?php endif ?>
														    	
															<?php if ($this->session->flashdata('tipo_mensaje') == 'error'): ?>
													            <div class="alert alert-error">
														            <button type="button" class="close" data-dismiss="alert">×</button>
														            <?php echo $this->session->flashdata('mensaje_con_impresora') ?>
													            </div>
													        <?php endif ?>
												    	<?php endif ?>

														<?php if ($con_impresoras): ?>
															<table class="table table-bordered">
																<thead>
																	<tr>
																		<th>Nombre</th>
																		<th># Serie</th>
																		<th>Fabricante</th>
																		<th>Modelo</th>
																		<th>&nbsp;</th>
																	</tr>									
																</thead>
																<tbody>
																	<?php $i = 0;$impresoras_conectados = array(); ?>
																	<?php foreach ($con_impresoras as $row):?>
																		<tr>
																			<td><a href="<?php echo base_url().'impresora/nuevo/'.$row->id_impresora; ?>"><?php echo $row->nombre; ?></a></td>
																			<td><?php echo $row->n_serie; ?></td>
																			<td><?php echo $row->fabricante; ?></td>
																			<td><?php echo $row->modelo; ?></td>
																			<td colspan="4">
																				<a href="<?php echo base_url().'computador/eliminar_impresora/'.$id_computador.'/'.$row->id; ?>" class="btn btn-danger btn-mini"><i class="icon-remove"></i></a>
																			</td>
																		</tr>
																		<?php $impresoras_conectados[$i++] = $row->id_impresora;?>
																	<?php endforeach ?>																		
																</tbody>
															</table>
														<?php else: ?>
															<p>No se Encontraron Impresoras</p>
														<?php endif ?>


														<form class="form-inline">
															<label for="id_impresora">Conectar Impresora</label>
															<select name="id_impresora" id="slc_com_imp" data-url="<?php echo base_url().'computador/conectar_impresora/'.$id_computador; ?>">
																<?php foreach ($lis_impresoras as $row): ?>																																													
																	<option value="<?php echo $row->id ?>"><?php echo $row->nombre; ?> - <?php echo $row->n_serie; ?></option>
																<?php endforeach ?>
															</select>
															<button type="button" class="btn btn-info" id="btn_com_imp"><i class="icon-plus-sign"></i></button>
														</form>
													<?php endif ?>
												</div>
											</div>
										</div>
									</div>
									<!-- pestaña 3 -->
									<div class="accordion-group">
										<div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#conexiones" href="#pes_dispositivo">
												<i class="icon-keyboard"></i>
												Dispositivo
											</a>
										</div>
										<div id="pes_dispositivo" class="accordion-body collapse">
											<div class="accordion-inner">
												<!-- dispositivo -->									
												<div class="well">
													<?php if (isset($con_dispositivos)): ?>

														<!-- alertas -->
														<?php if ($this->session->flashdata('mensaje_con_dispositivo')): ?>
												    		<?php if ($this->session->flashdata('tipo_mensaje') == 'exito'): ?>
												    			<div class="alert alert-success">
														            <button type="button" class="close" data-dismiss="alert">×</button>
														            <?php echo $this->session->flashdata('mensaje_con_dispositivo') ?>
													            </div>
												    		<?php endif ?>
														    	
															<?php if ($this->session->flashdata('tipo_mensaje') == 'error'): ?>
													            <div class="alert alert-error">
														            <button type="button" class="close" data-dismiss="alert">×</button>
														            <?php echo $this->session->flashdata('mensaje_con_dispositivo') ?>
													            </div>
													        <?php endif ?>
												    	<?php endif ?>

														<?php if ($con_dispositivos): ?>
															<table class="table table-bordered">
																<thead>
																	<tr>
																		<th>Nombre</th>
																		<th># Serie</th>
																		<th>Fabricante</th>
																		<th>Modelo</th>
																		<th>&nbsp;</th>
																	</tr>									
																</thead>
																<tbody>
																	<?php $i = 0;$dispositivos_conectados = array(); ?>
																	<?php foreach ($con_dispositivos as $row):?>
																		<tr>
																			<td><a href="<?php echo base_url().'dispositivo/nuevo/'.$row->id_dispositivo; ?>"><?php echo $row->nombre; ?></a></td>
																			<td><?php echo $row->n_serie; ?></td>
																			<td><?php echo $row->fabricante; ?></td>
																			<td><?php echo $row->modelo; ?></td>
																			<td colspan="4">
																				<a href="<?php echo base_url().'computador/eliminar_dispositivo/'.$id_computador.'/'.$row->id; ?>" class="btn btn-danger btn-mini"><i class="icon-remove"></i></a>
																			</td>
																		</tr>
																		<?php $dispositivos_conectados[$i++] = $row->id_dispositivo;?>
																	<?php endforeach ?>																		
																</tbody>
															</table>
														<?php else: ?>
															<p>No se Encontraron dispositivos</p>
														<?php endif ?>


														<form class="form-inline">
															<label for="id_dispositivo">Conectar Dispositivo</label>
															<select name="id_dispositivo" id="slc_com_dis" data-url="<?php echo base_url().'computador/conectar_dispositivo/'.$id_computador; ?>">
																<?php foreach ($lis_dispositivos as $row): ?>																																					
																	<option value="<?php echo $row->id ?>"><?php echo $row->nombre; ?></option>
																<?php endforeach ?>
															</select>
															<button type="button" class="btn btn-info" id="btn_com_dis"><i class="icon-plus-sign"></i></button>
														</form>
													<?php endif ?>
												</div>
											</div>
										</div>
									</div>
									<!-- pestaña 4 -->
									<div class="accordion-group">
										<div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#conexiones" href="#pes_software">
												<i class="icon-windows"></i>
												Software
											</a>
										</div>
										<div id="pes_software" class="accordion-body collapse">
											<div class="accordion-inner">
												<!-- software -->									
												<div class="well">
													<?php if (isset($con_software)): ?>

														<!-- alertas -->
														<?php if ($this->session->flashdata('mensaje_con_software')): ?>
												    		<?php if ($this->session->flashdata('tipo_mensaje') == 'exito'): ?>
												    			<div class="alert alert-success">
														            <button type="button" class="close" data-dismiss="alert">×</button>
														            <?php echo $this->session->flashdata('mensaje_con_software') ?>
													            </div>
												    		<?php endif ?>
														    	
															<?php if ($this->session->flashdata('tipo_mensaje') == 'error'): ?>
													            <div class="alert alert-error">
														            <button type="button" class="close" data-dismiss="alert">×</button>
														            <?php echo $this->session->flashdata('mensaje_con_software') ?>
													            </div>
													        <?php endif ?>
												    	<?php endif ?>

														<?php if ($con_software): ?>
															<table class="table table-bordered">
																<thead>
																	<tr>
																		<th>Nombre</th>
																		<th>Versión</th>
																		<th>Fabricante</th>
																		<th>&nbsp;</th>
																	</tr>									
																</thead>
																<tbody>
																	<?php $i = 0;$software_conectado = array(); ?>
																	<?php foreach ($con_software as $row):?>
																		<tr>
																			<td><a href="<?php echo base_url().'software/nuevo/'.$row->id_software; ?>"><?php echo $row->nombre; ?></a></td>
																			<td><?php echo $row->version; ?></td>
																			<td><?php echo $row->fabricante; ?></td>
																			<td colspan="4">
																				<a href="<?php echo base_url().'computador/eliminar_software/'.$id_computador.'/'.$row->id; ?>" class="btn btn-danger btn-mini"><i class="icon-remove"></i></a>
																			</td>
																		</tr>
																		<?php $software_conectado[$i++] = $row->id_software;?>
																	<?php endforeach ?>																		
																</tbody>
															</table>
														<?php else: ?>
															<p>No se Encontró Software Instalado</p>
														<?php endif ?>


														<form class="form-inline">
															<label for="id_software">Instalar Software</label>
															<select name="id_software" id="slc_com_soft" data-url="<?php echo base_url().'computador/conectar_software/'.$id_computador; ?>">
																<?php foreach ($lis_software as $row): ?>																																					
																	<option value="<?php echo $row->id ?>"><?php echo $row->nombre; ?></option>
																<?php endforeach ?>
															</select>
															<button type="button" class="btn btn-info" id="btn_com_soft"><i class="icon-plus-sign"></i></button>
														</form>
													<?php endif ?>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</article>

						<article class="row-fluid">
							<div class="well">
								<form action="<?php echo $accion_componente; ?>" class="form-inline" method="POST">
									<label for="componente">Componente</label>
									<select name="componente" id="slc_componente" required>
										<option value="">--</option>

										<?php if ($discosduro): ?>												
											<option value="discoduro">Disco Duro</option>
										<?php endif ?>

										<?php if ($procesadores): ?>												
											<option value="procesador">Procesador</option>
										<?php endif ?>

										<?php if ($memorias): ?>												
											<option value="memoria">Memoria</option>
										<?php endif ?>

										<?php if ($tvideo): ?>												
											<option value="tvideo">Tarjeta de Video</option>
										<?php endif ?>
									</select>
									<select name="id_componente" id="slc_nombre_componente" required>
										<option value="">--</option>

										<?php if ($discosduro): ?>
											<?php foreach ($discosduro as $row): ?>													
												<option value="<?php echo $row->id ?>" class="discoduro"><?php echo $row->nombre; ?></option>
											<?php endforeach ?>
										<?php endif ?>

										<?php if ($procesadores): ?>
											<?php foreach ($procesadores as $row): ?>													
												<option value="<?php echo $row->id ?>" class="procesador"><?php echo $row->nombre; ?></option>
											<?php endforeach ?>
										<?php endif ?>

										<?php if ($memorias): ?>
											<?php foreach ($memorias as $row): ?>													
												<option value="<?php echo $row->id ?>" class="memoria"><?php echo $row->nombre.' '.$row->tamano.'GB'; ?></option>
											<?php endforeach ?>
										<?php endif ?>

										<?php if ($tvideo): ?>
											<?php foreach ($tvideo as $row): ?>													
												<option value="<?php echo $row->id ?>" class="tvideo"><?php echo $row->nombre; ?></option>
											<?php endforeach ?>
										<?php endif ?>

									</select>
									<input type="number" name="cantidad" id="cantidad" class="spinner span1" value="1">
									<button type="submit" class="btn btn-info" id="btn_com_dis"><i class="icon-plus-sign"></i></button>
								</form>
								<br>

								<!-- alertas -->
								<?php if ($this->session->flashdata('mensaje_con_componente')): ?>
						    		<?php if ($this->session->flashdata('tipo_mensaje') == 'exito'): ?>
						    			<div class="alert alert-success">
								            <button type="button" class="close" data-dismiss="alert">×</button>
								            <?php echo $this->session->flashdata('mensaje_con_componente') ?>
							            </div>
						    		<?php endif ?>
								    	
									<?php if ($this->session->flashdata('tipo_mensaje') == 'error'): ?>
							            <div class="alert alert-error">
								            <button type="button" class="close" data-dismiss="alert">×</button>
								            <?php echo $this->session->flashdata('mensaje_con_componente') ?>
							            </div>
							        <?php endif ?>
						    	<?php endif ?>
								<table class="table table-bordered tabla">
									<thead>
										<tr>
											<th style="width:20%;">Cantidad</th>
											<th>Componente</th>
											<th>Nombre</th>
											<th>Fabricante</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
										<?php if ($discoduro_con): ?>
											<?php foreach ($discoduro_con as $row): ?>
												<tr>
													<td><input type="number" name="cantidad" id="cantidad" class="spinner span5" value="<?php echo $row->cantidad; ?>"></td>
													<td>Disco Duro</td>
													<td><?php echo $row->nombre; ?></td>
													<td><?php echo $row->fabricante; ?></td>
													<td colspan="4">
														<a href="<?php echo base_url().'computador/desconectar_componente/'.$id_computador.'/'.$row->id.'/1'; ?>" class="btn btn-danger btn-mini"><i class="icon-remove"></i></a>
														<a href="<?php echo base_url().'computador/modificar_componente/'.$id_computador.'/'.$row->id.'/1'; ?>" class="btn btn-info btn-mini"><i class="icon-wrench"></i></a>
													</td>
												</tr>
											<?php endforeach ?>
										<?php endif ?>

										<?php if ($memoria_con): ?>
											<?php foreach ($memoria_con as $row): ?>
												<tr>
													<td><input type="number" name="cantidad" id="cantidad" class="spinner span5" value="<?php echo $row->cantidad; ?>"></td>
													<td>Memoria</td>
													<td><?php echo $row->nombre.' '.$row->tamano.'GB'; ?></td>
													<td><?php echo $row->fabricante; ?></td>
													<td colspan="4">
														<a href="<?php echo base_url().'computador/desconectar_componente/'.$id_computador.'/'.$row->id.'/2'; ?>" class="btn btn-danger btn-mini"><i class="icon-remove"></i></a>
														<a href="<?php echo base_url().'computador/modificar_componente/'.$id_computador.'/'.$row->id.'/2'; ?>" class="btn btn-info btn-mini"><i class="icon-wrench"></i></a>
													</td>
												</tr>
											<?php endforeach ?>
										<?php endif ?>

										<?php if ($procesador_con): ?>
											<?php foreach ($procesador_con as $row): ?>
												<tr>
													<td><input type="number" name="cantidad" id="cantidad" class="spinner span5" value="<?php echo $row->cantidad; ?>"></td>
													<td>Procesador</td>
													<td><?php echo $row->nombre; ?></td>
													<td><?php echo $row->fabricante; ?></td>
													<td colspan="4">
														<a href="<?php echo base_url().'computador/desconectar_componente/'.$id_computador.'/'.$row->id.'/3'; ?>" class="btn btn-danger btn-mini"><i class="icon-remove"></i></a>
														<a href="<?php echo base_url().'computador/modificar_componente/'.$id_computador.'/'.$row->id.'/3'; ?>" class="btn btn-info btn-mini"><i class="icon-wrench"></i></a>
													</td>
												</tr>
											<?php endforeach ?>
										<?php endif ?>

										<?php if ($tvideo_con): ?>
											<?php foreach ($tvideo_con as $row): ?>
												<tr>
													<td><input type="number" name="cantidad" id="cantidad" class="spinner span5" value="<?php echo $row->cantidad; ?>"></td>
													<td>Tarjeta de Video</td>
													<td><?php echo $row->nombre; ?></td>
													<td><?php echo $row->fabricante; ?></td>
													<td colspan="4">
														<a href="<?php echo base_url().'computador/desconectar_componente/'.$id_computador.'/'.$row->id.'/4'; ?>" class="btn btn-danger btn-mini"><i class="icon-remove"></i></a>
														<a href="<?php echo base_url().'computador/modificar_componente/'.$id_computador.'/'.$row->id.'/4'; ?>" class="btn btn-info btn-mini"><i class="icon-wrench"></i></a>
													</td>
												</tr>
											<?php endforeach ?>
										<?php endif ?>
									</tbody>
								</table>								
							</div>
						</article>
					<?php endif ?>
						
				</div>

				<!-- PESTAÑA 2 -->
				<div class="tab-pane" id="tab2">
					<?php if ($historial): ?>
					    <table class="table table-condensed table-bordered tabla">
							<thead>
								<tr>
									<th>&nbsp;</th>
									<th>Fecha</th>
									<th>Descripción</th>
									<th>Valor Anterior</th>
									<th>Valor Nuevo</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php foreach ($historial as $row): ?>									
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $row->fecha; ?></td>
										<td><?php echo $row->descripcion; ?></td>
										<td><?php echo $row->ant_valor; ?></td>
										<td><?php echo $row->new_valor; ?></td>
									</tr>
									<?php $i++; ?>
								<?php endforeach ?>
							</tbody>
						</table>
					<?php endif ?>
				</div>
			</div>
</div>