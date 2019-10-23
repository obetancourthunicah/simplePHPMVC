<h1>Gestión de Productos {{username}}</h1>
<section>

</section>
<section>
  <table>
    <thead>
      <tr>
      <th>Código</th>
      <th>Producto</th>
      <th>Precio</th>
      <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      {{foreach productos}}
        <tr>
          <td>{{prdcod}}</td> 
          <td>{{prddsc}}</td>
          <td>{{prdprc}}</td>
          <td>&nbsp;</td>
        </tr>
      {{endfor productos}}
    </tbody>
  </table>
</section>
