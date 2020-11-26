<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/
	
	abstract class DAOCategoria
	{
		static public $conexion;
		
		static public function generateId()
		{
			return self::$conexion->autoID("categoria","ìd_categoria");
		}

		static public function getCategoriaById($id_categoria)
		{
			$query = "SELECT * FROM categoria 
						WHERE id_categoria = ".self::$conexion->safeText(utf8_encode($id_categoria));
      		return self::$conexion->query_db($query);
		}

		static public function getAllcategoria()
		{
			$query = "SELECT * FROM categoria";
			//echo $query;
			return self::$conexion->query_db($query);
		}

		static public function editCategoria($id_categoria, $categoria)
		{
			$query = 'UPDATE categoria set categoria ="'.self::$conexion->safeText(utf8_encode($categoria)).'" WHERE id_categoria = '.$id_categoria;

			return self::$conexion->exec_query_db($query);
		}

		static public function addCategoria($categoria)
		{
			$id_categoria = self::$conexion->autoID("categoria","id_categoria");

			$query = 'INSERT INTO categoria (
						id_categoria, 
						categoria 
						) VALUES (
						'.$id_categoria.', 
						"'.self::$conexion->safeText(utf8_encode($categoria)).'" 
					)';
			//die('Agregando usuario: <br>'.$query);
			return self::$conexion->exec_query_db($query);
		}

		static public function delCategoria($id_categoria)
		{
			$query = 'DELETE FROM categoria WHERE id_categoria = '.self::$conexion->safeText(utf8_encode($id_categoria));
			return self::$conexion->exec_query_db($query);
		}
		
	}
	
	class categoria
	{
		private $main;
		public $categoriaData = array();
		
		public function __construct(&$p_main)
		{
			$this->main = $p_main;
			DAOCategoria::$conexion = $this->main->db_data;
			$this->categoriaData = (!empty($this->categoriaData))?$this->categoriaData[0]:$this->categoriaData;
		}

		public function generateId()
		{
			return DAOCategoria::generateId();
		}
			
		public function getCategoriaById($id_categoria)
		{
			return DAOCategoria::getCategoriaById($id_categoria);
		}

		public function getAllcategoria()
		{
			return DAOCategoria::getAllcategoria();
		}

		public function editCategoria($id_categoria, $categoria)
		{
			return DAOCategoria::editCategoria($id_categoria, $categoria);
		}

		public function addCategoria($categoria)
		{
			return DAOCategoria::addCategoria($categoria);
		}

		public function delCategoria($id_categoria)
		{
			return DAOCategoria::delCategoria($id_categoria);
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