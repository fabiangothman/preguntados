<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class nuevo_usuario extends controller
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

		$this->title = _MSFW_APP_NAME_." - Agregar usuario";

		//se cargan los roles existentes
		$this->loadModel("modules/rol/rol.cls",false);
		$mdlRol = new rol($this->main);
		$this->roles = $mdlRol->getAllrol();

		$this->addScript(true, "usuario/nuevo_usuario");
		
		$this->addStyle("modules/usuario/usuario", "stylesheet", "screen");
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
				$this->peligro = "No se pudo consultar el usuario!";
				break;
			default:
				$this->info = null;
				break;
		}
	}

  	public function render()
	{
    	return $this->printView("modules/usuario/nuevo_usuario");;
  	}
}
?>
