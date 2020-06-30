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

    $arrDataView["catest_ACT"] = "select";
    $arrDataView["catest_INA"] = "";

    $arrDataView["readonly"] = "";

    $arrDataView["isDeleting"] = false;

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

    if (isset($_POST["btnCancelar"])) {
        header("location:index.php?page=categorias");
        die;
    }

    if (isset($_POST["btnGuardar"])) {
        $arrDataView["catdsc"] = $_POST["catdsc"];
        $arrDataView["catest"] = $_POST["catest"];

        switch ($arrDataView["mode"]) {
        case "INS":
            $newId = addNuevaCategoria($arrDataView["catdsc"], $arrDataView["catest"]);
            if ($newId > 0) {
                redirectWithMessage("Guardado de Forma Satisfactoria", "index.php?page=categorias");
                die();
            }
            break;
        case "UPD":
            if (actualizarCategoria(
                $arrDataView["catid"],
                $arrDataView["catdsc"],
                $arrDataView["catest"]
            )
            ) {
                redirectWithMessage("Actualizado de Forma Satisfactoria", "index.php?page=categorias");
                die();
            }
            break;
        case "DEL":
            if (eliminarCategoria($arrDataView["catid"])) {
                redirectWithMessage("Eliminado de Forma Satisfactoria", "index.php?page=categorias");
                die();
            }
            break;
        }
    }

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

            if ($arrDataView["catest"] == "ACT") {
                $arrDataView["catest_ACT"] = "selected";
                $arrDataView["catest_INA"] = "";
            } else {
                $arrDataView["catest_ACT"] = "";
                $arrDataView["catest_INA"] = "selected";
            }
            if ($arrDataView["mode"] == "DEL" || $arrDataView["mode"] == "DSP") {
                $arrDataView["readonly"] = "disabled readonly";
                if ($arrDataView["mode"] == "DEL") {
                    $arrDataView["isDeleting"] = true;
                }
            }
            

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
