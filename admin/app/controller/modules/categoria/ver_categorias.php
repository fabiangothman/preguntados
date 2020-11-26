<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class ver_categorias extends controller
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

		$this->getError();

		$this->title = _MSFW_APP_NAME_." - Categorias";

		// se carga el modelo de categoria
		$this->loadModel("modules/categoria/mdlcategoria.cls",false);
		$mdlUsuario = new categoria($this->main);

		$this->categorias = $mdlUsuario->getAllcategoria();

		if($this->categorias == null || empty($this->categorias))
		{
			
		}

		$this->addScript(true, "categoria/ver_categorias");
		$this->addScript(true, "bootstrap/bootstrap");
		$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
 	}
	
	public function getError()
	{
		//Se cargan los posibles mensajes a enviar al view, según la variable
		$this->exito = "";
		$this->peligro = "";
		$this->info = "";
		$this->alerta = "";
		switch($this->convertNullToEmpty($this->getArg("mensaje")))
		{
			case "1":
				$this->peligro = "No se pudo consultar la categoria!";
				break;
			case "2":
				$this->peligro = "No encuentro la categoria a editar!";
				break;
			default:
				$this->info = null;
				break;
		}
	}

  	public function render()
	{
    	return $this->printView("modules/categoria/ver_categorias");;
  	}
}
?>
