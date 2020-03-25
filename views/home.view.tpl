<section class="cards row">
  {{foreach productos}}
  <section class="card depth-2 col-4 col-sm-6 col-md-3">
    <span class="col-sm-12 center depth-1">
      {{if urlthbprd}}
          <img src="{{urlthbprd}}" alt="{{skuprd}} {{dscprd}}" class="imgthumb center" />
      {{endif urlthbprd}}
    </span>
    <span class="col-sm-12 center depth-1 m-padding">
        <span class="col-sm-12">{{skuprd}}</span>
        <span class="col-sm-12">{{dscprd}}</span>
    </span>
    <span class="col-sm-12 center depth-1 m-padding">
      <span class="col-sm-6">Disponibles</span>
      <span class="col-sm-6 center">{{stkprd}}</span>
      <span class="col-sm-12 bold center m-padding">
        <a href="index.php?page=addtocart&codprd={{codprd}}" class="l-padding btn btn-primary">
          L {{prcprd}} <span class="ion-plus-circled"></span>
        </a>
      </span>
    </span>
    </span>
  </section>
  {{endfor productos}}
</section>
