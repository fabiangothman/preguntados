<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

	class seleccionCategoria extends controller
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
			$this->title = _MSFW_APP_NAME_.utf8_encode(" - Selección de categoría");
			//Carga los mensajes entrantes
			$this->loadError();

			//Obtiene la id_ronda que se juega actualmente
			$id_ronda = $this->convertNullToEmpty($this->getArg("id_ronda"));
			if(empty($id_ronda)){
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/9");
				exit();
			}

			$this->loadModel("modules/ruleta/ruletainfo.cls", false);
			$obj_mdlruleta = new ruletaInfo($this->main);
			//Obtiene la id_partida de la ronda actual
			$id_partida = $obj_mdlruleta->get_id_partida_by_ronda($id_ronda);
			if(empty($id_partida) || !($id_partida)){
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/4");
				exit();
			}

			//Valida permisos de acceso a la ruleta para los usuarios
			//Está restringido si NO es mi turno o si YA finalizó la partida
			$id_usu_respondiendo = $obj_mdlruleta->get_id_usua_respondiendo($id_partida);
			if(!($obj_mdlruleta->partida_en_proceso($id_partida)) || ($id_usu_respondiendo <> $this->usuario->id_usuario)){
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/12");
				exit();
			}

			//Obtiene la cantidad de contador de barras poseida en el momento para la partida
			$contador_barra = $obj_mdlruleta->obtener_estado_barra($id_partida, $this->usuario->id_usuario);
			if($contador_barra <> 3){
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/12");
				exit();
			}

			//Obtiene la información de todas categorias
			$this->todas_categorias_faltantes = $obj_mdlruleta->obtener_categorias_sin_ganar($id_ronda, $this->usuario->id_usuario);

			//Obtiene el nombre de las categorias en un array para pasarlo al js
			$tmp_nombre_categorias = $obj_mdlruleta->obtener_nombre_categorias();
			$nombre_categorias = array();
			foreach ($tmp_nombre_categorias as $valor => $categoria){
				array_push($nombre_categorias, utf8_decode($categoria['nombre']));
			}
			$nombre_categorias = json_encode($nombre_categorias);

			
			//Carga todos los archivos requeridos en el view
			$this->addjQueryScript(true, "jquery-1.8.2.min", "jQuery182");
			$this->addScript(true, "seleccionCategoria/seleccionCategoria");
			$this->addScript(true, "bootstrap/bootstrap");
			$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
			$this->addStyle("modules/seleccionCategoria/seleccionCategoria", "stylesheet", "screen");
			$this->addInReadyCode("
				MSSeleccionCategoria.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', ".$id_ronda.", '".$nombre_categorias."', $('#body').width());
				$(window).resize(function() {
					MSSeleccionCategoria.cambiar_responsive($('#body').width());
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
					$this->exito = "";
					break;
				case "2":
					$this->peligro = "";
					break;
				case "3":
					$this->info = "";
					break;
				default:
					$this->alerta = null;
					break;
			}
		}

		public function render()
		{
			return $this->printView("modules/seleccionCategoria/seleccionCategoria");
		}
	}
?>
