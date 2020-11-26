/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.Verpreguntas = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	Verpreguntas = {},
	owner = window,
	docElement = document.documentElement;
	
	Verpreguntas.init = function(_path, _model, _view, tamanoVentana){
		path = _path;
		model = _model;
		view = _view;
		Verpreguntas.cambiar_responsive(tamanoVentana);
	}

	Verpreguntas.cambiar_responsive = function(tamanoVentana){
		//console.log(tamanoVentana);
		if(tamanoVentana<600){
			
		}else{
			
		}
	}

	Verpreguntas.eliminar = function(id_pregunta)
	{
		if(confirm("desea continuar? , eliminará todas las partidas asociadas a esta pregunta."))
		{
			$.post( path+"modules/pregunta/pregunta_callback.php", 
				{ 
					id_pregunta : id_pregunta,
					action : "eliminar"
				})
			  	.done(function( data ) 
			  	{
				  	if(data.lastIndexOf("ERROR:") == 0){
			  			location.href = path+'modules/pregunta/ver_preguntas/mensaje/5';
			  		}else{
			  			location.href = path+'modules/pregunta/ver_preguntas/mensaje/6';
			  		}
			  	})
		  	  	.fail(function() 
		  	  	{
			    	location.href = path+'modules/pregunta/ver_preguntas//mensaje/5';
				})
			;
		}
	}


	return Verpreguntas;
	
})(this, this.document);