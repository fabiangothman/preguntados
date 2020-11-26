<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class carga_usuarios extends controller
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
		$this->title = _MSFW_APP_NAME_." - Cargar Usuarios";


		$this->loadModel("modules/cargaUsuarios/cargar_usuarios.cls",false);
		$mdlCarga = new cargar_usuarios($this->main);
		$this->lista_usuarios = $mdlCarga->obtener_usuarios();
		

		$this->addStyle("modules/cargaUsuarios/carga_usuarios", "stylesheet", "screen");
		$this->addInReadyCode("
			//
		");
 	}
	

  	public function render()
	{
    	return $this->printView("modules/cargaUsuarios/carga_usuarios");;
  	}
}
?>