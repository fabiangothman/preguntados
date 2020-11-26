/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.nuevo_usuario = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	nuevo_usuario = {},
	owner = window,
	docElement = document.documentElement;
	
	nuevo_usuario.init = function(_path, _model, _view, tamanoVentana)
	{
		path = _path;
		model = _model;
		view = _view;
		nuevo_usuario.cambiar_responsive(tamanoVentana);
	}

	nuevo_usuario.cambiar_responsive = function(tamanoVentana){
		//console.log(tamanoVentana);
		if(tamanoVentana<600){
			$("#email").attr("placeholder", "Correo electrónico");
			$("#contrasena").attr("placeholder", "Contraseña");
		}else{
			$("#email").attr("placeholder", "Ingrese su email");
			$("#contrasena").attr("placeholder", "Ingrese su clave");
		}
	}

	nuevo_usuario.guardar = function()
	{	
		$('#error').hide();  $('#bien').hide();
		$('#error').empty();  $('#bien').empty();

		var id_rol = $("#id_rol").val();
		var identificacion = $("#identificacion").val();
		var codigo = $("#codigo").val();
		var nombres = $("#nombres").val();
		var apellidos = $("#apellidos").val();
		var email = $("#email").val();
		var clave = $("#clave").val();
		
		$.post( path+"modules/usuario/usuario_callback.php", 
			{ 
				id_rol : id_rol, 
				identificacion :  identificacion,
				codigo : codigo,
				nombres : nombres,
				apellidos : apellidos,
				email : email,
				clave : clave,
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
		  		}
		  		//alert( data );
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
			    //alert( "error: " + data );
			    $('#error').append('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + data);
		  		$('#error').show(); 
			})
		;
	}


	return nuevo_usuario;
	
})(this, this.document);