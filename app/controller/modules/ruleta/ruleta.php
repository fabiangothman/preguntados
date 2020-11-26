<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

	class ruleta extends controller
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
			//Carga los mensajes entrantes
			$this->loadError();

			//Obtiene el id_ronda de la partida que se jugará
			$id_ronda = $this->convertNullToEmpty($this->getArg("id_ronda"));
			if(empty($id_ronda)){
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/9");
				exit();
			}

			//Obtiene el id_partida de la partida mediante su id_ronda
			$this->loadModel("modules/ruleta/ruletainfo.cls", false);
			$obj_mdlruleta = new ruletaInfo($this->main);
			$id_partida = $obj_mdlruleta->get_id_partida_by_ronda($id_ronda);
			if(empty($id_partida) || !($id_partida)){
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/4");
				exit();
			}

			//Obtiene los dos jugadores de la partida, el local y el visitante
			$this->usu_local = $obj_mdlruleta->obtener_usuario_local($id_partida);
			$this->usu_visitante = $obj_mdlruleta->obtener_usuario_visitante($id_partida);

			if(!($this->usu_local) || !($this->usu_visitante)){
				$this->redirect(_MSFW_PATH_."modules/home/home/mensaje/5");
				exit();
			}

			//Valida permisos de acceso a la ruleta para los usuarios
			//Está restringido si NO es mi turno o si YA finalizó la partida
			$id_usu_respondiendo = $obj_mdlruleta->get_id_usua_respondiendo($id_partida);
			$this->acceso_concedido = false;
			if($obj_mdlruleta->partida_en_proceso($id_partida)){
				if($id_usu_respondiendo == $this->usuario->id_usuario){
					$this->acceso_concedido = true;
				}else{
					$this->acceso_concedido = false;
					$this->loadErrorPermisos("1");
				}
			}else{
				$this->acceso_concedido = false;
				$this->loadErrorPermisos("2");
			}
			$enviar_permisos_js = ($this->acceso_concedido) ? 1 : 0;

			$this->foto_local = $this->obtener_foto_usuario($this->usu_local["id"]);
			$this->foto_visitante = $this->obtener_foto_usuario($this->usu_visitante["id"]);

			//Obtiene todas las categorias
			$todas_categorias = $obj_mdlruleta->obtener_categorias();

			//Obtiene el nombre de las categorias en un array para pasarlo al js
			$tmp_nombre_categorias = $obj_mdlruleta->obtener_nombre_categorias();
			$nombre_categorias = array();
			foreach ($tmp_nombre_categorias as $valor => $categoria){
				array_push($nombre_categorias, utf8_decode($categoria['nombre']));
			}
			$nombre_categorias = json_encode($nombre_categorias);
			//echo $nombre_categorias;

			//Obtiene el nombre de los avatares de las categorias en un array para pasarlo al js
			$tmp_nombre_avatar = $obj_mdlruleta->obtener_nombre_avatar_categorias();
			$nombre_avatar = array();
			foreach ($tmp_nombre_avatar as $valor => $categoria){
				array_push($nombre_avatar, utf8_decode($categoria['avatar']));
			}
			$nombre_avatar = json_encode($nombre_avatar);
			//echo $nombre_avatar;

			//Obtiene las categorias ganadas por el usuario local en esta partida
			$categ_loc_ganadas = $obj_mdlruleta->obtener_categorias_ganadas($id_ronda, $this->usu_local["id"]);
			$ids_categoria_local = array();
			//Recorre todas las categorias en busca de aquellas ya ganadas
			foreach ($todas_categorias as $numeroCategoria => $categoria){
				if(empty($categ_loc_ganadas)){
					$ids_categoria_local[$numeroCategoria+1]['id_categoria']=$categoria["id_categoria"];
					$ids_categoria_local[$numeroCategoria+1]['nombre']=$categoria["nombre_avatar"];
					$ids_categoria_local[$numeroCategoria+1]['clase']="_off";
				}else{
					foreach ($categ_loc_ganadas as $numeroGanada => $categoria_ganada){
						if($categoria["id_categoria"]==$categoria_ganada["id_categoria"]){
							$ids_categoria_local[$numeroCategoria+1]['id_categoria']=$categoria["id_categoria"];
							$ids_categoria_local[$numeroCategoria+1]['nombre']=$categoria["nombre_avatar"];
							$ids_categoria_local[$numeroCategoria+1]['clase']="_on";
							break;
						}else{
							$ids_categoria_local[$numeroCategoria+1]['id_categoria']=$categoria["id_categoria"];
							$ids_categoria_local[$numeroCategoria+1]['nombre']=$categoria["nombre_avatar"];
							$ids_categoria_local[$numeroCategoria+1]['clase']="_off";
						}
					}
				}
			}
			$this->ids_categoria_local = $ids_categoria_local;

			//Obtiene las categorias ganadas por el usuario visitante en esta partida
			$categ_visi_ganadas = $obj_mdlruleta->obtener_categorias_ganadas($id_ronda, $this->usu_visitante["id"]);
			$ids_categoria_visitante = array();
			//Recorre todas las categorias en busca de aquellas ya ganadas
			foreach ($todas_categorias as $numeroCategoria => $categoria){
				if(empty($categ_visi_ganadas)){
					$ids_categoria_visitante[$numeroCategoria+1]['id_categoria']=$categoria["id_categoria"];
					$ids_categoria_visitante[$numeroCategoria+1]['nombre']=$categoria["nombre_avatar"];
					$ids_categoria_visitante[$numeroCategoria+1]['clase']="_off";
				}else{
					foreach ($categ_visi_ganadas as $numeroGanada => $categoria_ganada){
						if($categoria["id_categoria"]==$categoria_ganada["id_categoria"]){
							$ids_categoria_visitante[$numeroCategoria+1]['id_categoria']=$categoria["id_categoria"];
							$ids_categoria_visitante[$numeroCategoria+1]['nombre']=$categoria["nombre_avatar"];
							$ids_categoria_visitante[$numeroCategoria+1]['clase']="_on";
							break;
						}else{
							$ids_categoria_visitante[$numeroCategoria+1]['id_categoria']=$categoria["id_categoria"];
					$ids_categoria_visitante[$numeroCategoria+1]['nombre']=$categoria["nombre_avatar"];
					$ids_categoria_visitante[$numeroCategoria+1]['clase']="_off";
						}
					}
				}
			}
			$this->ids_categoria_visitante = $ids_categoria_visitante;


			//Obtiene la barra de preguntas correctas respondidas por el usuario para poder ganar categoria
			$this->contador_barra = $obj_mdlruleta->obtener_estado_barra($id_partida, $this->usuario->id_usuario);
			
			//Carga todos los archivos requeridos en el view
			$this->addjQueryScript(true, "jquery-1.8.2.min", "jQuery182");
			$this->addjQueryScript(true, "jquery-3.2.1.slim.min.js", "jQuerySlim");
			
			$this->addScript(true, "bootstrap/bootstrap");
			$this->addScript(true, "ruleta/winwheel.min.js");
			$this->addScript(true, "ruleta/tweenMax.min.js");
			//$this->addScript(true, "ruleta/sweetalert.min.js");
			//$this->addScript(true, "jquery.fancybox.min.js");
			$this->addScript(true, "sweetalert2.min.js");
			$this->addScript(true, "ruleta/ruleta");

			$this->addStyle("common/bootstrap/bootstrap", "stylesheet", "screen");
			//$this->addStyle("modules/ruleta/sweetalert", "stylesheet", "screen");
			//$this->addStyle("common/jquery.fancybox.min", "stylesheet", "screen");
			$this->addStyle("common/sweetalert2.min", "stylesheet", "screen");
			$this->addStyle("common/bootstrap/bootstrap.min", "stylesheet", "screen");
			$this->addStyle("modules/ruleta/ruleta", "stylesheet", "screen");

			$this->addInReadyCode("
				MSRuleta.init('"._MSFW_PATH_."', '"._MODEL_PATH_."', '"._VIEW_PATH_."', '".$nombre_categorias."', '".$nombre_avatar."', ".$id_ronda.", ".$this->contador_barra.", ".$enviar_permisos_js.", $('#body').width());
				MSRuleta.leerElementos();
				$(window).resize(function() {
					MSRuleta.cambiar_responsive($('#body').width());
				});
			");
		}

		private function loadError()
		{
			//Se cargan los posibles mensajes a enviar al view, según la variable
			$this->exito = "";
			$this->peligro = "";
			$this->info = "";
			$this->alerta = "";
			switch($this->convertNullToEmpty($this->getArg("mensaje")))
			{
				case "1":
					$this->exito = "";
					break;
				case "2":
					$this->peligro = "";
					break;
				case "3":
					$this->info = "";
					break;
				default:
					$this->alerta = null;
					break;
			}
		}

		private function loadErrorPermisos($permiso)
		{
			//Se cargan los posibles mensajes a enviar al view, según la variable
			$this->exito = "";
			$this->peligro = "";
			$this->info = "";
			$this->alerta = "";
			switch($permiso)
			{
				case "1":
					$this->peligro = "No es su turno, debe esperar a que el usuario oponente conteste.";
					break;
				case "2":
					$this->peligro = "La partida se encuentra finalizada.";
					break;
				default:
					$this->alerta = null;
					break;
			}
		}

		//Busca en la carpeta de profilepic la imagen que tenga el mismo nombre que la id de usuario y la retorna, de lo contrario retorna la default
		//La imagen se retorna con caché por lo que puede que no se actualice inmediatamente
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
		//La imagen se retorna sin caché para que se actualice inmediatamente
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

		private function utf8ize($d) {
		    if (is_array($d)) {
		        foreach ($d as $k => $v) {
		            $d[$k] = $this->utf8ize($v);
		        }
		    } else if (is_string ($d)) {
		        return utf8_encode($d);
		    }
		    return $d;
		}

		public function render()
		{
			return $this->printView("modules/ruleta/ruleta");
		}
	}
?>
