<?php

header("Content-Type: application/xls");

header("Content-Disposition: attachment; filename= reporte.xls");
?>
<table>
    <tr>
        <th>Fecha</th>
        <th>Articulo</th>
        <th>Valor Total</th>
        <th>Area</th>
        <th>Proveedor</th>
        <th>Detalles</th>
    </tr>
    <?php

    include("../../helper/conexion-excel.php");

    $sql = "SELECT mantenimiento.id, mantenimiento.fecha, mantenimiento.articulo, mantenimiento.valor_total, 
    centro_costo.centro_costo, mantenimiento.proveedor, mantenimiento.detalles
     from mantenimiento inner join centro_costo on centro_costo.id = mantenimiento.centro_costo ;";

    $ejecutar = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_array($ejecutar)) {


    ?>
        <tr>
            <td><?php echo $fila[1]; ?></td>
            <td><?php echo $fila[2]; ?></td>
            <td><?php echo number_format($fila[3], 2, ",", "."); ?></td>
            <td><?php echo $fila[4]; ?></td>
            <td><?php echo $fila[5]; ?></td>
            <td><?php echo $fila[6]; ?></td>

        </tr>

    <?php
    }
    ?>
</table>