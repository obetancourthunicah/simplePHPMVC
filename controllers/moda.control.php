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
    $viewData["xcfrt"] = $_SESSION["xcfrt"];
    if (isset($_POST["btnDsp"])) {
        $mode = "DSP";
        $moda = obtenerModaPorId($_POST["idmoda"]);
        mergeFullArrayTo($moda, $viewData);
        $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscmoda"];
    }
    if (isset($_POST["btnUpd"])) {
        $mode = "UPD";
        //Vamos A Cargar los datos
        $moda = obtenerModaPorId($_POST["idmoda"]);
        mergeFullArrayTo($moda, $viewData);
        $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscmoda"];
    }
    if (isset($_POST["btnDel"])) {
        $mode = "DEL";
        //Vamos A Cargar los datos
        $moda = obtenerModaPorId($_POST["idmoda"]);
        mergeFullArrayTo($moda, $viewData);
        $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscmoda"];
    }
    if (isset($_POST["btnIns"])) {
        $mode = "INS";
        //Vamos A Cargar los datos
        $viewData["modeDsc"] = $modeDesc[$mode];
    }
    // if ($mode == "") {
    //     print_r($_POST);
    //     die();
    // }
    if (isset($_POST["btnConfirmar"])) {
        $mode = $_POST["mode"];
         mergeFullArrayTo($_POST, $viewData);
        switch($mode)
        {
        case 'INS':
            if (agregarNuevaModa(
                $viewData["dscmoda"],
                $viewData["prcmoda"],
                $viewData["ivamoda"],
                $viewData["estmoda"]
            )
            ) {
                redirectWithMessage(
                    "Moda Guardada Exitosamente",
                    "index.php?page=modas"
                );
                die();
            }
            break;
        case 'UPD':
            if (modificarModa(
                $viewData["dscmoda"],
                $viewData["prcmoda"],
                $viewData["ivamoda"],
                $viewData["estmoda"],
                $viewData["idmoda"]
            )
            ) {
                redirectWithMessage(
                    "Moda Actualizada Exitosamente",
                    "index.php?page=modas"
                );
                die();
            }
            break;
        case 'DEL':
            if (eliminarModa(
                $viewData["idmoda"]
            )
            ) {
                redirectWithMessage(
                    "Moda Eliminada Exitosamente",
                    "index.php?page=modas"
                );
                die();
            }
            break;
        }
    }
    $viewData["mode"] = $mode;
    renderizar("moda", $viewData);
}
run();
?>
