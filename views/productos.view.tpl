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
      <th><a href="index.php?page=producto&mode=INS&prdcod=">Agregar Nuevo</a></th>
      </tr>
    </thead>
    <tbody>
      {{foreach productos}}
        <tr>
          <td>{{prdcod}}</td>
          <td>{{prddsc}}</td>
          <td>{{prdprc}}</td>
          <td>
            <a href="index.php?page=producto&mode=UPD&prdcod={{prdcod}}">Editar</a>&nbsp;
            <a href="index.php?page=producto&mode=DEL&prdcod={{prdcod}}">Eliminar</a>&nbsp;
            <a href="index.php?page=producto&mode=DSP&prdcod={{prdcod}}">Ver</a>
          </td>
        </tr>
      {{endfor productos}}
    </tbody>
  </table>
</section>
