<?php
/**
 * PHP Version 7
 * Controlador de Controlador
 *
 * @category Controllers_Dashboard
 * @package  Controllers\Dashboard
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS:1.0.0
 *
 * @link http://url.com
 */
 // Sección de requires

require_once "models/mantenimientos/productos.model.php";

/**
 * Corre el Controlador
 *
 * @return void
 */
function run()
{
    $arrDataView = array();
    $arrDataView["productos"] = productoCatalogo();
    renderizar("dashboard", $arrDataView);
}
run();
?>
