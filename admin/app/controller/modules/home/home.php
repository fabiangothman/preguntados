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

			//Carga los mensajes entrantes
			$this->loadError();
			
			// Carga de modelo de usuario
			/*$this->loadModel("common/mdlusuario.cls",false);
		
			// Se verifica el inicio de sesión con los datos proporcionados
			$this->usuario = new usuario($this->main, "login", $this->email, $this->contrasena, "");
			*/

			//cargamos todos los usuarios del sistema
			$this->loadModel("common/mdlusuario.cls",false);

			//Carga todos los archivos requeridos en el view
			$this->addjQueryScript(true, "jquery-1.8.2.min", "jQuery182");
			$this->addScript(true, "home/home");
			$this->addScript(true, "bootstrap/bootstrap");
			$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
			$this->addStyle("modules/home/home", "stylesheet", "screen");
			$this->addInReadyCode("
				MSHome.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', $(window).width());
				$(window).resize(function() {
				  MSHome.cambiar_responsive($(window).width());
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
				case "6":
					$this->peligro = "Error al consultar los usuarios.";
					break;
				case "7":
					$this->peligro = "Error al consultar las preguntas.";
					break;
				default:
					$this->info = null;
					break;
			}
		}

		public function render()
		{
			return $this->printView("modules/home/home");
		}
	}
?>
