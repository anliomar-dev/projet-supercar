<?php
    echo"
      <div class='sidebar start-0 overflow-x-hidden fixed-top px-3' style='z-index: 1000;'>
        <div class='navbar-brand' href='/super-car/admin/admin/dashboard'>
          <img src='../medias/images/logos/supercar_logo_blanc.webp' alt='SuperCar logo' style='height: 50px;'>
        </div>
        
        <a href='#' class='mb-3 d-flex primary-custom-btn py-b mt-3 home-btn'>
          <svg class=' pb-0' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
            <path fill-rule='evenodd' d='M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z' clip-rule='evenodd' />
          </svg>
          <p class='ms-2 pb-0'>Dashboard</p>
        </a>
        <div class='btn-group my-3'>
          <button class='btn btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false'>
            Permissions
          </button>
          <ul class='dropdown-menu px-2'>
            <li>
              <a class='dropdown-item text-dark d-flex align-items-center py-0' href='#'>
              <svg class='' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
                  <path d='M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM6 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM1.49 15.326a.78.78 0 0 1-.358-.442 3 3 0 0 1 4.308-3.516 6.484 6.484 0 0 0-1.905 3.959c-.023.222-.014.442.025.654a4.97 4.97 0 0 1-2.07-.655ZM16.44 15.98a4.97 4.97 0 0 0 2.07-.654.78.78 0 0 0 .357-.442 3 3 0 0 0-4.308-3.517 6.484 6.484 0 0 1 1.907 3.96 2.32 2.32 0 0 1-.026.654ZM18 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM5.304 16.19a.844.844 0 0 1-.277-.71 5 5 0 0 1 9.947 0 .843.843 0 0 1-.277.71A6.975 6.975 0 0 1 10 18a6.974 6.974 0 0 1-4.696-1.81Z' />
              </svg>
              <p class='mt-4 ms-2'>Groupes</p>
              </a>
            </li>
            <li>
              <a class='dropdown-item text-dark d-flex align-items-center py-0' href='#'>
              <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
                <path fill-rule='evenodd' d='M9.661 2.237a.531.531 0 0 1 .678 0 11.947 11.947 0 0 0 7.078 2.749.5.5 0 0 1 .479.425c.069.52.104 1.05.104 1.59 0 5.162-3.26 9.563-7.834 11.256a.48.48 0 0 1-.332 0C5.26 16.564 2 12.163 2 7c0-.538.035-1.069.104-1.589a.5.5 0 0 1 .48-.425 11.947 11.947 0 0 0 7.077-2.75Zm4.196 5.954a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z' clip-rule='evenodd' />
              </svg>
              <p class='mt-4 ms-2'>Permissions</p>
              </a>
            </li>
            <li>
              <a class='dropdown-item text-dark d-flex align-items-center py-0' href='#'>
              <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
                <path d='M7 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM14.5 9a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5ZM1.615 16.428a1.224 1.224 0 0 1-.569-1.175 6.002 6.002 0 0 1 11.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 0 1 7 18a9.953 9.953 0 0 1-5.385-1.572ZM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 0 0-1.588-3.755 4.502 4.502 0 0 1 5.874 2.636.818.818 0 0 1-.36.98A7.465 7.465 0 0 1 14.5 16Z' />
              </svg>
              <p class='mt-4 ms-2'>Utilisateurs</p>
              </a>
            </li>
          </ul>
        </div>
        <div class='btn-group my-3'>
          <button class='btn btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown' data-bs-auto-close='true' aria-expanded='false'>
            Voitures
          </button>
          <ul class='dropdown-menu px-2'>
            <li>
              <a class='dropdown-item text-dark d-flex align-items-center py-0' href='#'>
                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
                  <path fill-rule='evenodd' d='M4.5 2A2.5 2.5 0 0 0 2 4.5v3.879a2.5 2.5 0 0 0 .732 1.767l7.5 7.5a2.5 2.5 0 0 0 3.536 0l3.878-3.878a2.5 2.5 0 0 0 0-3.536l-7.5-7.5A2.5 2.5 0 0 0 8.38 2H4.5ZM5 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z' clip-rule='evenodd' />
                </svg>
                <p class='mt-3 ms-2'>Marques</p>
              </a>
            </li>
            <li>
              <a class='dropdown-item text-dark d-flex align-items-center py-0' href='#'>
                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'>
                  <path d='M135.2 117.4L109.1 192l293.8 0-26.1-74.6C372.3 104.6 360.2 96 346.6 96L165.4 96c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32l181.2 0c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2l0 144 0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L96 400l0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L0 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z'/>
                </svg>
                <p class='mt-4 ms-2'>Modeles</p>
              </a>
            </li>
            <li>
              <a class='dropdown-item text-dark d-flex align-items-center py-0' href='#'>
              <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
                <path fill-rule='evenodd' d='M1 5.25A2.25 2.25 0 0 1 3.25 3h13.5A2.25 2.25 0 0 1 19 5.25v9.5A2.25 2.25 0 0 1 16.75 17H3.25A2.25 2.25 0 0 1 1 14.75v-9.5Zm1.5 5.81v3.69c0 .414.336.75.75.75h13.5a.75.75 0 0 0 .75-.75v-2.69l-2.22-2.219a.75.75 0 0 0-1.06 0l-1.91 1.909.47.47a.75.75 0 1 1-1.06 1.06L6.53 8.091a.75.75 0 0 0-1.06 0l-2.97 2.97ZM12 7a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z' clip-rule='evenodd' />
              </svg>
              <p class='mt-3 ms-2'>images</p>
              </a>
            </li>
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