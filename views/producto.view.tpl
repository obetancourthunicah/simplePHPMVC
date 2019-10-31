<h1>Gestion de Producto</h1>
<h2>{{modedesc}}</h2>
<h3>{{prdcod}} {{prddsc}}</h3>
<a href="index.php?page=productos">Regresar</a>
<section class="row">
<form method="post" action="index.php?page=producto&mode={{mode}}&prdcod={{prdcod}}">
  <input type="hidden" name="prdcod" value={{prdcod}}/>
  <input type="hidden" name="producto_token" value={{producto_token}} />
  <input type="hidden" name="btnConfirmar" value="confirmar" />
  <section class="col-sm-10 col-md-6 col-sm-offset-1 col-offset-3">
  <fieldset>
    <legend>Datos del Producto</legend>
    <div class="row">
      <label for="prddsc" class="col-sm-12 col-md-4">Producto</label>
      <input type="text" maxlength="45" placeholder="Nombre del Producto"
          name="prddsc" id="prddsc" value="{{prddsc}}"
            class="col-sm-12 col-md-8" {{readonly}} {{isdeleting}}/>
      {{if prddsc_haserror}}
        <div class="col-sm-12 alert">{{prddsc_error}}</div>
      {{endif prddsc_haserror}}
    </div>
    <div>
      <label for="prdprc" class="col-sm-12 col-md-4">Precio</label>
      <input type="number" min="0" max="1000000000000"
        placeholder="Precio del Producto"
        name="prdprc" id="prdprc" value="{{prdprc}}"
        class="col-sm-12 col-md-8" {{readonly}} {{isdeleting}}/>
    </div>
    <div>
        <label for="catcod" class="col-sm-12 col-md-4">Categoría</label>
        <span class="select col-sm-12 col-md-8">
          <select name="catcod" id="catcod"
            class="col-sm-12"
            {{if readonly}} readonly="readonly" disabled {{endif readonly}}
            {{if isdeleting}} readonly="readonly" disabled {{endif isdeleting}}
          >
          {{foreach categories}}
            <option value="{{catcod}}" {{selected}}>{{catdsc}}</option>
          {{endfor categories}}
          </select>
        </span>
    </div>
  </fieldset>
  {{ifnot readonly}}
  <fieldset class="right">
    <button type="button" id="btnConfirmar">Confirmar</button>
    &nbsp;
    <button type="button" id="btnCancelar">Cancelar</button>
  </fieldset>
  {{endifnot readonly}}
  </section>
</form>
{{if haserrors}}
<section class="alert">
      <ol>
        {{foreach errors}}
        <li>{{this}}</li>
        {{endfor errors}}
      </ol>
</section>
{{endif haserrors}}
</section>
<script>
  $().ready(
    function(){
      {{ifnot readonly}}
      $("#btnCancelar").click(function(e){
          e.preventDefault();
          e.stopPropagation();
          window.location.assign("index.php?page=productos");
      });
      $("#btnConfirmar").click(function (e) {
        e.preventDefault();
        e.stopPropagation();
        /* validar en el cliente aqui */
        document.forms[0].submit();
      });
      {{endifnot readonly}}
    }
  );
</script>
