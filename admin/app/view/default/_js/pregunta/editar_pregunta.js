/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.EditarPregunta = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	id_pregunta = "" /* id de la pregunta a editar*/,
	EditarPregunta = {},
	owner = window,
	docElement = document.documentElement;
	
	EditarPregunta.init = function(_path, _model, _view, tamanoVentana, _id_pregunta)
	{
		path = _path;
		model = _model;
		view = _view;
		EditarPregunta.cambiar_responsive(tamanoVentana);
		id_pregunta = _id_pregunta;
	}

	EditarPregunta.cambiar_responsive = function(tamanoVentana){
		//console.log(tamanoVentana);
		if(tamanoVentana<600){
			
		}else{
			
		}
	}

	EditarPregunta.guardar = function()
	{	
		$('#error').hide();  $('#bien').hide();
		$('#error').empty();  $('#bien').empty();

		var id_categoria = $("#id_categoria").val();
		var pregunta = $("#pregunta").val();
		var id_respuesta_1 = $("#idR1").val();
		var id_respuesta_2 = $("#idR2").val();
		var id_respuesta_3 = $("#idR3").val();
		var id_respuesta_4 = $("#idR4").val();
		var respuesta_1 = $("#r1").val();
		var respuesta_2 = $("#r2").val();
		var respuesta_3 = $("#r3").val();
		var respuesta_4 = $("#r4").val();
		var correcta = $('input[name="correcta"]:checked', '#formEditPregunta').val();

		$.post( path+"modules/pregunta/pregunta_callback.php",
			{ 
				id_pregunta : id_pregunta,
				id_categoria : id_categoria,
				pregunta : pregunta,
				id_respuesta_1 : id_respuesta_1,
				id_respuesta_2 : id_respuesta_2,
				id_respuesta_3 : id_respuesta_3,
				id_respuesta_4 : id_respuesta_4,
				respuesta_1 : respuesta_1,
				respuesta_2 : respuesta_2,
				respuesta_3 : respuesta_3,
				respuesta_4 : respuesta_4,
				correcta : correcta,
				action : "editar"
			})
		  	.done(function( data ) 
		  	{
		  		if(data.lastIndexOf("ERROR:") == 0)
		  		{
		  			$('#error').append('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data);
		  			$('#error').show();  
		  		}else{
		  			$('#bien').append('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data);
		  			$('#bien').show();
		  		}
		  	})
	  	  	.fail(function() 
	  	  	{
			    $('#error').append('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data);
		  		$('#error').show(); 
			})
		;
	}


	return EditarPregunta;
	
})(this, this.document);