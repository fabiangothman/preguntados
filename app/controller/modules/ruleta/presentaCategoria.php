<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

	class presentaCategoria extends controller
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
			$this->title = _MSFW_APP_NAME_." - Categoria";
			//Carga los mensajes entrantes
			$this->loadError();

			//Sección que obtiene el id de la partida y categoria que se jugará
			$this->id_categoria = $this->convertNullToEmpty($this->getArg("categoria"));
			if(empty($this->id_categoria)){
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/6");
				exit();
			}
			$this->id_partida = $this->convertNullToEmpty($this->getArg("partida"));
			if(empty($this->id_partida)){
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/7");
				exit();
			}
			$this->ronda = $this->convertNullToEmpty($this->getArg("ronda"));
			if(empty($this->ronda)){
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/9");
				exit();
			}

			//Empiece a animar el avatar de la categoria y da la opción de continuar a la pregunta
			//Obtiene el nombre de la categoria
			$this->loadModel("modules/ruleta/ruletainfo.cls", false);
			$obj_mdlruleta = new ruletaInfo($this->main);
			$this->categoria_nombre = $obj_mdlruleta->obtener_nom_categoria($this->id_categoria);

			//Url con parametros para redireccionar a la pregunta
			$this->link_pregunta = _MSFW_PATH_."modules/pregunta/pregunta/categoria/".$this->id_categoria."/partida/".$this->id_partida."/ronda/".$this->ronda;
			
			
			
			//Carga todos los archivos requeridos en el view
			$this->addjQueryScript(true, "jquery-1.8.2.min", "jQuery182");
			$this->addScript(true, "ruleta/presentaCategoria");
			$this->addScript(true, "bootstrap/bootstrap");
			$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
			$this->addStyle("modules/ruleta/presentaCategoria", "stylesheet", "screen");
			$this->addInReadyCode("
				MSPresentaCategoria.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', $('#body').width());
				$(window).resize(function() {
					MSPresentaCategoria.cambiar_responsive($('#body').width());
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
			return $this->printView("modules/ruleta/presentaCategoria");
		}
	}
?>
