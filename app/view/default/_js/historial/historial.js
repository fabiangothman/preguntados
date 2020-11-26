/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.MSHistorial = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	MSHistorial = {},
	owner = window,
	docElement = document.documentElement;
	
	MSHistorial.init = function(_path, _model, _view, tamanoVentana){
		path = _path;
		model = _model;
		view = _view;
		MSHistorial.cambiar_responsive(tamanoVentana);
	}

	MSHistorial.cambiar_responsive = function(tamanoVentana){
		if(tamanoVentana<600){
			$("#tipo_visualizacion").attr("class", "areaNavegacionResponsive");
		}else{
			$("#tipo_visualizacion").attr("class", "areaNavegacionEscritorio");
		}

		//Alto minimo para este módulo
		var altoVentana = $(window).height() - $("#header_container").height();
		$("#historial_container .page_content").css("min-height", altoVentana+"px");
	}

	MSHistorial.navegar = function(url){
		window.location.href = url;
	}

	return MSHistorial;
	
})(this, this.document);