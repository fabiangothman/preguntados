<?php
  /****************************************************************************
  * Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com      *
  *           Juan Suárez, juancsuarezg@correo.udistrital.edu.co  *
  *           © 2017                        *
  ****************************************************************************/

abstract class DAOPreguntas{
  
  static public $conexion;

  //Consulta cual es la id de pregunta disponible para crear nuevo regitro de pregunta
  static public function obtener_idpregunta_disponible()
  {
    return self::$conexion->autoID("pregunta","id_pregunta");
  }

  //Retorna una pregunta aleatoria
  static public function obtener_preguntaAleatoria($id_categoria)
  {
    $query = "SELECT * FROM "._DBPFX_."pregunta AS preg WHERE preg.id_categoria=".self::$conexion->safeText(utf8_encode($id_categoria))." ORDER BY RAND() LIMIT 1";
    $result = self::$conexion->query_db($query);

    //return $query;
    if(isset($result[0]))
      return $result[0];
    else
      return false;
  }

  //Retorna las respuestas a una pregunta
  static public function obtener_respuestas_desordenadas($id_pregunta)
  {
    $query = "SELECT * FROM "._DBPFX_."respuesta WHERE id_pregunta=".self::$conexion->safeText(utf8_encode($id_pregunta))." ORDER BY RAND() LIMIT 4";  
    $result = self::$conexion->query_db($query);

    //return $query;
    if(isset($result))
      return $result;
    else
      return false;
  }

  //Valida la respuesta que se dió a una pregunta
  static public function validar_respuesta($id_pregunta, $id_respuesta)
  {
    $query = "SELECT resp.correcta AS 'correcta' FROM "._DBPFX_."respuesta AS resp WHERE resp.id_pregunta=".self::$conexion->safeText(utf8_encode($id_pregunta))." AND resp.id_respuesta=".self::$conexion->safeText(utf8_encode($id_respuesta))." LIMIT 1";  
    $result = self::$conexion->query_db($query);

    //return $query;
    if(isset($result[0])){
      if($result[0]["correcta"])
        return "verdadera";
      else
        return "falsa";
    }else{
      return false;
    }
  }

  //Guarda un nuevo registro para usuario_pregunta
  static public function guardar_usuario_pregunta($id_usuario, $id_pregunta, $id_respuesta, $id_partida_ronda)
  {
    //En dado caso que el tiempo para responder se acabe, llegará como vacio
    if($id_respuesta=="")
      $id_respuesta='NULL';
    
    $query = 'INSERT INTO usuario_pregunta(id_usuario, id_pregunta, id_respuesta, id_partida_ronda_usupreg) VALUES ('.self::$conexion->safeText(utf8_encode($id_usuario)).', '.self::$conexion->safeText(utf8_encode($id_pregunta)).', '.self::$conexion->safeText(utf8_encode($id_respuesta)).', '.self::$conexion->safeText(utf8_encode($id_partida_ronda)).')';
    return self::$conexion->exec_query_db($query);
  }

  //Retorna la id_categoria a la que pertenece la pregunta
  static public function get_id_nueva_categ_ganada($id_pregunta)
  {
    $query = "SELECT cat.id_categoria AS 'id_categoria' FROM categoria AS cat, pregunta AS pre WHERE cat.id_categoria = pre.id_categoria AND pre.id_pregunta = ".self::$conexion->safeText(utf8_encode($id_pregunta))." LIMIT 1";
    $result = self::$conexion->query_db($query);

    if(isset($result[0]))
      return $result[0]['id_categoria'];
    else
      return false;
  }

  //Retorna el id de una partida, recibiendo la id de una ronda de la tabla partida_ronda
  static public function get_id_partida($id_ronda){

    $query = "SELECT par_ron.id_partida AS 'id_partida' FROM partida_ronda_usupreg AS par_ron WHERE par_ron.id_partida_ronda_usupreg = ".self::$conexion->safeText(utf8_encode($id_ronda))." LIMIT 1";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result[0])))
      return $result[0]['id_partida'];
    else
      return false;
  }

  //Retorna la id_categoria a la que pertenece la pregunta
  static public function almacenar_nueva_categoria_ganada($id_nueva_categ_ganada, $id_usuario, $id_ronda)
  {
    //Se valida que no exista ganada ya, esta categoria para la partida actual del usuario
    $id_partida = static::get_id_partida(self::$conexion->safeText(utf8_encode($id_ronda)));

    $queryExiste = "SELECT tro_cat.id_categoria AS 'id_categoria' FROM trofeo_categoria_ganada AS tro_cat, partida_ronda_usupreg AS par_ron WHERE tro_cat.id_partida_ronda_usupreg = par_ron.id_partida_ronda_usupreg AND par_ron.id_partida = ".self::$conexion->safeText($id_partida)." AND tro_cat.id_usuario = ".self::$conexion->safeText(utf8_encode($id_usuario))." AND tro_cat.id_categoria = ".self::$conexion->safeText(utf8_encode($id_nueva_categ_ganada));
    $resultExiste = self::$conexion->query_db($queryExiste);

    if(!empty(isset($resultExiste[0]))){
      return false;
    }
    else{
      $query = "INSERT INTO trofeo_categoria_ganada(id_categoria, id_usuario, id_partida_ronda_usupreg) VALUES (".self::$conexion->safeText(utf8_encode($id_nueva_categ_ganada)).", ".self::$conexion->safeText(utf8_encode($id_usuario)).", ".self::$conexion->safeText(utf8_encode($id_ronda)).")";
      return self::$conexion->exec_query_db($query);

    }
    
  }

}

class preguntas
{
  private $main;
  private $userData = array();

  public function __construct(&$p_main)
	{
    $this->main = $p_main;
    DAOPreguntas::$conexion = $this->main->db_data;
  }

  public function obtener_idpregunta_disponible()
  {
    return DAOPreguntas::obtener_idpregunta_disponible();
  }

  public function obtener_preguntaAleatoria($id_categoria)
  {
    return DAOPreguntas::obtener_preguntaAleatoria($id_categoria);
  }

  public function obtener_respuestas_desordenadas($id_pregunta)
  {
    return DAOPreguntas::obtener_respuestas_desordenadas($id_pregunta);
  }

  public function validar_respuesta($id_pregunta, $id_respuesta)
  {
    return DAOPreguntas::validar_respuesta($id_pregunta, $id_respuesta);
  }

  public function guardar_usuario_pregunta($id_usuario, $id_pregunta, $id_respuesta, $id_partida_ronda)
  {
    return DAOPreguntas::guardar_usuario_pregunta($id_usuario, $id_pregunta, $id_respuesta, $id_partida_ronda);
  }

  public function get_id_nueva_categ_ganada($id_pregunta)
  {
    return DAOPreguntas::get_id_nueva_categ_ganada($id_pregunta);
  }

  public function almacenar_nueva_categoria_ganada($id_nueva_categ_ganada, $id_usuario, $id_ronda)
  {
    return DAOPreguntas::almacenar_nueva_categoria_ganada($id_nueva_categ_ganada, $id_usuario, $id_ronda);
  }

}