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
              <button>Edit</button>
              <button>Delete</button>
              <button>View</button>
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
