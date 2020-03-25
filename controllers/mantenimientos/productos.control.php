<?php
/**
 * PHP Version 7
 * Controlador de Productos
 *
 * @category Controllers_Productos
 * @package  Controllers\Productos
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS:1.0.0
 *
 * @link http://url.com
 */
require_once "models/mantenimientos/productos.model.php";
/**
 * Controlador Tabla Productos
 *
 * @return void
 */
function run()
{
    $arrViewData = array();
    $arrViewData["productos"] = todosLosProductos();
    renderizar("mantenimientos/productos", $arrViewData);
}
run();
