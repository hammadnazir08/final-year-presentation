<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    // If the user is not logged in, redirect them to the login page and stop further script execution
    header("Location: login.php");
    exit(); // Make sure to exit after redirection
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'fyp');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function isLoggedIn() {
    return isset($_SESSION['UserID']); // Ensure consistent session variable usage
}

function redirectToLogin() {
    header("Location: login.php");
    exit(); // Make sure to exit after redirection
}
?>

