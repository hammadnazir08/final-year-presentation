<?php
include 'config.php';
include 'navbar.php';

$message = '';

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
} else {
    $user_id = $_SESSION['UserID'];

    // Fetch user data
    $sql = "SELECT * FROM users WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        $message = "User not found.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
        .profile-container {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-header h2 {
            margin: 0;
        }
        .profile-header p {
            margin: 0;
            color: #6c757d;
        }
        .profile-info label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .alert {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="header d-flex justify-content-between align-items-center">
            <h2>User Profile</h2>
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
        <div class="profile-container mt-4">
            <div class="profile-header">
                <h2>Profile</h2>
                <p>View and manage your profile</p>
            </div>
            <?php if ($message): ?>
                <div class="alert alert-info"><?php echo $message; ?></div>
            <?php endif; ?>
            <div class="profile-info">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <p><?php echo htmlspecialchars($user['Email']); ?></p>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <p>********</p> <!-- Typically, you wouldn't display the actual password -->
                </div>
                <a href="settings.php" class="btn btn-primary mt-3">Update Profile</a>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>

    <!-- Javascript -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
