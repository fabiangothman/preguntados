<h1>CATEGORIAS</h1>

<table  class="table table-striped" >
	<thead>
		<th>CATEGORIA</th>
		<th>OPCIONES</th>
	</thead>
	<?php 
	if($categorias == null || empty($categorias))
	{ 
		echo "<td>No hay categorias registradas<td>";
	}else{
	?>
	<tbody>
	<?php foreach($categorias as $unCategoria){
		 $id_categoria = $unCategoria['id_categoria'];
	?>
		<tr>
			<td><?php echo utf8_decode($unCategoria['categoria']); ?></td>
			<td>
				<input type="button" name="editar" value="editar" onclick="location.href = '<?php echo _MSFW_PATH_ ?>modules/categoria/editar_categoria/id_categoria/<?php echo $id_categoria; ?>'" class="btn btn-secondary"/>
			</td>
		</tr>
	<?php } ?>
	</tbody>
	<?php } ?>
</table>
