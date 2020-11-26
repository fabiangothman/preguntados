/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.MSLogin = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	MSLogin = {},
	owner = window,
	docElement = document.documentElement;
	
	MSLogin.init = function(_path, _model, _view, tamanoVentana){
		path = _path;
		model = _model;
		view = _view;
		MSLogin.cambiar_responsive(tamanoVentana);
	}

	MSLogin.cambiar_responsive = function(tamanoVentana){
		if(tamanoVentana<600){
			$("#tipo_visualizacion").attr("class", "areaNavegacionResponsive");
		}else{
			$("#tipo_visualizacion").attr("class", "areaNavegacionEscritorio");
		}

		//Alto minimo para este módulo
		//var altoVentana = $(window).height() - $("#header_container").height();
		var altoVentana = $(window).height() + $(".alertsContainer").height();
		$("#login_container .page_content").css("min-height", altoVentana+"px");
	}

	MSLogin.navegar = function(url){
		window.location.href = url;
	}

	return MSLogin;
	
})(this, this.document);