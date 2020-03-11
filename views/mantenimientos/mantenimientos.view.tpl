<header>
  <h1>Manteniminetos</h1>
</header>
<section class="row">
  {{foreach mantenimientos}}
    <section class="card depth-0 col-3 center">
      <a class="bg-white button" href="index.php?page={{page}}">
        <div class="ion-{{ionicon}} bigicon"></div>
        <div>{{pageDsc}}</div>
      </a>
    </section>
  {{endfor mantenimientos}}
</section>
<style>
  .button{
    display: block;
    overflow: auto;
    padding: 1em;
    text-decoration: none;
  }
  .bigicon {
    font-size: 3em;
  }
  a.bg-white:hover{
    background-color: #b9b9b9 !important;
  }
</style>
