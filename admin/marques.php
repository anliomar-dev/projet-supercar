<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>marques</title>
    <!--cdn font awsome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/super-car/admin/styles/dashboard.css" rel="stylesheet">
    <script src="js/dashboard.js" type="module" defer></script>
    <script src="js/sidebar_navbar.js" type="module" defer></script>
    <link href="/super-car/admin/components/sidebar.css" rel="stylesheet">
    <style>
        .close-sidebar{
            display: none;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row position-relative">
        <!-- Sidebar -->
        <?php
            include_once('components/sidebar.php');
        ?>
        <!-- Main Content -->
        <div class="position-absolute end-0 dashboard" style="z-index: 10;">
            <?php
                include_once('components/navbar.php');
            ?>
            <!--display all modele-->
            <section class="container my-4 mx-auto all-models-section">
                <!-- section header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Modèles</h4>
                    <select id="Marque" name="marque" class="form-select" aria-label="Default select example" style="width: 300px;">
                        <option selected>Toutes les modèles</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <div class="">
                        <button class="btn btn-success ms-2 show-section" data-section="new-user-section">+ Ajouter</button>
                        <button class="btn btn-secondary ms-2">Supprimer</button>
                    </div>
                </div>
                <!-- models -->
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="d-flex justify-content-center pt-3">
                                <input 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    data-bs-title="tout sélectionner"
                                    class="check-all form-check-input" type="checkbox"
                                >
                            </th>
                            <th class="">
                                <span class="th-col" data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    data-bs-title="cliquez pour trier par la marque">
                                    ID
                                </span>
                                <button class="btn d-none sortBtn" data-order="desc" data-sort-by="first_name">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h7.508a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .75.75v6.59l1.95-2.1a.75.75 0 1 1 1.1 1.02l-3.25 3.5a.75.75 0 0 1-1.1 0l-3.25-3.5a.75.75 0 1 1 1.1-1.02l1.95 2.1V7.75A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75h4.562a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button class="btn d-none sortBtn" data-order="asc" data-sort-by="first_name">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h6.365a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .55.24l3.25 3.5a.75.75 0 1 1-1.1 1.02l-1.95-2.1v6.59a.75.75 0 0 1-1.5 0V9.66l-1.95 2.1a.75.75 0 1 1-1.1-1.02l3.25-3.5A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75H7A.75.75 0 0 1 7 12H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </th>
                            <th class="">
                                <span class="th-col" data-bs-toggle="tooltip" 
                                    data-bs-placement="top" 
                                    data-bs-title="cliquez pour trier par le nom du modèle">
                                    Nom Marque
                                </span>
                                <button class="btn d-none sortBtn" data-order="desc" data-sort-by="last_name">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h7.508a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .75.75v6.59l1.95-2.1a.75.75 0 1 1 1.1 1.02l-3.25 3.5a.75.75 0 0 1-1.1 0l-3.25-3.5a.75.75 0 1 1 1.1-1.02l1.95 2.1V7.75A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75h4.562a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button class="btn d-none sortBtn" data-order="asc" data-sort-by="last_name">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h6.365a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .55.24l3.25 3.5a.75.75 0 1 1-1.1 1.02l-1.95-2.1v6.59a.75.75 0 0 1-1.5 0V9.66l-1.95 2.1a.75.75 0 1 1-1.1-1.02l3.25-3.5A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75H7A.75.75 0 0 1 7 12H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </th>
                            <th class="pb-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="users-container">
                        <template id="template-user">
                            <tr class="table-row">
                                <td class="d-flex justify-content-center pt-3">
                                    <input class="checkbox-user form-check-input" type="checkbox" value="">
                                </td>
                                <td class="first-name hover show-user-infos" data-section="update-user-section"></td>
                                <td class="last-name hover show-user-infos" data-section="update-user-section"></td>
                                <td class="email hover show-user-infos" data-section="update-user-section"></td>
                                <td class="buttons">
                                    <button class="btn btn-sm btn-outline-primary edit-button show-section" data-id="" data-section="update-user-section">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                            <path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                            <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                        </svg>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger delete-button" data-id="">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                            <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <!-- pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        
                    </ul>
                </nav>
            </section>
            <!--section update or create modele-->
            <section class="container my-3 update-and-create-section">
                <form class="row">
                    <div class="col-md-8 border rounded-3 shadow p-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="infos-tab" data-bs-toggle="tab" data-bs-target="#infosMarque" type="button" role="tab" aria-controls="infosModele" aria-selected="true">Marque</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="infosMarque" role="tabpanel" aria-labelledby="infos-tab">
                                <div class="mt-4 update-user-form border rounded-3 p-4">
                                    <div class="mb-3">
                                        <label for="NomModele" class="form-label">Nom Marque</label>
                                        <input type="text" name="NomMarque" class="form-control" id="NomMarque" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="logo" class="form-label">Logo</label>
                                        <input type="file" name="Prix" class="form-control" id="logo" value="">
                                    </div>                                 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-1 d-flex flex-column align-items-start">
                        <button type="submit" class="btn btn-enregistrer w-100 mb-2">Enregistrer</button>
                        <button type="button" class="btn btn-supprimer w-100 mb-2">Supprimer</button>
                        <button type="button" class="btn btn-historique w-100">Historique</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
