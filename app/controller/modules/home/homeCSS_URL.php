<?php
	/******************************************************/
	/*	Desarrollado por: Fabi�n Murillo � 2017	*/
	/******************************************************/

	class home extends controller
	{
		protected function index()
		{
			// Se verifica la sesi�n
			$this->logged = ($this->main->session->check_session()=="open")?true:false;
			if(!$this->logged){
				$this->redirect(_MSFW_PATH_."modules/login/login/err/1");
				exit();
			}else{
				//Array con toda la informaci�n del usuario
				$this->usuario = $this->main->usuario;
			}

			//Configuraci�n inicial
			$this->title = _MSFW_APP_NAME_." - home";
			//Carga los mensajes entrantes
			$this->loadError();
			
			// Carga de archivos requeridos en el view
			$this->addStyle("modules/home/home.css.php?viewpath=".urlencode(_MSFW_PATH_._VIEW_PATH_), "stylesheet", "screen");
			$this->addScript(true, "home/home");
			$this->addScript(true, "bootstrap/bootstrap");
			$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");

			$this->addInReadyCode("
				//
			");
		}

		private function loadError()
		{
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
					$this->peligro = "ERROR: Debe ingresar los campos obligatorios.";
					break;
				case "3":
					$this->peligro = "ERROR: Email o contrase�a incorrecta.";
					break;
				case "4":
					$this->peligro = "ERROR: La informaci�n de inicio de sesi�n autom�tica no es v�lida.";
					break;
				default:
					$this->peligro = null;
					break;
			}
		}

		public function render()
		{
			return $this->printView("modules/home/home");
		}
	}
?>
