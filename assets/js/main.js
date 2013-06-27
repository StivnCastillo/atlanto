$(document).on("ready", inicio);

function inicio () {

	/*
	* Validacion
	 */
	
	$(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );

	/*
	* Busca y reemplaza en select con las ubicaciones
	 */
	$("#iubicacion").on("keyup", function(url){
		var valor = $("#iubicacion").val();
		var accion = $("#iubicacion").data('url');
		var todos = 0;

		if(valor == String.fromCharCode(42)){
			todos = 1;
		}
		var parametros = {"valor":valor, "todos":todos}
		$.ajax({
	        type: "POST",
	        url: accion,
	        data: parametros,
	        dataType: "html",
	        success: function(datos){
				$("#ubicacion").children().remove();
				$("#ubicacion").append(datos);
			}
		});
		
	});

	/*
	* Busca y reemplaza en select con las ubicaciones
	 */
	$("#idepartamento").on("keyup", function(url){
		var valor = $("#idepartamento").val();
		var accion = $("#idepartamento").data('url');
		var todos = 0;

		if(valor == String.fromCharCode(42)){
			todos = 1;
		}

		var parametros = {"valor":valor, "todos":todos}
		$.ajax({
	        type: "POST",
	        url: accion,
	        data: parametros,
	        dataType: "html",
	        success: function(datos){
				$("#departamento").children().remove();
				$("#departamento").append(datos);
			}
		});
	});

	/*
	* Busca y reemplaza en select con las cargos
	 */
	$("#icargo").on("keyup", function(url){
		var valor = $("#icargo").val();
		var accion = $("#icargo").data('url');
		var todos = 0;

		if(valor == String.fromCharCode(42)){
			todos = 1;
		}

		var parametros = {"valor":valor, "todos":todos}
		$.ajax({
	        type: "POST",
	        url: accion,
	        data: parametros,
	        dataType: "html",
	        success: function(datos){
				$("#cargo").children().remove();
				$("#cargo").append(datos);
				console.log('Listo');
			}
		});
	});

}