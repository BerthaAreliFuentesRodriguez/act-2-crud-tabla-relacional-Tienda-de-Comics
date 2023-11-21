<?php
if(!isset($_GET["idcomic"])) exit();
$id = $_GET["idcomic"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM comics WHERE idcomic = ?;");
$resultado = $sentencia->execute([$id]);
if($resultado === TRUE){
	header("Location: ./listar.php");
	exit;
}
else echo "Algo salió mal";
?>