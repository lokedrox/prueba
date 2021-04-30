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


                <form action="?action=guardarCcosto" method="POST" class="container contenedor-guardar-usuarios  pl-md-5 pt-md-4">

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

                        <div class="col-md-6">

                            <label>Centro de costo</label>
                            <input type="text" name="centro_costo" class="form-control p-1 " placeholder="Ejempo NPP" value="<?php if (isset($centro_costo)) {
                                                                                                                                    echo $centro_costo;
                                                                                                                                } ?>">
                        </div>

                        <div class="col-md-5 mx-md-2">

                            <label>Nombre Centro de Costo </label>
                            <input type="text" name="nom_ccosto" class="form-control p-1" placeholder="Logistica" value="<?php if (isset($nom_ccosto)) {
                                                                                                                                echo $nom_ccosto;
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