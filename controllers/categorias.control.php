<?php

require_once 'models/categorias.model.php';
function run(){
    $arrDataView = array();
    $arrDataView["categorias"] = obtenerCategorias();
   // addCssRef("public/css/pagina2.css");
    //addJsRef("public/js/scripx.js");
    renderizar("categorias", $arrDataView);
}
run();

?>
