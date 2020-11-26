<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class ver_usuarios extends controller
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

		$this->title = _MSFW_APP_NAME_." - Usuarios";

		// se carga el modelo de usuarios
		$this->loadModel("common/mdlusuario.cls",false);
		$mdlUsuario = new usuario($this->main);

		$this->id_administrador = $this->main->usuario->id_usuario;
		$this->usuarios = $mdlUsuario->getAllUsers($this->id_administrador);

		if($this->usuarios == null || empty($this->usuarios))
		{
			$this->redirect("modules/home/home/mensaje/6");
		}

		$this->addScript(true, "usuario/ver_usuarios");
		$this->addScript(true, "bootstrap/bootstrap");
		$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");

		$this->addInReadyCode("
				VerUsuarios.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', $('#body').width());
		");
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
			case "2":
				$this->peligro = "Se desconoce el usuario a consultar!";
				break;
			case '3':
				$this->peligro = "No se pudo eliminar al usuario!";
				break;
			case '4':
				$this->info = "Se elimino correctamente al usuario!";
				break;
			default:
				$this->info = null;
				break;
		}
	}

  	public function render()
	{
    	return $this->printView("modules/usuario/usuario");;
  	}
}
?>
