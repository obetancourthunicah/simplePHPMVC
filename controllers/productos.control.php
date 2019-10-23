<?php
require_once 'models/productos.model.php';

function run(){
    $viewData = array();
    $viewData["username"] = "Orlando J Betancourth";
    $viewData["productos"] = obtenerTodosProductos();
    renderizar("productos", $viewData);
}

run();
?>
