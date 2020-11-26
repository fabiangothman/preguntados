/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.Vercategorias = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	Vercategorias = {},
	owner = window,
	docElement = document.documentElement;
	
	Vercategorias.init = function(_path, _model, _view, tamanoVentana){
		path = _path;
		model = _model;
		view = _view;
		Vercategorias.cambiar_responsive(tamanoVentana);
	}

	Vercategorias.cambiar_responsive = function(tamanoVentana){
		//console.log(tamanoVentana);
		if(tamanoVentana<600){
			
		}else{
			
		}
	}

	Vercategorias.eliminar = function(id_categoria)
	{
		$.post( path+"modules/categoria/categoria_callback.php", 
			{ 
				id_categoria : id_categoria,
				action : "eliminar"
			})
		  	.done(function( data ) 
		  	{
		  		alert( data );
		  		location.reload();
		  	})
	  	  	.fail(function() 
	  	  	{
			    alert( "error: " + data );
			})
		;
	}


	return Vercategorias;
	
})(this, this.document);