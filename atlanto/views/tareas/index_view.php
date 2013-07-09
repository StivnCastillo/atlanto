<?php 
$ci = &get_instance();
?>
		<ul class="breadcrumb">
		    <li>
		    	<a href="<?php echo base_url().'tarea/nueva_tarea'; ?>"><?php echo $ci->lang->line('lnk_agregar_a'); ?></a> 
		    	<span class="divider">|</span> 
		    	<a href="<?php echo base_url().'panel/tareas/'.$this->session->userdata('id'); ?>"><?php echo $ci->lang->line('lnk_mis_tareas'); ?></a>
		    	<span class="divider">|</span> 
		    	<a href="<?php echo base_url().'panel/tareas'; ?>"><?php echo $ci->lang->line('lnk_todas'); ?></a>
		    	
		    </li>
		</ul>
	    	
		<article class="well">
			<form class="form-inline">			
				<div class="input-append">
					<!-- idioma -->
					<input class="span2" name="busqueda" id="busqueda" placeholder="<?php echo $ci->lang->line('plc_buscar'); ?>" type="text">
					<button class="btn btn-inverse disabled" type="button"><i class="icon-search icon-white"></i></button>
				</div>
				<label for="ordenar" class="offset1"><?php echo $ci->lang->line('lbl_mostrar'); ?></label>
				<select class="span1" name="mostrar" id="mostrar">
					<option value="1">10</option>
					<option value="2">20</option>
					<option value="3">30</option>
					<option value="4">40</option>
					<option value="5">50</option>
					<option value="todo">Todo/All</option>
				</select>
				<label for="ordenar" class="offset1"><?php echo $ci->lang->line('lbl_imprimir'); ?></label>
				<select class="span2" name="mostrar" id="">
					<option value="1"><?php echo $ci->lang->line('slc_imp_pdf'); ?></option>
					<option value="2"><?php echo $ci->lang->line('slc_imp_excel'); ?></option>
				</select>
				<a href="#" class="btn btn-inverse"><i class="icon-print icon-white"></i></a>
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

		<article class="row-fuid">
			<table class="table table-bordered tabla">
				<thead>
					<tr>
						<th class="tabla-center"><?php echo $ci->lang->line('tab_estado'); ?></th>
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
								<td class="tabla-center">
									<div 
										class="switch switch-mini terminada" 
										data-id="<?php echo $row->id; ?>" 
										data-accion="<?php echo base_url().'tarea/cambiar_estado'; ?>"
										data-on="success" 
										data-off="info" 
										data-on-label="SI" 
										data-off-label="NO">
										<input type="checkbox" <?php if ($row->estado == 1): ?>checked="checked"<?php endif ?> name="activado" id="activado"/>
									</div>
								</td>
								<td><a href="<?php echo base_url().'tarea/nueva_tarea/'.$row->id ?>"><?php echo $row->titulo; ?></a></td>
								<td><a href="<?php echo base_url().'usuario/nuevo_usuario/'.$row->id_usuario ?>"><?php echo $row->nombre." ".$row->apellido; ?></a></td>
								<td><?php echo $row->fecha_inicio; ?></td>
								<td><?php echo $row->fecha_fin; ?></td>
								<td class="tabla-center">
									<div class="btn-group">
										<a class="btn btn-small" href="#ver" data-toggle="modal">
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
