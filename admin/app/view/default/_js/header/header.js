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

	MSHeader.init = function(_path, _model, _view){
		path = _path;
		model = _model;
		view = _view;
	}

	MSHeader.redirigir = function(url){
		window.location.href = url;
	}

	MSHeader.cerrar_sesion = function()
	{
		owner.location = path+"modules/login/logout";
	}

	return MSHeader;
	
})(this, this.document);