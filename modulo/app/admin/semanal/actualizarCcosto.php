<?php

// peticion get para traer información del crud

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $usuario = unserialize(base64_decode($_GET['objeto']));

    $id = $usuario['id'];
    $centro_costo = $usuario['centro_costo'];
    $nom_ccosto = $usuario['nom_ccosto'];
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    require_once '../../../modelo/semanadao.php';
    $dao = new semanaDao();
    if (isset($_POST['boton'])) {

        if ($_POST['boton'] == 'guardar') {


            if (
                isset($_POST['id']) & isset($_POST['centro_costo']) & isset($_POST['nom_ccosto'])
            ) {

                $id = htmlspecialchars($_POST['id']);
                $centro_costo = htmlspecialchars($_POST['centro_costo']);
                $nom_ccosto = htmlspecialchars($_POST['nom_ccosto']);

                if (empty($id) | empty($centro_costo) | empty($nom_ccosto)) {
                    $mensaje = "Campo Vacio";
                } else {

                    $mensaje = $dao->actualizarCcosto($id, $centro_costo, $nom_ccosto);
                }
            }
        } else if ($_POST['boton'] == 'limpiar') {

            $id = "";
            $centro_costo = "";
            $nom_ccosto = "";
        }
    }
} // metodo post

// peticion post para actualizar el registro


require_once 'VistaActualizarCcosto.php';
