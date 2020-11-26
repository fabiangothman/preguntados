<?php
	/******************************************************/
	/*	Desarrollado por: Fabián Murillo © 2017	*/
	/******************************************************/
	
	class footer_iframe extends controller
	{
		protected function index()
		{
			
		}
		
		public function render()
		{
			$output = $this->printView("common/footer_iframe");
			foreach($this->subControllers as $unSubController)
			{
				$output .= $unSubController->render();
			}
			return $output;
		}
	}
?>