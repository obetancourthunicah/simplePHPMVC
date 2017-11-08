<?php

    session_start();

    require_once("libs/utilities.php");

    $pageRequest = "home";

    if(isset($_GET["page"])){
        $pageRequest = $_GET["page"];
    }

    //Incorporando los midlewares son codigos que se deben ejecutar
    //Siempre
    require_once("controllers/verificar.mw.php");
    require_once("controllers/site.mw.php");


    //Este switch se encarga de todo el enrutamiento
    switch($pageRequest){
        case "home":
            //llamar al controlador
            require_once("controllers/home.control.php");
            break;
        case "prdbacklog":
        require_once("controllers/prdbacklog.control.php");
        break;
        default:
            require_once("controllers/error.control.php");
    }
?>
