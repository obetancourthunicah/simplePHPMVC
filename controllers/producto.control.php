<?php

require_once 'models/productos.model.php';
require_once 'libs/validadores.php';
function run()
{
    $viewData = Array();
    /*
    prdcod bigint(18) UN AI PK
    prddsc varchar(128)
    prdcodbrr varchar(45)
    prdSKU varchar(45)
    prdStock int(8)
    prdPrcVVnt decimal(13,4)
    prdPrcCpm decimal(13,4)
    prdImgUri varchar(255)
    prdEst char(3)
    prdBio mediumtext
     */
    $modeDescriptions = array(
      "UPD" => "Actualizando ",
      "DEL" => "Eliminando ",
      "DSP" => "Detalle de "
    );

    $viewData["mode"] = "";
    $viewData["modeDsc"] = "";
    $viewData["tocken"] = "";
    $viewData["errores"] = Array();
    $viewData["haserrores"] = false;
    $viewData["readonly"] = false;
    $viewData["isupdate"] = false;
    $viewData["isinsert"] = false;

    $viewData["estados"] = obtenerEstados();

    $viewData["prdcod"] = "";
    $viewData["prddsc"] = "";
    $viewData["prdcodbrr"] = "";
    $viewData["prdSKU"] = "";
    $viewData["prdStock"] = "";
    $viewData["prdPrcVVnt"] = "";
    $viewData["prdPrcCpm"] = "";
    $viewData["prdImgUri"] = "";
    $viewData["prdEst"] = "";
    $viewData["prdBio"] = "";

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        if (isset($_GET["mode"])) {
            $viewData["mode"] = $_GET["mode"];
            $viewData["prdcod"] = $_GET["prdcod"];
            switch($viewData["mode"])
            {
            case 'INS':
                $viewData["modeDsc"] = "Nuevo Producto";
                $viewData["isinsert"] = true;
                break;
            case 'UPD':
                if (isset($_GET["prdcod"])) {
                    $viewData["prdcod"] =  $_GET["prdcod"];
                } else {
                    redirectWithMessage(
                        "Código de Producto no Válido",
                        "index.php?page=productos"
                    );
                    die();
                }
                break;
            case 'DEL':
                $viewData["readonly"] = "readonly";
                if (isset($_GET["prdcod"])) {
                    $viewData["prdcod"] =  $_GET["prdcod"];
                } else {
                    redirectWithMessage(
                        "Código de Producto no Válido",
                        "index.php?page=productos"
                    );
                    die();
                }
                break;
            case 'DSP':
                $viewData["readonly"] = "readonly";
                if (isset($_GET["prdcod"])) {
                    $viewData["prdcod"] =  $_GET["prdcod"];
                } else {
                    redirectWithMessage(
                        "Código de Producto no Válido",
                        "index.php?page=productos"
                    );
                    die();
                }
                break;
            }
            $viewData["tocken"] = md5(time().'productos');
            $_SESSION["producto_tocken"] = $viewData["tocken"];
        }
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["tocken"])
            && $_POST["tocken"] === $_SESSION["producto_tocken"]
        ) {
             mergeFullArrayTo($_POST, $viewData);
            $viewData["mode"] = $_POST["mode"];
            $viewData["prdcod"] = $_POST["prdcod"];
            $viewData["tocken"] = md5(time().'productos');
            $_SESSION["producto_tocken"] = $viewData["tocken"];

            switch($viewData["mode"])
            {
            case 'INS':
                $viewData["modeDsc"] = "Nuevo Producto";
                $viewData["isinsert"] = true;
                /// validar la data
                if (!isValidSKU($_POST["prdSKU"])) {
                    $viewData["haserrores"] = true;
                    $viewData["errores"][] = "El codigo SKU no tiene el formato correcto. (VID|PTF|ACC)0000";
                }

                //$viewData["errores"] = Array();
                //$viewData["haserrores"] = false;
                if (!$viewData["haserrores"]) {
                    /// llamamos al modelo de datos para insertar el producto
                    $lastID = agregarNuevoProducto($_POST);
                    if ($lastID) {
                        redirectWithMessage("Producto Agregado Satisfactorimente", "index.php?page=productos");
                        die();
                    } else {
                        $viewData["errores"][] = "No se pudo agregar el producto";
                        $viewData["haserrores"] = true;
                    }
                }
                break;
            case 'UPD':
                $result = actualizarProducto($_POST);
                if ($result) {
                    redirectWithMessage("Producto Actualizado Satisfactorimente", "index.php?page=productos");
                    die();
                } else {
                     $viewData["errores"][] = "No se pudo Actualizar el producto";
                     $viewData["haserrores"] = true;
                }
                break;
            case 'DEL':
                $result = eliminarProducto($_POST["prdcod"]);
                if ($result) {
                    redirectWithMessage("Producto Eliminado Satisfactorimente", "index.php?page=productos");
                    die();
                } else {
                     $viewData["errores"][] = "No se pudo Eliminar el producto";
                     $viewData["haserrores"] = true;
                }
                break;
            }
        } else {
            $viewData["tocken"] = md5(time().'productos');
            $_SESSION["producto_tocken"] = $viewData["tocken"];
            $viewData["errores"][] = "No se pudo validar la información";
            $viewData["haserrores"] = true;
        }
    }

    //Si viene el codigo del producto buscamos el producto en el modelo de datos
    if ($viewData["prdcod"]!=='') {
        $dbProducto = obtieneProductoPorId($viewData["prdcod"]);

        mergeFullArrayTo($dbProducto, $viewData);

        $viewData["estados"] = addSelectedCmbArray(
            $viewData["estados"],
            "cod",
            $viewData["prdEst"],
            "selected"
        );
        $viewData["modeDsc"] = $modeDescriptions[$viewData["mode"]] .
            $viewData["prddsc"];
/*
        $viewData["prddsc"] = $dbProducto[""];
        $viewData["prdcodbrr"] = $dbProducto[""];
        $viewData["prdSKU"] = $dbProducto[""];
        $viewData["prdStock"] = "";
        $viewData["prdPrcVVnt"] = "";
        $viewData["prdPrcCpm"] = "";
        $viewData["prdImgUri"] = "";
        $viewData["prdEst"] = "";
        $viewData["prdBio"] = "";
        */
    }
    renderizar("producto", $viewData);
}

run();

?>
