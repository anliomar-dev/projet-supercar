<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../stylesheets/navbar.css" rel="stylesheet">
  <link href="../stylesheets/essai.css" rel="stylesheet">
  <title>Modèles</title>
</head>
<body class="position-relative">
  <?php
    include_once("../components/navbar.php");
  ?>
  
  <main class="">
    <!-- signup form -->
    <div class="form_container d-flex justify-content-center pt-3 mt-5">
        <div class="signup-form">
            <h2 class="text-center font-weight-bold">Reservez un essai</h2>
            <form style="width: 100%;" id="signupForm">
                <input type="hidden" id="action" value="create">
                <div class="row mt-3 pt-2">
                    <div class="form-group col-md-6">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" placeholder="Date" autocomplete="" autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="heure">Heure</label>
                        <div class="d-flex">
                          <button type="button" class="rounded-start-2 primary-custom-btn border-0 px-2 d-flex justify-content-center align-items-center" style="height: 38px">
                            <svg class="clock-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                          </button>
                          <input type="text" class="form-control" id="heure" placeholder="Heure" autocomplete="">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="marque">Marque</label>
                    <select name="marque" id="marque" class="form-control">
                      <?php
                        include("../php/all_marques.php");
                        option_brands();
                      ?>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="modele">Modèle</label>
                    <div class="d-flex">
                      <button type="button" 
                        class="rounded-start-2 primary-custom-btn border-0 px-2 
                        d-flex justify-content-center align-items-center" 
                        style="height: 37.5px; width: 60px;"
                        data-bs-toggle="modal" data-bs-target="#scrollModal"
                        >
                        <img src="../medias/images/logos/porsche_logo.webp" alt="" style="width: 100%; height: 75%;">
                      </button>
                      <input type="text" class="form-control" id="modele" placeholder="modele" autocomplete="">
                    </div>
                </div>
                <button type="button" id="" class="btn col-12 primary-custom-btn mt-2">submit</button>
                <button type="reset" class="btn col-12 btn-reset mt-2">reset</button>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="scrollModal" data-bs-backdrop="scrollModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scrollModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="scrollModal">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus repudiandae inventore deleniti veniam ea vero non veritatis, 
            dolores ducimus eaque fugiat, rem animi ipsum quos laboriosam nobis at, quaerat voluptates.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus repudiandae inventore deleniti veniam ea vero non veritatis, 
            dolores ducimus eaque fugiat, rem animi ipsum quos laboriosam nobis at, quaerat voluptates.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus repudiandae inventore deleniti veniam ea vero non veritatis, 
            dolores ducimus eaque fugiat, rem animi ipsum quos laboriosam nobis at, quaerat voluptates.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus repudiandae inventore deleniti veniam ea vero non veritatis, 
            dolores ducimus eaque fugiat, rem animi ipsum quos laboriosam nobis at, quaerat voluptates.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus repudiandae inventore deleniti veniam ea vero non veritatis, 
            dolores ducimus eaque fugiat, rem animi ipsum quos laboriosam nobis at, quaerat voluptates.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus repudiandae inventore deleniti veniam ea vero non veritatis, 
            dolores ducimus eaque fugiat, rem animi ipsum quos laboriosam nobis at, quaerat voluptates.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus repudiandae inventore deleniti veniam ea vero non veritatis, 
            dolores ducimus eaque fugiat, rem animi ipsum quos laboriosam nobis at, quaerat voluptates.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus repudiandae inventore deleniti veniam ea vero non veritatis, 
            dolores ducimus eaque fugiat, rem animi ipsum quos laboriosam nobis at, quaerat voluptates.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>
</html>