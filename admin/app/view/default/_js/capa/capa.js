/*------------------------------------------------------
	Propietario:	Fabián Murillo © 2017
  Producto: 		Plantilla líneal
  Archivo base:	menup.js v.1.0.0
  Descripción: 	Archivo de comportamientos del menú
								principal de la	plantilla.
  Actualizable:	Empleando cualquier editor compatible.
  Información:	Comuníquese con Fabián Murillo
  Derechos:			Derechos totalmente reservados para su
  							distribución, copia o modificación,
                salvo expresa autorización de:
                Fabián Murillo
--------------------------------------------------------*/

/*
Simple Image Trail script- By JavaScriptKit.com
Visit http://www.javascriptkit.com for this script and more
This notice must stay intact
*/

/*	Código perfeccionado por Fabián Murillo	
		Este comentario debe aparecer de esta manera en
		todo caso y sin excepción.	*/

var offsetfrommouse=[15,15]; //image x,y offsets from cursor position in pixels. Enter 0,0 for no offset
var currentdivwidth = 400;	// maximum div size.
var currentdivheight = 300;	// maximum div size.
var cualNombreCapa=null;
var monitoreoMouseCapa = false;
var capaEstatica = false;

function gettrailobj(cual)
{
	if (document.getElementById)
		return document.getElementById(cual).style
	else if (document.all)
		return document.all.cual.style
}

function gettrailobjnostyle(cual)
{
	if (document.getElementById)
		return document.getElementById(cual)
	else if (document.all)
		return document.all.cual
}

function truebody()
{
	return (!window.opera && document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function showtrail(quien, estatico){
	var arrEleIframes = document.getElementsByTagName("iframe");
	// Prevención de múltiples capas
	if(cualNombreCapa!=null && cualNombreCapa!=quien && !capaEstatica)
	{
		gettrailobj(cualNombreCapa).display="none";
		document.onmousemove=null;
		for(unIframe in arrEleIframes)
		{
			var iframeWin = (arrEleIframes[unIframe].contentWindow || arrEleIframes[unIframe].contentDocument)?(arrEleIframes[unIframe].contentWindow || arrEleIframes[unIframe].contentDocument.parentWindow):null;
			if(iframeWin)
				iframeWin.document.onmousemove = null;
		}
		cualNombreCapa=null;
		monitoreoMouseCapa=false;
	}
	else if(cualNombreCapa!=null)
		return;
	
	capaEstatica = estatico;
	
	var tempWidth =	$("#"+quien).width();
	currentdivwidth =	tempWidth*1;
	
	
	$("#"+quien).css("left",-currentdivwidth);
	gettrailobj(quien).display="block";
	currentdivheight = gettrailobjnostyle(quien).offsetHeight;
	gettrailobj(quien).display="none";
	
	document.onmousemove=followmouse;
	
	for(unIframe in arrEleIframes)
	{
		var iframeWin = (arrEleIframes[unIframe].contentWindow || arrEleIframes[unIframe].contentDocument)?(arrEleIframes[unIframe].contentWindow || arrEleIframes[unIframe].contentDocument.parentWindow):null;
		if(iframeWin)
			iframeWin.document.onmousemove = followmouse;
	}
	
	cualNombreCapa = quien;
}

function followmouse(e){
	var xcoord=offsetfrommouse[0]
	var ycoord=offsetfrommouse[1]
	
	var scrolly = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
	
	var posX = (typeof e != "undefined")?e.pageX:event.clientX;
	var posY = (typeof e != "undefined")?e.pageY:event.clientY;
	
	var tempDivX = $("#"+cualNombreCapa).css("left");
	var tempDivY = $("#"+cualNombreCapa).css("top");
	
	var divX = tempDivX*1;
	var divY = tempDivY*1;
	
	// Revisión de sobreposición de mouse con capa
	if(monitoreoMouseCapa)
	{
		var correccionScroll = (typeof e != "undefined")?0:scrolly;
		if((divX<posX || divX>posX) && ((divY-correccionScroll)<posY || (divY-correccionScroll)>posY)) // Sin conflicto
		{
			cierraLayer((typeof e != "undefined")?e:event);
			return;
		}
		else
			return;
	}
	
	posY = (typeof e != "undefined")?posY-scrolly:posY;
	
	var docwidth=document.all? truebody().scrollLeft+truebody().clientWidth : pageXOffset+window.innerWidth-15
	var docheight=document.all? Math.min(truebody().scrollHeight, truebody().clientHeight) : Math.min(window.innerHeight)
	
	// Se revisa horizontalmente
	if(capaEstatica)
	{
		if ((posX + (currentdivwidth/2))>docwidth){
			xcoord = docwidth - currentdivwidth - 2;
		} else if ((posX - (currentdivwidth/2))<0){
			xcoord = 2;
		} else {
			xcoord = posX - (currentdivwidth/2);
		}
		// Se revisa verticalmente
		if ((posY - (currentdivheight/2))<51){
			ycoord = 2;
		} else if ((posY + (currentdivheight/2))>docheight){
			ycoord = docheight - currentdivheight - 2;
		} else {
			ycoord = posY - (currentdivheight/2);
		}
	}
	else
	{
		if ((posX + offsetfrommouse[0] + currentdivwidth)>docwidth){
			xcoord = posX - offsetfrommouse[0] - currentdivwidth;
		} else {
			xcoord = posX + offsetfrommouse[0];
		}
		if (xcoord < 0){
			xcoord = 0;
		}
		// Se revisa verticalmente
		if ((posY - currentdivheight - offsetfrommouse[1])<51){
			ycoord = posY + offsetfrommouse[1];
		} else {
			ycoord = posY - currentdivheight - offsetfrommouse[1];
		}
		if ((ycoord + currentdivheight)>docheight){
			ycoord = docheight - currentdivheight;
		}
	}
	$("#"+cualNombreCapa).css("left",xcoord);
	$("#"+cualNombreCapa).css("top",ycoord+scrolly);
	gettrailobj(cualNombreCapa).display="block";
}

function cierraLayer(e) {
	var arrEleIframes = document.getElementsByTagName("iframe");
	// Se verifica que la capa no esté en conflicto con el mouse
	var posX = (typeof e.pageX != "undefined")?e.pageX:e.clientX;
	var posY = (typeof e.pageY != "undefined")?e.pageY:e.clientY;
	
	var tempDivX = $("#"+cualNombreCapa).css("left");
	var tempDivY = $("#"+cualNombreCapa).css("top");
	
	var scrolly = Math.max(document.body.scrollTop,document.documentElement.scrollTop);
	
	var divX = tempDivX*1;
	var divY = tempDivY*1;
	
	if(divX<=posX && (divX+currentdivwidth)>=posX) // Conflicto en x
	{
		var correccionScroll = (typeof e.pageX != "undefined")?0:scrolly;
		if((divY-correccionScroll)<=posY && ((divY-correccionScroll)+currentdivheight)>=posY) // Conflicto en y
		{
			monitoreoMouseCapa = true;
			return;
		}
	}	
	// Se oculta la capa
	gettrailobj(cualNombreCapa).display="none";
	document.onmousemove=null;
	for(unIframe in arrEleIframes)
	{
		var iframeWin = (arrEleIframes[unIframe].contentWindow || arrEleIframes[unIframe].contentDocument)?(arrEleIframes[unIframe].contentWindow || arrEleIframes[unIframe].contentDocument.parentWindow):null;
		if(iframeWin)
			iframeWin.document.onmousemove = null;
	}
	cualNombreCapa=null;
	monitoreoMouseCapa=false;
}

function muestraLayer(quien, tLink)
{
	if(tLink) {
		showtrail(quien,tLink);
	}
	else {
		showtrail(quien,tLink);
	}
}