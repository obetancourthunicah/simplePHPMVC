<?php
require_once 'vendor/autoload.php';

die("<h1>Revisar el archivo libs/paypal.php</h1><h1>Comentar o eliminar linea 4 despues de agregar los datos de autenticación solicitados</h1><h2><a href=\"index.php?page=dashboard\">Regresar</a></h2>");
/**
 * Retorna el Api Context de Paypal
 *
 * @return void
 */
function getApiContext()
{
    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'elClienteIDdeSuCuentaApp',     // ClientID
            'elClienteSecretDeSuCuentaApp'      // ClientSecret
        )
    );
    return $apiContext;
}
?>
