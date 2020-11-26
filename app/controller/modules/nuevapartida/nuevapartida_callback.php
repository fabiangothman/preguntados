<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

	class nuevapartida_callback extends controller
	{
		protected function index()
		{
			//Se verifica el estado de la sesión
			$this->logged = ($this->main->session->check_session()=="open")?true:false;
			if(!$this->logged){
				$this->redirect(_MSFW_PATH_);
				exit();
			}else{
				//Array con toda la información del usuario
				$this->usuario = $this->main->usuario;
			}

			//Configuración inicial
			$this->title = _MSFW_APP_NAME_." - Nueva partida";

			//Sección que obtiene el id del usuario contra quién se jugará
			$this->id_oponente = $this->convertNullToEmpty($this->getArg("oponente"));
			if(empty($this->id_oponente)){
				//Busca oponente random
				$this->loadModel("modules/home/juegoOponente.cls", false);
				$obj_mdljuegoOponente = new juegoOponente($this->main);
				$this->id_oponente = $obj_mdljuegoOponente->obtenerOponenteRandom($this->usuario->id_usuario);
				//Si no encuentra un oponente random
				if(!$this->id_oponente){
					$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/2");
					exit();
				}
				
			}

			//Seccion encargada de crear la nueva partida
			$this->loadModel("modules/nuevapartida/nuevaspartidas.cls", false);
			$obj_mdlnuevaPartida = new nuevasPartidas($this->main);
			$this->id_partida = $obj_mdlnuevaPartida->obtener_idpartida_disponible();
			$this->partida_creada = $obj_mdlnuevaPartida->iniciar_nuevapartida($this->id_partida, $this->usuario->id_usuario);

			if($this->partida_creada){
				$this->llenado_usuarios = $obj_mdlnuevaPartida->llenar_usuarios_en_partida($this->id_partida, $this->usuario->id_usuario, $this->id_oponente);
				if($this->llenado_usuarios){
					$id_ronda = $obj_mdlnuevaPartida->id_ronda_disponible();
					//Se crea por defecto en la bd la ronda 1
					$this->ronda = $obj_mdlnuevaPartida->crear_ronda($id_ronda, $this->id_partida);
					
					if($this->ronda){
						$this->redirect(_MSFW_PATH_."modules/ruleta/ruleta/id_ronda/".$id_ronda);
						exit();
					}else{
						$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/3");
						exit();
					}					
				}else{
					$obj_mdlnuevaPartida->borrar_partida($this->id_partida);
					$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/3");
					exit();
				}
			}else{
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/3");
				exit();
			}
		}

		public function render()
		{
			return "";
		}
	}
?>
