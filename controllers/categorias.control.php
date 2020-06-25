<?php

require_once 'models/categorias.model.php';
function run(){
    $arrDataView = array();
    $arrDataView["categorias"] = obtenerCategorias();
    renderizar("categorias", $arrDataView);
}
run();

?>
