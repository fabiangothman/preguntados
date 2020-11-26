<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
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
				$this->idUsuario = $this->main->session->id_admin;
				//$target_dir = _UPLOAD_IMG_ROOT_."modules/perfil/perfiles/";
				
				$this->usuario = $this->main->usuario;
			}
			
			$this->controlador = $this->main->url_solver->getObjectName();

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
				MSHeader.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."');
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