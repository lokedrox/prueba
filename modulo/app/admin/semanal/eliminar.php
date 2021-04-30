<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $cuenta = base64_decode($_GET['id']);
    require_once '../../../modelo/semanadao.php';
    $dao = new semanaDao();
    $dao->eliminar($cuenta);

    require_once 'vista.eliminar.php';


}
