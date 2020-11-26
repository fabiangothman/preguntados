/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.MSInstrucciones = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	MSInstrucciones = {},
	owner = window,
	docElement = document.documentElement;
	
	MSInstrucciones.init = function(_path, _model, _view, tamanoVentana){
		path = _path;
		model = _model;
		view = _view;
		MSInstrucciones.cambiar_responsive(tamanoVentana);
	}

	MSInstrucciones.cambiar_responsive = function(tamanoVentana){
		if(tamanoVentana<600){
			$("#tipo_visualizacion").attr("class", "areaNavegacionResponsive");
		}else{
			$("#tipo_visualizacion").attr("class", "areaNavegacionEscritorio");
		}

		//Alto minimo para este módulo
		var altoVentana = $(window).height() - $("#header_container").height();
		$("#instrucciones_container .page_content").css("min-height", altoVentana+"px");

		//Calcula las dimensiones del iframe
		MSInstrucciones.calcula_altoIframe(530, 846);
	}

	MSInstrucciones.navegar = function(url){
		window.location.href = url;
	}


	//Código para calcular el alto del iframe de los edge de presentación de categoría
	MSInstrucciones.calcula_altoIframe = function(widthOrig, heightOrigi){
		var anchoVent = $("#tipo_visualizacion").width();
		var alto_iframe = $(window).height() - $("#header_container").height() - 5;
	    var nuevo_anchoIframe = alto_iframe*(widthOrig/heightOrigi);

	    if(nuevo_anchoIframe > anchoVent){
		    var nuevo_altoIframe = $("#tipo_visualizacion").width()*(heightOrigi/widthOrig);
		    $("#iframe_instructivo").css({ "height":nuevo_altoIframe+"px", "width":$("#tipo_visualizacion").width()+"px" });
	    }else{
	    	$("#iframe_instructivo").css({ "height":alto_iframe+"px", "width":nuevo_anchoIframe+"px" });
	    }
	    
	}

	return MSInstrucciones;
	
})(this, this.document);