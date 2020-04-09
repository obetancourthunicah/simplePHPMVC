<?php
/**
 * PHP Version 5
 * Application Router
 *
 * @category Router
 * @package  Router
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @author   Luis Fernando Gomez Figueroa <lgomezf16@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS: 1.0.0
 *
 * @link http://url.com
 */
session_start();

require_once "libs/utilities.php";

$pageRequest = "home";

if (isset($_GET["page"])) {
    $pageRequest = $_GET["page"];
}

//Incorporando los midlewares son codigos que se deben ejecutar
//Siempre
require_once "controllers/mw/verificar.mw.php";
require_once "controllers/mw/site.mw.php";
require_once "controllers/retail/mw/cart.mw.php";
// aqui no se toca jajaja la funcion de este index es
// llamar al controlador adecuado para manejar el
// index.php?page=modulo

    //Este switch se encarga de todo el enrutamiento público
switch ($pageRequest) {
    //Accesos Publicos
case "home":
    //llamar al controlador
    include_once "controllers/home.control.php";
    die();
case "login":
    include_once "controllers/security/login.control.php";
    die();
case "logout":
    include_once "controllers/security/logout.control.php";
    die();
case "ficha":
    include_once "controllers/ficha.control.php";
    die();
case 'register':
    include_once "controllers/security/register.control.php";
    die();
case "addtocart":
    include_once "controllers/retail/addtocart.control.php";
    die();
case "rmvtocart":
    include_once "controllers/retail/rmvtocart.control.php";
    die();
case "cartanon":
    include_once "controllers/retail/cartanon.control.php";
    die();
case "rmvallcart":
    include_once "controllers/retail/rmvAllCart.control.php";
    die();

}


//Este switch se encarga de todo el enrutamiento que ocupa login
$logged = mw_estaLogueado();
if ($logged) {
    addToContext("layoutFile", "verified_layout");
    include_once 'controllers/mw/autorizar.mw.php';
    if (!isAuthorized($pageRequest, $_SESSION["userCode"])) {
        include_once"controllers/notauth.control.php";
        die();
    }
    generarMenu($_SESSION["userCode"]);
}

require_once "controllers/mw/support.mw.php";
switch ($pageRequest) {
case "dashboard":
    ($logged)?
      include_once "controllers/dashboard.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "security":
    ($logged)?
      include_once "controllers/security/security.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "users":
    ($logged)?
      include_once "controllers/security/users.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "user":
    ($logged)?
      include_once "controllers/security/user.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "roles":
    ($logged)?
      include_once "controllers/security/roles.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "rol":
    ($logged)?
      include_once "controllers/security/rol.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "programas":
    ($logged)?
      include_once "controllers/security/programas.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "programa":
    ($logged)?
      include_once "controllers/security/programa.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "parametros":
    ($logged) ?
      include_once "controllers/mantenimientos/mantenimientos.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "categorias":
    ($logged) ?
      include_once "controllers/mantenimientos/categorias.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "categoria":
    ($logged) ?
      include_once "controllers/mantenimientos/categoria.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
    //Centro de Costos
case "centros_de_costos":
    ($logged) ?
      include_once "controllers/mantenimientos/centroscostos.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "centro_de_costos":
    ($logged) ?
      include_once "controllers/mantenimientos/centrocostos.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "productos":
    ($logged) ?
      include_once "controllers/mantenimientos/productos.control.php" :
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "producto":
    ($logged) ?
      include_once "controllers/mantenimientos/producto.control.php" :
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "productimg":
    ($logged) ?
      include_once "controllers/mantenimientos/productimg.control.php" :
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "cartauth":
    ($logged) ?
      include_once "controllers/retail/cartauth.control.php" :
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "checkout":
    ($logged) ?
      include_once "controllers/retail/paypal/checkout.control.php" :
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "checkoutapr":
    ($logged) ?
      include_once "controllers/retail/paypal/checkoutapproved.control.php" :
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
case "checkoutcnl":
    ($logged) ?
      include_once "controllers/retail/paypal/checkoutcancel.control.php" :
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    die();
}

addToContext("pageRequest", $pageRequest);
require_once "controllers/error.control.php";
