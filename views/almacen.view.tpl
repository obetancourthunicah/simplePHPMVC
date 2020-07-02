<h1>{{modedsc}}</h1>
<section>
  <form action="index.php?page=almacen&mode={{mode}}&almcod={{almcod}}" method="POST">
      <div>
        <label for="almcod">Código</label>
        <input type="number" name="almcod" id="almcod" value="{{almcod}}" />
      </div>
      <div>
        <label for="almdsc">Almacén</label>
        <input type="text" name="almdsc" id="almdsc" value="{{almdsc}}" />
      </div>
      <div>
        <label for="almtip">Tipo</label>
        <select id="almtip" name="almtip">
          <option value="WRH" {{almtip_WRH}}>Almacén</option>
          <option value="RTL" {{almtip_RTL}}>Punto de Venta</option>
          <option value="TRS" {{almtip_TRS}}>Almacén de Distribución</option>
        </select>
      </div>
      <div>
        <label for="almest">Estado</label>
        <select id="almest" name="almest">
          <option value="PLN" {{almest_PLN}}>En Construcción</option>
          <option value="ACT" {{almest_ACT}}>Activo</option>
          <option value="INA" {{almest_INA}}>Inactivo</option>
        </select>
      </div>
      <div>
        <button type="submit" name="btnGuardar">Guardar</button>
        &nbsp;
        <button type="submit" name="btnCancelar">Cancelar</button>
      </div>
  </form>
</section>
