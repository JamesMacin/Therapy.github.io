<?php
session_start();

// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$database = "test_db";

// Connect to MySQL database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Query users table to check if email and password match
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Authentication successful
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
    echo "Login successful";
} else {
    // Authentication failed
    echo "Invalid email or password";
}

// Close database connection
$conn->close();
?>
