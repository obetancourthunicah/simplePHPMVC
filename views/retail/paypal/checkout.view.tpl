<section>
  <header>
    <h1><span class="ion-card s2"></span>&nbsp; Pago con Paypal</h1>
  </header>
  <br />
  <section class="row">
    <section class="col-12 col-md-8 col-offset-2">
      <table class="full-width">
        <thead>
          <tr>
            <th>Linea</th>
            <th>SKU</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Total</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody class="zebra">
          {{foreach products}}
          <tr>
            <td>{{line}}</td>
            <td>{{skuprd}}</td>
            <td>{{dscprd}}</td>
            <td class="right">{{crrctd}}</td>
            <td class="right">{{crrprc}}</td>
            <td class="right">{{total}}</td>
            <td class="center">
              <a href="index.php?page=rmvtocart&codprd={{codprd}}" class="btn s-padding mdftocart">
                <span class="ion-minus-circled"></span></a>
              &nbsp;
              <a href="index.php?page=addtocart&codprd={{codprd}}" class="btn s-padding mdftocart">
                <span class="ion-plus-circled"></span></a>
            </td>
          </tr>
          {{endfor products}}
        </tbody>
        <tfooter>
          <tr style="border-top:1px solid #333;">
            <td colspan="2" class="center">
              {{if totctd}}
              <a class="btn m-padding bg-red center rmvcart" href="index.php?page=rmvallcart">
                <span class="ion-trash-b s4"></span>&nbsp;Cancelar
              </a>
              {{endif totctd}}
            </td>
            <td class="right"><strong>Total</strong></td>
            <td class="right">{{totctd}}</td>
            <td></td>
            <td class="right">{{total}}</td>
            <td>
              {{if totctd}}
              <form action="index.php?page=checkout" method="post">
                <button type="submit" name="btnSubmit" class="btn btn-primary m-padding">
                  Pagar con Paypal
                </button>
              </form>
              {{endif totctd}}
            </td>
          </tr>
        </tfooter>
      </table>
    </section>

  </section>
</section>
<script>
  $().ready(function () {
    $(".mdftocart, .rmvcart").click(function (e) {
      e.preventDefault();
      e.stopPropagation();
      $.post(
        $(this).attr("href"),
        function (data, success, xqXML) {
          if (data.cartAmount && data.cartAmount > 0) {
            window.location.reload();
          }
        }
      );
    });
  });
</script>
