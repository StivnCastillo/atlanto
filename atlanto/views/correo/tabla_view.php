<?php 
	$ci = &get_instance();
?>


		<article class="well">
			<form class="form-inline">			
				<a href="<?php echo base_url().'correo/nuevo'; ?>" id="btn_agregar" class="btn btn-inverse" title="<?php echo $ci->lang->line('lnk_agregar') ?>"><i class="icon icon-plus icon-white"></i></a>				
			</form>
		</article>

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

	    <article class="well">
			<table class="table table-striped table-hover tabla" id="tabla">
				<thead>
					<tr>
						<!-- idioma -->
						<th><?php echo $ci->lang->line('tab_pendiente'); ?></th>
						<th><?php echo $ci->lang->line('tab_nombre'); ?></th>
						<th><?php echo $ci->lang->line('tab_cargo'); ?></th>
						<th><?php echo $ci->lang->line('tab_mail'); ?></th>
						<th class="tabla-center"><?php echo $ci->lang->line('tab_acciones'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ($correos as $row): ?>
						<tr>
							<td class="tabla-center">
								<div 
									class="switch switch-mini correo-creado" 
									data-id="<?php echo $row->id; ?>" 
									data-accion="<?php echo base_url().'correo/cambiar_estado'; ?>"
									data-on="success" 
									data-off="info" 
									data-on-label="SI" 
									data-off-label="NO">
									<input type="checkbox" <?php if ($row->creado == 1): ?>checked="checked"<?php endif ?> name="activado" id="activado"/>
								</div>
							</td>
							<td><?php echo $row->nombre; ?></td>
							<td><?php echo $row->cargo; ?></td>
							<td><a href="mailto:<?php echo $row->correo; ?>"><?php echo $row->correo; ?></a></td>
							<td class="tabla-center">
								<div class="btn-group">
									<a class="btn btn-small" href="<?php echo base_url().'correo/nuevo/'.$row->id ?>" data-toggle="modal">
										<i class="icon-search icon-black"></i>
									</a>
									<a class="btn btn-small" href="<?php echo base_url().'correo/nuevo/'.$row->id ?>" data-toggle="modal">
										<i class="icon-wrench icon-black"></i>
									</a>
									<a class="btn btn-small" href="#vnt_eliminar<?php echo $row->id; ?>" role="button" data-toggle="modal">
										<i class="icon-remove icon-black"></i>
									</a>

									<!-- VENTANA MODAL DE ELIMINACION-->
									<div id="vnt_eliminar<?php echo $row->id; ?>" class="modal hide fade" >
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h3 id="myModalLabel"><?php echo $ci->lang->line('titulo_eliminar_usu'); ?></h3>
										</div>
										<div class="modal-body">
											<p class="lead"><?php echo $ci->lang->line('msj_eliminar'); ?> <?php echo $row->nombre_usuario; ?>?</p>
										</div>
										<div class="modal-footer">
											<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $ci->lang->line('btn_cerrar'); ?></button>
											<a href="<?php echo base_url().'usuario/eliminar/'.$row->id ?>" class="btn btn-primary"><?php echo $ci->lang->line('btn_eliminar'); ?></a>
										</div>
									</div>

								</div>
							</td>
						</tr>
						<?php $i++; ?>
					<?php endforeach ?>					
				</tbody>
			</table>
		</article>