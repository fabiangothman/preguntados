/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.MSHome = (function( window, document, undefined ) {
	path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	controlTiempo = null /* Variable usada para llevar el contador de tiempo*/,
	cada_cuanto_actualizar = 5	/*	Variable para configurar cada cuanto tiempo se actualiza el home	*/,
	usar_timer = true	/*	Variable configurable para iniciar o no el timer de actualización	*/,
	MSHome = {},
	owner = window,
	docElement = document.documentElement;
	
	MSHome.init = function(_path, _model, _view, tamanoVentana){
		path = _path;
		model = _model;
		view = path+_view;
		MSHome.cambiar_responsive(tamanoVentana);

		//Para iniciar el timer de actualización
		(usar_timer) ? MSHome.actualizarHome() : '';
	}

	MSHome.navegar = function(url){
		window.location.href = url;
	}

	MSHome.cambiar_responsive = function(tamanoVentana){
		if(tamanoVentana<600){
			$("#tipo_visualizacion").attr("class", "areaNavegacionResponsive");
		}else{
			$("#tipo_visualizacion").attr("class", "areaNavegacionEscritorio");
		}

		//Alto minimo para este módulo
	    var altoVentana = $(window).height() - $("#header_container").height();
	    $("#home_container .page_content").css("min-height", altoVentana+"px");

		//Ajusta el area de resultados de busqueda al width del buscador
		$("#resultadosBusqueda").attr("style", "width:"+$("#cont_buscar_usuario").width()+"px");

		//Ajusta el alto del buscador
		var heightAreaBuscador = $(window).height() - $("#header_container").height() - $(".seccionBotonera").height();
		$("#resultadosBusqueda").css("max-height", heightAreaBuscador+"px");

	}


	//Se encarga de actualizar el contenido del home cada "cada_cuanto_actualizar" tiempo
	MSHome.actualizarHome = function(){
		var segundos = 0;

		controlTiempo = setInterval(function(){
			if(segundos>=cada_cuanto_actualizar){
				segundos = 0;
				MSHome.traerInformacion();
				clearInterval(controlTiempo);
			}else{
				segundos++;
			}			
		}, 1000);
	}


	MSHome.traerInformacion = function(){
		var parametros = {
			"accion" : "actualizarHome"
        };
        $.ajax({
        	data: parametros, //datos que se envian a traves de ajax
        	url: path+"modules/home/homeModel/", //archivo que recibe la peticion
        	type: 'post', //método de envio
        	beforeSend: function(){
        		console.log("Actualizando home, espere por favor...");
        	},
        	success: function(response){ //una vez que el archivo recibe el request lo procesa y lo devuelve
        		var respJson = $.parseJSON(response);
        		var mi_turno = respJson.partidas_activas.mi_turno;
        		var su_turno = respJson.partidas_activas.su_turno;
        		var partidas_historial = respJson.partidas_historial;

        		MSHome.actualizar_mi_turno(mi_turno);
        		MSHome.actualizar_su_turno(su_turno);
        		MSHome.actualizar_historial(partidas_historial);

        		//Finalmente vuelve a iniciar el intervalo
				MSHome.actualizarHome();
        	}
        });
	}


	MSHome.actualizar_mi_turno = function(array_mi_turno){

		//Vacia todo el contenedor para maquetarlo de cero
		$("#area_miturno").html('');

		if(array_mi_turno.length >= 1){
			$("#area_miturno").append(""+
				"<div class='cont_titulo'>"+
					"<div class='titulo'>Mi turno</div>"+
				"</div>"+
				"<div class='cont_cuerpo'></div>"+
				"<div class='espaciador'></div>"+
			"");

			$.each(array_mi_turno, function(index, mi_partida){
				//Debe limpiar el html desde el foreach del php
				$("#area_miturno .cont_cuerpo").append(""+
					"<div class='cuerpo link_continuar' onclick=MSHome.navegar('"+MSHome.utf8_decode(mi_partida.link_continuar)+"');>"+
						"<div class='columna col_foto'>"+
							"<div class='foto'>"+
								"<img src='"+view+"default/_img/modules/perfil/profilepics/"+MSHome.utf8_decode(mi_partida.foto_oponente)+"' width='50' height='50' />"+
							"</div>"+
						"</div><div class='columna col_inform'>"+
							"<div class='inform'>"+
								"<div class='linea_info nombre_oponente'>"+
									"<span>"+MSHome.utf8_decode(mi_partida.nombre_oponente)+"</span>"+
								"</div>"+
								"<div class='linea_info ronda'>"+
									"<span>Ronda "+MSHome.utf8_decode(mi_partida.ronda)+"</span>"+
								"</div>"+
								"<div class='linea_info fecha_creacion'>"+
									"<span>Iniciado el "+MSHome.utf8_decode(mi_partida.fecha_inicio)+"</span>"+
								"</div>"+
							"</div>"+
						"</div><div class='columna col_marcador'>"+
							"<div class='marcador'>"+
								MSHome.utf8_decode(mi_partida.categorias_local)+" - "+MSHome.utf8_decode(mi_partida.categorias_visitante)+
							"</div>"+
						"</div>"+
					"</div>"+
				"");
			});
		}
	}


	MSHome.actualizar_su_turno = function(array_su_turno){

		//Vacia todo el contenedor para maquetarlo de cero
		$("#area_suturno").html('');

		if(array_su_turno.length >= 1){
			$("#area_suturno").append(""+
				"<div class='cont_titulo'>"+
					"<div class='titulo'>Su turno</div>"+
				"</div>"+
				"<div class='cont_cuerpo'></div>"+
				"<div class='espaciador'></div>"+
			"");

			$.each(array_su_turno, function(index, su_partida){
				//Debe limpiar el html desde el foreach del php
				$("#area_suturno .cont_cuerpo").append(""+
					"<div class='cuerpo link_continuar' onclick=MSHome.navegar('"+MSHome.utf8_decode(su_partida.link_continuar)+"');>"+
						"<div class='columna col_foto'>"+
							"<div class='foto'>"+
								"<img src='"+view+"default/_img/modules/perfil/profilepics/"+MSHome.utf8_decode(su_partida.foto_oponente)+"' width='50' height='50' />"+
							"</div>"+
						"</div><div class='columna col_inform'>"+
							"<div class='inform'>"+
								"<div class='linea_info nombre_oponente'>"+
									"<span>"+MSHome.utf8_decode(su_partida.nombre_oponente)+"</span>"+
								"</div>"+
								"<div class='linea_info ronda'>"+
									"<span>Ronda "+MSHome.utf8_decode(su_partida.ronda)+"</span>"+
								"</div>"+
								"<div class='linea_info fecha_creacion'>"+
									"<span>Iniciado el "+MSHome.utf8_decode(su_partida.fecha_inicio)+"</span>"+
								"</div>"+
							"</div>"+
						"</div><div class='columna col_marcador'>"+
							"<div class='marcador'>"+
								MSHome.utf8_decode(su_partida.categorias_local)+" - "+MSHome.utf8_decode(su_partida.categorias_visitante)+
							"</div>"+
						"</div>"+
					"</div>"+
				"");
			});
		}
	}


	MSHome.actualizar_historial = function(array_historial){

		//Vacia todo el contenedor para maquetarlo de cero
		$("#area_ultimaspartidas").html('');

		if(array_historial.length >= 1){
			$("#area_ultimaspartidas").append(""+
				"<div class='cont_titulo'>"+
					"<div class='titulo'>Últimas partidas</div>"+
				"</div>"+
				"<div class='cont_cuerpo'></div>"+
				"<div class='espaciador'></div>"+
			"");

			$.each(array_historial, function(index, his_partida){
				//Debe limpiar el html desde el foreach del php
				$("#area_ultimaspartidas .cont_cuerpo").append(""+
					"<div class='cuerpo link_continuar' onclick=MSHome.navegar('"+MSHome.utf8_decode(his_partida.link_continuar)+"');>"+
						"<div class='columna col_foto'>"+
							"<div class='foto'>"+
								"<img src='"+view+"default/_img/modules/perfil/profilepics/"+MSHome.utf8_decode(his_partida.foto_oponente)+"' width='50' height='50' />"+
							"</div>"+
						"</div><div class='columna col_inform'>"+
							"<div class='inform'>"+
								"<div class='linea_info nombre_oponente'>"+
									"<span>"+MSHome.utf8_decode(his_partida.nombre_oponente)+"</span>"+
								"</div>"+
								"<div class='linea_info ronda'>"+
									"<span>Ronda "+MSHome.utf8_decode(his_partida.ronda)+"</span>"+
								"</div>"+
								"<div class='linea_info fecha_creacion'>"+
									"<span>Iniciado el "+MSHome.utf8_decode(his_partida.fecha_inicio)+"</span>"+
								"</div>"+
								"<div class='linea_info fecha_fin'>"+
									"<span>Finalizado el "+MSHome.utf8_decode(his_partida.fecha_fin)+"</span>"+
								"</div>"+
							"</div>"+
						"</div><div class='columna col_marcador'>"+
							"<div class='marcador'>"+
								MSHome.utf8_decode(his_partida.categorias_local)+" - "+MSHome.utf8_decode(his_partida.categorias_visitante)+
							"</div>"+
						"</div>"+
					"</div>"+
				"");
			});
		}
	}


	MSHome.buscarOponente = function(cadena_buscar, mi_id_usuario){
		//Ahora debe validar que la id del oponente sea valida
		var parametros = {
			"cadena_buscar" : cadena_buscar,
			"mi_id_usuario" : mi_id_usuario,
			"accion" : "busqueda"
        };
        $.ajax({
        	data: parametros, //datos que se envian a traves de ajax
        	url: path+"modules/home/homeModel/", //archivo que recibe la peticion
        	type: 'post', //método de envio
        	beforeSend: function(){
        		$("#buscar_usuario").attr("id_oponente", "");
        		$("#resultadosBusqueda").html("<p class='resul'>Cargando usuarios ...</p>");
        	},
        	success: function(response){ //una vez que el archivo recibe el request lo procesa y lo devuelve
        		if(response=='false'||response=='[]'){
        			if($("#buscar_usuario").val()=="")
        				$("#resultadosBusqueda").html("");
        			else
        				$("#resultadosBusqueda").html("<p class='no-resul'>Ninguna coincidencia</p>");
        		}else{
        			//console.log(response);
        			var respJson = $.parseJSON(response);
        			//Vacia el area de resultados para borrar acumulados
        			$("#resultadosBusqueda").html("");
        			jQuery.each(respJson, function(index, oponente){
        				var nombreCompleto =  MSHome.utf8_decode(oponente.nombres)+' '+MSHome.utf8_decode(oponente.apellidos);
        				$("#resultadosBusqueda").append("<p class='resul' onclick=\"MSHome.seleccionarOponente("+MSHome.utf8_decode(oponente.id_usuario)+", '"+nombreCompleto+"');\">"+nombreCompleto+"</p>");
        			});
        			//window.location.href = url;
        		}
        	}
        });
	}

	//Entra cuando se ha buscado un oponente y se presiona sobre el en el listado
	MSHome.seleccionarOponente = function(id_oponente, nombresCompletos_oponente){
		$("#buscar_usuario").attr("id_oponente", id_oponente);
		$("#buscar_usuario").val(nombresCompletos_oponente);
		$("#resultadosBusqueda").html("");
	}

	MSHome.navegarAleatoria = function(url){
		window.location.href = url;
	}

	MSHome.navegarOponente = function(url){
		//Si no esta vacio el input permita redirigir
		if($("#buscar_usuario").val().length > 0){
			//Ahora debe validar que la id del oponente sea valida
			var parametros = {
				"id_oponente" : $("#buscar_usuario").attr("id_oponente"),
				"accion" : "buscarIdOponente"
	        };
	        $.ajax({
	        	data: parametros, //datos que se envian a traves de ajax
	        	url: path+"modules/home/homeModel/", //archivo que recibe la peticion
	        	type: 'post', //método de envio
	        	beforeSend: function(){
	        		console.log("Procesando petición, espere por favor...");
	        	},
	        	success: function(response){ //una vez que el archivo recibe el request lo procesa y lo devuelve
	        		if(response){
	        			window.location.href = url+"/oponente/"+$("#buscar_usuario").attr("id_oponente");
	        		}else{
	        			window.location.href = path+"modules/home/home/mensaje/1";
	        		}
	        	}
	        });

		}else{
			alert("Debe ingresar un oponente.");
		}
	}

	MSHome.id_existe = function(id_oponente){
		var resp="demora";
		var parametros = {
			"id_oponente" : id_oponente
        };
        $.ajax({
        	data: parametros, //datos que se envian a traves de ajax
        	url: path+"modules/home/homeModel/", //archivo que recibe la peticion
        	type: 'post', //método de envio
        	beforeSend: function(){
        		console.log("Procesando petición, espere por favor...");
        	},
        	success: function(response){ //una vez que el archivo recibe el request lo procesa y lo devuelve
        		console.log("response:"+response);
        		resp = response;
        		return resp;
        	}
        });
	}

	MSHome.utf8_decode = function(texto){
		return decodeURIComponent(escape(texto));
	}

	return MSHome;
	
})(this, this.document);