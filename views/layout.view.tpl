<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Music Blog</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/jazz.css" />
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>

  <style>
    .brand {
      width: 150px;
      padding: 21px 15px 0px 15px;
    }

    .article {
      margin-top: 1.5em;
    }

    .art-img {
      width: 100%;
      margin-bottom: 1em;
    }

    .searchbox {
      margin-top: 1em;
      margin-bottom: 1em;
    }
  </style>
  {{foreach css_ref}}
  <link rel="stylesheet" href="{{uri}}" />
  {{endfor css_ref}}
</head>

<body>
          <div class="row" style="margin-left:0px !important; margin-right:0px !important;">
            <div class="col-sm-12 col-md-4 text-center">
              <img class="brand" src="public/imgs/brand.png" alt="JazzBrand" />
            </div>
            <div class="col-sm-12 col-md-8 text-center text-md-right align-self-end">
              <img src="public/imgs/facebook.png" alt="Facebook" />
              <img src="public/imgs/instagram.png" alt="Instagram">
              <img src="public/imgs/twitter.png" alt="Twitter">
            </div>
          </div>
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
              aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav d-flex justify-content-around" style="width:100%">
                <li class="nav-item ">
                  <a class="nav-link" href="index.php?page=home">{{page_title}}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Artistas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Grupos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Top 10</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Letras</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php?page=login">Iniciar Sesión</a>
                </li>
              </ul>
            </div>
          </nav>
            <div class="container" style="margin-top:1em;margin-bottom: 1em;">
                {{{page_content}}}
            </div>
            <footer class="blog-footer">
                <p>Derechos Reservados 2018</p>
                <p><a href="#">Back to top</a></p>
              </p>
            </footer>
            
            {{foreach js_ref}}
                <script src="{{uri}}"></script>
            {{endfor js_ref}}
            <script src="https://unpkg.com/ionicons@4.4.1/dist/ionicons.js"></script>
        </body>
    </html>
