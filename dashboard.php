<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        canvas {
            margin-top: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>

<?php
// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$database = "test_db";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the "form1" table
$sql = "SELECT username, question1, question2, question3 FROM form1";
$result = $conn->query($sql);

// Initialize arrays to store data for the chart
$labels = [];
$question1Data = [];
$question2Data = [];
$question3Data = [];

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['username'];
        $question1Data[] = $row['question1'];
        $question2Data[] = $row['question2'];
        $question3Data[] = $row['question3'];
    }
}

// Close the database connection
$conn->close();
?>

<h1>User Data Dashboard</h1>

<canvas id="question1Chart"></canvas>
<canvas id="question2Chart"></canvas>
<canvas id="question3Chart"></canvas>

<script>
    var labels = <?php echo json_encode($labels); ?>;
    var question1Data = <?php echo json_encode($question1Data); ?>;
    var question2Data = <?php echo json_encode($question2Data); ?>;
    var question3Data = <?php echo json_encode($question3Data); ?>;

    // Chart for Question 1
    var ctx1 = document.getElementById('question1Chart').getContext('2d');
    var question1Chart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Question 1',
                data: question1Data,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    // Chart for Question 2
    var ctx2 = document.getElementById('question2Chart').getContext('2d');
    var question2Chart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Question 2',
                data: question2Data,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    // Chart for Question 3
    var ctx3 = document.getElementById('question3Chart').getContext('2d');
    var question3Chart = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Question 3',
                data: question3Data,
                backgroundColor: 'rgba(255, 206, 86, 0.5)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

</body>
</html>
