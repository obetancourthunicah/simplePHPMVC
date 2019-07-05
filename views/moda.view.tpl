<h1>{{modeDsc}}</h1>
<section class="row">
<form action="index.php?page=moda" method="post" class="col-8 col-offset-2">
  {{if hasErrors}}
    <section class="row">
      <ul class="error">
        {{foreach errores}}
          <li>{{this}}</li>
        {{endfor errores}}
      </ul>
    </section>
  {{endif hasErrors}}
  <input type="hidden" name="mode" value="{{mode}}"/>
  <input type="hidden" name="xcfrt" value="{{xcfrt}}" />
  <input type="hidden" name="btnConfirmar" value="Confirmar" />
  {{if showIdModa}}
  <fieldset class="row">
    <label class="col-5" for="idmoda">Código de Moda</label>
    <input type="text" name="idmoda" id="idmoda" readonly value="{{idmoda}}" class="col-7" />
  </fieldset>
  {{endif showIdModa}}
  <fieldset class="row">
    <label class="col-5" for="dscmoda">Descripción Corta</label>
    <input type="text" name="dscmoda" id="dscmoda" {{readonly}} value="{{dscmoda}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="prcmoda">Precio de Venta</label>
    <input type="text" name="prcmoda" id="prcmoda" {{readonly}} value="{{prcmoda}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="ivamoda">Impuesto sobre la Venta</label>
    <input type="text" name="ivamoda" id="ivamoda" {{readonly}} value="{{ivamoda}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="estmoda">Estado</label>
    <select name="estmoda" id="estmoda" class="col-7" {{selectDisable}} {{readonly}} >
      {{foreach estadosModa}}
        <option value="{{cod}}" {{selected}}>{{dsc}}</option>
      {{endfor estadosModa}}
    </select>
  </fieldset>
  <fieldset class="row">
    <div class="right">
      {{if showBtnConfirmar}}
      <button type="button" id="btnConfirmar" >Confirmar</button>
      &nbsp;
      {{endif showBtnConfirmar}}
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
    });
    $("#btnConfirmar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      /*Aqui deberia hacer validación de datos*/
      document.forms[0].submit();
    });
  });
</script>
