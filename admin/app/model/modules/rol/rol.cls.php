<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/
	
	abstract class DAOrol
	{
		static public $conexion;
		
		static public function getAllrol()
		{
			$query = 'SELECT * FROM rol';
			//die('obtener roles: <br>'.$query);
			return self::$conexion->query_db($query);
		}

		static public function getRol($id_rol)
		{
			$query = 'SELECT * FROM rol WHERE id_rol = '.self::$conexion->safeText(utf8_encode($id_rol));
			//die("obetner un rol ".$query);
			return self::$conexion->query_db($query);
		}

		static public function editRol($id_rol, $nombre)
		{
			$query = 'UPDATE rol set 
						nombre = "'.self::$conexion->safeText(utf8_encode($nombre)).'" 
					WHERE id_rol = '.self::$conexion->safeText(utf8_encode($id_rol));
			//die('editar rol: '.$query);
			return self::$conexion->exec_query_db($query);
		}

		static public function addRol($nombre)
		{
			$id_rol = self::$conexion->autoID("rol","id_rol");

			$query = 'INSERT INTO rol (
							id_rol, 
							nombre
						) VALUES (
							'.$id_rol.', 
							"'.self::$conexion->safeText(utf8_encode($nombre)).'"
						)';
			//die('Agregando rol: <br>'.$query);
			return  self::$conexion->exec_query_db($query);
		}
		
	}
	
	class rol
	{
		private $main;
		public $rolData = array();
		
		public function __construct(&$p_main)
		{
			$this->main = $p_main;
			DAOrol::$conexion = $this->main->db_data;
			$this->rolData = (!empty($this->rolData))?$this->rolData[0]:$this->rolData;
		}

		public function getAllrol()
		{
			return DAOrol::getAllrol();
		}

		function getRol($id_rol)
		{
			return DAOrol::getRol($id_rol);
		}

		public function editRol($id_rol, $nombre)
		{
			return DAOrol::editRol($id_rol, $nombre);
		}

		public function addRol($nombre)
		{
			return DAOrol::addrol($nombre);
		}
			
		///////////////////////FUNCIONES GLOBALES////////////////////////////////
		
		public function __isset($name)
	    {
	      return isset($this->rolData[$name]);
	    }
			
		public function __set($name, $value)
	    {
				if (isset($this->rolData[$name]))
	        $this->rolData["old_".$name] = $this->rolData[$name];
				$this->rolData[$name] = $value;
	    }

	    public function __get($name)
	    {
				if (array_key_exists($name, $this->rolData)) {
					return $this->rolData[$name];
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