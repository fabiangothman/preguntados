<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

	define("USING_DB", true);

	$_DB_MSAPP = array( 
		"Server"=>'localhost',
		"User"=>'ubitwrvy_preguntados_v_ubits',
		"Pass"=>'Pr3gunt4d05',
		"Db"=>'ubitwrvy_preguntados_v_ubits',
		"Driver"=>'mysqli',
		"Debug"=>false,
		"Conector"=>'adodb');

	/*$_DB_MSAPP = array( 
		"Server"=>'localhost',
		"User"=>'ubitwrvy_preguntados',
		"Pass"=>'eaUPk(?}No3l',
		"Db"=>'ubitwrvy_preguntados',
		"Driver"=>'mysqli',
		"Debug"=>false,
		"Conector"=>'adodb');*/
		
	define("_MSFW_APP_NAME_","Preguntados");

	/**** DEFICIÓN DE CONSTANTES ****/
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
	define("_IMG_ROOT_","app/view/default/_img/");

	/*	Envio de correos	*/
	define("_EMAILFROM_", "no-reply@preguntados.com");

	/* Tiempo de caducidad de la sesión (en minutos) */
	define("_SESSION_TIME_", 720);

	define("_DBPFX_",""); //Prefijo tablas base de datos del sistema
	define("_CHARSET_","iso-8859-1"); //Cotejamiento de las páginas

	// Definición de auto carga de clases para las librerías
	/*spl_autoload_register(function ($clase) {
    include_once (_LIB_PATH_ . "common/" . $clase . '.cls.php');
	});*/
?>
