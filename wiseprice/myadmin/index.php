<?php
include 'config.php';
include 'authenticate.php'; // Ensure this file checks for session and redirects to login if not logged in
include 'navbar.php';
include 'footer.php';

// Fetch data for the cards
$totalCarsQuery = "SELECT COUNT(*) AS totalCars FROM cars";
$totalCarsResult = $conn->query($totalCarsQuery);
$totalCars = $totalCarsResult->fetch_assoc()['totalCars'];

$totalManufacturersQuery = "SELECT COUNT(*) AS totalManufacturers FROM manufacturers";
$totalManufacturersResult = $conn->query($totalManufacturersQuery);
$totalManufacturers = $totalManufacturersResult->fetch_assoc()['totalManufacturers'];

$totalUsersQuery = "SELECT COUNT(*) AS totalUsers FROM users";
$totalUsersResult = $conn->query($totalUsersQuery);
$totalUsers = $totalUsersResult->fetch_assoc()['totalUsers'];

// Additional data queries for more cards
$totalSalesQuery = "SELECT COUNT(*) AS totalSales FROM inventory";
$totalSalesResult = $conn->query($totalSalesQuery);
$totalSales = $totalSalesResult->fetch_assoc()['totalSales'];

$totalRevenueQuery = "SELECT SUM(Quantity) AS totalRevenue FROM inventory";
$totalRevenueResult = $conn->query($totalRevenueQuery);
$totalRevenue = $totalRevenueResult->fetch_assoc()['totalRevenue'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            margin: 0;
        }
        .content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            position: relative;
        }
        .profile-dropdown {
            position: absolute;
            top: 15px;
            right: 20px;
            display: flex;
            align-items: center;
        }
        .profile-dropdown .bi {
            font-size: 1.5rem;
            margin-right: 5px;
        }
        .profile-dropdown .dropdown-toggle::after {
            display: none;
        }
        .btn-secondary .dropdown-toggle::after {
            margin-left: 0.5rem;
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
        <div class="header d-flex justify-content-between align-items-center">
            <h2>Admin Panel</h2>
            <div class="profile-dropdown dropdown">
                <i class="bi bi-person-circle"></i>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="profileMenu" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo htmlspecialchars($_SESSION['Username']); ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileMenu">
                    <li><a class="dropdown-item" href="profile.php">View Profile</a></li>
                    <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-primary text-white mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Cars</h5>
                            <p class="card-text"><?php echo $totalCars; ?> cars in the system.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Manufacturers</h5>
                            <p class="card-text"><?php echo $totalManufacturers; ?> manufacturers in the system.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning text-white mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text"><?php echo $totalUsers; ?> users in the system.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-danger text-white mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Sales</h5>
                            <p class="card-text"><?php echo $totalSales; ?> sales in the system.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info text-white mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Revenue</h5>
                            <p class="card-text">$<?php echo number_format($totalRevenue, 2); ?> in revenue.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- Javascript -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/jquery-migrate-3.4.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
