<?php

  /* Users Controller
   * 2017-06-14
   * Created By OJBA
   * Bitacora de Cambios:
   * -----------------------------------------------------------------------
   *| Fecha   | Usuario | Descripción                                      |
   * -----------------------------------------------------------------------
   */
require_once 'models/security/security.model.php';
function run(){
    $data = array();
    $data["fltEmail"] = "";
    $filter = '';
    if(isset($_SESSION["users_context"])){
      $filter = $_SESSION["users_context"]["filter"];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $filter = $_POST["fltEmail"];
      $_SESSION["users_context"] = array("filter"=>$filter);
    }
    $data["fltEmail"] = $filter;
    $data["usuarios"] = obtenerUsuarioPorFiltro($filter,'%');
    $data["canEdit"] = isAuthorized('users_UPD', $_SESSION["userCode"]);
    $data["canNew"] = isAuthorized('users_INS', $_SESSION["userCode"]);


    renderizar("security/users", $data );
}

run();

?>
