<?php
require_once "models/mantenimientos/categorias.model.php";
/**
 * Controlador de Lista de Categorias WW
 *
 * @return void
 */
function run()
{
    $arrViewData = array();
    $arrViewData["categorias"] = obtenerTodasCategorias();
    renderizar('mantenimientos/categorias', $arrViewData);
}

run();

?>
