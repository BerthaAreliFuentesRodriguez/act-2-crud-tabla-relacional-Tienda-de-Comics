<?php
if(!isset($_POST["total"])) exit;


session_start();


$total = $_POST["total"];
include_once "base_de_datos.php";


$ahora = date("Y-m-d H:i:s");


$sentencia = $base_de_datos->prepare("INSERT INTO ventas(fecha, total) VALUES (?, ?);");
$sentencia->execute([$ahora, $total]);

$sentencia = $base_de_datos->prepare("SELECT idventa FROM ventas ORDER BY idventa DESC LIMIT 1;");
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_OBJ);

$idventa = $resultado === false ? 1 : $resultado->idventa;

$base_de_datos->beginTransaction();
$sentencia = $base_de_datos->prepare("INSERT INTO comics_vendidos(idcomic, idventa, cantidad) VALUES (?, ?, ?);");
$sentenciaExistencia = $base_de_datos->prepare("UPDATE comics SET existencia = existencia - ? WHERE idcomic = ?;");
foreach ($_SESSION["carrito"] as $comic) {
	$total += $comic->total;
	$sentencia->execute([$comic->idcomic, $idventa, $comic->cantidad]);
	$sentenciaExistencia->execute([$comic->cantidad, $comic->idcomic]);
}
$base_de_datos->commit();
unset($_SESSION["carrito"]);
$_SESSION["carrito"] = [];
header("Location: ./vender.php?status=1");
?>