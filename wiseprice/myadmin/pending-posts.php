<?php
include 'config.php';
include 'navbar.php';



// Fetch pending posts
$sql = "SELECT c.CarID, c.ManufacturerID, m.Name as ManufacturerName, c.Model, c.Year, c.BasePrice, c.CarPicture, c.status 
        FROM cars c
        JOIN manufacturers m ON c.ManufacturerID = m.ManufacturerID
        WHERE c.status = 'pending'";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carID = $_POST['car_id'];
    $action = $_POST['action'];

    if ($action == 'approve') {
        $update_sql = "UPDATE cars SET status = 'approved' WHERE CarID = ?";
    } else {
        $update_sql = "UPDATE cars SET status = 'denied' WHERE CarID = ?";
    }

    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $carID);

    if ($stmt->execute()) {
        echo "<script>alert('The post has been $action successfully.');</script>";
        header("refresh:3;url=pending-posts.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Posts</title>
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
        /* .sidebar a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575d63;
        } */
    </style>
</head>
<body>
    <div class="content">
    <div class="header d-flex justify-content-between align-items-center">
            <h2>Admin Panel</h2>
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
                <h3>Pending Posts</h3>
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
                                <th>Action</th>
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
                                    <td><img src="<?php echo $row['CarPicture']; ?>" alt="Car Picture"></td>
                                    <td>
                                        <form method="post" class="d-inline">
                                            <input type="hidden" name="car_id" value="<?php echo $row['CarID']; ?>">
                                            <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
                                            <button type="submit" name="action" value="deny" class="btn btn-danger">Deny</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
            </div> 
        <?php else: ?>
            <p>No pending posts.</p>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
