<?php 
$ci = &get_instance();
?>
		<div class="row-fluid">
			<div class="span6">
				<ul class="nav nav-tabs nav-stacked">
				
					<li class="active"><a href=""><?php echo $ci->lang->line('tit_men_tareas'); ?></a></li>
					<li><a href="<?php echo base_url()."reporte/tareas_lista" ?>"><?php echo $ci->lang->line('rep_men_lista'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>
					<li><a href="<?php echo base_url()."reporte/tareas_personalizada" ?>"><?php echo $ci->lang->line('rep_men_personalizar'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>

					<li class="active"><a href="">Tipos</a></li>
					<li><a href="#"><?php echo $ci->lang->line('construccion'); ?></a></li>
					<li><a href="#"><?php echo $ci->lang->line('construccion'); ?></a></li>
					<li><a href="#"><?php echo $ci->lang->line('construccion'); ?></a></li>
					<li><a href="#"><?php echo $ci->lang->line('construccion'); ?></a></li>
				</ul>
			</div>
			<div class="span6">
				<ul class="nav nav-tabs nav-stacked">
					<li class="active"><a href="">menu 1</a></li>
					<li><a href="#"><?php echo $ci->lang->line('construccion'); ?></a></li>
					<li><a href="#"><?php echo $ci->lang->line('construccion'); ?></a></li>
					<li><a href="#"><?php echo $ci->lang->line('construccion'); ?></a></li>
					<li><a href="#"><?php echo $ci->lang->line('construccion'); ?></a></li>
				</ul>
			</div>
		</div>