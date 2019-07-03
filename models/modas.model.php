<?php 

require_once "libs/dao.php";
/*
    idmoda bigint(15) AI PK
    dscmoda varchar(60)
    blogmoda mediumtext
    bannermod varchar(512)
    thumbmoda varchar(512)
    modelmoda varchar(512)
    prcmoda decimal(15,2)
    ivamoda decimal(5,2)
    estmoda char(3)
    idcategoria bigint(15)

    `modas`.`idmoda`,
    `modas`.`dscmoda`,
    `modas`.`blogmoda`,
    `modas`.`bannermod`,
    `modas`.`thumbmoda`,
    `modas`.`modelmoda`,
    `modas`.`prcmoda`,
    `modas`.`ivamoda`,
    `modas`.`estmoda`,
    `modas`.`idcategoria`
*/
/**
 * Obtiene los registro de la tabla de modas
 *
 * @return Array
 */
function obtenerModas()
{
    $sqlstr = "select `modas`.`idmoda`,
    `modas`.`dscmoda`,
    `modas`.`prcmoda`,
    `modas`.`ivamoda`,
    `modas`.`estmoda` from `modas`";

    $modas = array();
    $modas = obtenerRegistros($sqlstr);
    return $modas;
}

/**
 * Obtiene una moda por ID
 *
 * @param number $id identificador de la moda
 *
 * @return void
 */
function obtenerModaPorId($id)
{
    $sqlstr = "select `modas`.`idmoda`,
    `modas`.`dscmoda`,
    `modas`.`prcmoda`,
    `modas`.`ivamoda`,
    `modas`.`estmoda` from `modas` where idmoda=%d";

    $modas = array();
    $modas = obtenerUnRegistro(sprintf($sqlstr, $id));
    return $modas;
}
?>
