/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.nueva_categoria = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	nueva_categoria = {},
	owner = window,
	docElement = document.documentElement;
	
	nueva_categoria.init = function(_path, _model, _view, tamanoVentana)
	{
		path = _path;
		model = _model;
		view = _view;
		nueva_categoria.cambiar_responsive(tamanoVentana);
	}

	nueva_categoria.cambiar_responsive = function(tamanoVentana){
		//console.log(tamanoVentana);
		if(tamanoVentana<600){
			
		}else{
			
		}
	}

	nueva_categoria.guardar = function()
	{
		var categoria = $("#categoria").val();
			
		$.post( path+"modules/categoria/categoria_callback.php", 
			{ 
				categoria : categoria,
				action : "agregar"
			})
		  	.done(function( data ) 
		  	{
		  		alert( data );
		  		location.reload();
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
			    alert( "error: " + data );
			})
		;
	}


	return nueva_categoria;
	
})(this, this.document);