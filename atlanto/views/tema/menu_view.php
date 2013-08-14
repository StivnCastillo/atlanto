<?php 
	$ci = &get_instance();
	$ci->load->model('tarea_model'); 
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
				<div class="nav-collapse collapse">
					<ul class="nav">
						
						<?php if ($ci->session->userdata('ingresado')): ?>
							<!-- escritorio -->
							<li>
								<a href="<?php echo base_url().'panel/escritorio' ?>"><?php echo $ci->lang->line('men_escritorio') ?></a>
							</li>

							<!-- inventario -->
							<?php if ($ci->session->userdata('roles')->inventario): ?>
								<li class="dropdown">
									<a href="" class="dropdown-toggle" data-toggle="dropdown">
										<?php echo $ci->lang->line('men_inventario'); ?>
										<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										<li><a href="<?php echo base_url().'computador'; ?>"><?php echo $ci->lang->line('men_sub_compu'); ?></a></li>
										<li><a href="<?php echo base_url().'monitor'; ?>"><?php echo $ci->lang->line('men_sub_monitores'); ?></a></li>
										<li><a href="<?php echo base_url().'equipored'; ?>"><?php echo $ci->lang->line('men_sub_red'); ?></a></li>
										<li><a href="<?php echo base_url().'impresora'; ?>"><?php echo $ci->lang->line('men_sub_impresoras'); ?></a></li>
										<li><a href="<?php echo base_url().'telefono'; ?>"><?php echo $ci->lang->line('men_sub_telefonos'); ?></a></li>
										<li><a href=""><?php echo $ci->lang->line('men_sub_dispositivos'); ?></a></li>
										<li><a href=""><?php echo $ci->lang->line('men_sub_software'); ?></a></li>
									</ul>
								</li>
							<?php endif ?>

							<!-- ticket -->
							<?php if ($ci->session->userdata('roles')->ticket_admin): ?>
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
							<?php endif ?>

							<!-- tareas -->
							<?php if ($ci->session->userdata('roles')->tareas): ?>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<?php echo $ci->lang->line('men_tareas') ?>
										<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										<li>
											<a href="<?php echo base_url().'tarea/nueva_tarea'; ?>">
												<?php echo $ci->lang->line('men_sub_nueva'); ?>
												<span class="badge badge-important">
													<?php echo $ci->tarea_model->get_no_tareas(array('estado' => 0)); ?>
												</span>
											</a>
										</li>
										<li>
											<a href="<?php echo base_url().'panel/tareas/'.$this->session->userdata('id'); ?>">
												<?php echo $ci->lang->line('men_sub_mis'); ?>
												<span class="badge badge-important">
													<?php echo $ci->tarea_model->get_no_tareas(array('estado' => 0, 'id_usuario_asignado' => $ci->session->userdata('id'))); ?>
												</span>
											</a>
										</li>
										<li><a href="<?php echo base_url().'panel/tareas' ?>"><?php echo $ci->lang->line('men_sub_todo'); ?></a></li>
									</ul>
								</li>
							<?php endif ?>

							<!-- fnanciero -->
							<?php if ($ci->session->userdata('roles')->financiero): ?>
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
							<?php endif ?>

							<!-- administracion -->
							
								<li class="dropdown">
									<a href="" class="dropdown-toggle" data-toggle="dropdown">
										<?php echo $ci->lang->line('men_administracion') ?>
										<b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										<?php if ($ci->session->userdata('roles')->administracion): ?>
											<li><a href="<?php echo base_url()."panel/usuarios" ?>"><?php echo $ci->lang->line('men_sub_usuarios') ?></a></li>
											<li><a href=""><?php echo $ci->lang->line('men_sub_perfiles') ?></a></li>
											<li><a href="<?php echo base_url().'panel/titulos' ?>"><?php echo $ci->lang->line('men_sub_tablas') ?></a></li>
											<li><a href=""><?php echo $ci->lang->line('men_sub_resp') ?></a></li>
										<?php endif ?>
										<!-- administrador de correos -->
										<?php if ($ci->session->userdata('roles')->admin_correos): ?>
											<li><a href="<?php echo base_url().'correo/correos' ?>"><?php echo $ci->lang->line('men_correos') ?></a></li>
										<?php endif ?>
									</ul>
								</li>

							<!-- reportes -->
							<?php if ($ci->session->userdata('roles')->reportes): ?>
								<li><a href="<?php echo base_url()."reporte" ?>"><?php echo $ci->lang->line('men_reportes') ?></a></li>
							<?php endif ?>

							<!-- configuraciones -->
							<?php if ($ci->session->userdata('roles')->configuraciones): ?>
								<li><a href="<?php echo base_url()."configuracion" ?>"><?php echo $ci->lang->line('men_config') ?></a></li>			
							<?php endif ?>

						<?php else: ?>
							<li>
								<a href="" class="dropdown-toggle" data-toggle="dropdown">
									<?php echo $ci->lang->line('men_servicios') ?>
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo base_url().'correo' ?>"><?php echo $ci->lang->line('men_sub_correo') ?></a></li>
									<li><a href="#"><?php echo $ci->lang->line('men_sub_manuales') ?></a></li>
								</ul>
							</li>
						<?php endif ?>
					</ul>
					<?php if ($ci->session->userdata('ingresado')): ?>
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
					<?php endif ?>
				</div>
			</div>
		</div>
	</nav>
	<section class="container">