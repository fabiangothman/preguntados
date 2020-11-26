<div id="ruleta_container">
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

				<div class="concursantes">
					<div class="cont_rivales">
						<div id="usu_local">
							<div class="datos">
								<div class="foto">
									<img src="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/perfil/profilepics/'.$foto_local; ?>" width="100%" height="100%">
								</div>
								<div class="cont_nom_comp">
									<div class="nombre_comp"><?php echo utf8_decode($usu_local['nombres']); ?></div>
									<div class="nombre_comp"><?php echo utf8_decode($usu_local['apellidos']); ?></div>
								</div>
							</div>
							<div class="categorias">
								<center>
								<div class="cont_categ">
									<?php foreach ($ids_categoria_local as $numero => $id_categoria){ ?>
										<img src="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/ruleta/'.$id_categoria['id_categoria'].utf8_decode($id_categoria['clase']).'.png'; ?>" class="categoria" title="<?php echo utf8_decode($id_categoria['nombre']); ?>" width="50" />
									<?php } ?>
								</div>
							</center>
							</div>
						</div>
						<div id="vs">
							<img src="<?php echo _MSFW_PATH_._VIEW_PATH_; ?>default/_img/modules/ruleta/vs.png" width="100%">
						</div>
						<div id="usu_visitante">
							<div class="datos">
								<div class="cont_nom_comp">
									<div class="nombre_comp"><?php echo utf8_decode($usu_visitante['nombres']); ?></div>
									<div class="nombre_comp"><?php echo utf8_decode($usu_visitante['apellidos']); ?></div>
								</div>
								<div class="foto">
									<img src="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/perfil/profilepics/'.$foto_visitante; ?>" width="100%" height="100%">
								</div>
							</div>
							<div class="categorias">
								<div class="cont_categ">
									<?php foreach ($ids_categoria_visitante as $numero => $id_categoria){ ?>
										<img src="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/ruleta/'.$id_categoria['id_categoria'].utf8_decode($id_categoria['clase']).'.png'; ?>" class="categoria" title="<?php echo utf8_decode($id_categoria['nombre']); ?>" width="50" />
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="ruleta">
					<div class="cont_ruleta">
						<center>
							<div id="canvasContainer" <?php echo ($acceso_concedido) ? 'onclick="MSRuleta.girarRuleta(this);"' : 'class="bloquear_giro"' ?> >
								<div class="cont_base">
									<canvas id='ruleta' width='550' height='550'>
										Canvas not supported, use another browser.
									</canvas>
								</div>
								<div class="cont_cerebro">
									<img src="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/ruleta/cerebro.png'; ?>" class="cerebro" width="100%" height="100%" />
								</div>
								
							</div>
						</center>
					</div>
				</div>
				<div class="barras">
					<div class="cont_barra">
						<img class="barra" src ="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/ruleta/'; ?><?php echo (($contador_barra==1)||($contador_barra==2)||($contador_barra==3)) ? 'lleno' : 'vacio' ?>.png" />
						<img class="barra" src ="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/ruleta/'; ?><?php echo (($contador_barra==2)||($contador_barra==3)) ? 'lleno' : 'vacio' ?>.png" />
						<img class="barra" src ="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/ruleta/'; ?><?php echo ($contador_barra==3) ? 'lleno' : 'vacio' ?>.png" />
					</div>
				</div>

			</div>
		</div>
		<!--	FINALIZA LA MAQUETACIÓN DEL MÓDULO	-->
	</div>
</div>