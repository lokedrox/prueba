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

    <div class="container-fluid mx-md-1">
        <div class="d-flex justify-content-center ">



            <form action="?action=actualizarPresupuesto" method="post" class="container contenedor-guardar-usuarios animacion-lateral pl-md-5 pt-md-4">


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

                    <div class="col-md-2 mx-md-2">

                        <label>ID</label>
                        <input type="number" name="id" class="form-control p-1" readonly value="<?php if (isset($id)) {
                                                                                                    echo $id;
                                                                                                } ?>">
                    </div>

                    <div class="col-md-3 mx-md-2">

                        <label>Fecha</label>
                        <input type="date" name="fecha" class="form-control p-1" value="<?php if (isset($fecha)) {
                                                                                            echo $fecha;
                                                                                        } ?>">
                    </div>

                    <div class="col-md-4 mr-md-2 ">

                        <label>Centro de Costo</label>
                        <input type="text" name="centro_costo" class="form-control  p-1" readonly value="<?php if (isset($centro_costo)) {
                                                                                                                echo $centro_costo;
                                                                                                            } ?>">
                        </input>
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
                    <a type="submit" name="boton" class="btn btn-success   my-2 p-2" href="?action=mostrarPresupuesto">
                        <i class="fas fa-arrow-left"></i> Regresar
                    </a>
                    <button type="submit" name="boton" value="guardar" class="btn btn-primary my-2 p-2 mx-2" onclick="javascript:return asegurar();">
                        <i class="fas fa-check"></i> Guardar
                    </button>
                    <button type="submit" name="boton" value="limpiar" class="btn btn-warning my-2 p-2">
                        <i class="fas fa-trash"></i> Limpiar
                    </button>
                </center>
            </form>
        </div>

    </div>
    <script>
        function asegurar() {
            rc = confirm("¿Seguro que desea Actualizar?");
            return rc;
        }
    </script>

</body>

</html>