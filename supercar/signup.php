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
                        <label for="phone">Téléphone</label>
                        <input type="text" class="form-control" id="phone" placeholder="Téléphone">
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
                <button type="submit" class="btn col-12 signup-btn mt-2">SIGNUP</button>
                <button type="reset" class="btn col-12 btn-reset mt-2">reset</button>
            </form>
            <div class="text-center mt-3">
                <small>Avez-vous déjà un compte ? <a href="/super-car/supercar/signin" class="signin-link">signin</a></small>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="../js/signup.js" type="module" defer></script>
</body>
</html>
