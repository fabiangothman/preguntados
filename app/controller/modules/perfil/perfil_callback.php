<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

class perfil_callback extends controller
{
	private $usuario;

	protected function index()
	{
		//Se verifica el estado de la sesión
		$this->logged = ($this->main->session->check_session()=="open")?true:false;
		if(!$this->logged){
			echo "Error, por favor inicie sesión.";
			exit();
		}else{
			//Array con toda la información del usuario
			$this->usuario = $this->main->usuario;
		}

		//Garantiza que se ha seleccionado una foto para cargar, sino NO cambia la foto
		if(isset($_FILES['subefoto']) && (!empty($_FILES['subefoto']['name'])) && (($_FILES['subefoto']['type'] == 'image/jpeg') || ($_FILES['subefoto']['type'] == 'image/png') || ($_FILES['subefoto']['type'] == 'image/gif'))){

			$profilepics = _UPLOAD_PROFILE_PIC_."modules/perfil/profilepics/";
			$imageTemp = $_FILES['subefoto'];

			$nombre = $imageTemp['tmp_name'];
			$extension = pathinfo($imageTemp['name'], PATHINFO_EXTENSION);

			//Mueve la imagen subida temporalmente a la carpeta profilepics, con el nombre del id y etension original
			//Se forza a guardarla como .png para evitar duplicidad en la carpeta profilepics, por las extensiones
			move_uploaded_file($nombre, $profilepics.$this->usuario->id_usuario."."."png");
		}

		// Recuperación de datos del perfil
		$this->getFormData("codigo", false);
		$this->getFormData("nombres", false);
		$this->getFormData("apellidos", false);
		$this->getFormData("id_grupo", false);
			
		$this->loadModel("modules/perfil/mperfil.cls", false);
		$obj_mdlPerfil = new mPerfil($this->main);

		//Obtiene los datos completos del jugador en curso
		$actualiza = $obj_mdlPerfil->actualizar_datos($this->usuario->id_usuario, $this->codigo, $this->nombres, $this->apellidos, $this->id_grupo);

		if($actualiza){
			//Redirige al perfil mostrando mensaje de exito
			$this->redirect(_MSFW_PATH_."modules/perfil/perfil/mensaje/2/");
			exit();	
		}

		//Redirige al perfil mostrando mensaje de error
		$this->redirect(_MSFW_PATH_."modules/perfil/perfil/mensaje/1/");
		exit();		
  }
	
	

  public function render()
	{
    return "";
  }
}
?>
