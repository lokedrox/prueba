<?php


require_once '../../../modelo/semanadao.php';
$dao = new semanaDao();
$usuarios = $dao->listaPresupuesto();
$tam = sizeof($usuarios);
require_once 'vistaPresupuestoMostrar.php';
