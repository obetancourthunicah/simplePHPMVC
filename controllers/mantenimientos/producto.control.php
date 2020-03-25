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

    $arrModeDsc = array(
        'INS' => "Nuevo Producto",
        'UPD' => "Editando %s - %s",
        'DEL' => "Eliminando %s - %s",
        'DSP' => "Datos de %s - %s"
    );

    $arrViewData['codprd'] = 0;
    $arrViewData['dscprd'] = '';
    $arrViewData['sdscprd'] = '';
    $arrViewData['ldscprd'] = '';
    $arrViewData['skuprd'] = '';
    $arrViewData['bcdprd'] = '';
    $arrViewData['stkprd'] = 0;

    $arrViewData['typprd'] = '';
    $arrViewData['typeRTLTrue'] = '';
    $arrViewData['typeSRVTrue'] = '';
    $arrViewData['typeISKTrue'] = '';

    $arrViewData['prcprd'] = 0;
    $arrViewData['urlprd'] = '';
    $arrViewData['urlthbprd'] = '';

    $arrViewData['estprd'] = '';
    $arrViewData['estACTTrue'] = '';
    $arrViewData['estINATrue'] = '';
    $arrViewData['estPLNTrue'] = '';
    $arrViewData['estRETTrue'] = '';
    $arrViewData['estDSCTrue'] = '';

    $arrViewData['mode'] = 'INS';
    $arrViewData['modedsc'] = '';

    //GET
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        if (isset($_GET['mode'])) {
            $arrViewData['codprd'] = $_GET['codprd'];
            $arrViewData['mode'] = $_GET['mode'];

            if ($arrViewData['mode'] !== 'INS') {
                $arrTemp = obtenerUnProducto($arrViewData['codprd']);
                mergeFullArrayTo($arrTemp, $arrViewData);
            }
        }
    }

    //POST
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //Comprobar token
        if (isset($_POST['token'])
            && isset($_SESSION['token_productos'])
            && $_POST['token'] === $_SESSION['token_productos']
        ) {
            //refresh variables
            $arrViewData['codprd'] = intval($_POST['codprd']);
            $arrViewData['dscprd'] = $_POST['dscprd'];
            $arrViewData['sdscprd'] = $_POST['sdscprd'];
            $arrViewData['ldscprd'] = $_POST['ldscprd'];
            $arrViewData['skuprd'] = $_POST['skuprd'];
            $arrViewData['bcdprd'] = $_POST['bcdprd'];
            $arrViewData['stkprd'] = intval($_POST['stkprd']);
            $arrViewData['typprd'] = $_POST['typprd'];
            $arrViewData['prcprd'] = floatval($_POST['prcprd']);
            $arrViewData['urlprd'] = $_POST['urlprd'];
            $arrViewData['urlthbprd'] = $_POST['urlthbprd'];
            $arrViewData['estprd'] = $_POST['estprd'];
            $arrViewData['mode'] = $_POST['mode'];

            //Mode
            switch($arrViewData['mode']) {
            case 'INS':
                insertProducto(
                    $arrViewData['dscprd'], $arrViewData['sdscprd'], $arrViewData['ldscprd'], $arrViewData['skuprd'], $arrViewData['bcdprd'],
                    $arrViewData['stkprd'], $arrViewData['typprd'], $arrViewData['prcprd'],  $arrViewData['urlprd'], $arrViewData['urlthbprd'],
                    $arrViewData['estprd']
                );

                redirectWithMessage("Producto agregado exitosamente", "index.php?page=productos");
                die();

            case 'UPD':
                updateProducto(
                    $arrViewData['dscprd'], $arrViewData['sdscprd'], $arrViewData['ldscprd'], $arrViewData['skuprd'], $arrViewData['bcdprd'],
                    $arrViewData['stkprd'], $arrViewData['typprd'], $arrViewData['prcprd'],  $arrViewData['urlprd'], $arrViewData['urlthbprd'],
                    $arrViewData['estprd'], $arrViewData['codprd']
                );

                redirectWithMessage("Producto editado exitosamente", "index.php?page=productos");
                die();

            case 'DEL':
                deleteProducto($arrViewData['codprd']);
                redirectWithMessage("Producto eliminado exitosamente", "index.php?page=productos");
                die();
            }
        } else {
            error_log("INTENTO DE ATAQUE XRS DE ". $_SERVER["REMOTE_ADDR"]);
        }
    }

    ////////GLOBALES

    //Token
    $xrsToken = md5(time() . random_int(0, 10000) . "prod");
    $arrViewData['token'] = $xrsToken;
    $_SESSION['token_productos'] = $xrsToken;

    //Titulo
    $arrViewData['modedsc'] = sprintf($arrModeDsc[$arrViewData['mode']], $arrViewData['codprd'], $arrViewData['dscprd']);

    //Combobox
    $arrViewData['typeRTLTrue'] = ($arrViewData['typprd'] === "RTL")? "selected" : "";
    $arrViewData['typeSRVTrue'] = ($arrViewData['typprd'] === "SRV")? "selected" : "";
    $arrViewData['typeISKTrue'] = ($arrViewData['typprd'] === "ISK")? "selected" : "";

    $arrViewData['estACTTrue'] = ($arrViewData['estprd'] === "ACT")? "selected" : "";
    $arrViewData['estINATrue'] = ($arrViewData['estprd'] === "INA")? "selected" : "";
    $arrViewData['estPLNTrue'] = ($arrViewData['estprd'] === "PLN")? "selected" : "";
    $arrViewData['estRETTrue'] = ($arrViewData['estprd'] === "RET")? "selected" : "";
    $arrViewData['estDSCTrue'] = ($arrViewData['estprd'] === "DSC")? "selected" : "";

    //Campos segun mode
    $arrViewData['isReadOnly'] = false;

    if ($arrViewData['mode'] === "DSP" || $arrViewData['mode'] === "DEL") {
        $arrViewData['isReadOnly'] = true;
    }

    $arrViewData['hasAction'] = true;

    if ($arrViewData['mode'] === "DSP") {
        $arrViewData['hasAction'] = false;
    }

    renderizar("mantenimientos/producto", $arrViewData);
}

run();

?>
