<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class carga_preguntas extends controller
{

	protected function index()
	{
		header('Content-Type: text/html; charset=UTF-8');
		//Se verifica el estado de la sesión
		$this->logged = ($this->main->session->check_session()=="open")?true:false;
		if(!$this->logged)
		{
			$this->redirect(_MSFW_PATH_);
			exit();
		}
		$this->title = _MSFW_APP_NAME_." - Cargar Preguntas";


		$this->loadModel("modules/cargaPreguntas/cargar_preguntas.cls",false);
		$mdlCarga = new cargar_preguntas($this->main);
		$this->lista_preguntas = $mdlCarga->obtener_preguntas();
		

		$this->addStyle("modules/cargaPreguntas/carga_preguntas", "stylesheet", "screen");
		$this->addInReadyCode("
			//
		");
 	}
	

  	public function render()
	{
    	return $this->printView("modules/cargaPreguntas/carga_preguntas");;
  	}
}
?>