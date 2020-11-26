<?php
  /****************************************************************************
  * Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com      *
  *           Juan Suárez, juancsuarezg@correo.udistrital.edu.co  *
  *           © 2017                        *
  ****************************************************************************/

abstract class DAOMPerfil{
  
  static public $conexion;

  //Actualiza los datos de un usuario
  static public function actualizar_datos($id_usuario, $codigo, $nombres, $apellidos, $id_grupo)
  {
    $query = "UPDATE usuarios SET codigo = ".self::$conexion->safeText(utf8_encode($codigo)).", nombres = '".self::$conexion->safeText(utf8_encode($nombres))."', apellidos = '".self::$conexion->safeText(utf8_encode($apellidos))."', id_grupo = ".self::$conexion->safeText(utf8_encode($id_grupo))." WHERE id_usuario = ".self::$conexion->safeText(utf8_encode($id_usuario));
    return self::$conexion->exec_query_db($query);
  }

  //Retorna la id disponible para poder crear la ronda
  static public function id_ronda_disponible()
  {
    return self::$conexion->autoID("partida_ronda_usupreg","id_partida_ronda_usupreg");
  }

  //Obtiene el listado de jugadores
  static public function traer_datos_jugador($id_usuario)
  {
    $query = "SELECT * FROM usuarios AS usu WHERE usu.id_usuario = ".self::$conexion->safeText(utf8_encode($id_usuario))." LIMIT 1";
    $result = self::$conexion->query_db($query);

    if(isset($result[0]))
      return $result[0];
    else
      return false;
  }

  //Obtiene el listado de jugadores
  static public function obtener_grupos()
  {
    $query = "SELECT * FROM grupo";
    $result = self::$conexion->query_db($query);

    if(isset($result[0]))
      return $result;
    else
      return false;
  }
  

}

class mPerfil
{
  private $main;
  private $userData = array();

  public function __construct(&$p_main)
	{
    $this->main = $p_main;
    DAOMPerfil::$conexion = $this->main->db_data;
  }

  public function traer_datos_jugador($id_usuario)
	{
		return DAOMPerfil::traer_datos_jugador($id_usuario);
  }

  public function obtener_grupos()
  {
    return DAOMPerfil::obtener_grupos();
  }

  public function actualizar_datos($id_usuario, $codigo, $nombres, $apellidos, $id_grupo)
  {
    return DAOMPerfil::actualizar_datos($id_usuario, $codigo, $nombres, $apellidos, $id_grupo);
  }

}