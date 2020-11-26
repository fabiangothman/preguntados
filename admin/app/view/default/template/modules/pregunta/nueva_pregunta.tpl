<!-- Alertas -->
<div id="error" class="alert alert-danger alert-dismissable fade in" style="display: none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>

<div id="bien" class="alert alert-success alert-dismissable fade in" style="display: none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>


<h1>NUEVA PREGUNTA</h1>

<form id="form_pregunta">
	<label>Categoría:</label>
	<select id="id_categoria" class="form-control validate[required]" required="true">
		<?php 
		foreach($categorias as $unCategoria){ 
		?>
		<option value="<?php echo $unCategoria['id_categoria'] ?>"><?php echo utf8_decode($unCategoria['categoria']); ?></option>
		<?php } ?>
	</select>
	<br/>
	<label>Pregunta:</label>
	<br/>
	<textarea id="pregunta" required="true" placeholder="escriba aqui su pregunta" required="true" class="form-control form_textarea" ></textarea>
	<br/>
	<label>RESPUESTAS</label>
	<table class="table table-striped">
		<thead>
			<th>#</th>
			<th>Respuesta</th>
			<th>Correcta?</th>
		</thead>
		<tbody>
			<tr>
				<td> 1 </td>
				<td> <input type="text" id="r1" placeholder="escriba aqui su respuesta" required="true" class="form-control form_respuesta" /> </td>
				<td> <input type="radio" name="correcta" value="r1" /> </td>
			</tr>
			<tr>
				<td> 2 </td>
				<td> <input type="text" id="r2" placeholder="escriba aqui su respuesta" required="true" class="form-control form_respuesta"/> </td>
				<td> <input type="radio" name="correcta" value="r2" /> </td>
			</tr>
			<tr>
				<td> 3 </td>
				<td> <input type="text" id="r3" placeholder="escriba aqui su respuesta" required="true" class="form-control form_respuesta" /> </td>
				<td> <input type="radio" name="correcta" value="r3" /> </td>
			</tr>
			<tr>
				<td> 4 </td>
				<td> <input type="text" id="r4" placeholder="escriba aqui su respuesta" required="true" class="form-control form_respuesta" /> </td>
				<td> <input type="radio" name="correcta" value="r4" /> </td>
			</tr>
		</tbody>
	</table>

	<input type="button" value="Guardar" onclick="nueva_pregunta.guardar()" class="btn btn-secondary" />
</form>