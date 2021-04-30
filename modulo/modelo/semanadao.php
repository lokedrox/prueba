<?php

include 'conexion.php';

class semanaDao extends Conexion
{



  /* -----------INSERTAR UNA SEMANA-------------- */

  public function insertar($fecha, $articulo, $valor_total, $centro_costo, $proveedor, $detalles)
  {
    $mensaje = "";
    try {
      $conexion = Conexion::conectar();
      $sql = "INSERT INTO mantenimiento(id, fecha ,articulo, valor_total, centro_costo,proveedor, detalles) 
      VALUES (NULL, :fecha ,:articulo, :valor_total, :centro_costo, :proveedor, :detalles);";

      $stmt = $conexion->prepare($sql);

      $stmt->bindParam(":fecha", $fecha);
      $stmt->bindParam(":articulo", $articulo);
      $stmt->bindParam(":valor_total", $valor_total);
      $stmt->bindParam(":centro_costo", $centro_costo);
      $stmt->bindParam(":proveedor", $proveedor);
      $stmt->bindParam(":detalles", $detalles);



      $stmt->execute();
      $fila = $stmt->rowCount();
      $mensaje = "Se guardo con exito!!";
    } catch (PDOException $e) {

      if ($e->errorInfo[1] == 1062) {
        $mensaje = "día Existe!!";
        // duplicate entry, do something else
      } else {
        // an error other than duplicate entry occurred
        echo $e->errorInfo[1];
      }
    }
    return $mensaje;
  }

  /* -----------INSERTAR UN presupuesto-------------- */

  public function insertarPresupuesto($fecha, $centro_costo, $presupuesto)
  {
    $mensaje = "";
    try {
      $conexion = Conexion::conectar();
      $sql = "INSERT INTO presupuesto(fecha, centro_costo, presupuesto) VALUES ( :fecha ,:centro_costo , :presupuesto);";

      $stmt = $conexion->prepare($sql);

      $stmt->bindParam(":fecha", $fecha);
      $stmt->bindParam(":centro_costo", $centro_costo);
      $stmt->bindParam(":presupuesto", $presupuesto);

      $stmt->execute();
      $fila = $stmt->rowCount();
      $mensaje = "Se guardo con exito!!";
    } catch (PDOException $e) {

      if ($e->errorInfo[1] == 1062) {
        $mensaje = "Ya Existe!!";
        // duplicate entry, do something else
      } else {
        // an error other than duplicate entry occurred
        echo $e->errorInfo[1];
      }
    }
    return $mensaje;
  }


  /* -----------INSERTAR UN CENTRO DE COSTO-------------- */

  public function insertarCcosto($centro_costo, $nom_ccosto)
  {
    $mensaje = "";
    try {
      $conexion = Conexion::conectar();
      $sql = "INSERT INTO centro_costo(centro_costo, nom_ccosto) VALUES ( :centro_costo , :nom_ccosto);";

      $stmt = $conexion->prepare($sql);

      $stmt->bindParam(":centro_costo", $centro_costo);
      $stmt->bindParam(":nom_ccosto", $nom_ccosto);

      $stmt->execute();
      $fila = $stmt->rowCount();
      $mensaje = "Se guardo con exito!!";
    } catch (PDOException $e) {

      if (
        $e->errorInfo[1] == 1062
      ) {
        $mensaje = "Ya Existe!!";
        // duplicate entry, do something else
      } else {
        // an error other than duplicate entry occurred
        echo $e->errorInfo[1];
      }
    }
    return $mensaje;
  }

  /* -----------INSERTAR UN CONTROL DE CORREO-------------- */

  public function insertarControlCorreo($sum_gastos, $centro_costo, $fecha)
  {
    $mensaje = "";
    try {
      $conexion = Conexion::conectar();
      $sql = "INSERT INTO control_correos (sum_gastos, centro_costo,fecha) VALUES ( :sum_gastos , :centro_costo, :fecha); WHere centro_costo = '1' ";

      $stmt = $conexion->prepare($sql);

      $stmt->bindParam(":sum_gastos", $sum_gastos);
      $stmt->bindParam(":centro_costo", $centro_costo);
      $stmt->bindParam(":fecha", $fecha);

      $stmt->execute();
      $fila = $stmt->rowCount();
      $mensaje = "Se guardo con exito!!";
    } catch (PDOException $e) {

      if (
        $e->errorInfo[1] == 1062
      ) {
        $mensaje = "Ya Existe!!";
        // duplicate entry, do something else
      } else {
        // an error other than duplicate entry occurred
        echo $e->errorInfo[1];
      }
    }
    return $mensaje;
  }





  /* ----------------LISTA DE SEMANAS ---------------------*/
  public function lista()
  {
    $conexion = Conexion::conectar();
    $sql = "SELECT mantenimiento.id, mantenimiento.fecha, mantenimiento.articulo, mantenimiento.valor_total, 
    centro_costo.centro_costo, mantenimiento.proveedor, mantenimiento.detalles from mantenimiento inner join centro_costo on centro_costo.id = mantenimiento.centro_costo ;";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;
    return $array;
  }

  /* ----------------LISTA DE CENTROS DE COSTO ---------------------*/
  public function listaCcosto()
  {
    $conexion = Conexion::conectar();
    $sql = "SELECT * FROM centro_costo order by centro_costo asc;";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;
    return $array;
  }


  /* ----------------LISTA DE PRESUPUESTO POR CENTROS ---------------------*/
  public function listaPresupuesto()
  {
    $conexion = Conexion::conectar();
    $sql = "SELECT presupuesto.id, presupuesto.fecha, centro_costo.centro_costo, presupuesto.presupuesto  FROM presupuesto
    inner join centro_costo on centro_costo.id = presupuesto.centro_costo ;";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;
    return $array;
  }

  /* ----------------LISTA CONTROL CORREOS ---------------------*/
  public function listaControlCorreos()
  {
    $conexion = $this->conectar();
    $sql = /* "SELECT control_correos.id, control_correos.sum_gastos , centro_costo.centro_costo, control_correos.fecha   FROM control_correos
    inner join centro_costo on centro_costo.id = presupuesto.centro_costo ;"; */
      "SELECT * FROM control_correos";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = null;
    return $array;
  }




  /* ---------------ACTUALIZAR UN SEMANA-------------------------- */
  public function actualizar($id, $fecha, $articulo, $valor_total, $proveedor, $detalles)
  {

    $mensaje = "";
    try {

      $conexion = Conexion::conectar();
      $sql = "UPDATE mantenimiento SET fecha=:fecha, articulo=:articulo, valor_total=:valor_total, proveedor=:proveedor, detalles=:detalles
       where id=:id ;";
      $stmt = $conexion->prepare($sql);

      $stmt->bindParam(":id", $id);
      $stmt->bindParam(":fecha", $fecha);
      $stmt->bindParam(":articulo", $articulo);
      $stmt->bindParam(":valor_total", $valor_total);
      $stmt->bindParam(":proveedor", $proveedor);
      $stmt->bindParam(":detalles", $detalles);

      $stmt->execute();
      $mensaje = "Se actualizo con exito!!";
    } // fin de try

    catch (PDOException $e) {

      $mensaje = "Problemas al Actualizar Consulte con el Administrador del Sistema!!";
    } // fin del catch

    return $mensaje;
  } // fin del metodo       

  /* ---------------ACTUALIZAR CENTRO DE COSTO-------------------------- */
  public function actualizarCcosto($id, $centro_costo, $nom_ccosto)
  {

    $mensaje = "";
    try {

      $conexion = Conexion::conectar();
      /*  UPDATE `centro_costo` SET `centro_costo` = 'lpp', `nom_ccosto` = 'asdasd' WHERE `centro_costo`.`centro_costo` = 'lpps';  */
      $sql = "UPDATE centro_costo SET centro_costo=:centro_costo, nom_ccosto=:nom_ccosto where  id=:id ;";
      $stmt = $conexion->prepare($sql);

      $stmt->bindParam(":id", $id);
      $stmt->bindParam(":centro_costo", $centro_costo);
      $stmt->bindParam(":nom_ccosto", $nom_ccosto);

      $stmt->execute();
      $mensaje = "Se actualizo con exito!!";
    } // fin de try

    catch (PDOException $e) {

      $mensaje = "Problemas al Actualizar Consulte con el Administrador del Sistema!!";
    } // fin del catch

    return $mensaje;
  } // fin del metodo       

  /* ---------------ACTUALIZAR PRESUPUESTO-------------------------- */
  public function actualizarPresupuesto($id, $fecha, $presupuesto)
  {

    $mensaje = "";
    try {

      $conexion = Conexion::conectar();
      /*  UPDATE `centro_costo` SET `centro_costo` = 'lpp', `nom_ccosto` = 'asdasd' WHERE `centro_costo`.`centro_costo` = 'lpps';  */
      $sql = "UPDATE presupuesto SET id=:id ,fecha=:fecha, presupuesto=:presupuesto where  id=:id ;";
      $stmt = $conexion->prepare($sql);

      $stmt->bindParam(":id", $id);
      $stmt->bindParam(":fecha", $fecha);
      $stmt->bindParam(":presupuesto", $presupuesto);

      $stmt->execute();
      $mensaje = "Se actualizo con exito!!";
    } // fin de try

    catch (PDOException $e) {

      $mensaje = "Problemas al Actualizar Consulte con el Administrador del Sistema!!";
    } // fin del catch

    return $mensaje;
  } // fin del metodo   

  /* ---------------ACTUALIZAR CONTROL DE CORREOS-------------------------- */
  public function actualizarControlCorreos($id, $sum_gastos, $fechaActual)
  {

    $mensaje = "";
    try {

      $conexion = Conexion::conectar();
      /*  UPDATE `centro_costo` SET `centro_costo` = 'lpp', `nom_ccosto` = 'asdasd' WHERE `centro_costo`.`centro_costo` = 'lpps';  */
      $sql = "UPDATE control_correos SET sum_gastos=:sum_gastos , fecha=:fecha where  id=:id ;";
      /*    UPDATE `control_correos` SET `sum_gastos` = '1000', `centro_costo` = '3', `fecha` = '2013-08-08' WHERE `control_correos`.`id` = 8;  */
      $stmt = $conexion->prepare($sql);

      $stmt->bindParam(":id", $id);
      $stmt->bindParam(":sum_gastos", $sum_gastos);
      $stmt->bindParam(":fecha", $fechaActual);

      $stmt->execute();
      $mensaje = "Se actualizo con exito!!";
    } // fin de try

    catch (PDOException $e) {

      $mensaje = "Problemas al Actualizar Consulte con el Administrador del Sistema!!";
    } // fin del catch

    return $mensaje;
  } // fin del metodo  

  /* ----------------ELIMINAR UNA SEMANA------------------ */

  public function eliminar($id)
  {
    $mensaje = "";
    try {

      $conexion = Conexion::conectar();
      $sql = "DELETE from mantenimiento WHERE id=:id;";
      $stmt = $conexion->prepare($sql);
      $stmt->bindParam(":id", $id);
      $stmt->execute();
      $mensaje = "Eliminó con Exito";
    } // fin del try

    catch (PDOException $e) {
      $mensaje = "Problemas al Eliminar consulte con el administrador";
    } // fin del catch

    return $mensaje;
  } // fin del metodo eliminarUsuario

  /* ----------------ELIMINAR UNA SEMANAS------------------ */
  public function EliminarTodo()
  {
    $mensaje = "";
    try {

      $conexion = Conexion::conectar();
      $sql = "DELETE from mantenimiento ;";
      $stmt = $conexion->prepare($sql);
      $stmt->execute();
      $mensaje = "Eliminó con Exito";
    } // fin del try

    catch (PDOException $e) {
      $mensaje = "Problemas al Eliminar consulte con el administrador";
    } // fin del catch

    return $mensaje;
  } // fin del metodo eliminarUsuario


  /* ----------------ELIMINAR CENTRO DE COSTO------------------ */

  public function eliminarCcosto($centro_costo)
  {
    $mensaje = "";
    try {

      $conexion = Conexion::conectar();
      $sql = "DELETE from centro_costo WHERE centro_costo=:centro_costo;";
      $stmt = $conexion->prepare($sql);
      $stmt->bindParam(":centro_costo", $centro_costo);
      $stmt->execute();
      $mensaje = "Eliminado con Exito";
    } // fin del try

    catch (PDOException $e) {
      $mensaje = "Problemas al Eliminar consulte con el administrador";
    } // fin del catch

    return $mensaje;
  } // fin del metodo eliminarUsuario

  /*  public function eliminarUsuarios()
  {
    $mensaje = "";
    try {

      $conexion = Conexion::conectar();
      $sql = "delete from usuario";
      $stmt = $conexion->prepare($sql);
      $stmt->execute();
      $mensaje = "Eliminó, Usuarios con Exito";
    } // fin del try

    catch (PDOException $e) {
      $mensaje = "Problemas al Eliminar consulte con el administrador";
    } // fin del catch

    return $mensaje;
  } */ // fin del metodo eliminarUsuario



}// fn de clase