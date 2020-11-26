<?php
	/****************************************************************************
	*	Desarrollado por: Fabi�n Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Su�rez, juancsuarezg@correo.udistrital.edu.co	*
	*					  � 2017												*
	****************************************************************************/
	
	class login extends controller
	{
		protected function index()
		{
			//Se verifica el estado de la sesi�n
			$this->logged = ($this->main->session->check_session()=="open")?true:false;
			if($this->logged)
			{
				// Se debe dirigir al path por defecto
				$this->redirect(_MSFW_PATH_);
				exit();
			}

			//Configuraci�n inicial
			$this->title = _MSFW_APP_NAME_." - Login";
			//Carga los mensajes entrantes
			$this->loadError();
			//Carga el email si hay error al tratar de iniciar sesi�n
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
			//Se cargan los posibles mensajes a enviar al view, seg�n la variable
			$this->exito = "";
			$this->peligro = "";
			$this->info = "";
			$this->alerta = "";
			switch($this->convertNullToEmpty($this->getArg("mensaje")))
			{
				case "1":
					//$this->info = utf8_decode("La sesi�n expir�!");
					$this->info = "La sesi�n expir�!";
					break;
				case "2":
					//$this->peligro = utf8_decode("ERROR: Debe ingresar los campos obligatorios de manera correcta.");
					$this->peligro = "ERROR: Debe ingresar los campos obligatorios de manera correcta.";
					break;
				case "3":
					//$this->peligro = utf8_decode("ERROR: Email o contrase�a incorrecta.");
					$this->peligro = "ERROR: Email o contrase�a incorrecta.";
					break;
				case "4":
					//$this->peligro = utf8_decode("ERROR: La informaci�n de inicio de sesi�n autom�tica no es v�lida.");
					$this->peligro = "ERROR: La informaci�n de inicio de sesi�n autom�tica no es v�lida.";
					break;
				case "5":
					//$this->exito = utf8_decode("Ha cerrado sesi�n con �xito.");
					$this->exito = "Ha cerrado sesi�n con �xito.";
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