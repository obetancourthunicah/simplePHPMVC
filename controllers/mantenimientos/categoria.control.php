<?php

require_once 'models/mantenimientos/categorias.model.php';
/**
 * Controlador de Vista Formulario de Categorias
 *
 * @return void
 */
function run()
{

    $arrDataView = array();
    // Inicializando Variable
    $arrDataView["ctgcod"] = 0;
    $arrDataView["ctgdsc"] = '';
    $arrDataView["ctgest"] = 'ACT';
    $arrDataView["ctgEstACTTrue"] = '';
    $arrDataView["ctgEstINATrue"] = '';
    $arrModeDsc = array(
        "INS" =>" Crear Nueva Categoría",
        "UPD" =>" Actualizando Categoría %s - %s",
        "DEL" => "Eliminando Categoría %s - %s",
        "DSP" => "Categoría %s - %s"
    );
    $arrDataView["mode"] = 'INS'; // INS, UPD, DEL, DSP --> CRUD

    if ($_SERVER["REQUEST_METHOD"]==="GET") {
        if (isset($_GET["mode"])) {
            $arrDataView["mode"] = $_GET["mode"];
            $arrDataView["ctgcod"] = intval($_GET["ctgcod"]);
        }
        if ($arrDataView["ctgcod"]>0 && $arrDataView["mode"]!=="INS") {
            $arrTmpCategoria = obtenerCategoriaPorCodigo($arrDataView["ctgcod"]);
            mergeFullArrayTo($arrTmpCategoria, $arrDataView);
        }
    }
    if ($_SERVER["REQUEST_METHOD"]  === "POST") {
        if (isset($_POST["token"])
            && isset($_SESSION["token_categoria"])
            && $_POST["token"] === $_SESSION["token_categoria"]
        ) {
            $arrDataView["ctgcod"] = intval($_POST["ctgcod"]);
            $arrDataView["ctgdsc"] = $_POST["ctgdsc"];
            $arrDataView["ctgest"] = $_POST["ctgest"];
            $arrDataView["mode"] = $_POST["mode"];

            switch ($arrDataView["mode"]){
            case 'INS':
                guardarNuevaCategoria(
                    $arrDataView["ctgdsc"],
                    $arrDataView["ctgest"]
                );
                redirectWithMessage(
                    "Guardado Satisfactoriamente",
                    "index.php?page=categorias"
                );
                die();
            case 'UPD':
                actualizarCategoria(
                    $arrDataView["ctgcod"],
                    $arrDataView["ctgdsc"],
                    $arrDataView["ctgest"]
                );
                redirectWithMessage(
                    "Actualizado Satisfactoriamente",
                    "index.php?page=categorias"
                );
                die();
            case 'DEL':
                eliminarCategoria(
                    $arrDataView["ctgcod"]
                );
                redirectWithMessage(
                    "Eliminado Satisfactoriamente",
                    "index.php?page=categorias"
                );
                die();
                break;
            }
        } else {
            error_log("Intento de XRS attack " . $_SERVER["REMOTE_ADDR"]);
        }
    }
    // Datos Globales no importa si es get o post
    $xrstoken = md5(time() . (random_int(0, 10000)) . "categ");
    $_SESSION["token_categoria"] = $xrstoken;
    $arrDataView["token"] = $xrstoken;

    $arrDataView["modedsc"] = sprintf(
        $arrModeDsc[$arrDataView["mode"]],
        $arrDataView["ctgcod"],
        $arrDataView["ctgdsc"]
    );

    $arrDataView["ctgEstACTTrue"] = ($arrDataView["ctgest"] == 'ACT')? "selected":"";
    $arrDataView["ctgEstINATrue"] = ($arrDataView["ctgest"] == 'INA') ? "selected" : "";

    $arrDataView["isReadOnly"] = true;
    if ($arrDataView["mode"] === 'INS' || $arrDataView["mode"] === 'UPD') {
        $arrDataView["isReadOnly"] = false;
    }

    $arrDataView["hasAction"] = true;
    if ($arrDataView["mode"] === 'DSP') {
        $arrDataView["hasAction"] = false;
    }

    renderizar("mantenimientos/categoria", $arrDataView);
}
run();
?>
