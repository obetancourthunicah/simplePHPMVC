<?php 
/**
 * PHP Version 7
 * Controlador de Controlador
 *
 * @category Controllers_Almacen
 * @package  Controllers\Almacen
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS:1.0.0
 *
 * @link http://url.com
 */
  // Sección de requires
require_once "models/almacenes.model.php";
/**
 * Corre el Controlador
 *
 * @return void
 */
function run()
{
    $arrDataView = array();
    $arrDataView["mode"] = "INS";
    $arrDataView["modedsc"] = "";
    $arrDataView["almcod"] = "";
    $arrDataView["almdsc"] = "";
    $arrDataView["almtip"] = "WRH";
    $arrDataView["almest"] = "ACT";
    $arrDataView["almtip_WRH"] = "";
    $arrDataView["almtip_RTL"] = "";
    $arrDataView["almtip_TRS"] = "";
    $arrDataView["almest_PLN"] = "";
    $arrDataView["almest_ACT"] = "";
    $arrDataView["almest_INA"] = "";

    $modeDsc = array(
      "INS"=>"Nuevo Almacén",
      "DSP" => "Detalle de %s %s",
      "UPD" => "Actualizando %s %s",
      "DEL" => "Eliminado %s %s",
    );

    if (isset($_GET["mode"])) {
        $arrDataView["mode"] = $_GET["mode"];
    }
    
    if (isset($_GET["almcod"])) {
        $arrDataView["almcod"] = intval($_GET["almcod"]);
    }

    if (isset($_POST["btnCancelar"])) {
        header("location:index.php?page=almacenes");
        die();
    }

    if (isset($_POST["btnGuardar"])) {
        $arrDataView["almdsc"] = $_POST["almdsc"];
        $arrDataView["almtip"] = $_POST["almtip"];
        $arrDataView["almest"] = $_POST["almest"];

        switch($arrDataView["mode"]){
        case "INS":
            agregarAlmacen(
                $arrDataView["almdsc"],
                $arrDataView["almtip"],
                $arrDataView["almest"]
            );
            redirectWithMessage("Almacén Agregado Satisfactoriamente", "index.php?page=almacenes");
            break;
        case "UPD":
            actualizarAlmacen(
                $arrDataView["almdsc"],
                $arrDataView["almtip"],
                $arrDataView["almest"],
                $arrDataView["almcod"]
            );
            redirectWithMessage("Almacén Actualizado Satisfactoriamente", "index.php?page=almacenes");
            break;
        case "DEL":
            eliminarAlmacen(
                $arrDataView["almcod"]
            );
            redirectWithMessage("Almacén Eliminado Satisfactoriamente", "index.php?page=almacenes");
            break;
        }
    }

    if (isset($modeDsc[$arrDataView["mode"]])) {
        if ($arrDataView["mode"] != 'INS') {
            $almtmp = obtenerAlmacenXId($arrDataView["almcod"]);
            $arrDataView["almdsc"] = $almtmp["almdsc"];
            $arrDataView["almtip"] = $almtmp["almtip"];
            $arrDataView["almest"] = $almtmp["almest"];
            $arrDataView["modedsc"] = sprintf(
                $modeDsc[$arrDataView["mode"]],
                $arrDataView["almcod"],
                $arrDataView["almdsc"]
            );
        }
            $arrDataView["almtip_WRH"] = ($arrDataView["almtip"] == "WRH") ? "selected" : "";
            $arrDataView["almtip_RTL"] = ($arrDataView["almtip"] == "RTL") ? "selected" : "";
            $arrDataView["almtip_TRS"] = ($arrDataView["almtip"] == "TRS") ? "selected" : "";
            $arrDataView["almest_PLN"] = ($arrDataView["almest"] == "PLN") ? "selected" : "";
            $arrDataView["almest_ACT"] = ($arrDataView["almest"] == "ACT") ? "selected" : "";
            $arrDataView["almest_INA"] = ($arrDataView["almest"] == "INA") ? "selected" : "";
    } else {
        redirectWithMessage("Error algo pasó", "index.php?page=almacenes");
    }
    renderizar("almacen", $arrDataView);
    //renderizar("Controlador",array());
}
// Correr el controlador
run();
