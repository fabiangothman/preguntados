<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class ver_preguntas extends controller
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

		$this->title = _MSFW_APP_NAME_." - Preguntas";

		// se carga el modelo de preguntas
		$this->loadModel("modules/pregunta/pregunta.cls",false);
		$mdlPregunta = new pregunta($this->main);

		$this->preguntas = $mdlPregunta->getAllpregunta();

		$this->addScript(true, "pregunta/ver_preguntas");
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
				$this->peligro = "No se pudo consultar la pregunta!";
				break;
			case "2":
				$this->peligro = "Error al consultar la pregunta";
				break;
			case "3":
				$this->peligro = "Error al consultar las respuestas de la pregunta";
				break;
			case "4":
				$this->peligro = "Error al consultar la categoria de la pregunta";
				break;
			case "5":
				$this->peligro = "No se pudo eliminar la pregunta";
				break;
			case "6":
				$this->info = "Se ha eliminado la pregunta!";
				break;
			default:
				$this->info = null;
				break;
		}
	}

  	public function render()
	{
    	return $this->printView("modules/pregunta/ver_preguntas");;
  	}
}
?>
