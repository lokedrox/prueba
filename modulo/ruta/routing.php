<?php

if (isset($_GET['action'])) {

    if ($_GET['action'] == "mostrar") {

        require_once "mostrar.php";
    } elseif ($_GET['action'] == "guardar") {

        require_once "guardar.php";
    } elseif ($_GET['action'] == "mostrarCcosto") {

        require_once "mostrarCcosto.php";
    } elseif ($_GET['action'] == "mostrarPresupuesto") {

        require_once "mostrarPresupuesto.php";
    } elseif ($_GET['action'] == "guardarpresupuesto") {

        require_once "bienvenida.php";
    } elseif ($_GET['action'] == "guardarPresupuesto") {

        require_once "guardarPresupuesto.php";
    } elseif ($_GET['action'] == "guardarCcosto") {

        require_once "guardarCcosto.php";
    } elseif ($_GET['action'] == "eliminar") {

        require_once "eliminar.php";
    } elseif ($_GET['action'] == "eliminarTodo") {

        require_once "EliminarTodo.php";
    } elseif ($_GET['action'] == "actualizar") {

        require_once "actualizar.php";
    } elseif ($_GET['action'] == "actualizarCcosto") {

        require_once "actualizarCcosto.php";
    } elseif ($_GET['action'] == "actualizarPresupuesto") {

        require_once "actualizarPresupuesto.php";
    } elseif ($_GET['action'] == "inicio") {

        require_once "mostrar.php";
    } else {

        require_once "page404.php";
    }
} else {

    require_once "mostrar.php"; //aqui podes poner una bienvenida o un login
}
