<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

	class pregunta extends controller
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
			$this->title = _MSFW_APP_NAME_." - Pregunta";
			//Carga los mensajes entrantes
			$this->loadError();

			//Sección que obtiene el id de la ronda que se está jugando
			$this->id_ronda = $this->convertNullToEmpty($this->getArg("id_ronda"));
			if(empty($this->id_ronda)){
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/9");
				exit();
			}

			//Sección que obtiene el id de la categoria elegida por la ruleta o por seleccionCategoria
			$this->id_categoria = $this->convertNullToEmpty($this->getArg("id_categoria"));
			if(empty($this->id_categoria)){
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/6");
				exit();
			}
			
			$this->loadModel("modules/ruleta/ruletainfo.cls", false);
			$obj_mdlRuleta = new ruletaInfo($this->main);

			//Obtiene el id_partida de la partida mediante su id_ronda
			$id_partida = $obj_mdlRuleta->get_id_partida_by_ronda($this->id_ronda);
			if(empty($id_partida) || !($id_partida)){
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/4");
				exit();
			}

			//Valida permisos de acceso a la ruleta para los usuarios
			//Está restringido si NO es mi turno o si YA finalizó la partida
			$id_usu_respondiendo = $obj_mdlRuleta->get_id_usua_respondiendo($id_partida);
			if(!($obj_mdlRuleta->partida_en_proceso($id_partida)) || ($id_usu_respondiendo <> $this->usuario->id_usuario)){
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/12");
				exit();
			}

			//Valida que si id_categoria es "_0", quiere decir que la ruleta cayo en el diamante, se redirige a la selección de categoria
			//Establece en 3 el contador barra para que seleccionCategoria no lo banee por estar allí sin tener el contador en 3
			if($this->id_categoria=="_0"){
				$obj_mdlRuleta->set_estado_barra($id_partida, $this->usuario->id_usuario, 3);
				$this->redirect(_MSFW_PATH_."modules/seleccionCategoria/seleccionCategoria/id_ronda/".$this->id_ronda);
				exit();
			}

			//Obtiene el nombre de la categoria
			$this->categoria_nombre = $obj_mdlRuleta->obtener_nom_categoria($this->id_categoria);

			//Seccion encargada de traer aleatoriamente una id de pregunta
			$this->loadModel("modules/pregunta/preguntas.cls", false);
			$obj_mdlPreguntas = new preguntas($this->main);
			$this->pregunta = $obj_mdlPreguntas->obtener_preguntaAleatoria($this->id_categoria);
			if(!$this->pregunta){
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/8");
				exit();
			}

			//Seccion encargada de obtener las respuestas a la pregunta
			$this->respuestas = $obj_mdlPreguntas->obtener_respuestas_desordenadas($this->pregunta["id_pregunta"]);
			

			
			//Carga todos los archivos requeridos en el view
			$this->addjQueryScript(true, "jquery-1.8.2.min", "jQuery182");
			$this->addScript(true, "pregunta/pregunta");
			$this->addScript(true, "bootstrap/bootstrap");
			$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
			$this->addStyle("modules/pregunta/pregunta", "stylesheet", "screen");
			$this->addInReadyCode("
				MSPregunta.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', ".$this->pregunta["id_pregunta"].", ".$this->id_ronda.", $('#body').width());
				MSPregunta.iniciarContador("._TIEMPO_PREGUNTA_.");
				$(window).resize(function() {
					MSPregunta.cambiar_responsive($('#body').width());
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
			return $this->printView("modules/pregunta/pregunta");
		}
	}
?>
