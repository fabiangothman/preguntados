<!-- Alertas -->
<div id="error" class="alert alert-danger alert-dismissable fade in" style="display: none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>

<div id="bien" class="alert alert-success alert-dismissable fade in" style="display: none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>


<h1>AGREGAR USUARIO</h1>

<br/>

<form class="form_usuario">
	<label class="form_label">Rol</label>
	<select id="id_rol" class="form-control validate[required]">
		<?php 
		foreach($roles as $unRol){ 
			if($unRol['id_rol'] == $usuario[id_rol]){
		?>
		<option selected="true" value="<?php echo $unRol['id_rol'] ?>"><?php echo utf8_decode($unRol['nombre']); ?></option>
		<?php
			}else{
		?>
		<option value="<?php echo $unRol['id_rol'] ?>"><?php echo utf8_decode($unRol['nombre']); ?></option>
		<?php }
		} ?>
	</select>
	<br/>
	<label class="form_label">Identificación</label>
	<input type="text" id="identificacion" class="form-control validate[required]" placeholder="identificación" />
	<br/>
	<label class="form_label">Codigo</label>
	<input type="text" id="codigo"  placeholder="codigo" class="form-control" />
	<br/>
	<label class="form_label">Nombres</label>
	<input type="text" id="nombres" placeholder="nombres" class="form-control" />
	<br/>
	<label class="form_label">Apellidos</label>
	<input type="text" id="apellidos" placeholder="apellidos" class="form-control" />
	<br/>
	<label class="form_label">Email</label>
	<input type="text" id="email" class="form-control validate[required,email]" placeholder="email" />
	<br/>
	<label class="form_label">Clave</label>
	<input type="password" id="clave" placeholder="clave"  class="form-control"/>
	<br/>
	
	<input class="btn btn-secondary" type="button" id="guardar" onclick="nuevo_usuario.guardar()" value="Guardar">

</form>