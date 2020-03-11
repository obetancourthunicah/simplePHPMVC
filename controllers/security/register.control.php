<?php
/**
 * PHP Version 7
 * Controlador de Registrar Nuevo Usuario
 *
 * @category Controllers_Registrar_Nuevo_Usuario
 * @package  Controllers\Registrar_Nuevo_Usuario
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS:1.0.0
 *
 * @link http://url.com
 */
 // Sección de requires
require_once 'models/security/security.model.php';
require_once 'libs/validadores.php';

/**
 * Corre el Controlador
 *
 * @return void
 */
function run()
{
    $arrDataView = array();
    $arrDataView['userName'] = '';
    $arrDataView['userEmail'] = '';
    $arrDataView['password'] = '';
    $arrDataView['passwordCnf'] = '';
    $arrDataView['userType'] = 'PUB';
    $arrDataView['hasErrors'] = false;
    $arrDataView['errors'] = array();

    if ($_SERVER["REQUEST_METHOD"]==="POST") {
        $arrDataView['userEmail'] = $_POST['userEmail'];
        $arrDataView['password'] = $_POST['password'];
        $arrDataView['passwordCnf'] = $_POST['passwordCnf'];
        if (isset($_POST["token"]) && isset($_SESSION["token_register"]) && $_POST["token"] == $_SESSION["token_register"]) {
            //validaciones
            if (!isValidEmail($arrDataView['userEmail'])) {
                $arrDataView['errors'][]="Correo con formato incorrecto";
                $arrDataView['hasErrors'] = true;
            }
            if (!isValidPassword($arrDataView['password'])) {
                $arrDataView['errors'][]="Contraseña con formato incorrecto";
                $arrDataView['hasErrors'] = true;
            }
            if (!isValidPassword($arrDataView['password']) && $arrDataView['password']!== $arrDataView['passwordCnf']) {
                $arrDataView['errors'][] = "Contraseñas no coinciden";
                $arrDataView['hasErrors'] = true;
            }
            if (!$arrDataView['hasErrors']) {
                $usuario = obtenerUsuarioPorEmail($arrDataView['userEmail']);
                if (count($usuario) == 0) {
                    $pswd = $arrDataView['password'];
                    $fchingreso = time();
                    $pswdSalted = "";
                    if ($fchingreso % 2 == 0) {
                        $pswdSalted = $pswd . $fchingreso;
                    } else {
                        $pswdSalted = $fchingreso . $pswd;
                    }

                    $pswdSalted = md5($pswdSalted);

                    $result = insertUsuario(
                        '',
                        $_POST['userEmail'],
                        $fchingreso,
                        $pswdSalted,
                        $arrDataView['userType']
                    );
                    if ($result) {
                        //Asegurarse de que el rol existe
                        agregarRolaUsuario('publico', $result);
                        //Aqui se puede agregar roles espcificos.
                        redirectWithMessage(
                            "Cuenta Creada Satisfactoriamente, Favor Ingresar",
                            'index.php?page=login'
                        );
                    }
                } else {
                    error_log("Intento de Crear cuenta con correo existente " . $usuario["usercod"]);
                    $arrDataView['hasErrors'] = true;
                    $arrDataView['errors'][] = "Error al registrar cuenta";
                }
            }
        }
    }

    $_SESSION["token_register"] = md5(time().'register');
    $arrDataView['token'] = $_SESSION["token_register"];

    addJsRef('public/js/validators.js');
    renderizar('register', $arrDataView);
    //renderizar("Registrar Nuevo Usuario",array());
}
// Correr el controlador
run();

?>
