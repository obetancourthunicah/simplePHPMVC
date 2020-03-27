<?php
/**
 * PHP Version 5
 * Controlador de los Eventos por Flujo Por Categoría
 *
 * @category Utilities
 * @package  DAO
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version 1.0.0
 *
 * @link http://url.com
 */
require_once "libs/parameters.php";


$conexion = new mysqli(
    $server, $user, $pswd, $database, $port
);

if ($conexion->connect_errno ) {
    die($conexion->connect_error);
}

$conexion->set_charset("utf8");

// Establecer lo zona horaria de la conexion
$conexion->query("SET time_zone = '-6:00'");
/**
 * Obtener Registros
 *
 * @param string $sqlstr   Cadena SQL a ejecutar
 * @param object $conexion Objecto de Conexión por Referencia
 * 
 * @return array
 */
function obtenerRegistros($sqlstr, &$conexion = null )
{
    if (!$conexion) {
        global $conexion;
    } 
    $result = $conexion->query($sqlstr);
    if ($conexion->connect_errno ) {
        error_log($conexion->connect_error);
    } 
    $resultArray = array();

    if (isset($result) && $result != '' ) {
        foreach ($result as $registro ) {
            $resultArray[] = $registro;
        }
        $result->free();
    }
    return $resultArray;
}

/**
 * Obtener Registro
 *
 * @param string $sqlstr   Cadena SQL a ejecutar
 * @param object $conexion Objecto de Conexión por Referencia
 * 
 * @return array
 */
function obtenerUnRegistro($sqlstr, &$conexion = null ) 
{
    if (!$conexion) {
        global $conexion;
    }
    $result = $conexion->query($sqlstr);
    if ($conexion->errno ) {
        error_log($conexion->error);
    }
    $resultArray = array();
    $resultArray = $result->fetch_assoc();
    $result->free();
    return $resultArray;
}
/**
 * Inicia la Transacción en Mysql
 *
 * @param object $conexion Objecto de Conexión por Referencia
 * 
 * @return void
 */
function iniciarTransaccion(&$conexion = null ) 
{
    if (!$conexion) {
        global $conexion;
    } 
    $conexion->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
    if ($conexion->errno ) {
        error_log($conexion->error);
    }
}
/**
 * Termina la Transacción en Mysql
 *
 * @param boolean $commit   Verdadero Confirma los Cambios en la Base de Datos
 * @param object  $conexion Objecto de Conexión por Referencia
 * 
 * @return void
 */
function terminarTransaccion($commit=true,&$conexion = null)
{
    if (!$conexion) {
        global $conexion;
    } 
    if ($commit && true ) {
        $conexion->commit();
        if ($conexion->errno ) {
            error_log($conexion->error);
        }
    } else {
        $conexion->rollback();
        if ($conexion->errno ) {
            error_log($conexion->error);
        }
    }
}
/**
 * Ejecuta query sin resultado Update, Insert o Delete
 *
 * @param string $sqlstr   Cadena SQL a ejecutar
 * @param object $conexion Objecto de Conexión por Referencia
 * 
 * @return integer Número de Registro Afectados
 */
function ejecutarNonQuery($sqlstr, &$conexion = null)
{
    if (!$conexion ) {
        global $conexion;
    } 
    $result = $conexion->query($sqlstr);
    if ($conexion->errno ) {
        error_log($conexion->error);
    }
    return $conexion->affected_rows >= 0; 
}
/**
 * Convierta Cadenas de Texto Peligrosas en Sanas para Queries
 *
 * @param string $str      Cadena de Texto a sanear
 * @param object $conexion Objecto de Conexión por Referencia 
 * 
 * @return string
 */
function valstr($str, &$conexion = null)
{
    if (!$conexion ) {
        global $conexion;
    } 
    return $conexion->escape_string($str);
}
/**
 * Obtiene el Último Autonumérico generado
 *
 * @param object $conexion Objecto de Conexión por Referencia 
 * 
 * @return integer
 */
function getLastInserId(&$conexion = null) 
{
    if (!$conexion ) {
        global $conexion;
    } 
    return $conexion->insert_id;
}
/**
 * Muestra los Errores de la Conexión de la última ejecución de comandos
 * en el cliente de Mysql
 *
 * @param object $conexion Objecto de Conexión por Referencia 
 * 
 * @return string
 */
function showErrors(&$conexion = null)
{
    if (!$conexion ) {
        global $conexion;
    } 
    echo $conexion->error;
}
?>
