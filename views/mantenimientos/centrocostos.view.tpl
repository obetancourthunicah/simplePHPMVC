<header>
  <h1>Tabajar con Centro de Costo</h1>
</header>
<main>
  <form action="index.php?page=centro_de_costos" method="post">
    <input type="hidden" name="cccod" value="{{cccod}}" />
    <input type="hidden" name="mode" value="{{mode}}" />
    <fieldset>
      <label>Código</label>
      <input type="text" readonly disabled value="{{cccod}}" />
    </fieldset>
    <fieldset>
      <label>Centro de Costo</label>
      <input type="text" value="{{ccdsc}}" name="ccdsc" />
    </fieldset>
    <fieldset>
      <label>Estado</label>
      <select name="ccest">
        <option value="ACT" {{if ccest_ACT}}selected{{endif ccest_ACT}} >Activo</option>
        <option value="INA" {{if ccest_INA}}selected{{endif ccest_INA}}>Inactivo</option>
      </select>
    </fieldset>
    <fieldset>
      <button type="submit">Guardar</button>
      <button id="btnCancel">Cancelar</button>
    </fieldset>
  </form>
</main>
<script>
  $().ready(function(){
    $("#btnCancel").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.assign('index.php?page=centros_de_costos');
    });
  });
</script>
