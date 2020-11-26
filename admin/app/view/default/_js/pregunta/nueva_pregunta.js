/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.nueva_pregunta = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	nueva_pregunta = {},
	owner = window,
	docElement = document.documentElement;
	
	nueva_pregunta.init = function(_path, _model, _view, tamanoVentana)
	{
		path = _path;
		model = _model;
		view = _view;
		nueva_pregunta.cambiar_responsive(tamanoVentana);
	}

	nueva_pregunta.cambiar_responsive = function(tamanoVentana){
		//console.log(tamanoVentana);
		if(tamanoVentana<600){
			
		}else{
			
		}
	}

	nueva_pregunta.guardar = function()
	{	
		$('#error').hide();  $('#bien').hide();
		$('#error').empty();  $('#bien').empty();
		
		var id_categoria = $("#id_categoria").val();
		var pregunta = $("#pregunta").val();
		var respuesta_1 = $("#r1").val();
		var respuesta_2 = $("#r2").val();
		var respuesta_3 = $("#r3").val();
		var respuesta_4 = $("#r4").val();
		var correcta  = $('input[name="correcta"]:checked', '#form_pregunta').val();

		console.log(correcta);

		$.post( path+"modules/pregunta/pregunta_callback.php", 
			{ 
				id_categoria :  id_categoria,
				pregunta : pregunta,
				respuesta_1 :  respuesta_1,
				respuesta_2 : respuesta_2,
				respuesta_3 : respuesta_3,
				respuesta_4 : respuesta_4,
				correcta : correcta,
				action : "agregar"
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

		  			$("#pregunta").val("");
		  			$("#r1").val("");
		  			$("#r2").val("");
		  			$("#r3").val("");
		  			$("#r4").val("");
		  		}
		  		//location.reload();
		  		/*$("#identificacion").val() = "";
		  		$("#codigo").val() = "";
		  		$("#nombres").val() = "";
		  		$("#apellidos").val() = "";
		  		$("#email").val() = "";
		  		$("#clave").val() = "";
		  		*/
		  	})
	  	  	.fail(function() 
	  	  	{
			    $('#error').append('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data);
		  		$('#error').show(); 
			})
		;
	}


	return nueva_pregunta;
	
})(this, this.document);