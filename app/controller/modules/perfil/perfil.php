<?php
	/****************************************************************************
	*	Desarrollado por: Fabi�n Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Su�rez, juancsuarezg@correo.udistrital.edu.co	*
	*					  � 2017												*
	****************************************************************************/

	class perfil extends controller
	{
		protected function index()
		{
			//Se verifica el estado de la sesi�n
			$this->logged = ($this->main->session->check_session()=="open")?true:false;
			if(!$this->logged){
				$this->redirect(_MSFW_PATH_);
				exit();
			}else{
				//Array con toda la informaci�n del usuario
				$this->usuario = $this->main->usuario;
			}

			//Configuraci�n inicial
			$this->title = _MSFW_APP_NAME_." - Home";
			//Carga los mensajes entrantes
			$this->loadError();

			$this->loadModel("modules/perfil/mperfil.cls", false);
			$obj_mdlPerfil = new mPerfil($this->main);

			//Obtiene los datos completos del jugador en curso
			$tmp_jugador = $obj_mdlPerfil->traer_datos_jugador($this->usuario->id_usuario);
			//Arma un nuevo array de jugador con los datos adicionales requeridos para el tpl
			$jugador = array();
			if(!empty(isset($tmp_jugador))){

				$jugador = array(
					'id_usuario' => $tmp_jugador['id_usuario'],
					'foto' => ($this->verificar_cache()) ? $this->obtener_foto_usuario_cache($tmp_jugador['id_usuario']) : $this->obtener_foto_usuario($tmp_jugador['id_usuario']),
					'identificacion' => $tmp_jugador['identificacion'],
					'codigo' => $tmp_jugador['codigo'],
					'nombres' => $tmp_jugador['nombres'],
					'apellidos' => $tmp_jugador['apellidos'],
					'email' => $tmp_jugador['email'],
					'id_grupo' => $tmp_jugador['id_grupo']
				);

			}
			$this->jugador = $jugador;

			$this->grupos = $obj_mdlPerfil->obtener_grupos();
			
			
			//Carga todos los archivos requeridos en el view
			$this->addjQueryScript(true, "jquery-1.8.2.min", "jQuery182");
			$this->addScript(true, "perfil/perfil");
			$this->addScript(true, "bootstrap/bootstrap");
			$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
			$this->addStyle("modules/perfil/perfil", "stylesheet", "screen");
			$this->addInReadyCode("
				MSPerfil.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', $(window).width());
				$(window).resize(function() {
				  MSPerfil.cambiar_responsive($(window).width());
				});
			");
		}

		private function loadError()
		{
			//Se cargan los posibles mensajes a enviar al view, seg�n la variable
			$this->exito = "";
			$this->peligro = "";
			$this->info = "";
			$this->alerta = "";
			switch($this->convertNullToEmpty($this->getArg("mensaje")))
			{
				case "1":
					$this->peligro = "Ocurri� un error al intentar actualizar la informaci�n.";
					break;
				case "2":
					$this->exito = "Se ha actualizado la informaci�n con �xito.";
					break;
				default:
					$this->info = null;
					break;
			}
		}


		//C�digo adicionado para ejecutar funci�n de imagen con cach�, solo cuando se halla retornado un mensaje (puesto que con un mensaje se da por enterado que se acab� de actualizar)
		private function verificar_cache()
		{
			$mensaje = $this->convertNullToEmpty($this->getArg("mensaje"));

			if(empty($mensaje)){
				return false;
			}else{
				return true;
			}
		}

		//Busca en la carpeta de profilepic la imagen que tenga el mismo nombre que la id de usuario y la retorna, de lo contrario retorna la default
		//La imagen se retorna con cach� por lo que puede que no se actualice inmediatamente
		private function obtener_foto_usuario($id_usuario){
			$existe_foto_usr = glob("app/view/default/_img/modules/perfil/profilepics/".$id_usuario.".*");
			
			if(!empty(isset($existe_foto_usr[0]))){
				$ext = pathinfo($existe_foto_usr[0], PATHINFO_EXTENSION);
				if(($ext=="png")||($ext=="jpg")||($ext=="gif"))
					return $id_usuario.".".$ext;
				else
					return "default.png";
			}else{
				return "default.png";
			}
		}

		//Busca en la carpeta de profilepic la imagen que tenga el mismo nombre que la id de usuario y la retorna, de lo contrario retorna la default
		//La imagen se retorna sin cach� para que se actualice inmediatamente
		private function obtener_foto_usuario_cache($id_usuario){
			$existe_foto_usr = glob("app/view/default/_img/modules/perfil/profilepics/".$id_usuario.".*");
			
			if(!empty(isset($existe_foto_usr[0]))){
				$ext = pathinfo($existe_foto_usr[0], PATHINFO_EXTENSION);
				if(($ext=="png")||($ext=="jpg")||($ext=="gif"))
					return $id_usuario.".".$ext."?".time();
				else
					return "default.png?".time();
			}else{
				return "default.png?".time();
			}
		}

		public function render()
		{
			return $this->printView("modules/perfil/perfil");
		}
	}
?>
