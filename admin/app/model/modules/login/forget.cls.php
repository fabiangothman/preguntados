<?php

/* * **************************************************
 * 	Desarrollado por: Fabián Murillo © 2017	*
 * *************************************************** */

abstract class DAOForget{
  
  static public $conexion;

  // Validamos si existe el correo en la base de datos
	static public function checkUserbyEmail($UsuarioEmail)
	{
    $query = "SELECT * FROM "._DBPFX_."usuarios WHERE email = '".self::$conexion->safeText($UsuarioEmail)."' LIMIT 1";  
		$result = self::$conexion->query_db($query);  
    
		if( isset($result[0]) )
      return $result[0];
		else
      return null;
	}

  static public function changePass($id, $pass)
	{
    $query = "UPDATE "._DBPFX_."usuarios SET clave = '".md5(self::$conexion->safeText($pass))."' WHERE id_usuario = ".self::$conexion->safeText($id)." LIMIT 1";

    return self::$conexion->exec_query_db($query);
  } 
}

class forget
{
  private $main;
  private $userData = array();

  public function __construct(&$p_main)
	{
    $this->main = $p_main;
    DAOForget::$conexion = $this->main->db_data;
  }

  public function checkUserbyEmail($UsuarioEmail)
	{
		return DAOForget::checkUserbyEmail($UsuarioEmail);
  }

  public function changePass($id, $pass)
	{
    return DAOForget::changePass($id, $pass);
  }
}