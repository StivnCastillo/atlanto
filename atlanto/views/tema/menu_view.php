<?php 
$ci = &get_instance();
?>
<!-- Barra superior-->
	<nav class="navbar navbar-fixed-top navbar-inverse">
		<div class="navbar-inner">
			<div class="container">

				<!-- BOTON MENU, CUANDO SE ACHIQUE--> 
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" href="#">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				
				<?php if (!$validador): ?>
					<a href="" class="brand"><?php echo $titulo_menu; ?></a>
				<?php endif ?>				
				<?php if ($validador): ?>
					<!-- MENU ADMINISTRADOR -->
					<?php if ($ci->session->userdata('rol') == 1): ?>
					<!-- BOTON MENU, CUANDO SE ACHIQUE--> 
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" href="#">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li class="active">
								<a href="<?php echo base_url().'panel/escritorio' ?>"><?php echo $ci->lang->line('men_escritorio') ?></a>
							</li>
							<li class="dropdown">
								<a href="" class="dropdown-toggle" data-toggle="dropdown">
									<?php echo $ci->lang->line('men_inventario'); ?>
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="computadores.html"><?php echo $ci->lang->line('men_sub_compu'); ?></a></li>
									<li><a href="monitores.html"><?php echo $ci->lang->line('men_sub_monitores'); ?></a></li>
									<li><a href=""><?php echo $ci->lang->line('men_sub_red'); ?></a></li>
									<li><a href=""><?php echo $ci->lang->line('men_sub_impresoras'); ?></a></li>
									<li><a href=""><?php echo $ci->lang->line('men_sub_telefonos'); ?></a></li>
									<li><a href=""><?php echo $ci->lang->line('men_sub_dispositivos'); ?></a></li>
									<li><a href=""><?php echo $ci->lang->line('men_sub_software'); ?></a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="" class="dropdown-toggle" data-toggle="dropdown">
									<?php echo $ci->lang->line('men_tickets') ?>
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href=""><?php echo $ci->lang->line('men_sub_abiertos'); ?></a></li>
									<li><a href=""><?php echo $ci->lang->line('men_sub_respondidos'); ?></a></li>
									<li><a href=""><?php echo $ci->lang->line('men_sub_cerrados'); ?></a></li>
									<li><a href=""><?php echo $ci->lang->line('men_sub_mis_tickets'); ?></a></li>
									<li><a href=""><?php echo $ci->lang->line('men_sub_crear'); ?></a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<?php echo $ci->lang->line('men_tareas') ?>
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url().'panel/tareas' ?>"><?php echo $ci->lang->line('men_sub_todo'); ?></a></li>
									<li><a href="<?php echo base_url().'tarea/nueva_tarea'; ?>"><?php echo $ci->lang->line('men_sub_nueva'); ?></a></li>
									<li><a href="<?php echo base_url().'panel/tareas/'.$this->session->userdata('id'); ?>"><?php echo $ci->lang->line('men_sub_mis'); ?></a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="" class="dropdown-toggle" data-toggle="dropdown">
									<?php echo $ci->lang->line('men_financiero') ?>
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href=""><?php echo $ci->lang->line('men_sub_proveedores'); ?></a></li>
									<li><a href=""><?php echo $ci->lang->line('men_sub_contratos'); ?></a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="" class="dropdown-toggle" data-toggle="dropdown">
									<?php echo $ci->lang->line('men_administracion') ?>
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url()."panel/usuarios" ?>"><?php echo $ci->lang->line('men_sub_usuarios') ?></a></li>
									<li><a href=""><?php echo $ci->lang->line('men_sub_perfiles') ?></a></li>
									<li><a href="<?php echo base_url().'panel/titulos' ?>"><?php echo $ci->lang->line('men_sub_tablas') ?></a></li>
									<li><a href=""><?php echo $ci->lang->line('men_sub_resp') ?></a></li>
								</ul>
							</li>
							<li><a href="#"><?php echo $ci->lang->line('men_reportes') ?></a></li>
							<li class="dropdown">
								<a href="" class="dropdown-toggle" data-toggle="dropdown">
									<?php echo $ci->lang->line('men_config') ?>
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href=""><a href=""><?php echo $ci->lang->line('men_sub_general') ?></a></li>
									<li><a href=""><a href=""><?php echo $ci->lang->line('men_sub_noti') ?></a></li>
									<li><a href=""><a href=""><?php echo $ci->lang->line('men_sub_rol') ?></a></li>
								</ul>
							</li>			
						</ul>
						<ul class="nav pull-right">
							<li class="dropdown">
								<a href="" class="dropdown-toggle" data-toggle="dropdown">
									<?php echo $this->session->userdata('nombre'); ?>
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href=""><?php echo $ci->lang->line('men_sub_configuracion') ?></a></li>
									<li><a href="<?php echo base_url().'usuario/logout' ?>"><?php echo $ci->lang->line('men_sub_salir') ?></a></li>
								</ul>
							</li>
						</ul>
					</div>
					<?php endif ?>
					<!-- MENU USUARIO -->
				<?php endif ?>
			</div>
		</div>
	</nav>
	<section class="container">