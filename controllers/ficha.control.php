<?php
/* Ficha Controller
 * 2019-06-27
 * Created By OJBA
 */

// Modelo de Datos a Utilizar
require_once 'models/application.model.php';
/**
 * Corre el Controlador de la Ficha
 *
 * @return void
 */
function run()
{
    $dataArray = obtenerDatosDeAplicacion();
    renderizar("ficha", $dataArray);
}
run();
?>
