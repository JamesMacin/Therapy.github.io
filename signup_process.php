<?php
// Validate form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Validate password
    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare data to be saved
    $data = "$email:$hashed_password\n";

    // Save data to file (append mode)
    $file_path = "users.txt";
    if (file_put_contents($file_path, $data, FILE_APPEND | LOCK_EX) === false) {
        die("Unable to save user data.");
    }

    // Redirect to login page
    header("Location: login.html");
    exit();
}
?>
