<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #search-overlay {
            display: none; /* Masqué par défaut */
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .search-input {
            width: 300px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }
        .search-input.show {
            opacity: 1;
            visibility: visible;
        }
    </style>
    <title>Barre de Recherche</title>
</head>
<body>

    <button class="btn btn-primary" id="search-button">Rechercher</button>

    <div id="search-overlay" class="d-flex">
        <input type="text" class="form-control search-input" id="search-input" placeholder="Rechercher..." />
        <div id="search-results" class="mt-2"></div>
    </div>

    <script>
        const searchButton = document.getElementById('search-button');
        const searchOverlay = document.getElementById('search-overlay');
        const searchInput = document.getElementById('search-input');
        const searchResults = document.getElementById('search-results');

        searchButton.addEventListener('click', () => {
            searchOverlay.style.display = 'flex';
            setTimeout(() => {
                searchInput.classList.add('show');
                searchInput.focus();
            }, 10);
        });

        searchInput.addEventListener('input', () => {
            const query = searchInput.value;
            if (query) {
                searchResults.innerHTML = `Résultats pour "${query}"`; // Remplacez par vos résultats réels
            } else {
                searchResults.innerHTML = '';
            }
        });

        // Ferme la barre de recherche en cliquant en dehors
        searchOverlay.addEventListener('click', (event) => {
            if (event.target === searchOverlay) {
                searchOverlay.style.display = 'none';
                searchInput.classList.remove('show');
                searchInput.value = '';
                searchResults.innerHTML = '';
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
