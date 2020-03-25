<section>
  <header>
    <h1>{{modedsc}}</h1>
  </header>
  <br/>
  <main class="row">
    <form action="index.php?page=producto&mode={{mode}}&codprd={{codprd}}" method="POST"  class="col-12 col-md-8 col-offset-2">
      <input type="hidden" name="codprd" value="{{codprd}}" />
      <input type="hidden" name="mode" value="{{mode}}" />
      <input type="hidden" name="token" value="{{token}}" />

      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">Código: &nbsp;</label>
        <input type="text" name="dummy" value="{{codprd}}" placeholder="Código" disabled readonly />
      </fieldset>
      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">Código Interno: &nbsp;</label>
        <input type="text" name="skuprd" value="{{skuprd}}" maxlength=128 placeholder="SKU" 
        {{if isReadOnly}} disabled readonly {{endif isReadOnly}} />
      </fieldset>
      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">Código de Barra: &nbsp;</label>
        <input type="text" name="bcdprd" value="{{bcdprd}}" maxlength="128" placeholder="Código de Barra" 
        {{if isReadOnly}} disabled readonly {{endif isReadOnly}} />
      </fieldset>
      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">Tipo: &nbsp;</label>
        <select name="typprd" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>
          <option value="RTL" {{typeRTLTrue}}>Retail</option>
          <option value="SRV" {{typeSRVTrue}}>Servicio</option>
          <option value="ISK" {{typeISKTrue}}>Infinite Stock</option>
        </select>
      </fieldset>
      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">Descripción Comercial: &nbsp;</label>
        <input type="text" name="dscprd" value="{{dscprd}}" maxlength="70" placeholder="Descripción Comercial" 
        {{if isReadOnly}} disabled readonly {{endif isReadOnly}} />
      </fieldset>

      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">Descripción Corta: &nbsp;</label>
        <textarea name="sdscprd"
          maxlength="255" placeholder="Descripción Corta" class="col-12 col-sm-8 col-md-9"
          {{if isReadOnly}} disabled readonly {{endif isReadOnly}}
        >{{sdscprd}}</textarea>
      </fieldset>

      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">Descripción Larga: &nbsp;</label>
        <textarea name="ldscprd" maxlength="2048" rows=10 placeholder="Descripción Larga" class="col-12 col-sm-8 col-md-9"
          {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>{{ldscprd}}</textarea>
      </fieldset>

      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">Stock: &nbsp;</label>
        <input type="number" name="stkprd" value="{{stkprd}}" min="1" placeholder="Unidades Inventario" {{if isReadOnly}} disabled
          readonly {{endif isReadOnly}} />
      </fieldset>

      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">Precio: &nbsp;</label>
        <input type="text" name="prcprd" value="{{prcprd}}" maxlength="15" placeholder="Precio de Venta" {{if isReadOnly}}
          disabled readonly {{endif isReadOnly}} />
      </fieldset>

      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">URL imagen: &nbsp;</label>
        <input type="text" name="urlprd" value="{{urlprd}}" maxlength="255" placeholder="Imágen de Portada" disabled readonly />
      </fieldset>

      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">URL imagen pequeña: &nbsp;</label>
        <input type="text" name="urlthbprd" value="{{urlthbprd}}" maxlength="255" placeholder="Imágen Catálogo"
           disabled readonly  />
      </fieldset>

      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">Estado: &nbsp;</label>
        <select name="estprd" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>
          <option value="ACT" {{estACTTrue}}>Activo</option>
          <option value="INA" {{estINATrue}}>Inactivo</option>
          <option value="PLN" {{estPLNTrue}}>Planificación</option>
          <option value="RET" {{estRETTrue}}>Retirado</option>
          <option value="DSC" {{estDSCTrue}}>Descontinuado</option>
        </select>
      </fieldset>

      <fieldset class="right">
        {{if hasAction}} <button type="submit" name="botGuardar" class="m-padding btn-primary">Guardar</button> &nbsp; {{endif hasAction}}
        <button id="botCancelar" class="m-padding">Cancelar</button>
      </fieldset>
    </form>
  </main>
</section>

<script>
  var botCancelar = document.getElementById("botCancelar");

  botCancelar.addEventListener("click", function (e) {
    e.preventDefault();
    e.stopPropagation();

    window.location.assign("index.php?page=productos");
  });
</script>
