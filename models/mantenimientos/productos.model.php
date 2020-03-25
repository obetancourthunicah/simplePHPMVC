<?php

/**
 * Modelo Tabla Productos
 * 
 * @return array
 */

require_once "libs/dao.php";

function todosLosProductos()
{
    $sqlSelect = "SELECT * FROM productos;";

    return obtenerRegistros($sqlSelect);
}

function productoCatalogo()
{
    $sqlSelect = "SELECT codprd, dscprd, stkprd, skuprd, urlthbprd, prcprd from productos where estprd in('ACT','DSC');";
    $tmpProducto =  obtenerRegistros($sqlSelect);
    $assocProducto = array();
    foreach ($tmpProducto as $producto) {
    //Cambiando a imagen predeterminada si no hay imagen
        $assocProducto[$producto["codprd"]] = $producto;
        if (preg_match('/^\s*$/', $producto["urlthbprd"])) {
            $assocProducto[$producto["codprd"]]["urlthbprd"] = "public/imgs/noprodthb.png";
        }
    }
    $timeDelta =  6 * 60 * 60; //h , m, s
    $sqlSelectReserved = "select codprd, sum(crrctd) as reserved
    from carretilla where TIME_TO_SEC(TIMEDIFF(now(), crrfching)) <= %d
    group by codprd;
    ";
    $arrReserved = obtenerRegistros(
        sprintf(
            $sqlSelectReserved,
            $timeDelta
        )
    );
    foreach ($arrReserved as $reserved) {
        if (isset($assocProducto[$reserved["codprd"]])) {
            $assocProducto[$reserved["codprd"]]["stkprd"] = $assocProducto[$reserved["codprd"]]["stkprd"] - $reserved["reserved"];
        }
    }
    return $assocProducto;
}

function obtenerUnProducto($codprd)
{
    $sqlSelect = "SELECT * FROM productos WHERE codprd = %d;";

    return obtenerUnRegistro(
      sprintf($sqlSelect, $codprd)
    );
}

function insertProducto($dscprd, $sdscprd, $ldscprd, $skuprd, $bcdprd, $stkprd, $typprd, $prcprd, $urlprd, $urlthbprd, $estprd)
{
    $sqlInsert = "INSERT INTO productos (dscprd, sdscprd, ldscprd, skuprd, bcdprd, stkprd, typprd, prcprd, urlprd, urlthbprd, estprd) 
                  VALUES ('%s', '%s', '%s', '%s', '%s', %d, '%s', %lf, '%s', '%s', '%s');";

    $isOk = ejecutarNonQuery(
      sprintf($sqlInsert, $dscprd, $sdscprd, $ldscprd, $skuprd, $bcdprd, $stkprd, $typprd, $prcprd, '', '', $estprd)
    );

    return getLastInserId();
}

function updateProducto($dscprd, $sdscprd, $ldscprd, $skuprd, $bcdprd, $stkprd, $typprd, $prcprd, $urlprd, $urlthbprd, $estprd, $codprd)
{
    $sqlUpdate = "UPDATE productos SET dscprd = '%s', sdscprd = '%s', ldscprd = '%s', skuprd = '%s', bcdprd = '%s', stkprd = %d,
                  typprd = '%s', prcprd = %lf, estprd = '%s' WHERE codprd = %d;";

    return ejecutarNonQuery(
      sprintf($sqlUpdate, $dscprd, $sdscprd, $ldscprd, $skuprd, $bcdprd, $stkprd, $typprd, $prcprd, $estprd, $codprd)
    );
}

function setImageProducto($url, $codprd, $type="PRT")
{
    $sqlUpdatePRT = "UPDATE productos SET urlprd = '%s' WHERE codprd = %d;";
    $sqlUpdateTHB = "UPDATE productos SET urlthbprd = '%s' WHERE codprd = %d;";
    $sqlUpdate = ($type === "PRT") ? $sqlUpdatePRT : $sqlUpdateTHB;
    return ejecutarNonQuery(
        sprintf(
            $sqlUpdate,
            $url,
            $codprd
        )
    );
}


function deleteProducto($codprd)
{
    $sqlDelete = "DELETE FROM productos WHERE codprd = %d;";

    return ejecutarNonQuery(
        sprintf($sqlDelete, $codprd)
    );
}

?>
