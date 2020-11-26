<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/
	
	abstract class DAORespuesta
	{
		static public $conexion;
		
		static public function generateId()
		{
			return self::$conexion->autoID("respuesta","id_respuesta");
		}

		static public function getRespuestaById($id_respuesta)
		{
			$query = "SELECT * FROM respuesta 
						WHERE id_respuesta = ".self::$conexion->safeText(utf8_encode($id_respuesta));
      		return self::$conexion->query_db($query);
		}

		static public function getRespuestaByPregunta($id_pregunta)
		{
			$query = "SELECT * FROM respuesta 
						WHERE id_pregunta = ".self::$conexion->safeText(utf8_encode($id_pregunta));
      		return self::$conexion->query_db($query);	
		}

		static public function getAllrespuesta()
		{
			$query = "SELECT * FROM respuesta";
			//echo $query;
			return self::$conexion->query_db($query);
		}

		static public function editRespuesta($id_respuesta, $respuesta, $correcta = null)
		{
			$query = 'UPDATE respuesta set respuesta ="'.self::$conexion->safeText(utf8_encode($respuesta)).'"';
			$correcta = self::$conexion->safeText(utf8_encode($correcta));
			if($correcta != null && $correcta!= "")
			{
				$query .= ", correcta = 1";
			}else{
				$query .= ", correcta = 0";
			}

			$query .= ' WHERE id_respuesta = '.self::$conexion->safeText(utf8_encode($id_respuesta));

			//die('Editando usuario: <br>'.$query);

			return self::$conexion->exec_query_db($query);
		}

		static public function addRespuesta($respuesta, $correcta, $id_pregunta)
		{	
			$id_respuesta = self::$conexion->autoID("respuesta", "id_respuesta");
			$correcta = self::$conexion->safeText(utf8_encode($correcta));
			$query = 'INSERT INTO respuesta (
						id_respuesta, 
						respuesta, ';

			if($correcta != null){
				$query .= 'correcta, ';
			}
						
			$query .= 'id_pregunta
						) VALUES (
						'.$id_respuesta.', 
						"'.self::$conexion->safeText(utf8_encode($respuesta)).'", ';
			if($correcta != null){
				$query .= $correcta.', ';
			}
						
			$query .= self::$conexion->safeText(utf8_encode($id_pregunta)).' 
					)';

			//echo 'Agregando respuesta: <br>'.$query;    //return true;
			return self::$conexion->exec_query_db($query);
		}

		static public function delRespuesta($id_respuesta)
		{
			$query = 'DELETE FROM respuesta WHERE id_respuesta = '.self::$conexion->safeText(utf8_encode($id_respuesta));
			return self::$conexion->exec_query_db($query);
		}
		
	}
	
	class respuesta
	{
		private $main;
		public $respuestaData = array();
		
		public function __construct(&$p_main)
		{
			$this->main = $p_main;
			DAORespuesta::$conexion = $this->main->db_data;
			$this->respuestaData = (!empty($this->respuestaData))?$this->respuestaData[0]:$this->respuestaData;
		}

		public function generateId()
		{
			return DAORespuesta::generateId();
		}
			
		public function getRespuestaById($id_respuesta)
		{
			return DAORespuesta::getRespuestaById($id_respuesta);
		}

		public function getRespuestaByPregunta($id_pregunta)
		{
			return DAORespuesta::getRespuestaByPregunta($id_pregunta);
		}

		public function getAllrespuesta()
		{
			return DAORespuesta::getAllrespuesta();
		}

		public function editRespuesta($id_respuesta, $respuesta, $correcta)
		{
			return DAORespuesta::editRespuesta($id_respuesta, $respuesta, $correcta);
		}

		public function addRespuesta($respuesta, $correcta = null, $id_pregunta)
		{
			return DAORespuesta::addRespuesta($respuesta, $correcta, $id_pregunta);
		}

		public function delRespuesta($id_respuesta)
		{
			return DAORespuesta::delRespuesta($id_respuesta);
		}

		///////////////////////FUNCIONES GLOBALES////////////////////////////////
		
		public function __isset($name)
	    {
	      return isset($this->respuestaData[$name]);
	    }
			
		public function __set($name, $value)
	    {
				if (isset($this->respuestaData[$name]))
	        $this->respuestaData["old_".$name] = $this->respuestaData[$name];
				$this->respuestaData[$name] = $value;
	    }

	    public function __get($name)
	    {
				if (array_key_exists($name, $this->respuestaData)) {
					return $this->respuestaData[$name];
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