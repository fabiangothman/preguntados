<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class pregunta_callback extends controller
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
				$this->addPregunta();
				break;
			case 'editar':
				$this->editPregunta();
				break;
			case 'todos':
				$this->getAllPregunta();
				break;
			case 'eliminar':
				$this->delPregunta();
			default:
				# code...
				break;
		}		
 	}
	
	public function addPregunta()
  	{
	  	$this->getFormData("id_categoria", false);
	  	$this->getFormData("pregunta", false);
	  	$this->getFormData("respuesta_1", false);
	  	$this->getFormData("respuesta_2", false);
	  	$this->getFormData("respuesta_3", false);
	  	$this->getFormData("respuesta_4", false);
	  	$this->getFormData("correcta", false);
	  	
	  	// Carga validador de datos
		$this->loadServerFormValidator();
		$validator = new FormValidator();
	    $validator->addValidation("id_categoria","req","La pregunta debe esta asociada a una categoría");
	    $validator->addValidation("pregunta","req","La pregunta es obligatoria");
	    $validator->addValidation("respuesta_1","req","Hace falta la respuesta 1");
	    $validator->addValidation("respuesta_2","req","Hace falta la respuesta 2");
	    $validator->addValidation("respuesta_3","req","Hace falta la respuesta 3");
	    $validator->addValidation("respuesta_4","req","Hace falta la respuesta 4");
	    $validator->addValidation("correcta","req","Debe escoger una respuesta correcta");
	  
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
		$this->loadModel("modules/pregunta/pregunta.cls",false);
		$mdlPregunta = new pregunta($this->main);
		$id_pregunta = $mdlPregunta->generateId();
		$insertar = $mdlPregunta->addPregunta($id_pregunta, $this->id_categoria, $this->pregunta);

		if($insertar != 1)
		{
			echo "ERROR: No se pudo agregar una pregunta.";
			exit();
		}

		//insertamos las respuestas de la pregunta
		$this->loadModel("modules/respuesta/respuesta.cls",false);
		$mdlrespuesta = new respuesta($this->main);
		$insertR1 = $mdlrespuesta->addRespuesta($this->respuesta_1, (($this->correcta == "r1")?1:null), $id_pregunta);
		if($insertR1 != 1)
		{
			echo "ERROR: No se pudo ingresar la respuesta 1 a la base de datos";
			exit();
		}
		$insertR2 = $mdlrespuesta->addRespuesta($this->respuesta_2, (($this->correcta == "r2")?1:null), $id_pregunta);
		if($insertR2 != 1)
		{
			echo "ERROR: No se pudo ingresar la respuesta 2 a la base de datos";
			exit();
		}
		$insertR3 = $mdlrespuesta->addRespuesta($this->respuesta_3, (($this->correcta == "r3")?1:null), $id_pregunta);
		if($insertR3 != 1)
		{
			echo "ERROR: No se pudo ingresar la respuesta 2 a la base de datos";
			exit();
		}
		$insertR4 = $mdlrespuesta->addRespuesta($this->respuesta_4, (($this->correcta == "r4")?1:null), $id_pregunta);
		if($insertR4 != 1)
		{
			echo "ERROR: No se pudo ingresar la respuesta 2 a la base de datos";
			exit();
		}

		echo "La pregunta ha sido guardada!";
		exit();
	}


	public function editPregunta()
	{
		$this->getFormData("id_pregunta", false);
		$this->getFormData("id_categoria", false);
		$this->getFormData("pregunta", false);
		$this->getFormData("id_respuesta_1", false);
		$this->getFormData("id_respuesta_2", false);
		$this->getFormData("id_respuesta_3", false);
	  	$this->getFormData("id_respuesta_4", false);
	  	$this->getFormData("respuesta_1", false);
	  	$this->getFormData("respuesta_2", false);
	  	$this->getFormData("respuesta_3", false);
	  	$this->getFormData("respuesta_4", false);
	  	$this->getFormData("correcta", false);

	  	// Carga validador de datos
		$this->loadServerFormValidator();
		$validator = new FormValidator();
		$validator->addValidation("id_pregunta","req","Se desconoce la pregunta a editar");
		$validator->addValidation("id_categoria","req","La categoria es obligatoria");
	    $validator->addValidation("pregunta","req","La pregunta es obligatoria");
	    $validator->addValidation("id_respuesta_1","req","Error en el sistema");
	    $validator->addValidation("id_respuesta_2","req","Error en el sistema");
	    $validator->addValidation("id_respuesta_3","req","Error en el sistema");
	    $validator->addValidation("id_respuesta_4","req","Error en el sistema");
	    $validator->addValidation("respuesta_1","req","La respuesta 1 es obligatoria");
	    $validator->addValidation("respuesta_2","req","La respuesta 2 es obligatoria");
	    $validator->addValidation("respuesta_3","req","La respuesta 3 es obligatoria");
	    $validator->addValidation("respuesta_4","req","La respuesta 4 es obligatoria");
	    $validator->addValidation("correcta","req","Debe escoger una respuesta correcta");
	    
	    //Verificación de validación
	    if(!$validator->ValidateForm()){
	    	$errores = "ERROR: ";
	    	foreach ($validator->GetErrors() as $UnError) {
	    		$errores .= $UnError.'. ';
	    	}
	    	echo $errores;
	    	exit();
	    }

	    // Carga de modelo de pregunta
		$this->loadModel("modules/pregunta/pregunta.cls",false);
		$mdlpregunta = new pregunta($this->main);
		$editar = $mdlpregunta->editPregunta($this->id_pregunta, $this->id_categoria, $this->pregunta);
		
		if($editar != 1)
		{
			echo "ERROR: No se pudo editar la pregunta en la base de datos.";
			exit();
		}

		//editamos las respuestas a las preguntas
		$this->loadModel("modules/respuesta/respuesta.cls",false);
		$mdlrespuesta = new respuesta($this->main);
		
		$editarR1 = $mdlrespuesta->editRespuesta($this->id_respuesta_1, $this->respuesta_1, (($this->correcta == "r1")?1:null));
		if($editarR1 != 1)
		{
			echo "ERROR: No se pudo editar la respuesta 1.";
			exit();
		}

		$editarR2 = $mdlrespuesta->editRespuesta($this->id_respuesta_2, $this->respuesta_2, (($this->correcta == "r2")?1:null));
		if($editarR2 != 1)
		{
			echo "ERROR: No se pudo editar la respuesta 2.";
			exit();
		}
		
		$editarR3 = $mdlrespuesta->editRespuesta($this->id_respuesta_3, $this->respuesta_3, (($this->correcta == "r3")?1:null));
		if($editarR3 != 1)
		{
			echo "ERROR: No se pudo editar la respuesta 3.";
			exit();
		}

		$editarR4 = $mdlrespuesta->editRespuesta($this->id_respuesta_4, $this->respuesta_4, (($this->correcta == "r4")?1:null));
		if($editarR4 != 1)
		{
			echo "ERROR: No se pudo editar la respuesta 4.";
			exit();
		}

		echo "Se han guardado los cambios!";
		exit();
	}

	public function getAllPregunta()
	{
		// Carga de modelo de usuario
		$this->loadModel("modeules/pregunta/pregunta.cls",false);
		$mdlpregunta = new pregunta($this->main);
		$preguntas = $mdlpregunta->getAllpregunta();
		print_r($preguntas);
		exit();
	}

	public function delPregunta()
	{
		$this->getFormData("id_pregunta", false);
		// Carga de modelo de usuario
		$this->loadModel("modules/pregunta/pregunta.cls",false);
		$mdlpregunta = new pregunta($this->main);
		$eliminar = $mdlpregunta->delPregunta($this->id_pregunta);
		if($eliminar != 1){
			echo "ERROR: Error al eliminar la pregunta de la base datos";
			exit();
		}
		echo "Pregunta eliminada correctamente.";
		exit();
	}

  	public function render()
	{
    	return "";
  	}
}
?>
