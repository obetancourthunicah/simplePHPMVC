<section>
  <header>
    <h1>{{modedsc}}</h1>
  </header>
  <br />
  <main class="row">
    <form action="index.php?page=productimg&codprd={{codprd}}" method="POST"
      class="col-12 col-md-8 col-offset-2" enctype="multipart/form-data">
      <input type="hidden" name="codprd" value="{{codprd}}" />
      <input type="hidden" name="token" value="{{token}}" />

      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">Código Interno: &nbsp;</label>
        <input type="text" name="skuprd" value="{{skuprd}}" maxlength=128 placeholder="SKU" disabled readonly />
      </fieldset>
      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">Descripción Comercial: &nbsp;</label>
        <input type="text" name="dscprd" value="{{dscprd}}" maxlength="70" placeholder="Descripción Comercial"
          disabled readonly/>
      </fieldset>

      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">Imágen de Portada: &nbsp;</label>
        {{if urlprd}}
          <span class="col-12 col-sm-8 col-md-9 center"><img src="{{urlprd}}" alt="Portada {{codprd}} {{dscprd}}" class="imagePrd"/></span>
        {{endif urlprd}}
        {{ifnot urlprd}}
        <span class="col-12 col-sm-8 col-md-9 center"><img src="public/imgs/noprod.png" alt="Portada {{codprd}} {{dscprd}}"
            class="imagePrd" /></span>
        {{endifnot urlprd}}
        <input class="col-sm-12 col-md-6 col-offset-3" {{readonly}} type="file" name="uploadUrlPrd" id="uploadUrlPrd" />
        <button type="submit" name="btnGuardarUrlPrd" class="m-padding btn-primary">Guardar</button>
        <span class="center col-12 col-sm-12">Imágen jpg, png, o svg de 480 x 480 px 115 dpi</span>
      </fieldset>

      <fieldset>
        <label class="col-12 col-sm-4 col-md-3">Imágen de Catálogo: &nbsp;</label>
        {{if urlprd}}
        <span class="col-12 col-sm-8 col-md-9 center"><img src="{{urlthbprd}}" alt="Catálogo {{skuprd}} {{dscprd}}" class="imgthumb" /></span>
        {{endif urlprd}}
        {{ifnot urlprd}}
        <span class="col-12 col-sm-8 col-md-9 center"><img src="public/imgs/noprodthb.png" alt="Catálogo {{codprd}} {{dscprd}}"
            class="imgthumb" /></span>
        {{endifnot urlprd}}
        <input class="col-sm-12 col-md-6 col-offset-3" {{readonly}} type="file" name="uploadUrlThbPrd" id="uploadUrlThbPrd" />
        <button type="submit" name="btnGuardarUrlThbPrd" class="m-padding btn-primary">Guardar</button>
        <span class="center col-12 col-sm-12">Imágen jpg, png, o svg de 115 x 115 px 115 dpi</span>
      </fieldset>

      <fieldset class="right">
        <button id="botCancelar" class="m-padding">Cerrar</button>
      </fieldset>
    </form>
  </main>
</section>

<script>
  var botCancelar = document.getElementById("botCancelar");

  botCancelar.addEventListener("click", function (e) {
    e.preventDefault();
    e.stopPropagation();

    window.location.assign("index.php?page=productos");
  });
</script>
