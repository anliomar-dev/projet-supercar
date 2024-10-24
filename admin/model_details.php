<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercedes EQB 300</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .car-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .thumbnail {
            cursor: pointer;
            transition: transform 0.2s;
        }
        .thumbnail:hover {
            transform: scale(1.05);
        }
        .btn-custom {
            background-color: #1d3557;
            color: white;
        }
        .btn-custom:hover {
            background-color: #457b9d;
        }
        .details-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .color-circle {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            margin-right: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="row">
        <!-- Image principale -->
        <div class="col-md-6">
            <img src="https://via.placeholder.com/600x400" alt="Mercedes EQB 300" class="car-image img-fluid mb-3">
            <div class="d-flex justify-content-center">
                <img src="https://via.placeholder.com/100x100" class="thumbnail mx-1" alt="Miniature 1">
                <img src="https://via.placeholder.com/100x100" class="thumbnail mx-1" alt="Miniature 2">
                <img src="https://via.placeholder.com/100x100" class="thumbnail mx-1" alt="Miniature 3">
                <img src="https://via.placeholder.com/100x100" class="thumbnail mx-1" alt="Miniature 4">
            </div>
        </div>

        <!-- Informations sur la voiture -->
        <div class="col-md-6">
            <h1 class="mb-3">Mercedes Benz</h1>
            <h4 class="text-muted">Modèle : <span class="fw-bold">EQB 300</span></h4>

            <div class="my-3">
                <button class="btn btn-custom">Images Intérieur</button>
            </div>

            <div class="d-flex align-items-center my-3">
                <div class="color-circle" style="background-color: black;"></div>
                <div class="color-circle" style="background-color: green;"></div>
                <div class="color-circle" style="background-color: blue;"></div>
            </div>

            <div class="details-card mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Modèle :</strong> EQB 300</p>
                        <p><strong>Année :</strong> 2021</p>
                        <p><strong>Prix :</strong> 200000 e</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Transmission :</strong> Automatique</p>
                        <p><strong>Type :</strong> SUV électrique</p>
                        <p><strong>carburant :</strong> essence</p>
                    </div>
                </div>
                <hr>
                <h5>Description</h5>
                <p class="overflow-y-scroll">
                    Le Mercedes EQB 300 est un SUV compact entièrement électrique offrant une autonomie impressionnante,
                    un intérieur raffiné, et des technologies de pointe. Parfait pour les amateurs d’innovation et de
                    performances écologiques.
                </p>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
