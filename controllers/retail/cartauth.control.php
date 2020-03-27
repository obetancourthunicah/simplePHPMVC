<?php

/**
 * PHP Version 7
 * Controlador de CartAuth
 *
 * @category Controllers_CartAuth
 * @package  Controllers\CartAuth
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
 * Corre el Controlador de cartauth
 *
 * @return void
 */
function run()
{
    $usuario = $_SESSION["userCode"];
    $arrDataView = array();
    $arrDataView = getAuthCartDetail($usuario);
    renderizar("retail/cartauth", $arrDataView);
}
// Correr el controlador
run();

?>
