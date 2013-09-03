<?php 
	$ci = &get_instance();
?>

		<div class="row-fluid">
			<div class="span6">
				<ul class="nav nav-tabs nav-stacked">
					<li class="active"><a href=""><?php echo $ci->lang->line('tit_men_comp'); ?></a></li>
					<li><a href="<?php echo base_url().'componente/discoduro' ?>"><?php echo $ci->lang->line('tit_men_dd'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>
					<li><a href="<?php echo base_url().'componente/procesador' ?>"><?php echo $ci->lang->line('tit_men_pro'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>
					<li><a href="<?php echo base_url().'componente/memoria' ?>"><?php echo $ci->lang->line('tit_men_mem'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>
					<li><a href="<?php echo base_url().'componente/tarjeta_video' ?>"><?php echo $ci->lang->line('bre_componente_tvideo'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>
				</ul>
			</div>
		</div>