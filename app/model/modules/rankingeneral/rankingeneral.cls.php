<?php
  /****************************************************************************
  * Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com      *
  *           Juan Suárez, juancsuarezg@correo.udistrital.edu.co  *
  *           © 2017                        *
  ****************************************************************************/

abstract class DAORankinGeneral{
  
  static public $conexion;

  //Crea una nueva partida con los datos del usuario local
	static public function iniciar_nuevapartida($id_partida, $mi_id)
	{
    $query = 'INSERT INTO partida(id_partida, id_usuario_local, id_usuario_respondiendo) VALUES ('.self::$conexion->safeText(utf8_encode($id_partida)).', '.self::$conexion->safeText(utf8_encode($mi_id)).', '.self::$conexion->safeText(utf8_encode($mi_id)).')';
    return self::$conexion->exec_query_db($query);
	}

  //Retorna la id disponible para poder crear la ronda
  static public function id_ronda_disponible()
  {
    return self::$conexion->autoID("partida_ronda_usupreg","id_partida_ronda_usupreg");
  }

  //Obtiene el listado de jugadores
  static public function listado_jugadores()
  {
    $query = "SELECT usu.id_usuario AS 'id_usuario', usu.nombres AS 'nombres', usu.apellidos AS 'apellidos', usu.email AS 'email', (SELECT COUNT(usu_pre.id_usuario_pregunta) FROM usuario_pregunta AS usu_pre, respuesta AS resp WHERE (usu_pre.id_respuesta = resp.id_respuesta) AND (usu_pre.id_usuario = usu.id_usuario) AND (resp.correcta = 1)) AS 'resp_correctas', (SELECT COUNT(usu_par.id_usuarios_en_partida) FROM usuarios_en_partida AS usu_par WHERE usu_par.id_usuario = usu.id_usuario) AS 'partidas_participadas' FROM usuarios AS usu ORDER BY resp_correctas DESC, partidas_participadas ASC, nombres ASC, apellidos ASC";
    $result = self::$conexion->query_db($query);

    if(isset($result[0]))
      return $result;
    else
      return false;
  }
  

}

class rankinGeneral
{
  private $main;
  private $userData = array();

  public function __construct(&$p_main)
	{
    $this->main = $p_main;
    DAORankinGeneral::$conexion = $this->main->db_data;
  }

  public function listado_jugadores()
	{
		return DAORankinGeneral::listado_jugadores();
  }

}