<section>
  <h1>Checkout Pago con PayPal</h1>
  <section class="row">
    <section class="col-md-8 col-offset-2">
      <form action="index.php?page=checkout" method="post">
        <fieldset class="row bg-blue-grey">
            <div class="col-md-2"><b>SKU</b></div>
            <div class="col-md-4"><b>Producto</b></div>
            <div class="col-md-2 right"><b>Prc Und</b></div>
            <div class="col-md-2 right"><b>Cantidad</b></div>
            <div class="col-md-2 right"><b>Total</b></div>
        </fieldset>
        {{foreach items}}
        <fieldset class="row">
            <div class="col-md-2">{{sku}}</div>
            <div class="col-md-4">{{name}}</div>
            <div class="col-md-2 right">{{price}}</div>
            <div class="col-md-2 right">{{quantity}}</div>
            <div class="col-md-2 right">{{subtotal}}</div>
        </fieldset>
        {{endfor items}}
        <fieldset class="row right">
          <button type="submit" class="btn-primary l-padding" name="btnSubmit" value="submit">
            Pagar
          </button>
        </fieldset>
      </form>
    </section>
  </section>
</section>
