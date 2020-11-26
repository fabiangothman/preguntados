<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class usuario_callback extends controller
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
				$this->addUsuario();
				break;
			case 'editar':
				$this->editUsuario();
				break;
			case 'todos':
				$this->getAllUsers();
				break;
			case 'eliminar':
				$this->delUsuario();
			default:
				# code...
				break;
		}		
 	}
	
	public function addUsuario()
  	{
	  	$this->getFormData("id_rol", false);
	  	$this->getFormData("id_grupo", false);
	  	$this->getFormData("identificacion", false);
	  	$this->getFormData("codigo", false);
	  	$this->getFormData("nombres", false);
	  	$this->getFormData("apellidos", false);
	  	$this->getFormData("email", false);
	  	$this->getFormData("clave", false);

	  	// Carga validador de datos
		$this->loadServerFormValidator();
		$validator = new FormValidator();
	    $validator->addValidation("id_rol","req","El usuario no tien un rol especifico");
	    $validator->addValidation("identificacion","req","La identificacion es obligatoria");
	    $validator->addValidation("email","email","El correo esta mal escrito");
	    $validator->addValidation("email","req","El correo es obligatorio");
	    $validator->addValidation("clave","req","La clave es obligatoria");

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
		$this->loadModel("common/mdlusuario.cls",false);
		$mdlUsuario = new usuario($this->main);

		//verificamos que el usuario no exista en la base de datos
		$porEmail = $mdlUsuario->checkUser("email", $this->email);
		if($porEmail){
			echo "ERROR: Ya existe un usuario con el mismo email";
			exit();
		}
		$porIdentificacion = $mdlUsuario->checkUser("identificacion", $this->identificacion);
		if($porIdentificacion){
			echo "ERROR: Ya existe un usuario con la misma identificacion";
			exit();
		}
		$porCodigo = $mdlUsuario->checkUser("codigo", $this->codigo);
		if($porCodigo){
			echo "ERROR: Ya existe un usuario con este codigo";
			exit();
		}
		
		$insertar = $mdlUsuario->addUser($this->id_rol, 1, $this->identificacion, $this->codigo, $this->nombres, $this->apellidos, $this->email, $this->clave);

		if($insertar != 1)
		{
			echo "ERROR: Error al insertar un nuevo usuario a la base de datos.";
			exit();
		}

		echo "Se ha insertado un usuario correctamente!";
		exit();
	}


	public function editUsuario()
	{
		$this->getFormData("id_usuario", false);
		$this->getFormData("id_rol", false);
	  	$this->getFormData("identificacion", false);
	  	$this->getFormData("codigo", false);
	  	$this->getFormData("nombres", false);
	  	$this->getFormData("apellidos", false);
	  	$this->getFormData("email", false);
	  	$this->getFormData("clave", false);

	  	// Carga validador de datos
		$this->loadServerFormValidator();
		$validator = new FormValidator();
		$validator->addValidation("id_usuario","req","Se desconoce el usuario a editar");
	    $validator->addValidation("id_rol","req","El usuario no tiene un rol especifico");
	    $validator->addValidation("identificacion","req","La identificacion es obligatoria");
	    $validator->addValidation("email","email","el correo esta mal escrito");
	    $validator->addValidation("email","req","El correo es obligatorio");

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
		$this->loadModel("common/mdlusuario.cls",false);
		$mdlUsuario = new usuario($this->main);
		$editar = $mdlUsuario->editUser($this->id_usuario, $this->id_rol, null, $this->identificacion, $this->codigo, $this->nombres, $this->apellidos, $this->email, $this->clave);
		
		if($editar != 1)
		{
			echo "ERROR: No se pudo editar al usuario en la base de datos.";
			exit();
		}

		echo "Se han guardado los cambios!";
		exit();
	}

	public function getAllusuarios()
	{
		// Carga de modelo de usuario
		$this->loadModel("common/mdlusuario.cls",false);
		$mdlUsuario = new usuario($this->main);
		$usuarios = $mdlUsuario->getAllUsers();
		print_r($usuarios);
		exit();
	}

	public function delUsuario()
	{
		$this->getFormData("id_usuario", false);
		// Carga de modelo de usuario
		$this->loadModel("common/mdlusuario.cls",false);
		$mdlUsuario = new usuario($this->main);
		$eliminar = $mdlUsuario->delUsuario($this->id_usuario);
		if($eliminar != 1){
			echo "ERROR: No se pudo eliminar al usuario.";
			exit();
		}
		echo "Usuario eliminado correctamente!";
		exit();
	}

  	public function render()
	{
    	return "";
  	}
}
?>
