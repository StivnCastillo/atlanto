<?php 
$ci = &get_instance();
?>
		<!-- MENU COMPONENTES -->
	    <ul class="breadcrumb">
		    <li><a href="com_agregar.html"><?php echo $ci->lang->line('lnk_agregar'); ?></a> <span class="divider">/</span></li>
		    <!-- variable -->
		    <li><a href="#"><?php echo $ci->lang->line('lnk_new_plantilla'); ?></a> <span class="divider">/</span></li>
	    </ul>

		<article class="well">
			<form class="form-inline">			
				<div class="input-append">
					<!-- idioma -->
					<input class="span2" name="busqueda" id="appendedInput" type="text" placeholder="<?php echo $ci->lang->line('plc_buscar'); ?>">
					<button class="btn btn-inverse" type="button"><i class="icon-search icon-white"></i></button>
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

		<article class="well">
			<table class="table table-striped table-hover">
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
							<td><a href=""><?php echo $row->nombre_usuario; ?></a></td>
							<td><?php echo $row->departamento; ?></td>
							<td><?php echo $row->lugar; ?></td>
							<td><a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a></td>
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
					<?php endforeach ?>					
				</tbody>
			</table>
			    
		</article>
		
		<!-- PAGINADOR -->
		<article class="pagination pagination-right">
		    <ul>
		    <li class="disabled"><span>&laquo;</span></li>
		    <li class="active"><span>1</span></li>
		    <li><a href="">2</a></li>
		    <li><a href="">3</a></li>
		    <li><a href="">4</a></li>
		    <li><a href="">5</a></li>
		    <li><a href="">&raquo;</a></li>
		    </ul>
		</article>