<?php

/**
 * PHP Version 7
 * Controlador de CartAnon
 *
 * @category Controllers_CartAnon
 * @package  Controllers\CartAnon
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
 * Corre el Controlador de CartAnon
 *
 * @return void
 */
function run()
{
    $cartAnonUniqueID = '';
    if (isset($_SESSION["cart_anon_uid"])) {
        $cartAnonUniqueID = $_SESSION["cart_anon_uid"];
    }
    if ($cartAnonUniqueID === '') {
        $cartAnonUniqueID = time() . random_int(1000, 9999);
    }
    $_SESSION["cart_anon_uid"] = $cartAnonUniqueID;
    $arrDataView = array();
    $arrDataView = getAnonCartDetail($cartAnonUniqueID);
    renderizar("retail/cartauth", $arrDataView);
}
// Correr el controlador
run();

?>
