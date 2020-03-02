<section>
  <header>
    <h1>Trabajar con Categorías</h1>
  </header>
  <main>
    <table>
      <thead>
        <tr>
          <th>Código</th>
          <th>Categoría</th>
          <th>Estado</th>
          <th><button id="btnNew">Add New</button></th>
        </tr>
      </thead>
      <tbody>
        {{foreach categorias}}
          <tr>
            <td>{{ctgcod}}</td>
            <td>{{ctgdsc}}</td>
            <td>{{ctgest}}</td>
            <td>
              <a class="btn" href="index.php?page=categoria&mode=UPD&ctgcod={{ctgcod}}">Editar</a>
              <a class="btn" href="index.php?page=categoria&mode=DSP&ctgcod={{ctgcod}}">Ver</a>
              <a class="btn" href="index.php?page=categoria&mode=DEL&ctgcod={{ctgcod}}">Eliminar</a>
            </td>
          </tr>
          {{endfor categorias}}
      </tbody>
    </table>
  </main>
</section>
<script>
  $().ready(
    function(){
      $("#btnNew").click(function(e){
        e.preventDefault();
        e.stopPropagation();
        window.location.assign("index.php?page=categoria&mode=INS&ctgcod=0");
      });
    }
  )
</script>
