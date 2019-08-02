<?php
require 'models/security/security.model.php';
require 'models/security/programas.model.php';

function generarMenu($usercod)
{
    $menu = array();
    // Aqui se establece las pestañas superiores
    // Menu Principal Autenticado
    if (isAuthorized('dashboard',$usercod)) $menu[] = array("mdlprg"=>"dashboard","mdldsc"=>"Administración");
    // WW de Modas
    if (isAuthorized('modas',$usercod)) $menu[] = array("mdlprg"=>"modas","mdldsc"=>"WW Modas");

    $menu[] = array("mdlprg"=>"checkout","mdldsc"=>"Pagar Paypal Demo");
    addToContext('appmenu', $menu);
}

function isAuthorized($assetCode, $usercod)
{
    $programa = obtenerFuncionPorCodigo($assetCode);
    if (count($programa) == 0) {
        insertFuncion($assetCode, $assetCode, 'ACT', 'PRG');
    }
    if ($_SESSION["userType"] == 'ADM') {
        return true;
    }
    return estaAutorizado($usercod, $assetCode);
}

function hasAccess($functionCode, $usercod)
{
    $programa = obtenerFuncionPorCodigo($assetCode);
    if (count($programa) == 0) {
        insertPrograma($assetCode, $assetCode, 'ACT', 'FNC');
    }
    if ($_SESSION["userType"] == 'ADM') {
        return true;
    }
    return estaAutorizado($usercod, $assetCode);
}
?>
