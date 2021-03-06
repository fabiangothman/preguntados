<?php
	/******************************************************/
	/*	Desarrollado por: Fabi�n Murillo � 2017	*/
	/******************************************************/
	
	class header_iframe extends controller
	{
		protected function index()
		{
			$this->data = $this->header_data;
			
			// Carga de archivos requeridos en el view
			$this->addStyle("common/general", "stylesheet", "screen");
			$this->addScript(true, "polyFills/cssMediaQuery/css3-mediaqueries");
			$this->addjQueryScript(true, "jquery-1.12.4", "$");
			$this->addScript(true, "modal/jquery.simplemodal-1.4.4");
			$this->addScript(true, "modal/modal_manager");
		}
		public function render()
		{
			$output = $this->printView("common/header_iframe");
			foreach($this->subControllers as $unSubController)
			{
				$output .= $unSubController->render();
			}
			return $output;
		}
	}
?>