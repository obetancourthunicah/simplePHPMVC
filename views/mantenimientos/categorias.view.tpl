<section>
  <header>
    <h1>Trabajar con Categorías</h1>
  </header>
  <main class="row">
    <div class="col-12 col-md-8 col-offset-2">
      <table class="full-width">
        <thead>
          <tr>
            <th>Código</th>
            <th>Categoría</th>
            <th>Estado</th>
            <th class="center"><button id="btnNew">Add New</button></th>
          </tr>
        </thead>
        <tbody class="zebra">
          {{foreach categorias}}
            <tr>
              <td>{{ctgcod}}</td>
              <td>{{ctgdsc}}</td>
              <td>{{ctgest}}</td>
              <td class="center">
                <a class="btn" href="index.php?page=categoria&mode=UPD&ctgcod={{ctgcod}}">Editar</a>
                <a class="btn" href="index.php?page=categoria&mode=DSP&ctgcod={{ctgcod}}">Ver</a>
                <a class="btn" href="index.php?page=categoria&mode=DEL&ctgcod={{ctgcod}}">Eliminar</a>
              </td>
            </tr>
            {{endfor categorias}}
        </tbody>
      </table>
    </div>
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
