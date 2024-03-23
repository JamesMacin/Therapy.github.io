<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data Chart</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        canvas {
            display: block;
            margin: auto;
            width: 80%; /* Adjust width as needed */
            height: 400px; /* Adjust height as needed */
        }
    </style>
</head>
<body>

    <nav class="navigation">
        <ul class="menu-list">
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="tools and resources.html">Tools and Resources</a></li>
            <li><a href="book an appointment.html">Book Appointment</a></li>
            <li><a href="register.html">New Users Register</a></li>
            <li><a href="signin.html">Sign In</a></li>
        </ul>
    </nav>

    <div class="button-container">
        <a href="book an appointment.html" class="button">Book Appointment</a>
        <a href="tools and resources.html" class="button">Tools and Resources</a>
    </div>

    <canvas id="columnChart"></canvas>

    <?php
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

    $sql = "SELECT username, question1, question2, question3, question4, question5, question6, question7 FROM form1";
    $result = $conn->query($sql);

    $data = array(
        'labels' => array("I often worry that my partner will stop loving me", "I find it easy to be affectionate with my partner", "I fear that once someone gets to know me, they won't like who I am", "I find that I bounce back quick after a break up","When Im not invloved in a relationship, I feel somewhat anxious","I find it difficult to emotionally support my partner when they are feeling down","When my partner is away, Im affraid they might become interested in someone else"), // Removed "Username" from labels
        'datasets' => array()
    );

    // Define an array of colors
    $colors = array('rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)', 'rgba(75, 192, 192, 0.5)', 'rgba(153, 102, 255, 0.5)', 'rgba(255, 159, 64, 0.5)', 'rgba(255, 99, 132, 0.5)');

    if ($result->num_rows > 0) {
        // Output data of each row
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $label = $row['username']; // Username as label
            $data['datasets'][] = array(
                'label' => $label, // Use username as label
                'data' => array($row['question1'], $row['question2'], $row['question3'], $row['question4'], $row['question5'], $row['question6'], $row['question7']),
                'backgroundColor' => $colors[$i], // Assign a color from the array
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 1
            );
            $i++;
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>

    <script>
        var data = <?php echo json_encode($data); ?>;

        var ctx = document.getElementById('columnChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: data.datasets
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










