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
    $viewData["errors"]= array();
    $viewData["haserrors"] = false;
    $viewData["readonly"] = false;
    $viewData["isdeleting"] = false;
    $viewData["xstoken"] = '';

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
        $viewData["isdeleting"] = "readonly";
        break;
      case "DSP":
       $viewData["readonly"] = "readonly";
        break;
      default:
        redirectWithMessage("Acción No Disponible", "index.php?page=productos");
    }

    if (isset($_POST["btnConfirmar"])) { /// Si hay un POST (INS, UPD, DEL)
        $varBody = $_POST;

        mergeFullArrayTo($viewData, $varBody);


        //Validacion
        $validated = true;
        if($viewData["mode"] =='INS' || $viewData["mode"]=="UPD"){
          //Validaciones Correspondientes
          if($_SESSION["producto_token"] != $varBody["producto_token"]){
            $validated = false;
            $viewData["haserrors"] = true;
            error_log("Token de Verificacion comprometido");
            addBitacora("producto", "Error Token", json_encode($varBody), "WRN");
            redirectWithMessage("Lo sentimos ocurrio un error!!!", "index.php?page=productos");
          }
          if (preg_match('/^\s*$/', $varBody["prddsc"] ) == 1){
            $validated = false;
            $viewData["prddsc_haserror"] = true;
            $viewData["prddsc_error"] = "La descripción no puede ir vacia.";
          }
        } else {
            if($viewData["mode"] == 'DEL'){
              $viewData["isdeleting"] = "readonly";
            }
            if($viewData["mode"] == 'DSP'){
              $viewData["readonly"] = "readonly";
            }
        
        }
        if($validated){
          switch($viewData["mode"]){
            case "INS":
              if(agregarNuevoProducto($varBody["prddsc"], $varBody["prdprc"], $varBody["catcod"])){
                $_SESSION["producto_token"] = "";
                redirectWithMessage("Producto Agregado Satisfactoriamente!", "index.php?page=productos");
              }else{
                $viewData["errors"][] = "Error al agregar nuevo producto";
                $viewData["haserrors"] = true;
              }
              break;
            case "UPD":
              $oldProduct = obtenerProductoXCodigo($varBody["prdcod"]);
              if(actualizarProducto($varBody["prddsc"], $varBody["prdprc"], $varBody["catcod"], $varBody["prdcod"])==1){
                $logDetail = array("old"=> $oldProduct,"new"=>$varBody);
                addBitacora("producto","Actualización", json_encode($logDetail), "WRN");
                $_SESSION["producto_token"] = "";
                redirectWithMessage("Producto Actualizado Satisfactoriamente!", "index.php?page=productos");
                }else{
                  $viewData["errors"][] = "No se actualizó el producto o se generó un error. Intente nuevamente mas tarde.";
                  $viewData["haserrors"] = true;
                }
                break;
              case "DEL":
                if(eliminarProducto($varBody["prdcod"])==1) {
                    $_SESSION["producto_token"] = "";
                    redirectWithMessage("Producto Eliminado Satisfactoriamente!", "index.php?page=productos");
                  }else{
                    $viewData["errors"][] = "No se eliminó el producto o se generó un error. Intente nuevamente mas tarde.";
                    $viewData["haserrors"] = true;
                  }
                  break;
          }
        }
    }
    if ($viewData["mode"] !== "INS") {
        $producto = obtenerProductoXCodigo($viewData["prdcod"]);
        mergeFullArrayTo($producto, $viewData);
    }
    $_SESSION["producto_token"] = md5("product" . time());
    $viewData["producto_token"] = $_SESSION["producto_token"];

    $viewData["categories"] = obtenerCategorias();
    if(isset($viewData["prddsc"])){
      $viewData["categories"] = addSelectedCmbArray(
          $viewData["categories"],
          "catcod",
          $viewData["catcod"]
      );
    }
    $viewData["modedesc"] = $mododesc[$viewData["mode"]];


    renderizar("producto", $viewData);
}

run();
?>
