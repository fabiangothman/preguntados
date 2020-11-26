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


		<!--	INICIA LA MAQUETACIÓN DE LA PÁGINA	-->
		<div class="contenedor_form">
			<div class="header_form">
				<div class="cont_texto">
					<div class="hh2">Iniciar sesión</div>
				</div>
			</div>
			<div class="cuerpo_form">
				<form action="<?php echo _MSFW_PATH_ ?>modules/login/login_callback" method="post" target="_self">
					<div class="campo correo">
						<label>Correo electrónico</label>
						<div class="input">
							<input name="email" id="email" placeholder="" type="email" value="<?php echo $email; ?>" maxlength="100" required />
						</div>
					</div>
					<div class="campo clave">
						<label>Contraseña</label>
						<div class="input">
							<input name="contrasena" id="contrasena" placeholder=""  type="password" maxlength="50" autocomplete="false" required />
						</div>
					</div>
					<div class="enviar">
						<input type="submit" name="btnEnviar" class="btnLogin" value="INGRESAR">
					</div>
				</form>
			</div>
			<div class="footer_form">
				<div class="cont_texto">
					<a href="<?php echo $ir_recuperar; ?>">
						<div class="hh1">¿Ha olvidado su contraseña?</div>
					</a>
					<a href="<?php echo $ir_admin; ?>">
						<div class="hh1">Iniciar sesión como administrador</div>
					</a>
				</div>
			</div>
		</div>


	</div>
</div>