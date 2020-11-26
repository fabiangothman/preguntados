<?php
  /****************************************************************************
  * Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com      *
  *           Juan Suárez, juancsuarezg@correo.udistrital.edu.co  *
  *           © 2017                        *
  ****************************************************************************/

abstract class DAOPartidas{
  
  static public $conexion;

  //Busca en la carpeta de profilepic la imagen que tenga el mismo nombre que la id de usuario y la retorna, de lo contrario retorna la default
  //La imagen se retorna con caché por lo que puede que no se actualice inmediatamente
  static public function obtener_foto_usuario($id_usuario){
    $id_usuario = self::$conexion->safeText(utf8_encode($id_usuario));
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
    $id_usuario = self::$conexion->safeText(utf8_encode($id_usuario));
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
  static public function historial_partidas($mi_id)
  {
    $mi_id = self::$conexion->safeText(utf8_encode($mi_id));
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

        //Sale del foreach si ya acomula mas de 3 históricos, en el home solo se muestran 3
        if(($valor+1)>=3){
          break;
        }

      }
    }

    return $array_finalizadas;

  }

  //Busca las partidas en las cuales es mi turno
	static public function turnos($mi_id)
	{
    $mi_id = utf8_encode($mi_id);
    //Array que contiene arrays con partidas en que sea mi turno
    $array_mi_turno = array();
    $array_su_turno = array();

    //Tiene las partidas que lleva el usuario sin haber terminado
    $mis_partidas_vigentes = static::mis_partidas_vigentes($mi_id);

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

          //Retorna la id del usuario que se encuentra respondiendo la partida (no importa la ronda)
          $id_usu_respondiendo = static::get_id_usua_respondiendo($partida['id_partida']);
          //echo "id_usu_respondiendo".$id_usu_respondiendo.".<br />";
          if($mi_id==$id_usu_respondiendo){
            array_push($array_mi_turno, $nuevo_array);
          }else if($oponente_data['id']==$id_usu_respondiendo){
            array_push($array_su_turno, $nuevo_array);
          }else{
            echo "-> Error: El usuario que está respondiendo la partida es incorrecto. (id_partida: ".$partida['id_partida'].".)<br />";
          }

        }else{
          echo "-> Error en aplicación, no se crearon rondas para las partidas en curso. (id_partida: ".$partida['id_partida'].".)<br />";
        }

      }

    }

    return array(
      "mi_turno" => $array_mi_turno,
      "su_turno" => $array_su_turno
    );
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

  //Valida si un usuario es local o visitante en una partida
  static public function es_usuario_local($id_usuario, $id_partida){
    $query = "SELECT par.id_partida FROM partida AS par WHERE par.id_partida = ".self::$conexion->safeText(utf8_encode($id_partida))." AND par.id_usuario_local = ".self::$conexion->safeText(utf8_encode($id_usuario))." LIMIT 1";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result[0])))
      return true;
    else
      return false;
  }

  //Obtiene la existencia de respuestas de un usuario en una determinada ronda
  static public function usuario_ha_contestado_ronda($id_usuario, $id_ronda){
    $query = "SELECT usu_pre.id_usuario_pregunta FROM usuario_pregunta AS usu_pre WHERE usu_pre.id_usuario = ".self::$conexion->safeText(utf8_encode($id_usuario))." AND usu_pre.id_partida_ronda_usupreg = ".self::$conexion->safeText(utf8_encode($id_ronda))." LIMIT 1";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result[0])))
      return true;
    else
      return false;
  }

  //Obtiene la existencia de respuestas del usuario local de una partida, demuestra el inicio de una ronda
  static public function local_ha_contestado_ronda($id_ronda){
    $query = "SELECT usu_pre.id_usuario_pregunta AS 'id_usupreg' FROM usuario_pregunta AS usu_pre, partida_ronda_usupreg AS par_ron, partida AS par WHERE usu_pre.id_usuario = par.id_usuario_local AND usu_pre.id_partida_ronda_usupreg = ".self::$conexion->safeText(utf8_encode($id_ronda))." AND usu_pre.id_partida_ronda_usupreg = par_ron.id_partida_ronda_usupreg AND par_ron.id_partida = par.id_partida LIMIT 1";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result[0])))
      return true;
    else
      return false;
  }

  //Obtiene los datos del oponente de una partida
  static public function get_oponente_partida($mi_id, $id_partida){

    $id_oponente_partida = static::get_id_oponente_partida(self::$conexion->safeText(utf8_encode($mi_id)), self::$conexion->safeText(utf8_encode($id_partida)));

    $query = "SELECT usu.id_usuario AS 'id', CONCAT(usu.nombres, ' ', usu.apellidos) AS 'nombre' FROM usuarios AS usu WHERE usu.id_usuario = ".self::$conexion->safeText($id_oponente_partida)." LIMIT 1";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result[0])))
      return $result[0];
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

  //Obtiene el id del oponente de una partida
  static public function get_id_oponente_partida($mi_id, $id_partida){
    $query = "SELECT usu_par.id_usuario AS 'id_oponente' FROM usuarios_en_partida AS usu_par WHERE usu_par.id_partida = ".self::$conexion->safeText(utf8_encode($id_partida))." AND usu_par.id_usuario <> ".self::$conexion->safeText(utf8_encode($mi_id))." LIMIT 1";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result)))
      return $result[0]['id_oponente'];
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


  //Retorna el número de ronda en el que va una id_ronda de partida
  static public function get_numero_ronda($id_ronda){

    $query = "SELECT par_ron.ronda AS 'ronda' FROM partida_ronda_usupreg AS par_ron WHERE par_ron.id_partida_ronda_usupreg = ".self::$conexion->safeText(utf8_encode($id_ronda))." LIMIT 1";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result[0])))
      return $result[0]['ronda'];
    else
      return false;
  }


  //Retorna el número límite de rondas que tiene una partida
  static public function get_limite_rondas_partida($id_partida)
  {
    $query = "SELECT par.tope_rondas AS 'limite_rondas' FROM partida AS par WHERE par.id_partida = ".self::$conexion->safeText(utf8_encode($id_partida))." LIMIT 1";

    $result = self::$conexion->query_db($query);

    if(!empty(isset($result[0])))
      return $result[0]['limite_rondas'];
    else
      return false;
  }

  //Actualiza la fecha de fin de una partida
  static public function set_fecha_fin_partida($id_partida)
  {
    $query = 'UPDATE partida SET fecha_fin = CURRENT_TIMESTAMP WHERE id_partida = '.self::$conexion->safeText(utf8_encode($id_partida));
    return self::$conexion->exec_query_db($query);
  }


  //Realiza la creación de una nueva ronda para una partida, tomando como base la id de ronda anterior
  //Si al crearse esta nueva ronda, la ronda es igual al limite de la partida, entonces añade fecha de finalización (fecha_fin) en la tabla partida
  static public function crear_siguiente_ronda($id_ronda)
  {

    //Obtiene la id de partida de la ronda
    $id_partida = static::get_id_partida(self::$conexion->safeText(utf8_encode($id_ronda)));
    //Obtiene el número de ronda de la partida y le suma uno
    $nueva_ronda_actual = (static::get_numero_ronda(self::$conexion->safeText(utf8_encode($id_ronda))))+1;
    //Obtiene el tope de rondas para la partida
    $limite_rondas = static::get_limite_rondas_partida($id_partida);

    $query = 'INSERT INTO partida_ronda_usupreg(id_partida, ronda) VALUES ('.self::$conexion->safeText($id_partida).', '.self::$conexion->safeText($nueva_ronda_actual).')';
    $resul_ronda = self::$conexion->exec_query_db($query);

    if(($nueva_ronda_actual>=$limite_rondas)&&($resul_ronda)){
      //Finaliza la partida ya que con esa insercción llega al tope de rondas de la partida
      static::set_fecha_fin_partida($id_partida);
    }

    return $resul_ronda;
    
  }

  //Actualiza la id_usuario_respondiendo de una partida
  static public function cambiar_id_usuario_respondiendo($id_partida, $id_nuevo_usr_respondiendo)
  {
    $query = "UPDATE partida SET id_usuario_respondiendo = ".self::$conexion->safeText(utf8_encode($id_nuevo_usr_respondiendo))." WHERE id_partida = ".self::$conexion->safeText(utf8_encode($id_partida));
    return self::$conexion->exec_query_db($query);
  }

}

class partidas
{
  private $main;
  private $userData = array();

  public function __construct(&$p_main)
	{
    $this->main = $p_main;
    DAOPartidas::$conexion = $this->main->db_data;
  }

  public function turnos($mi_id)
	{
		return DAOPartidas::turnos($mi_id);
  }

  public function historial_partidas($mi_id)
  {
    return DAOPartidas::historial_partidas($mi_id);
  }

  public function crear_siguiente_ronda($id_ronda)
  {
    return DAOPartidas::crear_siguiente_ronda($id_ronda);
  }

  //Los siguientes métodos son un vinculo para que los llamados externos puedan realizarase
  public function local_ha_contestado_ronda($id_ronda)
  {
    return DAOPartidas::local_ha_contestado_ronda($id_ronda);
  }

  public function es_usuario_local($id_usuario, $id_partida)
  {
    return DAOPartidas::es_usuario_local($id_usuario, $id_partida);
  }

  public function get_id_partida($id_ronda)
  {
    return DAOPartidas::get_id_partida($id_ronda);
  }

  public function usuario_ha_contestado_ronda($id_usuario, $id_ronda)
  {
    return DAOPartidas::usuario_ha_contestado_ronda($id_usuario, $id_ronda);
  }

  public function cambiar_id_usuario_respondiendo($id_partida, $id_nuevo_usr_respondiendo)
  {
    return DAOPartidas::cambiar_id_usuario_respondiendo($id_partida, $id_nuevo_usr_respondiendo);
  }

  public function get_oponente_partida($id_usuario, $id_partida)
  {
    return DAOPartidas::get_oponente_partida($id_usuario, $id_partida);
  }

  public function set_fecha_fin_partida($id_partida)
  {
    return DAOPartidas::set_fecha_fin_partida($id_partida);
  }

}