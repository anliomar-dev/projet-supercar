<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>signin</title>
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../stylesheets/signin.css" rel="stylesheet">
    <link href="../stylesheets/navbar.css" rel="stylesheet">
  </head>
  <body>
    <?php
      include_once("../components/navbar.php")
    ?>
    <div class="form-container">
      <div class="row d-flex justify-content-center">
        <div class="col-10 col-md-6 col-lg-4">
          <form action="" class="shadow border mt-5 pt-3 pb-5 rounded" style="box-sizing: border-box; padding-inline: 30px;">
            <div class="logo text-center my-3 py-2">
              <img style="width: 190px; height: 56px;" class="img-fluid" src="../medias/images/logos/supercar_logo_noir.webp" alt="logo supercar">
            </div>
            <h4 class="text-center mt-3">CONNEXION</h4>
            <div class="form-group py-3">
              <label for="email">Adresse e-mail</label>
              <input type="email" class="form-control py-2" id="email" name="email" placeholder="email" autocomplete="email" autofocus>
            </div>
            <div class="form-group py-3 position-relative password-container">
              <label for="password">Mot de passe</label>
              <input type="password" class="form-control py-2 passwordField" id="password" name="password" placeholder="password" autocomplete="current-password">
              <span class="eye-icon">👁️</span>
              <span style="display: none;" class="hide-password">🙈</span>
            </div>
            <p class="d-flex justify-content-end"><a href="">Mot de passe oublié ?</a></p>
            <div class="form-group py-2">
              <button class="btn btn-block col-12 text-white signin-btn">Login</button>
            </div>
            <p class="text-center mt-3">Vous n'avez pas de compte ? <a href="/super-car/supercar/signup">signup</a></p>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="../js/signin.js" type="module" defer></script>
  </body>
</html>