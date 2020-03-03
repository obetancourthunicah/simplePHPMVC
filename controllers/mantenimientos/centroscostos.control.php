<?php
require_once "models/mantenimientos/centroscostos.model.php";
function run()
{
    $arrViewData = array();
    $arrViewData["centroscostos"] = obtenerCentrosDeCostos();
    renderizar('mantenimientos/centroscostos', $arrViewData);
}
run();
?>
