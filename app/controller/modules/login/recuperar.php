<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/
	
	class recuperar extends controller
	{
		protected function index()
		{
			//Se verifica el estado de la sesión
			$this->logged = ($this->main->session->check_session()=="open")?true:false;
			if($this->logged)
			{
				// Se debe dirigir al path por defecto
				$this->redirect(_MSFW_PATH_);
				exit();
			}

			//Configuración inicial
			$this->title = _MSFW_APP_NAME_." - Recuperar contraseña";
			//Carga los mensajes entrantes
			$this->loadError();
			
			//Carga el email si hay error al tratar de iniciar sesión
			$this->email = $this->convertNullToEmpty($this->getArg("email"));
			//URL para volver al inicio de sesión
			$this->ir_volver = _MSFW_PATH_."modules/login/login";
			
			$this->addjQueryScript(true, "jquery-1.8.2.min", "jQuery182");
			$this->addScript(true, "recuperar/recuperar");
			$this->addScript(true, "bootstrap/bootstrap");
			$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
			$this->addStyle("modules/login/recuperar", "stylesheet", "screen");
			$this->addInReadyCode("
				MSRecuperar.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', $(window).width());
				$(window).resize(function() {
				  MSRecuperar.cambiar_responsive($(window).width());
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
					$this->peligro = utf8_decode("ERROR: Los datos son incorrectos, por favor intente de nuevo.");
					break;
				case "2":
					$this->peligro = utf8_decode("ERROR: El correo ingresado es incorrecto o no existe en nuestra base de datos.");
					break;
				case "3":
					$this->alerta = utf8_decode("No se pudo enviar la nueva contraseña al correo electrónico. Por favor vuelva a intentarlo de nuevo.");
					break;
				case "4":
					$this->exito = utf8_decode("Se ha enviado la nueva contraseña al correo electónico.");
					break;
				case "5":
					$this->peligro = utf8_decode("ERROR: no se pudo consultar la Base de datos.");
					break;
				default:
					$this->info = null;
					break;
			}
		}
		
		public function render()
		{
			return $this->printView("modules/login/recuperar");
		}
	}
?>