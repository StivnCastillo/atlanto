<?php 
	$ci = &get_instance();
?>
		

		<div class="row">
			<div class="span6">
				<form method="POST" action="<?php echo $accion; ?>">
					<fieldset>
						<legend>Consultar Correo Corporativo</legend>
						<p>Esta sección es para consultar si usted ya tiene asignado un correo corporativo.</p>
						<div class="control-group">
							<label class="control-label" for="cedula">Numero de cedula</label>
							<div class="controls">
								<input type="number" class="span3" id="cedula" name="cedula" value="<?php echo (isset($usuario)) ? $usuario->email : ''; ?>" required  />
							</div>
						</div>
						<span class="help-block">No use puntos (.) ni comas (,)</span>
						<button type="submit" class="btn btn-inverse">Verificar</button>
					</fieldset>
				</form>
			</div>
		</div>
		<?php if (isset($correo)): ?>
			<hr>
			<div class="row">
				<?php if ($exito): ?>
					<div class="alert alert-block alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<h4>Encontramos su correo corporativo.</h4>
						Este es su correo corporativo, para ingresar siga este <a href="http://blancoynegromasivo.com.co/webmail">Enlace</a>. La clave inicial es su numero de cedula.
					</div>
				<?php else: ?>
					<div class="alert alert-block">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<h4>Su correo aun no ha sido creado!</h4>
						El correo corporativo se crea despues de la primer quincena. Si ya ha pasado dicho tiempo y usted no conoce nada de su correo corporativo, dirijase a Gestión Humana.
					</div>
				<?php endif ?>
					
				<table class="table">
					<thead>
						<tr>
							<th>Cedula</th>
							<th>Nombre</th>
							<th>Cargo</th>
							<th>Correo Corporativo</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($exito): ?>
							<tr>
								<td><?php echo $correo->cedula; ?></td>
								<td><?php echo $correo->nombre; ?></td>
								<td><?php echo $correo->cargo; ?></td>
								<td><?php echo $correo->correo; ?></td>
							</tr>
						<?php else: ?>
							<tr>
								<td colspan="4">No se encontro registro</td>
							</tr>
						<?php endif ?>
											
					</tbody>
				</table>
			</div>
		<?php endif ?>
			

