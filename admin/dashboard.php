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
            <!-- header -->
            <?php
                include_once('components/navbar.php');
            ?>

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
