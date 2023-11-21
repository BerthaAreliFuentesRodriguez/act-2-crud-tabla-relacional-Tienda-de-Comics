<?php include_once "encabezado.php" ?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT * FROM comics;");
$comics = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

	<div class="col-xs-12">
		<h1>comics</h1>
		<div>
			<a class="btn btn-success" href="./formulario.php">Nuevo <i class="fa fa-plus"></i></a>
		</div>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>ID</th>
					<th>nomcomic</th>
					<th>proveedor</th>
					<th>editorial</th>
					<th>tipo</th>
					<th>costo</th>
					<th>inclusiones</th>
					<th>img</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($comics as $comic){ ?>
				<tr>
					<td><?php echo $comic->idcomic ?></td>
					<td><?php echo $comic->nomcomic ?></td>
					<td><?php echo $comic->proveedor ?></td>
					<td><?php echo $comic->editorial ?></td>
					<td><?php echo $comic->tipo ?></td>
					<td><?php echo $comic->costo ?></td>
					<td><?php echo $comic->inclusiones ?></td>
					<td><center><img src="img/<?php echo $comic->img ?>" alt="-" with="80" height="100"></center></td>
					<td><a class="btn btn-warning" href="<?php echo "editar.php?idcomic=" . $comic->idcomic?>"><i class="fa fa-edit"></i></a></td>
					<td><a class="btn btn-danger" href="<?php echo "eliminar.php?idcomic=" . $comic->idcomic?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php include_once "pie.php" ?>