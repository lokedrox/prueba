<?php

require_once '../../../modelo/semanadao.php';

/* Guardar un centro de costo nuevo */

$dao = new semanaDao();
if (isset($_POST['boton'])) {

    if ($_POST['boton'] == 'guardar') {


        if (
            isset($_POST['fecha']) & isset($_POST['centro_costo']) & isset($_POST['presupuesto'])
        ) {

            $fecha = htmlspecialchars($_POST['fecha']);
            $centro_costo = htmlspecialchars($_POST['centro_costo']);
            $presupuesto = htmlspecialchars($_POST['presupuesto']);

            if (empty($fecha) | empty($centro_costo) | empty($presupuesto)) {
                $mensaje = "Campo Vacio";
            } else {


                $mensaje = $dao->insertarPresupuesto($fecha, $centro_costo, $presupuesto);
            }
        }
    } else if ($_POST['boton'] == 'limpiar') {


        $fecha = "";
        $centro_costo = "";
        $presupuesto = "";
    }
}



require_once 'VistaGuardarPresupuesto.php';
