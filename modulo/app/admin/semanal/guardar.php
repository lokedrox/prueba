<?php
require_once '../../../modelo/semanadao.php';
$dao = new semanaDao();
if (isset($_POST['boton'])) {

    if ($_POST['boton'] == 'guardar') {


        if (
            isset($_POST['fecha']) & isset($_POST['articulo'])  & isset($_POST['valor_total'])  & isset($_POST['centro_costo'])  & isset($_POST['proveedor'])
            & isset($_POST['detalles'])
        ) {

            $fecha = htmlspecialchars($_POST['fecha']);
            $articulo = htmlspecialchars($_POST['articulo']);
            $valor_total = htmlspecialchars($_POST['valor_total']);
            $centro_costo = htmlspecialchars($_POST['centro_costo']);
            $proveedor = htmlspecialchars($_POST['proveedor']);
            $detalles = htmlspecialchars($_POST['detalles']);
            ucfirst:





            if (empty($fecha) | empty($articulo) | empty($valor_total) | empty($centro_costo) | empty($proveedor) | empty($detalles)) {
                $mensaje = "Campo Vacio";
            } else {


                $mensaje = $dao->insertar($fecha, ucfirst($articulo), $valor_total,  strtoupper($centro_costo), ucfirst($proveedor), ucfirst($detalles));
            }
        }
    } else if ($_POST['boton'] == 'limpiar') {


        $fecha = "";
        $articulo = "";
        $valor_total = "";
        $centro_costo = "";
        $proveedor = "";
        $detalles = "";
    }
}

require_once 'vistaguardar.php';
