<?php 
	$ci = &get_instance();
?>
		<article class="row span6 offset3" id="logo">
			<img src="<?php echo base_url(); ?>assets/img/logo_informatica.png" />
		</article>

		<article class="row span8 offset2" id="logo">
			<?php echo $config->texto_inicio; ?>
		</article>

		<article class="row span4 offset4">

			<?php if ($this->session->flashdata('error_login')): ?>
				<div class="alert alert-error">
					<?php echo $ci->lang->line('msj_error_sesion') ?>
					<button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
			<?php endif ?>
			

			<a class="btn primary btn-primary" href="#inicio-sesion" data-toggle="modal"><?php echo $ci->lang->line('btn_iniciar_sesion') ?></a>
			<a class="btn primary btn-inverse pull-right" href="#ticket-express"  data-toggle="modal"><?php echo $ci->lang->line('btn_ticket_rapido') ?></a>
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

		<!-- Crear Ticket-->
		<article class="modal hide fade"  id="ticket-express">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3><?php echo $ci->lang->line('index_titulo_ticket') ?></h3>
			</div>
			<div class="modal-body">
				<p><?php echo $ci->lang->line('index_info_ticket') ?></p>
				<div class="login-form">
					<form class="form-horizontal" action="<?php echo $accion_ticket; ?>" name="frm_ticket" method="POST">
						<fieldset>
							<div class="control-group">
								<label class="control-label" for="usuario"><?php echo $ci->lang->line('lbl_usuario') ?></label>
								<div class="controls">
									<input type="text" class="span3" name="usuario" id="usuario" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="asunto"><?php echo $ci->lang->line('lbl_asunto') ?></label>
								<div class="controls">
									<input type="text" class="span3" name="asunto" id="asunto" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="mensaje"><?php echo $ci->lang->line('lbl_mensaje') ?></label>
								<div class="controls">
									<textarea class="span3" id="textarea" name="mensaje" id="mensaje" rows="4"></textarea>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal"><?php echo $ci->lang->line('btn_cerrar') ?></a>
				<a href="#" onclick="document.frm_ticket.submit()" class="btn btn-inverse"><?php echo $ci->lang->line('btn_enviar') ?></a>
			</div>
		</article>