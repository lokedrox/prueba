<div class=" col-12 ">
  <ul class="nav nav-pills mb-3">
    <li class="nav-item">
      <a class="nav-link  bordes p-3
      <?php
      if ($action == "mostrar") echo "active";
      ?>
      " href="?action=mostrar">Lista Gastos</a>
    </li>

    <li class="nav-item">
      <a class="nav-link  bordes p-3
      <?php
      if ($action == "mostrarCcosto") echo "active";
      ?>
      " href="?action=mostrarCcosto">Lista Centros de Costo</a>
    </li>

    <li class="nav-item">
      <a class="nav-link  bordes p-3
      <?php
      if ($action == "mostrarPresupuesto") echo "active";
      ?>
      " href="?action=mostrarPresupuesto">Lista Presupuesto</a>
    </li>

    <li class="nav-item">
      <a class="nav-link bordes p-3
      <?php
      if ($action == "guardarpresupuesto") echo "active";
      ?>
      " href="?action=guardarpresupuesto">Control Presupuesto</a>
    </li>

    <li class="nav-item">
      <a class="nav-link bordes p-3
      
      <?php
      if ($action == "guardar") echo "active";
      ?> 
      " href="?action=guardar">Agregar Gasto</a>
    </li>

    <li class="nav-item">
      <a class="nav-link bordes p-3
      
      <?php
      if ($action == "guardarCcosto") echo "active";
      ?> 
      " href="?action=guardarCcosto">Agregar Centro de Costo</a>
    </li>


    <li class="nav-item">
      <a class="nav-link bordes p-3
      
      <?php
      if ($action == "guardarPresupuesto") echo "active";
      ?> 
      " href="?action=guardarPresupuesto">Agregar Presupuesto</a>
    </li>
  </ul>
</div>