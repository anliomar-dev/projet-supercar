
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../stylesheets/navbar.css" rel="stylesheet">
    <link href="../stylesheets/model_details.css" rel="stylesheet">
    <title>details modele</title>
    <style>
        .hero-section {
      background-color: #f9f9f9;
    }

    .hero-section h2 {
      font-size: 2.5rem;
      font-weight: bold;
    }

    .hero-section p {
      font-size: 1.1rem;
      margin-bottom: 20px;
    }

    .hero-section .btn {
      padding: 10px 20px;
      font-size: 1.2rem;
    }

    .offer-section h3 {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .offer-section h4 {
      font-size: 1.5rem;
      margin-bottom: 15px;
    }

    .offer-section img {
      width: 100%;
      height: auto;
      max-width: 200px;
    }
    .header-img{
      width: 550px;
    }
  </style>
</head>
<body class="position-relative">
<?php
include_once("../components/navbar.php");
?>
<!-- Header Section -->
<section class="hero-section text-center pt-5 mt-3">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <img src="../medias/images/Mercedes-Benz/EQB-300_white-left.webp" class="img-fluid header-img" alt="Car Image">
        </div>
        <div class="col-md-6 text-start">
          <h2 class="text-danger">Cheap Prices With Quality Cars</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed laborom blanditiis ratione numquam odio ea!</p>
          <a href="#" class="btn btn-danger">Learn More</a>
        </div>
      </div>
    </div>
  </section>

  <!-- What We Offer Section -->
  <section class="offer-section py-2 bg-light text-center">
    <div class="container">
      <h3 class="text-danger">What We Offer</h3>
      <h4>Our Car Is Always Excellent</h4>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iusto, doloremque.</p>
      <div class="row">
        <div class="col-md-3">
          <img src="../medias/images/logos/Jeep-logo.webp" class="img-fluid" alt="Engine 1">
        </div>
        <div class="col-md-3">
          <img src="../medias/images/logos/Ferrari-logo.webp" class="img-fluid" alt="Engine 2">
        </div>
        <div class="col-md-3">
          <img src="../medias/images/logos/porsche_logo.webp" class="img-fluid" alt="Engine 3">
        </div>
        <div class="col-md-3">
          <img src="../medias/images/logos/mercedes_logo.webp" class="img-fluid" alt="Engine 3">
        </div>
      </div>
    </div>
  </section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>
</html>