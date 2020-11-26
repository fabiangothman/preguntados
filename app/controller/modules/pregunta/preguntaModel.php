<?php
	/****************************************************************************
	*	Desarrollado por: Fabián Murillo, fabianmurillo.01@gmail.com			*
	*					  Juan Suárez, juancsuarezg@correo.udistrital.edu.co	*
	*					  © 2017												*
	****************************************************************************/

	class preguntaModel extends controller
	{
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

			//Valida que existan y esten llenas las variables recibidas del ajax
			$this->getFormData("accion", false);
			$this->getFormData("id_pregunta", false);
			$this->getFormData("id_respuesta", false);
			$this->getFormData("id_ronda", false);
			if(!isset($this->accion) || ($this->convertNullToEmpty($this->accion)=="") || !isset($this->id_pregunta) || ($this->convertNullToEmpty($this->id_pregunta)=="") || !isset($this->id_respuesta) || !isset($this->id_ronda) || ($this->convertNullToEmpty($this->id_ronda)=="")){
				echo false;
				exit();
			}

			//Variable usada para mandar de retorno al js/ajax la respuesta más los 'echo's, ó solo la respuesta.
			//Es necesario descomentariar el console.log de la funcion validarRespuesta() del pregunta.js
			$validador_de_retorno = false;
			$ret_prueba = "";

			if($this->accion=="validarRespuesta"){
				//Guarda la respuesta contestada
				$this->loadModel("modules/pregunta/preguntas.cls", false);
				$obj_mdlPreguntas = new preguntas($this->main);

				//Guarda la respuesta del usuario a la pregunta
				$usu_preg = $obj_mdlPreguntas->guardar_usuario_pregunta($this->usuario->id_usuario, $this->id_pregunta, $this->convertNullToEmpty($this->id_respuesta), $this->id_ronda);
				if($usu_preg){

					$this->loadModel("modules/home/partidas.cls",false);
					$obj_mdlPartidas = new partidas($this->main);
					$id_partida = $obj_mdlPartidas->get_id_partida($this->id_ronda);

					$this->loadModel("modules/ruleta/ruletainfo.cls",false);
					$obj_mdlRuleta = new ruletaInfo($this->main);

					//Cuando guarde la respuesta, debe validar si fue correcta para sumar barra y validar las categorias, o si fue falsa para crear nueva ronda en caso de ser el segundo en responder y cambiar la id_usuario_respondiendo a la del oponene
					//Retorna el resultado de la respuesta para el view/js
					//La respuesta a la pregunta es correcta
					$respuesta_correcta = $obj_mdlPreguntas->validar_respuesta($this->id_pregunta, $this->id_respuesta);
					if($respuesta_correcta=="verdadera"){

						
						$contador_barra = $obj_mdlRuleta->obtener_estado_barra($id_partida, $this->usuario->id_usuario);

						//Significa que el contador es tres por lo cual ganará la categoría
						if($contador_barra>=3){
							//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
							$ret_prueba .= "entra_1_";

							//Vuelve a 0 el estado del contador_barra ya que con esta respuesta el contador sería 4
							$obj_mdlRuleta->set_estado_barra($id_partida, $this->usuario->id_usuario, 0);

							//Obtiene el estado de las categorias ganadas
							$categorias_ganadas = $obj_mdlRuleta->obtener_numero_categ_ganadas($id_partida, $this->usuario->id_usuario);
							//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
							$ret_prueba .= "categorias_ganadas_".$categorias_ganadas."_";


							($categorias_ganadas=="0") ? $categorias_ganadas = 0 : $categorias_ganadas = $categorias_ganadas;

							//Obtiene la categoria de la pregunta respondida, la cual es la categoría que seleccionó para competir
							$id_nueva_categ_ganada = $obj_mdlPreguntas->get_id_nueva_categ_ganada($this->id_pregunta);
							//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
							$ret_prueba .= "entra_2_";


							//Significa que estando en 5 cat ganadas, con esta nueva serían las 6 categorias
							if($categorias_ganadas>=5){
								//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
								$ret_prueba .= "entra_3_";

								//Almacena la nueva categoria ganada, y pone fecha de fin a la partida
								if($obj_mdlPreguntas->almacenar_nueva_categoria_ganada($id_nueva_categ_ganada, $this->usuario->id_usuario, $this->id_ronda)){
									//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
									$ret_prueba .= "entra_4_";

									//Solo si yo NO soy usuario local puedo finalizar partida, ya que visitante tiene la oportunidad de responder
									//Lo que hago es cambiar de turno para dar la oportunidad al oponente de alcanzarme y/o ganar(empatar)
									if($obj_mdlPartidas->es_usuario_local($this->usuario->id_usuario, $id_partida)){
										//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
										$ret_prueba .= "entra_5_";

										$id_oponente = $obj_mdlPartidas->get_oponente_partida($this->usuario->id_usuario, $id_partida)['id'];
										$obj_mdlPartidas->cambiar_id_usuario_respondiendo($id_partida, $id_oponente);
										//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
										$ret_prueba .= "entra_6_";

										$respuesta_correcta .= "_espera";
									}else{
										//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
										$ret_prueba .= "entra_7_";

										$obj_mdlPartidas->set_fecha_fin_partida($id_partida);
										//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
										$ret_prueba .= "entra_8_";

										$respuesta_correcta .= "_completa";
									}
									
									//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
									$ret_prueba .= "entra_9_";

								}else{
									//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
									$ret_prueba .= "entra_10_";

									$obj_mdlRuleta->set_estado_barra($id_partida, $this->usuario->id_usuario, $contador_barra);
									//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
									$ret_prueba .= "entra_11_";

								}

							}else{
								//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
								$ret_prueba .= "entra_12_";

								//Almacena la nueva categoria ganada, si no la puede almacenar, no suma el contador
								if(!$obj_mdlPreguntas->almacenar_nueva_categoria_ganada($id_nueva_categ_ganada, $this->usuario->id_usuario, $this->id_ronda)){
									//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
									$ret_prueba .= "entra_13_";

									$obj_mdlRuleta->set_estado_barra($id_partida, $this->usuario->id_usuario, $contador_barra);
									//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
									$ret_prueba .= "entra_14_";


								}
								//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
								$ret_prueba .= "entra_15_";

							}
						}else{
							//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
							$ret_prueba .= "entra_16_";

							$obj_mdlRuleta->set_estado_barra($id_partida, $this->usuario->id_usuario, ($contador_barra+1));
							//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
							$ret_prueba .= "entra_17_";

						}
					}else{
						//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
						$ret_prueba .= "entra_18_";

						//Valida si el oponente (Si él es local y yo visitante) ya ganó la partida.
						//Obtiene el estado de las categorias ganadas por el oponente
						$id_oponente = $obj_mdlPartidas->get_oponente_partida($this->usuario->id_usuario, $id_partida)['id'];
						$categorias_ganadas_oponente = $obj_mdlRuleta->obtener_numero_categ_ganadas($id_partida, $id_oponente);
						if($categorias_ganadas_oponente>=6){
							//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
							$ret_prueba .= "entra_19_";

							$obj_mdlPartidas->set_fecha_fin_partida($id_partida);
							//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
							$ret_prueba .= "entra_20_";

							$respuesta_correcta .= "_completa";

						}else{
							//Si se equivoca en la respuesta, se cambia la id_usuario_respndiendo al oponente y si soy usuario visitante creo la siguiente ronda
						
							$obj_mdlPartidas->cambiar_id_usuario_respondiendo($id_partida, $id_oponente);
							//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
							$ret_prueba .= "entra_21_";

							if(!$obj_mdlPartidas->es_usuario_local($this->usuario->id_usuario, $id_partida)){
								$obj_mdlPartidas->crear_siguiente_ronda($this->id_ronda);
								//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
								$ret_prueba .= "entra_22_";
							}
							//(( -> Retorno de prueba configurado en variable $validador_de_retorno. ))
							$ret_prueba .= "entra_23_";
						}

						

					}

					echo ($validador_de_retorno) ? $ret_prueba.$respuesta_correcta : $respuesta_correcta;
					exit();
					
				}
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
