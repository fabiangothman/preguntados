<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/
	
	abstract class DAOGrupo
	{
		static public $conexion;
		
		static public function getAllGrupo()
		{
			$query = 'SELECT * FROM grupo';
			die('obtener grupos: <br>'.$query);
			return self::$conexion->query_db($query);
		}

		static public function getGrupo($id_grupo)
		{
			$query = 'SELECT * FROM grupo WHERE id_grupo = '.self::$conexion->safeText(utf8_encode($id_grupo));
			die('obtener un grupo: <br>'$query);
			return self::$conexion->query_db($query);
		}

		static public function editGrupo($id_grupo, $grupo)
		{
			$query = 'UPDATE grupo set 
						grupo = "'.self::$conexion->safeText(utf8_encode($grupo)).'" 
					WHERE id_grupo = '.self::$conexion->safeText(utf8_encode($id_grupo));
			die('editar grupo: '.$query);
			return self::$conexion->exec_query_db($query);
		}

		static public function addGrupo($grupo)
		{
			$id_grupo = self::$conexion->autoID("grupo","id_grupo");

			$query = 'INSERT INTO grupo (
							id_grupo, 
							grupo
						) VALUES (
							'.$id_grupo.', 
							"'.self::$conexion->safeText(utf8_encode($grupo)).'"
						)';
			die('Agregando grupo: <br>'.$query);
			return  self::$conexion->exec_query_db($query);
		}
		
	}
	
	class grupo
	{
		private $main;
		public $grupoData = array();
		
		public function __construct(&$p_main)
		{
			$this->main = $p_main;
			$this->grupoData = (!empty($this->grupoData))?$this->grupoData[0]:$this->grupoData;
		}

		public function getAllGrupo()
		{
			return DAOGrupo::getAllGrupo();
		}

		public function editGrupo($id_grupo, $grupo)
		{
			return DAOGrupo::editGrupo($id_grupo,$grupo);
		}

		public function addGrupo($grupo)
		{
			return DAOGrupo::addGrupo($grupo);
		}

		 function getGrupo($id_grupo)
		 {
		 	return DAOGrupo::getGrupo($id_grupo);
		 }
			
		///////////////////////FUNCIONES GLOBALES////////////////////////////////
		
		public function __isset($name)
	    {
	      return isset($this->grupoData[$name]);
	    }
			
		public function __set($name, $value)
	    {
				if (isset($this->grupoData[$name]))
	        $this->grupoData["old_".$name] = $this->grupoData[$name];
				$this->grupoData[$name] = $value;
	    }

	    public function __get($name)
	    {
				if (array_key_exists($name, $this->grupoData)) {
					return $this->grupoData[$name];
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