<?php 
/**
 * PHP Version 7
 * Controlador de Controlador
 *
 * @category Controllers_Almacenes
 * @package  Controllers\Almacenes
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS:1.0.0
 *
 * @link http://url.com
 */
  // Sección de requires
require_once 'models/almacenes.model.php';
/**
 * Corre el Controlador
 *
 * @return void
 */
function run()
{
    $arrDataView = array();

    $arrDataView["almacenes"] = obtenerAlmacenes();
    renderizar("almacenes", $arrDataView);
    //renderizar("Controlador",array());
}
// Correr el controlador
run();
?>
