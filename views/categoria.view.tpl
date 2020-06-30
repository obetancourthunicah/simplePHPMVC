<h1>Mantenimiento de Categoría</h1>
<h2>{{modedsc}}</h2>

<section class="row">
<form action="index.php?page=categoria&mode={{mode}}&catid={{catid}}" method="post"
  class="col-offset-2 col-8">
  <fieldset>
    <section class="row">
      <label class="col-4" for="catid">Código</label>
      <input class="col-8" type="text" id="catid"  name="catid" value="{{catid}}" disabled readonly />
    </section>
    <section class="row">
      <label class="col-4" for="catdsc">Nombre de la Categoría</label>
      <input class="col-8" type="text"  {{readonly}} name="catdsc" id="catdsc" value="{{catdsc}}" placeholder="Nombre de la Categoría" />
    </section>
    <section class="row">
      <label class="col-4"  for="catest">Estado</label>
      <select id="catest" name="catest" class="col-8"  {{readonly}}>
        <option value="ACT" {{catest_ACT}}>Activo</option>
        <option value="INA" {{catest_INA}}>Inactivo</option>
      </select>
    </section>
    <section class="row right">
      {{if isDeleting}}
        <button type="submit" name="btnGuardar">Eliminar</button> &nbsp;
      {{endif isDeleting}}
      {{ifnot isDeleting}}
        <button type="submit" name="btnGuardar">Guardar</button> &nbsp;
      {{endifnot isDeleting}}
      <button id="btnCancelar" name="btnCancelar">Cancelar</button>
    </section>
  </fieldset>
</form>

</section>
