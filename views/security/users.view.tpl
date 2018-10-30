  <h1>
  Gestión de Usuarios
</h1>
<div class="row depth-1 m-padding">
  <form action="index.php?page=users" method="post" class="col-md-8 col-offset-2">
      <div class="row s-padding">
        <label class="col-md-1" for="fltEmail">Correo:&nbsp;</label>
        <input type="email" name="fltEmail"  class="col-md-8"
              id="fltEmail" placeholder="correo@electron.ico" value="{{fltEmail}}" />
        <button class="col-md-3" id="btnFiltro"><span class="ion-refresh">&nbsp;Actualizar</span></button>
      </div>
  </form>
</div>

<div class="row depth-1">
  <table class="col-md-12">
    <thead>
      <tr>
        <th>Correo</th>
        <th>Nombre</th>
        <th class="sd-hide">Tipo</th>
        <th class="sd-hide">Estado</th>
        <th>
          {{if canNew}}
          <a href="index.php?page=user&usrcod=0&mode=INS" class="btn depth-1 s-margin">
          <span class="ion-plus-circled"></span>
          </a>
          {{endif canNew}}
        </th>
      </tr>
    </thead>
    <tbody class="zebra">
      {{foreach usuarios}}
      <tr>
        <td>{{useremail}}</td>
        <td>{{username}}</td>
        <td class="sd-hide">{{usertipo}}</td>
        <td class="sd-hide">{{userest}}</td>
        <td class="center">
          {{if ~canEdit}}
          <a href="index.php?page=user&usrcod={{usercod}}&mode=UPD" class="btn depth-1 s-margin"><span class="ion-edit"></span></a>
          {{endif ~canEdit}}
          <a href="index.php?page=user&usrcod={{usercod}}&mode=DSP" class="btn depth-1 s-margin"><span class="ion-eye"></span></a>
        </td>
      </tr>
      {{endfor usuarios}}
    </tbody>
  </table>
</div>


<script>
    $().ready(
    function(){
      $("#btnFiltro").click(
        function(e){
          e.preventDefault();
          e.stopPropagation();
          document.forms[0].submit();
        }
      );
    }

    );
</script>
