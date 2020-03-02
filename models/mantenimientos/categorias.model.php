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

function guardarNuevaCategoria($ctgdsc, $ctgest){
    $sqlIns = "INSERT into categorias (ctgdsc, ctgest) values ('%s', '%s');";
    $isOK = ejecutarNonQuery(
        sprintf($sqlIns, $ctgdsc, $ctgest)
    );
    return getLastInserId();
}

function obtenerCategoriaPorCodigo($ctgcod)
{
    $sqlstr = "SELECT * from categorias where ctgcod = %d;";
    return obtenerUnRegistro(
        sprintf($sqlstr, $ctgcod)
    );
}

function actualizarCategoria($ctgcod, $ctgdsc, $ctgest)
{
    $sqludp = "update categorias set ctgdsc = '%s', ctgest='%s' where ctgcod=%d;";
    return ejecutarNonQuery(sprintf($sqludp, $ctgdsc, $ctgest, $ctgcod));
}

function eliminarCategoria($ctgcod)
{
    $sqldel = "delete from categorias where ctgcod=%d";
    return ejecutarNonQuery(
        sprintf($sqldel, $ctgcod)
    );
}
?>
