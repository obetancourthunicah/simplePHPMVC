<?php
/* Home Controller
 * 2014-10-14
 * Created By OJBA
 * Last Modification 2014-10-14 20:04
 */
require_once "models/mantenimientos/productos.model.php";
function run(){
    $arrDataView = array();
    $arrDataView["productos"] = todosLosProductos();
    renderizar("home", $arrDataView);
}
run();
?>
