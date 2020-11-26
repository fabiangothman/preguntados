/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.MSHeader = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	MSHeader = {},
	owner = window,
	docElement = document.documentElement;

	MSHeader.init = function(_path, _model, _view, tamanoVentana){
		path = _path;
		model = _model;
		view = _view;
		MSHeader.cambiar_responsive(tamanoVentana);
	}

	MSHeader.cambiar_responsive = function(tamanoVentana){
		//console.log(tamanoVentana);
		if(tamanoVentana<600){
			$("#email").attr("placeholder", "Correo electrónico");
			$("#contrasena").attr("placeholder", "Contraseña");
		}else{
			$("#email").attr("placeholder", "Ingrese su email");
			$("#contrasena").attr("placeholder", "Ingrese su clave");
		}
	}

	MSHeader.navegar = function(url){
		window.location.href = url;
	}

	return MSHeader;
	
})(this, this.document);