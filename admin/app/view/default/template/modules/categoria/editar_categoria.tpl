<!-- Alertas -->
<div id="error" class="alert alert-danger alert-dismissable fade in" style="display: none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>

<div id="bien" class="alert alert-success alert-dismissable fade in" style="display: none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>

<h1>EDITAR CATEGORIA</h1>

<form id="formEditCategoria"  >
	<label>Categoria:</label>
	<input type="text" id="categoria" placeholder="nombre de la categoria" value="<?php echo utf8_decode($categoria['categoria']); ?>" class="form-control imput_categoria" />
	<br/>
	<input type="button" value="Guardar" onclick="EditarCategoria.guardar()" class="btn btn-secondary" >
</form>