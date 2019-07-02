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
          <th>&nbsp;</th>
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
          <td>&nbsp;</td>
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
