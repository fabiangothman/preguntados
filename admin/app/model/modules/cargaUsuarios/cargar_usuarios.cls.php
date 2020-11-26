<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/
	
	abstract class DAOCargar_usuarios
	{
		static public $conexion;
		static private $update = 0;
		static private $insert = 0;
		static private $error = 0;

		static public function cargar_array_csv($array_usuarios)
		{
			print_r($array_usuarios);
		    echo "<br /><br />";

		    //Limite de 240 segundos para terminar de actualizar la información en bd
			set_time_limit(240);
            foreach ($array_usuarios as $valor => $unaLinea){
            	//Llama funcion en bd que valide si los datos de $line[x] existen ya en la base de datos para actualizarlos o si no existen los inserta
            	$unaLinea[0] = isset($unaLinea[0]) ? $unaLinea[0] : "";
            	$unaLinea[1] = isset($unaLinea[1]) ? $unaLinea[1] : "";
            	$unaLinea[2] = isset($unaLinea[2]) ? $unaLinea[2] : "";
            	$unaLinea[3] = isset($unaLinea[3]) ? $unaLinea[3] : "";
            	$unaLinea[4] = isset($unaLinea[4]) ? $unaLinea[4] : "";
            	$unaLinea[5] = isset($unaLinea[5]) ? $unaLinea[5] : "";
            	$unaLinea[6] = isset($unaLinea[6]) ? $unaLinea[6] : "";
            	$unaLinea[7] = isset($unaLinea[7]) ? $unaLinea[7] : "";
            	static::cargar_usuarios($unaLinea[0], $unaLinea[1], $unaLinea[2], $unaLinea[3], $unaLinea[4], $unaLinea[5], $unaLinea[6], $unaLinea[7]);
            }


            //static::inicia_carga_recursiva();
		}
		
		static public function cargar_usuarios($id_rol, $id_grupo, $identificacion, $codigo, $nombres, $apellidos, $email = NULL, $clave)
		{
			//Se deben codificar doble vez por el formato csv
			$id_rol = utf8_encode($id_rol);
			$id_grupo = utf8_encode($id_grupo);
			$identificacion = utf8_encode($identificacion);
			$codigo = utf8_encode($codigo);
			$nombres = utf8_encode($nombres);
			$apellidos = utf8_encode($apellidos);
			$email = utf8_encode($email);
			$clave = utf8_encode($clave);

			
			//Valida que ninguno de los campos requeridos llegue vacio
			if( !is_null($id_rol) && !empty($id_rol) && !is_null($id_grupo) && !empty($id_grupo) && !is_null($identificacion) && !empty($identificacion) && !is_null($clave) && !empty($clave) ){
				
				//Valida que el usuario existe ya sea por su identificacion o por su email
				//$usr_existe = static::valida_existencia_usr_por_ambos($identificacion, $email);
				$usr_existe = static::valida_existencia_usr_por_identificacion($identificacion);
				//$usr_existe = static::valida_existencia_usr_por_email($email);

				if($usr_existe=="identificacion"){

					if(static::actualizar_usr($id_rol, $id_grupo, $identificacion, $codigo, $nombres, $apellidos, $email, $clave)){
						self::$update = self::$update+1;
						echo "<span class='update'>".self::$update.". Se ha actualizado el dato de identificacion ".$identificacion.".</span><br />";
					}else{
						self::$error = self::$error+1;
						echo "<span class='error'>".self::$error.". Hubo un error al tratar de actualizar el dato de identificacion ".$identificacion.".</span><br />";
					}
					

				}else if($usr_existe=="email"){

					if(static::actualizar_usr($id_rol, $id_grupo, $identificacion, $codigo, $nombres, $apellidos, $email, $clave)){
						self::$update = self::$update+1;
						echo "<span class='update'>".self::$update.". Se ha actualizado el dato de email ".$email.".</span><br />";
					}else{
						self::$error = self::$error+1;
						echo "<span class='error'>".self::$error.". Hubo un error al tratar de actualizar el dato de email ".$email.".</span><br />";
					}

				}else{

					if(static::insertar_usr($id_rol, $id_grupo, $identificacion, $codigo, $nombres, $apellidos, $email, $clave)){
						self::$insert = self::$insert+1;
						echo "<span class='insert'>".self::$insert.". Se ha insertado el dato de identificacion ".$identificacion.".</span><br />";
					}else{
						self::$error = self::$error+1;
						echo "<span class='error'>".self::$error.". Hubo un error al tratar de insertar el dato de identificacion ".$identificacion.".</span><br />";
					}

				}

			}else{
				self::$error = self::$error+1;
				echo "<span class='error'>".self::$error.". El dato ".((is_null($identificacion)||empty($identificacion)) ? "de identificacion desconocida" : "de identificacion ".$identificacion)." tiene campos erróneos en el CSV.</span><br />";
			}

		}


		//Valida la existencia de un usuario buscandolo por identificacion y email, por ambos
		static public function valida_existencia_usr_por_ambos($identificacion, $email){
			$query = "SELECT IF(EXISTS(SELECT 1 FROM usuarios WHERE identificacion = '".self::$conexion->safeText(utf8_encode($identificacion))."' LIMIT 1),'identificacion', IF(EXISTS(SELECT 1 FROM usuarios WHERE email = '".self::$conexion->safeText(utf8_encode($email))."' LIMIT 1),'email',false)) AS result";
		    $result = self::$conexion->query_db($query);

		    if($result[0])
		      return $result[0]['result'];
		    else
		      return false;
		}


		//Valida la existencia de un usuario buscandolo por identificacion
		static public function valida_existencia_usr_por_identificacion($identificacion){
			$query = "SELECT IF(EXISTS(SELECT 1 FROM usuarios WHERE identificacion = '".self::$conexion->safeText(utf8_encode($identificacion))."' LIMIT 1),'identificacion', false) AS result";
		    $result = self::$conexion->query_db($query);

		    if($result[0])
		      return $result[0]['result'];
		    else
		      return false;
		}

		//Valida la existencia de un usuario buscandolo por email
		static public function valida_existencia_usr_por_email($email){
			$query = "SELECT IF(EXISTS(SELECT 1 FROM usuarios WHERE email = '".self::$conexion->safeText(utf8_encode($email))."' LIMIT 1),'email', false) AS result";
		    $result = self::$conexion->query_db($query);

		    if($result[0])
		      return $result[0]['result'];
		    else
		      return false;
		}

		//Actualiza los datos de un usuario
		static public function actualizar_usr($id_rol, $id_grupo, $identificacion, $codigo, $nombres, $apellidos, $email, $clave)
		{
			$email = (empty($email) || is_null($email)) ? 'NULL' : $email;
			$query = "UPDATE usuarios SET id_rol = ".self::$conexion->safeText(utf8_encode($id_rol)).", id_grupo = ".self::$conexion->safeText(utf8_encode($id_grupo)).", identificacion = '".self::$conexion->safeText(utf8_encode($identificacion))."', codigo = '".self::$conexion->safeText(utf8_encode($codigo))."', nombres = '".self::$conexion->safeText(utf8_encode($nombres))."', apellidos = '".self::$conexion->safeText(utf8_encode($apellidos))."', email = '".self::$conexion->safeText(utf8_encode($email))."', clave = '".self::$conexion->safeText(utf8_encode(md5($clave)))."' WHERE identificacion = ".self::$conexion->safeText(utf8_encode($identificacion));
			//echo "<br /><br />".$query."<br />";
			return self::$conexion->exec_query_db($query);
		}

		//Inserta un nuevo usuario
		static public function insertar_usr($id_rol, $id_grupo, $identificacion, $codigo, $nombres, $apellidos, $email, $clave)
		{
		    $query = "INSERT INTO usuarios(id_rol, id_grupo, identificacion, codigo, nombres, apellidos, email, clave) VALUES (".self::$conexion->safeText(utf8_encode($id_rol)).", ".self::$conexion->safeText(utf8_encode($id_grupo)).", '".self::$conexion->safeText(utf8_encode($identificacion))."', '".self::$conexion->safeText(utf8_encode($codigo))."', '".self::$conexion->safeText(utf8_encode($nombres))."', '".self::$conexion->safeText(utf8_encode($apellidos))."', '".self::$conexion->safeText(utf8_encode($email))."', '".self::$conexion->safeText(utf8_encode(md5($clave)))."')";
		    //echo $query."<br />";
		    return self::$conexion->exec_query_db($query);
		}

		static public function obtener_usuarios(){
			$query = "SELECT * FROM usuarios";
		    $result = self::$conexion->query_db($query);

		    if(!empty(isset($result[0])))
		      return $result;
		    else
		      return false;
		}
		
	}
	
	class cargar_usuarios
	{
		private $main;
		public $categoriaData = array();
		
		public function __construct(&$p_main)
		{
			$this->main = $p_main;
			DAOCargar_usuarios::$conexion = $this->main->db_data;
			$this->categoriaData = (!empty($this->categoriaData))?$this->categoriaData[0]:$this->categoriaData;
		}

		public function cargar_array_csv($array_usuarios)
		{
			return DAOCargar_usuarios::cargar_array_csv($array_usuarios);
		}

		public function cargar_usuarios($id_rol, $id_grupo, $identificacion, $codigo, $nombres, $apellidos, $email, $clave)
		{
			return DAOCargar_usuarios::cargar_usuarios($id_rol, $id_grupo, $identificacion, $codigo, $nombres, $apellidos, $email, $clave);
		}

		public function obtener_usuarios()
		{
			return DAOCargar_usuarios::obtener_usuarios();
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