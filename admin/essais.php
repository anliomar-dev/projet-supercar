<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>demandes d'essais</title>
    <!--cdn font awsome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/super-car/admin/styles/dashboard.css" rel="stylesheet">
    <link href="/super-car/admin/styles/users.css" rel="stylesheet">
    <link href="/super-car/admin/styles/common.css" rel="stylesheet">
    <script src="js/essais.js" type="module" defer></script>
    <script src="js/sidebar_navbar.js" type="module" defer></script>
    <link href="/super-car/admin/components/sidebar.css" rel="stylesheet">
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
            <!-- header-->
            <?php
                include_once('components/navbar.php');
            ?>

            <!--display all user section-->
            <section class="container my-4 mx-auto all-essais-section">
                <!-- section header -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Demande d'essais</h4>
                    <div>
                        <button class="btn btn-outline-success ms-2 show-section add-btn" data-section="new-essai-section"
                            data-bs-toggle="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="ajouter une nouvelle demande"
                        >
                            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
                                <path stroke-linecap='round' stroke-linejoin='round' d='M19.5 10.5V6.75A2.25 2.25 0 0017.25 4.5h-10.5A2.25 2.25 0 004.5 6.75v10.5A2.25 2.25 0 006.75 19.5h10.5a2.25 2.25 0 002.25-2.25V13.5m-6 0H9m3 3H9m6-6h-6m6 0H9' />
                            </svg>
                        </button>
                        <button class="btn btn-outline-danger ms-2 delete-all-btn"
                            data-bs-toggle="tooltip" 
                            data-bs-placement="top" 
                            data-bs-title="supprimer toutes les lignes selectionées"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- users -->
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
                                    data-bs-title="cliquez pour trier par la date">
                                    Date
                                </span>
                                <button class="btn d-none sortBtn" data-order="desc" data-sort-by="DateEssai">
                                    <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h7.508a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .75.75v6.59l1.95-2.1a.75.75 0 1 1 1.1 1.02l-3.25 3.5a.75.75 0 0 1-1.1 0l-3.25-3.5a.75.75 0 1 1 1.1-1.02l1.95 2.1V7.75A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75h4.562a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button class="btn d-none sortBtn" data-order="asc" data-sort-by="DateEssai">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M2 3.75A.75.75 0 0 1 2.75 3h11.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 7.5a.75.75 0 0 1 .75-.75h6.365a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 7.5ZM14 7a.75.75 0 0 1 .55.24l3.25 3.5a.75.75 0 1 1-1.1 1.02l-1.95-2.1v6.59a.75.75 0 0 1-1.5 0V9.66l-1.95 2.1a.75.75 0 1 1-1.1-1.02l3.25-3.5A.75.75 0 0 1 14 7ZM2 11.25a.75.75 0 0 1 .75-.75H7A.75.75 0 0 1 7 12H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </th>
                            <th class="">
                                <span class="">
                                    Heure
                                </span>
                            </th>
                            <th class="">
                                <span class="">
                                    status
                                </span>
                            </th>
                            <th class="pb-3"><span>Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="essais-container">
                        <template id="template-essai">
                            <tr class="table-row">
                                <td class="d-flex justify-content-center pt-3">
                                    <input class="checkbox-essai form-check-input" type="checkbox" value="">
                                </td>
                                <td class="date hover" data-section="update-essai-section"></td>
                                <td class="heure hover" data-section="update-essai-section"></td>
                                <td class="status hover" data-section="update-essai-section"></td>
                                <td class="buttons">
                                    <button class="btn btn-sm btn-outline-primary edit-button show-section" data-id="" data-section="update-essai-section">
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
            
            <!--update essai infos section -->
            <section class="container mt-3 update-essai-section d-none">
                <form class="row">
                    <div class="col-md-8 border rounded-3 shadow py-4 px-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="compte-tab" data-bs-toggle="tab" data-bs-target="#compte" type="button" role="tab" aria-controls="compte" aria-selected="true">infos générale</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="user-tab" data-bs-toggle="tab" data-bs-target="#user" type="button" role="tab" aria-controls="user" aria-selected="false">demandeur</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="compte" role="tabpanel" aria-labelledby="compte-tab">
                                <div class="mt-4 update-user-form">
                                    <div class="mb-3">
                                        <label for="DateEssai" class="form-label">Date</label>
                                        <input type="text" name="DateEssai" class="form-control" id="DateEssai" value="" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Heure" class="form-label">Heure</label>
                                        <input type="text" name="Heure" class="form-control" id="Heure" value="" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <input type="text" name="status" class="form-control" id="status" value="" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Marque" class="form-label">Marque</label>
                                        <select id="Marque" name="IdMarque" class="form-select" aria-label="Default select example">
                                            <?php
                                                include_once('../php/all_marques.php');
                                                option_brands()
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="user-tab">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Prenom</label>
                                    <input type="Prenom" name="Prenom" class="form-control" id="Prenom" value="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Nom" class="form-label">Nom</label>
                                    <input type="text" name="email" class="form-control" id="Nom" value="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Téléphone</label>
                                    <input type="phone" name="phone" class="form-control" id="phone" value="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-1 d-flex flex-column align-items-start">
                        <button type="submit" class="btn btn-enregistrer w-100 mb-2 save-change">Enregistrer</button>
                        <button type="button" class="btn btn-supprimer w-100 mb-2">Supprimer</button>
                        <button type="button" class="btn btn-historique w-100 mb-2">Historique</button>
                        <button type="button" class="btn btn-retour w-100 show-section" data-section="all-essais-section">
                            <i class="fa-solid fa-left-long"></i>
                            Retour
                        </button>
                    </div>
                </form>
            </section>

            <!--section create new essai-->
            <section class="container mt-3 mb-3 new-essai-section d-none">
                <form class="row">
                    <div class="col-md-8 border rounded-3 shadow py-4 px-4">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="inscription-tab" data-bs-toggle="tab" data-bs-target="#inscription" type="button" role="tab" aria-controls="inscription" aria-selected="true">Infos personnelles</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">Compte et Permissions</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- create new essai form -->
                            <div class="tab-pane fade show active border rounded-3 p-4" id="inscription" role="tabpanel" aria-labelledby="inscription-tab">
                                <div class="mt-4">
                                    <div class="mb-3">
                                        <label for="prenom-inscription" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="prenom-inscription" placeholder="Entrez votre prénom" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nom-inscription" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="nom-inscription" placeholder="Entrez votre nom" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="adresse-inscription" class="form-label">Adresse</label>
                                        <input type="text" class="form-control" id="adresse-inscription" placeholder="Entrez votre adresse" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telephone-inscription" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" id="telephone-inscription" placeholder="Entrez votre téléphone" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Détails supplémentaires pour l'inscription -->
                            <div class="tab-pane fade border rounded-3 p-4" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <div class="mb-3">
                                    <label for="email-inscription" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email-inscription" placeholder="Entrez votre email" autocomplete="email" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-1 d-flex flex-column align-items-start">
                        <button type="submit" class="btn btn-enregistrer w-100 mb-2">Enregistrer</button>
                        <button type="button" class="btn btn-supprimer w-100 mb-2">Annuler</button>
                        <button type="button" class="btn btn-retour w-100 mb-2 show-section" 
                            data-section="all-essais-section">
                            <i class="fa-solid fa-left-long"></i>
                            Retour
                        </button>
                    </div>
                </form>
            </section>
            <!---->
        </div>
    </div>
</div>
<script>
    // Activer les tooltips sur tout le document
    document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    });
</script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>
</html>
