<?php
	/****************************************************************************
	*	Desarrollado por: Fabi�n Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Su�rez, juancsuarezg@correo.udistrital.edu.co	*
	*					  � 2017												*
	****************************************************************************/

class login_callback extends controller
{
	private $usuario;

	protected function index()
	{
		// Recuperaci�n de datos del login
		$this->getFormData("email", false);
		$this->getFormData("contrasena", false);
		/*
		// Carga validador de datos
		$this->loadServerFormValidator();
		$validator = new FormValidator();
	    $validator->addValidation("email","email","El correo electr�nico es obligatorio");
	    $validator->addValidation("contrasena","req","La contrase�a es obligatoria");

	   	//Verificaci�n de validaci�n
	    if(!$validator->ValidateForm()){
	    	$this->redirect(_MSFW_PATH_."modules/login/login/mensaje/2/email/$this->email");
	    	exit();
	    }
	    */
			
		// Carga de modelo de usuario
		$this->loadModel("common/mdlusuario.cls",false);
		
		// Se verifica el inicio de sesi�n con los datos proporcionados
		$this->usuario = new usuario($this->main, "login_admin", $this->email, $this->contrasena, "");

		if(isset($this->usuario->id_usuario))
		{
			// Se inicia sesi�n
			$this->main->session->login($this->usuario);
		}else{
			// Se redirige al login y se muestra mensaje de error de autenticaci�n
			$this->redirect(_MSFW_PATH_."modules/login/login/mensaje/3/email/$this->email");
			exit();
		}

		// Redirige al Home
		$this->redirect(_MSFW_PATH_."modules/home/home");
		exit();		
  }
	
	

  public function render()
	{
    return "";
  }
}
?>
