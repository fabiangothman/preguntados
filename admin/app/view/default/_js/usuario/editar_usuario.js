/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.EditarUsuario = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	id_usuario = "" /* id del usuario a editar*/,
	EditarUsuario = {},
	owner = window,
	docElement = document.documentElement;
	
	EditarUsuario.init = function(_path, _model, _view, tamanoVentana, _id_usuario)
	{
		path = _path;
		model = _model;
		view = _view;
		EditarUsuario.cambiar_responsive(tamanoVentana);
		id_usuario = _id_usuario;
	}

	EditarUsuario.cambiar_responsive = function(tamanoVentana){
		//console.log(tamanoVentana);
		if(tamanoVentana<600){
			$("#email").attr("placeholder", "Correo electrónico");
			$("#contrasena").attr("placeholder", "Contraseña");
		}else{
			$("#email").attr("placeholder", "Ingrese su email");
			$("#contrasena").attr("placeholder", "Ingrese su clave");
		}
	}

	EditarUsuario.guardar = function()
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
				id_usuario : id_usuario,
				id_rol : id_rol, 
				identificacion :  identificacion,
				codigo : codigo,
				nombres : nombres,
				apellidos : apellidos,
				email : email,
				clave : clave,
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


	return EditarUsuario;
	
})(this, this.document);