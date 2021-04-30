<?php

require_once '../../../modelo/semanadao.php';
$dao = new semanaDao();
$dao->EliminarTodo();

$_SESSION["plantatotal"] = 0;
$_SESSION["logisticatotal"] = 0;
$_SESSION["adobototal"] = 0;

require_once 'mostrar.php';
