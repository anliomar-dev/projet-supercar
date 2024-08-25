<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../stylesheets/navbar.css" rel="stylesheet">
  <title>Marques</title>
</head>
<body>
  <?php
      include_once("../components/navbar.php")
  ?>
  <main class="container mt-3 d-flex justify-content-center flex-wrap">
    <?php
      for($i = 0; $i < 11; $i++){
        echo'
          <div class="card shadow mx-auto my-4" style="height: 300px; width: 230px">
            <div 
              class="
                card_head px-3 
                d-flex flex-column align-items-center 
                py-4 position-relative rounded-top h-50 text-white
              " 
              style="background-color: #000D50;"
            >
              <h3 class="card-title">Porsche</h3>
              <hr class="my-0 w-75" style="background-color: white;"/>
              <div class="mt-1" style="height: 70%;">
                <img src="../medias/images/logos&icones/porsche_logo" alt="logo" class="h-100">
              </div>
              <div class="position-absolute" 
              style="height: 25px; width: 25px; background-color: white; right: 0; bottom: 0;">
                
              </div>
              <div class="position-absolute" 
              style="height: 60px; width: 60px; background-color: #000D50; border-radius: 100%; right: 0; bottom: 0;">
                
              </div>
            </div>
            <div class="card_body d-flex flex-column align-items-center justify-content-center position-relative">
            <div class="position-absolute z-0 start-0 top-0" 
              style="height: 25px; width: 25px; background-color: #000D50;">
                
              </div>
              <div class="position-absolute bg-white z-1 top-0 start-0" 
              style="height: 60px; width: 60px; border-radius: 100%;">
                
              </div>
              <div class="mt-3 z-2">
                <h4 style="">20 modèles</h4>
              </div>
              <div class="mt-3">
                <button class="btn btn-primary">models</button>
              </div>
            </div>
          </div>
        ';
      }
    ?>
  </main>
</body>
</html>