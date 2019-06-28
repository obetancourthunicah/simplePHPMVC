<?php
/**
 * Modelo de Datos de Los PArametros de la APlicación
 */

require_once "libs/dao.php";
/**
 * Obtiene los datos de la aplicación
 *
 * @return Array
 */
function obtenerDatosDeAplicacion()
{
    $sqlstr = "SELECT * from application;";
    return obtenerUnRegistro($sqlstr);
}

 ?>
