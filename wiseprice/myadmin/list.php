<?php
include 'config.php';
include 'navbar.php';

// Fetch approved cars
$sql = "SELECT c.CarID, c.ManufacturerID, m.Name as ManufacturerName, c.Model, c.Year, c.BasePrice, c.CarPicture
        FROM cars c
        JOIN manufacturers m ON c.ManufacturerID = m.ManufacturerID
        WHERE c.status = 'approved'";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Approved Cars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
            margin-left: 250px; /* Adjust if necessary */
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
        .table img {
            width: 100px;
            height: auto;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table .btn {
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="header d-flex justify-content-between align-items-center">
            <h2>All Approved Cars</h2>
            <div class="profile-dropdown dropdown">
                <i class="bi bi-person-circle"></i>
                <button class="btn btn-secondary dropdown-toggle" type="button" id="profileMenu" data-bs-toggle="dropdown" aria-expanded="false">
                    Profile
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileMenu">
                    <li><a class="dropdown-item" href="profile.php">View Profile</a></li>
                    <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-4">   
            <h3>All Approved Cars</h3>
            <?php if ($result->num_rows > 0): ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Car ID</th>
                            <th>Manufacturer</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Base Price</th>
                            <th>Picture</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['CarID']); ?></td>
                                <td><?php echo htmlspecialchars($row['ManufacturerName']); ?></td>
                                <td><?php echo htmlspecialchars($row['Model']); ?></td>
                                <td><?php echo htmlspecialchars($row['Year']); ?></td>
                                <td>$<?php echo number_format($row['BasePrice'], 2); ?></td>
                                <td><img src="<?php echo htmlspecialchars($row['CarPicture']); ?>" alt="Car Picture"></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
        </div> 
        <?php else: ?>
            <p>No  cars found.</p>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
