<?php

// peticion get para traer información del crud

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $usuario = unserialize(base64_decode($_GET['objeto']));

    $id = $usuario['id'];
    $fecha = $usuario['fecha'];
    $articulo = $usuario['articulo'];
    $valor_total = $usuario['valor_total'];
    $centro_costo = $usuario['centro_costo'];
    $proveedor = $usuario['proveedor'];
    $detalles = $usuario['detalles'];
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    require_once '../../../modelo/semanadao.php';
    $dao = new semanaDao();
    if (isset($_POST['boton'])) {

        if ($_POST['boton'] == 'guardar') {


            if (
                isset($_POST['fecha']) & isset($_POST['articulo']) & isset($_POST['valor_total']) & isset($_POST['proveedor'])
                & isset($_POST['detalles'])
            ) {

                $id = htmlspecialchars($_POST['id']);
                $fecha = htmlspecialchars($_POST['fecha']);
                $articulo = htmlspecialchars($_POST['articulo']);
                $valor_total = htmlspecialchars($_POST['valor_total']);
                $centro_costo = htmlspecialchars($_POST['centro_costo']);
                $proveedor = htmlspecialchars($_POST['proveedor']);
                $detalles = htmlspecialchars($_POST['detalles']);


                if (empty($fecha) | empty($articulo) | empty($valor_total) | empty($proveedor) | empty($detalles)) {
                    $mensaje = "Campo Vacio";
                } else {

                    $mensaje = $dao->actualizar($id, $fecha, $articulo, $valor_total, $proveedor, $detalles);
                }
            }
        } else if ($_POST['boton'] == 'limpiar') {

            $fecha = "";
            $articulo = "";
            $valor_total = "";
            $area = "";
            $proveedor = "";
            $detalles = "";
        }
    }
} // metodo post

// peticion post para actualizar el registro


require_once 'vistaactualizar.php';
