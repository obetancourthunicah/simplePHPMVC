<?php
/* Home Controller
 * 2014-10-14
 * Created By OJBA
 * Last Modification 2014-10-14 20:04
 */

require_once "models/categorias.model.php";

function run(){

    $arrModos = array(
        "INS"=>"Nueva Categoría",
        "UPD"=>"Actualizando %s | %s",
        "DEL"=>"Eliminando %s | %s",
        "DSP"=>"Detalle de %s | %s"
    );
  
    $arrDataView = array();
    $arrDataView["mode"] = "*NA";
    $arrDataView["modedsc"] = "";

    $arrDataView["catid"] = 0;
    $arrDataView["catdsc"] = "";
    $arrDataView["catest"] = "ACT";

    if (isset($_GET["mode"])) {
        $arrDataView["mode"] = $_GET["mode"];
    }
    if (isset($_GET["catid"])) {
        $arrDataView["catid"] = intval($_GET["catid"]);
    }
    /*
      INS -> Insertar
      UPD -> Actualizar
      DSP -> Visualizar
      DEL -> Eliminar
    */

    if (!(isset($arrModos[$arrDataView["mode"]]))) {
        redirectWithMessage("Error al Procesar Solicitud", "index.php?page=categorias");
        die();
    } else {
        if ($arrDataView["mode"] == "INS") {
            $arrDataView["modedsc"] = $arrModos[$arrDataView["mode"]];
        } else {
            $tmpCategoria = obtenerCategoriaXId($arrDataView["catid"]);
            if (count($tmpCategoria) <=0 ) {
                redirectWithMessage("Error al Procesar Solicitud", "index.php?page=categorias");
                die();
            }
            $arrDataView["catid"] = $tmpCategoria["catid"];
            $arrDataView["catdsc"] = $tmpCategoria["catdsc"];
            $arrDataView["catest"] = $tmpCategoria["catest"];

            $arrDataView["modedsc"] = sprintf(
                $arrModos[$arrDataView["mode"]],
                $arrDataView["catid"],
                $arrDataView["catdsc"]
            );
        }
    }
    renderizar("categoria", $arrDataView);
}

run();

?>
