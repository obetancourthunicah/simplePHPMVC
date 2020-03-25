<section class="cards row">
  {{foreach productos}}
  <section class="card depth-1 col-4 col-sm-6 col-md-3">
    <span class="col-sm-12 center">
      {{if urlthbprd}}
          <img src="{{urlthbprd}}" alt="{{skuprd}} {{dscprd}}" class="imgthumb center" />
      {{endif urlthbprd}}
    </span>
  </section>
  {{endfor productos}}
</section>
