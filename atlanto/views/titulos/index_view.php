<?php 
	$ci = &get_instance();
?>

		<div class="row-fluid">
			<div class="span6">
				<ul class="nav nav-tabs nav-stacked">

					<li class="active"><a href=""><?php echo $ci->lang->line('tit_men_general'); ?></a></li>
					<li><a href="<?php echo base_url().'ubicacion' ?>"><?php echo $ci->lang->line('tit_men_ubicaciones'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>
					<li><a href="<?php echo base_url().'cargo' ?>"><?php echo $ci->lang->line('tit_men_cargos'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>
					<li><a href="<?php echo base_url().'departamento' ?>"><?php echo $ci->lang->line('tit_men_departamentos'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>
					<li><a href="<?php echo base_url().'estado' ?>"><?php echo $ci->lang->line('tit_men_estados'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>

					<li class="active"><a href=""><?php echo $ci->lang->line('tit_men_tipos'); ?></a></li>
					<li><a href="<?php echo base_url().'tipo/tipo_computadores' ?>"><?php echo $ci->lang->line('tit_men_tipos_com'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>
					<li><a href="<?php echo base_url().'tipo/tipo_so' ?>"><?php echo $ci->lang->line('tit_men_tipos_so'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>
				</ul>
			</div>
			<div class="span6">
				<ul class="nav nav-tabs nav-stacked">
					<li class="active"><a href=""><?php echo $ci->lang->line('tit_men_red'); ?></a></li>
					<li><a href="<?php echo base_url().'dominio' ?>"><?php echo $ci->lang->line('tit_men_dominios'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>
					<li><a href="<?php echo base_url().'red' ?>"><?php echo $ci->lang->line('tit_men_redes'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>

					<li class="active"><a href=""><?php echo $ci->lang->line('tit_men_software'); ?></a></li>
					<li><a href="<?php echo base_url().'sistema_operativo' ?>"><?php echo $ci->lang->line('tit_men_so'); ?><i class="icon icon-chevron-right pull-right"></i></a></li>
				</ul>
			</div>
		</div>