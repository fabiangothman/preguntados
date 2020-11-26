/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.EditarCategoria = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	id_categoria = "" /* id del usuario a editar*/,
	EditarCategoria = {},
	owner = window,
	docElement = document.documentElement;
	
	EditarCategoria.init = function(_path, _model, _view, tamanoVentana, _id_categoria)
	{
		path = _path;
		model = _model;
		view = _view;
		EditarCategoria.cambiar_responsive(tamanoVentana);
		id_categoria = _id_categoria;
	}

	EditarCategoria.cambiar_responsive = function(tamanoVentana){
		//console.log(tamanoVentana);
		if(tamanoVentana<600){
			
		}else{
			
		}
	}

	EditarCategoria.guardar = function()
	{
		$('#error').hide();  $('#bien').hide();
		$('#error').empty();  $('#bien').empty();
		
		var categoria = $("#categoria").val();

		$.post( path+"modules/categoria/categoria_callback.php", 
			{ 
				id_categoria : id_categoria,
				categoria : categoria,
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
			    $('#error').append('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Comuniquese con el administrador!</strong> ' + data);
		  		$('#error').show();  
			})
		;
	}


	return EditarCategoria;
	
})(this, this.document);