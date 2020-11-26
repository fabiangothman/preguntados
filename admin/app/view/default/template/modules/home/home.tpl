<div id="home_container">
	<div class="page_content">



		<!--	INICIA LA MAQUETACIÓN DE LA PÁGINA	-->
		<br/>
		<!--
		<input class="btn btn-primary" type="button" value="Administrar usuarios" onclick="location.href = '<?php echo _MSFW_PATH_ ?>modules/usuario/ver_usuarios'" />
		
		<input class="btn btn-primary" type="button" value="Administrar preguntas" onclick="location.href = '<?php echo _MSFW_PATH_ ?>modules/pregunta/ver_preguntas'" />
		-->

		<div class="home_buttons">
			<a href="#" onclick="location.href = '<?php echo _MSFW_PATH_ ?>modules/usuario/ver_usuarios'">
				<div class="btn_preguntas" >
					<img  class="home_img" src="<?php echo _MSFW_PATH_._VIEW_PATH_ ?>/default/_img/modules/home/pregunta.png">
					<p class="text_image">Administrar usuarios</p>
				</div>
			</a>

			<a href="#"  onclick="location.href = '<?php echo _MSFW_PATH_ ?>modules/pregunta/ver_preguntas'" >
				<div class="btn_usuarios">
					<img class="home_img" src="<?php echo _MSFW_PATH_._VIEW_PATH_ ?>/default/_img/modules/home/usuarios.png">
					<p class="text_image">Administrar preguntas</p>
				</div>
			</a>
		</div>


		<br/>

	</div>
</div>