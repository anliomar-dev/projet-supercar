<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/super-car/admin/styles/dashboard.css" rel="stylesheet">
    <link href="/super-car/admin/components/sidebar.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
    <div class="row position-relative">
        <!-- Sidebar -->
        <?php
            include_once('../components/sidebar.php');
        ?>
        <!-- Main Content -->
        <div class="position-absolute end-0 dashboard" style="z-index: 10;">
            <div class="dashboard-header mt-2 h-auto py-3 px-5 d-flex justify-content-between">
                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='currentColor' class='size-5'>
                    <path fill-rule='evenodd' d='M2 4.75A.75.75 0 0 1 2.75 4h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 4.75Zm0 10.5a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5a.75.75 0 0 1-.75-.75ZM2 10a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 10Z' clip-rule='evenodd' />
                </svg>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4>Bienvenue, John!</h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <strong>John Doe</strong><br>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Finance Section -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="finance-card">
                        <h5>Total Payable</h5>
                        <h2>$10,000</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="finance-card">
                        <h5>Total Paid</h5>
                        <h2>$5,000</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="finance-card">
                        <h5>Others</h5>
                        <h2>$300</h2>
                    </div>
                </div>
            </div>

            <!-- Enrolled Courses -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="course-card">
                        <h5>Object Oriented Programming</h5>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="course-card">
                        <h5>Fundamentals of Database Systems</h5>
                        <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>

            <!-- Instructor Section & Notice -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <h5>Course Instructors</h5>
                    <div class="d-flex">
                        <img src="https://via.placeholder.com/50" class="avatar me-2" alt="Instructor 1">
                        <img src="https://via.placeholder.com/50" class="avatar me-2" alt="Instructor 2">
                        <img src="https://via.placeholder.com/50" class="avatar" alt="Instructor 3">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="notice">
                        <h5>Daily Notice</h5>
                        <p><strong>Prelim payment due:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p><strong>Exam schedule:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
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
