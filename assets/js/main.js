$(document).on("ready", inicio);

function inicio () {

	/*
	* Textareas con un editor de texto html
	*/ 
	$('.editorhtml').wysihtml5({
		"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
		"emphasis": true, //Italics, bold, etc. Default true
		"lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
		"html": false, //Button which allows you to edit the generated HTML. Default false
		"link": false, //Button to insert a link. Default true
		"image": false, //Button to insert an image. Default true,
		"color": false //Button to change color of font
	});

	/*
	* Scroll escritorio, menu
	*/
	$('.lnk').on('click', function () {
		$('.lnk').parent().removeClass();
		$(this).parent().addClass('active');
		var href = $(this).attr('href');
		var posi = $(href).offset().top-60;
		$('html, body').animate({scrollTop:posi}, 'slow');
	});

	/*
	* Toltip para botones de secciones
	*/
	$('#btn_agregar, #btn_imprimir').tooltip();

	$('.popover-tarea').popover({trigger:'hover'})

	/*
	* swicth, verificando estado y enviando para modificarlo
	*/
	$('.terminada').on('switch-change', function (e, data) {
	    var value = data.value;
	    var id = $(this).data('id');
	    var accion = $(this).data('accion');
	    if(value){
	    	var valor = 1;
	    }else{
	    	var valor = 0;
	    }
	    //pasar por ajax
	    var parametros = {"id":id, "valor":valor}
		$.ajax({
	        type: "POST",
	        url: accion,
	        data: parametros,
	        dataType: "html",
		});
    });

	/*
	* Calendario
	*/
	$('.fecha').datetimepicker({});

	/*
	* Validacion de formularios en la vista
	 */	
	$(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );

	/*
	* Busca y reemplaza en select con las ubicaciones
	 */
	$("#iubicacion").on("keyup", function(){
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
	$("#idepartamento").on("keyup", function(){
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
	$("#icargo").on("keyup", function(){
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

	/*
	* Busca y reemplaza en select con las ubicaciones
	 */
	$("#iusuario").on("keyup", function(){
		var valor = $("#iusuario").val();
		var accion = $("#iusuario").data('url');
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
				$("#usuario").children().remove();
				$("#usuario").append(datos);
			}
		});
	});

	/*
	* Tablas paginadas
	 */
	oTable = $('.tabla').dataTable({
		"oLanguage": {
			"oPaginate": {
				"sNext": "",
				"sPrevious": ""
			},
			"sSearch": "Buscar",
			"sZeroRecords": "No se encontraron resultados",
			"sInfo": "Mostrando _TOTAL_ de (_START_ a _END_)",
			"sInfoEmpty": "Mostrando 0 de ",
			"sInfoFiltered": "_MAX_"
		},
		"iDisplayLength": 10
	});
	$.extend( $.fn.dataTableExt.oStdClasses, {
	    "sWrapper": "dataTables_wrapper form-inline"
	} );
}