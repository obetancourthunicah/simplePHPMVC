<?php
/**
 * PHP Version 7
 * Modelo de Datos para modelo
 *
 * @category Data_Model
 * @package  Models${1:modelo}
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version SVN:1.0.0
 *
 * @link http://url.com
 */
require_once 'libs/dao.php';

/*
`almcod` BIGINT(18) NOT NULL AUTO_INCREMENT,
`almdsc` VARCHAR(75) NULL,
`almtyp` CHAR(3) NULL,
`almest` CHAR(3) NULL,
*/

/**
 * Obtiene todos los almacenes de la tabla
 *
 * @return array Arreglo con los Registros de Almacenes
 */
function obtenerAlmacenes()
{
    $sqlstr = "SELECT * from almacenes;";
    return obtenerRegistros($sqlstr);
}

/**
 * Obtiene un Almacen por Código
 *
 * @param integer $almcod Código del Almacén
 *
 * @return array Registro identificado por $almcod
 */
function obtenerAlmacenXId ($almcod)
{
    $sqlstr = "SELECT * from almacenes where almcod=%d;";
    return obtenerUnRegistro(
        sprintf(
            $sqlstr,
            $almcod
        )
    );
}

/**
 * Agrega un nuevo almacén
 *
 * @param string $almdsc Nombre del Almacén
 * @param string $almtyp Tipo de Almacén (WHR Warehouse, RTL Retail, TRS transport)
 * @param string $almest Estado del Almacén (ACT Activo, PLN En Construcción, INA Inactivo)
 *
 * @return boolean True si se agregó un nuevo registro, False si exite algún error.
 */
function agregarAlmacen($almdsc, $almtyp, $almest)
{
    $sqlins = "INSERT INTO almacenes( almdsc, almtyp, almest) values ('%s','%s','%s');";

    return ejecutarNonQuery(
        sprintf(
            $sqlins,
            $almdsc,
            $almtyp,
            $almest
        )
    );

}

/**
 * Actualiza el Almacen Identificado por AlmCod
 *
 * @param string  $almdsc Nombre del Almacén
 * @param string  $almtyp Tipo de Almacén
 * @param string  $almest Estado de Almacén
 * @param integer $almcod Código del Almacén
 *
 * @return boolean True si se actualizó el registro, False si exite algún error.
 */
function actualizarAlmacen($almdsc, $almtyp, $almest , $almcod)
{
    $sqlupd = "UPDATE almacenes set almdsc='%s', almtyp='%s', almest='%s' where almcod=%d;";

    return ejecutarNonQuery(
        sprintf(
            $sqlupd,
            $almdsc,
            $almtyp,
            $almest,
            $almcod
        )
    );
}

/**
 * Elimina un Almacén identificado por almcod
 *
 * @param integer $almcod Código del Almacén
 *
 * @return boolean True si se eliminó el registro, False si exite algún error.
 */
function eliminarAlmacen($almcod)
{
    $sqldel = "DELETE FROM almacenes where almcod=%d;";
    return ejecutarNonQuery(
        sprintf(
            $sqldel,
            $almcod
        )
    );
}

?>
