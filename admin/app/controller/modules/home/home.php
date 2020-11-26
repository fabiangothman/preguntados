<?php
	/****************************************************************************
	*	Desarrollado por: Fabi�n Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Su�rez, juancsuarezg@correo.udistrital.edu.co	*
	*					  � 2017												*
	****************************************************************************/

	class home extends controller
	{
		protected function index()
		{
			//Se verifica el estado de la sesi�n
			$this->logged = ($this->main->session->check_session()=="open")?true:false;
			if(!$this->logged){
				$this->redirect(_MSFW_PATH_);
				exit();
			}else{
				//Array con toda la informaci�n del usuario
				$this->usuario = $this->main->usuario;
			}

			//Configuraci�n inicial
			$this->title = _MSFW_APP_NAME_." - Home";

			//Carga los mensajes entrantes
			$this->loadError();
			
			// Carga de modelo de usuario
			/*$this->loadModel("common/mdlusuario.cls",false);
		
			// Se verifica el inicio de sesi�n con los datos proporcionados
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
			//Se cargan los posibles mensajes a enviar al view, seg�n la variable
			$this->exito = "";
			$this->peligro = "";
			$this->info = "";
			$this->alerta = "";
			switch($this->convertNullToEmpty($this->getArg("mensaje")))
			{
				case "1":
					$this->info = "La sesi�n expir�!";
					break;
				case "2":
					$this->alerta = "ERROR: Debe ingresar los campos obligatorios.";
					break;
				case "3":
					$this->peligro = "ERROR: Email o contrase�a incorrecta.";
					break;
				case "4":
					$this->peligro = "ERROR: La informaci�n de inicio de sesi�n autom�tica no es v�lida.";
					break;
				case "5":
					$this->exito = "Ha cerrado sesi�n con �xito.";
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
