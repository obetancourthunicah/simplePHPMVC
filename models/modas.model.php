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
/**
 * Agrega nuevo Moda a la tabla
 *
 * @param string $dscmoda Descripción de la Moda
 * @param double $prcmoda Precio de la moda
 * @param double $ivamoda Impuesto de la moda 0 - 1
 * @param string $estmoda Estado de la Moda [ACT, INA, PLN, RET]
 *
 * @return integer affected rows
 */
function agregarNuevaModa($dscmoda, $prcmoda, $ivamoda, $estmoda) {
    $insSql = "INSERT INTO modas(dscmoda, prcmoda, ivamoda, estmoda)
      values ('%s', %f, %f, '%s');";
      if (ejecutarNonQuery(
          sprintf(
              $insSql,
              $dscmoda,
              $prcmoda,
              $ivamoda,
              $estmoda
          )))
      {
        return getLastInserId();
      } else {
          return false;
      }
}

function modificarModa($dscmoda, $prcmoda, $ivamoda, $estmoda, $idmoda) 
{
    $updSQL = "UPDATE modas set dscmoda='%s', prcmoda=%f,
    ivamoda=%f, estmoda='%s' where idmoda=%d;";

    return ejecutarNonQuery(
        sprintf(
            $updSQL,
            $dscmoda,
            $prcmoda,
            $ivamoda,
            $estmoda,
            $idmoda
        )
    );
}
function eliminarModa($idmoda)
{
    $delSQL = "DELETE FROM modas where idmoda=%d;";

    return ejecutarNonQuery(
        sprintf(
            $delSQL,
            $idmoda
        )
    );
}

function obtenerEstados()
{
    return array(
        array("cod"=>"ACT", "dsc"=>"Activo"),
        array("cod"=>"INA", "dsc"=>"Inactivo"),
        array("cod"=>"PLN", "dsc"=>"En Planificación"),
        array("cod"=>"RET", "dsc"=>"Retirado"),
        array("cod"=>"SUS", "dsc"=>"Suspendido"),
        array("cod"=>"DES", "dsc"=>"Descontinuado")
    );
}
?>
