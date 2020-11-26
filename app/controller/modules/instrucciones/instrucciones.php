<?php
	/****************************************************************************
	*	Desarrollado por: Fabi�n Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Su�rez, juancsuarezg@correo.udistrital.edu.co	*
	*					  � 2017												*
	****************************************************************************/

	class instrucciones extends controller
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
			$this->title = _MSFW_APP_NAME_." - Nueva partida";
			//Carga los mensajes entrantes
			$this->loadError();

			
			//Carga todos los archivos requeridos en el view
			$this->addjQueryScript(true, "jquery-1.8.2.min", "jQuery182");
			$this->addScript(true, "instrucciones/instrucciones");
			$this->addScript(true, "bootstrap/bootstrap");
			$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
			$this->addStyle("modules/instrucciones/instrucciones", "stylesheet", "screen");
			$this->addInReadyCode("
				MSInstrucciones.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', $('#body').width());
				$(window).resize(function() {
					MSInstrucciones.cambiar_responsive($('#body').width());
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
			return $this->printView("modules/instrucciones/instrucciones");
		}
	}
?>
