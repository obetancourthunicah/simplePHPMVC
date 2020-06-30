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

function addNuevaCategoria($catdsc, $catest)
{
    $sqlINS = "INSERT INTO categorias (catdsc, catest) value ('%s' , '%s');";
    ejecutarNonQuery(
        sprintf(
            $sqlINS,
            $catdsc,
            $catest
        )
    );
    $id = getLastInserId();
    return $id;
}

function actualizarCategoria($catid, $catdsc, $catest)
{
    $sqlUPD = "UPDATE categorias set catdsc='%s', catest='%s' where catid=%d;";
    return ejecutarNonQuery(
        sprintf(
            $sqlUPD,
            $catdsc,
            $catest,
            $catid
        )
    );
}

function eliminarCategoria($catid)
{
    $sqlDEL = "DELETE from categorias where catid=%d;";
    return ejecutarNonQuery(
        sprintf(
            $sqlDEL,
            $catid
        )
    );
}

?>
