<?php
	/****************************************************************************
	*	Desarrollado por: Fabi�n Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Su�rez, juancsuarezg@correo.udistrital.edu.co	*
	*					  � 2017												*
	****************************************************************************/
	
	class header extends controller
	{
		protected function index()
		{
			$this->data = $this->header_data;
                        
			$this->_MSFW_APP_NAME_ = _MSFW_APP_NAME_;
			
			$this->logged = ($this->main->session->check_session()=="open")?true:false;
			
			if($this->logged)
			{
				//Contiene array con toda la informaci�n del usuario logueado
				$this->usuario = $this->main->usuario;
				$mi_id = $this->usuario->id_usuario;
			}
			$focus = (isset($mi_id)) ? "#".$mi_id : '';
			
			$this->controlador = $this->main->url_solver->getObjectName();
			//URL para cerrar la sesi�n del usuario
			$this->ir_cerrar_sesion = _MSFW_PATH_."modules/login/logout";
			//Listado de urls para navegar en men�
			$this->ir_home = _MSFW_PATH_."modules/home/home";
			$this->ir_rankingsemanal = _MSFW_PATH_."modules/rankingsemanal/rankingsemanal/".$focus;
			$this->ir_rankinggeneral = _MSFW_PATH_."modules/rankinggeneral/rankinggeneral/".$focus;
			$this->ir_historial = _MSFW_PATH_."modules/historial/historial";
			$this->ir_perfil = _MSFW_PATH_."modules/perfil/perfil";

			// Carga de archivos requeridos en el view
			$this->addStyle("common/general", "stylesheet", "screen");
			$this->addStyle("common/header", "stylesheet", "screen");
			$this->addjQueryScript(true, "jquery-1.12.4", "$");
			$this->addScript(true, "header/header");
			
			if($this->logged)
			{
				$this->addScript(true, "jquery-ui");
				$this->addScript(true, "modal/jquery.simplemodal-1.4.4");
				$this->addScript(true, "modal/modal_manager");
			}

			$this->addInReadyCode("
				MSHeader.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', $(window).width());
				$(window).resize(function() {
				  MSHeader.cambiar_responsive($(window).width());
				});
			");
		}

		public function render()
		{
			$output = $this->printView("common/header");	
			foreach($this->subControllers as $unSubController)
			{
				$output .= $unSubController->render();
			}
			return $output;
		}
	}
?>