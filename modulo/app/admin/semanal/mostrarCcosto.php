<?php


require_once '../../../modelo/semanadao.php';
$dao = new semanaDao();
$usuarios = $dao->listaCcosto();
$tam = sizeof($usuarios);
require_once 'vistaCcostoMostrar.php';
