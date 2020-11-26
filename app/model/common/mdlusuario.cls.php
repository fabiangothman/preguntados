<?php
	/****************************************************
	*	Desarrollado por: Fabián Murillo © 2017	*
	*****************************************************/
	
	abstract class DAOUsuario
	{
		static public $conexion;
		
		
		static public function login($p_email, $p_contrasena)
		{
			$query = "SELECT * FROM "._DBPFX_."usuarios WHERE (email = '".self::$conexion->safeText($p_email)."' OR identificacion = '".self::$conexion->safeText($p_email)."') AND clave = '".md5(self::$conexion->safeText($p_contrasena))."' LIMIT 1";
			return self::$conexion->query_db($query);
		}
		
		static public function getUserById($pUser_id)
		{
			$query = "SELECT * FROM "._DBPFX_."usuarios WHERE id_usuario= ".self::$conexion->safeText($pUser_id);
      return self::$conexion->query_db($query);
		}

		static public function getAllUsers($id_usuario)
		{
			$query = "SELECT * FROM usuarios ";
					if($id_usuario != null || $id_usuario != "" ){
						$query .= 	"WHERE id_usuario != ".$id_usuario;
					}
			//echo $query;
			return self::$conexion->query_db($query);
		}

		static public function editUser($id_usuario, $id_rol, $id_grupo ,$identificacion, $codigo, $nombres, $apellidos, $email, $clave )
		{
			$query = 'UPDATE usuarios set ';

			if($id_rol != null || $id_rol != ""){
				$query .= ' id_rol = '.$id_rol.', ';
			}

			if($id_grupo != null || $id_grupo != ""){
				$query .= ' id_grupo = '.$id_grupo.', ';
			}

			if($identificacion != null || $identificacion != ""){
				$query .= ' identificacion = "'.self::$conexion->safeText($identificacion).'" ';
			}

			if($codigo != null ){
				$query .= ', codigo = "'.self::$conexion->safeText($codigo).'" ';
			}

			if($nombres != null ){
				$query .= ', nombres = "'.self::$conexion->safeText($nombres).'" ';
			}

			if($apellidos != null ){
				$query .= ', apellidos = "'.self::$conexion->safeText($apellidos).'" ';
			}

			if($email != null || $email != ""){
				$query .= ', email = "'.self::$conexion->safeText($email).'" ';
			}

			if($clave != null || $clave != ""){
				$query .= ', clave = "'.md5($clave).'" ';
			}

			$query .= ' WHERE id_usuario = '.$id_usuario;

			//die('Editando usuario: <br>'.$query);

			return self::$conexion->exec_query_db($query);
		}
		
	}
	
	class usuario
	{
		private $main;
		public $userData = array();
		
		public function __construct(&$p_main, $p_method = null, $p_email = null, $p_clave = null, $p_id = null)
		{
			$this->main = $p_main;
			DAOUsuario::$conexion = $this->main->db_data;
			switch ($p_method)
			{
				case "login":
					$this->userData = DAOUsuario::login($p_email, $p_clave);
          			break;
				case "id":
					$this->userData = DAOUsuario::getUserById($p_id);
					break;
				default:
					break;
			}
			$this->userData = (!empty($this->userData))?$this->userData[0]:$this->userData;
		}
			
		
		public function login($p_email, $p_clave)
		{
			return DAOUsuario::login($p_email, $p_clave);
		}
		

		public function getUserById($pUser_id)
		{
			return DAOUsuario::getUserById($pUser_id);
		}

		public function getAllUsers($id_usuario = null)
		{
			return DAOUsuario::getAllUsers($id_usuario);
		}

		public function editUser($id_usuario = null, $id_rol = null, $id_grupo = null, $identificacion = null, $codigo = null, $nombres = null, $apellidos = null, $email = null, $clave = null)
		{
			return DAOUsuario::editUser($id_usuario, $id_rol, $id_grupo ,$identificacion, $codigo, $nombres, $apellidos, $email, $clave );
		}

		///////////////////////FUNCIONES GLOBALES////////////////////////////////
		
		public function __isset($name)
	    {
	      return isset($this->userData[$name]);
	    }
			
		public function __set($name, $value)
	    {
				if (isset($this->userData[$name]))
	        $this->userData["old_".$name] = $this->userData[$name];
				$this->userData[$name] = $value;
	    }

	    public function __get($name)
	    {
				if (array_key_exists($name, $this->userData)) {
					return $this->userData[$name];
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