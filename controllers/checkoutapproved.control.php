<?php
require_once 'libs/paypal.php';

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transactions;


/**
 * Controlador cuando paypal manda una aprobación del usuario
 * se debe ahora procesar el pago ejecutandolo y creando la factura
 *
 * @return void
 */
function run()
{
    $payment = executePaypal();
    $viewData = array();
    if ($payment) {
        $viewData["payment"] = $payment->toJSON();
        $viewData["checkoutTitle"]
            = $payment->getPayer()
            ->getPayerInfo()
            ->getFirstName().
            " ".
            $payment->getPayer()
            ->getPayerInfo()
            ->getLastName();
        $viewData["checkoutDescription"] = "";
        $viewData["error"] =  "";
        $viewData["amount"]
            = $payment->getTransactions()[0]
            ->getAmount()
            ->getTotal();
    } else {
        $viewData["error"] = "Error al procesar pagos";
    }
    renderizar("checkoutapproved", $viewData);
}

run();

/**
 * Ejecuta el pago en paypal
 *
 * @return void
 */
function executePaypal()
{
    if (isset($_GET['PayerID'])) {
        $apiContext = getApiContext();

        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);

        try {
            // error_log($payment->toJSON());
            $result = $payment->execute($execution, $apiContext);
            
            error_log($result);
            try {
                $payment = Payment::get($paymentId, $apiContext);
            } catch (Exception $ex) {
                error_log($ex);
                return false;
            }
        } catch (Exception $ex) {
            error_log($ex);
        }
        return $payment;
    } else {
        error_log("Usuario cancelo transacción o no es un a peticio adecuada");
        return false;
    }
}
?>
