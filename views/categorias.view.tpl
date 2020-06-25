<section class="card depth-1">
  <h1>Mantenimiento de Categorías</h1>
</section>
<section class="card depth-1">
  <table class="full-width">
    <thead>
      <tr>
        <th>
          Código
        </th>
        <th>
          Categoría
        </th>
        <th>
          Estado
        </th>
        <th>
          <a class="btn depth-1 s-margin" href="index.php?page=categoria&mode=INS&catid="><span class="ion-plus"></span></a>
        </th>
      </tr>
    </thead>
    <tbody class="zebra hover">
      {{foreach categorias}}
        <tr>
          <td>{{catid}}</td>
          <td>{{catdsc}}</td>
          <td>{{catest}}</td>
          <td class="center"> 
            <a class="btn depth-1 s-margin" href="index.php?page=categoria&mode=DSP&catid={{catid}}"><span class="ion-eye"></span></a>
            <a class="btn depth-1 s-margin" href="index.php?page=categoria&mode=UPD&catid={{catid}}"><span class="ion-edit"></span></a>
            <a class="btn depth-1 s-margin" href="index.php?page=categoria&mode=DEL&catid={{catid}}"><span class="ion-trash-b"></span></a>
          </td>
        </tr>
      {{endfor categorias}}
    </tbody>
  </table>
</section>
