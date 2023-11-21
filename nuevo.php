<?php
#Salir si alguno de los datos no está presente
if(!isset($_POST["nomcomic"]) || !isset($_POST["proveedor"]) || !isset($_POST["editorial"]) || !isset($_POST["tipo"]) || !isset($_POST["costo"]) || !isset($_POST["inclusiones"]) || !isset($_POST["img"])) exit();

#Si todo va bien, se ejecuta esta parte del código...

include_once "base_de_datos.php";
$nomcomic = $_POST["nomcomic"];
$proveedor = $_POST["proveedor"];
$editorial = $_POST["editorial"];
$tipo = $_POST["tipo"];
$costo = $_POST["costo"];
$inclusiones = $_POST["inclusiones"];
$img = $_POST["img"];

$sentencia = $base_de_datos->prepare("INSERT INTO comics(nomcomic, proveedor, editorial, tipo, costo, inclusiones, img) VALUES (?, ?, ?, ?, ?, ?, ?);");
$resultado = $sentencia->execute([$nomcomic, $proveedor, $editorial, $tipo, $costo, $inclusiones, $img]);

if($resultado === TRUE){
	header("Location: ./listar.php");
	exit;
}
else echo "Algo salió mal. Por favor verifica que la tabla exista";


?>
<?php include_once "pie.php" ?>