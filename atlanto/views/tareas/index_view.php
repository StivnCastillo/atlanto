<?php 
$ci = &get_instance();
?>
		<article class="well">
			<form class="form-inline">			
				<a href="<?php echo base_url().'tarea/nueva_tarea'; ?>" id="btn_agregar" class="btn btn-inverse" title="<?php echo $ci->lang->line('lnk_agregar') ?>"><i class="icon icon-plus icon-white"></i></a>
				<a href="<?php echo base_url().'panel/tareas/'.$this->session->userdata('id'); ?>" id="btn_agregar" class="btn btn-inverse" title="<?php echo $ci->lang->line('lnk_mis_tareas') ?>"><i class="icon icon-th icon-white"></i></a>
				<a href="<?php echo base_url().'panel/tareas'; ?>" id="btn_agregar" class="btn btn-inverse" title="<?php echo $ci->lang->line('lnk_todas'); ?>"><i class="icon icon-th-list icon-white"></i></a>
				<a href="<?php echo base_url().'reporte/index/tareas'; ?>" id="btn_agregar" class="btn btn-inverse" title="<?php echo $ci->lang->line('lnk_reporte') ?>"><i class="icon icon-print icon-white"></i></a>
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

		<article>
			<table class="table table-striped table-hover table-bordered tabla" id="tabla">
				<thead>
					<tr>
						<th class="tabla-center"><?php echo $ci->lang->line('tab_numero'); ?></th>
						<th><?php echo $ci->lang->line('tab_estado'); ?></th>
						<th><?php echo $ci->lang->line('tab_titulo'); ?></th>
						<th><?php echo $ci->lang->line('tab_usuario_asignado'); ?></th>
						<th><?php echo $ci->lang->line('tab_fecha_inicio'); ?></th>
						<th><?php echo $ci->lang->line('tab_fecha_fin'); ?></th>
						<th class="tabla-center"><?php echo $ci->lang->line('tab_acciones'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php if ($tareas): ?>
						<?php foreach ($tareas as $row): ?>
							<tr>
								<td><a href="<?php echo base_url().'tarea/nueva_tarea/'.$row->id ?>"><?php echo $row->id; ?></a></td>
								<td class="tabla-center">
									<div 
										class="switch switch-mini terminada" 
										data-id="<?php echo $row->id; ?>" 
										data-accion="<?php echo base_url().'tarea/cambiar_estado'; ?>"
										data-fecha="<?php echo $row->fecha_inicio; ?>"
										data-on="success" 
										data-off="info" 
										data-on-label="SI" 
										data-off-label="NO">
										<input type="checkbox" <?php if ($row->estado == 1): ?>checked="checked"<?php endif ?> name="activado" id="activado"/>
									</div>
								</td>
								<td><a href="<?php echo base_url().'tarea/nueva_tarea/'.$row->id ?>" class="popover-tarea" data-content="<?php echo $row->nota; ?>" data-original-title="<?php echo $row->descripcion; ?>" rel="popover"><?php echo $row->titulo; ?></a></td>
								<td><a href="<?php echo base_url().'usuario/nuevo_usuario/'.$row->id_usuario ?>"><?php echo $row->nombre." ".$row->apellido; ?></a></td>
								<td><?php echo $row->fecha_inicio; ?></td>
								<td><?php echo $row->fecha_fin; ?></td>
								<td class="tabla-center">
									<div class="btn-group">
										<a class="btn btn-small" href="<?php echo base_url().'tarea/nueva_tarea/'.$row->id ?>" data-toggle="modal">
											<i class="icon-search icon-black"></i>
										</a>
										<a class="btn btn-small" href="<?php echo base_url().'tarea/nueva_tarea/'.$row->id ?>" data-toggle="modal">
											<i class="icon-wrench icon-black"></i>
										</a>
									</div>
								</td>
							</tr>
							<?php $i++; ?>
						<?php endforeach ?>	
					<?php else: ?>
						<tr>
							<td colspan="6">Sin Resultados</td>
						</tr>
					<?php endif ?>							
				</tbody>
			</table>						    
		</article>
