<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $cuenta = base64_decode($_GET['centro_costo']);
    require_once '../../../modelo/semanadao.php';
    $dao = new semanaDao();
    $dao->eliminarCcosto($cuenta);

    require_once 'vista.eliminarCcosto.php';
}
