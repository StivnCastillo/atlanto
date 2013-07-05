<?php 
$ci = &get_instance();
?>
		<!-- MENU COMPONENTES -->
	    <ul class="breadcrumb">
		    <li><a href="<?php echo base_url().'usuario/nuevo_usuario' ?>"><?php echo $ci->lang->line('lnk_agregar'); ?></a> <span class="divider">/</span></li>
		</ul>

		<article class="well">
			<form class="form-inline">			
				<div class="input-append">
					<!-- idioma -->
					<input class="span2" name="busqueda" id="busqueda" type="text" placeholder="<?php echo $ci->lang->line('plc_buscar'); ?>">
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

		<article class="well">
			<table class="table table-striped table-hover tabla" id="tabla">
				<thead>
					<tr>
						<!-- idioma -->
						<th><?php echo $ci->lang->line('tab_empty'); ?></th>
						<th><?php echo $ci->lang->line('tab_nombre'); ?></th>
						<th><?php echo $ci->lang->line('tab_departamento'); ?></th>
						<th><?php echo $ci->lang->line('tab_lugar'); ?></th>
						<th><?php echo $ci->lang->line('tab_mail'); ?></th>
						<th class="tabla-center"><?php echo $ci->lang->line('tab_acciones'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($usuarios as $row): ?>
						<tr>
							<td>
								<?php if ($row->activo == 1): ?>
									<span class="label label-success">
										<i class="icon-ok icon-white"></i>
									</span>
								<?php endif ?>
								<?php if ($row->activo == 2): ?>
									<span class="label label-important">
										<i class="icon-remove icon-white"></i>
									</span>
								<?php endif ?>
								
							</td>
							<td><a href="<?php echo base_url().'usuario/nuevo_usuario/'.$row->id ?>"><?php echo $row->nombre_usuario; ?></a></td>
							<td><?php echo $row->departamento; ?></td>
							<td><?php echo $row->lugar; ?></td>
							<td><a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a></td>
							<td class="tabla-center">
								<div class="btn-group">
									<a class="btn btn-small" href="<?php echo base_url().'usuario/nuevo_usuario/'.$row->id ?>" data-toggle="modal">
										<i class="icon-search icon-black"></i>
									</a>
									<a class="btn btn-small" href="<?php echo base_url().'usuario/nuevo_usuario/'.$row->id ?>" data-toggle="modal">
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
					<?php endforeach ?>					
				</tbody>
			</table>
			    
		</article>
		