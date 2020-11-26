<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class editar_pregunta extends controller
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

		$this->title = _MSFW_APP_NAME_." - Editar Pregunta";

		$id_pregunta = $this->convertNullToEmpty($this->getArg("id_pregunta"));

		if($id_pregunta == null || $id_pregunta == "")
		{
			$this->redirect(_MSFW_PATH_."modules/pregunta/ver_preguntas/mensaje/1");
		}

		// se carga el modelo de pregunta
		$this->loadModel("modules/pregunta/pregunta.cls",false);
		$mdlpregunta = new pregunta($this->main);

		$this->pregunta = $mdlpregunta->getPreguntaById($id_pregunta);

		if($this->pregunta == null || empty($this->pregunta))
		{
			$this->redirect(_MSFW_PATH_."modules/pregunta/ver_preguntas/mensaje/2");
			exit();
		}

		$this->pregunta = $this->pregunta[0];

		//consultamos las respuestas de la pregunta
		$this->loadModel("modules/respuesta/respuesta.cls",false);
		$mdlrespuesta = new respuesta($this->main);
		$this->respuestas = $mdlrespuesta->getRespuestaByPregunta($id_pregunta);
		//print_r($this->respuestas);
		//exit();

		if($this->respuestas == null || empty($this->respuestas))
		{
			$this->redirect(_MSFW_PATH_."modules/pregunta/ver_preguntas/mensaje/3");
			exit();
		}

		//consultamos las categorias
		$this->loadModel("modules/categoria/mdlcategoria.cls",false);
		$mdlcategoria = new categoria($this->main);
		$this->categorias = $mdlcategoria->getAllcategoria();

		if($this->categorias == null || empty($this->categorias))
		{
			$this->redirect(_MSFW_PATH_."modules/pregunta/ver_preguntas/mensaje/4");
			exit();
		}

		$this->addScript(true, "pregunta/editar_pregunta");

		$this->addjQueryScript(true, "jquery-1.8.2.min", "jQuery182");
		$this->addScript(true, "bootstrap/bootstrap");
		$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
		$this->addStyle("modules/pregunta/pregunta", "stylesheet", "screen");
		
		$this->addInReadyCode("
				EditarPregunta.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', $(window).width(),'".$id_pregunta."');
				$(window).resize(function() {
				  EditarPregunta.cambiar_responsive($(window).width());
				});
		");
 	}
	

  	public function render()
	{
    	return $this->printView("modules/pregunta/editar_pregunta");;
  	}
}
?>
