<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/
	
	abstract class DAOPregunta
	{
		static public $conexion;
		
		static public function generateId()
		{
			return self::$conexion->autoID("pregunta","id_pregunta");
		}

		static public function getPreguntaById($id_pregunta)
		{
			$query = "SELECT * FROM pregunta 
						WHERE id_pregunta = ".self::$conexion->safeText(utf8_encode($id_pregunta));
      		return self::$conexion->query_db($query);
		}

		static public function getAllpregunta()
		{
			$query = "SELECT p.id_pregunta as id_pregunta,
							p.id_categoria as id_categoria, 
							c.categoria as categoria, 
							p.pregunta as pregunta,
							p.puntaje as puntaje
			 			FROM pregunta as p, categoria as c
			 			WHERE p.id_categoria = c.id_categoria";
			//echo $query;
			return self::$conexion->query_db($query);
		}

		static public function editPregunta($id_pregunta, $id_categoria, $pregunta, $puntaje)
		{
			$query = 'UPDATE pregunta set pregunta ="'.self::$conexion->safeText(utf8_encode($pregunta)).'"';
			$puntaje = self::$conexion->safeText(utf8_encode($puntaje));

			if($puntaje != null && $puntaje!= "")
			{
				$query .= ", puntaje = ".$puntaje;
			}

			$query .= ' WHERE id_pregunta = '.self::$conexion->safeText(utf8_encode($id_pregunta));

			//die('Editando usuario: <br>'.$query);

			return self::$conexion->exec_query_db($query);
		}

		static public function addPregunta($id_pregunta, $id_categoria, $pregunta)
		{			
			$query = 'INSERT INTO pregunta (
						id_categoria, 
						id_pregunta, 
						pregunta 
						) VALUES (
						'.self::$conexion->safeText(utf8_encode($id_categoria)).', 
						'.self::$conexion->safeText(utf8_encode($id_pregunta)).', 
						"'.self::$conexion->safeText(utf8_encode($pregunta)).'" 
					)';
			//echo 'Agregando pregunta: <br>'.$query;    //return true;
			return self::$conexion->exec_query_db($query);
		}

		static public function delPregunta($id_pregunta)
		{
			$query = 'DELETE FROM pregunta WHERE id_pregunta = '.self::$conexion->safeText(utf8_encode($id_pregunta));
			//echo $query;
			return self::$conexion->exec_query_db($query);
		}
		
	}
	
	class pregunta
	{
		private $main;
		public $preguntaData = array();
		
		public function __construct(&$p_main)
		{
			$this->main = $p_main;
			DAOPregunta::$conexion = $this->main->db_data;
			$this->preguntaData = (!empty($this->preguntaData))?$this->preguntaData[0]:$this->preguntaData;
		}

		public function generateId()
		{
			return DAOPregunta::generateId();
		}
			
		public function getPreguntaById($id_pregunta)
		{
			return DAOPregunta::getPreguntaById($id_pregunta);
		}

		public function getAllpregunta()
		{
			return DAOPregunta::getAllpregunta();
		}

		public function editPregunta($id_pregunta, $id_categoria, $pregunta = null, $puntaje = null)
		{
			return DAOPregunta::editPregunta($id_pregunta, $id_categoria, $pregunta, $puntaje);
		}

		public function addPregunta($id_pregunta, $id_categoria, $pregunta)
		{
			return DAOPregunta::addPregunta($id_pregunta, $id_categoria, $pregunta);
		}

		public function delPregunta($id_pregunta)
		{
			return DAOPregunta::delPregunta($id_pregunta);
		}

		///////////////////////FUNCIONES GLOBALES////////////////////////////////
		
		public function __isset($name)
	    {
	      return isset($this->preguntaData[$name]);
	    }
			
		public function __set($name, $value)
	    {
				if (isset($this->preguntaData[$name]))
	        $this->preguntaData["old_".$name] = $this->preguntaData[$name];
				$this->preguntaData[$name] = $value;
	    }

	    public function __get($name)
	    {
				if (array_key_exists($name, $this->preguntaData)) {
					return $this->preguntaData[$name];
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