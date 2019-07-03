<?php
/* Modas Controller
 * 2019-07-01
 * Created By OJBA
 */

require 'models/modas.model.php';
/**
 * Controla la lista del Patron Trabajar Con
 *
 * @return void
 */
function run()
{
    $viewData = array();
    $viewData["xcfrt"] = md5(microtime());
    $_SESSION["xcfrt"] = $viewData["xcfrt"];
    $viewData["modas"] = obtenerModas();
    renderizar("modas", $viewData);
}
  run();
?>
