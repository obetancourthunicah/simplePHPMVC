<?php
require_once 'vendor/autoload.php';

// die("<h1>Revisar el archivo libs/paypal.php</h1><h1>Comentar o eliminar linea 4 despues de agregar los datos de autenticación solicitados</h1><h2><a href=\"index.php?page=dashboard\">Regresar</a></h2>");
/**
 * Retorna el Api Context de Paypal
 *
 * @return void
 */
function getApiContext()
{
    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AcPU-ZCed-DjyUtP8vM916FdGcwHrucBtbBaEXw5EU74HVshrHGf2g-ycpqRq7iwX3KbqbEbxgNi9h8M',     // ClientID
            'EJq6q53BVrrobPEyPrCG_NqyF8vcwLMoPQJpczwxIu16_JKXH8ZEjkn7T3Ob19Y7wLu_3YQdKeSBu6jj'      // ClientSecret
        )
    );
    return $apiContext;
}
