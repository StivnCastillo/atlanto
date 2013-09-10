<?php 
	$ci = &get_instance();
?>
		<div class="row-fluid">
			<div class="span10 offset1">
				<table class="table table-striped table-bordered">
					<tr>
						<th>Numero de Ticket</th>
						<td><?php echo $ticket->id; ?></td>
						<th>Estado</th>
						<td><?php echo $ticket->estado; ?></td>
					</tr>
					<tr>
						<th>Prioridad</th>
						<td><?php echo $ticket->prioridad; ?></td>
						<th>Usuario</th>
						<td><?php echo $ticket->usuario; ?></td>
					</tr>
					<tr>
						<th>Fecha de Creación</th>
						<td><?php echo $ticket->fecha_creado; ?></td>
						<th>Fecha de Solución</th>
						<td><?php echo $ticket->fecha_solucion; ?></td>
					</tr>
					<tr>
						<th>Origen</th>
						<td><?php echo $ticket->origen; ?></td>
						<th>IP</th>
						<td><?php echo $ticket->ip; ?></td>
					</tr>
				</table>
			</div>
			<div class="row-fluid">
				<div class="span10 offset1">
					<ul class="media-list">
						<li class="media">
							<a class="pull-left" href="#">
								<img class="media-object" data-src="holder.js/64x64/text:<?php echo $ticket->usuario; ?>">
							</a>
							<div class="media-body">
								<h4 class="media-heading"><?php echo $ticket->asunto; ?> <small><?php echo $ticket->usuario; ?></small></h4>
								<p>
									<?php echo $ticket->mensaje; ?><br>
									<?php if ($archivos): $i=1;?>
										<?php foreach ($archivos as $row): ?>
											<a href="<?php echo base_url().$row->url; ?>"><i class="icon-download-alt"></i> archivo_<?php echo $i.$row->extension ?></a>
										<?php 
										$i++;
										endforeach ?>
									<?php endif ?>
								</p>
							</div>
						</li>
						<?php if ($mensajes): ?>							
							<?php foreach ($mensajes as $row): ?>
								<li class="media">
									<a class="pull-left" href="#">
										<img class="media-object" data-src="holder.js/64x64/text:<?php echo $row->usuario; ?>">
									</a>
									<div class="media-body">
										<h4 class="media-heading"><?php echo $row->fecha; ?> <small><?php echo $row->usuario; ?></small></h4>
										<p><?php echo $row->mensaje; ?></p>
									</div>
								</li>
							<?php endforeach ?>
						<?php endif ?>
					</ul>
				</div>
			</div>
			<div class="row-fluid">
				<form class="form-vertical" action="<?php echo $accion; ?>" name="frmTicket" method="POST" enctype="multipart/form-data">
					<div class="span10 offset1">
						<!-- mensaje, error, completado, peligro -->
						<?php if ($this->session->flashdata('mensaje')): ?>
					    		<!-- mensaje de exito -->
					    		<?php if ($this->session->flashdata('tipo_mensaje') == 'exito'): ?>
					    			<div class="alert alert-success">
							            <button type="button" class="close" data-dismiss="alert">×</button>
							            <?php echo $this->session->flashdata('mensaje') ?>
						            </div>
					    		<?php endif ?>
							    <!-- mensaje de error -->
								<?php if ($this->session->flashdata('tipo_mensaje') == 'error'): ?>
						            <div class="alert alert-error">
							            <button type="button" class="close" data-dismiss="alert">×</button>
							            <?php echo $this->session->flashdata('mensaje') ?>
						            </div>
						        <?php endif ?>
								<!-- mensaje de peligro -->
								<?php if ($this->session->flashdata('tipo_mensaje') == 'warning'): ?>
						            <div class="alert alert-warning">
							            <button type="button" class="close" data-dismiss="alert">×</button>
							            <?php echo $this->session->flashdata('mensaje') ?>
						            </div>
					            <?php endif ?>
					    <?php endif ?>
						<div class="control-group">
							<label class="control-label" for="mensaje">Mensaje</label>
							<div class="controls">
								<input type="hidden" name="id_ticket" value="<?php echo $ticket->id; ?>">
								<textarea class="input-block-level" name="mensaje" id="mensaje" rows="6" required></textarea>
							</div>
						</div>
						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-inverse">Responder</button>
								<a href="<?php echo base_url().'ticket/mis_tickets'; ?>" name="cancelar" class="btn"><?php echo $ci->lang->line('btn_cancelar'); ?></a>
							</div>
						</div>
					</div>					
				</form>
			</div>
		</div>