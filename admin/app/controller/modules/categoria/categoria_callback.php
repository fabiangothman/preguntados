<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class categoria_callback extends controller
{
	private $usuario;

	protected function index()
	{
		//Se verifica el estado de la sesión
		$this->logged = ($this->main->session->check_session()=="open")?true:false;
		if(!$this->logged){
			echo "Acceso denegado.";
			exit();
		}

		$this->getFormData("action", false);

		switch ($this->action) {
			case 'agregar':
				$this->addCategoria();
				break;
			case 'editar':
				$this->editCategoria();
				break;
			case 'todos':
				$this->getAllCategoria();
				break;
			case 'eliminar':
				$this->delCategoria();
			default:
				# code...
				break;
		}		
 	}
	
	public function addCategoria()
  	{
	  	$this->getFormData("categoria", false);
	  	
	  	// Carga validador de datos
		$this->loadServerFormValidator();
		$validator = new FormValidator();
	    $validator->addValidation("categoria","req","El nombre de la categoria es obligatorio");
	  
	   	//Verificación de validación
	    if(!$validator->ValidateForm()){
	    	$errores = "";
	    	foreach ($validator->GetErrors() as $UnError) {
	    		$errores .= $UnError.'. ';
	    	}
	    	echo $errores;
	    	exit();
	    }
			
		// Carga de modelo de usuario
		$this->loadModel("modules/categoria/mdlcategoria.cls",false);
		$mdlCategoria = new categoria($this->main);

		$insertar = $mdlCategoria->addCategoria($this->categoria);

		if($insertar != 1)
		{
			echo "Error al insertar una nueva categoria a la base de datos.";
			exit();
		}

		echo "Categoria guardada.";
		exit();
	}


	public function editCategoria()
	{
		$this->getFormData("id_categoria", false);
		$this->getFormData("categoria", false);
	  	
	  	// Carga validador de datos
		$this->loadServerFormValidator();
		$validator = new FormValidator();
		$validator->addValidation("id_categoria","req","Se desconoce la categoria a editar");
	    $validator->addValidation("categoria","req","El nombre de la categoria es obligatoria");
	    
	    //Verificación de validación
	    if(!$validator->ValidateForm()){
	    	$errores = "ERROR: ";
	    	foreach ($validator->GetErrors() as $UnError) {
	    		$errores .= $UnError.'. ';
	    	}
	    	echo $errores;
	    	exit();
	    }

	    // Carga de modelo de usuario
		$this->loadModel("modules/categoria/mdlcategoria.cls",false);
		$mdlcategoria = new categoria($this->main);
		$editar = $mdlcategoria->editCategoria($this->id_categoria, $this->categoria);
		
		if($editar != 1)
		{
			echo "ERROR: No se pudo editar la categoria en la base de datos.";
			exit();
		}

		echo "Se han guardado los cambios.";
		exit();
	}

	public function getAllCategoria()
	{
		// Carga de modelo de usuario
		$this->loadModel("modeules/categoria/mdlcategoria.cls",false);
		$mdlcategoria = new categoria($this->main);
		$categorias = $mdlcategoria->getAllcategoria();
		print_r($categorias);
		exit();
	}

	public function delCategoria()
	{
		$this->getFormData("id_categoria", false);
		// Carga de modelo de usuario
		$this->loadModel("modules/categoria/mdlcategoria.cls",false);
		$mdlcategoria = new categoria($this->main);
		$eliminar = $mdlcategoria->delCategoria($this->id_categoria);
		if($eliminar != 1){
			echo "ERROR: Error al eliminar la categoria de la base datos";
			exit();
		}
		echo "Categoria eliminada correctamente.";
		exit();
	}

  	public function render()
	{
    	return "";
  	}
}
?>
