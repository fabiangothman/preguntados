<?php
  /****************************************************************************
  * Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com      *
  *           Juan Suárez, juancsuarezg@correo.udistrital.edu.co  *
  *           © 2017                        *
  ****************************************************************************/

abstract class DAOJuegoOponente{
  
  static public $conexion;

  // Validamos si existe el correo en la base de datos
	static public function buscarIdOponente($id_oponente)
	{
    $query = "SELECT id_usuario FROM "._DBPFX_."usuarios WHERE id_usuario = '".self::$conexion->safeText($id_oponente)."' LIMIT 1";  
		$result = self::$conexion->query_db($query);  
    
		if(isset($result[0]))
      return true;
		else
      return false;
	}

  static public function obtenerUsuarioBySearch($busqueda, $mi_id_usuario)
	{
    $busqueda = utf8_encode($busqueda);
    //La busqueda no puede ser vacia o tener mas de dos espacios
    if($busqueda==""||$busqueda==" "||$busqueda==null)
      return false;

    $query = "SELECT usu.id_usuario, usu.nombres, usu.apellidos FROM "._DBPFX_."usuarios AS usu WHERE usu.id_usuario<>".self::$conexion->safeText(utf8_encode($mi_id_usuario))." AND (usu.identificacion LIKE '%".self::$conexion->safeText($busqueda)."%' OR usu.codigo LIKE '%".self::$conexion->safeText($busqueda)."%' OR CONCAT(usu.nombres,' ', usu.apellidos) LIKE '%".self::$conexion->safeText($busqueda)."%' OR usu.email LIKE '%".self::$conexion->safeText($busqueda)."%')";  
    $result = self::$conexion->query_db($query);
    
    //return $query;
    if(isset($result))
      return $result;
    else
      return false;
  }

  static public function obtenerOponenteRandom($mi_id_usuario)
  {
    $query = "SELECT id_usuario FROM "._DBPFX_."usuarios WHERE id_usuario<>".self::$conexion->safeText(utf8_encode($mi_id_usuario))." ORDER BY RAND() LIMIT 1";  
    $result = self::$conexion->query_db($query);

    //return $query;
    if(isset($result))
      return $result[0]["id_usuario"];
    else
      return false;
  }
}

class juegoOponente
{
  private $main;
  private $userData = array();

  public function __construct(&$p_main)
	{
    $this->main = $p_main;
    DAOJuegoOponente::$conexion = $this->main->db_data;
  }

  public function buscarIdOponente($id_oponente)
	{
		return DAOJuegoOponente::buscarIdOponente($id_oponente);
  }

  public function obtenerUsuarioBySearch($busqueda, $mi_id_usuario)
	{
    return DAOJuegoOponente::obtenerUsuarioBySearch($busqueda, $mi_id_usuario);
  }

  public function obtenerOponenteRandom($mi_id_usuario)
  {
    return DAOJuegoOponente::obtenerOponenteRandom($mi_id_usuario);
  }
}