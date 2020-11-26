<div id="seleccionCategoria_container">
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
				<div class="cont_seleccion">
					<div class="cont_titulos">
						<div class="tit_general">ELIGE LA <strong>CATEGORÍA</strong> QUE QUIERAS JUGAR</div>
						<div id="tit_categ_selecc"></div>
					</div>
					<div class="cont_categorias">
						<div class="categorias">
							<?php foreach ($todas_categorias_faltantes as $numero_cat => $categoria){ ?>
							<div class="cont_personaje" id="<?php echo $categoria['id_categoria']; ?>" onclick="MSSeleccionCategoria.seleccionarCategoria(this);">
								<img src="<?php echo _MSFW_PATH_._VIEW_PATH_.'default/_img/modules/ruleta/seleccion/'.utf8_decode($categoria['id_categoria']).'.png'; ?>" class="personaje" height="100" />
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="cont_botones">
						<div class="btn_jugar" onclick="MSSeleccionCategoria.jugar();">Jugar</div>
					</div>
				</div>
			</div>
		<!--	FINALIZA LA MAQUETACIÓN DEL MÓDULO	-->
	</div>
</div>