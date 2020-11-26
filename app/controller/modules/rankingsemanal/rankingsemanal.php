<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

	class rankingsemanal extends controller
	{
		protected function index()
		{
			//Se verifica el estado de la sesión
			$this->logged = ($this->main->session->check_session()=="open")?true:false;
			if(!$this->logged){
				$this->redirect(_MSFW_PATH_);
				exit();
			}else{
				//Array con toda la información del usuario
				$this->usuario = $this->main->usuario;
			}

			//Configuración inicial
			$this->title = _MSFW_APP_NAME_." - Home";
			//Carga los mensajes entrantes
			$this->loadError();

			/*Se encarga de obtener la fecha de la semana*/
			date_default_timezone_set('America/Bogota');
			$fecha_lunes = date('d/m/Y', strtotime('monday this week'));
			$fecha_lunes_sql = date('Y-m-d', strtotime('monday this week'));
			$fecha_domingo = date('d/m/Y', strtotime('sunday this week'));
			$fecha_domingo_sql = date('Y-m-d', strtotime('sunday this week'));

			setlocale(LC_ALL,"Spanish_Colombia");
			$date = DateTime::createFromFormat("d/m/Y", $fecha_lunes);
 			$this->inicio_semana = $date->format("d")." DE ".strtoupper(strftime("%B",$date->getTimestamp()));
 			$date = DateTime::createFromFormat("d/m/Y", $fecha_domingo);
 			$this->fin_semana = $date->format("d")." DE ".strtoupper(strftime("%B",$date->getTimestamp()));

 			$this->loadModel("modules/rankinsemanal/rankinsemanal.cls", false);
			$obj_mdlRSemanal = new rankinSemanal($this->main);

			//Obtiene el listado de todos los jugadores y adiciona los campos que se necesitan para construir el ranking
			$tmp_list_jugdrs = $obj_mdlRSemanal->listado_jugadores_semana($fecha_lunes_sql, $fecha_domingo_sql);

			$jugadores = array();
			if(!empty(isset($tmp_list_jugdrs[0]))){

				foreach ($tmp_list_jugdrs as $numero => $jugador){
					$array = array(
						'id_usuario' => $jugador['id_usuario'],
						'nombres' => $jugador['nombres'],
						'apellidos' => $jugador['apellidos'],
						'email' => $jugador['email'],
						'resp_correctas' => $jugador['resp_correctas'],
						'partidas_participadas' => $jugador['partidas_participadas'],
						'foto' => $this->obtener_foto_usuario($jugador['id_usuario'])
					);
					array_push($jugadores, $array);
				}

			}
			$this->listado_jugadores = $jugadores;
			
			
			//Carga todos los archivos requeridos en el view
			$this->addjQueryScript(true, "jquery-1.8.2.min", "jQuery182");
			$this->addScript(true, "rankingsemanal/rankingsemanal");
			$this->addScript(true, "bootstrap/bootstrap");
			$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
			$this->addStyle("modules/rankingsemanal/rankingsemanal", "stylesheet", "screen");
			$this->addInReadyCode("
				MSRankingSemanal.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', $(window).width());
				$(window).resize(function() {
				  MSRankingSemanal.cambiar_responsive($(window).width());
				});
			");
		}

		private function loadError()
		{
			//Se cargan los posibles mensajes a enviar al view, según la variable
			$this->exito = "";
			$this->peligro = "";
			$this->info = "";
			$this->alerta = "";
			switch($this->convertNullToEmpty($this->getArg("mensaje")))
			{
				case "1":
					$this->info = "La sesión expiró!";
					break;
				case "2":
					$this->alerta = "ERROR: Debe ingresar los campos obligatorios.";
					break;
				case "3":
					$this->peligro = "ERROR: Email o contraseña incorrecta.";
					break;
				case "4":
					$this->peligro = "ERROR: La información de inicio de sesión automática no es válida.";
					break;
				case "5":
					$this->exito = "Ha cerrado sesión con éxito.";
					break;
				default:
					$this->info = null;
					break;
			}
		}

		//Busca en la carpeta de profilepic la imagen que tenga el mismo nombre que la id de usuario y la retorna, de lo contrario retorna la default
		//La imagen se retorna con caché por lo que puede que no se actualice inmediatamente
		private function obtener_foto_usuario($id_usuario){
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
		private function obtener_foto_usuario_cache($id_usuario){
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

		public function render()
		{
			return $this->printView("modules/rankingsemanal/rankingsemanal");
		}
	}
?>
