<input type="button" name="volver" value="volver" onclick="location.href = '<?php echo _MSFW_PATH_ ?>modules/categoria/ver_categorias'">

<h1>Agregar Categoria</h1>

<form id="formCategoria">
	<label>Categoria: </label>
	<input type="text" id="categoria" placeholder="nombre"/>
	<input type="button" name="guardar" value="Guardar" onclick="nueva_categoria.guardar()">
</form>