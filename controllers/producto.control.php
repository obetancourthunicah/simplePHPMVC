<?php
require_once('models/productos.model.php');

function run(){
    $viewData = array();
    $mododesc = array(
        "INS"=>"Nuevo Producto",
        "UPD" => "Actualizando ",
        "DEL" => "Eliminando ",
        "DSP" => "Detalle de ",
    );
    $viewData["mode"] = "";
    $viewData["prdcod"] = "";
    if (isset($_GET["mode"])){
      $viewData["mode"] = $_GET["mode"];
    }
    if (isset($_GET["prdcod"])){
      $viewData["prdcod"] = $_GET["prdcod"];
    }

    switch($viewData["mode"]){
      case "INS":
        
        break;
      case "UPD":
        
        break;
      case "DEL":
        
        break;
      case "DSP":
       
        break;
      default:
        redirectWithMessage("Acción No Disponible", "index.php?page=productos");
    }
    if ($viewData["modedesc"] !== "INS") {
        $producto = obtenerProductoXCodigo($viewData["prdcod"]);
        mergeFullArrayTo($producto, $viewData);
    }
    $viewData["modedesc"] = $mododesc[$viewData["mode"]];
    

    renderizar("producto", $viewData);
}

run();
?>
