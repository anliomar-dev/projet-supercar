<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../stylesheets/navbar.css" rel="stylesheet">
  <link href="../stylesheets/modeles.css" rel="stylesheet">
  <title>Modèles</title>
</head>
<body class="position-relative">
  <?php
    include_once("../components/navbar.php");
    include_once("../php/all_marques.php");
  ?>
  <div class="position-relative z-5 toggle-container" style="max-width: 235px;">
    <svg class="toggle-side-bar" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
    </svg>
    <span class="position-absolute bottom-0 border bg-white py-2 px-3 z-5 shadow mt-2 ms-2 rounded-3 pop-over">click to open options</span>
  </div>
  <div class="sidbar ms-2 pt-2 pb-5 px-3 rounded-2 position-fixed" style="background-color: #000D50; width: auto; z-index: 1000;">
    <div class="close-side-bar d-flex justify-content-between pb-3 pt-2">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
      </svg>
      <svg class="close-sidebar" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
      </svg>
    </div>
    <select name="" id="filterOptions" class="form-select">
      <option value="brows-by-type">parcourir par type</option>
      <option value="filter">filtrer par le prix</option>
      <option value="sort">Trier</option>
      <option value="search">Search</option>
    </select>
    <div class="brows-by-type mt-3 pt-3">
      <h5 class="text-white px-2"><u>Parcourir par type</u></h5>
      <div class="buttons mt-3">
        <div class="btn-container my-2 px-2">
          <button class="btn primary-custom-btn fs-6">Thermique</button>
        </div>
        <div class="btn-container my-2 px-2">
          <button class="btn primary-custom-btn fs-6">électrique</button>
        </div>
        <div class="btn-container my-2 px-2">
          <button class="btn primary-custom-btn fs-6">Hybride</button>
        </div>
      </div>
    </div>
    <div class="filter mt-3 pt-3" style="display: none">
      <h5 class="text-white px-2 pb-2"><u>Filtrer par le prix</u></h5>
      <form action="">
        <div class="form-group my-2">
          <label for="min" class="text-white">Prix manimum</label>
          <input type="number" name="" id="min" class="form-control" placeholder="prix minimum" min="0">
        </div>
        <div class="form-group my-2">
          <label for="max" class="text-white">Prix maximum</label>
          <input type="number" name="" id="max" class="form-control" placeholder="Prix maximum" min="0">
        </div> 
      </form>
    </div>
    <div class="sort mt-3 pt-3" style="display: none">
      <h5 class="text-white px-2"><u>Trier par</u></h5>
      <select name="" id="" class="form-select">
        <option value="">Le nom du modèle</option>
        <option value="">Année</option>
        <option value="">Prix</option>
      </select>
    </div>
    <div class="search mt-3" style="display: none">
      <form action="" class="search-form border py-2 px-3 rounded-3 shadow d-flex justify-content-center align-items-center" style="width: 300px;">
      <input type="text" class="form-control w-100" name="search" id="search" placeholder="search a model">
      </form>
    </div>
  </div>
  <main class="z-3 container d-flex justify-content-center flex-wrap">
    <div class="z-3 card pt-3 pb-2 px-3 mt-5 rounded-4" style="width: 300px">
      <div class="w-100 d-flex justify-content-between">
        <div class="image border-end" style="width: 30%">
          <img class="w-100" src="../medias/images/logos&icones/porsche_logo.webp" alt="">
        </div>
        <div class="brand d-flex justify-content-center align-items-center" style="width: 70%">
          <h5 style="color: #000D50;">panamera</h5>
        </div>
      </div>
      <p class="ms-2 py-0 my-0" style="color: #000D50;;">Porsche</p>
      <div class="body mt-2">
        <img class="w-100 rounded-3" src="../medias/images/panamera.webp" alt="">
      </div>
      <div class="footer mt-2 py-3 px-2">
        <h4 class="mx-0 px-0" style="color: #000D50;">Details</h4>
        <div class="row card-details">
          <div class="col-6 border py-1 card-details-items"><strong style="color:#000D50;">Année</strong></div>
          <div class="col-6 border py-1 card-details-items">2020</div>
          <div class="col-6 border py-1 card-details-items"><strong style="color:#000D50;">Prix</strong></div>
          <div class="col-6 border py-1 card-details-items">300.000,00 €</div>
          <div class="col-6 border py-1 card-details-items"><strong style="color:#000D50;">Moteur</strong></div>
          <div class="col-6 border py-1 card-details-items">Electrique</div>
          <div class="col-12 mt-2">
            <div class="row">
              <a href="" class="btn col-6 mx-auto primary-custom-btn">Essayer</a>
              <a href="" class="btn col-6 mx-auto" style="color:#218739;"><strong>Voir plus</strong></a>
            </div>
          </div>
          <div class="other-models d-flex justify-content-end pe-0 mt-3">
            <div class="me-2 omar border rounded-5" style="width: 40px; height: 40px; border-radius: 100%;">
              
            </div>
            <div class="me-2 omar border rounded-5" style="width: 40px; height: 40px; border-radius: 100%;">
              
            </div>
            <div class="omar border rounded-5" style="width: 40px; height: 40px; border-radius: 100%;">
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="../js/modeles.js" type="module" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>
</html>