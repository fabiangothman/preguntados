<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class editar_categoria extends controller
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

		$this->title = _MSFW_APP_NAME_." - Editar Categoria";

		$id_categoria = $this->convertNullToEmpty($this->getArg("id_categoria"));

		if($id_categoria == null || $id_categoria == "")
		{
			$this->redirect("modules/categoria/ver_categorias/mensaje/1");
		}

		// se carga el modelo de categoria
		$this->loadModel("modules/categoria/mdlcategoria.cls",false);
		$mdlcategoria = new categoria($this->main);

		$this->categoria = $mdlcategoria->getCategoriaById($id_categoria);

		if($this->categoria == null || empty($this->categoria))
		{
			$this->redirect("modules/categoria/ver_categorias/mensaje/2");
		}

		$this->categoria = $this->categoria[0];

		$this->addScript(true, "categoria/editar_categoria");

		$this->addjQueryScript(true, "jquery-1.8.2.min", "jQuery182");
		$this->addScript(true, "bootstrap/bootstrap");
		$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
		$this->addStyle("modules/categoria/categoria", "stylesheet", "screen");
		
		$this->addInReadyCode("
				// binds form submission and fields to the validation engine
				//jQuery182(\"#formEditCategoria\").validationEngine();

				EditarCategoria.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', $(window).width(),'".$id_categoria."');
				$(window).resize(function() {
				  EditarCategoria.cambiar_responsive($(window).width());
				});
		");
 	}
	

  	public function render()
	{
    	return $this->printView("modules/categoria/editar_categoria");;
  	}
}
?>
