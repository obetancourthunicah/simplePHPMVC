<?php
/**
 * Run function Ejectua el Controlador
 *
 * @return void
 */
function run()
{
    $arrViewData = array();
    $arrViewData["nombre"] = "Orlando J Betancourth";
    $arrViewData["cuenta"] = "1206300023 ";
    $arrViewData["email"] = "obetancourthunicah@gmail.com";
    renderizar("ficha", $arrViewData);
}

run();

?>
