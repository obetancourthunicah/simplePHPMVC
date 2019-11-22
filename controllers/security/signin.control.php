<?php
require_once 'models/security/security.model.php';

function run(){
  $loginData = array(
    "errors" => array(),
    "tocken" => "",
    "txtEmail" => "",
    "showerrors" => false,
  );

  if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $loginData["tocken"] = md5("siginentry" . time());
    $_SESSION["sigin_tocken"] = $loginData["tocken"];
    renderizar("security/sigin", $loginData);
  }
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include_once "libs/validadores.php";
    //Validaciones
    if (isset($_POST["tocken"]) && isset($_SESSION["sigin_tocken"])) {
      if (($_POST["tocken"] === $_SESSION["sigin_tocken"]) && (!isEmpty($_SESSION["sigin_tocken"]))) {
        $loginData["txtEmail"] = $_POST["txtEmail"];
        $loginData["txtPswd"] = $_POST["txtPswd"];

        if (isEmpty($loginData["txtEmail"]) || !isValidEmail($loginData["txtEmail"])) {
          $loginData["errors"][] = "Correo Electrónico con formato incorrecto";
        }
        if (isEmpty($loginData["txtPswd"])) { //se elimina validacion de contraseña || !isValidPassword($loginData["txtPswd"])){
          $loginData["errors"][] = "Debe ingresar una contraseña.";
        }


        if (count($loginData["errors"]) > 0) {
          $loginData["tocken"] = md5("siginentry" . time());
          $_SESSION["sigin_tocken"] = $loginData["tocken"];
          $loginData["showerrors"] = true;
          renderizar("security/sigin", $loginData);
        } else {
          //Correr Crear Cuenta
          $fchingreso = time();
          $pswdSalted = "";
          if ($fchingreso % 2 === 0) {
            $pswdSalted = $loginData["txtPswd"]  . $fchingreso;
          } else {
            $pswdSalted = $fchingreso . $loginData["txtPswd"];
          }

          $pswdSalted = md5($pswdSalted);

          $result = insertUsuario(
            '',
            $loginData["txtEmail"],
            $fchingreso,
            $pswdSalted,
            'NRM'
          );
          if ($result == 0) {
            $loginData["tocken"] = md5("siginentry" . time());
            $_SESSION["sigin_tocken"] = $loginData["tocken"];
            $loginData["errors"][] = "No se pudo crear cuenta";
            $loginData["showerrors"] = true;
            renderizar("security/sigin", $loginData);
          } else {
            // El mismo elemento  del login

            redirectWithMessage(
              "Cuenta Creada Satisfactoriamente.",
              "index.php?page=login"
            );
          }
        }
      } else {
        $loginData["tocken"] = md5("siginentry" . time());
        $_SESSION["sigin_tocken"] = $loginData["tocken"];
        $loginData["errors"][] = "Falla al intentar crear cuenta de usuario.";
        $loginData["showerrors"] = true;
        renderizar("security/sigin", $loginData);
      }
    } else {
      $loginData["tocken"] = md5("siginentry" . time());
      $_SESSION["sigin_tocken"] = $loginData["tocken"];
      $loginData["errors"][] = "Falla al intentar crear cuenta de usuario.";
      $loginData["showerrors"] = true;
      renderizar("security/sigin", $loginData);
    }
  }
}

run();
?>
