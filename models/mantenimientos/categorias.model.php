<?php

require_once 'libs/dao.php';
/**
 * Obtiene todas las Categorias de Las Encuestas
 *
 * @return array Arreglo con los Registro de Categorías
 */
function obtenerTodasCategorias()
{
    $arrCategorias = array();
    $strSelect = "SELECT * from categorias;";
    $arrCategorias = obtenerRegistros($strSelect);
    return $arrCategorias;
}

?>
