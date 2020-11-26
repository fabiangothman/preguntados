<div id="historial_container">
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
							<div class="texto">HISTORIAL DE PARTIDAS</div>
						</div>
					</div>

					<div class="tabla_cont">
						<div class="tabla">

							<div class="column left_col">
								<div class="cont_col cont_left">

									<div class="tbl_titu_cont_curso">
										<div class="titl_area">
											<div class="texto">Partidas activas</div>
										</div>
									</div>
									<div class="tbl_list_cont activas">
										<div class="list_area">
											<div class="cont_info">
												<?php if(!empty(isset($partidas_activas[0]))){ ?>
													<?php foreach($partidas_activas as $valor => $partida){ ?>
													<div class="info_jugador link_continuar" onclick=MSHistorial.navegar("<?php echo utf8_decode($partida['link_continuar']); ?>"); >
														<div class="cont_foto">
															<div class="foto">
																<img src="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/perfil/profilepics/'.utf8_decode($partida['foto_oponente']); ?>" width="100%" height="100%" />
															</div>
														</div>
														<div class="cont_user_data">
															<div class="cont_user">
																<div class="nombres"><?php echo utf8_decode($partida['nombre_oponente']); ?></div>
																<div class="ronda">Ronda <?php echo utf8_decode($partida['ronda']); ?></div>
																<div class="iniciado"><?php echo utf8_decode($partida['fecha_inicio']); ?></div>
															</div>
														</div>
														<div class="cont_marcador">
															<div class="marcador"><?php echo utf8_decode($partida['categorias_local']); ?> - <?php echo utf8_decode($partida['categorias_visitante']); ?></div>
														</div>
													</div>
													<hr class="divisorInfo" />
													<?php } ?>
												<?php }else{ ?>
												<div class="no_listado">No hay ninguna partida activa en la aplicación.</div>
												<?php } ?>
											</div>
										</div>
									</div>

									<div class="tbl_titu_cont_fin">
										<div class="titl_area">
											<div class="texto">Partidas finalizadas</div>
										</div>
									</div>
									<div class="tbl_list_cont finalizadas">
										<div class="list_area">
											<div class="cont_info">
												<?php if(!empty(isset($partidas_historial[0]))){ ?>
													<?php foreach($partidas_historial as $valor => $partida){ ?>
													<div class="info_jugador link_continuar" onclick=MSHistorial.navegar("<?php echo utf8_decode($partida['link_continuar']); ?>"); >
														<div class="cont_foto">
															<div class="foto">
																<img src="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/perfil/profilepics/'.utf8_decode($partida['foto_oponente']); ?>" width="100%" height="100%" />
															</div>
														</div>
														<div class="cont_user_data">
															<div class="cont_user">
																<div class="nombres"><?php echo utf8_decode($partida['nombre_oponente']); ?></div>
																<div class="ronda">Ronda <?php echo utf8_decode($partida['ronda']); ?></div>
																<div class="iniciado"><?php echo utf8_decode($partida['fecha_inicio']); ?></div>
																<div class="finalizado"><?php echo utf8_decode($partida['fecha_fin']); ?></div>
															</div>
														</div>
														<div class="cont_marcador">
															<div class="marcador"><?php echo utf8_decode($partida['categorias_local']); ?> - <?php echo utf8_decode($partida['categorias_visitante']); ?></div>
														</div>
													</div>
													<hr class="divisorInfo" />
													<?php } ?>
												<?php }else{ ?>
												<div class="no_listado">No hay ninguna partida finalizada en la aplicación.</div>
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