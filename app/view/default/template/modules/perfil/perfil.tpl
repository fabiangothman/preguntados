<div id="perfil_container">
	<div class="page_content">


		<!--	REPORTE DE ERRORES	-->
		<div class="alertsContainer">
			<?php if(isset($exito)&&($exito != '')){ ?>
				<div class="alert alert-success alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-textoCampo="close">×</a>
					<?php echo utf8_encode($exito); ?>
				</div>
			<?php } ?>
			<?php if(isset($peligro)&&($peligro != '')){ ?>
				<div class="alert alert-danger alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-textoCampo="close">×</a>
					<?php echo utf8_encode($peligro); ?>
				</div>
			<?php } ?>
			<?php if(isset($info)&&($info != '')){ ?>
				<div class="alert alert-info alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-textoCampo="close">×</a>
					<?php echo utf8_encode($info); ?>
				</div>
			<?php } ?>
			<?php if(isset($alerta)&&($alerta != '')){ ?>
				<div class="alert alert-warning alert-dismissable">
					<a href="#" class="close" data-dismiss="alert" aria-textoCampo="close">×</a>
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
							<div class="texto">MI PERFIL</div>
						</div>
					</div>

					<div class="info_cont">
						<div class="info">
							<form action="<?php echo _MSFW_PATH_ ?>modules/perfil/perfil_callback" method="post" target="_self" enctype="multipart/form-data">

								<div class="seccion">
									<div class="foto_cont">
										<div class="foto">
											<img src="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/perfil/profilepics/'.utf8_decode($jugador['foto']); ?>" width="100%" height="100%" />
										</div>
									</div>
								</div>

								<div class="seccion">
									<div class="cont_titl">
										<div class="textoCampo">Cambiar foto de perfil</div>
									</div>
									<div class="subefoto_cont">
										<div class="subefoto">
											<input type="file" name="subefoto" id="subefoto" width="100%" value="<?php echo utf8_decode($jugador['identificacion']); ?>" accept='image/x-png, image/jpeg' />
										</div>
									</div>
								</div>

								<div class="seccion">
									<div class="cont_titl">
										<div class="textoCampo">Identificación</div>
									</div>
									<div class="identi_cont">
										<div class="identificacion">
											<input type="text" name="identificacion" width="100%" class="disabled" disabled="true" value="<?php echo utf8_decode($jugador['identificacion']); ?>" />
										</div>
									</div>
								</div>

								<div class="seccion">
									<div class="cont_titl">
										<div class="textoCampo">Código</div>
									</div>
									<div class="codig_cont">
										<div class="codigo">
											<input type="text" name="codigo" width="100%" placeholder="Ingrese en código" value="<?php echo utf8_decode($jugador['codigo']); ?>" />
										</div>
									</div>
								</div>

								<div class="seccion">
									<div class="cont_titl">
										<div class="textoCampo">Nombres</div>
									</div>
									<div class="nombr_cont">
										<div class="nombres">
											<input type="text" name="nombres" width="100%" placeholder="Ingrese los nombres" value="<?php echo utf8_decode($jugador['nombres']); ?>" required="true" />
										</div>
									</div>
								</div>

								<div class="seccion">
									<div class="cont_titl">
										<div class="textoCampo">Apellidos</div>
									</div>
									<div class="apell_cont">
										<div class="apellidos">
											<input type="text" name="apellidos" width="100%" placeholder="Ingrese los apellidos" value="<?php echo utf8_decode($jugador['apellidos']); ?>" required="true" />
										</div>
									</div>
								</div>

								<div class="seccion">
									<div class="cont_titl">
										<div class="textoCampo">Correo</div>
									</div>
									<div class="emai_cont">
										<div class="email">
											<input type="text" name="email" width="100%" class="disabled" disabled="true" value="<?php echo utf8_decode($jugador['email']); ?>" />
										</div>
									</div>
								</div>

								<div class="seccion">
									<div class="cont_titl">
										<div class="textoCampo">Grupo</div>
									</div>
									<div class="grup_cont">
										<div class="grupo">
											<?php if(!empty(isset($grupos[0]))){ ?>
											<select name="id_grupo" width="100%">
												<?php foreach($grupos as $valor => $grupo){ ?>
												<option value="<?php echo $grupo['id_grupo']; ?>" <?php echo ($jugador['id_grupo'] == $grupo['id_grupo']) ? 'selected="true"' : ''; ?> ><?php echo utf8_decode($grupo['grupo']); ?></option>
												<?php } ?>
											</select>
											<?php }else{ ?>
											<input type="text" width="100%" class="disabled" disabled="true" value="No hay grupos cargados en la plataforma." />
											<?php } ?>
										</div>
									</div>
								</div>

								<div class="seccion">
									<div class="btn_cont">
										<div class="btn_enviar">
											<input type="submit" name="btn_enviar" value="GUARDAR" />
										</div>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!--	FINALIZA LA MAQUETACIÓN DEL MÓDULO	-->
	</div>
</div>