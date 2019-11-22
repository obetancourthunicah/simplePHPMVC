<?php
require_once 'models/productos.model.php';

function run(){
    $viewData = array();
    $viewData["categorias"] = obtenerCategorias();
    $viewData["funnyData"] = "Esto es algo gracioso";
    renderizar("cats", $viewData);
}

run();
?>
