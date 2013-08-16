<?php 
	$ci = &get_instance();
?>
		<article class="well">
			<form class="form-inline">
				<a href="<?php echo base_url().'componente/nuevo_discoduro/' ?>" id="btn_agregar" class="btn btn-inverse" title="<?php echo $ci->lang->line('lnk_agregar') ?>"><i class="icon icon-plus icon-white"></i></a>
				<a href="<?php echo base_url().'reporte'; ?>" id="btn_agregar" class="btn btn-inverse" title="<?php echo $ci->lang->line('lnk_reporte') ?>"><i class="icon icon-print icon-white"></i></a>
			</form>
		</article>

		<!-- mensaje, error, completado, peligro -->
		<?php if ($this->session->flashdata('mensaje')): ?>
	    		<!-- mensaje de exito -->
	    		<?php if ($this->session->flashdata('tipo_mensaje') == 'exito'): ?>
	    			<div class="alert alert-success">
			            <button type="button" class="close" data-dismiss="alert">×</button>
			            <?php echo $this->session->flashdata('mensaje') ?>
		            </div>
	    		<?php endif ?>
			    <!-- mensaje de error -->
				<?php if ($this->session->flashdata('tipo_mensaje') == 'error'): ?>
		            <div class="alert alert-error">
			            <button type="button" class="close" data-dismiss="alert">×</button>
			            <?php echo $this->session->flashdata('mensaje') ?>
		            </div>
		        <?php endif ?>
				<!-- mensaje de peligro -->
				<?php if ($this->session->flashdata('tipo_mensaje') == 'warning'): ?>
		            <div class="alert alert-warning">
			            <button type="button" class="close" data-dismiss="alert">×</button>
			            <?php echo $this->session->flashdata('mensaje') ?>
		            </div>
	            <?php endif ?>
	    <?php endif ?>

		<article>
			<table class="table table-striped table-hover table-bordered tabla" id="tabla">
				<thead>
					<tr>
						<th><?php echo $ci->lang->line('tab_empty'); ?></th>
						<th><?php echo $ci->lang->line('tab_nombre'); ?></th>
						<th><?php echo $ci->lang->line('tab_fabricante'); ?></th>
						<th><?php echo $ci->lang->line('tab_interfaz'); ?></th>
						<th class="tabla-center"><?php echo $ci->lang->line('tab_acciones'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; ?>
					<?php if ($discos): ?>
						<?php foreach ($discos as $row): ?>
							<tr>
								<td><?php echo $i; ?> </td>
								<td><a href="<?php echo base_url().'componente/nuevo_discoduro/'.$row->id ?>"><?php echo $row->nombre; ?></a></td>
								<td><?php echo $row->fabricante; ?></td>
								<td><?php echo $row->interfaz; ?></td>
								<td class="tabla-center">
									<div class="btn-group">
										<a class="btn btn-small" href="<?php echo base_url().'componente/nuevo_discoduro/'.$row->id ?>">
											<i class="icon-search icon-black"></i>
										</a>
										<a class="btn btn-small" href="<?php echo base_url().'componente/nuevo_discoduro/'.$row->id ?>">
											<i class="icon-wrench icon-black"></i>
										</a>
										<a class="btn btn-small" href="#vnt_eliminar<?php echo $row->id; ?>" role="button" data-toggle="modal">
											<i class="icon-remove icon-black"></i>
										</a>

										<!-- VENTANA MODAL DE ELIMINACION-->
										<div id="vnt_eliminar<?php echo $row->id; ?>" class="modal hide fade" >
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h3 id="myModalLabel"><?php echo $ci->lang->line('titulo_eliminar_dd'); ?></h3>
											</div>
											<div class="modal-body">
												<p class="lead"><?php echo $ci->lang->line('msj_eliminar_dd'); ?> <?php echo $row->nombre; ?>?</p>
											</div>
											<div class="modal-footer">
												<button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $ci->lang->line('btn_cerrar'); ?></button>
												<a href="<?php echo base_url().'componente/eliminar_discoduro/'.$row->id ?>" class="btn btn-primary"><?php echo $ci->lang->line('btn_eliminar'); ?></a>
											</div>
										</div>

									</div>
								</td>
							</tr>
							<?php $i++; ?>
						<?php endforeach ?>	
					<?php else: ?>
						<tr>
							<td colspan="4"><?php echo $ci->lang->line('msj_error_resultado'); ?></td>
						</tr>
					<?php endif ?>				
				</tbody>
			</table>
			    
		</article>