<?php
/* Moda Controller
 * 2019-07-01
 * Created By OJBA
 */

require 'models/modas.model.php';
/**
 * Controla la vista de Moda (Un Registro) en modo INS, UPD, DEL, DSP
 *
 * @return void
 */
function run()
{
    $mode = "";
    $modeDesc = array(
      "DSP" => "Moda ",
      "INS" => "Creando Nueva Moda",
      "UPD" => "Actualizando Moda ",
      "DEL" => "Eliminando Moda "
    );
    $viewData = array();
    if (isset($_POST["xcfrt"]) && isset($_SESSION["xcfrt"]) &&  $_SESSION["xcfrt"] !== $_POST["xcfrt"]) {
        redirectWithMessage(
            "Petición Solicitada no es Válida",
            "index.php?page=modas"
        );
        die();
    }
    if (isset($_POST["btnDsp"])) {
        $mode = "DSP";
        $moda = obtenerModaPorId($_POST["idmoda"]);
        mergeFullArrayTo($moda, $viewData);
        $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscmoda"];
    }
    if (isset($_POST["btnUpd"])) {
        $mode = "UPD";
        //Vamos A Cargar los datos
        $viewData["modeDsc"] = $modeDesc[$mode];
    }
    if (isset($_POST["btnDel"])) {
        $mode = "DEL";
        //Vamos A Cargar los datos
        $viewData["modeDsc"] = $modeDesc[$mode];
    }
    if (isset($_POST["btnIns"])) {
        $mode = "INS";
        //Vamos A Cargar los datos
        $viewData["modeDsc"] = $modeDesc[$mode];
    }
    renderizar("moda", $viewData);
}
run();
?>
