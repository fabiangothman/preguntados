/****************************************************************************
*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
*					  © 2017												*
****************************************************************************/

// JavaScript Document
window.MSRuleta = (function( window, document, undefined ) {
	var path = "" /* path al FrameWork */,
	model = "" /* path a los modelos */,
	view = "" /* path a las vistas */,
	id_ronda /* Ronda actual que lleva la partida */,
  cont_barra = 0 /* Contiene el conteo de la barra de preguntas correctas respondidas */,
  acceso_concedido = false  /*  Contiene el estado de permisos para estar en esta página de la ruleta  */,
  //colors = ["#0055ff", "#00ff00", "#ff8000", "#35837b", "#ff0", "#00bbff", "#af2f3d"],
  colors = ["#ff8000", "#ff0000", "#fc28a3", "#8000ff", "#0080ff", "#00ff00", "#ff0"],
	categorias = [],
	avatar = [],
	objruleta,
	winningSegment,
	distnaciaX,
	distnaciaY,
	ctx,
	MSRuleta = {},
	owner = window,
	docElement = document.documentElement;
	
	MSRuleta.init = function(_path, _model, _view, _categorias, _avatar, _id_ronda, _cont_barra, _acceso_concedido, tamanoVentana){
		path = _path;
		model = path+_model;
		view = path+_view;
    cont_barra = _cont_barra;
    id_ronda = _id_ronda;
    acceso_concedido = _acceso_concedido;
    if(acceso_concedido){
      if(cont_barra>=3){
        console.log("Redirigiendo a selección de categoria a participar.");
        MSRuleta.navegar(path+"modules/seleccionCategoria/seleccionCategoria/id_ronda/"+id_ronda);
      }
    }
    
		var avat = $.parseJSON(_avatar);
		avatar[0] = "DIAMANTES";
		$.each(avat, function(index, value){
			avatar[index+1] = value;
      //console.log(value+"\n"+MSRuleta.utf8_decode(value));
		});
		//console.log(avatar);
		var cate = $.parseJSON(_categorias);
		categorias[0] = "Diamantes";
		$.each(cate, function(index, value){
			categorias[index+1] = value;
      //console.log(value+"\n"+MSRuleta.utf8_decode(value));
		});
		
		MSRuleta.cambiar_responsive(tamanoVentana);
	}


	MSRuleta.cambiar_responsive = function(tamanoVentana){
		if(tamanoVentana<600){
			$("#tipo_visualizacion").attr("class", "areaNavegacionResponsive");
		}else{
			$("#tipo_visualizacion").attr("class", "areaNavegacionEscritorio");
		}

    //Alto minimo para este módulo
    var altoVentana = $(window).height() - $("#header_container").height();
    $("#ruleta_container .page_content").css("min-height", altoVentana+"px");

    //Código para ponerle límite cuando se acorta con tres puntos los nombres de usuario
    $("#ruleta_container .nombre_comp").css("width","50px");
    var anchoNombre = $("#ruleta_container .cont_nom_comp").width();
    $("#ruleta_container .nombre_comp").css("width",anchoNombre+"px");

    //Código para calcular el alto del iframe de los edge de presentación de categoría
    //Se le envian los parámetros en px de tamaños del edge original para calculo de ratio
    MSRuleta.calcula_altoIframe(290, 322);


    //Calcula el alto y el ancho del contenedor del canvas para centrar el cerebro
    MSRuleta.calcula_canvas();
	}


  MSRuleta.calcula_canvas = function(){
    var paddingAncho = 35;
    var paddingAlto = 15;
    var anchoImagen = 100;
    var altoImagen = 100;
    var anchoCanvas = $("#canvasContainer").width() + (paddingAncho*2);
    var altoCanvas = $("#canvasContainer").height() + (paddingAlto*2);
    var ajusteAncho = -5;
    var ajusteAlto = 100;
    var mitadAnchoCanvas = (anchoCanvas*0.5) - (anchoImagen + ajusteAncho)*0.5;
    var mitadAltoCanvas = (altoCanvas*0.5)  - (altoImagen + ajusteAlto)*0.5;


    $("#canvasContainer .cont_cerebro").css({
      "top": mitadAltoCanvas+ "px",
      "left": mitadAnchoCanvas + "px"
    });
  }


	MSRuleta.navegar = function(url){
		window.location.href = url;
	}

  //Código para calcular el alto del iframe de los edge de presentación de categoría
  MSRuleta.calcula_altoIframe = function(widthOrig, heightOrigi){
    var nuevo_anchoIframe = $("#iframe_edge").width();
    var nuevo_altoIframe = nuevo_anchoIframe*(heightOrigi/widthOrig);
    $("#iframe_edge").css("height", nuevo_altoIframe+"px");
    //alert("nuevo_anchoIframe:"+nuevo_anchoIframe+"\nnuevo_altoIframe:"+nuevo_altoIframe);
  }

	MSRuleta.girarRuleta = function(obj){
		objruleta.startAnimation();
		obj.disabled = true;
		$("#canvasContainer").attr("onclick","");
		$("#canvasContainer").css("cursor","auto");
	}

	MSRuleta.Mensaje = function(){
      winningSegment = objruleta.getIndicatedSegment();
      //alert(winningSegment.idReal);

      swal({
        html: "<iframe src='"+view+"default/edge/modules/ruleta/"+winningSegment.idReal+"/"+winningSegment.idReal+".html' id='iframe_edge' scrolling='no' frameborder='0'></iframe>",
        showCancelButton: false,
        background:'rgba(0, 0, 0, 0.5)',
        confirmButtonColor: '#3085d6',
        allowOutsideClick: false,
        confirmButtonText: 'Jugar!',
        confirmButtonClass: 'btn_jugar',
        buttonsStyling: false
      }).then(function () {
        MSRuleta.navegar(path+"modules/pregunta/pregunta/id_categoria/"+winningSegment.idMask+"/id_ronda/"+id_ronda);
        //MSRuleta.navegar(path+"modules/pregunta/pregunta/id_categoria/_0/id_ronda/"+id_ronda);
      });

      MSRuleta.calcula_altoIframe(290, 322);
    }

    MSRuleta.DibujarTriangulo = function(){
      distnaciaX = 75;
      distnaciaY = -5;
      ctx = objruleta.ctx;
      ctx.strokeStyle = 'navy';
      ctx.fillStyle = '#2b2459';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(distnaciaX + 170, distnaciaY + 5);
      ctx.lineTo(distnaciaX + 230, distnaciaY + 5);
      ctx.lineTo(distnaciaX + 200, distnaciaY + 40);
      ctx.lineTo(distnaciaX + 171, distnaciaY + 5);
      ctx.stroke();
      ctx.fill();
    }


	MSRuleta.Dibujarruleta = function(ArregloElementos){
      objruleta = new Winwheel({
        'canvasId'    : 'ruleta',
        'numSegments' : ArregloElementos.length,
        'outerRadius' : 270,
        'innerRadius' : 30,
        'drawText'    : false,
        //'drawMode'    : 'segmentImage', // Must be segmentImage to draw wheel using one image per segemnt.
        'segments'    : ArregloElementos,
        'textFillStyle'     : 'black',
        'textFontSize'      : '28',
        /*
        'numSegments'       : ArregloElementos.length,              // Specify number of segments.
        'outerRadius'       : 270,            // Set outer radius so wheel fits inside the background.
        'drawText'          : true,           // Code drawn text can be used with segment images.
        'textFontSize'      : 14,
        'textOrientation'   : 'curved',
        'textAlignment'     : 'inner',
        'textMargin'        : '80',
        'textFontFamily'    : 'monospace',
        'textStrokeStyle'   : 'black',
        'textLineWidth'     : 3,
        'textFillStyle'     : 'white',
        'drawMode'          : 'segmentImage', // Must be segmentImage to draw wheel using one image per segemnt.
        'segments':ArregloElementos,
        */
        'animation':{
          'type': 'spinToStop',
          'duration':4,
          'spins': 3,
          'callbackFinished': 'MSRuleta.Mensaje()',
          'callbackAfter': 'MSRuleta.DibujarTriangulo()'
        }
      });
      var wheelImg = new Image();
      wheelImg.onload = function()
      {
          myWheel.wheelImage = wheelImg;
          myWheel.draw();
      }
      //wheelImg.src = "wheel_image.png";

      MSRuleta.DibujarTriangulo();
    }

    MSRuleta.leerElementos = function(){
    	var Elementosruleta = [];
    	var cont = "_0";	/*Como string para que cuando lo reciba pregunta.php no pase como false por ser 0*/
    	categorias.forEach(function (Elemento){
    		if(Elemento){
    			if(cont=="_0"){
    				Elementosruleta.push({ /*'image' : view+'default/_img/modules/1.png',*/ 'fillStyle': colors[0], 'text': Elemento, 'idReal':0, 'idMask':cont });
            cont = 0;
    			}else{
    				Elementosruleta.push({ /*'image' : view+'default/_img/modules/1.png',*/ 'fillStyle': colors[cont], 'text': Elemento, 'idReal':cont, 'idMask':cont });
    			}
    		}    		
    		cont++;
    	});
      MSRuleta.Dibujarruleta(Elementosruleta);
    }

    MSRuleta.utf8_decode = function(texto){
      return decodeURIComponent(escape(texto));
    }

    MSRuleta.utf8_encode = function(texto){
      return unescape(encodeURIComponent(texto));
    }

	return MSRuleta;
	
})(this, this.document);