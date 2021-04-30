<?php
session_start();


/* Si hay ya una sesió ya iniciada mandeme al contenido de neuvo,
    osea no me deja salir hasta que no cierre sesión* */
if (isset($_SESSION['usuario'])) {
    header('location:index.php');
}


/* Entonces aquí si no hay uan sesión inciada lo vamos a mandar a la página de registarme,
    para registar un nuevo usuario, o si ya tiene un usuario que el de a inciar sesión */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_empleado =  filter_var($_POST['usuario_empleado'], FILTER_SANITIZE_STRING);/* Aqui evitamos inyección de código y convertimos a minusculas*/
    $contra_empleado = $_POST['contra_empleado'];
    $nivel_acceso = $_POST['nivel_acceso'];

    //echo $usuario . " " . $password . " " . $password2; utilizado v}para ver si se enviaban datos

    $errores = "";

    if (empty($usuario_empleado) or empty($contra_empleado) or empty($nivel_acceso)) {/* empty dice "si esto no tiene contenido/esta vacio" */
        $errores .= '<li>Por favor rellena los campos correctamente</li>';
    } else {

        /* Aquí se hace la conexión con base de datos */
        try {
            $conexion = new PDO('mysql:host=localhost;dbname=controlpresupuestal', 'root', '');
        } catch (PDOException $e) {
            echo "Error en conexión: " . $e->getMessage();
        }

        /* Aquí hacemos nuestra consulta */
        $statement = $conexion->prepare('SELECT * FROM usuario WHERE usuario_empleado=:usuario_empleado LIMIT 1 ');
        $statement->execute(array(':usuario_empleado' => $usuario_empleado));
        $resultado = $statement->fetch();

        /* Fetch me regresa 2 cosas false/true en caso de que no exista/si existas */
        if ($resultado != false) {
            $errores .= "<li>Este usuario ya existe</li>";
        }

        /* $password = hash('sha512', $password); *//* hash es para encriptar una contraseña */
        /* $password2 = hash('sha512', $password2); */

        //echo $usuario . "<br/> pw1: " . $password . " <br/>pw2: " . $password2; Utilizamos para ver la contarseña encriptada


        /* Aquí vemos si las 2 contarseñas son iguales */

        /*   if ($password != $password2) {
            $errores .= "<li>Las contraseñas no coinciden</li>";
        } */
    }

    if ($errores == '') {
        $statement = $conexion->prepare('INSERT INTO usuario (usuario_empleado,contra_empleado,nivel_acceso) VALUES (:usuario_empleado,:contra_empleado,:nivel_acceso)');
        $statement->execute(array(':usuario_empleado' => $usuario_empleado, ':contra_empleado' => $contra_empleado, ':nivel_acceso' => $nivel_acceso));

        header('location:login.php');
    }
}

require 'register.view.php';
