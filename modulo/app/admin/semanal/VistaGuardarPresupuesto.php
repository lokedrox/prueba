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

    <div class="container-fluid mx-md-1  ">

        <div class="">

            <div class="d-flex justify-content-center  ">


                <form action="?action=guardarPresupuesto" method="POST" class="container contenedor-guardar-usuarios  pl-md-5 pt-md-4">

                    <div class="row">
                        <div class="col-md-11 ">

                            <?php
                            if (empty($mensaje) == false) {

                                echo "<div class='alert alert-warning alert-dismissible fade show '>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            " . $mensaje . "</div>";
                            }
                            ?>


                        </div>


                        <div class="col-md-3 mx-md-2">

                            <label>Fecha</label>
                            <input type="date" name="fecha" class="form-control p-1" value="<?php if (isset($fecha)) {
                                                                                                echo $fecha;
                                                                                            } ?>">
                        </div>

                        <div class="col-md-4 mr-md-2 ">

                            <label for="">Centro Costo</label>
                            <select name="centro_costo" class="form-control">
                                <option value="0">seleccione un centro de costo</option>
                                <?php

                                function getConnection()
                                {
                                    $user = 'root';
                                    $pwd = '';
                                    return new PDO('mysql:host=localhost;dbname=controlpresupuestal', $user, $pwd);
                                }
                                $db = getConnection();
                                $sql = "SELECT id, centro_costo, nom_ccosto FROM centro_costo";
                                $stmt = $db->prepare($sql);
                                $stmt->execute();
                                $filas = $stmt->fetchAll(PDO::FETCH_OBJ);

                                foreach ($filas as $i) {

                                ?>

                                    <option value="<?php print($i->id); ?>"><?php print($i->centro_costo . "-" . $i->nom_ccosto); ?></option>


                                <?php
                                }

                                ?>

                            </select>
                            <br>
                        </div>

                        <div class="col-md-4 mx-md-2">

                            <label>Presupuesto</label>
                            <input type="number" name="presupuesto" class="form-control p-1" value="<?php if (isset($presupuesto)) {
                                                                                                        echo $presupuesto;
                                                                                                    } ?>">
                        </div>





                    </div>

                    <br>
                    <center>
                        <button type="submit" name="boton" value="guardar" class="btn btn-primary my-4 p-2 mx-2">
                            <i class="fas fa-check"></i> Guardar
                        </button>
                        <button type="submit" name="boton" value="limpiar" class="btn btn-warning my-2 p-2">
                            <i class="fas fa-trash"></i> Limpiar
                        </button>
                    </center>
                </form>

                <div class="row">

                </div>
            </div>
        </div>

    </div>

</body>

</html>