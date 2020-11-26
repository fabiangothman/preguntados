<div id="login_container">
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

				<div class="contenedor_banner">
					<div class="banner">
						<img src="<?php echo _MSFW_PATH_._VIEW_PATH_; ?>default/_img/modules/login/banner.png" width="100%" height="100%" />
					</div>
				</div>

				<div class="contenedor_logo">
					<div class="logo">
						<img src="<?php echo _MSFW_PATH_._VIEW_PATH_; ?>default/_img/modules/login/logo.png" width="100%" height="100%" />
					</div>
				</div>

				<div class="contenedor_form">
					<div class="borde_form">
						<div class="cuerpo_form">
							<form action="<?php echo _MSFW_PATH_ ?>modules/login/login_callback" method="post" target="_self">
								<div class="cont_campos">

									<div class="campo datos">
										<div class="cont_texto">
											<div class="texto">Usuario o correo:</div>
										</div>
										<div class="cont_input">
											<input class="input" type="text" name="email" placeholder="Ingrese su correo electrónico" required="true" />
										</div>
									</div>
									<div class="campo datos">
										<div class="cont_texto">
											<div class="texto">Contraseña:</div>
										</div>
										<div class="cont_input">
											<input class="input" type="password" name="contrasena" placeholder="Ingrese su contraseña" required="true" />
										</div>
									</div>
									<div class="campo boton">
										<div class="cont_submit" align="center">
											<input class="enviar" type="submit" value="INICIAR" />
										</div>
									</div>
									<div class="campo mensajes">
										<div class="cont_mensajes">
											<div class="mensaje"><a href="<?php echo $ir_recuperar; ?>">¿Ha olvidado su contraseña de administrador?</a></div>
											<div class="mensaje"><a href="<?php echo $ir_usuario; ?>">Iniciar sesión como usuario</a></div>
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