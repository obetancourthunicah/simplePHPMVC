<header>
  <h1>Centros de Costos</h1>
</header>
<main>
  <table>
    <thead>
      <tr>
        <th>Código</th>
        <th>Centro de Costos</th>
        <th>Estado</th>
        <th><button id="btnAddNew">Nuevo</button></th>
      </tr>
    </thead>
    <tbody>
      {{foreach centroscostos}}
        <tr>
          <td>{{cccod}}</td>
          <td>{{ccdsc}}</td>
          <td>{{ccest}}</td>
          <td>
            <a href="index.php?page=centro_de_costos&mode=UPD&cccod={{cccod}}">Editar</a>
            <a href="index.php?page=centro_de_costos&mode=DEL&cccod={{cccod}}">Eliminar</a>
            <a href="index.php?page=centro_de_costos&mode=DSP&cccod={{cccod}}">Ver</a>
          </td>
        </tr>
        {{endfor centroscostos}}
    </tbody>
  </table>
</main>
<script>
  $().ready(function(){
    $("#btnAddNew").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=centro_de_costos&mode=INS&cccod=0");
    });
  });
</script>
