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
    $estadoModas = obtenerEstados();
    $selectedEst = 'PLN';
    $mode = "";
    $errores=array();
    $hasError = false;
    $modeDesc = array(
      "DSP" => "Moda ",
      "INS" => "Creando Nueva Moda",
      "UPD" => "Actualizando Moda ",
      "DEL" => "Eliminando Moda "
    );
    $viewData = array();
    $viewData["showIdModa"] = true;
    $viewData["showBtnConfirmar"] = true;
    $viewData["readonly"] = '';
    $viewData["selectDisable"] = '';

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
        $viewData["showBtnConfirmar"] = false;
        $viewData["readonly"] = 'readonly';
        $viewData["selectDisable"] = 'disabled';
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
        $viewData["readonly"] = 'readonly';
        $viewData["selectDisable"] = 'disabled';
        mergeFullArrayTo($moda, $viewData);
        $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscmoda"];
    }
    if (isset($_POST["btnIns"])) {
        $mode = "INS";
        //Vamos A Cargar los datos
        $viewData["modeDsc"] = $modeDesc[$mode];
         $viewData["showIdModa"]  = false;
    }
    // if ($mode == "") {
    //     print_r($_POST);
    //     die();
    // }
    if (isset($_POST["btnConfirmar"])) {
        $mode = $_POST["mode"];
        $selectedEst = $_POST["estmoda"];
         mergeFullArrayTo($_POST, $viewData);
        switch($mode)
        {
        case 'INS':
            $viewData["showIdModa"] = false;
            $viewData["modeDsc"] = $modeDesc[$mode];
            //validaciones
            if (floatval($viewData["prcmoda"]) <= 0) {
                $errores[] = "El precio de la moda no puede ser 0";
                $hasError = true;
            }
            if (!$hasError && agregarNuevaModa(
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
            $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscmoda"];
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
            $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscmoda"];
            $viewData["readonly"] = 'readonly';
            $viewData["selectDisable"] = 'disabled';
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
    $viewData["estadosModa"] = addSelectedCmbArray($estadoModas, 'cod', $selectedEst);
    $viewData["hasErrors"] = $hasError;
    $viewData["errores"] = $errores;
    renderizar("moda", $viewData);
}
run();
?>
