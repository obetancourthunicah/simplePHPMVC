<?php
/**
 * PHP Version 7
 * Controlador de Security_Menu
 *
 * @category Controllers_Security_Menu
 * @package  Controllers\Security_Menu
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS:1.0.0
 *
 * @link http://url.com
 */
 // Sección de requires

/**
 * Corre el Controlador
 *
 * @return void
 */
function run()
{
    $arrDataView = array();
    $arrSecurity = array();
    //Para Obtener el usuario logueado
    $usuario = $_SESSION["userCode"];
    if (isAuthorized('users', $usuario)) {
        $arrSecurity[] = array(
            "page" => "users",
            "pageDsc"=>"Usuarios",
            "ionicon"=> "person-stalker"
        );
    }
    if (isAuthorized('roles', $usuario)) {
        $arrSecurity[] = array(
            "page" => "roles",
            "pageDsc"=>"Roles",
            "ionicon"=> "cash"
        );
    }
    if (isAuthorized('programas', $usuario)) {
        $arrSecurity[] = array(
            "page" => "programas",
            "pageDsc"=>"Programas y Funciones",
            "ionicon"=> "ios-cog"
        );
    }
    $arrDataView["security"] = $arrSecurity;
    renderizar("security/security", $arrDataView);
}
// Correr el controlador
run();

/*
<section>
  <h2>Seguridad</h2>
  <div>
    <ul>
      <li><a href="index.php?page=users">Usuarios</a></li>
      <li><a href="index.php?page=roles">Roles</a></li>
      <li><a href="index.php?page=programas">Funciones</a></li>
    </ul>
  </div>
 */
