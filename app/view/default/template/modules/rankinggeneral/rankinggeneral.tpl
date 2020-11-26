<div id="rankinggeneral_container">
	<div class="page_content">


		<!--	REPORTE DE ERRORES	-->
		<div class="alertsContainer">
			<?php if(isset($exito)&&($exito != '')){ ?>
				<div class="alert alert-success alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
					<?php echo utf8_encode($exito); ?>
				</div>
			<?php } ?>
			<?php if(isset($peligro)&&($peligro != '')){ ?>
				<div class="alert alert-danger alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
					<?php echo utf8_encode($peligro); ?>
				</div>
			<?php } ?>
			<?php if(isset($info)&&($info != '')){ ?>
				<div class="alert alert-info alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
					<?php echo utf8_encode($info); ?>
				</div>
			<?php } ?>
			<?php if(isset($alerta)&&($alerta != '')){ ?>
				<div class="alert alert-warning alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
					<?php echo utf8_encode($alerta); ?>
				</div>
			<?php } ?>
		</div>


		<!--	INICIA LA MAQUETACIÓN DEL MÓDULO	-->
		<div class="contenedor_area">
			<!--	LA CLASE (RESPOSIVE O ESCRITORIO) SE PONE AUTOMÁTICAMENTE SEGÚN EL TAMAÑO DE PANTALLA. JQUERY	-->
			<div id="tipo_visualizacion" class="">

				<div class="rank_cont">
					<div class="titulo_cont">
						<div class="titulo">
							<div class="texto">RANKING GLOBAL DE JUGADORES</div>
						</div>
					</div>

					<div class="tabla_cont">
						<div class="tabla">

							<div class="column left_col">
								<div class="cont_col cont_left">
									<div class="tbl_titu_cont">
										<div class="titl_area">
											<div class="texto">Resultados</div>
										</div>
									</div>
									<div class="tbl_list_cont">
										<div class="list_area">
											<div class="cont_info">
												<?php if(!empty(isset($listado_jugadores[0]))){ ?>
													<?php foreach($listado_jugadores as $valor => $jugador){ ?>
													<div class="info_jugador<?php echo ($usuario->id_usuario == $jugador['id_usuario']) ? ' mi_area' : ''; ?>" id="<?php echo $jugador['id_usuario']; ?>">
														<div class="cont_posicion">
															<div class="posicion"><?php echo ($valor+1); ?></div>
														</div>
														<div class="cont_foto">
															<div class="foto">
																<img src="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/perfil/profilepics/'.utf8_decode($jugador['foto']); ?>" width="100%" height="100%" />
															</div>
														</div>
														<div class="cont_user_data">
															<div class="cont_user">
																<div class="prueba">
																	<div class="nombre"><?php echo utf8_decode($jugador['nombres']); ?></div>
																	<div class="apellido"><?php echo utf8_decode($jugador['apellidos']); ?></div>
																	<div class="correo"><?php echo utf8_decode($jugador['email']); ?></div>
																</div>
															</div>
														</div>
													</div>
													<hr class="divisorInfo" />
													<?php } ?>
												<?php }else{ ?>
												<div class="no_listado">No hay ningún usuario/administrador cargado en la aplicación.</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="column right_col">
								<div class="cont_col cont_right">
									<div class="tbl_titu_cont">
										<div class="titl_area">
											<div class="texto">Correctas</div>
										</div>
									</div>
									<div class="tbl_list_cont">
										<div class="list_area">
											<div class="cont_info">
												<?php if(!empty(isset($listado_jugadores[0]))){ ?>
													<?php foreach($listado_jugadores as $valor => $jugador){ ?>
													<div class="info_juegos<?php echo ($usuario->id_usuario == $jugador['id_usuario']) ? ' mi_area' : ''; ?>">
														<div class="cont_acertadas">
															<div class="acertadas"><?php echo utf8_decode($jugador['resp_correctas']); ?></div>
														</div>
														<div class="cont_partidas">
															<div class="partidas"><?php echo utf8_decode($jugador['partidas_participadas']); ?> partidas</div>
														</div>
													</div>
													<hr class="divisorInfo" />
													<?php } ?>
												<?php }else{ ?>
												<div class="no_listado">--</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>
		<!--	FINALIZA LA MAQUETACIÓN DEL MÓDULO	-->
	</div>
</div>