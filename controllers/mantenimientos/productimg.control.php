<?php

require_once "models/mantenimientos/productos.model.php";
/**
 * Controlador de Formulario de Producto
 *
 * @return void
 */
function run()
{
    $arrViewData = array();

    $arrViewData['codprd'] = 0;
    $arrViewData['dscprd'] = '';
    $arrViewData['sdscprd'] = '';
    $arrViewData['ldscprd'] = '';
    $arrViewData['skuprd'] = '';
    $arrViewData['bcdprd'] = '';
    $arrViewData['stkprd'] = 0;
    $arrViewData['typprd'] = '';
    $arrViewData['prcprd'] = 0;
    $arrViewData['urlprd'] = '';
    $arrViewData['urlthbprd'] = '';
    $arrViewData['estprd'] = '';
    //GET
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        if (isset($_GET['codprd'])) {
            $arrViewData['codprd'] = intval($_GET['codprd']);

            if ($arrViewData['codprd'] !== 0) {
                $arrTemp = obtenerUnProducto($arrViewData['codprd']);
                mergeFullArrayTo($arrTemp, $arrViewData);
            }
        }
    }

    //POST
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //Comprobar token
        if (isset($_POST['token'])
            && isset($_SESSION['token_productosimg'])
            && $_POST['token'] === $_SESSION['token_productosimg']
        ) {
            //refresh variables
            $arrViewData['codprd'] = intval($_POST['codprd']);
            //$arrViewData['urlprd'] = $_POST['urlprd'];
            //$arrViewData['urlthbprd'] = $_POST['urlthbprd'];

            if (isset($_FILES["uploadUrlPrd"]) && isset($_POST["btnGuardarUrlPrd"])) {
                //Obtenemos los datos necesarios para generar el registro
                $udir = "public/prods/"; // directorio a donde guardaremos el documento
                $fname = basename($_FILES["uploadUrlPrd"]["name"]); //El nombre del archivo
                $fsize = $_FILES["uploadUrlPrd"]["size"]; //tamaño en bytes
                //Se puede validar el tamano del archivo
                $tfil =  $udir . $arrViewData['codprd']."_".preg_replace('/(?:[^\w|\.])/m', '_', $fname);
                //guardamos el archivo sin letras especiales para evitar cortes de url directas
                move_uploaded_file($_FILES["uploadUrlPrd"]["tmp_name"], $tfil); //movemos el archivo para guardar en la carpeta
                setImageProducto($tfil, $arrViewData["codprd"], "PRT");
                redirectWithMessage("Imágen de Portada Actualizada", "index.php?page=productos");
                die();
            }
            if (isset($_FILES["uploadUrlThbPrd"])  && isset($_POST["btnGuardarUrlThbPrd"])) {
                //Obtenemos los datos necesarios para generar el registro
                $udir = "public/prods/"; // directorio a donde guardaremos el documento
                $fname = basename($_FILES["uploadUrlThbPrd"]["name"]); //El nombre del archivo
                $fsize = $_FILES["uploadUrlThbPrd"]["size"]; //tamaño en bytes
                //Se puede validar el tamano del archivo
                $tfil =  $udir . $arrViewData['codprd'] . "_" . preg_replace('/(?:[^\w|\.])/m', '_', $fname);
                //guardamos el archivo sin letras especiales para evitar cortes de url directas
                move_uploaded_file($_FILES["uploadUrlThbPrd"]["tmp_name"], $tfil); //movemos el archivo para guardar en la carpeta
                setImageProducto($tfil, $arrViewData["codprd"], "THB");
                redirectWithMessage("Imágen de Catálogo Actualizada", "index.php?page=productos");
                die();
            }

        } else {
            error_log("INTENTO DE ATAQUE XRS DE ". $_SERVER["REMOTE_ADDR"]);
        }
    }

    ////////GLOBALES

    //Token
    $xrsToken = md5(time() . random_int(0, 10000) . "prodimg");
    $arrViewData['token'] = $xrsToken;
    $_SESSION['token_productosimg'] = $xrsToken;

    //Titulo
    $arrViewData['modedsc'] = "Imágenes de ".$arrViewData['skuprd']." ".$arrViewData['dscprd'];

    $arrViewData['hasAction'] = true;

    renderizar("mantenimientos/productoimg", $arrViewData);
}

run();

?>
