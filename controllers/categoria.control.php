<?php
require_once('models/productos.model.php');
/*
  inicializacion de variables

 */
function run(){
    /*-----------------------

      Seccion de Iniciazación de Variables
    ---------------------------*/
    $viewData = array();
    $mododesc = array(
        "INS"=>"Nueva Categoría",
        "UPD" => "Actualizando ",
        "DEL" => "Eliminando ",
        "DSP" => "Detalle de ",
    );
    $viewData["mode"] = "";
    $viewData["catcod"] = "";
    $viewData["errors"]= array();
    $viewData["haserrors"] = false;
    $viewData["readonly"] = false;
    $viewData["isdeleting"] = false;
    $viewData["xstoken"] = '';

    /*-----------------------

      Todo Algoritmo por Metodo GET
    ---------------------------*/
    if (isset($_GET["mode"])){
      $viewData["mode"] = $_GET["mode"];
    }

    if (isset($_GET["catcod"])){
      $viewData["catcod"] = $_GET["catcod"];
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
        redirectWithMessage("Acción No Disponible", "index.php?page=categorias");
    }
      /*-----------------------
    FIN METODO GET

    ---------------------------*/

    /*-----------------------

    Algoritmo si hay un interaccion con el Formualrio
    ---------------------------*/
    if (isset($_POST["btnConfirmar"])) { /// Si hay un POST (INS, UPD, DEL)
        $varBody = $_POST;

        mergeFullArrayTo($viewData, $varBody);


        //Validacion
        $validated = true;
        if($viewData["mode"] =='INS' || $viewData["mode"]=="UPD"){
          //Validaciones Correspondientes
          if($_SESSION["categoria_token"] != $varBody["categoria_token"]){
            $validated = false;
            $viewData["haserrors"] = true;
            error_log("Token de Verificacion comprometido");
            addBitacora("categoria", "Error Token", json_encode($varBody), "WRN");
            redirectWithMessage("Lo sentimos ocurrio un error!!!", "index.php?page=categorias");
          }
          if (preg_match('/^\s*$/', $varBody["catdsc"] ) == 1){
            $validated = false;
            $viewData["catdsc_haserror"] = true;
            $viewData["catdsc_error"] = "La descripción no puede ir vacia.";
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
              if(agregarCategoria($varBody["catdsc"], $varBody["catest"])){
                $_SESSION["categoria_token"] = "";
                redirectWithMessage("Categoría Agregada Satisfactoriamente!", "index.php?page=categorias");
              }else{
                $viewData["errors"][] = "Error al agregar nueva categoría";
                $viewData["haserrors"] = true;
              }
              break;
            case "UPD":
              $oldCat = obtenerCategoriaXCodigo($varBody["catcod"]);
              if(actualizarCategoria($varBody["catdsc"], $varBody["catest"], $varBody["catcod"])==1){
                $logDetail = array("old"=> $oldCat,"new"=>$varBody);
                addBitacora("categoria","Actualización", json_encode($logDetail), "WRN");
                $_SESSION["categoria_token"] = "";
                redirectWithMessage("Categoría Actualizada Satisfactoriamente!", "index.php?page=categorias");
                }else{
                  $viewData["errors"][] = "No se actualizó la categoría o se generó un error. Intente nuevamente mas tarde.";
                  $viewData["haserrors"] = true;
                }
                break;
              case "DEL":
                if(eliminarCategoria($varBody["catcod"])==1) {
                    $_SESSION["categoria_token"] = "";
                    redirectWithMessage("Categoría Eliminada Satisfactoriamente!", "index.php?page=categorias");
                  }else{
                    $viewData["errors"][] = "No se eliminó la categoría o se generó un error. Intente nuevamente mas tarde.";
                    $viewData["haserrors"] = true;
                  }
                  break;
          }
        }
    }

        /*-----------------------
    Default is Display

    ---------------------------*/
    if ($viewData["mode"] !== "INS") {
        $categoria = obtenerCategoriaXCodigo($viewData["catcod"]);
        mergeFullArrayTo($categoria, $viewData);
    }
    $_SESSION["categoria_token"] = md5("categoria" . time());
    $viewData["categoria_token"] = $_SESSION["categoria_token"];

    $viewData["estados"] = getEstadosCategoria();
    if(isset($viewData["catdsc"])){
      $viewData["estados"] = addSelectedCmbArray(
          $viewData["estados"],
          "catest",
          $viewData["catest"]
      );
    }
    $viewData["modedesc"] = $mododesc[$viewData["mode"]];


    renderizar("categoria", $viewData);
}

run();
?>
