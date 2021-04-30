<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Entrada de Datos de Usuario</title>
</head>

<body>

    <div class="contai  ner-fluid mx-md-1">

        <div class="">

            <div class="d-flex justify-content-center">






            </div>

        </div>

        <div class="row mt-5 d-flex justify-content-center mb-5">
            <div class="container-fluid contenedor-guardar-usuarios  pl-md-5 pt-md-4 col-md-10">

                <!-- <div class="col-md-12  ">
                    <a href="nuevomes.php" class="btn btn-success p-2 m-1">Nuevo mes</a>
                </div> -->
                <div class="row mb-3 border p-3">

                    <div class="col-12 my-3">
                        <h3 class="text-center">Gastos actuales</h3>
                    </div>

                    <div class="col-md-4 ">
                        <p>Planta: <?php echo number_format($_SESSION["plantatotal"], 2, ",", "."); ?></p>
                    </div>




                    <div class="col-md-4 ">
                        <p>Logistica: <?php echo number_format($_SESSION["logisticatotal"], 2, ",", "."); ?></p>

                    </div>

                    <div class="col-md-4  ">
                        <p>Adobo: <?php echo number_format($_SESSION["adobototal"], 2, ",", "."); ?></p>

                    </div>



                </div>

                <div class="row my-5 border p-3">

                    <?php

                    /* Aquí inicializamos las varibles para que en caso de no exitir valores en la base de daots no nos salgan errores */
                    $_SESSION["presupuestoLogistica"] = 0;
                    $_SESSION["presupuestoPlanta"] = 0;
                    $_SESSION["presupuestoAdobo"] = 0;

                    /* foreach para hacer recorrido de la base de datos y scaar valor de cada presupuesto por area */

                    foreach ($presupuestos as $presupuesto) {


                        if (substr($presupuesto["centro_costo"], 0, 3) == "NPP" | substr($presupuesto["centro_costo"], 0, 3) == "npp") {

                            $_SESSION["presupuestoPlanta"] = $presupuesto["presupuesto"];
                        } elseif (substr($presupuesto["centro_costo"], 0, 3) == "NPL" | substr($presupuesto["centro_costo"], 0, 3) == "npl") {

                            $_SESSION["presupuestoLogistica"] = $presupuesto["presupuesto"];
                        } elseif (substr($presupuesto["centro_costo"], 0, 3) == "NPA" | substr($presupuesto["centro_costo"], 0, 3) == "npa") {

                            $_SESSION["presupuestoAdobo"] = $presupuesto["presupuesto"];
                        }
                    }

                    ?>


                    <!-- Aquí mostramos las variables con los resultados del recorrido -->
                    <div class="col-12">

                        <h3 class="text-center mb-4">Presupuestos</h3>

                    </div>

                    <dvi class="col-md-4">



                        <p>Planta: <?php echo number_format($_SESSION["presupuestoPlanta"], 2, ",", "."); ?></p>

                    </dvi>

                    <dvi class="col-md-4">

                        <p>Logistica: <?php echo number_format($_SESSION["presupuestoLogistica"], 2, ",", "."); ?></p>

                    </dvi>

                    <dvi class="col-md-4">

                        <p>Adobo: <?php echo number_format($_SESSION["presupuestoAdobo"], 2, ",", "."); ?></p>

                    </dvi>
                </div>

                <div class="row border  mb-5 p-3">
                    <div class="col-md-12">
                        <h3 class="text-center mb-4">Cuanto Queda</h3>
                    </div>

                    <dvi class="col-md-4">


                        <p>Planta: <?php
                                    /*Aqui hacemos la resta para saber si estamos gastando mas de lo que presupuestado  */
                                    $controlPresupuestoPlanta = $_SESSION["presupuestoPlanta"] - $_SESSION["plantatotal"];
                                    echo number_format($controlPresupuestoPlanta, 2, ",", ".");

                                    $_SESSION['excesoPlanta'] = $controlPresupuestoPlanta;
                                    ?></p>

                        <?php
                        /* Apartado de los correos */

                        /* Para planta */
                        $listaControlCorreos = new semanaDao();

                        $ListaCorreos = $listaControlCorreos->listaControlCorreos();

                        $fecha = getdate();

                        /*   print_r($fecha); */

                        $fechaActual = $fecha['year'] . "-" . $fecha['mon'] . "-" . $fecha['mday'];



                        /*   $insertar = new semanaDao();
                        $insertarGastos = $insertar->insertarControlCorreo($_SESSION['plantatotal'], '1', $fechaActual);
                        $insertarGastos = $insertar->insertarControlCorreo($_SESSION['logisticatotal'], '2', $fechaActual);
                        $insertarGastos = $insertar->insertarControlCorreo($_SESSION['adobototal'], '3', $fechaActual); */


                        foreach ($ListaCorreos as $correo) {

                            /* ESTO ES PARA LOS CORREOS DE PLANTA */

                            if (substr($correo["centro_costo"], 0, 3) == "1" & substr($correo['fecha'], 5, 2) == $fecha['mon']) {/* Determinamos de que centro de costo se trata */

                                /* Aqui declaramos las variables que vamso a utilzar del centro de costo correspondiente */
                                $id = $correo["id"];
                                $sum_gastos = $correo["sum_gastos"];
                                $centro_costo = $correo["centro_costo"];
                                $fechabaseDatos = $correo["fecha"];

                                /* Lueog pasamso a hacer condicionales para determinar si enviamos correo o no */
                                if ($sum_gastos < $_SESSION['presupuestoPlanta']) {


                                    $sum_gastos = $_SESSION["plantatotal"];

                                    $actulizarControlCorreo = new semanaDao();

                                    $actualizar = $actulizarControlCorreo->actualizarControlCorreos($id, $sum_gastos, $fechaActual);
                                } else if ($sum_gastos > $_SESSION['presupuestoPlanta']) {
                                    /* echo "<br>Usted entro a apartaod dodne gastos es mayor a presupusto " . " " . $sum_gastos . " " . $_SESSION['presupuestoPlanta'];

                                    echo "holi"; */


                                    if ($_SESSION['plantatotal'] > $sum_gastos) {
                                        /*  echo "<br> Usted entro al apartado donde el gasto actuAL es mayor al gasto en tabla"; */
                                        require_once '../../correoPlanta.php';

                                        $sum_gastos = $_SESSION["plantatotal"];

                                        $actulizarControlCorreo = new semanaDao();

                                        $actualizar = $actulizarControlCorreo->actualizarControlCorreos($id, $sum_gastos, $fechaActual);
                                    } else if ($sum_gastos = $_SESSION['plantatotal']) {
                                    }
                                }
                                /* ESTO ES PARA LOS CORREOS DE LOGISTICA */
                            }
                        }



                        ?>


                    </dvi>

                    <dvi class="col-md-4">


                        <p>Logistica: <?php
                                        $controlPresupuestoLogistica = $_SESSION["presupuestoLogistica"] - $_SESSION["logisticatotal"];
                                        echo number_format($controlPresupuestoLogistica, 2, ",", ".");
                                        $_SESSION['excesoLogistica'] = $controlPresupuestoLogistica; ?></p>



                        <?php

                        foreach ($ListaCorreos as $correo) {

                            /* ESTO ES PARA LOS CORREOS DE ADOBO */

                            if (substr($correo["centro_costo"], 0, 3) == "2" & substr($correo['fecha'], 5, 2) == $fecha['mon']) {/* Determinamos de que centro de costo se trata */

                                /* Aqui declaramos las variables que vamso a utilzar del centro de costo correspondiente */
                                $id = $correo["id"];
                                $sum_gastos = $correo["sum_gastos"];
                                $centro_costo = $correo["centro_costo"];
                                $fechabaseDatos = $correo["fecha"];

                                /* Lueog pasamso a hacer condicionales para determinar si enviamos correo o no */
                                if ($sum_gastos < $_SESSION['presupuestoLogistica']) {


                                    $sum_gastos = $_SESSION["logisticatotal"];

                                    $actulizarControlCorreo = new semanaDao();

                                    $actualizar = $actulizarControlCorreo->actualizarControlCorreos($id, $sum_gastos, $fechaActual);
                                } else if ($sum_gastos > $_SESSION['presupuestoLogistica']) {



                                    if ($_SESSION['logisticatotal'] > $sum_gastos) {
                                        require_once '../../correoLogistica.php';

                                        $sum_gastos = $_SESSION["logisticatotal"];

                                        $actulizarControlCorreo = new semanaDao();

                                        $actualizar = $actulizarControlCorreo->actualizarControlCorreos($id, $sum_gastos, $fechaActual);
                                    } else if ($sum_gastos = $_SESSION['logisticatotal']) {
                                    }
                                }
                                /* ESTO ES PARA LOS CORREOS DE LOGISTICA */
                            }
                        }

                        ?>

                    </dvi>

                    <dvi class="col-md-4">

                        <p>Adobo: <?php
                                    $controlPresupuestoAdobo = $_SESSION["presupuestoAdobo"] - $_SESSION["adobototal"];
                                    echo number_format($controlPresupuestoAdobo, 2, ",", ".");
                                    $_SESSION['excesoAdobo'] = $controlPresupuestoAdobo; ?></p>

                        <?php
                        foreach ($ListaCorreos as $correo) {
                            /* ESTO ES PARA LOS CORREOS DE LOGISTICA */

                            if (substr($correo["centro_costo"], 0, 3) == "3" & substr($correo['fecha'], 5, 2) == $fecha['mon']) {/* Determinamos de que centro de costo se trata */

                                /* Aqui declaramos las variables que vamso a utilzar del centro de costo correspondiente */
                                $id = $correo["id"];
                                $sum_gastos = $correo["sum_gastos"];
                                $centro_costo = $correo["centro_costo"];
                                $fechabaseDatos = $correo["fecha"];

                                /* Lueog pasamso a hacer condicionales para determinar si enviamos correo o no */
                                if ($sum_gastos < $_SESSION['presupuestoAdobo']) {


                                    $sum_gastos = $_SESSION["adobototal"];

                                    $actulizarControlCorreoAdobo = new semanaDao();

                                    $actualizarAdobo = $actulizarControlCorreoAdobo->actualizarControlCorreos($id, $sum_gastos, $fechaActual);
                                } else if ($sum_gastos > $_SESSION['presupuestoAdobo']) {



                                    if ($_SESSION['adobototal'] > $sum_gastos) {
                                        require_once '../../correoAdobo.php';

                                        $sum_gastos = $_SESSION["adobototal"];

                                        $actulizarControlCorreo = new semanaDao();

                                        $actualizar = $actulizarControlCorreo->actualizarControlCorreos($id, $sum_gastos, $fechaActual);
                                    } else if ($sum_gastos = $_SESSION['adobototal']) {
                                    }
                                }
                                /* ESTO ES PARA LOS CORREOS DE LOGISTICA */
                            }
                        }
                        ?>

                    </dvi>


                </div>
            </div>




        </div>

    </div>

</body>

</html>