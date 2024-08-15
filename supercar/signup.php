<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstName">Prenom</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Prenom">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastName">Nom</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Nom">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Adress</label>
                    <input type="text" class="form-control" id="address" placeholder="Adress">
                </div>
                <div class="form-row pt-2">
                    <div class="form-group col-md-6">
                        <label for="phone">Téléphone</label>
                        <input type="text" class="form-control" id="phone" placeholder="Téléphone">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 position-relative password-container">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" placeholder="Mot de passe">
                        <span class="eye-icon" onclick="togglePassword('password')">👁️</span>
                    </div>
                    <div class="form-group col-md-6 position-relative password-container">
                        <label for="confirmPassword">Mot de passe</label>
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Mot de passe">
                        <span class="eye-icon" onclick="togglePassword('confirmPassword')">👁️</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-block btn-signup">SIGNUP</button>
                <button type="reset" class="btn btn-block btn-reset">reset</button>
            </form>
            <div class="text-center mt-3">
                <small>Avez-vous déjà un compte ? <a href="/super-car/supercar/signin" class="signin-link">signin</a></small>
            </div>
        </div>
    </div>
    <!-- JavaScript de Bootstrap et optionnellement jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        function togglePassword(id) {
            var input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
</body>

</html>
