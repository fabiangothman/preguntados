/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.MSSeleccionCategoria = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	id_ronda = 0 /* Ronda actual que lleva la partida */,
	categorias = []	/*	Array de nombres de las categorias	*/,
	id_categ_selec = null	/*	id de la categoria seleccionada	*/,
	MSSeleccionCategoria = {},
	owner = window,
	docElement = document.documentElement;
	
	MSSeleccionCategoria.init = function(_path, _model, _view, _id_ronda, _categorias, tamanoVentana){
		path = _path;
		model = _model;
		view = _view;
		id_ronda = _id_ronda;
		categorias = $.parseJSON(_categorias);
		
		MSSeleccionCategoria.cambiar_responsive(tamanoVentana);
	}

	MSSeleccionCategoria.cambiar_responsive = function(tamanoVentana){
		if(tamanoVentana<600){
			$("#tipo_visualizacion").attr("class", "areaNavegacionResponsive");
		}else{
			$("#tipo_visualizacion").attr("class", "areaNavegacionEscritorio");
		}

		//Alto minimo para este módulo
	    var altoVentana = $(window).height() - $("#header_container").height();
	    $("#seleccionCategoria_container .page_content").css("min-height", altoVentana+"px");
	    $("#seleccionCategoria_container .contenedor_area").css("min-height", altoVentana+"px");
	}

	MSSeleccionCategoria.navegar = function(url){
		window.location.href = url;
	}

	MSSeleccionCategoria.jugar = function(){
		if(id_categ_selec == null){
			alert("Debe seleccionar una categoría a jugar.");
		}else{
			MSSeleccionCategoria.navegar(path+"modules/pregunta/pregunta/id_categoria/"+id_categ_selec+"/id_ronda/"+id_ronda);
		}
	}

	MSSeleccionCategoria.seleccionarCategoria = function(obj){
		id_categ_selec = $(obj).attr("id");
		$("#tit_categ_selecc").html(categorias[id_categ_selec-1].toUpperCase());
		$(".cont_personaje").css("background-color","white");
		$(".cont_personaje").hover(function(){
	        $(this).css("background-color", "#61d261");
	        }, function(){
	        $(this).css("background-color", "white");
	    });
	    $(obj).css("background-color","#61d261");
	    $(obj).hover(function(){
	        $(this).css("background-color", "#61d261");
	        }, function(){
	        $(this).css("background-color", "#61d261");
	    });

	}

    MSSeleccionCategoria.utf8_decode = function(texto){
      return decodeURIComponent(escape(texto));
    }

    MSSeleccionCategoria.utf8_encode = function(texto){
      return unescape(encodeURIComponent(texto));
    }

	return MSSeleccionCategoria;
	
})(this, this.document);