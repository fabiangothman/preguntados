/*********	MODAL USES ALLOWED ************************************
<a href="http://www.mediosysoluciones.com/" onclick="loadIframeModal('http://www.mediosysoluciones.com/','800','500','false'); return false;">prueba</a><br />
<a href="http://www.mediosysoluciones.com/" class="iFrameModal" width="800" height="500" local="false">prueba2</a><br />
<a href="http://www.mediosysoluciones.com/" class="Modal" obj="ejemplo">prueba3</a><br />
<a href="http://www.mediosysoluciones.com/" class="Modal" obj="ejemplo" width="800" height="500">prueba4</a><br />
<a href="http://www.mediosysoluciones.com/" onclick="loadModal('ejemplo','800','500'); return false;">prueba5</a><br />
<a href="http://www.mediosysoluciones.com/" onclick="loadModal('ejemplo'); return false;">prueba6</a>

<div id="ejemplo" style="display:none;"><h1>SimpleModal</h1></div>
*******************************************************************/

// JavaScript Document
jQuery(function ($) {
	$(".iFrameModal").click(function (event) {
		event.preventDefault();
		loadIframeModal($(this).attr("href"), $(this).attr("width"), $(this).attr("height"), $(this).attr("local"));
		return false;
	});
	$(".Modal").click(function (event) {
		event.preventDefault();
		loadModal($(this).attr("obj"), $(this).attr("width"), $(this).attr("height"));
		return false;
	});
	$(".iFrameHomeModal").click(function (event) {
		event.preventDefault();
		loadIframeHomeModal($(this).attr("href"), $(this).attr("width"), $(this).attr("height"), $(this).attr("local"));
		return false;
	});
	$(".iFrameAppModal").click(function (event) {
		event.preventDefault();
		loadIframeAppModal($(this).attr("href"), $(this).attr("width"), $(this).attr("height"), $(this).attr("local"));
		return false;
	});
	$(".AppModal").click(function (event) {
		event.preventDefault();
		loadAppModal($(this).attr("obj"), $(this).attr("width"), $(this).attr("height"));
		return false;
	});
});

function loadModal(pObject, pWidth, pHeight)
{
	$("#"+pObject).modal({
		closeHTML:'',
		opacity: 65,
		overlayCss:{
			backgroundColor:'#000'
		},
		containerCss:{
			backgroundColor:'#3C397B',
			borderColor:'#3C397B',
			height:pHeight,
			padding:0,
			width:pWidth
		},
		onOpen: openModal,
		onClose: closeModal,
		overlayClose:true,
		position: ['0',]
	});
}

function loadIframeModal(pSrc, pWidth, pHeight, pLocal)
{
	$.modal.close();
	pSrc = (pLocal=="true")?(pSrc+"[modal]"):pSrc;
	$.modal('<iframe id=\"iframe_modal\" src=\"' + pSrc + '\" height=\"' + pHeight + '\" width=\"' + pWidth + '\" style=\"border:0\" scrolling=\"no\">', {
		closeHTML:'',
		opacity: 65,
		overlayCss:{
			backgroundColor:'#000'
		},
		containerCss:{
			backgroundColor:'#fff',
			borderColor:'#3C397B',
			height:pHeight,
			padding:0,
			width:pWidth
		},
		onOpen: openModal,
		onClose: closeModal,
		overlayClose:true,
		position: [,]
	});
}

function loadIframeHomeModal(pSrc, pWidth, pHeight, pLocal)
{
	$.modal.close();
	pSrc = (pLocal=="true")?(pSrc+"[modal]"):pSrc;
	$.modal('<iframe src=\"' + pSrc + '\" height=\"' + pHeight + '\" width=\"' + pWidth + '\" style=\"border:0\">', {
		closeHTML:'',
		opacity: 65,
		overlayCss:{
			backgroundColor:'#000'
		},
		containerCss:{
			backgroundColor:'#3C397B',
			borderColor:'#3C397B',
			height:pHeight,
			padding:0,
			width:pWidth
		},
		onOpen: openModal,
		/*onClose: closeModal,*/
		overlayClose:true,
		position: [,]
	});
}

function loadAppModal(pObject, pWidth, pHeight)
{
	$("#"+pObject).modal({
		closeHTML:'',
		opacity: 95,
		overlayCss:{
			backgroundColor:'#000'
		},
		containerCss:{
			backgroundColor:'#3C397B',
			borderColor:'#3C397B',
			height:pHeight,
			padding:0,
			width:pWidth
		},
		onOpen: openModal,
		/*onClose: closeModal,*/
		overlayClose:false,
		position: ['0',]
	});
}

function loadIframeAppModal(pSrc, pWidth, pHeight, pLocal)
{
	$.modal.close();
	pSrc = (pLocal=="true")?(pSrc+"[modal]"):pSrc;
	$.modal('<iframe src=\"' + pSrc + '\" height=\"' + pHeight + '\" width=\"' + pWidth + '\" style=\"border:0\">', {
		closeHTML:'',
		opacity: 95,
		overlayCss:{
			backgroundColor:'#000'
		},
		containerCss:{
			backgroundColor:'#3C397B',
			borderColor:'#3C397B',
			height:pHeight,
			padding:0,
			width:pWidth
		},
		onOpen: openModal,
		/*onClose: closeModal,*/
		overlayClose:false,
		position: [,]
	});
}

function openModal(d)
{
	d.overlay.fadeIn(200,function(){
		d.data.show();
		d.container.show();
	});
}

function closeModal(d)
{
	d.data.fadeOut();
	d.container.fadeOut();
	d.overlay.fadeOut();
}