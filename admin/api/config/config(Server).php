<?php
	/****************************************************************************
	*	Desarrollado por: Fabi�n Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Su�rez, juancsuarezg@correo.udistrital.edu.co	*
	*					  � 2017												*
	****************************************************************************/

	define("USING_DB", true);

	$_DB_MSAPP = array( 
		"Server"=>'localhost',
		"User"=>'id1923578_userpreguntds',
		"Pass"=>'msclH:0',
		"Db"=>'id1923578_preguntads',
		"Driver"=>'mysqli',
		"Debug"=>false,
		"Conector"=>'adodb');
		
	define("_MSFW_APP_NAME_","Preguntados");

	/**** DEFICI�N DE CONSTANTES ****/
	define("_MSFW_PATH_", 'http://' . substr($_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], 0, strlen($_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']) - strlen('index.php')));
	if (!defined("_BASE_PATH_")) define("_BASE_PATH_","");
	define("_API_PATH_",_BASE_PATH_."api/");
	define("_LIB_PATH_",_API_PATH_."libraries/");
	define("_ENGINE_PATH_",_API_PATH_."engine/");
	define("_DB_PATH_",_API_PATH_."db_connector/");
	define("_CONFIG_PATH_",_API_PATH_."config/");

	define("_APP_PATH_",_BASE_PATH_."app/");
	define("_CONTROLLER_PATH_",_APP_PATH_."controller/");
	define("_MODEL_PATH_",_APP_PATH_."model/");
	define("_VIEW_PATH_",_APP_PATH_."view/");

	define("_DEFAULT_CONTROLLER_",_CONTROLLER_PATH_."modules/home/home"); //pagina principal
	define("_DEFAULT_VIEW_PATH_",_VIEW_PATH_."default/");
	define("_THEME_PATH_",_VIEW_PATH_."default/");
	

	/*	Envio de correos	*/
	define("_EMAILFROM_", "no-reply@preguntados.com");

	/*	Timeout por pregunta	*/
	define("_TIEMPO_PREGUNTA_", 21);

	/* Tiempo de caducidad de la sesi�n (en minutos) */
	define("_SESSION_TIME_", 720);

	// for linux
	/* 
	define("_IMG_ROOT_","app/view/default/_img/");
	define("_UPLOAD_IMG_ROOT_USER_","C:/xampp/htdocs/preguntados/app/view/default/_img/modules/usuario/");
	*/

	// for windows 
	
	define("_IMG_ROOT_","app\\view\\default\\_img\\");
	define("_UPLOAD_IMG_ROOT_USER_", "C:\\xampp\\htdocs\\preguntados\\app\\view\\default\\_img\\modules\\usuario\\");
	


	define("_DBPFX_",""); //Prefijo tablas base de datos del sistema
	define("_CHARSET_","iso-8859-1"); //Cotejamiento de las p�ginas

	// Definici�n de auto carga de clases para las librer�as
	/*spl_autoload_register(function ($clase) {
    include_once (_LIB_PATH_ . "common/" . $clase . '.cls.php');
	});*/
?>
