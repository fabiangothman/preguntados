<?php
	/****************************************************************************
	*	Desarrollado por: Fabi�n Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Su�rez, juancsuarezg@correo.udistrital.edu.co	*
	*					  � 2017												*
	****************************************************************************/

	class homeModel extends controller
	{
		protected function index()
		{
			//Se verifica el estado de la sesi�n
			$this->logged = ($this->main->session->check_session()=="open")?true:false;
			if(!$this->logged){
				echo "Error, por favor inicie sesi�n.";
				exit();
			}else{
				//Array con toda la informaci�n del usuario
				$this->usuario = $this->main->usuario;
			}
			$this->getFormData("accion", false);


			//Acciones para encontrar usuarios con los que competir mediante el ajax
			$this->loadModel("modules/home/juegoOponente.cls",false);
			$obj_mdljuegoOponente = new juegoOponente($this->main);
			if($this->accion=="buscarIdOponente"){
				$this->getFormData("id_oponente", false);
				echo $obj_mdljuegoOponente->buscarIdOponente($this->id_oponente);
				exit();
			}
			if($this->accion=="busqueda"){
				$this->getFormData("cadena_buscar", false);
				$this->getFormData("mi_id_usuario", false);
				echo json_encode($obj_mdljuegoOponente->obtenerUsuarioBySearch($this->cadena_buscar, $this->mi_id_usuario));
				exit();
			}


			//Acciones para actualizar el home mediante ajax
			if($this->accion=="actualizarHome"){
				//Obtiene los datos de mis partidas del home
				$this->loadModel("modules/home/partidas.cls",false);
				$obj_mdlPartidas = new partidas($this->main);

				$partidas_activas = $obj_mdlPartidas->turnos($this->usuario->id_usuario);
				$partidas_historial = $obj_mdlPartidas->historial_partidas($this->usuario->id_usuario);

				$respuesta = array(
					'partidas_activas' => $partidas_activas,
					'partidas_historial' => $partidas_historial
				);


				echo json_encode($respuesta);
				exit();
			}

			echo false;
			exit();

		}

		public function render()
		{
			return "";
		}
	}
?>
