<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!--cdn font awsome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/super-car/admin/styles/dashboard.css" rel="stylesheet">
    <script src="js/dashboard.js" type="module" defer></script>
    <script src="js/sidebar_navbar.js" type="module" defer></script>
    <link href="/super-car/admin/components/sidebar.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['essais', 'essais par marque'],
                ['Ferrari', 8],
                ['Jeep', 2],
                ['Mercedes-Benz', 12],
                ['Porsche', 4],
            ]);

            var options = {
                title: 'Demandes d\'esssai par marques',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
    <style>
        #myChart {
            max-width: 600px;
            height: 200px;
            margin: 0 auto; /* Centrer le canvas */
        }
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
            <div class="dashboard-header mt-2 h-auto py-2 px-3 d-flex justify-content-flex-between">
                <div class="d-flex flex-column justify-content-center align-items-start w-25 px-2">
                    <span style="font-size: 14px;">15-09-2024</span>
                    <h5>Bienvenue, John!</h5>
                </div>
                <div class="d-flex justify-content-end align-items-center w-75 pe-3">
                    <div class="d-flex align-items-center">
                        <svg class="toggle-sidebar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd" d="M2 4.75A.75.75 0 0 1 2.75 4h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 4.75ZM2 10a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 10Zm0 5.25a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                        </svg>
                        <svg class="ms-3 close-sidebar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd" d="M2 4.75A.75.75 0 0 1 2.75 4h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 4.75Zm7 10.5a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5a.75.75 0 0 1-.75-.75ZM2 10a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 10Z" clip-rule="evenodd" />
                        </svg>
                        <svg class="ms-3 loop" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
                        </svg>
                        <svg class="mx-3 settings-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path d="M13.024 9.25c.47 0 .827-.433.637-.863a4 4 0 0 0-4.094-2.364c-.468.05-.665.576-.43.984l1.08 1.868a.75.75 0 0 0 .649.375h2.158ZM7.84 7.758c-.236-.408-.79-.5-1.068-.12A3.982 3.982 0 0 0 6 10c0 .884.287 1.7.772 2.363.278.38.832.287 1.068-.12l1.078-1.868a.75.75 0 0 0 0-.75L7.839 7.758ZM9.138 12.993c-.235.408-.039.934.43.984a4 4 0 0 0 4.094-2.364c.19-.43-.168-.863-.638-.863h-2.158a.75.75 0 0 0-.65.375l-1.078 1.868Z" />
                            <path fill-rule="evenodd" d="m14.13 4.347.644-1.117a.75.75 0 0 0-1.299-.75l-.644 1.116a6.954 6.954 0 0 0-2.081-.556V1.75a.75.75 0 0 0-1.5 0v1.29a6.954 6.954 0 0 0-2.081.556L6.525 2.48a.75.75 0 1 0-1.3.75l.645 1.117A7.04 7.04 0 0 0 4.347 5.87L3.23 5.225a.75.75 0 1 0-.75 1.3l1.116.644A6.954 6.954 0 0 0 3.04 9.25H1.75a.75.75 0 0 0 0 1.5h1.29c.078.733.27 1.433.556 2.081l-1.116.645a.75.75 0 1 0 .75 1.298l1.117-.644a7.04 7.04 0 0 0 1.523 1.523l-.645 1.117a.75.75 0 1 0 1.3.75l.644-1.116a6.954 6.954 0 0 0 2.081.556v1.29a.75.75 0 0 0 1.5 0v-1.29a6.954 6.954 0 0 0 2.081-.556l.645 1.116a.75.75 0 0 0 1.299-.75l-.645-1.117a7.042 7.042 0 0 0 1.523-1.523l1.117.644a.75.75 0 0 0 .75-1.298l-1.116-.645a6.954 6.954 0 0 0 .556-2.081h1.29a.75.75 0 0 0 0-1.5h-1.29a6.954 6.954 0 0 0-.556-2.081l1.116-.644a.75.75 0 0 0-.75-1.3l-1.117.645a7.04 7.04 0 0 0-1.524-1.523ZM10 4.5a5.475 5.475 0 0 0-2.781.754A5.527 5.527 0 0 0 5.22 7.277 5.475 5.475 0 0 0 4.5 10a5.475 5.475 0 0 0 .752 2.777 5.527 5.527 0 0 0 2.028 2.004c.802.458 1.73.719 2.72.719a5.474 5.474 0 0 0 2.78-.753 5.527 5.527 0 0 0 2.001-2.027c.458-.802.719-1.73.719-2.72a5.475 5.475 0 0 0-.753-2.78 5.528 5.528 0 0 0-2.028-2.002A5.475 5.475 0 0 0 10 4.5Z" clip-rule="evenodd" />
                        </svg>
                        <svg class="user-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Finance Section -->
            <div class="row mt-5 d-flex justify-content-center stats-card-container">
                <div class=" d-flex flex-column border rounded-4 px-3 py-2 shadow mx-3 mb-5 stat-card">
                    <div class="d-flex justify-content-between mb-0">
                        <div class="icon" style="height:65px; width: 65px;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                            <path d="M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM6 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM1.49 15.326a.78.78 0 0 1-.358-.442 3 3 0 0 1 4.308-3.516 6.484 6.484 0 0 0-1.905 3.959c-.023.222-.014.442.025.654a4.97 4.97 0 0 1-2.07-.655ZM16.44 15.98a4.97 4.97 0 0 0 2.07-.654.78.78 0 0 0 .357-.442 3 3 0 0 0-4.308-3.517 6.484 6.484 0 0 1 1.907 3.96 2.32 2.32 0 0 1-.026.654ZM18 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM5.304 16.19a.844.844 0 0 1-.277-.71 5 5 0 0 1 9.947 0 .843.843 0 0 1-.277.71A6.975 6.975 0 0 1 10 18a6.974 6.974 0 0 1-4.696-1.81Z" />
                            </svg>            
                        </div>
                        <div class="numbers d-flex flex-column align-items-end pb-2">
                            <p class="mb-0" style="font-size: 18px;">Utilisateurs</p>
                            <h4 class="mt-0 ms-1">100</h4>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <hr class="py-0 my-0 d-flex justify-content-center" >
                    </div>
                    <div class="mt-3">
                        <p><strong class="text-success">+ 100</strong> utilisateurs inscrits</p>
                    </div>
                </div>
                <div class=" d-flex flex-column border rounded-4 px-3 py-2 shadow mx-3 mb-5 stat-card">
                    <div class="d-flex justify-content-between mb-0">
                        <div class="icon" style="height:65px; width: 65px;">
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'>
                                <path d='M135.2 117.4L109.1 192l293.8 0-26.1-74.6C372.3 104.6 360.2 96 346.6 96L165.4 96c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32l181.2 0c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2l0 144 0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L96 400l0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L0 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z'/>
                            </svg>          
                        </div>
                        <div class="numbers d-flex flex-column align-items-end pb-2">
                            <p class="mb-0" style="font-size: 18px;">Modèles voitures</p>
                            <h4 class="mt-0 ms-1">100</h4>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <hr class="py-0 my-0 d-flex justify-content-center" >
                    </div>
                    <div class="mt-3">
                        <p><strong class="text-success">+24</strong> Modèles</p>
                    </div>
                </div>
                <div class=" d-flex flex-column border rounded-4 px-3 py-2 shadow mx-3 mb-5 stat-card">
                    <div class="d-flex justify-content-between mb-0">
                        <div class="icon" style="height:65px; width: 65px;">
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'>
                                <path d='M135.2 117.4L109.1 192l293.8 0-26.1-74.6C372.3 104.6 360.2 96 346.6 96L165.4 96c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32l181.2 0c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2l0 144 0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L96 400l0 48c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-48L0 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z'/>
                            </svg>          
                        </div>
                        <div class="numbers d-flex flex-column align-items-end pb-2">
                            <p class="mb-0" style="font-size: 18px;">Modèles voitures</p>
                            <h4 class="mt-0 ms-1">100</h4>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <hr class="py-0 my-0 d-flex justify-content-center" >
                    </div>
                    <div class="mt-3">
                        <p><strong class="text-success">+24</strong> Modèles</p>
                    </div>
                </div>
                <div class=" d-flex flex-column border rounded-4 px-3 py-2 shadow mx-3 mb-5 stat-card">
                    <div class="d-flex justify-content-between mb-0">
                        <div class="icon" style="height:65px; width: 65px;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <div class="numbers d-flex flex-column align-items-end pb-2">
                            <p class="mb-0" style="font-size: 18px;">Visites</p>
                            <h4 class="mt-0 ms-1">100</h4>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <hr class="py-0 my-0 d-flex justify-content-center" >
                    </div>
                    <div class="mt-3">
                        <p><strong class="text-success">+55%</strong> que la semainde dernière</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div id="piechart_3d" class="bg-transparent rounded-3 ms-3" style="width: 550px; height: 300px;"></div>
                <canvas id="myChart" class=""></canvas>
            </div>
            <!-- Enrolled Courses -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="course-card">
                        <h5>Demandes d'essais</h5>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="course-card">
                        <h5>evennements</h5>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="course-card">
                        <h5>Demandes d'essais</h5>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="course-card">
                        <h5>evennements</h5>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="course-card">
                        <h5>Demandes d'essais</h5>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="course-card">
                        <h5>evennements</h5>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="course-card">
                        <h5>Demandes d'essais</h5>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="course-card">
                        <h5>evennements</h5>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
