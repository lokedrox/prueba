<?php

$errores = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


	if (empty($_POST['codigoacceso'])) {/* empty dice "si esto no tiene contenido/esta vacio" */
		$errores .= '<li>Por favor rellene el campo correctamente</li>';
	} else {

		$codigoacceso = $_POST['codigoacceso'];

		if ($codigoacceso == 1871158) {
			header("location:registrate.php");
		} else {
			$errores .= '<li>Codigo no valido</li>';
		}
	}
}

require 'control.registro.usuarios.view.php';
