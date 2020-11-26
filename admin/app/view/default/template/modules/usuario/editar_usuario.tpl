<!-- Alertas -->
<div id="error" class="alert alert-danger alert-dismissable fade in" style="display: none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>

<div id="bien" class="alert alert-success alert-dismissable fade in" style="display: none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
</div>



<h1>Usuario a editar</h1>
<form id="formEditUsuario" >
	<label>	Rol: </label>
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
	<label>Identificación: </label>
	<input type="text" id="identificacion" class="form-control validate[required]" value="<?php echo utf8_decode($usuario['identificacion']); ?>" />
	<br/>
	<label>Codigo</label>
	<input type="text" id="codigo"  value="<?php echo utf8_decode($usuario['codigo']); ?>" class="form-control" />
	<br/>
	<label>Nombres</label>
	<input type="text" id="nombres" value="<?php echo utf8_decode($usuario['nombres']); ?>" class="form-control" />
	<br/>
	<label>Apellidos</label>
	<input type="text" id="apellidos" value="<?php echo utf8_decode($usuario['apellidos']); ?>" class="form-control" />
	<br/>
	<label>Email</label>
	<input type="text" id="email" class="form-control validate[required,email]" value="<?php echo utf8_decode($usuario['email']); ?>" />
	<br/>
	<label>Clave</label>
	<input type="password" id="clave" placeholder="dejar vacio para no cambiar clave" class="form-control" />
	<br/>
	<input class="btn btn-secondary" type="button" id="guardar" onclick="EditarUsuario.guardar()" value="Guardar">
</form>