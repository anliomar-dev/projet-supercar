<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"
    >
    <!--lien plugin indicateurs telephonique-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.14/build/css/intlTelInput.css">
    <!--script plugin indicateurs telephonique-->
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.14/build/js/intlTelInput.min.js"></script>

    <link href="../stylesheets/signup.css" rel="stylesheet">
</head>
<body>
    <?php
        include_once("../components/navbar.php")
    ?>
    <div class="form_container d-flex justify-content-center pt-3">
        <div class="signup-form">
            <h2 class="text-center font-weight-bold">INSCRIPTION</h2>
            <form style="width: 100%;">
                <div class="row mt-3 pt-2">
                    <div class="form-group col-md-6">
                        <label for="firstName">Prenom</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Prenom">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastName">Nom</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Nom">
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="address">Adress</label>
                    <input type="text" class="form-control" id="address" placeholder="Adress">
                </div>
                <div class="row mt-3 pt-3">
                    <div class="form-group col-md-6">
                        <label for="phone">Téléphone</label><br>
                        <input type="text" class="form-control" id="phone" placeholder="Téléphone" value="+1">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                </div>
                <div class="row mt-3 pt-2">
                    <div class="form-group col-md-6 position-relative password-container">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control passwordField" name="password" id="password" placeholder="Mot de passe">
                        <span class="eye-icon">👁️</span>
                        <span style="display: none;" class="hide-password">🙈</span>
                    </div>
                    <div class="form-group col-md-6 position-relative password-container confirm-pass-container">
                        <label for="confirmPassword">Mot de passe</label>
                        <input type="password" class="form-control passwordField" name="confirmPassword" id="confirmPassword" placeholder="Mot de passe">
                        <span class="eye-icon">👁️</span>
                        <span style="display: none;" class="hide-password">🙈</span>
                    </div>
                </div>
                <button type="button" class="btn col-12 signup-btn mt-2" data-bs-toggle="modal" data-bs-target="#reviewModal">SIGNUP</button>
                <button type="reset" class="btn col-12 btn-reset mt-2">reset</button>
            </form>
            <div class="text-center mt-3">
                <small>Avez-vous déjà un compte ? <a href="/super-car/supercar/signin" class="signin-link">signin</a></small>
            </div>
        </div>
    </div>

    <!-- First Modal: Review Data -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Vérifiez vos informations</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Veuillez vérifier les informations suivantes avant de confirmer :</p>
                    <ul>
                        <li><strong>Nom :</strong> <span id="userName"></span></li>
                        <li><strong>Email :</strong> <span id="userEmail"></span></li>
                        <li><strong>Téléphone :</strong> <span id="userPhone"></span></li>
                        <!-- Ajoutez d'autres éléments de données ici -->
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Modifier</button>
                    <button type="button" class="btn btn-primary" id="confirmReviewButton">Confirmer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Modal: Consent and Conditions -->
    <div class="modal fade" id="consentModal" tabindex="-1" aria-labelledby="consentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="consentModalLabel">Consentement au traitement des données</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        En soumettant ce formulaire, vous consentez expressément à la collecte, au stockage, et au traitement de vos données personnelles par [Nom de l'Entreprise ou du Service]. 
                        Vous reconnaissez avoir pris connaissance des informations relatives à la collecte, au stockage, et au traitement de vos données personnelles, telles que détaillées dans notre 
                        <a href="#" target="_blank">Page des Mentions Légales</a>.
                    </p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="consentCheckbox">
                        <label class="form-check-label" for="consentCheckbox">
                            J'ai lu et compris les conditions ci-dessus.
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="finalConfirmButton" disabled>Confirmer et Soumettre</button>
                </div>
            </div>
        </div>
    </div>
    <!--- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="../js/signup.js" type="module" defer></script>
</body>
</html>
