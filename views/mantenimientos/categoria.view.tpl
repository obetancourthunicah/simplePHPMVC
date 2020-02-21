<section>
  <header>
    <h1>Trabajando con</h1>
  </header>
  <main>
    <form action="index.php?page=categoria" method="post">
    <fieldset>
      <label>Código</label>
      <input type="text" name="ctgcod" value="{{ctgcod}}" placeholder="Código"/>
    </fieldset>
    <fieldset>
      <label>Categoría</label>
      <input type="text" name="ctgdsc" value="{{ctgdsc}}"
        maxlength="70"  placeholder="Descripción de la Categoría" />
    </fieldset>
    <fieldset>
      <label>Estado</label>
      <select name="ctgest">
        <option value="ACT" {{ctgEstACTTrue}}>Activo</option>
        <option value="INA" {{ctgEstINATrue}} >Inactivo</option>
      </select>
    </fieldset>
    <fieldset>
      <button type="submit" name="btnConfirmar">Guardar</button>
      <button id="btnCancelar">Cancelar</button>
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
