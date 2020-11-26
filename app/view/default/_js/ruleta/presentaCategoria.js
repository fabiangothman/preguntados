/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.MSPresentaCategoria = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	MSPresentaCategoria = {},
	owner = window,
	docElement = document.documentElement;
	
	MSPresentaCategoria.init = function(_path, _model, _view, tamanoVentana){
		path = _path;
		model = _model;
		view = _view;
		MSPresentaCategoria.cambiar_responsive(tamanoVentana);
	}

	MSPresentaCategoria.cambiar_responsive = function(tamanoVentana){
		if(tamanoVentana<600){
			$("#tipo_visualizacion").attr("class", "areaNavegacionResponsive");
		}else{
			$("#tipo_visualizacion").attr("class", "areaNavegacionEscritorio");
		}
	}

	MSPresentaCategoria.navegar = function(url){
		window.location.href = url;
	}

	return MSPresentaCategoria;
	
})(this, this.document);