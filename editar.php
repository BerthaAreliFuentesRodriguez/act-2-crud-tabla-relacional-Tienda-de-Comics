<?php
if(!isset($_GET["idcomic"])) exit();
$idcomic = $_GET["idcomic"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM comics WHERE idcomic = ?;");
$sentencia->execute([$idcomic]);
$comic = $sentencia->fetch(PDO::FETCH_OBJ);
if($comic === FALSE){
	echo "¡No existe algún comic con ese id!";
	exit();
}

?>
<?php include_once "encabezado.php" ?>
	<div class="col-xs-12">
		<h1>Editar comic con el id <?php echo $comic->idcomic; ?></h1>
		<form method="post" action="guardarDatosEditados.php">
			<input type="hidden" name="idcomic" value="<?php echo $comic->idcomic; ?>">
	
			<label for="nomcomic">nombre comic:</label>
			<input value="<?php echo $comic->nomcomic ?>" class="form-control" name="nomcomic" required type="text" id="nomcomic" placeholder="Escribe el nombre del comic">

			<label for="proveedor">proveedor:</label>
			<input value="<?php echo $comic->proveedor ?>" class="form-control" name="proveedor" required type="text" id="proveedor" placeholder="Escribe el nombre del proveedor">

			<label for="editorial">editorial:</label>
			<input value="<?php echo $comic->editorial ?>" class="form-control" name="editorial" required type="text" id="editorial" placeholder="Escribe el nombre de la editorial">

			<label for="tipo">tipo:</label>
			<input value="<?php echo $comic->tipo ?>" class="form-control" name="tipo" required type="text" id="tipo" placeholder="Escribe el tipo de comic">

			<label for="costo">costo:</label>
			<input value="<?php echo $comic->costo ?>" class="form-control" name="costo" required type="number" id="costo" placeholder="Costo del comic">
			
			<label for="inclusiones">inclusiones/detalles:</label>
			<input value="<?php echo $comic->inclusiones ?>" class="form-control" name="inclusiones" required type="text" id="inclusiones" placeholder="Escribe las inclusiones o detalles del comic">

			<label for="img">nombre de la imagen:</label>
			<input value="<?php echo $comic->img ?>" class="form-control" name="img" required type="text" id="img" placeholder="Escribe el nombre de la imagen con su exxtension">

			<br><br><input class="btn btn-info" type="submit" value="Guardar">
			<a class="btn btn-warning" href="./listar.php">Cancelar</a>
		</form>
	</div>
<?php include_once "pie.php" ?>
