<?php
  /****************************************************************************
  * Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com      *
  *           Juan Suárez, juancsuarezg@correo.udistrital.edu.co  *
  *           © 2017                        *
  ****************************************************************************/

abstract class DAORuletaInfo{
  
  static public $conexion;

  //Obtiene el usuario local de una partida
	static public function obtener_usuario_local($id_partida)
	{
    $query = "SELECT usu.id_usuario AS 'id', usu.nombres AS 'nombres', usu.apellidos AS 'apellidos' FROM usuarios_en_partida AS usu_par, partida AS par, usuarios AS usu WHERE par.id_partida=".self::$conexion->safeText(utf8_encode($id_partida))." AND usu_par.id_partida=par.id_partida AND usu_par.id_usuario=usu.id_usuario AND par.id_usuario_local=usu.id_usuario LIMIT 1";
    $result = self::$conexion->query_db($query);

    if(isset($result[0]))
      return $result[0];
    else
      return false;
	}

  //Obtiene el usuario visitante de una partida
  static public function obtener_usuario_visitante($id_partida)
  {
    $query = "SELECT usu.id_usuario AS 'id', usu.nombres AS 'nombres', usu.apellidos AS 'apellidos' FROM usuarios_en_partida AS usu_par, partida AS par, usuarios AS usu WHERE par.id_partida=".self::$conexion->safeText(utf8_encode($id_partida))." AND usu_par.id_partida=par.id_partida AND usu_par.id_usuario=usu.id_usuario AND par.id_usuario_local<>usu.id_usuario LIMIT 1";
    $result = self::$conexion->query_db($query);

    if(isset($result[0]))
      return $result[0];
    else
      return false;
  }

  //Obtiene las categorias
  static public function obtener_categorias()
  {
    $query = "SELECT * FROM categoria";
    $result = self::$conexion->query_db($query);

    if(isset($result))
      return $result;
    else
      return false;
  }

  static public function obtener_nombre_categorias()
  {
    $query = "SELECT cat.categoria AS 'nombre' FROM categoria AS cat";
    $result = self::$conexion->query_db($query);

    if(isset($result[0]))
      return $result;
    else
      return false;
  }

  static public function obtener_nombre_avatar_categorias()
  {
    $query = "SELECT cat.nombre_avatar AS 'avatar' FROM categoria AS cat";
    $result = self::$conexion->query_db($query);

    if(isset($result[0]))
      return $result;
    else
      return false;
  }

  //Obtiene las categorias
  static public function obtener_nom_categoria($id_categoria)
  {
    $query = "SELECT cat.categoria FROM categoria AS cat WHERE id_categoria = ".self::$conexion->safeText(utf8_encode($id_categoria))." LIMIT 1";
    $result = self::$conexion->query_db($query);

    if(isset($result[0]))
      return $result[0]["categoria"];
    else
      return false;
  }

  //Obtiene las categorias que aún NO ha ganado un usuario en una partida
  static public function obtener_categorias_sin_ganar($id_ronda, $id_usuario)
  {
    $todas_categ = static::obtener_categorias();
    $ids_categs_ganas = static::convertir_array_ids(static::obtener_categorias_ganadas(self::$conexion->safeText(utf8_encode($id_ronda)), self::$conexion->safeText(utf8_encode($id_usuario))));

    $catgs_faltantes = array();
    if(count($todas_categ[0]) > 0){
      foreach ($todas_categ as $num_cat => $categ){
        if(!in_array($categ['id_categoria'], $ids_categs_ganas)) {
            array_push($catgs_faltantes, $categ);
        }
      }
    }

    //retorna array de arrays con id_categoria, categoria, nombre_avatar
    return $catgs_faltantes;
  }

  static public function convertir_array_ids($ids_categs_ganas){
    
    $array_ids = array();
    if(count($ids_categs_ganas[0]) > 0){
      foreach ($ids_categs_ganas as $key => $id_categ) {
        array_push($array_ids, self::$conexion->safeText(utf8_encode($id_categ['id_categoria'])));
      }
    }
    return $array_ids;
  }

  //Obtiene las categorias ganadas por un usuario en una partida
  static public function obtener_categorias_ganadas($id_ronda, $id_usuario)
  {
    $id_partida = static::get_id_partida(self::$conexion->safeText(utf8_encode($id_ronda)));
    $query = "SELECT trof.id_categoria AS 'id_categoria' FROM trofeo_categoria_ganada AS trof, partida_ronda_usupreg AS par_ron WHERE trof.id_usuario = ".self::$conexion->safeText(utf8_encode($id_usuario))." AND trof.id_partida_ronda_usupreg = par_ron.id_partida_ronda_usupreg AND par_ron.id_partida = ".self::$conexion->safeText($id_partida);
    $result = self::$conexion->query_db($query);

    if(isset($result[0]))
      return $result;
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

  //Obtiene el número de categorias ganadas por un usuario en una partida
  static public function obtener_numero_categ_ganadas($id_ronda, $id_usuario)
  {
    $query = "SELECT COUNT(DISTINCT(trof.id_categoria)) AS 'cats_ganadas' FROM trofeo_categoria_ganada AS trof WHERE trof.id_partida_ronda_usupreg=".self::$conexion->safeText(utf8_encode($id_ronda))." AND trof.id_usuario=".self::$conexion->safeText(utf8_encode($id_usuario))." LIMIT 1";
    $result = self::$conexion->query_db($query);

    if(isset($result[0])){
      if($result[0]['cats_ganadas']==0)
        return "0";
      else
        return $result[0]['cats_ganadas'];
    }else{
      return false;
    }
  }

  //Obtiene el estado de la barra de preguntas correctas del usuario
  static public function obtener_estado_barra($id_partida, $id_usuario)
  {
    $query = "SELECT usu_par.contador_barra AS 'contador_barra' FROM usuarios_en_partida AS usu_par WHERE usu_par.id_partida=".self::$conexion->safeText(utf8_encode($id_partida))." AND usu_par.id_usuario=".self::$conexion->safeText(utf8_encode($id_usuario))." LIMIT 1";
    $result = self::$conexion->query_db($query);

    if(isset($result[0]))
      return $result[0]["contador_barra"];
    else
      return false;
  }

  //Actualiza el número del contador_barra
  static public function set_estado_barra($id_partida, $id_usuario, $numero)
  {
    $query = "UPDATE usuarios_en_partida SET contador_barra = ".self::$conexion->safeText(utf8_encode($numero))." WHERE id_partida = ".self::$conexion->safeText(utf8_encode($id_partida))." AND id_usuario = ".self::$conexion->safeText(utf8_encode($id_usuario));
    return self::$conexion->exec_query_db($query);
  }

  //Retorna el id de una partida, recibiendo la id de una ronda de la tabla partida_ronda
  static public function get_id_partida_by_ronda($id_ronda){

    $query = "SELECT par_ron.id_partida AS 'id_partida' FROM partida_ronda_usupreg AS par_ron WHERE par_ron.id_partida_ronda_usupreg = ".self::$conexion->safeText(utf8_encode($id_ronda))." LIMIT 1";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result[0])))
      return $result[0]['id_partida'];
    else
      return false;
  }

  //Retorna la id del usuario que se encuentra respondiendo una determinada partida
  static public function get_id_usua_respondiendo($id_partida){
    $query = "SELECT par.id_usuario_respondiendo AS 'id' FROM partida AS par WHERE par.id_partida = ".self::$conexion->safeText(utf8_encode($id_partida))." LIMIT 1";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result[0])))
      return $result[0]['id'];
    else
      return false;
  }

  //Retorna el estado de una partida true ó false, mediante el id_partida
  static public function partida_en_proceso($id_partida){
    $query = "SELECT par.fecha_fin AS 'fecha_fin' FROM partida AS par WHERE par.id_partida = ".self::$conexion->safeText(utf8_encode($id_partida))." LIMIT 1";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result[0]))){
      if(is_null($result[0]['fecha_fin'])){
        return true;
      }else{
        return false;
      }
    }
    else
      return false;
  }
  

}

class ruletaInfo
{
  private $main;
  private $userData = array();

  public function __construct(&$p_main)
	{
    $this->main = $p_main;
    DAORuletaInfo::$conexion = $this->main->db_data;
  }

  public function obtener_usuario_local($id_partida)
	{
		return DAORuletaInfo::obtener_usuario_local($id_partida);
  }

  public function obtener_usuario_visitante($id_partida)
  {
    return DAORuletaInfo::obtener_usuario_visitante($id_partida);
  }

  public function obtener_categorias()
  {
    return DAORuletaInfo::obtener_categorias();
  }

  public function obtener_nombre_categorias()
  {
    return DAORuletaInfo::obtener_nombre_categorias();
  }

  public function obtener_nombre_avatar_categorias()
  {
    return DAORuletaInfo::obtener_nombre_avatar_categorias();
  }

  public function obtener_nom_categoria($id_categoria)
  {
    return DAORuletaInfo::obtener_nom_categoria($id_categoria);
  }

  public function obtener_categorias_ganadas($id_partida, $id_usuario)
  {
    return DAORuletaInfo::obtener_categorias_ganadas($id_partida, $id_usuario);
  }

  public function obtener_numero_categ_ganadas($id_partida, $id_usuario)
  {
    return DAORuletaInfo::obtener_numero_categ_ganadas($id_partida, $id_usuario);
  }

  public function obtener_estado_barra($id_partida, $id_usuario)
  {
    return DAORuletaInfo::obtener_estado_barra($id_partida, $id_usuario);
  }

  public function set_estado_barra($id_partida, $id_usuario, $numero)
  {
    return DAORuletaInfo::set_estado_barra($id_partida, $id_usuario, $numero);
  }

  public function get_id_partida_by_ronda($id_ronda)
  {
    return DAORuletaInfo::get_id_partida_by_ronda($id_ronda);
  }

  public function obtener_categorias_sin_ganar($id_ronda, $id_usuario)
  {
    return DAORuletaInfo::obtener_categorias_sin_ganar($id_ronda, $id_usuario);
  }

  public function get_id_usua_respondiendo($id_partida)
  {
    return DAORuletaInfo::get_id_usua_respondiendo($id_partida);
  }

  public function partida_en_proceso($id_partida)
  {
    return DAORuletaInfo::partida_en_proceso($id_partida);
  }

}