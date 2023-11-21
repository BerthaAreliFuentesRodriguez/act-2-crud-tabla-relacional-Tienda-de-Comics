<?php
if (!isset($_GET["idventa"])) {
    exit("No hay id");
}
$idventa = $_GET["idventa"];
include_once "base_de_datos.php";
$sentencia = $base_de_datos->prepare("SELECT idventa, fecha, total FROM ventas WHERE idventa = ?");
$sentencia->execute([$idventa]);
$venta = $sentencia->fetchObject();
if (!$venta) {
    exit("No existe venta con el id proporcionado");
}

$sentenciacomics = $base_de_datos->prepare("SELECT c.idcomic, c.nomcomic,c.costo, cv.cantidad
FROM comics c
INNER JOIN 
comics_vendidos cv
ON c.idcomic = cv.idcomic
WHERE cv.idventa = ?");
$sentenciacomics->execute([$idventa]);
$comics = $sentenciacomics->fetchAll();
if (!$comics) {
    exit("No hay comics");
}

?>
<style>
    * {
        font-size: 12px;
        font-family: 'Times New Roman';
    }

    td,
    th,
    tr,
    table {
        border-top: 1px solid black;
        border-collapse: collapse;
    }

    td.comic,
    th.comic {
        width: 75px;
        max-width: 75px;
    }

    td.cantidad,
    th.cantidad {
        width: 50px;
        max-width: 50px;
        word-break: break-all;
    }

    td.precio,
    th.precio {
        width: 50px;
        max-width: 50px;
        word-break: break-all;
        text-align: right;
    }

    .centrado {
        text-align: center;
        align-content: center;
    }

    .ticket {
        width: 175px;
        max-width: 175px;
    }

    img {
        max-width: inherit;
        width: inherit;
    }

    @media print {

        .oculto-impresion,
        .oculto-impresion * {
            display: none !important;
        }
    }
</style>

<body>
    <div class="ticket">
        <img src="img/logovoca.png" alt="Logotipo" with="250">
        <p class="centrado">TICKET DE VENTA
            <br><?php echo $venta->fecha; ?>
        </p>
        <table>
            <thead>
                <tr>
                    <th class="cantidad">CANT</th>
                    <th class="comic">comic</th>
                    <th class="precio">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($comics as $comic) {
                    $subtotal = $comic->costo * $comic->cantidad;
                    $total += $subtotal;
                ?>
                    <tr>
                        <td class="cantidad"><?php echo $comic->cantidad;  ?></td>
                        <td class="comic"><?php echo $comic->nomcomic;  ?> <strong>$<?php echo number_format($comic->costo, 2) ?></strong></td>
                        <td class="precio">$<?php echo number_format($subtotal, 2)  ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2" style="text-align: right;">TOTAL</td>
                    <td class="precio">
                        <strong>$<?php echo number_format($total, 2) ?></strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="centrado">¡GRACIAS POR SU COMPRA!
        </p>
    </div>
</body>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        window.print();
        setTimeout(() => {
            window.location.href = "./ventas.php";
        }, 1000);
    });
</script>