<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

	class home extends controller
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

			//Valida que reciba el mensaje "instruido" para cargar el home comple, sino redirige al instructivo
			(!empty($this->convertNullToEmpty($this->getArg("instruido")))) ? $instruido = false : $instruido = true;
			if(!$instruido){
				$this->redirect(_MSFW_PATH_."modules/instrucciones/instrucciones");
				exit();
			}

			//Carga los mensajes entrantes
			$this->loadError();

			//Ruta del model de nueva partida
			$this->nueva_partida = _MSFW_PATH_."modules/nuevapartida/nuevapartida_callback";

			//Obtiene los datos de mis partidas del home
			$this->loadModel("modules/home/partidas.cls",false);
			$obj_mdlPartidas = new partidas($this->main);
			$turnos = $obj_mdlPartidas->turnos($this->usuario->id_usuario);
			$this->partidas_mi_turno = $turnos["mi_turno"];
			$this->partidas_su_turno = $turnos["su_turno"];

			$this->partidas_historial = $obj_mdlPartidas->historial_partidas($this->usuario->id_usuario);
			
			//Carga todos los archivos requeridos en el view
			$this->addjQueryScript(true, "jquery-1.8.2.min", "jQuery182");
			$this->addScript(true, "home/home");
			$this->addScript(true, "bootstrap/bootstrap");
			$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
			$this->addStyle("modules/home/home", "stylesheet", "screen");
			$this->addInReadyCode("
				MSHome.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', $('#body').width());
				$(window).resize(function() {
					MSHome.cambiar_responsive($('#body').width());
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
					$this->peligro = "Ocurrió un error al intentar encontrar el oponente ingresado.";
					break;
				case "2":
					$this->peligro = "No se pudo encontrar un oponente aleatorio.";
					break;
				case "3":
					$this->peligro = "Ocurrió un error al intentar crear la nueva partida.";
					break;
				case "4":
					$this->peligro = "La partida que intentó jugar no es válida.";
					break;
				case "5":
					$this->peligro = "Ocurrió un error al intentar recuperar los jugadores de la partida.";
					break;
				case "6":
					$this->peligro = "Ocurrió un error al intentar recuperar la categoria a jugar.";
					break;
				case "7":
					$this->peligro = "Ocurrió un error al intentar recuperar la partida en curso.";
					break;
				case "8":
					$this->peligro = "No tiene preguntas cargadas para ésta categoría.";
					break;
				case "9":
					$this->peligro = "No se encuentra la ronda actual de la partida.";
					break;
				case "10":
					$this->exito = "Ha finalizado la partida.";
					break;
				case "11":
					$this->exito = "Ha finalizado la partida, debe esperar a que el oponente conteste su turno.";
					break;
				case "12":
					$this->peligro = "Ha ingresado a una zona restringida para su usuario.";
					break;
				default:
					$this->alerta = null;
					break;
			}
		}

		public function render()
		{
			return $this->printView("modules/home/home");
		}
	}
?>
