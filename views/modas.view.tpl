<section>
  <header>
    <h1>Gestión de Modas</h1>
  </header>
  <main>
    <table class="full-width">
      <thead>
        <tr>
          <th>Cod</th>
          <th>Moda</th>
          <th>Precio</th>
          <th>Iva</th>
          <th>Estado</th>
          <th class="right">
            <form action="index.php?page=moda" method="post">
            <input type="hidden" name="idmoda" value="" />
            <input type="hidden" name="xcfrt" value="{{~xcfrt}}" />
            <button type="submit" name="btnIns">Agregar</button>
          </form>
          </th>
        </tr>
      </thead>
      <tbody class="zebra">
        {{foreach modas}}
        <tr>
          <td>{{idmoda}}</td>
          <td>{{dscmoda}}</td>
          <td>{{prcmoda}}</td>
          <td>{{ivamoda}}</td>
          <td>{{estmoda}}</td>
          <td class="right">
            <form action="index.php?page=moda" method="post">
              <input type="hidden" name="idmoda" value="{{idmoda}}"/>
              <input type="hidden" name="xcfrt" value="{{~xcfrt}}" />
              <button type="submit" name="btnDsp">Ver</button>
              <button type="submit" name="btnUpd">Editar</button>
              <button type="submit" name="btnDel">Eliminar</button>
            </form>
          </td>
        </tr>
        {{endfor modas}}
      </tbody>
      <tfoot>
        <tr>
          <td colspan="6"> Paginación</td>
        </tr>
      </tfoot>
    </table>
  </main>
</section>
