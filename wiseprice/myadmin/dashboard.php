<?php
include 'navbar.php';
include 'footer.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .content {
            margin-left: 250px;
            padding: 20px;
            min-height: calc(100vh - 70px);
            padding-bottom: 70px; /* Space for the footer */
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .card {
            border: none;
            border-radius: 10px;
        }
        .card .card-body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="header">
            <h2>Admin Dashboard</h2>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-primary text-white mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Cars</h5>
                            <p class="card-text">Number of cars in the system.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Manufacturers</h5>
                            <p class="card-text">Number of manufacturers in the system.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning text-white mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text">Number of users in the system.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
