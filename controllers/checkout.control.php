<?php
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
    $myItems = array(
      array(
          "sku"=>"PRD01",
          "name"=>"Producto 1 Demo",
          "quantity"=>"1",
          "price"=>"10",
          "subtotal"=>"10",
      ),
      array(
          "sku"=>"PRD02",
          "name"=>"Producto 2 Demo",
          "quantity"=>"1",
          "price"=>"10",
          "subtotal"=>"10",
      )
    );
    $viewData["items"] = $myItems;
    if (isset($_POST["btnSubmit"])) {
        $viewData  = $_POST;
        $payPalReturn = createPaypalTransacction(0, $myItems);
        if ($payPalReturn) {
            redirectToUrl($payPalReturn);
        }
        $viewData["returndata"] = $payPalReturn;
    }
    renderizar("checkout", $viewData);
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
        $item->setSku($_item["sku"]);
        $item->setName($_item["name"]);
        $item->setQuantity($_item["quantity"]);
        $item->setPrice($_item["price"]);
        $_amount += floatval($_item["price"]);
        $item->setCurrency('USD');
        $items->addItem($item);
    }

    $amount = new \PayPal\Api\Amount();
    $amount->setTotal(strval($_amount));
    $amount->setCurrency('USD');

    $transaction = new \PayPal\Api\Transaction();
    $transaction->setAmount($amount);
    $transaction->setNoteToPayee("Venta de Paquete para un mes de EdnaModas");
    $transaction->setItemList($items);

    $redirectUrls = new \PayPal\Api\RedirectUrls();

    $redirectUrls
        ->setReturnUrl("http://localhost/mvc/index.php?page=checkoutapp")
        ->setCancelUrl("http://localhost/mvc/index.php?page=checkoutcnl");

    $payment = new \PayPal\Api\Payment();
    $payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions(array($transaction))
        ->setRedirectUrls($redirectUrls);

    try {
        $payment->create($apiContext);
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
