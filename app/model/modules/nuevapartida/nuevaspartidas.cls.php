<?php
  /****************************************************************************
  * Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com      *
  *           Juan Suárez, juancsuarezg@correo.udistrital.edu.co  *
  *           © 2017                        *
  ****************************************************************************/

abstract class DAONuevasPartidas{
  
  static public $conexion;

  //Crea una nueva partida con los datos del usuario local
	static public function iniciar_nuevapartida($id_partida, $mi_id)
	{
    $query = 'INSERT INTO partida(id_partida, id_usuario_local, id_usuario_respondiendo) VALUES ('.self::$conexion->safeText(utf8_encode($id_partida)).', '.self::$conexion->safeText(utf8_encode($mi_id)).', '.self::$conexion->safeText(utf8_encode($mi_id)).')';
    return self::$conexion->exec_query_db($query);
	}

  //Llena los dos usuarios que se enfrentarán en una partida nueva
  static public function llenar_usuarios_en_partida($id_partida, $mi_id, $id_oponente)
  {
    $query = 'INSERT INTO usuarios_en_partida(id_partida, id_usuario) VALUES ('.self::$conexion->safeText(utf8_encode($id_partida)).', '.self::$conexion->safeText(utf8_encode($mi_id)).'), ('.self::$conexion->safeText(utf8_encode($id_partida)).', '.self::$conexion->safeText(utf8_encode($id_oponente)).')';
    return self::$conexion->exec_query_db($query);
  }

  //Consulta cual es la id de partida disponible para crear nueva partida
  static public function obtener_idpartida_disponible()
  {
    return self::$conexion->autoID("partida","id_partida");
  }

  //Elimina una partida
  static public function borrar_partida($id_partida)
  {
    $query = 'DELETE FROM partida WHERE id_partida = '.self::$conexion->safeText(utf8_encode($id_partida));
    return self::$conexion->exec_query_db($query);
  }

  //Crea la ronda inicial para una partida
  static public function crear_ronda($id_ronda, $id_partida)
  {
    $query = 'INSERT INTO partida_ronda_usupreg(id_partida_ronda_usupreg, id_partida) VALUES ('.self::$conexion->safeText(utf8_encode($id_ronda)).', '.self::$conexion->safeText(utf8_encode($id_partida)).')';
    return self::$conexion->exec_query_db($query);
  }

  //Retorna la id disponible para poder crear la ronda
  static public function id_ronda_disponible()
  {
    return self::$conexion->autoID("partida_ronda_usupreg","id_partida_ronda_usupreg");
  }
  

}

class nuevasPartidas
{
  private $main;
  private $userData = array();

  public function __construct(&$p_main)
	{
    $this->main = $p_main;
    DAONuevasPartidas::$conexion = $this->main->db_data;
  }

  public function iniciar_nuevapartida($id_partida, $mi_id)
	{
		return DAONuevasPartidas::iniciar_nuevapartida($id_partida, $mi_id);
  }

  public function llenar_usuarios_en_partida($id_partida, $mi_id, $id_oponente)
  {
    return DAONuevasPartidas::llenar_usuarios_en_partida($id_partida, $mi_id, $id_oponente);
  }

  public function obtener_idpartida_disponible()
  {
    return DAONuevasPartidas::obtener_idpartida_disponible();
  }

  public function borrar_partida($id_partida)
  {
    return DAONuevasPartidas::borrar_partida($id_partida);
  }

  public function crear_ronda($id_ronda, $id_partida)
  {
    return DAONuevasPartidas::crear_ronda($id_ronda, $id_partida);
  }

  public function id_ronda_disponible()
  {
    return DAONuevasPartidas::id_ronda_disponible();
  }

}