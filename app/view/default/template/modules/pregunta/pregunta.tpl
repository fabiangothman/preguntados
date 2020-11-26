<div id="pregunta_container">
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
				<div class="cont_categoria">
					<div class="colum cont_logo">
						<div class="logo"></div>
					</div>
					<div class="colum cont_nombre">
						<div class="nombre"><?php echo mb_strtoupper(utf8_decode($categoria_nombre), 'utf-8'); ?></div>
					</div>
					<div class="colum cont_tiempo">
						<div id="contador_tiempo"></div>
					</div>
				</div>
				<div class="cont_pregunta">
					<div class="campo_pregunta">
						<center>
							<div class="pregunta">
								<div class="tex_preg"><?php echo utf8_decode($pregunta['pregunta']); ?></div>
							</div>
						</center>
					</div>
				</div>
				<div class="cont_respuestas">
					<div class="respuestas">
					<?php foreach($respuestas as $numero => $respuesta) { ?>
						<div class="cont_texto" onclick="MSPregunta.validarRespuesta(<?php echo utf8_decode($respuesta['id_respuesta']); ?>);">
							<div class="texto"><?php echo utf8_decode($respuesta['respuesta']); ?></div>
						</div>
					<?php } ?>
					</div>
				</div>
				<div id="retroal_respuesta"></div>
			</div>
		<!--	FINALIZA LA MAQUETACIÓN DEL MÓDULO	-->
	</div>
</div>