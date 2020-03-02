<section>
  <header>
    <h1>{{modedsc}}</h1>
  </header>
  <br/>
  <main class="row">
    <form action="index.php?page=categoria&mode={{mode}}&ctgcod={{ctgcod}}" method="post" class="col-12 col-md-8 col-offset-2">
      <input type="hidden" name="ctgcod" value="{{ctgcod}}" />
      <input type="hidden" name="mode" value="{{mode}}" />
      <input type="hidden" name="token" value="{{token}}"/>
    <fieldset>
      <label class="col-12 col-sm-4 col-md-3">Código</label>
      <input type="text" name="ctgcoddummy" value="{{ctgcod}}" placeholder="Código"
        disabled readonly
        />
    </fieldset>
    <fieldset>
      <label class="col-12 col-sm-4 col-md-3">Categoría</label>
      <input type="text" name="ctgdsc" value="{{ctgdsc}}"
        maxlength="70"  placeholder="Descripción de la Categoría"
         {{if isReadOnly}} disabled readonly {{endif isReadOnly}}
        />
    </fieldset>
    <fieldset>
      <label class="col-12 col-sm-4 col-md-3">Estado</label>
      <select name="ctgest" {{if isReadOnly}} disabled readonly {{endif isReadOnly}}>
        <option value="ACT" {{ctgEstACTTrue}}>Activo</option>
        <option value="INA" {{ctgEstINATrue}} >Inactivo</option>
      </select>
    </fieldset>
    <fieldset class="right">
      {{if hasAction}}
      <button type="submit" name="btnConfirmar" class="m-padding btn-primary">Guardar</button>
      {{endif hasAction}}
      <button id="btnCancelar"  class="m-padding">Cancelar</button>
    </fieldset>
    </form>
  </main>
</section>
<script>
  $().ready(function(){
    $("#btnCancelar").click(
      function(e){
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=categorias");
      }
    );
  });
</script>
