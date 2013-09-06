<?php 
	$ci = &get_instance();
?>

		<article class="well">
			<form class="form-inline">
				<a href="<?php echo base_url().'quejas/nuevo' ?>" id="btn_agregar" class="btn btn-inverse" title="<?php echo $ci->lang->line('lnk_agregar') ?>"><i class="icon icon-plus icon-white"></i></a>		
				<a href="<?php echo base_url().'reporte/index/computadores'; ?>" id="btn_agregar" class="btn btn-inverse" title="<?php echo $ci->lang->line('lnk_reporte') ?>"><i class="icon icon-print icon-white"></i></a>
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
						<th>#</th>
						<th>Item</th>
						<th>No. de Caso</th>
						<th>Ruta</th>
						<th>Fecha</th>
						<th>Proceso</th>
						<th>Estado</th>
						<th class="tabla-center"><?php echo $ci->lang->line('tab_acciones'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if ($queja): ?>
						<?php foreach ($queja as $row): ?>
							<tr>
								<td><?php echo $row->id ?></td>
								<td><?php echo $row->item ?></td>
								<td><?php echo $row->n_caso ?></td>
								<td><?php echo $row->ruta ?></td>
								<td><?php echo $row->fecha ?></td>
								<td><?php echo $row->proceso ?></td>
								<td>
									<?php if ($row->solucionado == 1): ?>
										<span class="label label-success">Solucionado</span>
									<?php else: ?>
										<span class="label label-important">Sin Solución</span>
									<?php endif ?>
								</td>
								<td>
									<div class="btn-group">
										<?php if (!$row->solucionado == 1): ?>
											<a class="btn btn-small" href="<?php echo base_url().'quejas/solucionar/'.md5($row->id).'/'.$row->id ?>">
												Solucionar
												<i class="icon-search icon-arrow-right"></i>
											</a>
										<?php else: ?>
											<a class="btn btn-small disabled" href="#">
												Solucionar
												<i class="icon-search icon-arrow-right"></i>
											</a>
										<?php endif ?>
									</div>
								</td>
							</tr>
						<?php endforeach ?>
					<?php endif ?>
						
					
				</tbody>
			</table>
	    </article>