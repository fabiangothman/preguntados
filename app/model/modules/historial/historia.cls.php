<?php
  /****************************************************************************
  * Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com      *
  *           Juan Suárez, juancsuarezg@correo.udistrital.edu.co  *
  *           © 2017                        *
  ****************************************************************************/

abstract class DAOHistoria{
  
  static public $conexion;


  //Busca en la carpeta de profilepic la imagen que tenga el mismo nombre que la id de usuario y la retorna, de lo contrario retorna la default
  //La imagen se retorna con caché por lo que puede que no se actualice inmediatamente
  static public function obtener_foto_usuario($id_usuario){
    $id_usuario = utf8_encode($id_usuario);
    $existe_foto_usr = glob("app/view/default/_img/modules/perfil/profilepics/".$id_usuario.".*");
    
    if(!empty(isset($existe_foto_usr[0]))){
      $ext = pathinfo($existe_foto_usr[0], PATHINFO_EXTENSION);
      if(($ext=="png")||($ext=="jpg")||($ext=="gif"))
        return $id_usuario.".".$ext;
      else
        return "default.png";
    }else{
      return "default.png";
    }
  }

  //Busca en la carpeta de profilepic la imagen que tenga el mismo nombre que la id de usuario y la retorna, de lo contrario retorna la default
  //La imagen se retorna sin caché para que se actualice inmediatamente
  static public function obtener_foto_usuario_cache($id_usuario){
    $id_usuario = utf8_encode($id_usuario);
    $existe_foto_usr = glob("app/view/default/_img/modules/perfil/profilepics/".$id_usuario.".*");
    
    if(!empty(isset($existe_foto_usr[0]))){
      $ext = pathinfo($existe_foto_usr[0], PATHINFO_EXTENSION);
      if(($ext=="png")||($ext=="jpg")||($ext=="gif"))
        return $id_usuario.".".$ext."?".time();
      else
        return "default.png?".time();
    }else{
      return "default.png?".time();
    }
  }


  //Busca las partidas en las cuales es mi turno
  static public function obtener_partidas_finalizadas($mi_id)
  {
    $mi_id = utf8_encode($mi_id);
    $array_finalizadas = array();

    //Tiene las partidas que ha terminado el usuario
    $mis_partidas_finalizadas = static::mis_partidas_finalizadas($mi_id);

    if($mis_partidas_finalizadas){

      foreach ($mis_partidas_finalizadas as $valor => $partida){

        //Obtiene los datos de la última ronda del usuario
        $ult_ronda = static::ultim_ronda_partida($partida['id_partida']);

        if($ult_ronda){

          //Obtiene los datos del oponente en la partida actual
          $oponente_data = static::get_oponente_partida($mi_id, $partida['id_partida']);

          //Resuleve cuál id_usuario es local y cuál visitante
          if(static::es_usuario_local($mi_id, $partida['id_partida'])){
            $id_usu_local = $mi_id;
            $id_usu_visitan = $oponente_data['id'];
          }else{
            $id_usu_local = $oponente_data['id'];
            $id_usu_visitan = $mi_id;
          }

          $nuevo_array = array(
            "foto_oponente" => static::obtener_foto_usuario($oponente_data['id']),
            "nombre_oponente" => $oponente_data['nombre'],
            "ronda" => $ult_ronda['ronda'],
            "fecha_inicio" => $partida['fecha_inicio'],
            "fecha_fin" => $partida['fecha_fin'],
            "categorias_local" => static::get_cant_categorias_ganadas($id_usu_local, $partida['id_partida']),
            "categorias_visitante" => static::get_cant_categorias_ganadas($id_usu_visitan, $partida['id_partida']),
            "link_continuar" => _MSFW_PATH_."modules/ruleta/ruleta/id_ronda/".$ult_ronda['id_ronda']
          );
          array_push($array_finalizadas, $nuevo_array);
        }else{
          echo "-> Error en aplicación, no se crearon rondas para las partidas finalizadas. (id_partida: ".$partida['id_partida'].".)<br />";
        }

      }
    }

    return $array_finalizadas;

  }


  //Busca las partidas en las cuales es mi turno
  static public function obtener_partidas_activas($mi_id)
  {
    $mi_id = utf8_encode($mi_id);
    //Array que contiene arrays con partidas en que sea mi turno
    $array_mi_turno = array();
    $array_su_turno = array();

    //Tiene las partidas que lleva el usuario sin haber terminado
    $mis_partidas_vigentes = static::mis_partidas_vigentes($mi_id);
    $array_retorno = array();

    if($mis_partidas_vigentes){

      foreach ($mis_partidas_vigentes as $valor => $partida){

        //Obtiene los datos de la última ronda del usuario
        $ult_ronda = static::ultim_ronda_partida($partida['id_partida']);

        if($ult_ronda){

          //Obtiene los datos del oponente en la partida actual
          $oponente_data = static::get_oponente_partida($mi_id, $partida['id_partida']);

          //Resuleve cuál id_usuario es local y cuál visitante
          if(static::es_usuario_local($mi_id, $partida['id_partida'])){
            $id_usu_local = $mi_id;
            $id_usu_visitan = $oponente_data['id'];
          }else{
            $id_usu_local = $oponente_data['id'];
            $id_usu_visitan = $mi_id;
          }

          $nuevo_array = array(
            "foto_oponente" => static::obtener_foto_usuario($oponente_data['id']),
            "nombre_oponente" => $oponente_data['nombre'],
            "ronda" => $ult_ronda['ronda'],
            "fecha_inicio" => $partida['fecha_inicio'],
            "categorias_local" => static::get_cant_categorias_ganadas($id_usu_local, $partida['id_partida']),
            "categorias_visitante" => static::get_cant_categorias_ganadas($id_usu_visitan, $partida['id_partida']),
            "link_continuar" => _MSFW_PATH_."modules/ruleta/ruleta/id_ronda/".$ult_ronda['id_ronda']
          );

          array_push($array_retorno, $nuevo_array);

        }else{
          echo "-> Error en aplicación, no se crearon rondas para las partidas en curso. (id_partida: ".$partida['id_partida'].".)<br />";
        }

      }

    }

    return $array_retorno;
  }


  //Obtiene datos de todas las partidas que tiene el usuario
  static public function mis_partidas_vigentes($mi_id)
  {
    $query = "SELECT usu_par.id_partida AS 'id_partida', par.fecha_inicio AS 'fecha_inicio' FROM usuarios_en_partida AS usu_par, partida AS par WHERE usu_par.id_partida = par.id_partida AND usu_par.id_usuario = ".self::$conexion->safeText(utf8_encode($mi_id))." AND par.fecha_fin IS NULL ORDER BY par.fecha_inicio DESC";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result)))
      return $result;
    else
      return false;
  }


  //Obtiene la id de la última ronda de una partida
  static public function ultim_ronda_partida($id_partida)
  {
    $query = "SELECT par_rond.id_partida_ronda_usupreg AS 'id_ronda', MAX(par_rond.ronda) AS 'ronda' FROM partida_ronda_usupreg AS par_rond WHERE par_rond.id_partida = ".self::$conexion->safeText(utf8_encode($id_partida))." GROUP BY par_rond.id_partida_ronda_usupreg ORDER BY ronda DESC LIMIT 1";
    $result = self::$conexion->query_db($query);

    if(!empty(isset($result[0])))
      return $result[0];
    else
      return false;
  }


  //Obtiene los datos del oponente de una partida
  static public function get_oponente_partida($mi_id, $id_partida){

    $id_oponente_partida = static::get_id_oponente_partida(utf8_encode($mi_id), utf8_encode($id_partida));

    $query = "SELECT usu.id_usuario AS 'id', CONCAT(usu.nombres, ' ', usu.apellidos) AS 'nombre' FROM usuarios AS usu WHERE usu.id_usuario = ".self::$conexion->safeText($id_oponente_partida)." LIMIT 1";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result[0])))
      return $result[0];
    else
      return false;
  }


  //Obtiene el id del oponente de una partida
  static public function get_id_oponente_partida($mi_id, $id_partida){
    $query = "SELECT usu_par.id_usuario AS 'id_oponente' FROM usuarios_en_partida AS usu_par WHERE usu_par.id_partida = ".self::$conexion->safeText(utf8_encode($id_partida))." AND usu_par.id_usuario <> ".self::$conexion->safeText(utf8_encode($mi_id))." LIMIT 1";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result)))
      return $result[0]['id_oponente'];
    else
      return false;
  }


  //Valida si un usuario es local o visitante en una partida
  static public function es_usuario_local($id_usuario, $id_partida){
    $query = "SELECT par.id_partida FROM partida AS par WHERE par.id_partida = ".self::$conexion->safeText(utf8_encode($id_partida))." AND par.id_usuario_local = ".self::$conexion->safeText(utf8_encode($id_usuario))." LIMIT 1";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result[0])))
      return true;
    else
      return false;
  }


  //Retorna la cantidad de categorias ganadas por un usuario en una partida
  static public function get_cant_categorias_ganadas($id_usuario, $id_partida)
  {
    $query = "SELECT COUNT(DISTINCT(tro_cat.id_categoria)) AS 'cantidad' FROM trofeo_categoria_ganada AS tro_cat, partida_ronda_usupreg AS par_ron WHERE par_ron.id_partida_ronda_usupreg = tro_cat.id_partida_ronda_usupreg AND par_ron.id_partida = ".self::$conexion->safeText(utf8_encode($id_partida))." AND tro_cat.id_usuario = ".self::$conexion->safeText(utf8_encode($id_usuario))." LIMIT 1";

    //echo $query."<br /><br />";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result[0])))
      return $result[0]['cantidad'];
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


  //Obtiene datos de todas las partidas que tiene el usuario
  static public function mis_partidas_finalizadas($mi_id)
  {
    $query = "SELECT par.id_partida AS 'id_partida', par.fecha_inicio AS 'fecha_inicio', par.fecha_fin AS 'fecha_fin' FROM usuarios_en_partida AS usu_par, partida AS par WHERE usu_par.id_partida = par.id_partida AND usu_par.id_usuario = ".self::$conexion->safeText(utf8_encode($mi_id))." AND par.fecha_fin IS NOT NULL ORDER BY par.fecha_fin DESC";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result)))
      return $result;
    else
      return false;
  }
  

}

class historia
{
  private $main;
  private $userData = array();

  public function __construct(&$p_main)
	{
    $this->main = $p_main;
    DAOHistoria::$conexion = $this->main->db_data;
  }

  public function obtener_partidas_activas($mi_id)
	{
		return DAOHistoria::obtener_partidas_activas($mi_id);
  }

  public function obtener_partidas_finalizadas($mi_id)
  {
    return DAOHistoria::obtener_partidas_finalizadas($mi_id);
  }

}