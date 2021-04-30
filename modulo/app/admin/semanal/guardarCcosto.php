<?php

require_once '../../../modelo/semanadao.php';

/* Guardar un centro de costo nuevo */

$dao = new semanaDao();
if (isset($_POST['boton'])) {

    if ($_POST['boton'] == 'guardar') {


        if (
            isset($_POST['centro_costo']) & isset($_POST['nom_ccosto'])
        ) {

            $centro_costo = htmlspecialchars($_POST['centro_costo']);
            $nom_ccosto = htmlspecialchars($_POST['nom_ccosto']);

            if (empty($centro_costo) | empty($nom_ccosto)) {
                $mensaje = "Campo Vacio";
            } else {


                $mensaje = $dao->insertarCcosto($centro_costo, $nom_ccosto);
            }
        }
    } else if ($_POST['boton'] == 'limpiar') {


        $centro_costo = "";
        $nom_ccosto = "";
    }
}



require_once 'VistaGuardarCcosto.php';
