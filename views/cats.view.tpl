<h1>Gestión de Categorias</h1>
<section>
    {{funnyData}}
</section>
<section>
  <table>
    <thead>
      <tr>
      <th>Código</th>
      <th>Categoria</th>
      <th>Estado</th>
      <th><a href="index.php?page=categoria&mode=INS&catcod=">Agregar Nuevo</a></th>
      </tr>
    </thead>
    <tbody>
      {{foreach categorias}}
        <tr>
          <td>{{catcod}}</td>
          <td>{{catdsc}}</td>
          <td>{{catest}}</td>
          <td>
            <a href="index.php?page=categoria&mode=UPD&catcod={{catcod}}">Editar</a>&nbsp;
            <a href="index.php?page=categoria&mode=DEL&catcod={{catcod}}">Eliminar</a>&nbsp;
            <a href="index.php?page=categoria&mode=DSP&catcod={{catcod}}">Ver</a>
          </td>
        </tr>
      {{endfor categorias}}
    </tbody>
  </table>
</section>
