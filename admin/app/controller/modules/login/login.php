<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/
	
	class login extends controller
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
			$this->title = _MSFW_APP_NAME_." - Login";
			//Carga los mensajes entrantes
			$this->loadError();
			//Carga el email si hay error al tratar de iniciar sesión
			$this->email = $this->convertNullToEmpty($this->getArg("email"));
			//URL para recuperar contrasena
			$this->ir_recuperar = _MSFW_PATH_."modules/login/recuperar";
			$this->ir_usuario = _MSFW_PATH_."../";
			
			$this->addjQueryScript(true, "jquery-1.8.2.min", "jQuery182");
			$this->addScript(true, "login/login");
			$this->addScript(true, "bootstrap/bootstrap");
			$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
			$this->addStyle("modules/login/login", "stylesheet", "screen");
			$this->addInReadyCode("
				MSLogin.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', $(window).width());
				$(window).resize(function() {
				  MSLogin.cambiar_responsive($(window).width());
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
					//$this->info = utf8_decode("La sesión expiró!");
					$this->info = "La sesión expiró!";
					break;
				case "2":
					//$this->peligro = utf8_decode("ERROR: Debe ingresar los campos obligatorios de manera correcta.");
					$this->peligro = "ERROR: Debe ingresar los campos obligatorios de manera correcta.";
					break;
				case "3":
					//$this->peligro = utf8_decode("ERROR: Email o contraseña incorrecta.");
					$this->peligro = "ERROR: Email o contraseña incorrecta.";
					break;
				case "4":
					//$this->peligro = utf8_decode("ERROR: La información de inicio de sesión automática no es válida.");
					$this->peligro = "ERROR: La información de inicio de sesión automática no es válida.";
					break;
				case "5":
					//$this->exito = utf8_decode("Ha cerrado sesión con éxito.");
					$this->exito = "Ha cerrado sesión con éxito.";
					break;
				default:
					$this->alerta = null;
					break;
			}
		}
			
		public function render()
		{
			return $this->printView("modules/login/login");
		}
	}
?>