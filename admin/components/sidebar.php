<?php
    echo"
      <div class='sidebar start-0 overflow-x-hidden fixed-top px-3' style='z-index: 1000;'>
        <div class='navbar-brand' href='/super-car/admin/admin/dashboard'>
          <img src='../../medias/images/logos/supercar_logo_blanc.webp' alt='SuperCar logo' style='height: 50px;'>
        </div>
        
        <a href='#' class='mb-3 d-flex primary-custom-btn py-b mt-3 home-btn'>
          <svg class=' pb-0' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
            <path fill-rule='evenodd' d='M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z' clip-rule='evenodd' />
          </svg>
          <p class='ms-2 mt-1 pb-0'>Dashboard</p>
        </a>
        <div class='btn-group my-3'>
          <button class='btn btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false'>
            Permissions
          </button>
          <ul class='dropdown-menu'>
            <li><a class='dropdown-item text-dark' href='#'>Groupes</a></li>
            <li><a class='dropdown-item text-dark' href='#'>Permissions</a></li>
            <li><a class='dropdown-item text-dark' href='#'>Utilisateurs</a></li>
          </ul>
        </div>
        <div class='btn-group my-3'>
          <button class='btn btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false'>
            Voitures
          </button>
          <ul class='dropdown-menu'>
            <li><a class='dropdown-item text-dark' href='#'>Marques</a></li>
            <li><a class='dropdown-item text-dark' href='#'>Modeles</a></li>
            <li><a class='dropdown-item text-dark' href='#'>Images</a></li>
          </ul>
        </div>
        <a href='#'>Contacts</a>
        <a href='#'>Essais</a>
        <a href='#'>Evennements</a>
        <a href='#'>Horaires</a>
        <a href='#'>Newsletter</a>
        <a href='#'>Visites</a>
        <a href='#'>Calendrier</a>
        <div class='col-12'>
          <a href='#' class='btn position-fixed bottom-0 my-3 logout-btn btn-block py-1'>Se deconnecter</a>
        </div>
      </div>
    ";
?>