<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../stylesheets/navbar.css" rel="stylesheet">
  <title>Modèles</title>
  <style>
    .primary-custom-btn {
      background-color: #28a745;
      color: white;
    }
    .primary-custom-btn:hover{
      background-color: #218739;
      color: white;
    }
    svg{
      width: 25px;
      height: 25px;
      fill: white;
      color: white;
    }
  </style>
</head>
<body>
  <?php
    include_once("../components/navbar.php");
  ?>
  <div class="sidbar mt-2 ms-2 pt-2 pb-5 px-3 rounded-2" style="background-color: #000D50; width: 220px; height: auto;">
    <div class="close-side-bar d-flex justify-content-end pb-3 pt-2">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
        <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
      </svg>
    </div>
    <select name="" id="" class="form-select">
      <option value="">parcourir par type</option>
      <option value="">filtrer par le prix</option>
      <option value="">Trier</option>
    </select>
    <div class="brows-by-type mt-3">
      <h5 class="text-white px-2">Parcourir par type</h5>
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
    <div class="filter">
    <h5 class="text-white px-2">Filtrer par le prix</h5>
    <form action="">
      <div class="form-group my-2">
        <label for="min" class="text-white">Prix manimum</label>
        <input type="number" name="" id="min" class="form-control" placeholder="prix minimum" min="0">
      </div>
      <div class="form-group my-2">
        <label for="max" class="text-white">Prix maximum</label>
        <input type="number" name="" id="max" class="form-control" placeholder="Prix minimum" min="0">
      </div> 
    </form>
    </div>
    <div class="sort">
      <h5 class="text-white px-2">Trier par</h5>
      <select name="" id="" class="form-select">
        <option value="">Le nom du modèle</option>
        <option value="">Année</option>
        <option value="">Prix</option>
      </select>
    </div>
  </div>
</body>
</html>