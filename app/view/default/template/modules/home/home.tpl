<div id="home_container">
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
			<div id="tipo_visualizacion" class="areaNavegacionResponsive">
				<div class="secciones">
					<div class="seccion seccionBotonera">
						<div class="nueva_partida">
							<!--	SE DEJA SIN ENTER EL DIV->COLUMNA PARA QUE NO TOME ESPACIOS EN MOZILLA	-->
							<div class="cont_btn cont_btnpartida">
								<div class="cont_area_opc">
									<div class="btn_partida btn_partida_aleat hh1" onclick="MSHome.navegarAleatoria('<?php echo $nueva_partida; ?>');">
										<img src="<?php echo _MSFW_PATH_._VIEW_PATH_; ?>default/_img/modules/home/play_.png" class="btn_play" width="64" height="auto" />
										<div class="texto_btn_play">Iniciar partida aleatoria</div>
									</div>
								</div>
							</div><div class="cont_btn cont_btnpartida_aleatorio">
								<div class="cont_area_opc">
									<div class="btn_partida btn_partida_opone hh1" onclick="MSHome.navegarOponente('<?php echo $nueva_partida; ?>');">
										<img src="<?php echo _MSFW_PATH_._VIEW_PATH_; ?>default/_img/modules/home/play_.png" class="btn_play" width="64" height="auto" />
										<div class="texto_btn_play">Iniciar partida con</div>
									</div>
									<div id="cont_buscar_usuario" class="buscar_usuario">
										<input type="text" id="buscar_usuario" id_oponente="" value="" onkeyup="MSHome.buscarOponente(this.value, <?php echo utf8_decode($usuario->id_usuario); ?>)" />
										<div id="resultadosBusqueda"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="seccion">
						<div id="area_miturno">
							<?php if(!empty(isset($partidas_mi_turno[0]))){ ?>
							<div class="cont_titulo">
								<div class="titulo">Mi turno</div>
							</div>
							<div class="cont_cuerpo">
								<?php foreach($partidas_mi_turno as $valor => $partida){ ?>
								<div class="cuerpo link_continuar" onclick=MSHome.navegar("<?php echo utf8_decode($partida['link_continuar']); ?>");>
									<!--	SE DEJA SIN ENTER EL DIV->COLUMNA PARA QUE NO TOME ESPACIOS EN MOZILLA	-->
									<div class="columna col_foto">
										<div class="foto">
											<img src="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/perfil/profilepics/'.utf8_decode($partida['foto_oponente']); ?>" width="50" height="50" />
										</div>
									</div><div class="columna col_inform">
										<div class="inform">
											<div class="linea_info nombre_oponente">
												<span><?php echo utf8_decode($partida['nombre_oponente']); ?></span>
											</div>
											<div class="linea_info ronda">
												<span>Ronda <?php echo utf8_decode($partida['ronda']); ?></span>
											</div>
											<div class="linea_info fecha_creacion">
												<span>Iniciado el <?php echo utf8_decode($partida['fecha_inicio']); ?></span>
											</div>
										</div>
									</div><div class="columna col_marcador">
										<div class="marcador">
											<span><?php echo utf8_decode($partida['categorias_local']); ?> - <?php echo utf8_decode($partida['categorias_visitante']); ?></span>
										</div>
									</div>									
								</div>
								<?php } ?>
							</div>
							<div class="espaciador"></div>
							<?php } ?>
						</div>
					</div>
					<div class="seccion">
						<div id="area_suturno">
							<?php if(!empty(isset($partidas_su_turno[0]))){ ?>
							<div class="cont_titulo">
								<div class="titulo">Su turno</div>
							</div>
							<div class="cont_cuerpo">
								<?php foreach($partidas_su_turno as $valor => $partida){ ?>
								<div class="cuerpo link_continuar" onclick=MSHome.navegar("<?php echo utf8_decode($partida['link_continuar']); ?>");>
									<!--	SE DEJA SIN ENTER EL DIV->COLUMNA PARA QUE NO TOME ESPACIOS EN MOZILLA	-->
									<div class="columna col_foto">
										<div class="foto">
											<img src="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/perfil/profilepics/'.utf8_decode($partida['foto_oponente']); ?>" width="50" height="50" />
										</div>
									</div><div class="columna col_inform">
										<div class="inform">
											<div class="linea_info nombre_oponente">
												<span><?php echo utf8_decode($partida['nombre_oponente']); ?></span>
											</div>
											<div class="linea_info ronda">
												<span>Ronda <?php echo utf8_decode($partida['ronda']); ?></span>
											</div>
											<div class="linea_info fecha_creacion">
												<span>Iniciado el <?php echo utf8_decode($partida['fecha_inicio']); ?></span>
											</div>
										</div>
									</div><div class="columna col_marcador">
										<div class="marcador">
											<span><?php echo utf8_decode($partida['categorias_local']); ?> - <?php echo utf8_decode($partida['categorias_visitante']); ?></span>
										</div>
									</div>									
								</div>
								<?php } ?>
							</div>
							<div class="espaciador"></div>
							<?php } ?>
						</div>
					</div>
					<div class="seccion">
						<div id="area_ultimaspartidas">
							<?php if(!empty(isset($partidas_historial[0]))){ ?>
							<div class="cont_titulo">
								<div class="titulo">Últimas partidas</div>
							</div>
							<div class="cont_cuerpo">
								<?php foreach($partidas_historial as $valor => $partida){ ?>
								<div class="cuerpo link_continuar" onclick=MSHome.navegar("<?php echo utf8_decode($partida['link_continuar']); ?>");>
									<!--	SE DEJA SIN ENTER EL DIV->COLUMNA PARA QUE NO TOME ESPACIOS EN MOZILLA	-->
									<div class="columna col_foto">
										<div class="foto">
											<img src="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/perfil/profilepics/'.utf8_decode($partida['foto_oponente']); ?>" width="50" height="50" />
										</div>
									</div><div class="columna col_inform">
										<div class="inform">
											<div class="linea_info nombre_oponente">
												<span><?php echo utf8_decode($partida['nombre_oponente']); ?></span>
											</div>
											<div class="linea_info ronda">
												<span>Ronda <?php echo utf8_decode($partida['ronda']); ?></span>
											</div>
											<div class="linea_info fecha_creacion">
												<span>Iniciado el <?php echo utf8_decode($partida['fecha_inicio']); ?></span>
											</div>
											<div class="linea_info fecha_fin">
												<span>Finalizado el <?php echo utf8_decode($partida['fecha_fin']); ?></span>
											</div>
										</div>
									</div><div class="columna col_marcador">
										<div class="marcador">
											<span><?php echo utf8_decode($partida['categorias_local']); ?> - <?php echo utf8_decode($partida['categorias_visitante']); ?></span>
										</div>
									</div>									
								</div>
								<?php } ?>
							</div>
							<div class="espaciador"></div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--	FINALIZA LA MAQUETACIÓN DEL MÓDULO	-->
	</div>
</div>
