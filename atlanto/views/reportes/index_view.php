<?php 
$ci = &get_instance();
?>
		<div class="row-fluid">
			<div class="span6">
				<ul class="nav nav-tabs nav-stacked">
					<?php if ($seccion == 'todas' OR $seccion == 'tareas'): ?>
						<!-- tareas -->																
						<li class="active"><a href=""><?php echo $ci->lang->line('tit_men_tareas'); ?></a></li>
						<li><a href="<?php echo base_url()."reporte/tareas_lista" ?>"><?php echo $ci->lang->line('rep_men_lista'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>
						<li><a href="<?php echo base_url()."reporte/tareas_personalizada" ?>"><?php echo $ci->lang->line('rep_men_personalizar'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>
					<?php endif ?>

					<?php if ($seccion == 'todas' OR $seccion == 'computadores'): ?>														
						<li class="active"><a href="">Computador</a></li>
						<li><a href="<?php echo base_url()."reporte/computador_lista" ?>">Lista<i class="icon icon-chevron-right pull-right"></i></a></li>
						<li><a href="#">Lista Personalizada<i class="icon icon-chevron-right pull-right"></i></a></li>
						<li><a href="<?php echo base_url()."reporte/computador" ?>">Informe individual<i class="icon icon-chevron-right pull-right"></i></a></li>
					<?php endif ?>		

				</ul>
			</div>
		</div>