<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class editar_usuario extends controller
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

		$this->title = _MSFW_APP_NAME_." - Editar Usuario";

		$id_usuario = $this->convertNullToEmpty($this->getArg("id_usuario"));


		if($id_usuario == null || $id_usuario == "")
		{
			$this->redirect("modules/usuario/ver_usuarios/mensaje/1");
		}

		// se carga el modelo de usuarios
		$this->loadModel("common/mdlusuario.cls",false);
		$mdlUsuario = new usuario($this->main);

		$this->usuario = $mdlUsuario->getUserById($id_usuario);

		if($this->usuario == null || empty($this->usuario))
		{
			$this->redirect("modules/usuario/ver_usuarios/mensaje/2");
		}

		//se cargan los roles existentes
		$this->loadModel("modules/rol/rol.cls",false);
		$mdlRol = new rol($this->main);
		$this->roles = $mdlRol->getAllrol();

		//print_r($this->roles);

		$this->usuario = $this->usuario[0];

		//print_r($this->usuario);

		$this->addScript(true, "usuario/editar_usuario");
		$this->addStyle("modules/usuario/usuario", "stylesheet", "screen");

		$this->addjQueryScript(true, "jquery-1.8.2.min", "jQuery182");
		$this->addScript(true, "bootstrap/bootstrap");
		$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
		
		$this->addInReadyCode("
				// binds form submission and fields to the validation engine
				//jQuery182(\"#formEditUsuario\").validationEngine();

				EditarUsuario.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', $(window).width(),'".$id_usuario."');
				$(window).resize(function() {
				  EditarUsuario.cambiar_responsive($(window).width());
				});
		");
 	}
	

  	public function render()
	{
    	return $this->printView("modules/usuario/editar_usuario");;
  	}
}
?>
