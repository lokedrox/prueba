<?php

require_once '../../../modelo/semanadao.php';

$dao = new semanaDao();
$usuarios = $dao->lista();
$tam = sizeof($usuarios);

/* para consultar presupuestos */
$dao = new semanaDao();
$presupuestos = $dao->listaPresupuesto();
$tam = sizeof($presupuestos);

/* Guardar un presupuesto nuevo */

$dao = new semanaDao();
if (isset($_POST['boton'])) {

    if ($_POST['boton'] == 'guardar') {


        if (
            isset($_POST['centro_costo']) & isset($_POST['presupuesto'])
        ) {

            $centro_costo = htmlspecialchars($_POST['centro_costo']);
            $presupuesto = htmlspecialchars($_POST['presupuesto']);

            if (empty($centro_costo) | empty($presupuesto)) {
                $mensaje = "Campo Vacio";
            } else {

                $mensaje = $dao->insertarPresupuesto($centro_costo, $presupuesto);
            }
        }
    } else if ($_POST['boton'] == 'limpiar') {


        $centro_costo = "";
        $presupuesto = "";
    }
}


$cont = 1;

$acumuladorlogistica = 0;
$acumuladorplanta = 0;
$acumuladoradobo = 0;
$_SESSION["plantatotal"] = 0;
$_SESSION["logisticatotal"] = 0;
$_SESSION["adobototal"] = 0;

foreach ($usuarios as $usuario) {
    $cont++;

    /*Esto es para acumular cuanto se va gastando por area y comparar con el presupuesto que se tiene*/

    /*Para acumular lo de logistica*/


    if (substr($usuario["centro_costo"], 0, 3) == "npl" | substr($usuario["centro_costo"], 0, 3) == "NPL") {

        $acumuladorlogistica += $usuario["valor_total"];
        $_SESSION["logisticatotal"] = $acumuladorlogistica;
    }
    /* para acumular lo de planta */
    if (substr($usuario["centro_costo"], 0, 3) == "NPP" | substr($usuario["centro_costo"], 0, 3) == "npp") {

        $acumuladorplanta += $usuario["valor_total"];
        $_SESSION["plantatotal"] = $acumuladorplanta;
    }

    /* para acumular lo de adobo */
    if (substr($usuario["centro_costo"], 0, 3) == "NPA" | substr($usuario["centro_costo"], 0, 3) == "npa") {

        $acumuladoradobo += $usuario["valor_total"];
        $_SESSION["adobototal"] = $acumuladoradobo;
    }
}

require_once 'bienvenida.view.php';
