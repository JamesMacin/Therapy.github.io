<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $question1 = $_POST["question1"];
    $question2 = $_POST["question2"];
    $question3 = $_POST["question3"];
    $question4 = $_POST["question4"];
    $question5 = $_POST["question5"];
    $question6 = $_POST["question6"];
    $question7 = $_POST["question7"];

    // Validate and sanitize the data (you can add more validation as needed)
    $username = htmlspecialchars(trim($username));
    $question1 = htmlspecialchars(trim($question1));
    $question2 = htmlspecialchars(trim($question2));
    $question3 = htmlspecialchars(trim($question3));
    $question4 = htmlspecialchars(trim($question4));
    $question5 = htmlspecialchars(trim($question5));
    $question6 = htmlspecialchars(trim($question6));
    $question7 = htmlspecialchars(trim($question7));

    // Database connection parameters
    $host = "localhost";
    $username_db = "root";
    $password = "";
    $database = "test_db";

    // Attempt to connect to MySQL database
    $conn = new mysqli($host, $username_db, $password, $database);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert data into form1 table
    $sql = "INSERT INTO form1 (username, question1, question2, question3, question4, question5, question6, question7) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters to the prepared statement
    $stmt->bind_param("ssssssss", $username, $question1, $question2, $question3, $question4, $question5, $question6, $question7);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Registration successful";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the prepared statement
    $stmt->close();

    // Close the database connection
    $conn->close();
    
    // Redirect back to the form page or to a confirmation page
    header("Location: fetch_data.php");
    exit();
} else {
    // Redirect back to the form page if the form is not submitted
    header("Location: fetch_data.php");
    exit();
}
?>

