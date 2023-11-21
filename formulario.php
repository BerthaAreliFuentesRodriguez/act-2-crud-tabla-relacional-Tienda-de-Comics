<?php include_once "encabezado.php" ?>

<div class="col-xs-12">
	<h1>Nuevo comic</h1>
	<form method="post" action="nuevo.php">

		<label for="nomcomic">nombre comic:</label>
		<input class="form-control" name="nomcomic" required type="text" id="nomcomic" placeholder="Escribe el nombre del comic">

		<label for="proveedor">proveedor:</label>
		<input class="form-control" name="proveedor" required type="text" id="proveedor" placeholder="Escribe nombre del proveedor">

		<label for="editorial">editorial:</label>
		<input class="form-control" name="editorial" required type="text" id="editorial" placeholder="Escribe el nombre de la editorial">

		<label for="tipo">tipo:</label>
		<input class="form-control" name="tipo" required type="text" id="tipo" placeholder="Escribe el tipo de comic">

		<label for="costo">costo:</label>
		<input class="form-control" name="costo" required type="float" id="costo" placeholder="costo del comic">

		<label for="inclusiones">inclusiones/detalles:</label>
		<input class="form-control" name="inclusiones" required type="text" id="inclusiones" placeholder="Escribe las inclusiones o detalles del comic">

		<label for="img">nombre de la imagen(con su extension):</label>
		<input class="form-control" name="img" required type="text" id="img" placeholder="Escribe el nombre de la imagen con su extension">

		<br><br><input class="btn btn-info" type="submit" value="Guardar">
	</form>
</div>
<?php include_once "pie.php" ?>