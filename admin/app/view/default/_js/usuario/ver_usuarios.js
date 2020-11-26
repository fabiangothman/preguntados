/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.VerUsuarios = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	VerUsuarios = {},
	owner = window,
	docElement = document.documentElement;
	
	VerUsuarios.init = function(_path, _model, _view, tamanoVentana){
		path = _path;
		model = _model;
		view = _view;
		VerUsuarios.cambiar_responsive(tamanoVentana);
	}

	VerUsuarios.cambiar_responsive = function(tamanoVentana){
		//console.log(tamanoVentana);
		if(tamanoVentana<600){
			$("#email").attr("placeholder", "Correo electrónico");
			$("#contrasena").attr("placeholder", "Contraseña");
		}else{
			$("#email").attr("placeholder", "Ingrese su email");
			$("#contrasena").attr("placeholder", "Ingrese su clave");
		}
	}

	VerUsuarios.eliminar = function(id_usuario)
	{
		if(confirm("desea continuar? , eliminara todas las partidas asociadas a este usuario."))
		{
			$.post( path+"modules/usuario/usuario_callback.php", 
			{ 
				id_usuario : id_usuario,
				action : "eliminar"
			})
		  	.done(function( data ) 
		  	{
		  		if(data.lastIndexOf("ERROR:") == 0){
		  			//console.log('ir a '+path+'modules/usuario/ver_usuarios/mensaje/3');	
		  			location.href = path+'modules/usuario/ver_usuarios/mensaje/3';
		  		}else{
		  			//console.log('ir a '+path+'modules/usuario/ver_usuarios/mensaje/4');	
		  			location.href = path+'modules/usuario/ver_usuarios/mensaje/4';
		  		}
		  	})
	  	  	.fail(function() 
	  	  	{
			    //console.log('ir a '+path+'modules/usuario/ver_usuarios/mensaje/3');
			    location.href = path+'modules/usuario/ver_usuarios/mensaje/3';
			});
		}
	}


	return VerUsuarios;
	
})(this, this.document);