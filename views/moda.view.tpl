<h1>{{modeDsc}}</h1>
<section class="row">
<form action="index.php?page=moda" method="post" class="col-8 col-offset-2">
  <fieldset class="row">
    <label class="col-5" for="idmoda">Código de Moda</label>
    <input type="text" name="idmoda" id="idmoda" value="{{idmoda}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="dscmoda">Descripción Corta</label>
    <input type="text" name="dscmoda" id="dscmoda" value="{{dscmoda}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="prcmoda">Precio de Venta</label>
    <input type="text" name="prcmoda" id="prcmoda" value="{{prcmoda}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="ivamoda">Impuesto sobre la Venta</label>
    <input type="text" name="ivamoda" id="ivamoda" value="{{ivamoda}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="estmoda">Estado</label>
    <input type="text" name="estmoda" id="estmoda" value="{{estmoda}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <div class="right">
      <button type="button" id="btnConfirmar">Confirmar</button>
      &nbsp;
      <button type="button" id="btnCancelar">Cancelar</button>
    </div>
  </fieldset>
  <!--
   <td>{{idmoda}}</td>
    <td>{{dscmoda}}</td>
    <td>{{prcmoda}}</td>
    <td>{{ivamoda}}</td>
    <td>{{estmoda}}</td>
   -->
</form>
</section>
<script>
  $().ready(function(){
    $("#btnCancelar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      location.assign("index.php?page=modas");
    })
  });
</script>
