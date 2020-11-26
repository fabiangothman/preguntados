/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.MSRankingGeneral = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	MSRankingGeneral = {},
	owner = window,
	docElement = document.documentElement;
	
	MSRankingGeneral.init = function(_path, _model, _view, tamanoVentana){
		path = _path;
		model = _model;
		view = _view;
		MSRankingGeneral.cambiar_responsive(tamanoVentana);
	}

	MSRankingGeneral.cambiar_responsive = function(tamanoVentana){
		if(tamanoVentana<600){
			$("#tipo_visualizacion").attr("class", "areaNavegacionResponsive");
		}else{
			$("#tipo_visualizacion").attr("class", "areaNavegacionEscritorio");
		}

		//Alto minimo para este módulo
		var altoVentana = $(window).height() - $("#header_container").height();
		$("#rankinggeneral_container .page_content").css("min-height", altoVentana+"px");
	}

	MSRankingGeneral.navegar = function(url){
		window.location.href = url;
	}

	return MSRankingGeneral;
	
})(this, this.document);