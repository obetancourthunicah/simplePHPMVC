<?php

require_once 'libs/dao.php';

function obtenerTodosProductos(){
    /*$conn = new mysqli('server','user','pswd','db','port');
    if($conn->errno > 0){
      die();
    }
    $cursor = $conn->query("select * from productos;");
    $productos = array();
    if($cursor){
      foreach ($cursor as $registro){
        $productos[] = $registro;
      }
    }
    return $productos;
    */
    $productos = array();
    $productos = obtenerRegistros("select * from productos");
    return $productos;
}

?>
