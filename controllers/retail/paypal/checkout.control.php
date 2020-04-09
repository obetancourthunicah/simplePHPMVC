<?php
/**
 * PHP Version 7
 * Controlador de CheckOut
 *
 * @category Controllers_CheckOut
 * @package  Controllers\CheckOut
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  Comercial http://
 *
 * @version CVS:1.0.0
 *
 * @link http://url.com
 */

// Sección de requires
require_once 'libs/paypal.php';
/**
 * Renderizado de Documento
 *
 * @return void
 */
function run()
{
    $viewData = array();
    //Esto lo saca de la carretilla de compras
    $usuario = $_SESSION["userCode"];
    $viewData = array();
    $viewData = getAuthCartDetail($usuario);
    if (isset($_POST["btnSubmit"])) {
        //$viewData  = $_POST;
        $payPalReturn = createPaypalTransacction(0, $viewData["products"]);
        if ($payPalReturn) {
            redirectToUrl($payPalReturn);
        }
        $viewData["returndata"] = $payPalReturn;
    }
    resetCartTime($usuario);
    renderizar("retail/paypal/checkout", $viewData);
}

/**
 * Undocumented function
 *
 * @param [type] $_amount Cantidad a Realizar en la transacción
 * @param array  $_items  Productos a Solicitar Pago
 *
 * @return array datos de la transaccion por paypal
 */
function createPaypalTransacction( $_amount , $_items )
{
    $apiContext = getApiContext();
    $payer = new \PayPal\Api\Payer();
    $payer->setPaymentMethod('paypal');

    $items = new \PayPal\Api\ItemList();
    $_amount = 0 ;
    foreach ($_items as $_item) {
        $item = new \PayPal\Api\Item();
        $item->setSku($_item["skuprd"]);
        $item->setName($_item["dscprd"]);
        $item->setQuantity($_item["crrctd"]);
        $item->setPrice($_item["crrprc"]);
        $_amount += floatval($_item["total"]);
        $item->setCurrency('USD');
        $items->addItem($item);
    }

    $amount = new \PayPal\Api\Amount();
    $amount->setTotal(strval($_amount));
    $amount->setCurrency('USD');

    $transaction = new \PayPal\Api\Transaction();
    $transaction->setAmount($amount);
    $transaction->setNoteToPayee("Orden de Compra");
    $transaction->setItemList($items);

    $redirectUrls = new \PayPal\Api\RedirectUrls();
    //TODO: Change This with host on production
    $redirectUrls
        ->setReturnUrl("http://localhost/mvc/index.php?page=checkoutapr")
        ->setCancelUrl("http://localhost/mvc/index.php?page=checkoutcnl");

    $payment = new \PayPal\Api\Payment();
    $payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions(array($transaction))
        ->setRedirectUrls($redirectUrls);

    try {
        $payment->create($apiContext);
        //Importante para saber que trasacción y guardarlo en la db
        $_SESSION["paypalTrans"] = $payment;
        return $payment->getApprovalLink();
    } catch (\PayPal\Exception\PayPalConnectionException $ex) {
        // This will print the detailed information on the exception.
        //REALLY HELPFUL FOR DEBUGGING
        error_log($ex->getData());
        return false;
    }
}

run();
?>
