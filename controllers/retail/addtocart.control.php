<?php

/**
 * PHP Version 7
 * Controlador de Controlador
 *
 * @category Controllers_AddToCart
 * @package  Controllers\Controllers_AddToCart
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
    $resultArray = array();
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["codprd"])) {
        $codprd = intval($_GET["codprd"]);
        $cantidad = 1;
        $producto = obtenerUnProducto($codprd);
        if (count($producto) <= 0) {
              $resultArray["msg"] = "No se encontró producto";
              header('Content-Type: application/json');
              echo json_encode($resultArray);
              die();
        }
        $precio = $producto["prcprd"];
        if (mw_estaLogueado()) {
            // agregar a carretilla autenticada
            $resultArray["msg"] = "Agregando a Carretilla Autenticada";
            $usuario = $_SESSION["userCode"];
            addToCartAuth($codprd, $usuario, $cantidad, $precio);
            $resultArray["cartAmount"] = getCartProducts($usuario);
        } else {
            // agregar a carretilla no autenticada
            $cartAnonUniqueID = '';
            if (isset($_SESSION["cart_anon_uid"])) {
                $cartAnonUniqueID = $_SESSION["cart_anon_uid"];
            }
            if ($cartAnonUniqueID === '') {
                $cartAnonUniqueID = time() . random_int(1000, 9999);
            }
            $_SESSION["cart_anon_uid"] = $cartAnonUniqueID;
            $resultArray["msg"] = "Agregando a Carretilla No Autenticada";
            addToCartAnon($codprd, $cartAnonUniqueID, $cantidad, $precio);
            $resultArray["cartAmount"] = getCartProductsData($cartAnonUniqueID);
        }
    } else {
        $resultArray["msg"] = "Esta tratando de hacer al incorrecto";
    }
    header('Content-Type: application/json');
    echo json_encode($resultArray);
    die();
}
// Correr el controlador
run();

?>
