<?php 
require_once "models/mantenimientos/centroscostos.model.php";
function run()
{
    $arrModesDsc = array(
        "INS" => "Nuevo Centro de Costos",
        "UPD" => "Actualizando CC %s %s",
        "DEL" => "Eliminando CC %s %s",
        "DSP" => "%s %s",
    );
    $arrDataView = array();
    $arrDataView["cccod"]=0;
    $arrDataView["ccdsc"] = "";
    $arrDataView["ccest"] = "ACT";
    $arrDataView["ccest_ACT"] = "";
    $arrDataView["ccest_INA"] = "";
    $arrDataView["mode"] = "INS";
    $arrDataView["modedsc"] = "";

    if ($_SERVER["REQUEST_METHOD"]==="GET") {
        $arrDataView["mode"] = $_GET["mode"];
        $arrDataView["cccod"] = $_GET["cccod"];
    }
    if ($_SERVER["REQUEST_METHOD"]==="POST") {
        $arrDataView["cccod"] = $_POST["cccod"];
        $arrDataView["ccdsc"] = $_POST["ccdsc"];
        $arrDataView["ccest"] = $_POST["ccest"];
        $arrDataView["mode"] = $_POST["mode"];
        switch($arrDataView["mode"])
        {
        case "INS":
            agregCentroCosts(
                $arrDataView["ccdsc"],
                $arrDataView["ccest"]
            );
            redirectWithMessage("Guardado", "index.php?page=centros_de_costos");
            break;
        case "UPD":
            actualizarCC(
                $arrDataView["ccdsc"],
                $arrDataView["ccest"],
                $arrDataView["cccod"]
            );
            redirectWithMessage("Actualizado", "index.php?page=centros_de_costos");
            break;
        case "DEL":
            eliminarCC($arrDataView["cccod"]);
            redirectWithMessage("Eliminado", "index.php?page=centros_de_costos");
            break;
        }
    }

    if ($arrDataView["mode"] !== "INS") {
        $tmpCentroCosto = obtenerCCxCodigo($arrDataView["cccod"]);
        mergeFullArrayTo($tmpCentroCosto, $arrDataView);
    }
    $arrDataView["modedsc"] = sprintf(
        $arrModesDsc[$arrDataView["mode"]],
        $arrDataView["cccod"],
        $arrDataView["cccdsc"]
    );
    $arrDataView["ccest_ACT"] = ($arrDataView["ccest"] ==="ACT")?true:false;
    $arrDataView["ccest_INA"] = ($arrDataView["ccest"] === "INA") ? true : false;
    renderizar("mantenimientos/centrocostos", $arrDataView);
}
run();
?>
