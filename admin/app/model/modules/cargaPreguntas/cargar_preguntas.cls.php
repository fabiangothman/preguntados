<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/
	
	abstract class DAOCargar_preguntas
	{
		static public $conexion;
		static private $update = 0;
		static private $insert = 0;
		static private $error = 0;

		static public function cargar_array_csv($array_preguntas)
		{
		    //Limite de 240 segundos para terminar de actualizar la información en bd
			set_time_limit(240);
            foreach ($array_preguntas as $valor => $unaLinea){
            	//Llama funcion en bd que valide si los datos de $line[x] existen ya en la base de datos para actualizarlos o si no existen los inserta
            	$unaLinea[0] = isset($unaLinea[0]) ? $unaLinea[0] : "";/*id_categoria*/
            	$unaLinea[1] = isset($unaLinea[1]) ? $unaLinea[1] : "";/*pregunta*/
            	$unaLinea[2] = isset($unaLinea[2]) ? $unaLinea[2] : "";/*puntaje*/
            	$unaLinea[3] = isset($unaLinea[3]) ? $unaLinea[3] : "";/*respuesta_correcta*/
            	$unaLinea[4] = isset($unaLinea[4]) ? $unaLinea[4] : "";/*respuesta1*/
            	$unaLinea[5] = isset($unaLinea[5]) ? $unaLinea[5] : "";/*respuesta2*/
            	$unaLinea[6] = isset($unaLinea[6]) ? $unaLinea[6] : "";/*respuesta3*/

            	static::cargar_preguntas($unaLinea[0], $unaLinea[1], $unaLinea[2], $unaLinea[3], $unaLinea[4], $unaLinea[5], $unaLinea[6]);
            }


            //static::inicia_carga_recursiva();
		}
		
		static public function cargar_preguntas($id_categoria, $pregunta, $puntaje, $respuesta_correcta, $respuesta1, $respuesta2, $respuesta3)
		{
			//Se deben codificar doble vez por el formato csv
			$id_categoria = $id_categoria;
			$pregunta = $pregunta;
			$puntaje = $puntaje;

			
			//Valida que ninguno de los campos requeridos llegue vacio
			if( !is_null($id_categoria) && !empty($id_categoria) && 
				!is_null($pregunta) && !empty($pregunta) && 
				!is_null($puntaje) && !empty($puntaje) && 
				!is_null($respuesta_correcta) && !empty($respuesta_correcta) && 
				!is_null($respuesta1) && !empty($respuesta1) && 
				!is_null($respuesta2) && !empty($respuesta2) && 
				!is_null($respuesta3) && !empty($respuesta3) ){
				

					if( static::insertar_pregunta($id_categoria, $pregunta, $puntaje, $respuesta_correcta, $respuesta1, $respuesta2, $respuesta3) ){
						self::$insert = self::$insert+1;
						echo "<span class='insert'>".self::$insert.". Se ha insertado la pregunta con sus respuestas.</span>
						<div style='border:1px solid black;'>".$pregunta."</div>
						<br />";
					}else{
						self::$error = self::$error+1;
						echo "<span class='error'>".self::$error.". Hubo un error al tratar de insertar la pregunta.</span>
						<div style='border:1px solid black;'>".$pregunta."</div>
						<br />";
					}

			}else{
				self::$error = self::$error+1;
				echo "<span class='error'>".self::$error.". La pregunta no se ha podido agregar pues hace falta campos dentro del CSV.</span>
						<div style='border:1px solid black;'>".$pregunta."</div>
						<div style='border:1px solid black;'>".$respuesta_correcta."</div>
						<div style='border:1px solid black;'>".$respuesta1."</div>
						<div style='border:1px solid black;'>".$respuesta2."</div>
						<div style='border:1px solid black;'>".$respuesta3."</div>
						<br />";
			}

		}

		//Inserta un nuevo usuario
		static public function insertar_pregunta($id_categoria, $pregunta, $puntaje, $respuesta_correcta, $respuesta1, $respuesta2, $respuesta3)
		{
			//Obtiene id disponible de pregunta para almacenarla
			$id_pregunta = self::$conexion->autoID("pregunta","id_pregunta");

		    $queryPregunta = "INSERT INTO pregunta (id_pregunta, id_categoria, pregunta, puntaje) VALUES (".self::$conexion->safeText(utf8_encode($id_pregunta)).", '".self::$conexion->safeText(utf8_encode($id_categoria))."', '".self::$conexion->safeText(utf8_encode($pregunta))."', '".self::$conexion->safeText(utf8_encode($puntaje))."')";
		    //echo $queryPregunta."<br />";
		    //echo $queryRespuestas."<br />";

		    //Inserta las 4 respuestas de la pregunta
		    $queryRespuestas = "INSERT INTO respuesta (respuesta, correcta, id_pregunta) VALUES 
		    ('".self::$conexion->safeText(utf8_encode($respuesta_correcta))."', 1, ".self::$conexion->safeText(utf8_encode($id_pregunta))."), 
		    ('".self::$conexion->safeText(utf8_encode($respuesta1))."', 0, ".self::$conexion->safeText(utf8_encode($id_pregunta))."), 
		    ('".self::$conexion->safeText(utf8_encode($respuesta2))."', 0, ".self::$conexion->safeText(utf8_encode($id_pregunta))."), 
		    ('".self::$conexion->safeText(utf8_encode($respuesta3))."', 0, ".self::$conexion->safeText(utf8_encode($id_pregunta)).")";
		    
		    $resPregunta = self::$conexion->exec_query_db($queryPregunta);
		    $resRespuestas = self::$conexion->exec_query_db($queryRespuestas);

		    return ($resPregunta && $resRespuestas) ? true : false;
		}

		static public function obtener_preguntas(){
			$query = "SELECT * FROM pregunta";
		    $result = self::$conexion->query_db($query);

		    if(!empty(isset($result[0])))
		      return $result;
		    else
		      return false;
		}
		
	}
	
	class cargar_preguntas
	{
		private $main;
		public $categoriaData = array();
		
		public function __construct(&$p_main)
		{
			$this->main = $p_main;
			DAOCargar_preguntas::$conexion = $this->main->db_data;
			$this->categoriaData = (!empty($this->categoriaData))?$this->categoriaData[0]:$this->categoriaData;
		}

		public function cargar_array_csv($array_preguntas)
		{
			return DAOCargar_preguntas::cargar_array_csv($array_preguntas);
		}

		public function cargar_usuarios($id_rol, $id_grupo, $identificacion, $codigo, $nombres, $apellidos, $email, $clave)
		{
			return DAOCargar_preguntas::cargar_usuarios($id_rol, $id_grupo, $identificacion, $codigo, $nombres, $apellidos, $email, $clave);
		}

		public function obtener_preguntas()
		{
			return DAOCargar_preguntas::obtener_preguntas();
		}

		///////////////////////FUNCIONES GLOBALES////////////////////////////////
		
		public function __isset($name)
	    {
	      return isset($this->categoriaData[$name]);
	    }
			
		public function __set($name, $value)
	    {
				if (isset($this->categoriaData[$name]))
	        $this->categoriaData["old_".$name] = $this->categoriaData[$name];
				$this->categoriaData[$name] = $value;
	    }

	    public function __get($name)
	    {
				if (array_key_exists($name, $this->categoriaData)) {
					return $this->categoriaData[$name];
				}

				$trace = debug_backtrace();
				trigger_error(
					'Undefined property via __get(): ' . $name .
					' in ' . $trace[0]['file'] .
					' on line ' . $trace[0]['line'],
					E_USER_NOTICE);
				return null;
	    }
	}
?>