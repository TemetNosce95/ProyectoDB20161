<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include('head.php'); ?>
		<script type="text/javascript">
			document.ready(function() {
				requestEspecializaciones();
			});

			function requestEspecializaciones() {
				var ruta = $('.especializaciones').data("ruta");
				var consulta = $('.especializaciones').data("consulta");
				var formMessages = $('#form-messages');

				$.ajax({
					type: 'POST',
					url: 'ajax-handler.php',
					data: {ruta: ruta, consulta: consulta}
				})

				.done(function(response) {
					for(var key in response) {
						document.querySelector('.especializaciones').options.add(parseData(response[key], 'multiple_select'));
					}
				})

				.fail(function(data) {
					formMessages.removeClass('hidden');
					formMessages.addClass('alert-danger');

					if (data.responseText !== '')
						formMessages.innerHtml = data.responseText;
					else
						formMessages.text('Oops! An error occured.');
				});
			}
		</script>
	</head>
	<body>
		<?php include('header.php');?>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6">
						<div class="panel panel-primary">
						  <div class="panel-heading">Registro del empleado</div>
						  	<div class="panel-body">
								<div id="form-messages" class="alert .alert-dismissible fade in hidden">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								</div>
								<form class="formEmpleado" action="ajax-handler.php" role="form">
									<div class="form-group row">
										<label for="cifi" class="col-sm-2 col-form-label">C.I. o pasaporte</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="cedula" id="cifi" placeholder="Ingrese la cedula de identidad o el pasaporte del empleado" required>
										</div>
									</div>

									<div class="form-group row">
										<label for="nfi" class="col-sm-2 col-form-label">Nombre</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="nombre" id="nfi" placeholder="Ingrese el nombre del empleado">
										</div>
									</div>

									<div class="form-group row">
										<label for="afi" class="col-sm-2 col-form-label">Apellido</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="apellido" id="afi" placeholder="Ingrese el apellido del empleado">
										</div>
									</div>

									<div class="form-group row">
										<label for="ffi" class="col-sm-2 col-form-label">Fecha de nacimiento</label>
										<div class="col-sm-10">
											<input type="date" class="form-control" name="fechaNacimiento" id="ffi">
										</div>
									</div>

									<div class="form-group row">
										<label for="dfi" class="col-sm-2 col-form-label">Direccion</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="direccion" id="dfi" placeholder="Ingrese la direccion del empleado">
										</div>
									</div>

									<div class="form-group row">
										<label for="telffi" class="col-sm-2 col-form-label">Teléfono</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="telefono" id="telffi" placeholder="Ingrese el teléfono del empleado">
										</div>
									</div>

									<div class="form-group row">
										<label for="tipoEmpleado" class="col-sm-2 col-form-label">Tipo de empleado</label>
										<div class="col-sm-8 col-sm-offset-2">
											<div class="col-sm-6">
												<label class"radio-inline">
													<input type="radio" class="form-control" name="tipoEmpleado" id="tipoEmpleado" value="1" onclick="insertHTML(1)">Empleado
												</label>
											</div>
											<div class="col-sm-6">
												<label class"radio-inline">
													<input type="radio" class="form-control" name="tipoEmpleado" id="tipoEmpleado" value="2" onclick="insertHTML(2)">Doctor
												</label>
											</div>
										</div>
									</div>

									<div class="temp"></div>

									<div class="form-group row">
										<label for="especializacion" class="col-sm-4 col-form-label">Especializaciones</label>
										<small id="select-esp-help" class="form-text text-muted col-sm-8">Mantenga presionada la tecla Ctrl para seleccionar varias especializaciones</small>
										<div class="col-sm-12">
												<select multiple class="form-control especializaciones" id="especializacion" name="especializacion" data-ruta="<?php echo RUTA_EMPLEADOS ?>" data-consulta="<?php echo LISTA_ESPECIALIZACIONES ?>">
													<!-- aqui va lo que devuelva el ajax -->
												</select>
										</div>
									</div>

									<div class="form-group">
										<input type="submit" class="form-control" name="guardar" value="Agregar">
									</div>

									<div class="form-group">
										<input type="submit" class="form-control" name="update" value="Actualizar datos">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php include('footer.php'); ?>
	</body>
</html>
