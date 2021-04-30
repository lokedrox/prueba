<?php

   
   require_once '../../../modelo/semanadao.php';
   $dao=new semanaDao();
   $usuarios=$dao->lista();
   $tam=sizeof($usuarios);
   require_once 'vistamostrar.php';
