<?php 
	$ci = &get_instance();
?>
		<article class="well">
			<form class="form-inline">
				<a href="<?php echo base_url().'ticket/nuevo' ?>" id="btn_agregar" class="btn btn-inverse" title="<?php echo $ci->lang->line('lnk_agregar') ?>"><i class="icon icon-plus icon-white"></i></a>
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
						<!-- idioma -->
						<th>#</th>
						<th>Asunto</th>
						<th>Fecha</th>
						<th>Estado</th>
						<th class="tabla-center"><?php echo $ci->lang->line('tab_acciones'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php if (isset($tickets) AND $tickets): ?>
						<?php foreach ($tickets as $row): ?>
							<tr>
								<td><a href="<?php echo base_url().'ticket/ver/'.$row->id ?>"><?php echo $row->id; ?></a></td>
								<td><a href="<?php echo base_url().'ticket/ver/'.$row->id ?>"><?php echo $row->asunto; ?></a></td>
								<td><?php echo $row->fecha_creado; ?></td>
								<td>
									<?php if ($row->id_estado == 3 OR $row->id_estado == 6): ?>
										<span class="label label-important"><?php echo $row->estado; ?></span>
									<?php endif ?>
									<?php if ($row->id_estado == 1): ?>
										<span class="label label-info"><?php echo $row->estado; ?></span>
									<?php endif ?>
									<?php if ($row->id_estado == 2): ?>
										<span class="label label-success"><?php echo $row->estado; ?></span>
									<?php endif ?>
									<?php if ($row->id_estado == 4 OR $row->id_estado == 5): ?>
										<span class="label label-warning"><?php echo $row->estado; ?></span>
									<?php endif ?>								
								</td>
								<td class="tabla-center">
									<div class="btn-group">
										<a class="btn btn-small" href="<?php echo base_url().'ticket/ver/'.$row->id ?>">
											<i class="icon-search icon-black"></i>
										</a>
									</div>
								</td>
							</tr>
						<?php endforeach ?>					
					<?php endif ?>				
				</tbody>
			</table>
			    
		</article>