/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.MSPerfil = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	MSPerfil = {},
	owner = window,
	docElement = document.documentElement;
	
	MSPerfil.init = function(_path, _model, _view, tamanoVentana){
		path = _path;
		model = _model;
		view = _view;
		MSPerfil.cambiar_responsive(tamanoVentana);
	}

	MSPerfil.cambiar_responsive = function(tamanoVentana){
		if(tamanoVentana<600){
			$("#tipo_visualizacion").attr("class", "areaNavegacionResponsive");
		}else{
			$("#tipo_visualizacion").attr("class", "areaNavegacionEscritorio");
		}

		//Alto minimo para este módulo
		var altoVentana = $(window).height() - $("#header_container").height();
		$("#perfil_container .page_content").css("min-height", altoVentana+"px");
		$("#perfil_container .contenedor_area").css("min-height", altoVentana+"px");
	}

	MSPerfil.navegar = function(url){
		window.location.href = url;
	}

	return MSPerfil;
	
})(this, this.document);