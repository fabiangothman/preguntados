<!-- Alertas -->
<div id="error" class="alert alert-danger alert-dismissable fade in" style="display: none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>

<div id="bien" class="alert alert-success alert-dismissable fade in" style="display: none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>


<h1>EDITAR PREGUNTA</h1>

<form id="formEditPregunta">
	<form id="form_pregunta">
	<label>Categoría:</label>
	<select id="id_categoria" class="form-control validate[required]" required="true">
		<?php 
		foreach($categorias as $unCategoria)
		{
			if($unCategoria['id_categoria'] == $pregunta['id_categoria'])
			{
		?>
			<option selected="true" value="<?php echo $unCategoria['id_categoria'] ?>"><?php echo utf8_decode($unCategoria['categoria']); ?></option>
		<?php
			}else{
		?>
		<option value="<?php echo $unCategoria['id_categoria'] ?>"><?php echo utf8_decode($unCategoria['categoria']); ?></option>
		<?php } 
			}
		?>
	</select>
	<br/>
	<label>Pregunta:</label>
	<br/>
	<textarea id="pregunta" required="true" placeholder="escriba aqui su pregunta" required="true" class="form-control form_textarea" ><?php echo utf8_decode($pregunta['pregunta']); ?></textarea>
	<br/>
	<label>RESPUESTAS</label>
	<table class="table table-striped">
		<thead>
			<th>#</th>
			<th>Respuesta</th>
			<th>Correcta?</th>
		</thead>
		<tbody>
		<?php 
			$cont = 1;
			foreach($respuestas as $unRespuesta)
			{
		?>
			<tr>
				<input type="hidden" id="idR<?php echo $cont; ?>" value="<?php echo $unRespuesta['id_respuesta']; ?>" />
				<td> <?php echo $cont; ?> </td>
				<td> <input type="text" id="r<?php echo $cont; ?>" placeholder="escriba aqui su respuesta" required="true"  value="<?php echo utf8_decode($unRespuesta['respuesta']); ?>"  class="form-control form_respuesta" /> </td>
				<?php 
					if(isset($unRespuesta['correcta']) && $unRespuesta['correcta'] == true){
				?>
				<td> <input type="radio" checked name="correcta" value="r<?php echo $cont; ?>"  class="form-control form_respuesta" />  </td>
				<?php
					}else{
				?>
				<td> <input type="radio" name="correcta" value="r<?php echo $cont; ?>" class="form-control form_respuesta" /> </td>
				<?php
					}
				?>
				
			</tr>
		<?php
			$cont++;
			}
		?>	
		
		</tbody>
	</table>

	<input type="button" value="Guardar" onclick="EditarPregunta.guardar()">
</form>
</form>