/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.MSPregunta = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	id_pregunta = "" /* id de la pregunta actual */,
	id_ronda = 0 /* Contiene la id de ronda en cual va la partida actual */,
	segDelay = 1 /* Segundos de delay al responder una pregunta para ser redirigido*/,
	controlTiempo = null /* Variable usada para llevar el contador de tiempo*/,
	MSPregunta = {},
	owner = window,
	docElement = document.documentElement;
	
	MSPregunta.init = function(_path, _model, _view, _id_pregunta, _id_ronda, tamanoVentana){
		path = _path;
		model = path+_model;
		view = path+_view;
		id_pregunta = _id_pregunta;
		id_ronda = _id_ronda;
		MSPregunta.cambiar_responsive(tamanoVentana);
	}

	MSPregunta.cambiar_responsive = function(tamanoVentana){
		if(tamanoVentana<600){
			$("#tipo_visualizacion").attr("class", "areaNavegacionResponsive");
		}else{
			$("#tipo_visualizacion").attr("class", "areaNavegacionEscritorio");
		}

		//Alto minimo para este módulo
	    var altoVentana = $(window).height() - $("#header_container").height();
	    $("#pregunta_container .page_content").css("min-height", altoVentana+"px");
	    $("#pregunta_container .contenedor_area").css("min-height", altoVentana+"px");
	}

	MSPregunta.navegar = function(url){
		window.location.href = url;
	}

	MSPregunta.iniciarContador = function(tiempo){
		$("#contador_tiempo").html(tiempo+'"');
		var conteo = tiempo-1;
		controlTiempo = setInterval(function(){
			if(conteo>=0){
				$("#contador_tiempo").html(conteo+'"');
				conteo--;
			}else{
				//Aca hace validacion para times'up
				clearInterval(controlTiempo);
				//Realiza la validación para tiempo fuera
				MSPregunta.validarRespuesta(null, true);
			}			
		}, 1000);
	}

	//Realiza la validacion por bd de la respuesta del usuario
	MSPregunta.validarRespuesta = function(id_respuesta, tiempoFuera = false){
		$(".cont_texto").removeAttr("onclick");
		clearInterval(controlTiempo);
		var parametros = {
			"accion" : "validarRespuesta",
			"id_pregunta" : id_pregunta,
			"id_respuesta" : id_respuesta,
			"id_ronda" : id_ronda
        };
        $.ajax({
        	data: parametros, //datos que se envian a traves de ajax
        	url: path+"modules/pregunta/preguntaModel/", //archivo que recibe la peticion
        	type: 'post', //método de envio
        	beforeSend: function(){
        		$("#body").css("cursor","wait");
        		console.log("Validando respuesta, espere por favor...");
        	},
        	success: function(response){ //una vez que el archivo recibe el request lo procesa y lo devuelve
        		$("#body").css("cursor","auto");
        		console.log("Respuesta:"+response+".");
        		
        		if(response=="verdadera"){
        			MSPregunta.animarRespuesta("Correcto", "#00ff00", "continue");
        		}else if(response=="verdadera_completa"){
        			MSPregunta.animarRespuesta("Correcto", "#00ff00", "modules/home/home/mensaje/10");
        		}else if(response=="verdadera_espera"){
        			MSPregunta.animarRespuesta("Correcto", "#00ff00", "modules/home/home/mensaje/11");
        		}else{
        			if(tiempoFuera){
        				MSPregunta.animarRespuesta("Tiempo fuera", "yellow", "modules/home/home");
        			}else{
        				MSPregunta.animarRespuesta("Perdiste", "red", "modules/home/home");
        			}
        		}
        	}
        });
	}

	//Anima las respuestas cuando el usuario presiona cualquier respuesta
	MSPregunta.animarRespuesta = function(respuesta, color = "red", evento = "modules/home/home"){
		$("#retroal_respuesta").html(respuesta.toUpperCase());
		$("#retroal_respuesta").css({"font-size":"0px", "color":color});
		$("#retroal_respuesta").animate({fontSize:'+=50px'}, 500, function(){
		var cuentaDelayResultado=0;
		var delayResultado = setInterval(function(){
			cuentaDelayResultado++
			if(cuentaDelayResultado>=segDelay){
				clearInterval(delayResultado);
				//Inicia la redirección según el tipo de evento
				if(evento=="continue"){
					MSPregunta.navegar(path+"modules/ruleta/ruleta/id_ronda/"+id_ronda);
				}else{
					MSPregunta.navegar(path+evento);
				}
			}
		}, 1000);
        });
	}

	return MSPregunta;
	
})(this, this.document);