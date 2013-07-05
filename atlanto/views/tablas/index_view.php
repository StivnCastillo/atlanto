<?php 
$ci = &get_instance();
?>
		<div class="row-fluid">
		    <div class="tabbable"> <!-- Only required for left/right tabs -->
				<ul class="nav nav-tabs">
					<li class="active"><a href="#cargos" data-toggle="tab"><?php echo $ci->lang->line('men_tab_cargos'); ?></a></li>
					<li><a href="#departamentos" data-toggle="tab"><?php echo $ci->lang->line('men_tab_dep'); ?></a></li>
					<li><a href="#ubicaciones" data-toggle="tab"><?php echo $ci->lang->line('men_tab_ubicacion'); ?></a></li>
				</ul>
				<br>
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

				<div class="tab-content">
					<div class="tab-pane active" id="cargos">
						<!-- MENU DE SECCION -->
						<ul class="breadcrumb">
						    <li><a href="#agregar-cargo" data-toggle="modal"><?php echo $ci->lang->line('lnk_agregar'); ?></a> <span class="divider">/</span></li>
						</ul>

						<article class="well">
							<table class="table table-striped table-hover tabla">
								<thead>
									<tr>
										<th><?php echo $ci->lang->line('tab_numero'); ?></th>
										<th><?php echo $ci->lang->line('tab_nombre'); ?></th>
										<th><?php echo $ci->lang->line('tab_descripcion'); ?></th>
										<th class="tabla-center">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									<?php foreach ($cargos as $row): ?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><a href=""><?php echo $row->nombre; ?></a></td>
											<td><?php echo $row->descripcion; ?></td>
											<td class="tabla-center">
												<div class="btn-group">
													<a class="btn btn-small" href="#vnt_eliminar<?php echo $row->id; ?>" data-toggle="modal">
														<i class="icon-remove icon-black"></i>
													</a>
												</div>
											<!-- VENTANA MODAL DE ELIMINACION DE CARGO-->
												<div id="vnt_eliminar<?php echo $row->id; ?>" class="modal hide fade" >
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h3 id="myModalLabel"><?php echo $ci->lang->line('titulo_eliminar_usu'); ?></h3>
													</div>
													<div class="modal-body">
														<p class="lead"><?php echo $ci->lang->line('msj_eliminar_car'); ?> <?php echo $row->nombre; ?>?</p>
													</div>
													<div class="modal-footer">
														<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $ci->lang->line('btn_cerrar'); ?></button>
														<a href="<?php echo base_url().'cargo/eliminar/'.$row->id ?>" class="btn btn-primary"><?php echo $ci->lang->line('btn_eliminar'); ?></a>
													</div>
												</div>
											</td>
										</tr>
										<?php $i++; ?>
									<?php endforeach ?>															
								</tbody>
							</table>						    
						</article>
					<!-- VENTANA DE AGREGAR NUEVO CARGO-->
					    <div class="modal hide fade" id="agregar-cargo">
							<div class="modal-header">
								<a class="close" data-dismiss="modal">×</a>
								<h3>Agregar nuevo</h3>
							</div>
							<div class="modal-body">
								    <form class="form-horizontal" action="<?php echo $accion_cargos; ?>" name="frmCargos" method="POST">
											<div class="control-group">
												<label class="control-label" for="nombre"><?php echo $ci->lang->line('lbl_nombre'); ?></label>
												<div class="controls">
													<input type="text" class="input-xlarge" id="nombre" name="nombre" required>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="descripcion"><?php echo $ci->lang->line('lbl_descripcion'); ?></label>
												<div class="controls">
													<textarea class="input-xlarge" name="descripcion" id="descripcion" rows="6"></textarea>
												</div>
											</div>

											<div class="control-group">
												<div class="controls">
													<input type="submit" name="guardar" value="Guardar" class="btn btn-inverse">
												</div>
											</div>
									</form>
							</div>
							<div class="modal-footer">
							</div>
						</div>
					
					</div>
					<div class="tab-pane" id="departamentos">
						<article class="well">
							<table class="table table-striped table-hover tabla">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Serial</th>
										<th>Usuario</th>
										<th>Ubicación</th>
										<th>Estado</th>
										<th class="tabla-center">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><a href="">PCBN001</a></td>
										<td>MXL154481</td>
										<td><a href="">Stiven Castillo</a></td>
										<td>Informatica - Financiero 2do piso</td>
										<td>Alquilado</td>
										<td class="tabla-center">
											<div class="btn-group">
												<a class="btn btn-small" href="#ver" data-toggle="modal">
													<i class="icon-search icon-black"></i>
												</a>
												<a class="btn btn-small" href="#modificar" data-toggle="modal">
													<i class="icon-wrench icon-black"></i>
												</a>
												<a class="btn btn-small" href="#eliminar" data-toggle="modal">
													<i class="icon-remove icon-black"></i>
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td><a href="">PCBN001</a></td>
										<td>MXL154481</td>
										<td><a href="">Stiven Castillo</a></td>
										<td>Informatica - Financiero 2do piso</td>
										<td>Alquilado</td>
										<td class="tabla-center">
											<div class="btn-group">
												<a class="btn btn-small" href="#ver" data-toggle="modal">
													<i class="icon-search icon-black"></i>
												</a>
												<a class="btn btn-small" href="#modificar" data-toggle="modal">
													<i class="icon-wrench icon-black"></i>
												</a>
												<a class="btn btn-small" href="#eliminar" data-toggle="modal">
													<i class="icon-remove icon-black"></i>
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td><a href="">PCBN001</a></td>
										<td>MXL154481</td>
										<td><a href="">Stiven Castillo</a></td>
										<td>Informatica - Financiero 2do piso</td>
										<td>Alquilado</td>
										<td class="tabla-center">
											<div class="btn-group">
												<a class="btn btn-small" href="#ver" data-toggle="modal">
													<i class="icon-search icon-black"></i>
												</a>
												<a class="btn btn-small" href="#modificar" data-toggle="modal">
													<i class="icon-wrench icon-black"></i>
												</a>
												<a class="btn btn-small" href="#eliminar" data-toggle="modal">
													<i class="icon-remove icon-black"></i>
												</a>
											</div>
										</td>
									</tr>
									<tr>
										<td><a href="">PCBN001</a></td>
										<td>MXL154481</td>
										<td><a href="">Stiven Castillo</a></td>
										<td>Informatica - Financiero 2do piso</td>
										<td>Alquilado</td>
										<td class="tabla-center">
											<div class="btn-group">
												<a class="btn btn-small" href="#ver" data-toggle="modal">
													<i class="icon-search icon-black"></i>
												</a>
												<a class="btn btn-small" href="#modificar" data-toggle="modal">
													<i class="icon-wrench icon-black"></i>
												</a>
												<a class="btn btn-small" href="#eliminar" data-toggle="modal">
													<i class="icon-remove icon-black"></i>
												</a>
											</div>
										</td>
									</tr>		
								</tbody>
							</table>						    
						</article>
					</div>
				</div>
			</div>
		</div>

		<div class="row-fluid">
			<div class="span9">
					
			</div>
		</div>