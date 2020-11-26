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

<h1>ADMINISTRAR PREGUNTAS</h1>

<input type="button" name="nuevo" value="Nueva pregunta" onclick="location.href = '<?php echo _MSFW_PATH_ ?>modules/pregunta/nueva_pregunta'" class="btn btn-dark"  />
<input type="button" name="nuevo" value="Ver Categorias" onclick="location.href = '<?php echo _MSFW_PATH_ ?>modules/categoria/ver_categorias'" class="btn btn-dark"  />

<br/>
<br/>

<?php 
	if($preguntas == null || empty($preguntas))
	{
		echo "<br/>No hay preguntas cargadas.";
	}else{
	?>

<table class="table table-striped" >
	<thead>
		<th>CATEGORIA</th>
		<th>PREGUNTA</th>
		<th>OPCIONES</th>
	</thead>
	<tbody>
	
	<?php foreach($preguntas as $unPregunta){
		 $id_pregunta = $unPregunta['id_pregunta'];
	?>
		<tr>
			<td><?php echo utf8_decode($unPregunta['categoria']); ?></td>
			<td><?php echo utf8_decode($unPregunta['pregunta']); ?></td>
			
			<td>
				<input type="button" name="editar" value="Editar" onclick="location.href = '<?php echo _MSFW_PATH_ ?>modules/pregunta/editar_pregunta/id_pregunta/<?php echo $id_pregunta; ?>'" class="btn btn-secondary" />
				<input type="button" name="eliminar" value="Eliminar" onclick="Verpreguntas.eliminar('<?php echo $id_pregunta ?>')" class="btn btn-secondary" />
			</td>
		</tr>
	<?php } ?>
	</tbody>
	
</table>

<?php } ?>