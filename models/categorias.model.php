<?php 

require_once 'libs/dao.php';

function obtenerCategorias()
{
    $categorias = array();
    $sqlstr = "SELECT * from categorias;";
    $categorias = obtenerRegistros($sqlstr);
    return $categorias;
}

function obtenerCategoriaXId($catid)
{
    $arrCategoria = array();
    $sqlstr = "SELECT * from categorias where catid=%d;";
    $arrCategoria = obtenerUnRegistro(sprintf($sqlstr, $catid));
    return $arrCategoria;
}
?>
