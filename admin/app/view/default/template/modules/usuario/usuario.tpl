<h1>USUARIOS</h1>

<!-- Alertas -->
<?php 
if($peligro != ''){
?>
<div id="error" class="alert alert-danger alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo $peligro; ?>
</div>
<?php
 }
if($info != ''){
?>
<div id="bien" class="alert alert-success alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo $info; ?>
</div>
<?php  } ?>


<input class="btn btn-dark" type="button" value="Agregar usuario" onclick="location.href = '<?php echo _MSFW_PATH_ ?>modules/usuario/nuevo_usuario'" />

<input class="btn btn-dark" type="button" value="Editar perfil" onclick="location.href = '<?php echo _MSFW_PATH_ ?>modules/usuario/editar_usuario/id_usuario/<?php echo $id_administrador; ?>'" />

<table  class="table table-striped">
	<thead>
		<th>FOTO</th>
		<th>IDENTIFICACION</th>
		<th>CODIGO</th>
		<th>NOMBRES</th>
		<th>APELLIDOS</th>
		<th>EMAIL</th>
		<th>OPCIONES</th>
	</thead>
	<tbody>
	<?php foreach($usuarios as $unUsuario){ 
		 $id_usuario = $unUsuario['id_usuario'];
	?>
		<tr>
			<td>
				<img class="img_foto" src="<?php echo str_replace('/admin','',_MSFW_PATH_._VIEW_PATH_.'default/_img/modules/perfil/profilepics/'.$id_usuario.'.png'); ?>" />
			</td>
			<td><?php echo utf8_decode($unUsuario['identificacion']); ?></td>
			<td><?php echo utf8_decode($unUsuario['codigo']); ?></td>
			<td><?php echo utf8_decode($unUsuario['nombres']); ?></td>
			<td><?php echo utf8_decode($unUsuario['apellidos']); ?></td>
			<td><?php echo utf8_decode($unUsuario['email']); ?></td>
			<td>
				<input class="btn btn-secondary" type="button" name="editar" onclick="location.href = '<?php echo _MSFW_PATH_ ?>modules/usuario/editar_usuario/id_usuario/<?php echo $id_usuario; ?>'" value="editar">
				<input class="btn btn-secondary" type="button" name="eliminar" onclick="VerUsuarios.eliminar('<?php echo $id_usuario; ?>')" value="eliminar">
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>