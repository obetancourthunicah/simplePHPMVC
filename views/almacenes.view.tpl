<section class="card depth-1">
  <h1>Gestión de Almacénes</h1>
</section>

<table class="full-width">
  <thead>
      <tr>
        <th>
          Código
        </th>
        <th>
          Almacén
        </th>
        <th>
          Tipo
        </th>
        <th>
          Estado
        </th>
        <th>
          <a href="index.php?page=almacen&mode=INS&almcod=" class="btn depth-1 s-margin"><span class="ion-plus"></span></a>
        </th>
      </tr>
  </thead>
  <tbody class="zebra hover">
      {{foreach almacenes}}
      <tr>
        <td>
            {{almcod}}
        </td>
        <td>
            {{almdsc}}
        </td>
        <td>
            {{almtyp}}
        </td>
        <td>
            {{almest}}
        </td>
        <td>
          <a href="index.php?page=almacen&mode=DSP&almcod={{almcod}}" class="btn depth-1 s-margin"><span class="ion-eye"></span></a>
          <a href="index.php?page=almacen&mode=UPD&almcod={{almcod}}" class="btn depth-1 s-margin"><span class="ion-edit"></span></a>
          <a href="index.php?page=almacen&mode=DEL&almcod={{almcod}}" class="btn depth-1 s-margin"><span class="ion-trash-b"></span></a>
        </td>
      </tr>
      {{endfor almacenes}}
  </tbody>
</table>
