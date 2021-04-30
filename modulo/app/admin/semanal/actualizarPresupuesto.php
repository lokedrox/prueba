<?php

// peticion get para traer información del crud

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $usuario = unserialize(base64_decode($_GET['objeto']));

    $id = $usuario['id'];
    $fecha = $usuario['fecha'];
    $centro_costo = $usuario['centro_costo'];
    $presupuesto = $usuario['presupuesto'];
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    require_once '../../../modelo/semanadao.php';
    $dao = new semanaDao();
    if (isset($_POST['boton'])) {

        if ($_POST['boton'] == 'guardar') {


            if (
                isset($_POST['id']) & isset($_POST['fecha']) &
                isset($_POST['centro_costo']) &  isset($_POST['presupuesto'])
            ) {

                $id = htmlspecialchars($_POST['id']);
                $fecha = htmlspecialchars($_POST['fecha']);
                $centro_costo = htmlspecialchars($_POST['centro_costo']);
                $presupuesto = htmlspecialchars($_POST['presupuesto']);

                if (empty($id) | empty($fecha) | empty($centro_costo) | empty($presupuesto)) {
                    $mensaje = "Campo Vacio";
                } else {

                    $mensaje = $dao->actualizarPresupuesto($id, $fecha, $presupuesto);
                }
            }
        } else if ($_POST['boton'] == 'limpiar') {

            $id = "";
            $fecha = "";
            $centro_costo = "";
            $presupuesto = "";
        }
    }
} // metodo post

// peticion post para actualizar el registro


require_once 'VistaActualizarPresupuesto.php';
