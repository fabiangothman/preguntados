<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class nueva_pregunta extends controller
{

	protected function index()
	{
		//Se verifica el estado de la sesión
		$this->logged = ($this->main->session->check_session()=="open")?true:false;
		if(!$this->logged)
		{
			$this->redirect(_MSFW_PATH_);
			exit();
		}

		$this->title = _MSFW_APP_NAME_." - Agregar categoria";

		//buscamos las categorias disponibles
		//se cargan los roles existentes
		$this->loadModel("modules/categoria/mdlcategoria.cls",false);
		$mdlcategoria = new categoria($this->main);
		$this->categorias = $mdlcategoria->getAllcategoria();

		//print_r($this->categorias);

		$this->addScript(true, "pregunta/nueva_pregunta");
		$this->addStyle("modules/pregunta/pregunta", "stylesheet", "screen");
		$this->addScript(true, "bootstrap/bootstrap");
		$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
 	}

  	public function render()
	{
    	return $this->printView("modules/pregunta/nueva_pregunta");;
  	}
}
?>
