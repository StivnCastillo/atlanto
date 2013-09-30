<?php 
	$ci = &get_instance();
?>
<?php if ($ci->session->userdata('roles')->id == 1): ?>	
	<div class="row-fluid">
		<div class="span10 offset1">

			<div class="row-fluid">
				<h2><small>Tickets</small></h2>

				<ul class="thumbnails">
				    <li class="span2">
					    <a href="<?php echo base_url().'ticket/nuevo'; ?>" class="thumbnail">
					    	<h1><i class="icon icon-plus"></i></h1>
					    	<p>Nuevo Ticket</p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="<?php echo base_url().'ticket'; ?>" class="thumbnail">
					    	<h1><i class="icon icon-list-alt"></i></h1>
					    	<p>Ver Tickets</p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="<?php echo base_url().'ticket/estado/3'; ?>" class="thumbnail">
					    	<h1><i class="icon icon-remove"></i></h1>
					    	<p>No Resueltos <span class="badge badge-important"><?php echo $n_tickets_no_resueltos; ?></span></p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="<?php echo base_url().'ticket/estado/5'; ?>" class="thumbnail">
					    	<h1><i class="icon icon-check-minus"></i></h1>
					    	<p>En Espera <span class="badge badge-important"><?php echo $n_tickets_espera; ?></span></p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="#" class="thumbnail">
					    	<h1><i class="icon icon-check"></i></h1>
					    	<p>Calificaciones</p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="<?php echo base_url().'ticket/index/admin'; ?>" class="thumbnail">
					    	<h1><i class="icon icon-user"></i></h1>
					    	<p>Mis Tickets <span class="badge badge-success"><?php echo $n_mis_tickets ?></span> </p>
					    </a>
				    </li>
			    </ul>
			</div>

			<div class="row-fluid">
				<h2><small>Tareas</small></h2>

				<ul class="thumbnails">
				    <li class="span2">
					    <a href="<?php echo base_url().'tarea/nueva_tarea'; ?>" class="thumbnail">
					    	<h1><i class="icon icon-plus"></i></h1>
					    	<p>Nueva Tarea</p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="<?php echo base_url().'panel/tareas' ?>" class="thumbnail">
					    	<h1><i class="icon icon-list-alt"></i></h1>
					    	<p>Ver Tareas</p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="<?php echo base_url().'panel/tareas' ?>" class="thumbnail">
					    	<h1><i class="icon icon-remove"></i></h1>
					    	<p>Sin Terminar <span class="badge badge-important"><?php echo $n_tareas_no_terminadas; ?></span></p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="<?php echo base_url().'panel/tareas/'.$this->session->userdata('id'); ?>" class="thumbnail">
					    	<h1><i class="icon icon-user"></i></h1>
					    	<p>Mis Tareas <span class="badge badge-important"><?php echo $n_mis_tareas; ?></span></p>
					    </a>
				    </li>
			    </ul>
			</div>

			<div class="row-fluid">
				<h2><small>Inventario</small></h2>

				<ul class="thumbnails">
				    <li class="span2">
					    <a href="<?php echo base_url().'computador'; ?>" class="thumbnail">
					    	<h1><i class="icon icon-laptop"></i></h1>
					    	<p>Computadores</p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="<?php echo base_url().'componente'; ?>" class="thumbnail">
					    	<h1><i class="icon icon-keyboard"></i></h1>
					    	<p>Componentes</p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="<?php echo base_url().'monitor'; ?>" class="thumbnail">
					    	<h1><i class="icon icon-desktop"></i></h1>
					    	<p>Monitores</p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="<?php echo base_url().'impresora'; ?>" class="thumbnail">
					    	<h1><i class="icon icon-print"></i></h1>
					    	<p>Impresoras</p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="<?php echo base_url().'telefono'; ?>" class="thumbnail">
					    	<h1><i class="icon icon-phone"></i></h1>
					    	<p>Telefonos</p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="#" class="thumbnail">
					    	<h1><i class="icon icon-gear"></i></h1>
					    	<p>Software</p>
					    </a>
				    </li>
			    </ul>
			</div>
		</div>
	</div>
<?php else: ?>
	<div class="row-fluid">
		<div class="span10 offset1">

			<div class="row-fluid">
				<h2><small>Tickets</small></h2>

				<ul class="thumbnails">
				    <li class="span2">
					    <a href="<?php echo base_url().'ticket/nuevo'; ?>" class="thumbnail">
					    	<h1><i class="icon icon-plus"></i></h1>
					    	<p>Nuevo Ticket</p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="#" class="thumbnail">
					    	<h1><i class="icon icon-remove"></i></h1>
					    	<p>No Resueltos <span class="badge badge-important"><?php echo $n_tickets_no_resueltos; ?></span></p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="#" class="thumbnail">
					    	<h1><i class="icon icon-check-minus"></i></h1>
					    	<p>En Espera <span class="badge badge-important"><?php echo $n_en_espera; ?></span></p>
					    </a>
				    </li>
				    <li class="span2">
					    <a href="<?php echo base_url().'ticket/mis_tickets'; ?>" class="thumbnail">
					    	<h1><i class="icon icon-user"></i></h1>
					    	<p>Mis Tickets <span class="badge badge-success"><?php echo $n_mis_tickets ?></span> </p>
					    </a>
				    </li>
			    </ul>
			</div>
		</div>
	</div>
<?php endif ?>