<?php 
	$ci = &get_instance();
?>
		<article class="row span6 offset3" id="logo">
			<img src="<?php echo base_url(); ?>assets/img/logo_informatica.png" />
		</article>

		<article class="row span8 offset2" id="logo">
			<?php echo $config->texto_inicio; ?>
		</article>

		<article class="row">
			<div class="span4 offset5">
				<?php if ($this->session->flashdata('error_login')): ?>
					<div class="alert alert-error">
						<?php echo $ci->lang->line('msj_error_sesion') ?>
						<button type="button" class="close" data-dismiss="alert">&times;</button>
					</div>
				<?php endif ?>
				<a class="btn primary btn-primary btn-large" href="#inicio-sesion" data-toggle="modal"><?php echo $ci->lang->line('btn_iniciar_sesion') ?></a>
			</div>
		</article>
		<!-- Cuadro Modal Iniciar Sesion-->
		<article class="modal hide fade"  id="inicio-sesion">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3><?php echo $ci->lang->line('btn_iniciar_sesion') ?></h3>
			</div>
			<div class="modal-body">
				<div class="login-form">
					<form class="form-horizontal" action="<?php echo $accion_login; ?>" method="POST" name="frm_login" id="frm_login">
						<fieldset>
							<div class="control-group">
								<label class="control-label" for="usuario"><?php echo $ci->lang->line('lbl_usuario') ?></label>
								<div class="controls">
									<input type="text" name="usuario" class="span3" id="usuario" placeholder="<?php echo $ci->lang->line('lbl_usuario') ?>" required />
									<p class="help-block"></p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="password"><?php echo $ci->lang->line('lbl_password') ?></label>
								<div class="controls">
									<input type="password" name="password" class="span3" id="password" placeholder="<?php echo $ci->lang->line('lbl_password') ?>" required />
								</div>
							</div>
							<div class="control-group">
								<div class="controls">
									<input type="submit" value="Enviar" class="btn btn-inverse" />
								</div>
							</div>
						</fieldset>

					</form>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal"><?php echo $ci->lang->line('btn_cerrar') ?></a>
			</div>
		</article>
		<br>
		<br>