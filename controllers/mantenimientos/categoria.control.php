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

    if (isset($_POST["btnConfirmar"]))
    {
        guardarNuevaCategoria($_POST["ctgdsc"], $_POST["ctgest"]);
        redirectWithMessage("Guardado Satisfactoriamente", "index.php?page=categorias");
        die();
    }

    renderizar("mantenimientos/categoria", $arrDataView);
}
run();
?>
