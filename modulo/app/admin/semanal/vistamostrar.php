<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
  <title>Entrada de Datos de Usuario</title>
  <style>
    #tabla {

      text-align: center;

    }

    #tabla>thead>tr>th:nth-child(5) {
      width: 20%;

    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
      background-color: #007bff;
      color: white !important;
      margin-top: 20px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background-color: #007bff !important;
      color: white !important;

    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:active {
      background-color: #007bff !important;
      color: white !important;

    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      color: white !important;
      border: 1px solid #111;
      background-color: #585858;
      background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #007bff), color-stop(100%, #111));
      background: -webkit-linear-gradient(top, #007bff 0%, #007bff 0%);
      background: -moz-linear-gradient(top, #007bff 0%, #007bff 100%);
      background: -ms-linear-gradient(top, #007bff 0%, #007bff 100%);
      background: -o-linear-gradient(top, #007bff 0%, #007bff 100%);
      background: linear-gradient(to bottom, #007bff 0%, #007bff 100%);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
      color: white !important;
      border: 1px solid #111;
      background-color: #585858;
      background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #007bff), color-stop(100%, #111));
      background: -webkit-linear-gradient(top, #007bff 0%, #007bff 0%);
      background: -moz-linear-gradient(top, #007bff 0%, #007bff 100%);
      background: -ms-linear-gradient(top, #007bff 0%, #007bff 100%);
      background: -o-linear-gradient(top, #007bff 0%, #007bff 100%);
      background: linear-gradient(to bottom, #007bff 0%, #007bff 100%);
    }
  </style>

</head>

<body>

  <div class="container-fluid px-md-3 mb-5">

    <?php


    if ($tam == 0) {
      echo "<br><p><strong>No se encontro registro de cargos!!</strong></p>";
    } else {

    ?>


      <br>
      <div class="row">
        <a href="../../excel.php" class="btn btn-success p-1 col-md-2 shadow-sm m-1"><i class="fas fa-file-excel fa-2x"> </i> Generar Excel</a>
        <a href="../../pdf.php" class="btn btn-danger p-1 col-md-2 shadow-sm m-1"><i class="fas fa-file-pdf fa-2x"> </i> Generar PDF</a>
        <a href="?action=eliminarTodo" class="btn btn-danger p-1 col-md-2 shadow-sm m-1" onclick='javascript:return asegurarTodo();'> <i class='fas fa-trash-alt fa-2x'></i> Eliminar Todo</a> </td></a>

      </div>
      <table class="table table-striped py-3 table-hover table-borderless " id="tabla">

        <thead class="thead-dark ">
          <th class="py-3 p-1">ID</th>
          <th class="py-3 p-1">Fecha </th>
          <th class="py-3 p-1">Articulo</th>
          <th class="py-3 p-1">Valor Total</th>
          <th class="py-3 p-1">Centro de Costo</th>
          <th class="py-3 p-1">Proovedor</th>
          <th class="py-3 p-1">Detalles</th>
          <th class="py-3 p-1">Acción</th>

        </thead>
        <tbody>
          <?php
          $cont = 1;

          $acumuladorlogistica = 0;
          $acumuladorplanta = 0;
          $acumuladoradobo = 0;
          $_SESSION["plantatotal"] = 0;
          $_SESSION["logisticatotal"] = 0;
          $_SESSION["adobototal"] = 0;

          foreach ($usuarios as $usuario) {
            echo "<tr >" .
              "<td class=' pt-4 p-1'>" . $usuario["id"] . "</td>" .
              "<td class=' pt-4 p-1'>" . $usuario["fecha"] . "</td>" .
              "<td class=' pt-4 p-1'>" . $usuario["articulo"] . "</td>" .
              "<td class=' pt-4 p-1'>" . number_format($usuario["valor_total"], 2, ",", ".") . "</td>" .
              "<td class=' pt-4 p-1'>" . $usuario["centro_costo"] . "</td>" .
              "<td class=' pt-4 p-1'>" . $usuario["proveedor"] . "</td>" .
              "<td class=' pt-4 p-1'>" . $usuario["detalles"] . "</td>" .



              "<td><a href='?action=actualizar&objeto=" . base64_encode(serialize($usuario)) .
              "' class='btn btn-warning p-1 my-3'><i class='fas fa-retweet'></i>  Actualizar</a>   &nbsp;&nbsp;" .
              "<a href='?action=eliminar&id=" . base64_encode($usuario["id"]) .
              "' class='btn btn-danger p-1 my-3'  onclick='javascript:return asegurar();'><i class='fas fa-trash-alt '></i> Eliminar</a></td>" .
              "</tr>";
            $cont++;

            /*Esto es para acumular cuanto se va gastando por area y comparar con el presupuesto que se tiene*/

            /*Para acumular lo de logistica*/


            if (substr($usuario["centro_costo"], 0, 3) == "npl" | substr($usuario["centro_costo"], 0, 3) == "NPL") {

              $acumuladorlogistica += $usuario["valor_total"];
              $_SESSION["logisticatotal"] = $acumuladorlogistica;
            }
            /* para acumular lo de planta */
            if (substr($usuario["centro_costo"], 0, 3) == "NPP" | substr($usuario["centro_costo"], 0, 3) == "npp") {

              $acumuladorplanta += $usuario["valor_total"];
              $_SESSION["plantatotal"] = $acumuladorplanta;
            }

            /* para acumular lo de adobo */
            if (substr($usuario["centro_costo"], 0, 3) == "NPA" | substr($usuario["centro_costo"], 0, 3) == "npa") {

              $acumuladoradobo += $usuario["valor_total"];
              $_SESSION["adobototal"] = $acumuladoradobo;
            }
          }

          ?>

        </tbody>

        <table>


        <?php
      }

      /*  echo $_SESSION["logisticatotal"]." ";
      echo $_SESSION["total"]; */
        ?>
  </div>
  <script>
    function asegurar() {
      rc = confirm("¿Seguro que desea Eliminar?");
      return rc;
    }

    function asegurarTodo() {
      rt = confirm("¿Seguro que desea eliminar todos los registros?");
      return rt;
    }


    $(document).ready(function() {
      $('#tabla').dataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        dom: 'Bfrtip',
        "pageLength": 5
      });
    });
  </script>
</body>

</html>