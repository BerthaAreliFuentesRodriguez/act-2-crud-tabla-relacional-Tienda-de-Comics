<?php
if (!isset($_POST["idcomic"])) {
    return;
}

$idcomic = $_POST["idcomic"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT * FROM comics WHERE idcomic = ? LIMIT 1;");
$sentencia->execute([$idcomic]);
$comic = $sentencia->fetch(PDO::FETCH_OBJ);
# Si no existe, salimos y lo indicamos
if (!$comic) {
    header("Location: ./vender.php?status=4");
    exit;
}
# Si no hay existencia...
if ($comic->existencia < 1) {
    header("Location: ./vender.php?status=5");
    exit;
}
session_start();
# Buscar comic dentro del cartito
$indice = false;
for ($i = 0; $i < count($_SESSION["carrito"]); $i++) {
    if ($_SESSION["carrito"][$i]->idcomic === $idcomic) {
        $indice = $i;
        break;
    }
}
# Si no existe, lo agregamos como nuevo
if ($indice === false) {
    $comic->cantidad = 1;
    $comic->total = $comic->costo;
    array_push($_SESSION["carrito"], $comic);
} else {
    # Si ya existe, se agrega la cantidad
    # Pero espera, tal vez ya no haya
    $cantidadExistente = $_SESSION["carrito"][$indice]->cantidad;
    # si al sumarle uno supera lo que existe, no se agrega
    if ($cantidadExistente + 1 > $comic->existencia) {
        header("Location: ./vender.php?status=5");
        exit;
    }
    $_SESSION["carrito"][$indice]->cantidad++;
    $_SESSION["carrito"][$indice]->total = $_SESSION["carrito"][$indice]->cantidad * $_SESSION["carrito"][$indice]->costo;
}
header("Location: ./vender.php");
